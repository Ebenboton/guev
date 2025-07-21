// Gestion de l'ajout au panier
function setupCart() {
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    
    function updateCartCount(count) {
        let cartCount = document.querySelector('.cart-count');
        if (!cartCount) {
            cartCount = document.createElement('span');
            cartCount.className = 'cart-count';
            document.querySelector('.cart-btn').appendChild(cartCount);
        }
        cartCount.textContent = count;
        cartCount.style.display = count > 0 ? 'flex' : 'none';
    }
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            
            // Animation feedback
            this.innerHTML = '<i class="fas fa-check"></i> Ajouté';
            this.classList.add('added');
            
            fetch('ajax/add-to-cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'product_id=' + productId
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) updateCartCount(data.cartCount);
            })
            .catch(error => console.error('Error:', error));
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-shopping-cart"></i> Ajouter';
                this.classList.remove('added');
            }, 2000);
        });
    });
}

// Slider Hero Bannière
function setupSlider() {
    const slides = document.querySelectorAll('.slide');
    if (!slides.length) return;
    
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    let currentIndex = 0;
    let intervalId;
    const slideInterval = 5000;
    
    function showSlide(index) {
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        currentIndex = index;
    }
    
    function nextSlide() {
        showSlide((currentIndex + 1) % slides.length);
    }
    
    function prevSlide() {
        showSlide((currentIndex - 1 + slides.length) % slides.length);
    }
    
    function startAutoPlay() {
        intervalId = setInterval(nextSlide, slideInterval);
    }
    
    function stopAutoPlay() {
        clearInterval(intervalId);
    }
    
    if (nextBtn) nextBtn.addEventListener('click', () => {
        nextSlide();
        stopAutoPlay();
        startAutoPlay();
    });
    
    if (prevBtn) prevBtn.addEventListener('click', () => {
        prevSlide();
        stopAutoPlay();
        startAutoPlay();
    });
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
            stopAutoPlay();
            startAutoPlay();
        });
    });
    
    const sliderContainer = document.querySelector('.slider-container');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', stopAutoPlay);
        sliderContainer.addEventListener('mouseleave', startAutoPlay);
    }
    
    showSlide(0);
    startAutoPlay();
}

// Animation pour les chiffres clés
function setupCounterAnimation() {
    function animateNumbers() {
        document.querySelectorAll('.number').forEach(element => {
            const target = parseInt(element.getAttribute('data-count'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;
            
            const interval = setInterval(() => {
                current += step;
                element.textContent = Math.floor(current);
                if (current >= target) clearInterval(interval);
            }, 16);
        });
    }
    
    const keyFiguresSection = document.querySelector('.key-figures');
    if (keyFiguresSection) {
        new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animateNumbers();
            }
        }, { threshold: 0.5 }).observe(keyFiguresSection);
    }
}

// Animation au scroll pour les articles
function setupArticleAnimations() {
    const articles = document.querySelectorAll('.article-card');
    if (!articles.length) return;
    
    articles.forEach(article => {
        article.style.opacity = '0';
        article.style.transform = 'translateY(20px)';
        article.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    });
    
    const articleObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });
    
    articles.forEach(article => articleObserver.observe(article));
}

// Gestion du formulaire d'avis
function setupReviewForm() {
    const avisForm = document.getElementById('avisForm');
    if (!avisForm) return;
    
    avisForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetch(this.action, {
            method: this.method,
            body: new FormData(this)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.style.display = 'none';
                document.getElementById('thankYouMessage').style.display = 'block';
            }
        })
        .catch(error => console.error('Error:', error));
    });
}

// Gestion du défilement des partenaires
function setupPartnersSlider() {
    const track = document.querySelector('.partners-track');
    const partners = document.querySelectorAll('.partner-card');
    if (!track || !partners.length) return;
    
    const nextBtn = document.querySelector('.next-partner');
    const prevBtn = document.querySelector('.prev-partner');
    const partnerWidth = partners[0].offsetWidth + 30;
    let currentPosition = 0;
    const maxPosition = -((partners.length - 3) * partnerWidth);
    
    function updateButtons() {
        if (prevBtn) prevBtn.disabled = currentPosition >= 0;
        if (nextBtn) nextBtn.disabled = currentPosition <= maxPosition;
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (currentPosition > maxPosition) {
                currentPosition -= partnerWidth;
                track.style.transform = `translateX(${currentPosition}px)`;
                updateButtons();
            }
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            if (currentPosition < 0) {
                currentPosition += partnerWidth;
                track.style.transform = `translateX(${currentPosition}px)`;
                updateButtons();
            }
        });
    }
    
    let autoSlide = setInterval(() => {
        if (currentPosition <= maxPosition) currentPosition = 0;
        else currentPosition -= partnerWidth;
        track.style.transform = `translateX(${currentPosition}px)`;
        updateButtons();
    }, 4000);
    
    track.addEventListener('mouseenter', () => clearInterval(autoSlide));
    track.addEventListener('mouseleave', () => {
        autoSlide = setInterval(() => {
            if (currentPosition <= maxPosition) currentPosition = 0;
            else currentPosition -= partnerWidth;
            track.style.transform = `translateX(${currentPosition}px)`;
            updateButtons();
        }, 4000);
    });
    
    updateButtons();
}

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    setupCart();
    setupSlider();
    setupCounterAnimation();
    setupArticleAnimations();
    setupReviewForm();
    setupPartnersSlider();
    
    // Gestion alternative du panier
    const addToCartForm = document.getElementById('addToCartForm');
    if (addToCartForm) {
        addToCartForm.addEventListener('submit', function(e) {
            e.preventDefault();
            fetch('panier.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) alert('Produit ajouté au panier');
                else alert('Erreur : ' + data.message);
            })
            .catch(error => console.error('Error:', error));
        });
    }
});