<?php
namespace SimonsCheckout\Shortcodes;

use function SimonsCheckout\render_template;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Cart {

    public static function register() {
        add_shortcode( 'simons_cart', [ __CLASS__, 'handle' ] );
    }

    public static function handle( $atts = [], $content = null ): string {
        if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
            return '<p>Votre panier est vide.</p>';
        }

        $cart = WC()->cart;

        return render_template( 'cart', [
            'cart' => $cart,
        ] );
    }
}
