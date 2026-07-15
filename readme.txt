=== Superdav AI Language Packs ===
Contributors: superdav42
Tags: translation, ai, machine-translation, i18n, localization
Requires at least: 5.8
Tested up to: 7.0
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically provides AI-generated translations for WordPress plugins when official translations are missing or incomplete.

== Description ==

The official WordPress translation platform (translate.wordpress.org) relies on human volunteers and only supports plugins hosted in the WordPress.org plugin repository. This creates a gap for premium plugins, plugins with incomplete translations, and plugins that haven't been fully translated.

**Superdav AI Language Packs** bridges this gap by providing AI-powered translations that are:

* Automatically downloaded when needed
* Generated on-demand using advanced language models
* Only used when official translations are missing or incomplete
* Always respectful of official translations (they take precedence)

= How It Works =

1. **Automatic Detection**: When WordPress checks for plugin updates, the plugin detects which plugins need translations
2. **Smart Filtering**: Only requests AI translations for languages with no official translation or incomplete official translations
3. **On-Demand Generation**: Translation jobs are triggered when a real site needs them
4. **Local Caching**: Translations are cached locally for performance
5. **Priority System**: Popular plugins get translated first

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
2. Search for "Superdav AI Plugin Translations"
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

The service currently supports: Spanish, German, French, Italian, Portuguese, Dutch, Russian, Polish, Swedish, Danish, Finnish, Hungarian, Czech, Romanian, Turkish, Greek, Chinese, and Japanese.

= Can I use this with existing translation plugins like Polylang or WPML? =

Yes! This plugin handles plugin translations (the .mo files), while Polylang/WPML handle content translations. They work together perfectly.

= What happens if an official translation becomes available? =

Official translations from wordpress.org always take precedence. If a human-reviewed translation becomes available, it will automatically replace the AI translation.

= How much does this cost? =

The plugin is free. The translation service is currently offered at no cost while in beta.

== Screenshots ==

1. Status page showing service health, background activity, detected locales, and translation statistics
2. Translation table showing installed AI language packs and queued translations

== Changelog ==

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
