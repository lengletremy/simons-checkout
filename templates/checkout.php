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

    <!-- Fil d'Ariane -->
    <div class="sw-breadcrumb">
        Mon panier &gt; Informations &gt; Paiement
    </div>

    <!-- Titre principal -->
    <h1 class="sw-page-title">MES COORDONNÉES</h1>

    <form name="checkout"
          method="post"
          class="checkout sw-checkout-form woocommerce-checkout"
          action="<?php echo esc_url(wc_get_checkout_url()); ?>">

        <div class="sw-grid-2">

            <!-- ==================================================== -->
            <!--                     COLONNE GAUCHE                   -->
            <!-- ==================================================== -->
            <div class="sw-checkout-left">

                <?php if (!is_user_logged_in()) : ?>

                <!-- =============================== -->
                <!-- ÉTAPE 1 : Onglets Figma -->
                <!-- =============================== -->

                <div class="sw-step1-wrapper">

                    <!-- TITRES: les tab switches -->
                    <div class="sw-step1-tabs">
                        <button type="button"
                                class="sw-step1-tab sw-step1-tab--active"
                                data-tab="guest">
                            COMMANDER SANS INSCRIPTION
                        </button>

                        <button type="button"
                                class="sw-step1-tab"
                                data-tab="login">
                            SE CONNECTER À MON COMPTE
                        </button>
                    </div>

                    <!-- ZONE CONTENU GRIS -->
                    <div class="sw-step1-panel-bg">

                        <!-- TAB 1 : Guest -->
                        <div class="sw-step1-panel sw-step1-panel--guest sw-step1-panel--active">

                            <label class="sw-input-label">Adresse e-mail*</label>
                            <input type="email"
                                   name="billing_email"
                                   class="sw-input-underline"
                                   placeholder="Ex.: exemple@tagheuer.com"
                                   value="<?php echo esc_attr($checkout->get_value('billing_email')); ?>"
                                   required>

                            <button type="button" class="sw-btn-red sw-btn-validate-email">
                                VALIDER
                            </button>

                            <p class="sw-step1-note">
                                Vous pourrez créer votre compte à la fin du processus de paiement.
                            </p>
                        </div>

                        <!-- TAB 2 : Login -->
                        <div class="sw-step1-panel sw-step1-panel--login">

                            <form method="post"
                                  action="<?php echo esc_url(wp_login_url(wc_get_checkout_url())); ?>">

                                <label class="sw-input-label">Adresse e-mail*</label>
                                <input type="email"
                                       name="log"
                                       class="sw-input-underline"
                                       placeholder="Ex.: exemple@simonswatches.com"
                                       required>

                                <label class="sw-input-label">Mot de passe*</label>
                                <input type="password"
                                       name="pwd"
                                       class="sw-input-underline"
                                       placeholder="Votre mot de passe"
                                       required>

                                <p class="sw-step1-terms">
                                    En me connectant à mon compte, je confirme avoir lu et accepté la Politique de Confidentialité.
                                </p>

                                <button type="submit" class="sw-btn-red">
                                    CONNEXION
                                </button>

                                <p class="sw-forgot">
                                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>">Mot de passe oublié ?</a>
                                </p>
                            </form>

                        </div>

                    </div>
                </div>

                <?php else : ?>

                <!-- =============================== -->
                <!-- UTILISATEUR CONNECTÉ (maquette TUNNEL 12) -->
                <!-- =============================== -->

                <div class="sw-step1-wrapper">
                    <div class="sw-step1-tabs">
                        <span class="sw-step1-tab sw-step1-tab--active">
                            MES INFORMATIONS
                        </span>
                    </div>

                    <div class="sw-step1-panel-bg">
                        <p class="sw-co-connected">
                            Vous êtes connecté en tant que
                            <strong><?php echo esc_html(wp_get_current_user()->display_name); ?></strong>.
                            <a href="<?php echo esc_url(wc_logout_url(wc_get_checkout_url())); ?>">Se déconnecter</a>
                        </p>
                    </div>
                </div>

                <?php endif; ?>

                <!-- =============================== -->
                <!-- ADRESSE DE LIVRAISON (Étape 2 PDF) -->
                <!-- =============================== -->
                <section class="sw-co-block sw-co-block--address">
                    <h2 class="sw-co-block-title">ADRESSE DE LIVRAISON</h2>

                    <div class="sw-co-fields-grid">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <p class="sw-co-checkbox">
                        <label>
                            <input type="checkbox" name="sw_same_addresses" checked>
                            Mes adresses de facturation et d'expédition sont les mêmes
                        </label>
                    </p>
                </section>

                <!-- MODE DE LIVRAISON -->
                <section class="sw-co-block sw-co-block--shipping">
                    <h2 class="sw-co-block-title">MODE DE LIVRAISON</h2>
                </section>

            </div>

            <!-- ==================================================== -->
            <!--                    COLONNE DROITE                    -->
            <!-- ==================================================== -->
            <?php include 'simons-checkout-summary.php'; ?>

        </div>

    </form>

</div>
