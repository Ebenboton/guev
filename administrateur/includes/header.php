<?php
// includes/header.php
?>
<header class="admin-header">
  <div class="admin-logo-container">
    <img src="<?php echo $lienLogo; ?>GUEV_GREEN.jpg" alt="GUEV Admin" class="admin-logo">
    <span class="admin-title">ADMINISTRATION</span>
  </div>

  <button class="admin-menu-toggle" id="adminMenuToggle" aria-label="Menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="header-content" id="headerContent">
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
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('adminMenuToggle');
    const headerContent = document.getElementById('headerContent');
    
    toggleButton.addEventListener('click', function() {
      this.classList.toggle('active');
      headerContent.classList.toggle('active');
    });
  });
</script>

<style>
/* ===== HEADER ADMIN EXISTANT - SEUL LE RESPONSIVE EST MODIFIE ===== */
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

.admin-menu {
  display: flex;
  gap: 1.2rem;
}

.admin-menu a {
  color: #555;
  font-weight: 500;
  padding: 0.4rem 0;
  position: relative;
  font-size: 0.95rem;
}

.admin-menu a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: #27ae60;
  transition: width 0.25s;
}

.admin-menu a:hover::after,
.admin-menu a.active::after {
  width: 100%;
}

.header-actions {
  margin-left: 1rem;
}

.logout-btn {
  background: #27ae60;
  color: white;
  padding: 0.4rem 1.2rem;
  border-radius: 4px;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.logout-btn:hover {
  background: #219653;
  transform: translateY(-1px);
}

/* ===== NOUVEAU CODE RESPONSIVE SEULEMENT ===== */
.admin-menu-toggle {
  display: none;
  flex-direction: column;
  justify-content: space-between;
  width: 28px;
  height: 20px;
  background: transparent;
  border: none;
  cursor: pointer;
  padding: 0;
  z-index: 101;
}

.admin-menu-toggle span {
  display: block;
  height: 2px;
  width: 100%;
  background: #333;
  transition: all 0.3s;
}

.header-content {
  display: flex;
  align-items: center;
}

@media (max-width: 992px) {
  .admin-menu-toggle {
    display: flex;
  }
  
  .header-content {
    position: fixed;
    top: 68px; /* Hauteur du header */
    left: 0;
    width: 100%;
    background: #fff;
    flex-direction: column;
    align-items: flex-start;
    padding: 1rem 2rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    display: none;
  }
  
  .header-content.active {
    display: flex;
  }
  
  .admin-menu {
    flex-direction: column;
    width: 100%;
    gap: 0;
  }
  
  .admin-menu li {
    width: 100%;
    border-bottom: 1px solid #eee;
  }
  
  .admin-menu a {
    display: block;
    padding: 0.8rem 0;
  }
  
  .admin-menu a::after {
    display: none;
  }
  
  .header-actions {
    margin: 1rem 0 0 0;
    width: 100%;
  }
  
  .logout-btn {
    display: block;
    text-align: center;
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
</style>