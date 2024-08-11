document.addEventListener("DOMContentLoaded", function() {
    var openButton = document.querySelector('.contactez-moi');
    var btnContactPhoto = document.querySelector('.centraleLeft-btn'); 
    var closeButton = document.querySelector('.modale__close'); 
    var modale = document.getElementById('divModale'); 
    var overlay = document.getElementById('modaleOverlay'); 
    var refARemplir = document.querySelector('input[name="your-photo"]'); // Champ input pour la référence photo
    var refADupliquer = document.getElementById('reference'); // Élément contenant la référence à dupliquer

    // Ouverture
    function showModale() {
        if (modale && overlay) {
            modale.style.display = 'flex';
            overlay.style.display = 'block'; 
        }
    }

    // Fermeture
    function closeModale() {
        if (modale && overlay) { 
            modale.style.display = 'none';
            overlay.style.display = 'none';
        }
    }

    // Ouverture avec la référence
    function openModaleWithReference() {
        if (refADupliquer && refADupliquer.textContent.trim() !== "") { // Vérifie si l'élément existe et n'est pas vide
            refARemplir.value = refADupliquer.textContent.trim(); // Remplit le champ avec le texte de l'élément
        }

        showModale(); // Fait défiler la page jusqu'au haut de la page avec un effet "smooth"
        window.scrollTo({ top: 10, behavior: "smooth" }); 
    }

    // Ecouteurs d'événements avec vérification de l'existence
    if (openButton) { // Ouverture de la modale en cliquant sur "Contact" de la nav
        openButton.addEventListener('click', showModale); 
    }

    if (btnContactPhoto) {  // Ouverture avec référence en cliquant sur le bouton photo
        btnContactPhoto.addEventListener('click', openModaleWithReference); 
    }

    if (closeButton) {  // Fermeture en cliquant sur la croix
        closeButton.addEventListener('click', closeModale); 
    }

    if (overlay) {  // Fermeture en cliquant sur l'overlay
        overlay.addEventListener('click', closeModale); 
    }
});
