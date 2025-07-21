// Animation d'apparition des avis (section "Avis")
document.addEventListener('DOMContentLoaded', () => {
    const testimonials = document.querySelectorAll('.avis-card');

    // Utilisation d'IntersectionObserver pour faire apparaître chaque avis en douceur
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    testimonials.forEach(card => {
        observer.observe(card);
    });
});