<?php
namespace SimonsCheckout\Shortcodes;

use function SimonsCheckout\render_template;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Thankyou {

    public static function register() {
        add_shortcode( 'simons_thankyou', [ __CLASS__, 'handle' ] );
    }

    public static function handle( $atts = [], $content = null ): string {
        $order_id  = 0;
        $order_key = '';

        if ( isset( $_GET['key'] ) ) {
            $order_key = wc_clean( wp_unslash( $_GET['key'] ) );
        }

        if ( isset( $_GET['order-received'] ) ) {
            $order_id = absint( $_GET['order-received'] );
        }

        if ( ! $order_id && get_query_var( 'order-received' ) ) {
            $order_id = absint( get_query_var( 'order-received' ) );
        }

        $order = $order_id ? wc_get_order( $order_id ) : false;

        return render_template( 'thankyou', [
            'order'     => $order,
            'order_id'  => $order_id,
            'order_key' => $order_key,
        ] );
    }
}
