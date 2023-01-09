<?php
require_once '../includes/bdd.php';
require_once '../includes/fonction.php';

$message = '';
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si il existe action qui contient 'deconnexion' dans l'url
    unset($_SESSION['membre']); // on supprime le membre de la session (le contenu du tableau indice membre)
    $message = '<div class="alert alert-success">Vous êtes Déconnecté</div>';// message de déconnexion cf echo plus bas
    //debug($_SESSION);
}
// redirection vers la page admin
 if (estConnecte()) {
  header('location:index.php');
  exit();
}
// traitement du formulaire de connexion
debug($_POST);

if(!empty($_POST)) {
    if (empty($_POST['username'])) { //si c'est vide - 0 ou null c'est FALSE
        $contenu .='<div class="alert alert-danger">Le pseudo est requis !</div>';
    }
    if (empty($_POST['password'])) {
        $contenu .='<div class="alert alert-danger">Le mot de passe est manquant !</div>';
    }
    if (empty($contenu)) {
        $resultat = executeRequete("SELECT * FROM user WHERE username =:username ",
        array (
            ':username' => $_POST['username'],
            // ':mdp' => $_POST['mdp'],
        ));
    
        if ($resultat->rowCount() == 1) {
            $user = $resultat->fetch(PDO ::FETCH_ASSOC);
            // debug($membre);


            if (password_verify($_POST['password'], $user['password'])) {
                // echo 'coucou';
                $_SESSION['user'] = $user;

                // debug($_SESSION);
                header('location:index.php');//VOIR
                exit();
            } else {
              $contenu .='<div class="alert alert-danger">Erreur sur les identifiants !</div>';
            }
        } else {
          $contenu .='<div class="alert alert-danger">Erreur sur les identifiants !</div>';
        }
    }
}

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
            <form action="" method="post">
                <h1>Connexion Administrateur</h1>
                <div>
                    <input type="text" placeholder="Identifiant" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe"  name="password" />
                </div>
                <div>
                    <input type="submit" value="Se connecter" />
                </div>
                <?php debug($_SESSION); echo $message, $contenu ?>
            </form><!-- form -->
            <div class="button">
                <a href="#">Formation avec projet en direct</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>