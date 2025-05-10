<?php
defined('ABSPATH') || exit;

class Vira_Filter_CPT {

    public static function register_cpt() {
        $labels = [
            'name' => __('Filters', 'vira-filter'),
            'singular_name' => __('Filter', 'vira-filter'),
            'add_new' => __('Add New', 'vira-filter'),
            'edit_item' => __('Edit Filter', 'vira-filter'),
        ];

        $args = [
            'label' => __('Filters', 'vira-filter'),
            'labels' => $labels,
            'public' => false,
            'show_ui' => true,
            'menu_icon' => 'dashicons-filter',
            'supports' => ['title'],
            'has_archive' => false,
            'show_in_menu' => true,
        ];

        register_post_type('vira_filter', $args);
    }
}
