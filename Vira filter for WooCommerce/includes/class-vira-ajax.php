<?php
class Vira_Ajax {
    public static function init() {
        add_action('wp_ajax_vira_filter_products', [__CLASS__, 'filter']);
        add_action('wp_ajax_nopriv_vira_filter_products', [__CLASS__, 'filter']);
    }

    public static function filter() {
        parse_str($_POST['filters'], $args);

        $query_args = [
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 12,
            'tax_query' => [],
            'meta_query' => [],
        ];

        foreach ($args as $key => $value) {
            if (is_array($value)) {
                $query_args['tax_query'][] = [
                    'taxonomy' => $key,
                    'field'    => 'slug',
                    'terms'    => $value,
                    'operator' => 'IN'
                ];
            } elseif (strpos($key, '_min') !== false || strpos($key, '_max') !== false) {
                $field = str_replace(['_min', '_max'], '', $key);
                $meta_key = $field;

                $min = isset($args[$field . '_min']) ? floatval($args[$field . '_min']) : 0;
                $max = isset($args[$field . '_max']) ? floatval($args[$field . '_max']) : 999999;

                $query_args['meta_query'][] = [
                    'key' => $meta_key,
                    'value' => [$min, $max],
                    'compare' => 'BETWEEN',
                    'type' => 'NUMERIC'
                ];
            }
        }

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                wc_get_template_part('content', 'product');
            }
        } else {
            echo '<p>No se encontraron productos.</p>';
        }

        wp_die();
    }
}
