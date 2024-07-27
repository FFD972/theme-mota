<?php
    // Infos Block images
    $titre_post = get_the_title();
    $titre_nettoye = sanitize_title($titre_post);
    $lien_post = get_site_url() . '/photographies/' . $titre_nettoye;
    $photo_post = get_the_post_thumbnail(get_the_ID(), 'large');
    $date_post = get_the_date('Y');
    $reference_photo = get_field('reference');

    // Récupération du format de la photo et stockage pour filtrage
    $formats = get_the_terms(get_the_ID(), 'formats');
    if ($formats && !is_wp_error($formats)) {
        $noms_formats = array();
        foreach ($formats as $format) {
            $noms_formats[] = $format->name;
        }
        $liste_formats = join(', ', $noms_formats);
    }

    // Récupération de la catégorie de la photo et stockage pour filtrage
    $categories = get_the_terms(get_the_ID(), 'categoriesphotos');
    if ($categories && !is_wp_error($categories)) {
        $noms_categories = array();
        foreach ($categories as $categorie) {
            $noms_categories[] = $categorie->name;
        }
        $liste_categories = join(', ', $noms_categories);
    }
?>

<!-- HTML d'une photo -->
<div class="blockPhoto">
    <div class="blockPhoto-lien">
         <?php echo $lien_post; ?> 
    </div>
    <div class=blockPhoto-post>
        <?php echo $photo_post; ?>
    </div>
    <div class="blockHover">
        <div class="blockHover-fullscreen">
                <i class="fa-solid fa-expand full-screen"></i>
        </div>
        <div class="blockHover-eye"> 
            <i class="fa-regular fa-eye oeil"></i>
        </div>
        <div class="blockHover-reference">
            <div class="ref-img">
                <?php echo $reference_photo ?>
            </div>
            <div class="ref-categories">
                <?php echo $liste_categories; ?>
            </div>
        </div>
    </div>
</div>