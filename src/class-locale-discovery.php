<?php
/**
 * Locale Discovery class
 *
 * Finds locales that can require plugin language packs without loading every
 * user, site, or site option through WordPress object APIs.
 *
 * @package GratisAIPluginTranslations
 */

declare(strict_types=1);

namespace GratisAIPluginTranslations;

defined( 'ABSPATH' ) || exit;

/**
 * Locale Discovery class.
 *
 * @since 1.0.0
 */
class Locale_Discovery {

	/**
	 * Cached locale summary for the current request.
	 *
	 * @since 1.0.0
	 * @var array<string, array{sources: array<string, bool>}>|null
	 */
	private ?array $locale_summary = null;

	/**
	 * Get locales needed by the current site, network sites, and user profiles.
	 *
	 * @since 1.0.0
	 * @param bool $translation_only Whether to omit English and site-default markers.
	 * @return array<int, string> Locale codes.
	 */
	public function get_locales( bool $translation_only = false ): array {
		return array_keys( $this->get_locale_summary( $translation_only ) );
	}

	/**
	 * Get locale details keyed by locale code.
	 *
	 * @since 1.0.0
	 * @param bool $translation_only Whether to omit English and site-default markers.
	 * @return array<string, array{sources: array<string, bool>}> Locale details keyed by locale code.
	 */
	public function get_locale_summary( bool $translation_only = false ): array {
		$summary = $this->get_all_locale_summary();

		if ( ! $translation_only ) {
			return $summary;
		}

		$translation_summary = array();
		foreach ( $summary as $locale => $locale_data ) {
			if ( $this->is_translation_locale( $locale ) ) {
				$translation_summary[ $locale ] = $locale_data;
			}
		}

		return $translation_summary;
	}

	/**
	 * Get non-English locale details keyed by locale code.
	 *
	 * @since 1.0.0
	 * @return array<string, array{sources: array<string, bool>}> Locale details keyed by locale code.
	 */
	public function get_translation_locale_summary(): array {
		return $this->get_locale_summary( true );
	}

	/**
	 * Check whether a locale needs translated language packs.
	 *
	 * @since 1.0.0
	 * @param string $locale Locale code.
	 * @return bool True when AI translations can be requested for the locale.
	 */
	public function is_translation_locale( string $locale ): bool {
		$locale = trim( $locale );

		return '' !== $locale && ! in_array( $locale, array( 'en_US', 'en', 'site-default' ), true );
	}

	/**
	 * Get all locale details for the current request.
	 *
	 * @since 1.0.0
	 * @return array<string, array{sources: array<string, bool>}> Locale details keyed by locale code.
	 */
	private function get_all_locale_summary(): array {
		if ( null !== $this->locale_summary ) {
			return $this->locale_summary;
		}

		$locales = array();

		$this->add_locale_source( $locales, get_locale(), 'site' );

		foreach ( $this->get_user_profile_locales() as $user_locale ) {
			$this->add_locale_source( $locales, $user_locale, 'user' );
		}

		foreach ( $this->get_network_site_locales() as $site_locale ) {
			$this->add_locale_source( $locales, $site_locale, 'network_site' );
		}

		ksort( $locales );

		$this->locale_summary = $locales;

		return $this->locale_summary;
	}

	/**
	 * Get distinct locale values saved in user profiles without loading users.
	 *
	 * @since 1.0.0
	 * @return array<int, string> Locale codes.
	 */
	private function get_user_profile_locales(): array {
		global $wpdb;

		// Read-only discovery query; only distinct locale strings are needed, not user records.
		$table = $this->quote_identifier( $wpdb->usermeta );

		// Core table name is quoted because this plugin supports WordPress versions before `%i` was introduced; values are prepared below.
		// phpcs:disable WordPress.DB
		// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		// phpcs:disable PluginCheck.Security.DirectDB.UnescapedDBParameter
		$locales = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT meta_value FROM {$table} WHERE meta_key = %s AND meta_value <> %s",
				'locale',
				''
			)
		);
		// phpcs:enable PluginCheck.Security.DirectDB.UnescapedDBParameter
		// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
		// phpcs:enable WordPress.DB

		return $this->normalise_locale_list( (array) $locales );
	}

	/**
	 * Get distinct locale values saved as site languages across the network.
	 *
	 * WordPress stores each site's selected language in that site's options table.
	 * The wp_blogs.lang_id column cannot replace this query: WordPress core
	 * documents it as currently unused and it has no locale-code mapping.
	 *
	 * @since 1.0.0
	 * @return array<int, string> Locale codes.
	 */
	private function get_network_site_locales(): array {
		global $wpdb;

		if ( ! is_multisite() ) {
			return array();
		}

		$batch_size   = (int) apply_filters( 'sd_ai_lang_packs_network_locale_site_batch_size', 100 );
		$batch_size   = max( 1, min( 500, $batch_size ) );
		$last_blog_id = 0;
		$locales      = array();
		$site_count   = 0;

		do {
			// Read-only discovery query; fetch bounded ID batches instead of loading WP_Site objects.
			$table = $this->quote_identifier( $wpdb->blogs );

			// Core table name is quoted because this plugin supports WordPress versions before `%i` was introduced; values are prepared below.
			// phpcs:disable WordPress.DB
			// phpcs:disable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			// phpcs:disable PluginCheck.Security.DirectDB.UnescapedDBParameter
			$site_ids = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT blog_id FROM {$table} "
					. 'WHERE blog_id > %d AND deleted = 0 AND spam = 0 AND archived = 0 '
					. 'ORDER BY blog_id ASC LIMIT %d',
					$last_blog_id,
					$batch_size
				)
			);
			// phpcs:enable PluginCheck.Security.DirectDB.UnescapedDBParameter
			// phpcs:enable WordPress.DB.PreparedSQL.InterpolatedNotPrepared
			// phpcs:enable WordPress.DB

			$site_ids = array_map( 'intval', (array) $site_ids );
			if ( empty( $site_ids ) ) {
				break;
			}

			$site_count   = count( $site_ids );
			$last_blog_id = max( $site_ids );
			$locales      = array_merge( $locales, $this->get_network_site_locales_for_ids( $site_ids ) );
		} while ( $site_count === $batch_size );

		return $this->normalise_locale_list( $locales );
	}

	/**
	 * Get distinct WPLANG values for a batch of site IDs.
	 *
	 * @since 1.0.0
	 * @param array<int, int> $site_ids Site IDs.
	 * @return array<int, string> Locale codes.
	 */
	private function get_network_site_locales_for_ids( array $site_ids ): array {
		global $wpdb;

		$selects = array();
		foreach ( $site_ids as $site_id ) {
			$selects[] = $this->prepare_network_site_locale_select( $site_id );
		}

		if ( empty( $selects ) ) {
			return array();
		}

		// Each UNION branch is prepared above; Plugin Check cannot infer the prepared fragment array.
		// Table names are quoted WordPress blog-prefix identifiers.
		// phpcs:disable WordPress.DB
		// phpcs:disable PluginCheck.Security.DirectDB.UnescapedDBParameter
		$locales = $wpdb->get_col(
			$wpdb->prepare(
				'SELECT DISTINCT locale FROM (' . implode( ' UNION ALL ', $selects ) . ') AS site_locales WHERE locale <> %s',
				''
			)
		);
		// phpcs:enable PluginCheck.Security.DirectDB.UnescapedDBParameter
		// phpcs:enable WordPress.DB

		return $this->normalise_locale_list( (array) $locales );
	}

	/**
	 * Prepare a locale-select query for a site's options table.
	 *
	 * Uses strict backtick quoting for a WordPress-generated table identifier
	 * because this plugin supports WordPress versions before `%i` was introduced.
	 *
	 * @since 1.0.0
	 * @param int $site_id Site ID.
	 * @return string Prepared SELECT query fragment.
	 */
	private function prepare_network_site_locale_select( int $site_id ): string {
		global $wpdb;

		$table = $wpdb->get_blog_prefix( $site_id ) . 'options';
		$table = $this->quote_identifier( $table );

		// Table name is quoted from a WordPress-generated blog prefix; values are prepared below.
		// phpcs:disable WordPress.DB
		// phpcs:disable PluginCheck.Security.DirectDB.UnescapedDBParameter
		$query = $wpdb->prepare(
			"SELECT option_value AS locale FROM {$table} WHERE option_name = %s AND option_value <> %s",
			'WPLANG',
			''
		);
		// phpcs:enable PluginCheck.Security.DirectDB.UnescapedDBParameter
		// phpcs:enable WordPress.DB

		return $query;
	}

	/**
	 * Add a locale source to the locale summary.
	 *
	 * @since 1.0.0
	 * @param array<string, array{sources: array<string, bool>}> $locales Locale details, mutated in place.
	 * @param string                                             $locale  Locale code.
	 * @param string                                             $source  Source key.
	 * @return void
	 */
	private function add_locale_source( array &$locales, string $locale, string $source ): void {
		$locale = trim( $locale );
		if ( '' === $locale ) {
			return;
		}

		if ( ! isset( $locales[ $locale ] ) ) {
			$locales[ $locale ] = array( 'sources' => array() );
		}

		$locales[ $locale ]['sources'][ $source ] = true;
	}

	/**
	 * Normalise a raw locale list.
	 *
	 * @since 1.0.0
	 * @param array<int, mixed> $locales Raw locale values.
	 * @return array<int, string> Locale codes.
	 */
	private function normalise_locale_list( array $locales ): array {
		$normalised = array();
		foreach ( $locales as $locale ) {
			if ( ! is_scalar( $locale ) ) {
				continue;
			}

			$locale = trim( (string) $locale );
			if ( '' !== $locale ) {
				$normalised[] = $locale;
			}
		}

		return array_values( array_unique( $normalised ) );
	}

	/**
	 * Quote a SQL identifier with backticks.
	 *
	 * @since 1.0.0
	 * @param string $identifier SQL identifier.
	 * @return string Quoted identifier.
	 */
	private function quote_identifier( string $identifier ): string {
		return '`' . str_replace( '`', '``', $identifier ) . '`';
	}
}
