=== Superdav AI Language Packs ===
Contributors: superdav42
Tags: translation, ai, machine-translation, i18n, localization
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

AI language packs for installed WordPress plugins when official translations are missing or incomplete.

== Description ==

**Finally, your installed WordPress plugins can speak the language your site and team use.** Superdav AI Language Packs detects each non-English WordPress locale configured for your site, network, or user profiles and supplies standard AI-generated language packs when official translations are missing or incomplete.

Install it and use the dashboard to see translation activity, locale coverage, and available language packs. Official WordPress.org translations always take precedence.

**Superdav AI Language Packs** helps by providing plugin translations that are:

* Automatically downloaded when needed
* Generated on-demand using advanced language models
* Only used when official translations are missing or incomplete
* Always respectful of official translations (they take precedence)

It translates installed plugins; it does not replace WordPress core or theme translations.

= How It Works =

1. **Automatic Detection**: When WordPress checks for plugin updates, the plugin detects which plugins need translations
2. **Smart Filtering**: Only requests AI translations for languages with no official translation or incomplete official translations
3. **On-Demand Generation**: Translation jobs are triggered when a real site needs them
4. **Local Caching**: Translations are cached locally for performance
5. **Priority System**: Popular plugins get translated first

= Premium plugin and theme coverage =

Need a language pack for a premium plugin or theme? Managed translation coverage is available from $100 per year per product, subject to availability. Open a support request to discuss your product, locales, and coverage requirements.

= External Service Usage =

This plugin requires the translation service at https://translate.ultimatemultisite.com to check availability and request AI-generated plugin language packs. Requests are made automatically after activation and during scheduled translation checks.

The service receives:

* Plugin text domain and installed version for plugins that need a language pack
* Requested locale codes, including locales discovered from site, network-site, and user-profile language settings
* Plugin update-source classification when it is available

The request body does not include the site URL, WordPress version, user IDs, names, email addresses, passwords, site content, posts, comments, or database records. The service receives the connection IP address as part of handling an HTTP request.

The plugin stores its cache and downloaded language packs locally. The service provider's handling, retention, and deletion of request data are governed by its current Privacy Policy and Terms of Use:

* **Service**: translate.ultimatemultisite.com
* **Purpose**: Check language-pack availability and generate requested translations
* **Terms of Use**: https://ultimatemultisite.com/terms
* **Privacy Policy**: https://ultimatemultisite.com/privacy

Deactivate the plugin to stop its external requests.

= Features =

* **Smart Detection**: Only downloads AI translations when official ones are missing
* **On-Demand Generation**: Translation jobs triggered when needed
* **WordPress Integration**: Uses standard WordPress translation update mechanisms
* **All WordPress locales**: Detects every non-English locale configured by WordPress, including site, network-site, and user-profile locales
* **Multisite Support**: Network-activated with per-site locale detection
* **Priority System**: Popular plugins get translated first
* **Caching**: Both API responses and translation files are cached
* **WP-CLI Support**: Full command-line management
* **Transparent service disclosure**: Documents the installation data sent to the translation service

== Installation ==

= Requirements =

* WordPress 5.8 or higher
* PHP 7.4 or higher
* Multisite supported (network-activated)

= From WordPress.org =

1. Go to **Plugins > Add New** in your WordPress admin
2. Search for "Superdav AI Language Packs"
3. Click **Install Now** and then **Activate**

= Manual Installation =

1. Download the plugin ZIP file
2. Go to **Plugins > Add New > Upload Plugin**
3. Select the ZIP file and click **Install Now**
4. Click **Activate**

= For Multisite =

1. Network activate the plugin from **My Sites > Network Admin > Plugins**
2. View translation status at **My Sites > Network Admin > Settings > AI Translations**

== Frequently Asked Questions ==

= How does this differ from Google Translate or other translation plugins? =

This plugin specifically fills the gap in plugin translations. Unlike page translation plugins, it downloads actual .mo/.po translation files that WordPress uses natively. It only activates when official translations from wordpress.org are missing or incomplete.

= Is my data safe? =

The plugin sends requested locale codes and limited installed-plugin metadata (text domain, version, and update source when available) to the translation service. It does not include the site URL, WordPress version, user IDs, names, email addresses, passwords, site content, posts, comments, or database records in its request body. The service receives the connection IP address as part of handling an HTTP request. Read the linked Privacy Policy and Terms of Use before activating the plugin.

= What languages are supported? =

Every non-English locale that WordPress can be configured to use, including the 100+ language and regional variants available through WordPress. The plugin does not use a fixed language allowlist: it discovers configured site, network-site, and user-profile locales and requests a language pack for each one.

= Can I use this with existing translation plugins like Polylang or WPML? =

Yes! This plugin handles plugin translations (the .mo files), while Polylang/WPML handle content translations. They work together perfectly.

= What happens if an official translation becomes available? =

Official translations from wordpress.org always take precedence. If a human-reviewed translation becomes available, it will automatically replace the AI translation.

= How much does this cost? =

The plugin and community-plugin language packs are free while the service is in beta. Managed language-pack coverage for a premium plugin or theme starts at $100 per year per product; open a support request to discuss availability.

== Screenshots ==

1. Language Pack Progress shows active packs, covered plugins, languages, and the background translation workflow.
2. The dashboard explains how AI language packs are requested, installed, and superseded by official WordPress.org translations.

== Changelog ==

= 1.0.2 - 2026-07-17 =
* New: WordPress.org listing icon, banners, and dashboard screenshots.
* New: Listing copy clarifying support for every configured WordPress locale.
* New: Premium plugin and theme translation coverage information.

= 1.0.1 - 2026-07-17 =
* First WordPress.org release for Superdav AI Language Packs.

= 1.0.0 - 2026-04-23 =
* New: Automatic AI translation downloads for plugins missing official translations
* New: Smart filtering — parses .po files to detect genuinely incomplete translations, not just missing ones
* New: Detect WordPress.org vs premium plugins; source is included in batch requests to the server
* New: Chunked, batched translation refresh to handle large plugin lists without timeouts
* New: Rich admin status page with per-plugin and per-locale translation counts
* New: Background activity reporting for chunked translation refreshes
* New: Default auto_approve=false — AI translations wait for server-side approval before downloading
* New: Allow downloads from translation server on private-IP/local networks (development environments)
* New: Full multisite support with network-admin settings page

== Upgrade Notice ==

= 1.0.2 =
Adds WordPress.org listing assets and clarifies locale coverage.

= 1.0.1 =
First WordPress.org release for Superdav AI Language Packs.

= 1.0.0 =
Initial release. No upgrade necessary.

== Credits ==

* Developed by Ultimate Multisite
* Translations powered by OpenAI GPT models
* Inspired by the WordPress Polyglots team

== Privacy Policy ==

This plugin communicates with translate.ultimatemultisite.com to check language-pack availability and request translations. It sends plugin text domains, plugin versions, plugin update-source classification when available, and requested locale codes. The request body does not include the site URL, WordPress version, user IDs, names, email addresses, passwords, site content, posts, comments, or database records.

The service receives the connection IP address as part of handling an HTTP request. The plugin stores its own cache and downloaded language packs locally; the service provider's processing and retention practices are described in its Privacy Policy: https://ultimatemultisite.com/privacy

You can stop plugin requests by deactivating the plugin.
