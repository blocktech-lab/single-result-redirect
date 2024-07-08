<?php
if (!defined('ABSPATH')) exit;

function ssr_remove_single_results() {
    if (!is_search()) return;

    global $wp_query;

    $posts  = get_option('srr_option_exact_posts', 0);
    $pages  = get_option('srr_option_exact_pages', 0);
    $single = get_option('srr_option_single', 1);

    $get_page_func = function_exists('wpcom_vip_get_page_by_title') ? 'wpcom_vip_get_page_by_title' : 'get_page_by_title';
    $search_query = get_search_query();

    if ($posts && $page = $get_page_func($search_query, 'OBJECT', 'post')) {
        wp_safe_redirect(get_permalink($page->ID));
        exit;
    }

    if ($pages && $page = $get_page_func($search_query, 'OBJECT', 'page')) {
        wp_safe_redirect(get_permalink($page->ID));
        exit;
    }

    if ($single && 1 === $wp_query->post_count && 1 === $wp_query->max_num_pages) {
        wp_safe_redirect(get_permalink($wp_query->posts[0]->ID));
        exit;
    }
}

add_action('template_redirect', 'ssr_remove_single_results');