<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cart = WC()->cart;
?>

<div class="sw-checkout-right">
    <div class="sw-order-summary sw-order-summary--checkout">
        <h3 class="sw-summary-heading">RÉSUMÉ DE MA COMMANDE</h3>

        <?php foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
            $product = $cart_item['data'];
            if ( ! $product || ! $product->exists() ) {
                continue;
            }

            $thumbnail = $product->get_image( 'woocommerce_thumbnail' );
            $name      = $product->get_name();
            $meta      = wc_get_formatted_cart_item_data( $cart_item, true );
            $price     = WC()->cart->get_product_subtotal( $product, $cart_item['quantity'] );
        ?>
            <div class="sw-checkout-product-card">
                <div class="sw-checkout-product-image">
                    <?php echo $thumbnail; ?>
                </div>
                <div>
                    <div class="sw-checkout-product-title"><?php echo esc_html( $name ); ?></div>
                    <div class="sw-checkout-product-meta"><?php echo wp_kses_post( $meta ); ?></div>
                    <div class="sw-checkout-product-meta"><?php echo sprintf( 'Quantité : %s', esc_html( $cart_item['quantity'] ) ); ?></div>
                    <div class="sw-checkout-product-meta">Bracelet : Métal</div>
                    <div class="sw-checkout-product-meta">Montre non gravée</div>
                    <div class="sw-checkout-product-price"><?php echo wp_kses_post( $price ); ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="sw-summary-lines">
            <div class="sw-summary-line">
                <span>Sous-total</span>
                <span><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>
            <div class="sw-summary-line">
                <span>Expédition</span>
                <span><?php echo wp_kses_post( WC()->cart->get_cart_shipping_total() ); ?></span>
            </div>
            <div class="sw-summary-line">
                <span>Taxes</span>
                <span><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></span>
            </div>
        </div>

        <div class="sw-summary-total-line">
            <span class="sw-total-label">Total</span>
            <span class="sw-total-value"><?php wc_cart_totals_order_total_html(); ?></span>
        </div>

        <button type="submit" class="sw-btn-checkout">PROCÉDER À L'ACHAT</button>

        <div class="sw-payments-wrapper">
            <div class="sw-payments-line">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/visa.png'; ?>" alt="Visa">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/mastercard.png'; ?>" alt="Mastercard">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/maestro.png'; ?>" alt="Maestro">
            </div>
            <div class="sw-payments-line">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/cb.png'; ?>" alt="CB">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/american-express.png'; ?>" alt="American Express">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/bancontact.png'; ?>" alt="Bancontact">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/sofort.png'; ?>" alt="Sofort">
            </div>
            <div class="sw-payments-line">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/crypto.png'; ?>" alt="Crypto">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/paypal.png'; ?>" alt="PayPal">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/apple-pay.png'; ?>" alt="Apple Pay">
            </div>
        </div>

        <p class="sw-co-payment-note">Paiement sécurisé crypté et authentifié.</p>
    </div>
</div>
