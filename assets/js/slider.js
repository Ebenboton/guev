document.addEventListener('DOMContentLoaded', function(){
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.slider-control.prev');
    const nextBtn = document.querySelector('.slider-control.next');
    const dots = document.querySelectorAll('.slider-pagination .dot');
    let currentSlide = 0;
    const slideInterval = 5000; // intervalle en ms

    // Fonction d'animation sur une slide
    function animateSlide(slide) {
        // On suppose que chaque slide contient un élément .slide-image et un .slide-content
        const image = slide.querySelector('.slide-image');
        const content = slide.querySelector('.slide-content');
        if(image) {
            image.classList.add('slide-image-animate');
            setTimeout(() => {
                image.classList.remove('slide-image-animate');
            }, 1000);
        }
        if(content) {
            content.classList.add('slide-content-animate');
            setTimeout(() => {
                content.classList.remove('slide-content-animate');
            }, 1000);
        }
    }

    function showSlide(index){
        if(index >= slides.length) index = 0;
        if(index < 0) index = slides.length - 1;
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });
        currentSlide = index;
        animateSlide(slides[currentSlide]);
    }
    
    function nextSlide(){
        showSlide(currentSlide + 1);
    }
    
    function prevSlide(){
        showSlide(currentSlide - 1);
    }
    
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);
    
    dots.forEach((dot, i) => {
        dot.addEventListener('click', function(){
            showSlide(i);
        });
    });
    
    // Passage automatique des slides
    setInterval(nextSlide, slideInterval);
    
    // Animation initiale sur la première slide
    animateSlide(slides[currentSlide]);
});