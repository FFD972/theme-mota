//_______  L I G H T B O X  _______//

document.addEventListener('DOMContentLoaded', function () {
    const lightbox = document.querySelector('.lightbox');
    const lightboxImage = document.querySelector('.lightbox-affichage img');
    const lightboxClose = document.querySelector('.lightbox-fermeture');
    const nextButton = document.querySelector('.suivante');
    const prevButton = document.querySelector('.precedente');
    let currentIndex = -1; // Initialisation de l'index courant pour la gestion des images

    // Fonction pour ajouter les événements de la lightbox aux images
    function addLightboxEvents() {
        // Sélection de toutes les photos
        const photos = document.querySelectorAll('.blockHover-fullscreen'); 
        photos.forEach((photo, index) => {
            // On supprime d'abord les anciens événements pour éviter les doublons
            photo.removeEventListener('click', handleLightboxClick);
            // On ajoute l'événement au clic pour ouvrir la lightbox avec l'image correspondante
            photo.addEventListener('click', handleLightboxClick);
        });
    }

    // Gestionnaire de clic sur une image pour afficher la lightbox
    function handleLightboxClick(event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        const photo = event.currentTarget; // Récupère l'élément qui a déclenché l'événement
        currentIndex = Array.from(document.querySelectorAll('.blockHover-fullscreen')).indexOf(photo);
        lightboxImage.src = photo.dataset.fullImage; // Met à jour la source de l'image de la lightbox
        // Met à jour la référence et la catégorie de la photo dans la lightbox
        lightbox.querySelector('.reference-photo').innerText = photo.closest('.blockPhoto').querySelector('.ref-img').innerText;
        lightbox.querySelector('.categorie-photo').innerText = photo.closest('.blockPhoto').querySelector('.ref-categories').innerText;
        lightbox.classList.add('visible'); // Affiche la lightbox
    }

    // Fermeture de la lightbox en cliquant sur X 
    lightboxClose.addEventListener('click', function () {
        lightbox.classList.remove('visible'); // Cache la lightbox
        lightboxImage.src = ''; // Réinitialise l'image affichée
    });

    // Bouton SUIVANT
    nextButton.addEventListener('click', function () {
        const photos = document.querySelectorAll('.blockHover-fullscreen');
        if (currentIndex < photos.length - 1) {
            currentIndex++; // Passage à l'image suivante
        } else {
            currentIndex = 0; // Revient à la première image si la dernière est atteinte
        }
        updateLightbox(); // Met à jour l'affichage de la lightbox avec la nouvelle image
    });

    // Bouton PRECEDENT
    prevButton.addEventListener('click', function () {
        const photos = document.querySelectorAll('.blockHover-fullscreen');
        if (currentIndex > 0) {
            currentIndex--; // Passage à l'image précédente
        } else {
            currentIndex = photos.length - 1; // Revient à la dernière image si la première est atteinte
        }
        updateLightbox(); // Met à jour l'affichage de la lightbox avec la nouvelle image
    });

    // Fonction pour mettre à jour l'image et les détails dans la lightbox
    function updateLightbox() {
        const photos = document.querySelectorAll('.blockHover-fullscreen');
        const newPhoto = photos[currentIndex]; // Récupère la nouvelle image à afficher
        lightboxImage.src = newPhoto.dataset.fullImage; // Met à jour la source de l'image dans la lightbox
        // Met à jour la référence et la catégorie de la nouvelle photo dans la lightbox
        lightbox.querySelector('.reference-photo').innerText = newPhoto.closest('.blockPhoto').querySelector('.ref-img').innerText;
        lightbox.querySelector('.categorie-photo').innerText = newPhoto.closest('.blockPhoto').querySelector('.ref-categories').innerText;
    }

    // Recharge les événements après le chargement de nouvelles images
    function reloadEventsAfterLoadMore() {
        const loadMoreButton = document.querySelector('#divBouton-chargerplus');
        if (loadMoreButton) {
            loadMoreButton.addEventListener('click', function () {
                // Remplacez ce setTimeout par le code de chargement AJAX réel
                setTimeout(function () {
                    addLightboxEvents(); // Réapplique les événements de la lightbox aux nouvelles images
                }, 1000); // Délai simulé pour le chargement des photos
            });
        }
    }

    // Fonction pour recharger les événements après l'application d'un filtre
    function reloadEventsAfterFilter() {
        const filterButtons = document.querySelectorAll('.filter-button');
        filterButtons.forEach(button => {
            button.addEventListener('click', function () {
                setTimeout(function () {
                    addLightboxEvents(); // Réapplique les événements de la lightbox après filtrage
                }, 1000); // Ajustez ce délai si nécessaire
            });
        });
    }

    addLightboxEvents(); // Applique les événements de la lightbox aux images présentes au chargement
    reloadEventsAfterLoadMore(); // Prépare la réinitialisation des événements après chargement de plus d'images
    reloadEventsAfterFilter(); // Prépare la réinitialisation des événements après l'application d'un filtre
});
