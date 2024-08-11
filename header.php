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
                <!-- Modifiable dans WP -->
                <div class="logo">
                    <?php the_custom_logo() ?>
                </div>
                <!-- Menu burger -->
                <div>
                    <img class="burgerBouton" src="<?php echo get_stylesheet_directory_uri() . '/images/icone-burger.png' ?>" alt="Icone du menu burger" />
                </div>

            <!-- Menu principale = modifiable dans WP -->
            <nav id="navMenu" class="navBurger">
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
        <div id="affichageModale" >
            <?php get_template_part('/template_part/modale'); ?>
        </div> 