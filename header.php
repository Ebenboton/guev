<?php
//session_start();

?>
<header class="header">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="header-container">
        <a href="index.php" class="logo-link">
            <div class="logo-container">
                <img src="assets/images/GUEV_GREEN.jpg" alt="Logo GUEV" class="logo">
                <h1>GUEV</h1>
            </div>
        </a>
        
        <!-- Bouton hamburger -->
        <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
            <span class="hamburger"></span>
            <span class="hamburger"></span>
            <span class="hamburger"></span>
        </button>
        
        <nav class="main-nav">
            <ul>
                <?php
                // Récupère le nom de la page actuelle
                $current_page = basename($_SERVER['PHP_SELF']);
                // Liste des pages qui doivent activer l'onglet Blog
                $blog_pages = ['blog.php', 'article.php', 'categorie-blog.php'];
                ?>
                
                <li><a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Accueil</a></li>
                <li><a href="boutique.php" class="<?= ($current_page == 'boutique.php') ? 'active' : '' ?>">Nos produits</a></li>
                <li><a href="apropos.php" class="<?= ($current_page == 'apropos.php') ? 'active' : '' ?>">À propos</a></li>
                <li><a href="contact.php" class="<?= ($current_page == 'contact.php') ? 'active' : '' ?>">Contact</a></li>
                <li><a href="blog.php" class="<?= (in_array($current_page, $blog_pages)) ? 'active' : '' ?>">Blog</a></li>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <li><a href="/guev/administrateur/index.php" class="<?= (strpos($_SERVER['REQUEST_URI'], '/guev/administrateur/') !== false) ? 'active' : '' ?>">Dashboard</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        
        <div class="user-actions">
            <?php if(isset($_SESSION['user'])): ?>
                <a href="compte.php" class="login-btn">Mon compte</a>
            <?php else: ?>
                <a href="connexion.php" class="login-btn">Connexion</a>
            <?php endif; ?>
            <a href="panier.php" class="cart-btn">
                <i class="fas fa-shopping-cart"></i>
                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                    <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</header>

<style>
/* Variables CSS pour une maintenance facile */
:root {
    --primary-color: #2c3e50;
    --secondary-color: #27ae60;
    --text-color: #333;
    --light-text: #fff;
    --hover-color: #1abc9c;
    --transition-speed: 0.3s;
    --shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    --header-height: 80px;
}

/* Reset et styles de base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.header {
    background-color: var(--light-text);
    box-shadow: var(--shadow);
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    height: var(--header-height);
    display: flex;
    align-items: center;
}

.header-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Logo */
.logo-link {
    text-decoration: none;
    display: flex;
    align-items: center;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    height: 50px;
    width: auto;
    transition: transform var(--transition-speed);
}

.logo-container h1 {
    color: var(--primary-color);
    font-size: 1.8rem;
    font-weight: 700;
    transition: color var(--transition-speed);
}

.logo-link:hover .logo {
    transform: scale(1.05);
}

.logo-link:hover h1 {
    color: var(--secondary-color);
}

/* Navigation principale */
.main-nav ul {
    display: flex;
    list-style: none;
    gap: 25px;
}

.main-nav a {
    color: var(--text-color);
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    position: relative;
    padding: 5px 0;
    transition: color var(--transition-speed);
}

.main-nav a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--secondary-color);
    transition: width var(--transition-speed);
}

.main-nav a:hover,
.main-nav a.active {
    color: var(--secondary-color);
}

.main-nav a:hover::after,
.main-nav a.active::after {
    width: 100%;
}

/* Actions utilisateur */
.user-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.login-btn, .cart-btn {
    padding: 8px 15px;
    border-radius: 4px;
    font-weight: 500;
    transition: all var(--transition-speed);
    display: flex;
    align-items: center;
    gap: 5px;
}

.login-btn {
    color: var(--primary-color);
    border: 1px solid var(--primary-color);
}

.login-btn:hover {
    background-color: var(--primary-color);
    color: var(--light-text);
}

.cart-btn {
    position: relative;
    color: var(--light-text);
    background-color: var(--secondary-color);
    border: none;
}

.cart-btn:hover {
    background-color: var(--hover-color);
    transform: translateY(-2px);
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background-color: var(--primary-color);
    color: var(--light-text);
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: bold;
}

/* Menu hamburger - masqué par défaut sur desktop */
.menu-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    padding: 10px;
    z-index: 1001;
}

.hamburger {
    display: block;
    width: 25px;
    height: 3px;
    background-color: var(--primary-color);
    margin: 5px 0;
    transition: all var(--transition-speed);
}

/* Styles responsives */
@media (max-width: 992px) {
    .header-container {
        padding: 0 15px;
    }
    
    .main-nav {
        position: fixed;
        top: var(--header-height);
        left: -100%;
        width: 80%;
        max-width: 300px;
        height: calc(100vh - var(--header-height));
        background-color: var(--light-text);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transition: left var(--transition-speed);
        z-index: 999;
    }
    
    .main-nav.active {
        left: 0;
    }
    
    .main-nav ul {
        flex-direction: column;
        padding: 20px;
        gap: 15px;
    }
    
    .main-nav a {
        padding: 10px 0;
        display: block;
    }
    
    .menu-toggle {
        display: block;
    }
    
    .menu-toggle.active .hamburger:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }
    
    .menu-toggle.active .hamburger:nth-child(2) {
        opacity: 0;
    }
    
    .menu-toggle.active .hamburger:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -6px);
    }
}

@media (max-width: 768px) {
    .header {
        height: 70px;
    }
    
    .logo {
        height: 40px;
    }
    
    .logo-container h1 {
        font-size: 1.5rem;
    }
    
    .user-actions {
        gap: 10px;
    }
    
    .login-btn, .cart-btn {
        padding: 6px 12px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .logo-container h1 {
        display: none;
    }
    
    .login-btn span {
        display: none;
    }
    
    .login-btn::before {
        content: "\f007";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
    }
    
    .cart-btn span {
        display: none;
    }
}
</style>

<script>
// Script amélioré pour gérer le menu hamburger et l'accessibilité
document.querySelector('.menu-toggle').addEventListener('click', function() {
    const isExpanded = this.getAttribute('aria-expanded') === 'true';
    this.setAttribute('aria-expanded', !isExpanded);
    this.classList.toggle('active');
    document.querySelector('.main-nav').classList.toggle('active');
    
    // Bloquer le défilement lorsque le menu est ouvert
    document.body.style.overflow = isExpanded ? 'auto' : 'hidden';
});

// Fermer le menu lorsqu'un lien est cliqué (sur mobile)
document.querySelectorAll('.main-nav a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 992) {
            document.querySelector('.menu-toggle').click();
        }
    });
});
</script>