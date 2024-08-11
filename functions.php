<?php
function theme_enqueue_styles(){
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


function theme_enqueue_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('menu-burger', get_template_directory_uri() . '/js/menu.js', array('jquery'), null, true);
    wp_enqueue_script('modale-nav', get_template_directory_uri() . '/js/modale-nav.js', array('jquery'), null, true);
    wp_enqueue_script('miniatures-script', get_template_directory_uri() . '/js/miniatures-script.js', array('jquery'), null, true);
    wp_enqueue_script('filtres-script', get_template_directory_uri() . '/js/filters.js');
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/js/lightbox.js');
    
    if (is_front_page()) {
        wp_enqueue_script('script-chargerplus', get_template_directory_uri() . '/js/charger-plus.js', array('jquery'), null, true);
        wp_localize_script('script-chargerplus', 'myAjax', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce'),
        ));
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_script');


//_______  M E N U  _______//  (tableau de bord WP) 
function register_menus() {
    register_nav_menus(array(
        'menu_principal' => __('Menu principal', 'Photographe'),
        'menu_secondaire' => __('Menu secondaire', 'Photographe'),
    ));
}
add_action('init', 'register_menus');


//_______  L O G O  _______// (modifiable dans WP)
function logo_nav() {
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'logo_nav');


//_______  I C O N E  _______// (icone du site modifiable dans WP)
add_theme_support('custom-logo', array(
    'height' => 100,
    'width' => 400,
    'flex-height' => true,
    'flex-width' => true,
));


//_______  Fonction B O U T O N  _______// (charger plus) 
function charger_plus() {

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $page = $_POST['page'];
    $ordreTriage = $_POST['order'];
    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $ordreTriage,
        'paged' => $page,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_part/block_photos');
        }
        wp_reset_postdata();
    }
    wp_die();
}

add_action('wp_ajax_charger_plus', 'charger_plus');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');


//_______  F I L T R E S  _______//
function filtrer_photos() {

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $tax_query = array('relation' => 'AND');
    $order = $_POST['order'] ?? 'ASC';

    // Si une catégorie est présente et n'est pas égale à all
    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
        $category = $_POST['category'];
        $tax_query[] = array(
            'taxonomy' => 'categoriesphotos',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Si un format est présent et n'est pas égal à all
    if (isset($_POST['format']) && $_POST['format'] !== 'all') {
        $format = $_POST['format'];
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }
    // Création des arguments pour la requête WP_Query
    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $order,
        'paged' => 1,
        'tax_query' => $tax_query,
    );

    $photo_query = new WP_Query($args);

    // Stockage du résultat en tampon temporairement
    ob_start();

    // Définition de la structure d'affichage des nouveaux éléments
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_part/block_photos');
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    // Récupére les infos mis en tampon dans la variable
    $output = ob_get_clean();

    // Affichage de la variable
    echo $output;

    wp_die();
}

add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');
