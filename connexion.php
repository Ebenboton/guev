
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - GUEV</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <style>
        /* Le formulaire d'inscription est caché par défaut */
        .signup-form {
            display: none;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="auth-section">
            <div class="container">
                <div class="auth-wrapper">
                    <!-- Formulaire de Connexion -->
                    <div class="login-form">
                        <h2>Connexion</h2>
                        <form action="config/traitement-connexion.php" method="POST">
                            <div class="form-group">
                                <label for="email_connexion">Email<i class="required" style="color: red;">*</i></label>
                                <input type="email" name="email" id="email_connexion" required>
                            </div>
                            <div class="form-group">
                                <label for="password_connexion">Mot de passe<i class="required" style="color: red;">*</i></label>
                                <input type="password" name="password" id="password_connexion" required>
                            </div>
                            <button type="submit" class="btn-submit">Se connecter</button>
                        </form>
                        <!-- Message pour inviter à l'inscription -->
                        <p class="toggle-signup">
                          Vous n'avez pas de compte ? 
                          <button id="toggleSignup" class="btn-submit">S'inscrire</button>
                        </p>
                    </div>

                    <!-- Formulaire d'Inscription placé juste en dessous -->
                    <div class="signup-form">
                        <h2>Inscription</h2>
                        <form action="config/traitement-inscription.php" method="POST">
                            <div class="form-group">
                                <label for="name_signup">Nom<i style="color:red;">*</i></label>
                                <input type="text" name="name" id="name_signup" required>
                            </div>
                            <div class="form-group">
                                <label for="email_signup">Email<i style="color:red;">*</i></label>
                                <input type="email" name="email" id="email_signup" required>
                            </div>
                            <div class="form-group">
                                <label for="password_signup">Mot de passe<i style="color:red;">*</i></label>
                                <input type="password" name="password" id="password_signup" required>
                            </div>
                            <button type="submit" class="btn-submit">S'inscrire</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script>
      // Lorsqu'on clique sur "S'inscrire", le formulaire d'inscription remplace le formulaire de connexion
      document.getElementById("toggleSignup").addEventListener("click", function(){
          const loginForm = document.querySelector(".login-form");
          const signupForm = document.querySelector(".signup-form");
          loginForm.style.display = "none";
          signupForm.style.display = "block";
          signupForm.scrollIntoView({ behavior: "smooth" });
      });
    </script>
</body>
</html>