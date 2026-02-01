# GUEV — Application Web (local XAMPP)

Description
- Projet PHP/MySQL pour la boutique GUEV (front + back minimal).

Prérequis
- XAMPP (Apache + MySQL) installé sur Windows
- PHP 8.x compatible

Installation rapide
1. Placez le dossier `guev` dans votre dossier hôte local (ex. `C:\xampp\htdocs\guev`).
2. Démarrez XAMPP (exécuter en Administrateur) et lancez `MySQL` et `Apache`.

Base de données
- Importez la base `guev` depuis le fichier SQL si nécessaire :
  - `guev.sql` (dump fourni)
- Si MySQL ne démarre pas, suivez la section « Dépannage MySQL » ci‑dessous.

Scripts utilitaires (dans `test/`)
- `test_db_connect.php` — teste la connexion MySQL (affiche `connected` ou l'erreur).
- `list_prod_images.php` — liste les produits et indique si le fichier image existe.
- `fix_missing_images.php` — met à jour certaines lignes `produits.image` vers un placeholder existant.

Problèmes courants et solutions
- Erreur de connexion MySQL (connection refused)
  1. Fermez XAMPP et redémarrez la machine.
  2. Avant de lancer XAMPP, vérifiez que le port 3306 n'est pas occupé :
     - `netstat -ano | findstr 3306`
     - `tasklist | findstr mysqld`
  3. Si le port est libre, lancez XAMPP en Administrateur et démarrez MySQL.
  4. Si MySQL refuse toujours, restaurer `C:\xampp\mysql\data` depuis `C:\xampp\mysql\backup` :
     - Renommez `data` → `data_old`
     - Copiez `backup` → `data`
     - Depuis `data_old`, récupérez uniquement vos schémas de bases d'utilisateur (ex. `guev`), pas les dossiers système (`mysql`, `performance_schema`).
  5. Consultez les dernières lignes du log : `C:\xampp\mysql\data\mysql_error.log`.

Images manquantes
- Les images produits sont servies depuis `assets/images/produits/`.
- Si des images sont manquantes, vous pouvez :
  - téléverser les fichiers manquants dans `assets/images/produits/`, ou
  - écrire un script pour remplacer `produits.image` par un placeholder (`cuisson.jpg` existe déjà).

Démarrer le projet localement
1. Assurez-vous que `Apache` et `MySQL` tournent dans XAMPP.
2. Ouvrez dans le navigateur : `http://localhost/guev/`

Notes de debugging réalisées
- Test de connexion réalisé avec `test_db_connect.php` — résultat : MySQL refusait la connexion initialement.
- Import du dump `guev.sql` et vérification des tables (création de `produits`).
- Détection d'images manquantes via `list_prod_images.php` et correction partielle avec `fix_missing_images.php`.


Fichier important
- `config/db.php` — configuration de la connexion (vérifie host/port/utilisateur/motdepasse).

