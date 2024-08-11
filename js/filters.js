//_______  F I L T R E S  _______// 

document.addEventListener("DOMContentLoaded", function() {
    // Fonction pour gérer l'ouverture et la fermeture d'un menu déroulant
    function gererMenuDeroulant(menuId, optionsId) {
        const menu = document.getElementById(menuId);
        const options = document.getElementById(optionsId);

        // Si les éléments n'existent pas, arrêter la fonction
        if (!menu || !options) return;
        const fleche = menu.querySelector(".menu-fleche");
        const blocCache = menu.querySelector(".cache");
        const blocVisible = menu.querySelector(".visible");

        // Ouverture/fermeture du menu au clic sur les flèches
        fleche.addEventListener("click", function() {
            const estOuvert = options.style.display === "block";
            if (estOuvert) {
                fermerMenu(options, menu, fleche, blocCache, blocVisible);
            } else {
                ouvrirMenu(options, menu, fleche, blocCache, blocVisible);
            }
        });

        // Fermer le menu si l'utilisateur clique en dehors
        document.addEventListener("click", function(event) {
            if (!menu.contains(event.target) && options.style.display === "block") {
                fermerMenu(options, menu, fleche, blocCache, blocVisible);
            }
        });
    }

    // Ouverture
    function ouvrirMenu(options, menu, fleche, blocCache, blocVisible) {
        options.style.display = "block";
        menu.classList.add("menu-ouvert");
        fleche.classList.add("rotation");
        options.classList.add("apparition");
        blocCache.style.display = "block";
        blocVisible.style.display = "none";
    }

    // Fermeture
    function fermerMenu(options, menu, fleche, blocCache, blocVisible) {
        options.style.display = "none";
        menu.classList.remove("menu-ouvert");
        fleche.classList.remove("rotation");
        options.classList.remove("apparition");
        blocCache.style.display = "none";
        blocVisible.style.display = "block";
    }

    // Initialiser les menus déroulants 
    ["categorie", "format", "tri"].forEach(id => {
        gererMenuDeroulant(`${id}-titre`, `${id}-options`);
    });

    // Gérer la sélection d'une option dans un menu déroulant
    function gererChoixOption(titreId, optionsId, titreAModifier) {
        const options = document.getElementById(optionsId);
        if (!options) return;

        const choixPossibles = options.querySelectorAll(".menu-option");
        choixPossibles.forEach((option, index) => {
            // Ajouter une classe spéciale au dernier élément
            if (index === choixPossibles.length - 1) option.classList.add("dernier");

            option.addEventListener("click", function() {
                // Mettre à jour le titre du menu déroulant avec l'option sélectionnée
                titreAModifier.textContent = option.textContent;

                // Réinitialiser toutes les options
                choixPossibles.forEach(choix => {
                    choix.classList.remove("selectionne", "dernier-selectionne");
                });

                // Marquer l'option sélectionnée
                option.classList.add("selectionne");
                if (index === choixPossibles.length - 1) option.classList.add("dernier-selectionne");

                // Fermer le menu après la sélection
                fermerMenu(options, option.closest(".menu-deroulant"), option.closest(".menu-deroulant").querySelector(".menu-fleche"), option.closest(".menu-deroulant").querySelector(".cache"), option.closest(".menu-deroulant").querySelector(".visible"));
            });
        });
    }

    // Initialiser les gestionnaires de choix d'options pour chaque menu
    const titresZones = {
        "categorie": document.querySelector("#categorie-titre .menu-titre"),
        "format": document.querySelector("#format-titre .menu-titre"),
        "tri": document.querySelector("#tri-titre .menu-titre")
    };

    Object.keys(titresZones).forEach(id => {
        gererChoixOption(`${id}-titre`, `${id}-options`, titresZones[id]);
    });

    // Variables pour suivre l'état actuel des filtres
    let categorieChangee = 'all';
    let formatChange = 'all';
    let triChange = 'ASC';

    // Fonction pour ajouter un écouteur d'événement aux options de filtres
    function ajouterEcouteurOptions(elements, typeChange) {
        elements.forEach(element => {
            element.addEventListener("click", function() {
                // Mettre à jour l'état des filtres selon le type
                if (typeChange === 'categorie') categorieChangee = element.id;
                if (typeChange === 'format') formatChange = element.id;
                if (typeChange === 'tri') triChange = element.id;

                // Mettre à jour l'affichage des photos avec les filtres sélectionnés
                miseAJourPhotos(categorieChangee, formatChange, triChange);
            });
        });
    }

    // Options des menus
    const elementsCategorie = document.querySelectorAll("#categorie-options .menu-option");
    const elementsFormat = document.querySelectorAll("#format-options .menu-option");
    const elementsTri = document.querySelectorAll("#tri-options .menu-option");

    ajouterEcouteurOptions(elementsCategorie, 'categorie');
    ajouterEcouteurOptions(elementsFormat, 'format');
    ajouterEcouteurOptions(elementsTri, 'tri');

    // Mise à jour des photos selon les filtres
    function miseAJourPhotos(category, format, order) {
        jQuery.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: {
                action: 'filtrer_photos',
                category: category,
                format: format,
                order: order,
                nonce: myAjax.nonce
            },
            success: function(response) {
                // Mise à jour du contenu de la zone des photos
                document.querySelector(".containerBlock-photos").innerHTML = response;

                // Vérifier si le bouton "Charger plus" doit être affiché
                surveillerChargerPlus();
                
                // Réinitialiser les événements du lightbox
                addLightboxEvents();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Vérifier si le bouton "Charger plus" doit être affiché
    function surveillerChargerPlus() {
        const nombrePhotos = document.querySelectorAll('.containerBlock-photos .blockPhoto').length;
        const chargerPlusBouton = document.getElementById("divBouton-chargerplus");
        chargerPlusBouton.style.display = nombrePhotos < 8 ? "none" : "block";
    }

    // Ajouter les événements pour la lightbox (agrandissement d'image)
    function addLightboxEvents() {
        const lightbox = document.querySelector('.lightbox');
        const lightboxImage = document.querySelector('.lightbox-affichage img');
        const photos = document.querySelectorAll('.blockHover-fullscreen');
        let currentIndex = -1;

        // Ouverture de la lightbox lorsque au click
        photos.forEach((photo, index) => {
            photo.addEventListener('click', function(event) {
                event.preventDefault();
                currentIndex = index;
                lightboxImage.src = photo.dataset.fullImage;
                lightbox.classList.add('visible');
            });
        });

        // Fermeture de la lightbox
        document.querySelector('.lightbox-fermeture').addEventListener('click', function() {
            lightbox.classList.remove('visible');
            lightboxImage.src = '';
        });

        // Photo suivante
        document.querySelector('.suivante').addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % photos.length;
            updateLightbox();
        });

        // Photo précédente
        document.querySelector('.precedente').addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + photos.length) % photos.length;
            updateLightbox();
        });

        // Mise à jour de l'affichage de la lightbox avec la nouvelle photo
        function updateLightbox() {
            const newPhoto = photos[currentIndex];
            lightboxImage.src = newPhoto.dataset.fullImage;
        }
    }

    addLightboxEvents();
});
