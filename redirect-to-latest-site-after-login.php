<?php
//Add this to your functions.php of your theme or ideally in a custom functionality plugin
add_filter('login_redirect', 'dollie_custom_redirect_after_login');
/**
 * Usage: https://yourhub.com?redirect=yes
 * This snippet will redirect a user to their most recent site in your Hub dashboard after they login
 * 
 * @since 1.0.0
 */
function dollie_custom_redirect_after_login() {
    if ( is_user_logged_in() ) {
        // If user is logged in and specific cookie is set
        if ( isset( $_COOKIE['dollie_redirect'] ) ) {
            setcookie( 'dollie_redirect', '', time() - 3600 );
            wp_safe_redirect( dollie()->get_latest_container_url(), 302 );
            exit;
        }
    }
}
