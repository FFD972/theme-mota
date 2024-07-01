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
            <!-- Custom_logo = modifiable dans WP -->
            <div class="logo">
                <?php the_custom_logo() ?>
            </div>
            <!-- Menu principale = modifiable dans WP -->
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu_principal',
                    'container' => false,
                    'menu_class' => 'menu',
                ));
                ?>
            </nav>

            <!-- Ajout de la modale -->
            <div class="modale">
                <?php get_template_part('/template_part/modale'); ?>
            </div>

        </header>

     