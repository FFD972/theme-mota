//_______  B O U T O N   C H A R G E R   P L U S  _______//

document.addEventListener('DOMContentLoaded', function() {

    // Ppremière page
    let page = 1;
    // Par défaut en ordre ascendant (croissant)
    let ordreTriage = 'ASC';

    // Sélection des éléments du DOM nécessaires
    const chargerPlusBouton = document.getElementById('divBouton-chargerplus'); // Bouton "Charger plus"
    const zoneLesPhotos = document.querySelector('.containerBlock-photos'); // Zone contenant les photos
    const blocLesPhotos = document.querySelector('.mainFrontPage'); // Bloc principal de la page
    const selectionTriDESC = document.getElementById('DESC'); // Tri descendant

    chargerPlusBouton.addEventListener('click', async function() {
        // Ordre de tri selon la sélection actuelle
        ordreTriage = selectionTriDESC.classList.contains('selectionne') ? 'DESC' : 'ASC';

        // Incrémentation chargement de la page suivante
        page++;

        // Création d'un objet pour envoyer la requête avec les paramètres nécessaires
        const data = new URLSearchParams();
        data.append('action', 'charger_plus'); // Action à effectuer
        data.append('page', page); // Numéro de la page à charger
        data.append('order', ordreTriage); // Ordre de tri
        // Ajout du nonce de sécurité pour la requête Ajax
        data.append('nonce', myAjax.nonce);

        // Envoi de la requête via fetch avec les paramètres spécifiés
        const reponse = await fetch(myAjax.ajaxurl, {
            method: 'POST',
            body: data,
        });

        if (reponse.ok) {
            // Extraction de la réponse sous forme de texte
            const responseData = await reponse.text();
            // Ajout du nouveau contenu HTML à la zone des photos
            zoneLesPhotos.insertAdjacentHTML('beforeend', responseData);

            // Parse (= analyse) la réponse HTML pour compter le nombre d'éléments 'figure'
            const parser = new DOMParser();
            const doc = parser.parseFromString(responseData, 'text/html');
            const figureCompte = doc.querySelectorAll('figure').length;

            // Si moins de 8 éléments ont été chargés, on cache le bouton "Charger plus"
            if (figureCompte < 8) {
                chargerPlusBouton.style.display = 'none';
            }

        }
    });
});
