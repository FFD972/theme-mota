<footer>
    <div>
        <?php
        wp_nav_menu(array(
            'theme_location' =>    'menu_secondaire',
            'container' => false,
            'menu_class' => 'menu',
        ));
        ?>

    </div>
    <p class="textFooter">TOUS DROITS RÉSERVÉS</p>
    <?php get_template_part('/template_part/lightbox'); ?>
</footer>
</div>

<?php wp_footer(); ?>
</body>

</html>