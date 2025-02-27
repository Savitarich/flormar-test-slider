<?php
/*
 * Plugin Name: Flormar Test Slider
 * Version: 1.0.0
 * Author: Maskym Nizovyi
 * Text Domain: flormar-test-slider
 */

if (!defined('ABSPATH')) {
    exit;
}

function flormar_test_slider_enqueue_scripts()
{
    wp_enqueue_style('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    wp_enqueue_style('flormar-test-slider', plugins_url('assets/css/slider.css', __FILE__));

    wp_enqueue_script('slick-slider', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);

    wp_enqueue_script('flormar-test-slider', plugins_url('assets/js/slider-init.js', __FILE__), array('jquery', 'slick-slider'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'flormar_test_slider_enqueue_scripts');

add_shortcode('flormar-test-slider', 'flormar_test_slider_shortcode');

function flormar_test_slider_activate()
{
    if (!class_exists('WooCommerce')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('This plugin requires WooCommerce to be installed and activated.');
    }
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flormar_test_slider_activate');

function flormar_test_slider_deactivate()
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'flormar_test_slider_deactivate');
