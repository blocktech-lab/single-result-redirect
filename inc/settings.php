<?php
if (!defined('ABSPATH')) exit;

function ssr_settings_init() {
    add_settings_section('ssr_section', __('SingleResult Redirect Search', 'single-result-redirect'), 'ssr_section_callback', 'general');

    $fields = [
        'srr_option_single' => [
            'title' => __('Redirect on SingleResult', 'single-result-redirect'),
            'callback' => 'ssr_setting_single_callback'
        ],
        'srr_option_exact_posts' => [
            'title' => __('Exact title match', 'single-result-redirect'),
            'callback' => 'ssr_setting_exact_posts_callback'
        ],
        'srr_option_exact_pages' => [
            'title' => '',
            'callback' => 'ssr_setting_exact_pages_callback'
        ]
    ];

    foreach ($fields as $option => $field) {
        add_settings_field($option, $field['title'], $field['callback'], 'general', 'ssr_section', ['label_for' => $option]);
        register_setting('general', $option);
    }
}
add_action('admin_init', 'ssr_settings_init');

function ssr_section_callback() {
    echo esc_html__('Define how you want search results to be handled, when exact matches and single results are found.', 'single-result-redirect');
}

function ssr_setting_single_callback() {
    echo '<label><input name="srr_option_single" type="checkbox" value="1" ' . checked(1, get_option('srr_option_single', 1), false) . '> ' . __('If a single result is found, redirect to that result', 'single-result-redirect') . '</label>';
}

function ssr_setting_exact_posts_callback() {
    echo '<label><input name="srr_option_exact_posts" type="checkbox" value="1" ' . checked(1, get_option('srr_option_exact_posts', ''), false) . '> ' . __('Enable for Posts', 'single-result-redirect') . '</label>';
}

function ssr_setting_exact_pages_callback() {
    echo '<label><input name="srr_option_exact_pages" type="checkbox" value="1" ' . checked(1, get_option('srr_option_exact_pages', ''), false) . '> ' . __('Enable for Pages', 'single-result-redirect') . '</label><br><br>';
    echo '<p class="description">' . __('If an exact match to a title is found, redirect to it.', 'single-result-redirect') . '</p>';
}