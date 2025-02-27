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
