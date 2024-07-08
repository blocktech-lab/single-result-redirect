<?php
if (!defined('ABSPATH')) exit;

function ssr_plugin_meta($links, $file) {
    if (strpos($file, 'single-result-redirect.php') !== false) {
        $links[] = '<a href="https://github.com/blocktech-dev/single-result-redirect">' . __('Github', 'single-result-redirect') . '</a>';
    }
    return $links;
}
add_filter('plugin_row_meta', 'ssr_plugin_meta', 10, 2);

function ssr_action_links($actions, $plugin_file) {
    if (strpos($plugin_file, 'single-result-redirect.php') !== false && current_user_can('manage_options')) {
        array_unshift($actions, '<a href="options-general.php">' . __('Settings', 'solo') . '</a>');
    }
    return $actions;
}
add_filter('plugin_action_links', 'ssr_action_links', 10, 2);

function ssr_fork_check() {
    if (function_exists('calmpress_version') || function_exists('classicpress_version')) {
        $plugins = get_plugins();
        $name = $plugins[SOLO_SEARCH_PLUGIN_BASE]['Name'];
        deactivate_plugins(SOLO_SEARCH_PLUGIN_BASE);

        $message = '<p><b>' . sprintf(__('%1$s has been deactivated', 'single-result-redirect'), $name) . '</b></p>'
            . '<p>' . __('Reason:', 'single-result-redirect') . '</p>'
            . '<ul><li>' . __('A fork of WordPress was detected.', 'single-result-redirect') . '</li></ul>'
            . '<p>' . sprintf(__('The author of %1$s will not provide any support until the above are resolved.', 'single-result-redirect'), $name) . '</p>';

        wp_die(wp_kses($message, ['p' => [], 'b' => [], 'ul' => [], 'li' => []]), '', ['back_link' => true]);
    }
}
add_action('admin_init', 'ssr_fork_check');