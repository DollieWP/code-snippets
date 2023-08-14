<?php
//Add this to your functions.php of your theme or ideally in a custom functionality plugin
add_action( 'template_redirect', 'dollie_custom_dashboard_redirect', 1 );

/**
 * Usage: https://yourhub.com?redirect=yes
 * This snippet will redirect a user to their most recent site in your Hub dashboard.
 * If the user is not logged in yet they will first be set to the Login Page. 
 * Once they login they are then redirected to their most recent site on your platform.
 * @since 1.0.0
 */
function dollie_custom_dashboard_redirect() {
    if ( isset( $_GET['redirect'] ) && ! is_user_logged_in() ) {
        // If 'redirect' parameter is present and user is not logged in
        unset( $_COOKIE['dollie_redirect'] );
        $url = $_GET['redirect'];
        setcookie( 'dollie_redirect', $url, time() + ( 86400 * 30 ), '/' );
        wp_safe_redirect( site_url() . '/wp-login.php' );
        exit;
    } elseif ( isset( $_GET['redirect'] ) && is_user_logged_in() ) {
        // If 'redirect' parameter is present and user is logged in
        wp_safe_redirect( dollie()->get_latest_container_url() );
        exit;
    }

    if ( is_user_logged_in() ) {
        // If user is logged in and specific cookie is set
        if ( isset( $_COOKIE['dollie_redirect'] ) ) {
            setcookie( 'dollie_redirect', '', time() - 3600 );
            wp_safe_redirect( dollie()->get_latest_container_url(), 302 );
            exit;
        }
    }
}
