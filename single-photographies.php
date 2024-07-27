 <!-- Page d'affiche d'une photo  -->

<?php 
	wp_head();
	get_header();

$slug = get_query_var('photographies');

// Récupération du post sélctionné
$args = [
    'post_type' => 'photographies',
    'name' => $slug,
    'posts_per_page' => 1
];

// Requête auprès de la base de données wordpress pour récupérer la photo correspondante
$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();

	$reference = get_field('reference');
	$type = get_field('type_photo');
    $annee = get_field('annee');
	$categories = wp_get_post_terms(get_the_ID(), 'categoriesphotos');
	$formats = wp_get_post_terms(get_the_ID(), 'formats');
?>


<!--  Z O N E  S U P E R I E U R E  -->
<!--  G A U C H E  -->
<section class="singlePhoto">
    <div class="singlePhoto-infos">
		<h2 class="singletitle"><?php echo the_title(); ?> </h2>
		<p>RÉFÉRENCE : <?php echo esc_html($reference);?> </p>
		<p>CATÉGORIE : 
			<?php
			if (is_array($categories)) {
				foreach ($categories as $categorie) {
					if (is_object($categorie) && property_exists($categorie, 'name')) {
						echo esc_html($categorie->name);
					}
				}
			} else {
				echo 'Pas de catégories disponibles';
			}
			?>
		</p>
		<p>FORMAT : 
			<?php
			if (is_array($formats)) {
				foreach ($formats as $format) {
					if (is_object($format) && property_exists($format, 'name')) {
						echo esc_html($format->name);
					}
				}
			} else {
				echo 'Pas de formats disponibles';
			}
			?>
		</p>
		<p>TYPE : <?php echo esc_html($type);?> </p>
		<p>ANNÉE : <?php echo esc_html($annee);?> </p>
	</div>

<!--  D R O I T E  -->
	<div class="singlePhoto-img">
		<?php the_post_thumbnail('large');?>
	</div>
</section>


<!--  Z O N E  C E N T R A L E -->
<!-- Ajout du bandeau d'interactions-->
<section class="sectionCentrale">
	<div class="centrale">
		<div class="centraleLeft">
			<p>Cette photo vous intéresse ?</p>
			<button class="centraleLeft-btn">Contact</button>
		</div>

		<div class="centraleRight">
			<!-- Définition des bornes du tableau pour créer une boucle -->
			<?php 
				// Requête pour obtenir le dernier post
				$args_dernier = array(
					'post_type' => 'photographies', 
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC',
				);

				$last_post = new WP_Query($args_dernier);

				// Requête pour obtenir le premier post
				$args_premier = array(
					'post_type' => 'photographies', 
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'ASC',
				);

				$first_post = new WP_Query($args_premier);
			?>

			<div class="div-vignettes">
				<div class="conteneur-vignette-precedent">
					<?php
						// Affichage du post précédent
						if (!empty($previous_post)) {
							$miniature = get_post_field('post_content', $previous_post->ID);
						} else {
							$miniature = get_post_field('post_content', $last_post);
						}
						// Affichage du contenu
						echo $miniature;
					?>
				</div>
				<div class="conteneur-vignette-suivant">
					<?php
						// Affichage du post suivant
						if (!empty($next_post)) {
							$vignette = get_post_field('post_content', $next_post->ID);
						} else {
							$vignette = get_post_field('post_content', $first_post);
						}
						// Affichage du contenu
						echo $vignette;
					?>
				</div>
		  	</div>

			<div class="arrows">
				<div class="arrows-left">
					<!-- Post précédent en fonction de la date de publication ASC (comportement par defaut) -->
					<?php
					$previous_post = get_previous_post();
					// Si le post précédent existe, affichage du post précédent
					if (!empty($previous_post)) :
					?>
						<a href="<?php echo get_permalink($previous_post); ?>" class="arrow-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($previous_post->ID, 'thumbnail'); ?>">
							<img class="imgArrow-svg" src="<?php echo get_stylesheet_directory_uri() . '/images/fleche-gauche.svg' ?>" alt="Flèche direction Gauche" />
						</a>
					<!-- Si post précédent non-existant, affichage du dernier post publié -->
					<?php else :
						$last_post = $last_post->posts[0];
					?>
						<a href="<?php echo get_permalink($last_post); ?>" class="arrow-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($last_post->ID, 'thumbnail'); ?>">
							<img class="imgArrow-svg" src="<?php echo get_stylesheet_directory_uri() . '/images/fleche-gauche.svg' ?>" alt="Flèche direction Gauche" />
						</a>
					<?php endif; ?>
				</div>
				<div class="arrows-right">
					<!-- Récupération du post suivant par date de publication ASC (comportement naturel) -->
					<?php
					$next_post = get_next_post();
					// Si post suivant existant, affichage du post suivant
					if (!empty($next_post)) :
					?>
						<a href="<?php echo get_permalink($next_post); ?>" class="arrow-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($next_post->ID, 'thumbnail'); ?>">
							<img class="imgArrow-svg" src="<?php echo get_stylesheet_directory_uri() . '/images/fleche-droite.svg' ?>" alt="Flèche direction droite" />
						</a>
					<!-- Si post suivant non-existant, affichage du premier post publié -->
					<?php else :
						$first_post = $first_post->posts[0]; 
					?>
						<a href="<?php echo get_permalink($first_post); ?>" class="arrow-link" data-thumbnail="<?php echo get_the_post_thumbnail_url($first_post->ID, 'thumbnail'); ?>">
							<img class="imgArrow-svg" src="<?php echo get_stylesheet_directory_uri() . '/images/fleche-droite.svg' ?>" alt="Flèche direction droite"/>
						</a>
					<?php endif; ?>
				</div>
			</div>	
			<div class="thumbnail-preview" id="thumbnail-preview"></div>
		</div>
	</div>

	<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</section>


<!--  Z O N E  I N F E R I E U R E   -->
<!-- Photos apparentées -->
<section class="sectionInferieure">
	<h3 class="sectionInferieure-TitleH3">VOUS AIMERIEZ AUSSI</h3>
	<div class="sectionInferieure-MainDiv">
		<div class="sectionInferieure-Div">
			<?php
				//photo actuelle
				$categories = wp_get_post_terms(get_the_ID(), 'categoriesphotos');

				if ($categories && !is_wp_error($categories)) {
					$ID_categories = wp_list_pluck($categories, 'term_id');

					// Récupération de deux photos de la même catégorie aléatoirement, en excluant la photo affichée au dessus
					$photos_similaires = new WP_Query(array(
						'post_type' => 'photographies',
						'posts_per_page' => 2,
						'post__not_in' => array(get_the_ID()),
						'orderby' => 'rand',
						'tax_query' => array(
							array(
								'taxonomy' => 'categoriesphotos',
								'field' => 'id',
								'terms' => $ID_categories,
							),
						),
					));

					if ($photos_similaires->have_posts()) {
						while ($photos_similaires->have_posts()) {
							$photos_similaires->the_post();
                            // Affichage de la photo similaire gérée via un template part
							get_template_part('/template_part/block_photos');
						}
						wp_reset_postdata();
					} else {
						// Affichage d'un message si aucune photo similaire n'est trouvée dans la même catégorie
						echo "Aucune photo similaire pour le moment";
					}
				}
			?>
		</div>
	</div>
</section>

<?php
	get_footer();
?>

<?php
wp_footer();
?>
