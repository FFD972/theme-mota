// Gestion de la modale de contact
document.addEventListener("DOMContentLoaded", function () { 
	const boutonContact = document.querySelector(".contactez-moi");
	const modale = document.querySelector(".modale");
	const boutonFermeture = document.querySelector(".modale__close");
	const conteneurModale = document.getElementById(".affichageModale");
	boutonContact.addEventListener("click", function() {
	    // Fermeture de la modale en cliquant sur : Contact
	    if (modale.style.display === "block") {
	        modale.style.display = "none";
	    }
	    else {
	        modale.style.display = "block";
	    }
	});

	// Fermeture de la modale au clic sur la croix
	boutonFermeture.addEventListener("click", function() {
	    modale.style.display = "none";
	});

});









// Modale avec la référence préremplie

document.addEventListener("DOMContentLoaded", function () {

    // Si on se trouve sur la page single-photographies.php seulement
    let urlActuelle = window.location.href;

    if (urlActuelle.match(/photographies/)) {
        const nav = document.querySelector("nav");
        const boutonContactPhoto = document.querySelector(".centraleLeft-btn");
        const modaleBis = document.querySelector(".modale");
        const refARemplir = document.querySelector(".wpcf7-form-control wpcf7-text"); // Assurez-vous que l'ID correspond à celui de l'input dans votre formulaire CF7
        const refADupliquer = document.getElementById("reference");

        boutonContactPhoto.addEventListener("click", function () {
            nav.classList.add("active");

            // Vérifiez si refADupliquer existe et a du contenu
            if (refADupliquer && refADupliquer.textContent.trim() !== "") {
                refARemplir.value = refADupliquer.textContent.trim();
            } else {
                console.error("La référence à dupliquer est introuvable ou vide.");
            }

            modaleBis.style.display = "block";
            window.scrollTo({
                top: 10,
                behavior: "smooth"
            });
        });
    }
});
