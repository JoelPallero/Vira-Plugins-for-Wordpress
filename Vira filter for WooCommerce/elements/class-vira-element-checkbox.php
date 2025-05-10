<?php
class Vira_Element_Checkbox {
    public static function render($args) {
        $terms = get_terms([
            'taxonomy' => $args['taxonomy'],
            'hide_empty' => false
        ]);

        if (empty($terms)) return;

        echo '<div class="vira-filter-checkbox">';
        echo '<strong>' . esc_html($args['label']) . '</strong>';
        echo '<ul>';
        foreach ($terms as $term) {
            echo '<li>';
            echo '<label>';
            echo '<input type="checkbox" name="' . esc_attr($args['url_key']) . '[]" value="' . esc_attr($term->slug) . '"> ';
            echo esc_html($term->name);
            echo '</label>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
