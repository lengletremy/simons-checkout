<?php
/**
 * Simon's Watches — Template Checkout
 * Basé sur TUNNEL DE VENTE (12)
 */

if (!defined('ABSPATH')) {
    exit;
}

$checkout = WC()->checkout();
$cart     = WC()->cart;

?>

<div class="sw-container sw-checkout-page">

    <div class="sw-breadcrumb">
        Mon panier &gt; Informations &gt; Paiement
    </div>

    <h1 class="sw-page-title">MES COORDONNÉES</h1>
    <p class="sw-co-required">* Champs obligatoires</p>

    <form name="checkout"
          method="post"
          class="checkout sw-checkout-form woocommerce-checkout"
          action="<?php echo esc_url( wc_get_checkout_url() ); ?>">

        <div class="sw-grid-2">

            <div class="sw-checkout-left">

                <?php if ( ! is_user_logged_in() ) : ?>
                    <section class="sw-co-block sw-co-block--login">
                        <div class="sw-co-login-tabs">
                            <button type="button" class="sw-co-login-tab sw-co-login-tab--active" data-sw-login-tab="guest">
                                COMMANDER SANS INSCRIPTION
                            </button>
                            <button type="button" class="sw-co-login-tab" data-sw-login-tab="login">
                                SE CONNECTER À MON COMPTE
                            </button>
                        </div>

                        <div class="sw-co-login-panels">
                            <div class="sw-co-login-panel sw-co-login-panel--guest sw-co-login-panel--active">
                                <div class="sw-field">
                                    <label for="sw_guest_email">Adresse e-mail*</label>
                                    <input id="sw_guest_email"
                                           type="email"
                                           name="billing_email"
                                           class="input-text sw-input-underline"
                                           placeholder="Ex: exemple@tagheur.com"
                                           value="<?php echo esc_attr( $checkout->get_value( 'billing_email' ) ); ?>"
                                           required>
                                </div>
                                <button type="button" class="sw-btn-validate-email sw-btn-red">Valider</button>
                                <p class="sw-co-login-note">Vous pourrez créer votre compte à la fin du processus de paiement.</p>
                            </div>

                            <div class="sw-co-login-panel sw-co-login-panel--login">
                                <form method="post" action="<?php echo esc_url( wp_login_url( wc_get_checkout_url() ) ); ?>">
                                    <div class="sw-field">
                                        <label for="sw_login_email">Adresse e-mail*</label>
                                        <input id="sw_login_email"
                                               type="email"
                                               name="log"
                                               class="input-text sw-input-underline"
                                               placeholder="exemple@simonswatches.com"
                                               required>
                                    </div>
                                    <div class="sw-field">
                                        <label for="sw_login_password">Mot de passe*</label>
                                        <input id="sw_login_password"
                                               type="password"
                                               name="pwd"
                                               class="input-text sw-input-underline"
                                               placeholder="Votre mot de passe"
                                               required>
                                    </div>

                                    <p class="sw-step1-terms">
                                        En me connectant à mon compte, je confirme avoir lu et accepté la Politique de Confidentialité.
                                    </p>

                                    <button type="submit" class="sw-btn-red">Connexion</button>
                                    <p class="sw-forgot">
                                        <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">Mot de passe oublié ?</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </section>
                <?php else : ?>
                    <section class="sw-co-block sw-co-block--login">
                        <div class="sw-co-login-tabs">
                            <span class="sw-co-login-tab sw-co-login-tab--active">MES INFORMATIONS</span>
                        </div>
                        <div class="sw-co-login-panels sw-co-login-panels--connected">
                            <p class="sw-co-connected">
                                Vous êtes connecté en tant que <strong><?php echo esc_html( wp_get_current_user()->display_name ); ?></strong>.
                                <a href="<?php echo esc_url( wc_logout_url( wc_get_checkout_url() ) ); ?>">Se déconnecter</a>
                            </p>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="sw-co-block sw-co-block--address sw-checkout-section sw-checkout-section--open">
                    <button type="button" class="sw-checkout-section-header" aria-expanded="true">
                        <span class="sw-co-block-title">ADRESSE DE LIVRAISON</span>
                        <span class="sw-checkout-section-toggle" aria-hidden="true"></span>
                    </button>
                    <div class="sw-checkout-section-body sw-co-block-inner sw-co-block-inner--light">
                        <div class="sw-co-fields-grid">
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                        </div>
                        <p class="sw-co-checkbox">
                            <label>
                                <input type="checkbox" name="ship_to_different_address" value="0" checked>
                                Mes adresses de facturation et d'expédition sont les mêmes
                            </label>
                        </p>
                    </div>
                </section>

                <section class="sw-co-block sw-co-block--shipping sw-checkout-section">
                    <button type="button" class="sw-checkout-section-header" aria-expanded="false">
                        <span class="sw-co-block-title">MODE DE LIVRAISON</span>
                        <span class="sw-checkout-section-toggle" aria-hidden="true"></span>
                    </button>
                    <div class="sw-checkout-section-body sw-co-block-inner sw-co-block-inner--light">
                        <?php
                        $packages        = WC()->shipping()->get_packages();
                        $chosen_methods  = WC()->session->get( 'chosen_shipping_methods' );
                        ?>

                        <?php if ( ! empty( $packages ) ) : ?>
                            <?php foreach ( $packages as $i => $package ) : ?>
                                <?php if ( empty( $package['rates'] ) ) : ?>
                                    <p class="sw-checkout-hint">
                                        <?php esc_html_e( 'Aucune méthode de livraison disponible pour cette adresse.', 'woocommerce' ); ?>
                                    </p>
                                <?php else : ?>
                                    <?php foreach ( $package['rates'] as $method ) : ?>
                                        <label class="sw-shipping-option" for="shipping_method_<?php echo esc_attr( $i . '_' . $method->id ); ?>">
                                            <input type="radio"
                                                   name="shipping_method[<?php echo esc_attr( $i ); ?>]"
                                                   data-index="<?php echo esc_attr( $i ); ?>"
                                                   id="shipping_method_<?php echo esc_attr( $i . '_' . $method->id ); ?>"
                                                   value="<?php echo esc_attr( $method->id ); ?>"
                                                <?php checked( $method->id, $chosen_methods[ $i ] ?? '' ); ?> />
                                            <span><?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?></span>
                                        </label>
                                        <?php do_action( 'woocommerce_after_shipping_rate', $method, $i ); ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="sw-checkout-hint"><?php esc_html_e( 'Veuillez renseigner votre adresse pour voir les modes de livraison.', 'woocommerce' ); ?></p>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="sw-co-block sw-co-block--payment sw-checkout-section">
                    <button type="button" class="sw-checkout-section-header" aria-expanded="false">
                        <span class="sw-co-block-title">PAIEMENT</span>
                        <span class="sw-checkout-section-toggle" aria-hidden="true"></span>
                    </button>
                    <div class="sw-checkout-section-body sw-co-block-inner sw-co-block-inner--light">
                        <?php woocommerce_checkout_payment(); ?>
                    </div>
                </section>
            </div>

            <?php include SIMONS_CHECKOUT_PLUGIN_DIR . 'templates/checkout-summary.php'; ?>

        </div>

    </form>

</div>
