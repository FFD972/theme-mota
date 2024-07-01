<?php get_header();?>

<main >
<!-- // temporaire : situer la page -->
    <h1 > home</h1>
    <?php

    while ( have_posts() ) :
        the_post();
        get_template_part( 'template-parts/content/content-page' );

        // If comments are open or there is at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) {
            comments_template();
        }
    endwhile; 
    ?>
</main >

<?php get_footer(); ?>