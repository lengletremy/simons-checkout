<?php
/**
 * Simon's Watches — Template du panier
 * Version finale conforme Figma / Tunnel de Vente (6)
 */

if (!defined('ABSPATH')) {
    exit;
}

$cart = WC()->cart;
?>

<div class="sw-container sw-cart-page">

    <!-- Fil d'Ariane -->
    <div class="sw-breadcrumb">
        Mon panier &gt; Information &gt; Paiement
    </div>

    <!-- Titre -->
    <h1 class="sw-page-title">MON PANIER</h1>

    <div class="sw-grid-2">

        <!-- ============================================================ -->
        <!--                     COLONNE GAUCHE                           -->
        <!-- ============================================================ -->
        <div class="sw-cart-left">

            <!-- Bannière information livraison -->
            <div class="sw-cart-info-banner">
    <div class="sw-cart-info-icon">
        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/alert-truck.png'; ?>" alt="">
    </div>

    <div class="sw-cart-info-text">
        <div class="sw-cart-info-title">Livraison le lendemain</div>
        <p>
            Livraison gratuite le lendemain (jour ouvré) pour toutes les commandes
            passées avant 13 heures.
        </p>
        <p>
            Veuillez noter que les montres gravées seront livrées sous 8 à 15 jours.
        </p>
    </div>

    <button type="button" class="sw-cart-info-close" aria-label="Fermer l’alerte">
        ×
    </button>
</div>


            <?php if ($cart->is_empty()) : ?>

                <p>Votre panier est vide.</p>

            <?php else : ?>

                <?php foreach ($cart->get_cart() as $cart_item_key => $cart_item) :

                    $product = $cart_item['data'];
                    if (!$product || !$product->exists()) {
                        continue;
                    }

                    $product_id = $product->get_id();
                    $permalink  = $product->is_visible() ? $product->get_permalink($cart_item) : '';
                    $thumbnail  = $product->get_image('woocommerce_single');
                    $name       = $product->get_name();
                    $price      = WC()->cart->get_product_subtotal($product, $cart_item['quantity']);
                    $meta       = wc_get_formatted_cart_item_data($cart_item, false);
                ?>

                    <!-- Carte individuelle du produit (bordure fine autour) -->
                    <div class="sw-cart-product-card">

                        <div class="sw-cart-item">

                            <!-- Image -->
                            <div class="sw-cart-image">
                                <?php if ($permalink) : ?>
                                    <a href="<?php echo esc_url($permalink); ?>">
                                        <?php echo $thumbnail; ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo $thumbnail; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Détails produit -->
                            <div class="sw-cart-details">

                                <div class="sw-cart-top-row">

                                    <!-- Titre -->
                                    <div class="sw-cart-title">
                                        <?php if ($permalink) : ?>
                                            <a href="<?php echo esc_url($permalink); ?>">
                                                <?php echo esc_html($name); ?>
                                            </a>
                                        <?php else : ?>
                                            <?php echo esc_html($name); ?>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Supprimer -->
                                    <a class="sw-cart-remove"
                                       href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>">
                                        ×
                                    </a>
                                </div>

                                <!-- Meta (taille, mouvement…) -->
                                <div class="sw-cart-meta">
                                    <?php echo wp_kses_post($meta); ?>
                                </div>

                                <!-- Prix -->
                                <div class="sw-cart-price">
                                    <?php echo wp_kses_post($price); ?>
                                </div>

                                <!-- Ajuster le bracelet -->
                                <div class="sw-adjust-link">
                                    <a href="#">Ajuster le bracelet</a>
                                </div>

                            </div>

                        </div><!-- /.sw-cart-item -->

                    </div><!-- /.sw-cart-product-card -->

                <?php endforeach; ?>

            <?php endif; ?>

            <!-- Recommandations -->
            <h2 class="sw-reco-title">
                Ce que nous recommandons
                <span class="sw-reco-line"></span>
            </h2>

            <div class="sw-reco-grid">
                <?php woocommerce_cross_sell_display(4, 4); ?>
            </div>

        </div>

        <!-- ============================================================ -->
        <!--                     COLONNE DROITE                           -->
        <!-- ============================================================ -->
        <div class="sw-cart-sidebar">

            <div class="sw-order-summary">

                <!-- Sous-total / Shipping / Taxes -->
                <div class="sw-summary-lines">

                    <div class="sw-summary-line">
                        <span>Sous-total</span>
                        <span><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>

                    <div class="sw-summary-line">
                        <span>Expédition</span>
                        <span><?php wc_cart_totals_shipping_html(); ?></span>
                    </div>

                    <div class="sw-summary-line">
                        <span>Taxes</span>
                        <span><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
                    </div>

                </div>

                <!-- TOTAL -->
                <div class="sw-summary-total-line">
                    <span class="sw-total-label">Total</span>
                    <span class="sw-total-value"><?php wc_cart_totals_order_total_html(); ?></span>
                </div>

                <!-- Bouton Procéder à l'achat -->
                <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
                   class="sw-btn-checkout">
                    Procéder à l'achat
                </a>

                <!-- Logos paiement (2 lignes) -->
                <div class="sw-payments-wrapper">

                    <div class="sw-payments-line">
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/visa.png'; ?>" alt="">
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/mastercard.png'; ?>" alt="">
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/maestro.png'; ?>" alt="">
                    </div>

                    <div class="sw-payments-line">
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/cb.png'; ?>" alt="">
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/paypal.png'; ?>" alt="">
                    </div>

                </div>

                <!-- Avantages -->
                <ul class="sw-benefits-list">

                    <li>
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/benefit-lock.png'; ?>" alt="">
                        <span>Transactions Sécurisées</span>
                    </li>

                    <li>
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/benefit-truck.png'; ?>" alt="">
                        <span>Livraison Offerte et Retours Faciles</span>
                    </li>

                    <li>
                        <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/benefit-badge.png'; ?>" alt="">
                        <span>Authenticité Garantie</span>
                    </li>

                </ul>

            </div>

            <!-- Besoin d’aide -->
            <div class="sw-help-box">
                <img src="<?php echo SIMONS_CHECKOUT_PLUGIN_URL . 'assets/img/help-contact.png'; ?>" alt="">
                <span>Besoin d'aide ? <a href="/contact">Contactez-nous</a></span>
            </div>

        </div>

    </div>

</div>
