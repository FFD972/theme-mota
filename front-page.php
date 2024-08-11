    <!--   P A G E   P R I N C I P A L E   -->
       
<?php
get_header();
?>
<!-- HERO -->
<div class="containerHero">
    <h1 class="titleH1">Photographe Event</h1>
    <div class="containerHero-images">
        <?php
        $args = array(
            'post_type' => 'photographies',
            'posts_per_page' => 1,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'formats',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
        );

        $photo_aleatoire_hero = new WP_Query($args);

        if ($photo_aleatoire_hero->have_posts()) {
            while ($photo_aleatoire_hero->have_posts()) {
                $photo_aleatoire_hero->the_post();
                the_post_thumbnail('full');
            }
            wp_reset_postdata();
        } else {
            echo 'Aucun post trouvé.';
        }
        ?>

    </div>

</div>

<!-- FILTRES-->
<div class="mainFrontPage">
    <div class="containerFiltres">
        <div class="containerFiltresGauche">
            <div class="containerFiltres-block">
                <!-- Déroulant "Catégories" -->
                <div class="menu-deroulant" id="categorie-titre">
                    <div class="menu-titre visible">Catégories</div>
                    <div class="menu-titre cache">Catégories</div>
                    <i class="fa-solid fa-chevron-down menu-fleche"></i>
                </div>
                <div class="menu-options" id="categorie-options">
                    <?php
                    echo '<div class="vide" id="categorie-vide"></div>';
                    $possibilites = get_terms('categoriesphotos');
                    if (!empty($possibilites) && !is_wp_error($possibilites)) {
                        foreach ($possibilites as $possibilite) {
                            echo '<div class="menu-option" id="' . esc_attr($possibilite->slug) . '">' . esc_html($possibilite->name) . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="containerFiltres-block">
                <!-- Déroulant "Formats" -->
                <div class="menu-deroulant" id="format-titre">
                    <div class="menu-titre visible">Formats</div>
                    <div class="menu-titre cache">Formats</div>
                    <i class="fa-solid fa-chevron-down menu-fleche"></i>
                </div>
                <div class="menu-options" id="format-options">
                    <?php
                    echo '<div class="vide" id="format-vide"></div>';
                    $termes = get_terms('formats');
                    if (!empty($termes) && !is_wp_error($termes)) {
                        foreach ($termes as $terme) {
                            echo '<div class="menu-option" id="' . esc_attr($terme->slug) . '">' . esc_html($terme->name) . '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="containerFiltresDroite">
            <div class="containerFiltres-block" id="filtre-tri">
                <!-- Déroulant "Trier par" -->
                <div class="menu-deroulant" id="tri-titre">
                    <div class="menu-titre visible">Trier par</div>
                    <div class="menu-titre cache">Trier par</div>
                    <i class="fa-solid fa-chevron-down menu-fleche"></i>
                </div>
                <div class="menu-options" id="tri-options">
                    <div class="vide" id="tri-vide"></div>
                    <div class="menu-option" id="ASC">A partir des plus récentes</div>
                    <div class="menu-option" id="DESC">A partir des plus anciennes</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Affichage des Photos -->
    <div class="containerBlock">
        <div class="containerBlock-photos">
            <?php
            $args = array(
                'post_type' => 'photographies',
                'posts_per_page' => 8,
                'orderby' => 'date',
                'order' => 'ASC',
                'paged' => 1,
            );

            $photo_query = new WP_Query($args);
            if ($photo_query->have_posts()) {
                while ($photo_query->have_posts()) {
                    $photo_query->the_post();
                    get_template_part('template_part/block_photos');
                }
                wp_reset_postdata();
            } else {
                echo 'Aucune photo trouvée.';
            }
            ?>
        </div>
    </div>
    <div class="divBouton">
        <button id="divBouton-chargerplus">Charger plus</button>
    </div>
</div>
<?php
get_footer();
?>