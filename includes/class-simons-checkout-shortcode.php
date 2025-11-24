<?php
namespace SimonsCheckout\Shortcodes;

use function SimonsCheckout\render_template;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Checkout {

    public static function register() {
        add_shortcode( 'simons_checkout', [ __CLASS__, 'handle' ] );
    }

    public static function handle( $atts = [], $content = null ): string {
        if ( ! function_exists( 'WC' ) ) {
            return '';
        }

        $checkout = WC()->checkout();

        return render_template( 'checkout', [
            'checkout' => $checkout,
        ] );
    }
}
