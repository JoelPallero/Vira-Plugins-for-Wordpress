<?php
/**
 * Plugin Name: Vira Filter for WooCommerce
 * Description: Sistema avanzado de filtros AJAX para productos de WooCommerce (taxonomías, atributos, campos ACF/PODs).
 * Version: 1.0.0
 * Author: Joel Pallero
 * URI: https://joelpallero.com.ar
 * Text Domain: vira-filter
 */

defined('ABSPATH') || exit;

// Definiciones globales
define('VIRA_FILTER_VERSION', '1.0.0');
define('VIRA_FILTER_PATH', plugin_dir_path(__FILE__));
define('VIRA_FILTER_URL', plugin_dir_url(__FILE__));

// Autocarga básica
require_once VIRA_FILTER_PATH . 'includes/class-vira-loader.php';
require_once VIRA_FILTER_PATH . 'includes/class-vira-cpt.php';

// Hooks de inicialización
add_action('init', ['Vira_Filter_CPT', 'register_cpt']);
add_action('plugins_loaded', ['Vira_Filter_Loader', 'init']);

Vira_Shortcode::init();

Vira_Ajax::init();

wp_enqueue_script('vira-filters', VIRA_FILTER_URL . 'assets/js/vira-filters.js', ['jquery'], '1.0', true);
wp_localize_script('vira-filters', 'vira_filters_ajax', [
    'ajax_url' => admin_url('admin-ajax.php')
]);
