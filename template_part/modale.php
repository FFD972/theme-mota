
    <div class="overlay" id="modaleOverlay"></div>
    <div id="divModale">
        <button class="modale__close">X</button>
        <div class="modale__contacte">
                <!-- Image "contact" du dessus-->
            <img class="modale__img" src="<?php echo get_stylesheet_directory_uri() . '/images/modale-header.png' ?>" alt="image du formulaire de contact"/>
            <div class="modale__cf7">
                <?php echo do_shortcode('[contact-form-7 id="657eadc" title="Contact form 1"]');?>
            </div>
        </div>
    </div>

