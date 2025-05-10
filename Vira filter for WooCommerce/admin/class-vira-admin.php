<?php
defined('ABSPATH') || exit;

class Vira_Filter_Admin {

    public static function init() {
        add_action('add_meta_boxes', [__CLASS__, 'add_meta_boxes']);
        add_action('save_post', [__CLASS__, 'save_filter_data']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_admin_assets']);
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'vira_filter_builder',
            __('Filter Builder', 'vira-filter'),
            [__CLASS__, 'render_filter_builder'],
            'vira_filter',
            'normal',
            'default'
        );
    }

    public static function enqueue_admin_assets() {
        wp_enqueue_style('vira-admin', VIRA_FILTER_URL . 'assets/css/admin.css', [], VIRA_FILTER_VERSION);
        wp_enqueue_script('vira-admin', VIRA_FILTER_URL . 'assets/js/admin.js', ['jquery'], VIRA_FILTER_VERSION, true);
    }

    public static function render_filter_builder($post) {
        $elements = get_post_meta($post->ID, '_vira_elements', true) ?: [];

        echo '<div id="vira-filter-builder" data-elements="' . esc_attr(json_encode($elements)) . '"></div>';
        echo '<input type="hidden" name="vira_elements_json" id="vira_elements_json" value="">';
    }

    public static function save_filter_data($post_id) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['vira_elements_json'])) {
            $data = json_decode(stripslashes($_POST['vira_elements_json']), true);
            update_post_meta($post_id, '_vira_elements', $data);
        }
    }
}
