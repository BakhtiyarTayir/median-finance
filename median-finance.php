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

    $options = get_option('median_finance_settings');
    
    
    $prices12 = [];
    $prices24 = [];
    for ($i = 2; $i <= 10; $i++) {
        $prices12[$i] = isset($options['median_finance_price_12m_' . $i]) ? $options['median_finance_price_12m_' . $i] : 0;
        $prices24[$i] = isset($options['median_finance_price_24m_' . $i]) ? $options['median_finance_price_24m_' . $i] : 0;
    }

    wp_enqueue_style('nouislider-style', plugins_url('/assets/js/nouislider.min.css', __FILE__));
    wp_enqueue_style('median-finance-style', plugins_url('/assets/css/style.css', __FILE__));

    wp_enqueue_script('wnumb-script', 'https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js', array(), '1.2.0', true);
    wp_enqueue_script('nouislider-script', plugins_url('/assets/js/nouislider.min.js', __FILE__) , array(), '15.7.1', true);
    wp_enqueue_script('median-finance-script', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), '', true);

    wp_register_script('median-finance-script', plugins_url('/assets/js/script.js', __FILE__), array('jquery'), '', true);

    wp_localize_script('median-finance-script', 'medianFinanceData', array(
        'prices12' => $prices12,
        'prices24' => $prices24
    ));

    wp_enqueue_script('median-finance-script');
}



add_action('elementor/frontend/after_enqueue_styles', 'enqueue_median_finance_styles');


// Добавление страницы настроек
function median_finance_menu() {
    add_menu_page(
        'Настройки Median Finance', // Заголовок страницы
        'Median Finance',           // Текст в меню
        'manage_options',           // Требуемые права
        'median-finance',           // Slug страницы
        'median_finance_options_page'    // Функция отображения содержимого страницы
    );
}
add_action('admin_menu', 'median_finance_menu');




function median_finance_settings_init() {
    register_setting('median-finance', 'median_finance_settings');

    add_settings_section(
        'median_finance_median-finance_section_12m',
        __('Настройки калькулятора (12 месяцев)', 'median_finance'),
        'median_finance_settings_section_callback',
        'median-finance'
    );
    
    add_settings_section(
        'median_finance_median-finance_section_24m',
        __('Настройки калькулятора (24 месяца)', 'median_finance'),
        'median_finance_settings_section_callback',
        'median-finance'
    );

    for ($i = 2; $i <= 10; $i++) {
        add_settings_field(
            'median_finance_price_12m_' . $i,
            __('Цена за кв.м. на этаже ' . $i, 'median_finance'),
            'median_finance_price_render_12m',
            'median-finance',
            'median_finance_median-finance_section_12m',
            ['floor' => $i]
        );
        add_settings_field(
            'median_finance_price_24m_' . $i,
            __('Цена за кв.м. на этаже ' . $i, 'median_finance'),
            'median_finance_price_render_24m',
            'median-finance',
            'median_finance_median-finance_section_24m',
            ['floor' => $i]
        );
    }
}

add_action('admin_init', 'median_finance_settings_init');

function median_finance_price_render_12m($args) {
    $floor = $args['floor'];
    $option_name = 'median_finance_price_12m_' . $floor;
    $options = get_option('median_finance_settings');
    $price = isset($options[$option_name]) ? $options[$option_name] : '';
    ?>
    <input type='text' name='median_finance_settings[<?php echo $option_name; ?>]' value='<?php echo $price; ?>'>
    <?php
}

function median_finance_price_render_24m($args) {
    $floor = $args['floor'];
    $option_name = 'median_finance_price_24m_' . $floor;
    $options = get_option('median_finance_settings');
    $price = isset($options[$option_name]) ? $options[$option_name] : '';
    ?>
    <input type='text' name='median_finance_settings[<?php echo $option_name; ?>]' value='<?php echo $price; ?>'>
    <?php
}


function median_finance_options_page() {
    ?>
    <form action='options.php' method='post'>
        
        <?php
        settings_fields('median-finance');
        do_settings_sections('median-finance');
        submit_button();
        ?>
    </form>
    <?php
}


function median_finance_settings_section_callback() {
    // Эта функция вызывается для отображения содержимого раздела настроек.
    // Если у вас нет конкретного содержимого для этого раздела, вы можете оставить эту функцию пустой.
}

