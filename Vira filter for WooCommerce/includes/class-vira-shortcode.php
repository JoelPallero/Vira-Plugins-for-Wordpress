<?php
class Vira_Shortcode {
    public static function init() {
        add_shortcode('vira_filters', [__CLASS__, 'render_filters']);
    }

    public static function render_filters($atts) {
        $atts = shortcode_atts([
            'id' => 0,
        ], $atts);

        $project_id = intval($atts['id']);
        if (!$project_id) return '';

        $elements = get_post_meta($project_id, 'vira_elements', true);
        if (empty($elements) || !is_array($elements)) return '';

        ob_start();
        echo '<form id="vira-filters-form">';

        foreach ($elements as $element) {
            $type = sanitize_text_field($element['type']);
            $class_name = 'Vira_Element_' . ucfirst($type);
            $file = VIRA_FILTER_PATH . 'elements/class-vira-element-' . strtolower($type) . '.php';

            if (file_exists($file)) {
                require_once $file;
                if (class_exists($class_name)) {
                    call_user_func([$class_name, 'render'], $element);
                }
            }
        }

        echo '</form>';
        echo '<div id="vira-products-results"></div>'; // Aquí se cargan los productos vía AJAX
        return ob_get_clean();
    }
}
