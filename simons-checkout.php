<?php
/**
 * Plugin Name: Simon's Checkout
 * Description: Tunnel de vente personnalisé (cart / checkout / merci) pour Simon's Watches avec shortcodes.
 * Author: Remy / ChatGPT
 * Version: 1.0.0
 * Text Domain: simons-checkout
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'SIMONS_CHECKOUT_PLUGIN_FILE' ) ) {
    define( 'SIMONS_CHECKOUT_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'SIMONS_CHECKOUT_PLUGIN_DIR' ) ) {
    define( 'SIMONS_CHECKOUT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SIMONS_CHECKOUT_PLUGIN_URL' ) ) {
    define( 'SIMONS_CHECKOUT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Vérifie que WooCommerce est actif
 */
function simons_checkout_is_woocommerce_active() {
    return class_exists( 'WooCommerce' );
}

/**
 * Charger le plugin
 */
function simons_checkout_init() {
    if ( ! simons_checkout_is_woocommerce_active() ) {
        add_action( 'admin_notices', function () {
            echo '<div class="notice notice-error"><p><strong>Simon\'s Checkout</strong> nécessite WooCommerce.</p></div>';
        } );
        return;
    }

    require_once SIMONS_CHECKOUT_PLUGIN_DIR . 'includes/class-simons-checkout-plugin.php';
    \SimonsCheckout\Plugin::instance();
}
add_action( 'plugins_loaded', 'simons_checkout_init' );
