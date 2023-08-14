<?php
/**
 * Get a list of sites owned by the current user.
 * Use this in your template files or inside a function.
 *
 * Usage: Display a list of sites owned by the user.
 *
 * @since 1.0.0
 */
$user_id = get_current_user_id(); // Change this if needed
$user_sites = dollie()->get_customer_sites($user_id);

if (!empty($user_sites)) {
    echo "<h3>Your Sites:</h3>";
    echo "<ul>";
    foreach ($user_sites as $site) {
        echo "<li>{$site->post_title}</li>";
    }
    echo "</ul>";
} else {
    echo "You don't have any sites.";
}

//Or create a shortcode like this:
/**
 * Shortcode to display a list of sites owned by the current user.
 * Add this to your theme's functions.php or custom functionality plugin.
 *
 * Usage: [user_sites_list]
 *
 * @since 1.0.0
 */
function user_sites_list_shortcode() {
    $user_id = get_current_user_id(); // Change this if needed
    $user_sites = dollie()->get_customer_sites($user_id);

    $output = '';

    if (!empty($user_sites)) {
        $output .= "<h3>Your Sites:</h3>";
        $output .= "<ul>";
        foreach ($user_sites as $site) {
            $output .= "<li>{$site->post_title}</li>";
        }
        $output .= "</ul>";
    } else {
        $output .= "You don't have any sites.";
    }

    return $output;
}
add_shortcode('user_sites_list', 'user_sites_list_shortcode');
