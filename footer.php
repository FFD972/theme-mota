<footer>
        <div>
            <?php
                wp_nav_menu(array(
                    'theme_location' =>	'menu_secondaire',
                    'container' => false,
                    'menu_class' => 'menu',
                    ));
            ?>
            
        </div>
        <p>TOUS DROITS RÉSERVÉS</p>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>