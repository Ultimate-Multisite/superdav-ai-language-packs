<?php
/**
 * Loads the plugin under the same WordPress bootstrap assumptions used at runtime.
 *
 * @package GratisAIPluginTranslations
 */

declare(strict_types=1);

if (!defined('WPINC')) {
    define('WPINC', 'wp-includes');
}

require_once dirname(__DIR__) . '/superdav-ai-language-packs.php';
