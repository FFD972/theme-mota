<?php
// Récupérer le numéro de la page actuelle
$paged = get_query_var("paged") ? get_query_var("paged") : 1;
// Définir les arguments pour la requête
$args = [
    "post_type" => "photographies",
    "posts_per_page" => 8,
    "orderby" => "date",
    "order" => "DESC",
    "paged" => $paged,
];
// Créer la requête WP_Query avec les arguments définis
$photo_query = new WP_Query($args);
?>
<section class="galerie">
    <?php
    // Boucle pour afficher les posts
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            // Pointe le premier post lors du premier appel puis se déplace au suivant
            $photo_query->the_post();
            echo "<figure class='galerie-item'>";
            if (has_post_thumbnail()) {
                // Affiche l'image mise en avant avec une taille personnalisée
                the_post_thumbnail("catalogue", ['class' => 'galerie-img']);
            } else {
                echo "<p>Aucune image mise en avant pour cette publication</p>";
            }
            echo "</figure>";
        }
        // Réinitialise les données du post
        wp_reset_postdata();
    }
    else {
        echo "Aucune publication trouvée";
    }
    ?>
</section>