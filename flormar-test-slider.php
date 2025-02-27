<?php
/*
 * Plugin Name: Flormar Test Slider
 * Version: 1.0.0
 * Author: Maksym Nizovyi
 * Text Domain: flormar-test-slider
 */

if (!defined('ABSPATH')) {
    exit;
}

function flormar_test_slider_shortcode($atts)
{
    $atts = shortcode_atts(array(
        'max-price' => '',
        'min-price' => '',
    ), $atts, 'flormar-test-slider');

    $meta_query = array();
    if (! empty($atts['min-price'])) {
        $meta_query[] = array(
            'key'     => '_price',
            'value'   => $atts['min-price'],
            'compare' => '>=',
            'type'    => 'NUMERIC'
        );
    }
    if (! empty($atts['max-price'])) {
        $meta_query[] = array(
            'key'     => '_price',
            'value'   => $atts['max-price'],
            'compare' => '<=',
            'type'    => 'NUMERIC'
        );
    }

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );

    if (! empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    $query = new WP_Query($args);

    if (! $query->have_posts()) {
        return '<p>' . esc_html__('No products found.', 'flormar-test-slider') . '</p>';
    }

    ob_start(); ?>

    <div class="flormar-slider">
        <div class="flormar-slider__container">
            <h3><?= __('Best-selling products', 'flormar-test-slider') ?></h3>
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()) : $query->the_post();
                        global $product; ?>
                        <div class="swiper-slide flormar-slider__slide">
                            <a href="<?php the_permalink(); ?>">
                                <?php echo woocommerce_get_product_thumbnail(); ?>
                                <h4 class="product-title"><?php the_title(); ?></h4>
                                <span class="price"><?php echo $product->get_price_html(); ?></span>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

<?php
    wp_reset_postdata();
    return ob_get_clean();
}

function flormar_test_slider_enqueue_scripts()
{
    wp_enqueue_style('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.css');
    wp_enqueue_style('flormar-test-slider', plugins_url('assets/css/slider.css', __FILE__));


    wp_enqueue_script('flormar-test-slider', plugins_url('assets/js/slider-init.js', __FILE__), array('swiper'), '1.0.0', true);
    wp_enqueue_script('swiper', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '8.4.5', true);
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
