<?php
// includes/header.php
?>
<header class="admin-header">
  <div class="admin-logo-container">
    <img src="<?php echo $lienLogo; ?>GUEV_GREEN.jpg" alt="GUEV Admin" class="admin-logo">
    <span class="admin-title">ADMINISTRATION</span>
  </div>

  <button class="admin-menu-toggle" id="adminMenuToggle">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <nav class="admin-menu">
    <ul>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="/guev/administrateur/index.php">Dashboard</a></li>
        <li><a href="/guev/administrateur/produits/index.php">Produits</a></li>
        <li><a href="/guev/administrateur/articles/index.php">Articles</a></li>
        <li><a href="/guev/administrateur/commandes/index.php">Commandes</a></li>
        <li><a href="/guev/administrateur/utilisateurs/index.php">Utilisateurs</a></li>
        <li><a href="/guev/administrateur/avis/index.php">Avis</a></li>
        <li><a href="/guev/administrateur/discussion.php">Discussion</a></li>
        <li><a href="/guev/administrateur/parametres/index.php">Paramètres</a></li>
    </ul>
</nav>

   <div class="header-actions">
        <a href="/guev/deconnexion.php" class="logout-btn">Déconnexion</a>
    </div>
    
</header>

<script>
  // Script pour le menu mobile
  const adminMenuToggle = document.getElementById('adminMenuToggle');
  const adminNav = document.getElementById('adminNav');
  
  adminMenuToggle.addEventListener('click', () => {
    adminMenuToggle.classList.toggle('active');
    adminNav.classList.toggle('active');
  });
</script>

<style>
/* ===== HEADER ADMIN OPTIMISÉ ===== */
.admin-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.8rem 2rem;
  background: #fff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
  z-index: 100;
}

.admin-logo-container {
  display: flex;
  align-items: center;
  gap: 12px;
}

.admin-logo {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
}

.admin-title {
  font-size: 1.1rem;
  font-weight: 600;
  color: #2c3e50;
}

.admin-nav {
  display: flex;
  gap: 1.2rem;
}

.admin-nav a {
  color: #555;
  font-weight: 500;
  padding: 0.4rem 0;
  position: relative;
  font-size: 0.95rem;
}

.admin-nav a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #27ae60;
  transition: width 0.25s;
}

.admin-nav a:hover::after,
.admin-nav a.active::after {
  width: 100%;
}

.admin-actions {
  display: flex;
  gap: 0.8rem;
}

.admin-logout-btn {
  background: #27ae60;
  color: white;
  padding: 0.4rem 1.2rem;
  border-radius: 4px;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.admin-logout-btn:hover {
  background: #219653;
  transform: translateY(-1px);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
  .admin-header {
    padding: 0.8rem 1.5rem;
  }
}

@media (max-width: 768px) {
  .admin-header {
    flex-wrap: wrap;
    padding: 0.8rem 1rem;
    gap: 1rem;
  }
  
  .admin-nav {
    order: 3;
    width: 100%;
    display: none;
    flex-direction: column;
    gap: 0;
    margin-top: 0.5rem;
  }
  
  .admin-nav.active {
    display: flex;
  }
  
  .admin-nav a {
    padding: 0.8rem;
    border-bottom: 1px solid #eee;
  }
  
  .admin-menu-toggle {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 28px;
    height: 20px;
  }
  
  .admin-menu-toggle span {
    display: block;
    height: 2px;
    background: #333;
    transition: all 0.3s;
  }
  
  .admin-menu-toggle.active span:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
  }
  .admin-menu-toggle.active span:nth-child(2) {
    opacity: 0;
  }
  .admin-menu-toggle.active span:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
  }
}

@media (max-width: 480px) {
  .admin-logo {
    width: 36px;
    height: 36px;
  }
  
  .admin-title {
    font-size: 1rem;
  }
  
  .admin-logout-btn {
    padding: 0.4rem 1rem;
    font-size: 0.85rem;
  }
}
</style>