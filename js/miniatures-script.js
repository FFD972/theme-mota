//_______  M I N I A T U R E  _______//
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne tous les éléments
    const arrowLinks = document.querySelectorAll('.arrow-link');
    
    // Sélectionne les conteneurs
    const vignettePrecedente = document.querySelector('.conteneur-vignette-precedent');
    const vignetteSuivante = document.querySelector('.conteneur-vignette-suivant');

    // Ajoute un événement 'mouseenter' à chaque survole de lien (flèche)
    arrowLinks.forEach(link => {
        link.addEventListener('mouseenter', (event) => {
            //URL de la miniature
            const thumbnailUrl = link.getAttribute('data-thumbnail');

            // Vérifie si l'élément cible est dans la section gauche ou droite
            if (link.closest('.arrows-left')) {
                // Affichage de la vignette précédente 
                vignettePrecedente.style.backgroundImage = `url(${thumbnailUrl})`;
                vignettePrecedente.style.display = 'block';
            } else if (link.closest('.arrows-right')) {
                // Affichage de la vignette suivante
                vignetteSuivante.style.backgroundImage = `url(${thumbnailUrl})`;
                vignetteSuivante.style.display = 'block';
            }
        });

        // 'mouseleave' Cacher les vignettes lorsque la souris quitte le lien (flèches)
        link.addEventListener('mouseleave', () => {
            vignettePrecedente.style.display = 'none';
            vignetteSuivante.style.display = 'none';
        });
    });
});
