 <?php
function theme_enqueue_styles(){
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function theme_enqueue_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('modale-script', get_template_directory_uri() . '/js/modale-script.js');
    wp_enqueue_script('miniatures-script', get_template_directory_uri() . '/js/miniatures-script.js');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');


//Gestion des menus dans le tableau de bord de wordpress
function register_menus() {
    register_nav_menus(array(
        'menu_principal' => __('Menu principal', 'Photographe'),
        'menu_secondaire' => __('Menu secondaire', 'Photographe'),
    ));
}
add_action('init', 'register_menus');


//Hook logo du site, modifiable dans le dashboard
function logo_nav() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'logo_nav');


// Ajout d'un logo
add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
));