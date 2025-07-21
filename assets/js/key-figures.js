// Animation du compteur pour la section "Notre Impact en Chiffres"
document.addEventListener('DOMContentLoaded', () => {
    const figures = document.querySelectorAll('.figure-card .number');

    const animateCounter = (element) => {
        const target = +element.getAttribute('data-count');
        let count = 0;
        const increment = target / 200; // ajuste la vitesse de l'animation

        const updateCount = () => {
            count += increment;
            if (count < target) {
                element.textContent = Math.floor(count);
                requestAnimationFrame(updateCount);
            } else {
                element.textContent = target;
            }
        };
        updateCount();
    };

    // Utilisation d'IntersectionObserver pour lancer l'animation quand la section est visible
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    figures.forEach(el => {
        observer.observe(el);
    });
});