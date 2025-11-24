<?php
/**
 * Template page de remerciement Simon's
 *
 * @var WC_Order|null $order
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="sw-thankyou-page">
    <div class="sw-thankyou-hero">
        <div class="sw-container">
            <h1 class="sw-thankyou-title">MERCI POUR VOTRE COMMANDE&nbsp;!</h1>

            <?php if ( $order ) : ?>
                <p class="sw-thankyou-text">
                    Votre commande n°<?php echo esc_html( $order->get_order_number() ); ?> a bien été enregistrée.<br>
                    Vous recevrez un e-mail de confirmation à
                    <strong><?php echo esc_html( $order->get_billing_email() ); ?></strong>.
                </p>
            <?php else : ?>
                <p class="sw-thankyou-text">
                    Votre commande a bien été enregistrée.
                </p>
            <?php endif; ?>

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sw-btn-primary">
                Revenir à la page d’accueil
            </a>
        </div>
    </div>

    <div class="sw-thankyou-benefits">
        <div class="sw-container sw-benefits-grid">
            <div class="sw-benefit-item">Garantie d’Authenticité</div>
            <div class="sw-benefit-item">Protection de l’Acheteur</div>
            <div class="sw-benefit-item">Montres certifiées authentiques</div>
            <div class="sw-benefit-item">Livraison Sécurisée</div>
        </div>
    </div>
</div>
