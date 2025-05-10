<?php
class Vira_Element_Select {
    public static function render($args) {
        $terms = get_terms([
            'taxonomy' => $args['taxonomy'],
            'hide_empty' => false
        ]);

        if (empty($terms)) return;

        echo '<div class="vira-filter-select">';
        echo '<strong>' . esc_html($args['label']) . '</strong>';
        echo '<select name="' . esc_attr($args['url_key']) . '">';
        echo '<option value="">' . __('Select…', 'vira-filter') . '</option>';
        foreach ($terms as $term) {
            echo '<option value="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</option>';
        }
        echo '</select>';
        echo '</div>';
    }
}
