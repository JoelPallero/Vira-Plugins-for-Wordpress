<?php
class Vira_Element_Slider {
    public static function render($args) {
        $min = isset($args['min']) ? intval($args['min']) : 0;
        $max = isset($args['max']) ? intval($args['max']) : 1000;

        echo '<div class="vira-filter-slider">';
        echo '<strong>' . esc_html($args['label']) . '</strong>';
        echo '<input type="range" name="' . esc_attr($args['url_key']) . '_min" min="' . $min . '" max="' . $max . '" value="' . $min . '">';
        echo '<input type="range" name="' . esc_attr($args['url_key']) . '_max" min="' . $min . '" max="' . $max . '" value="' . $max . '">';
        echo '</div>';
    }
}
