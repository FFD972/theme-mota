//_______  M E N U   B U R G E R  _______//

document.addEventListener("DOMContentLoaded", function () {
    const navBurgerMenu = document.querySelector(".burgerBouton");
    
    // Sélectionner l'élément <nav> du DOM, qui représente la barre de navigation
    const nav = document.querySelector("nav");

    // Fonction pour changer l'icône du bouton en fonction de l'état du menu
    function toggleIcon(element, imageName) {
        // Récupérer le chemin de base de l'image actuelle (jusqu'au dernier /)
        let basePath = element.src.substring(0, element.src.lastIndexOf("/") + 1);
        // Changer la source de l'image en ajoutant le nom de la nouvelle image au chemin de base
        element.src = basePath + imageName; 
    }

    // Ajouter un gestionnaire d'événements qui s'exécute lorsqu'on clique sur le bouton du menu "burger"
    navBurgerMenu.addEventListener("click", function () {
        // Vérifier si la navigation est actuellement affichée
        if (nav.style.display === "flex") {
            // Si elle est affichée, la masquer
            nav.style.display = "none";
            // Changer l'icône du bouton en icône "burger"
            toggleIcon(navBurgerMenu, "icone-burger.png"); 
        } else {
            // Si elle est masquée, l'afficher
            nav.style.display = "flex";
            // Changer l'icône du bouton en icône "close"
            toggleIcon(navBurgerMenu, "close.png");
        }
    });
});
