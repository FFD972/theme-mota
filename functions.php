<!-- Chargement du style CSS et des scripts -->
 <?php
function theme_enqueue_styles(){
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

        
// Gestion des menus dans le tableau de bord de wordpress
function register_custom_menus() {
    register_nav_menus(array(
        'menu_principal' => __('Menu principal', 'Photographe'),
        'menu_secondaire' => __('Menu secondaire', 'Photographe'),
    ));
}
add_action('init', 'register_custom_menus');

// Image mis en avant
add_theme_support("post-thumbnails");