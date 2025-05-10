<?php
defined('ABSPATH') || exit;

class Vira_Filter_Loader {

    public static function init() {
        if (is_admin()) {
            require_once VIRA_FILTER_PATH . 'admin/class-vira-admin.php';
            Vira_Filter_Admin::init();
        } else {
            require_once VIRA_FILTER_PATH . 'includes/class-vira-frontend.php';
            Vira_Filter_Frontend::init();
        }
    }
}
