<?php
// Inclure le fichier Session.php depuis le dossier classes
// Inclure la session et le checkLogin

?>
<?php
// Inclure le fichier config.php depuis le dossier config
// Inclure le fichier Database.php depuis le dossier db
// Inclure le fichier format.php depuis le dossier classes
?>

<?php
// Inclure la variable $db = new Database();
// Inclure la variable $format = new Format();
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <?php
            // Si la méthode de requête est POST
            // Alors
            //     Récupérer la valeur de username
            //     Récupérer la valeur de password
            //     Récupérer les données de la table user
            //     Tant que les données sont récupérées
            //         Récupérer la valeur de username et password
            //         Si username et password sont égaux aux valeurs récupérées
            //             Alors
            //                 Définir la session login
            //                 Définir la session username
            //                 Définir la session userid
            //                 Rediriger vers index.php
            //         Sinon
            //             Afficher un message d'erreur
            //     Sinon
            //         Afficher un message d'erreur
            ?>
            <form action="" method="post">
                <h1>Connexion Administrateur</h1>
                <div>
                    <input type="text" placeholder="Identifiant" required="" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe" required="" name="password" />
                </div>
                <div>
                    <input type="submit" value="Se connecter" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="#">Formation avec projet en direct</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>