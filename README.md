# Projet GUEV

Description
-----------
GUEV est une boutique e-commerce PHP/MySQL développée pour fonctionner localement avec XAMPP. Le projet inclut les pages produits, panier, gestion des commandes, compte utilisateur et une interface d'administration.

Fonctionnalités principales
---------------------------
- Catalogue de produits et pages individuelles (`produit.php`, `boutique.php`)
- Gestion du panier (`panier.php`, `add-to-cart.php`)
- Authentification et gestion de compte (`connexion.php`, `compte.php`)
- Pages administrateur pour gérer produits, commandes et utilisateurs
- Génération / téléchargement de factures (`facture.php`, `download-facture.php`)

Technologies
------------
- PHP 7/8
- MySQL / MariaDB
- HTML, CSS, JavaScript
- (Optionnel) Composer pour dépendances PHP

Prérequis
---------
- XAMPP (Apache + PHP + MySQL)
- Navigateur web

Installation locale
-------------------
1. Installer XAMPP et démarrer Apache et MySQL.
2. Copier le dossier du projet dans le répertoire `htdocs` (ex: `C:\xampp\htdocs\guev`).
3. Importer la base de données :

```bash
# depuis le dossier contenant guev.sql ou via phpMyAdmin
mysql -u root -p < guev.sql
```

4. Configurer la connexion à la base de données : modifier `config/db.php` si nécessaire (hôte, utilisateur, mot de passe, nom de la base).
5. Ouvrir le projet dans le navigateur : `http://localhost/guev`.

Structure du projet
-------------------
- `index.php` : Page d'accueil
- `boutique.php`, `produit.php` : Listing et page produit
- `panier.php`, `ajax/add-to-cart.php` : Gestion du panier
- `compte.php`, `connexion.php` : Gestion utilisateur
- `administrateur/` : Interface d'administration
- `config/` : Fichiers de configuration (`db.php`, `functions.php`)
- `assets/`, `css/`, `images/` : Ressources statiques

```

Contribuer
----------
- Ouvrir une issue pour proposer des améliorations ou signaler des bugs.
- Soumettre une pull request décrivant les changements.


Contact
-------
Pour toute question ou support, contacter le mainteneur du projet.
