<?php
class Vira_Element_Radio {
    public static function render($args) {
        $terms = get_terms([
            'taxonomy' => $args['taxonomy'],
            'hide_empty' => false
        ]);

        if (empty($terms)) return;

        echo '<div class="vira-filter-radio">';
        echo '<strong>' . esc_html($args['label']) . '</strong>';
        foreach ($terms as $term) {
            echo '<label>';
            echo '<input type="radio" name="' . esc_attr($args['url_key']) . '" value="' . esc_attr($term->slug) . '"> ';
            echo esc_html($term->name);
            echo '</label><br>';
        }
        echo '</div>';
    }
}
