<?php
namespace SimonsCheckout;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Rendu d'un template de ce plugin.
 *
 * @param string $template_name
 * @param array  $vars
 *
 * @return string
 */
function render_template( string $template_name, array $vars = [] ): string {
    $file = SIMONS_CHECKOUT_PLUGIN_DIR . 'templates/' . $template_name . '.php';

    if ( ! file_exists( $file ) ) {
        return '';
    }

    ob_start();
    extract( $vars, EXTR_SKIP );
    include $file;
    return ob_get_clean();
}
