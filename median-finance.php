<?php
/*
Plugin Name: Median Finance
Plugin URI: https://yourwebsite.com/property-payment
Description: A simple mortgage calculator plugin for WordPress.
Version: 1.0
Author: Median development
Author URI: https://mediandevelopment.uz
Text Domain: median-finance
Domain Path: /languages
*/

/// Проверка на прямой доступ
if (!defined('ABSPATH')) {
    exit;
}



add_action('elementor/widgets/widgets_registered', 'register_median_calc_widget');

function register_median_calc_widget($manager) {
    require_once plugin_dir_path(__FILE__) . 'includes/median-calc-widget.php';
    $manager->register_widget_type(new Median_Calc_Widget());
}



// Подключение скриптов и стилей для виджета
function enqueue_median_finance_styles() {

    wp_enqueue_style('nouislider-style', plugins_url('/assets/js/nouislider.min.css', __FILE__));
    wp_enqueue_style('median-finance-style', plugins_url('/assets/css/style.css', __FILE__));

    wp_enqueue_script('wnumb-script', 'https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js', array(), '1.2.0', true);
    wp_enqueue_script('nouislider-script', plugins_url('/assets/js/nouislider.min.js', __FILE__) , array(), '15.7.1', true);
    wp_enqueue_script('median-finance-script', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), '', true);

}



add_action('elementor/frontend/after_enqueue_styles', 'enqueue_median_finance_styles');


