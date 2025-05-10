<?php
class Vira_Element_Reset {
    public static function render($args) {
        echo '<div class="vira-filter-reset">';
        echo '<button type="reset" class="vira-reset-button">' . esc_html($args['label'] ?: __('Reset Filters', 'vira-filter')) . '</button>';
        echo '</div>';
    }
}
