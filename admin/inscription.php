<?php
require_once '../includes/bdd.php';
require_once '../includes/fonction.php';

// debug($_SESSION);
if ( !empty($_POST) ) {

     
              $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //bcrypt


    
              $succes = executeRequete( " INSERT INTO user (username, password) VALUES (:username, :password) ",
              array(
                  ':username' => $_POST['username'],
                  ':password' => $password,
              ));
              if ($succes) {
                $contenu .='<div class="alert alert-success">Préparer vous au combat, vous êtes inscrit sur Call of Duty Black Ops 3 ! <br>   <a href="login.php">Cliquez ici pour vous connecter</a></div>  ';


            } else {
                $contenu .='<div class="alert alert-danger">Erreur lors de l\'inscription !</div>';
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
                <h1>Inscription Administrateur</h1>
                <div>
                    <input type="text" placeholder="Identifiant" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="Mot de passe"  name="password" />
                </div>
                <div>
                    <input type="submit" value="S'inscire" />
                </div>
                <?php echo $message, $contenu ?>
            </form><!-- form -->
            <div class="button">
                <a href="#">Formation avec projet en direct</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>