document.addEventListener('DOMContentLoaded', function(){
    // Ajout d'effets au survol des cartes produits
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function(){
            card.classList.add('hovered');
        });
        card.addEventListener('mouseleave', function(){
            card.classList.remove('hovered');
        });
    });
});