<?php
function enqueue_child_styles() {
    $parent_style = 'hello-elementor-style';

    // Enqueue parent theme style as a dependency
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');

    // Enqueue child theme style with parent style as a dependency
    wp_enqueue_style('mon-theme-enfant-style', get_stylesheet_uri(), array($parent_style), wp_get_theme()->get('Version'));
    
    // Enqueue additional child theme style
    wp_enqueue_style('child-theme-style', get_stylesheet_directory_uri() . '/theme.min.css', array(), '1.0.0', 'all');
}

// Fonction pour ajouter un lien "Admin" dans le menu du header
add_action('nav_menu_item_title', 'ajouter_element_menu_admin', 10, 4);

function ajouter_element_menu_admin($title, $menu_item, $args, $depth) {
    // Vérifiez si l'utilisateur est connecté en tant qu'administrateur
    if (is_user_logged_in() && current_user_can('administrator')) {
        // Ajoutez votre élément au titre du menu
        $title .= ' (Admin)';
    }
    return $title;
}

?>