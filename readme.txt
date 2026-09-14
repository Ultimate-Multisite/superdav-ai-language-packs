=== Superdav AI Language Packs ===
Contributors: superdav42
Donate link: https://github.com/sponsors/superdav42
Tags: translation, ai, machine-translation, i18n, localization
Requires at least: 5.8
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Fill in missing WordPress core, plugin, and theme translations with AI.

== Description ==

**Fill in missing WordPress core, plugin, and theme translations with AI.** Superdav AI Language Packs gives your site free, high-quality language packs for WordPress core and the plugins and themes you already use.

The plugin detects every non-English WordPress locale configured for your site, network, or user profiles. When an official translation is unavailable or incomplete, it requests a context-aware AI translation and installs it through WordPress's standard language-pack system. Official WordPress.org translations always take precedence.

The plugin and translation service are free to use. Translation generation is designed for quality, using advanced language models to produce natural, context-aware wording rather than literal word-for-word substitutions.

**Superdav AI Language Packs** provides translations that are:

* Free to generate and download
* Built for natural, high-quality results
* Automatically downloaded when needed
* Only used when official translations are missing or incomplete
* Replaced automatically when an official translation becomes available

It can fill eligible gaps in WordPress core, plugin, and theme translations. Core requests use the exact installed WordPress version and cover the native default, admin, network-admin, and continents/cities domains together. It does not replace non-empty official human translations or delete normal WordPress core language files.

= How It Works =

1. **Automatic Detection**: Background scans detect configured non-English locales, installed plugins, and the exact installed WordPress core version
2. **Smart Filtering**: Only requests AI translations for languages with no official translation, incomplete official translations, or server-verified missing core strings across native domains
3. **On-Demand Generation**: Translation jobs are triggered asynchronously when a real site needs them
4. **Local Caching**: Translations are cached locally for performance
5. **Priority System**: Popular plugins get translated first

= Premium plugin and theme coverage =

The plugin and translation service are free. Existing community language packs also remain free. Optional sponsorship is available for users or vendors who want to fund priority work, premium-product compatibility, or maintained coverage.

Use the optional links on the plugin status page to request coverage or sponsor the project. Every request is reviewed for technical feasibility and distribution rights before work is accepted. Existing community language packs remain free.

= External Service Usage =

This plugin requires the translation service at https://translate.ultimatemultisite.com to check availability and request AI-generated core, plugin, and theme language packs. Requests are made automatically after activation and during scheduled translation checks.

The service receives:

* Plugin or theme text domain and installed version for extensions that need a language pack
* The exact installed WordPress version for a typed core language-pack check
* Requested locale codes, including locales discovered from site, network-site, and user-profile language settings
* Plugin update-source classification when it is available

The request body does not include the site URL, user IDs, names, email addresses, passwords, site content, posts, comments, or database records. The service receives the connection IP address as part of handling an HTTP request.

The plugin stores its cache and downloaded language packs locally. The service provider's handling, retention, and deletion of request data are governed by its current Privacy Policy and Terms of Use:

* **Service**: translate.ultimatemultisite.com
* **Purpose**: Check language-pack availability and generate requested translations
* **Terms of Use**: https://ultimatemultisite.com/terms
* **Privacy Policy**: https://ultimatemultisite.com/privacy

Deactivate the plugin to stop its external requests.

The status page also contains optional links to the project's GitHub issue tracker and GitHub Sponsors profile. GitHub is contacted only after an administrator clicks one of those links. The plugin does not add the site URL, installed-product list, locale list, or other site data to the links. Sponsorship requests are public; do not include licence keys, proprietary files, payment details, or other secrets.

= Features =

* **Smart Detection**: Only downloads AI translations when official ones are missing
* **Free Service**: Generates and downloads community language packs at no cost
* **Quality-Focused AI**: Produces natural, context-aware translations instead of simple word substitutions
* **On-Demand Generation**: Translation jobs triggered when needed
* **WordPress Integration**: Uses standard WordPress translation update mechanisms
* **All WordPress locales**: Detects every non-English locale configured by WordPress, including site, network-site, and user-profile locales
* **Core gap filling**: Checks incomplete or unverifiable locales against the exact WordPress version, and requires all four native core PO catalogs before treating coverage as complete
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

This plugin fills gaps in WordPress core, plugin, and theme translations. Unlike page translation plugins, it downloads actual .mo/.po translation files that WordPress uses natively. It only activates when official translations from wordpress.org are missing or incomplete.

= Is my data safe? =

The plugin sends requested locale codes, limited installed-plugin metadata (text domain, version, and update source when available), and the exact WordPress version for core gap checks to the translation service. It does not include the site URL, user IDs, names, email addresses, passwords, site content, posts, comments, or database records in its request body. The service receives the connection IP address as part of handling an HTTP request. Read the linked Privacy Policy and Terms of Use before activating the plugin.

= What languages are supported? =

Every non-English locale that WordPress can be configured to use, including the 100+ language and regional variants available through WordPress. The plugin does not use a fixed language allowlist: it discovers configured site, network-site, and user-profile locales and requests language packs where coverage is incomplete or cannot be verified.

= Can I use this with existing translation plugins like Polylang or WPML? =

Yes! This plugin handles plugin translations (the .mo files), while Polylang/WPML handle content translations. They work together perfectly.

= What happens if an official translation becomes available? =

Official translations from wordpress.org always take precedence. If a human-reviewed translation becomes available, it will automatically replace the AI translation.

= How much does this cost? =

The plugin and translation service are free to use, including generated community language packs. Optional sponsorship is available for priority work, premium-product compatibility, and maintained vendor coverage, but it is not required to use the service.

= How good are the AI translations? =

The service uses advanced language models to create natural, context-aware translations and standard WordPress language packs. AI can still make mistakes, so official human-reviewed WordPress.org translations always take precedence when available.

== Screenshots ==

1. Language Pack Progress shows active packs, covered plugins, languages, and the background translation workflow.
2. The dashboard explains how AI language packs are requested, installed, and superseded by official WordPress.org translations.

== Changelog ==

= Unreleased =
- New: Check and install typed, exact-version WordPress core AI gap-fill language packs through the native language-pack updater.
- Improved: Status and privacy information now distinguish WordPress core activity from plugin coverage.

= 1.0.4 - 2026-08-25 =
- Improved: Release metadata formatting is now consistent across distribution files.

= 1.0.3 - 2026-08-25 =
- Fix: Completed AI language packs now install correctly when returned by the translation service.

= 1.0.2 - 2026-07-17 =
Version 1.0.2 - Released on 2026-08-19
- Improved: WordPress compatibility metadata now reflects testing through WordPress 7.1.
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

This plugin communicates with translate.ultimatemultisite.com to check language-pack availability and request translations. It sends plugin text domains, plugin versions, plugin update-source classification when available, requested locale codes, and the exact WordPress version for core gap checks. The request body does not include the site URL, user IDs, names, email addresses, passwords, site content, posts, comments, or database records.

The service receives the connection IP address as part of handling an HTTP request. The plugin stores its own cache and downloaded language packs locally; the service provider's processing and retention practices are described in its Privacy Policy: https://ultimatemultisite.com/privacy

You can stop plugin requests by deactivating the plugin.
