<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );


add_filter('wp_nav_menu_items', 'ajouter_element_menu_admin', 10, 2);

function ajouter_element_menu_admin($items, $args) {
    // Vérifiez si l'utilisateur est connecté en tant qu'administrateur
    if (is_user_logged_in() && current_user_can('administrator')) {
        // Générer l'URL de connexion de l'administration
        $admin_login_url = wp_login_url();

        // Créer l'élément "Admin" avec l'URL de connexion
        $admin_link = '<li class="menu-item"><a class="admin-link" href="' . esc_url($admin_login_url) . '">Admin</a></li>';
        
        // Ajouter l'élément "Admin" à la fin de la liste d'éléments
        $items .= $admin_link;
    }
    return $items;
}


?>

