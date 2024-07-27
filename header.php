<!doctype html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
        <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
        <?php wp_head(); ?>
    </head>

    <body>
        <header>
            <div class="divHeader">
                <!-- Custom_logo = modifiable dans WP -->
                <div class="logo">
                    <?php the_custom_logo() ?>
                </div>
            <!-- Icone du Menu Burger -->
            <div class="burger">
                <img class="burger-open" src="<?php echo get_stylesheet_directory_uri() . '/images/icone-burger.png' ?>" alt=" icone menu burger" />
            </div>
            <!-- Menu principale = modifiable dans WP -->
            <nav id="navMenu">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_principal',
                    'container' => false,
                    'menu_class' => 'menu',
                ));
                ?>
            </nav>
           </div> 
        </header>
        <!-- Ajout de la modale -->
        <div class="affichageModale" >
            <?php get_template_part('/template_part/modale'); ?>
        </div> 