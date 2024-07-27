// Miniature Single Photo Hover
document.addEventListener('DOMContentLoaded', () => {
	const arrowLinks = document.querySelectorAll('.arrow-link');
	const vignettePrecedent = document.querySelector('.conteneur-vignette-precedent');
	const vignetteSuivant = document.querySelector('.conteneur-vignette-suivant');

	arrowLinks.forEach(link => {
		link.addEventListener('mouseenter', (event) => {
			const thumbnailUrl = event.target.closest('a').getAttribute('data-thumbnail');
			if (event.target.closest('.arrows-left')) {
				vignettePrecedent.style.backgroundImage = `url(${thumbnailUrl})`;
				vignettePrecedent.style.display = 'block';
			} else if (event.target.closest('.arrows-right')) {
				vignetteSuivant.style.backgroundImage = `url(${thumbnailUrl})`;
				vignetteSuivant.style.display = 'block';
			}
		});

		link.addEventListener('mouseleave', () => {
			vignettePrecedent.style.display = 'none';
			vignetteSuivant.style.display = 'none';
		});
	});
});
