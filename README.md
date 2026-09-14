# Superdav AI Language Packs

[![Download Plugin Now](https://img.shields.io/github/v/release/Ultimate-Multisite/ultimate-ai-plugin-translations?style=for-the-badge&label=Download+Plugin+Now&color=0073aa)](https://github.com/Ultimate-Multisite/ultimate-ai-plugin-translations/releases/latest/download/superdav-ai-plugin-translations.zip) &nbsp; Upload the zip to WordPress like any other plugin

**Fill in missing WordPress core, plugin, and theme translations with AI.**

Superdav AI Language Packs provides free, high-quality, context-aware language packs when official WordPress.org translations are missing or incomplete. Official translations always take precedence.

## Overview

The official WordPress translation platform relies on human volunteers and only supports extensions hosted in the WordPress.org repositories. This creates a gap for:

- Premium plugins and themes not hosted on WordPress.org
- Plugins and themes with incomplete translations
- Extensions that have not yet been translated by volunteers
- WordPress core locales with remaining untranslated strings

The plugin and translation service are free to use. Advanced language models generate natural, context-aware translations rather than simple word-for-word substitutions. Language packs are:

- Free to generate and download
- Built for natural, high-quality results
- Automatically downloaded when needed
- Only used when official translations are missing or incomplete
- Replaced automatically when an official translation becomes available

## Sponsor Premium Coverage

The plugin, translation service, and existing community language packs remain free. Users, agencies, and premium-plugin vendors can optionally fund priority delivery or maintained coverage for products that WordPress.org cannot host or translate.

Published launch offers:

| Offer | Price | Intended outcome |
|-------|------:|------------------|
| Community campaign | Greater of $299 or $99 per requested language | Fund feasibility and initial language-pack delivery for a requested premium product |
| Vendor launch | $750 once | Compatibility assessment, initial delivery, and up to three languages |
| Vendor maintenance | $149/month, 12-month term | One product, up to five maintained languages, release monitoring, and quarterly reporting |
| Vendor growth | $349/month, 12-month term | One product family, up to 15 languages, priority refreshes, terminology rules, and monthly reporting |

Read [SPONSORSHIP.md](SPONSORSHIP.md) before funding or requesting work. Requests are reviewed for technical feasibility and distribution rights before any deliverable is accepted. General GitHub sponsorship supports the project but does not create a specific delivery obligation unless the request is accepted in writing.

## How It Works

1. **Automatic Detection**: Background scans detect configured non-English locales, installed plugins, and the exact installed WordPress core version
2. **Smart Filtering**: Only requests AI translations for:
    - Languages with no official translation
    - Incomplete official translations (when enabled)
    - Core strings the server verifies are missing across native core domains
3. **On-Demand Generation**: Translation jobs are triggered asynchronously when a real site needs them
4. **Local Caching**: Translations are cached locally for performance
5. **Priority System**: Popular plugins get translated first

### WordPress Core Language Packs

Core is a first-class, versioned target rather than a plugin alias. For each
configured non-English locale whose native core catalogs are incomplete or
cannot be verified, the client sends the exact installed WordPress version
through the typed core batch contract. The server evaluates the `default`,
`admin`, `admin-network`, and `continents-cities` domains together, retains
official human translations, and asks AI only for eligible missing strings. A
returned package is installed through WordPress's native core language-pack
updater.

The client suppresses a core request only when all four expected PO catalogs
prove complete coverage; it never treats a single local PO file as sufficient.
It never deletes normal core language files and safely retries core checks when
connected to an older or unavailable server. Plugin requests and existing cached
packages continue independently.

## Installation

### Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- Multisite supported (network-activated)

### Install via ZIP

1. Download the plugin ZIP file
2. Go to **Plugins > Add New** in your WordPress admin
3. Click **Upload Plugin** and select the ZIP file
4. Click **Install Now** and then **Activate**

### Install via Composer

```bash
composer require ultimate-multisite/superdav-ai-plugin-translations
```

### For Multisite

1. Network activate the plugin from **My Sites > Network Admin > Plugins**
2. View translation status at **My Sites > Network Admin > Settings > AI Translations**

## Status and Configuration

### Status Page

Navigate to **Settings > AI Translations** (single site) or **Network Admin > Settings > AI Translations** (multisite).

The page is read-only. It reports service health, background scan activity, detected non-English locales, queued translation jobs, core coverage, plugin coverage, and installed AI language packs. It does not include a manual refresh button or write plugin options.

### Code Configuration

The plugin runs automatically. Site owners can adjust behaviour from `wp-config.php`, a small must-use plugin, or another trusted plugin:

| Constant / Filter | Description | Default |
|-------------------|-------------|---------|
| `SD_AI_LANG_PACKS_API_BASE` | Custom translation server endpoint | `https://translate.ultimatemultisite.com/wp-json/sd-ai-lang-pack/v1` |
| `sd_ai_lang_packs_fill_incomplete` | Request AI translations for missing strings in incomplete official translations | `true` |
| `sd_ai_lang_packs_cache_duration` | Cache duration for completed translation result sets | `HOUR_IN_SECONDS` |
| `sd_ai_lang_packs_refresh_chunk_size` | Number of plugins processed per background cron chunk | `25` |

You can define these in your `wp-config.php`:

```php
// Custom API endpoint (if running your own server)
define('SD_AI_LANG_PACKS_API_BASE', 'https://your-server.com/wp-json/sd-ai-lang-pack/v1');
```

## WP-CLI Commands

The plugin provides several WP-CLI commands for management:

```bash
# Check API status
wp superdav-ai-plugin-translations status

# Check translations for a specific plugin
wp superdav-ai-plugin-translations check woocommerce

# Request translation for specific locale
wp superdav-ai-plugin-translations check woocommerce --locale=es_ES

# Request translation generation
wp superdav-ai-plugin-translations request woocommerce --locale=de_DE

# List all AI translations
wp superdav-ai-plugin-translations list

# Clear translation cache
wp superdav-ai-plugin-translations clear-cache

# Get translation status
wp superdav-ai-plugin-translations status-plugin woocommerce de_DE
```

## Architecture

### Core Classes

- **Translation_Manager**: Hooks into WordPress update system, manages translation lifecycle
- **Translation_API_Client**: Communicates with the translation server
- **Admin_Settings**: Read-only admin status page
- **CLI**: WP-CLI command handlers

### Hooks Used

- `translations_api`: Filter cached plugin and exact-version core language-pack results
- `sd_ai_lang_packs_refresh_cache`: Refresh and install AI translation packages asynchronously
- `http_request_host_is_external`: Allow downloads from the configured translation server host

### Translation Priority

Translations are prioritized based on plugin popularity:
- 1M+ active installs: Priority 10 (highest)
- 100K+ active installs: Priority 8
- 10K+ active installs: Priority 7
- Others: Priority 5 (default)

## Privacy

- The translation service receives plugin text domains, installed versions, update-source classification when available, requested locale codes, and the exact WordPress version for core gap checks.
- The request body does not include the site URL, user IDs, names, email addresses, passwords, site content, posts, comments, or database records. The service receives the connection IP address as part of handling an HTTP request.
- The plugin stores its cache and downloaded language packs locally. The service provider's handling, retention, and deletion of request data are governed by its [Privacy Policy](https://ultimatemultisite.com/privacy) and [Terms of Use](https://ultimatemultisite.com/terms).
- Deactivate the plugin to stop its external requests.
- The optional sponsorship and coverage-request links open GitHub only when an administrator clicks them. The plugin does not append the site URL, installed-product list, locale list, or other site data to those links.

## Server Requirements

The translation server (`translate.ultimatemultisite.com`) uses:
- GlotPress for translation management
- OpenAI-compatible LLMs for translation generation
- WordPress REST API for client communication

## Development

### File Structure

```
superdav-ai-plugin-translations/
├── superdav-ai-plugin-translations.php # Main plugin file
├── src/
│   ├── class-translation-manager.php  # Core translation logic
│   ├── class-translation-api-client.php  # API communication
│   ├── class-admin-settings.php       # Settings UI
│   └── class-cli.php                  # WP-CLI commands
├── languages/                         # Plugin translations
└── README.md
```

### Coding Standards

- PHP 7.4+ with strict typing
- PSR-2 coding standards
- WordPress coding standards for hooks/filters
- Namespaced classes with autoloading

## Troubleshooting

### Translations Not Downloading

1. Check API status on the settings page
2. Verify the plugin is enabled
3. Check that your site's locale is not English (en_US)
4. Review error logs for API communication issues

### Cache Issues

Clear the translation cache:
```bash
wp superdav-ai-plugin-translations clear-cache
```

Or delete transients manually:
```sql
DELETE FROM wp_sitemeta WHERE meta_key LIKE '%sd_ai_lang_packs_%';
```

## License

GPL-2.0-or-later

## Credits

- Developed by Ultimate Multisite
- Powered by OpenAI-compatible LLMs
- Inspired by the WordPress Polyglots team
