<?php

include VIRA_FILTER_PATH . 'templates/elements/' . $element['type'] . '.php';

class Vira_Metabox {
    public static function init() {
        add_action('add_meta_boxes', [__CLASS__, 'add_metabox']);
        add_action('save_post', [__CLASS__, 'save_metabox']);
    }

    public static function add_metabox() {
        add_meta_box(
            'vira_filter_elements',
            'Filtros del proyecto',
            [__CLASS__, 'render_metabox'],
            'vira_filter',
            'normal',
            'default'
        );
    }

    public static function render_metabox($post) {
        $elements = get_post_meta($post->ID, 'vira_elements', true);
        if (!is_array($elements)) $elements = [];

        wp_nonce_field('vira_save_filters', 'vira_nonce');

        echo '<div id="vira-elements-wrapper">';

        foreach ($elements as $index => $element) {
            include VIRA_FILTER_PATH . 'templates/admin-element-row.php';
        }

        echo '</div>';
        echo '<button type="button" class="button" id="vira-add-element">Agregar Filtro</button>';
    }

    public static function save_metabox($post_id) {
        if (!isset($_POST['vira_nonce']) || !wp_verify_nonce($_POST['vira_nonce'], 'vira_save_filters')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $elements = [];
        if (!empty($_POST['vira_element'])) {
            foreach ($_POST['vira_element'] as $el) {
                $elements[] = [
                    'type' => sanitize_text_field($el['type']),
                    'title' => sanitize_text_field($el['title']),
                    'key' => sanitize_text_field($el['key']),
                    'source' => sanitize_text_field($el['source']),
                    'taxonomy' => sanitize_text_field($el['taxonomy']),
                    'meta' => sanitize_text_field($el['meta']),
                    'display' => sanitize_text_field($el['display'])
                ];
            }
        }

        update_post_meta($post_id, 'vira_elements', $elements);
    }
}
