document.addEventListener('DOMContentLoaded', function(){
    // Animation d'apparition pour chaque article à l'aide d'IntersectionObserver
    const articles = document.querySelectorAll('.article-card');
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if(entry.isIntersecting){
                entry.target.classList.add('visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    
    articles.forEach(article => {
        observer.observe(article);
    });
});