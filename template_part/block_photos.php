<?php
$titre_post = get_the_title();
$titre_nettoye = sanitize_title($titre_post);
$lien_post = get_site_url() . '/photographies/' . $titre_nettoye;
$reference_photo = get_field('reference');
$photo_post = get_the_post_thumbnail(get_the_ID(), 'large');
$date_post = get_the_date('Y');
$photo_post_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');

// Récupération du format
$formats = get_the_terms(get_the_ID(), 'formats');
if ($formats && !is_wp_error($formats)) {
    $noms_formats = array();
    foreach ($formats as $format) {
        $noms_formats[] = $format->name;
    }
    $liste_formats = join(', ', $noms_formats);
}

// Récupération de la catégorie 
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
    <div class=blockPhoto-post>
        <?php echo $photo_post; ?>
    </div>
    <div class="blockHover">
        <button class="blockHover-fullscreen" data-full-image="<?php echo $photo_post_full[0]; ?>">
            <i class="fa-solid fa-expand full-screen" aria-label="Afficher en plein écran"></i>
        </button>
        <div class="blockHover-eye">
            <a href="<?php echo $lien_post; ?> ">
                <i class="fa-regular fa-eye oeil"></i>
            </a>
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