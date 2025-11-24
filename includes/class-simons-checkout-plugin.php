<?php
namespace SimonsCheckout;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin {

    /** @var Plugin */
    protected static $instance;

    public static function instance(): Plugin {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->includes();
        $this->hooks();
    }

    protected function includes() {
        require_once SIMONS_CHECKOUT_PLUGIN_DIR . 'includes/helpers.php';
        require_once SIMONS_CHECKOUT_PLUGIN_DIR . 'includes/class-simons-cart-shortcode.php';
        require_once SIMONS_CHECKOUT_PLUGIN_DIR . 'includes/class-simons-checkout-shortcode.php';
        require_once SIMONS_CHECKOUT_PLUGIN_DIR . 'includes/class-simons-thankyou-shortcode.php';
    }

    protected function hooks() {
        add_action( 'init', [ $this, 'register_shortcodes' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public function register_shortcodes() {
        \SimonsCheckout\Shortcodes\Cart::register();
        \SimonsCheckout\Shortcodes\Checkout::register();
        \SimonsCheckout\Shortcodes\Thankyou::register();
    }

    public function enqueue_assets() {
        if ( ! is_cart() && ! is_checkout() && ! is_wc_endpoint_url( 'order-received' ) ) {
            return;
        }

        wp_enqueue_style(
            'simons-checkout',
            SIMONS_CHECKOUT_PLUGIN_URL . 'assets/css/simons-checkout.css',
            [],
            '1.0.0'
        );

        wp_enqueue_script(
            'simons-checkout',
            SIMONS_CHECKOUT_PLUGIN_URL . 'assets/js/simons-checkout.js',
            [ 'jquery' ],
            '1.0.0',
            true
        );
    }
}
