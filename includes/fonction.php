<?php
function debug($mavar) {// la fonction avec son paramètre, une variable
  
var_dump($mavar);// à cette variable on applique le fonction var_dump()

}

 // FONCTION POUR EXÉCUTER LES REQUETES PRÉPARÉES
function executeRequete($requete, $parametres = array()) {  // utile pour toutes les requêtes 1 la requête 2 
    foreach ($parametres as $indice => $valeur) { // boucle foreach
        $parametres[$indice] = htmlspecialchars($valeur); // pour se prémunir des failles XSS
        global $pdoBLOG; // * global  "nous permet d'acceder à la variable $pdoBLOG dans l'espace global du fichier log_bdd.php"

        $resultat = $pdoBLOG->prepare($requete); //prepare la requete
        $succes = $resultat->execute($parametres); //et execute


        if ($succes === false ) { 
            return false; // si la requête n'a pas marché je renvoie "false"
        } else {
            return $resultat; // sinon je renvoie les resultats de la requête
        }// fin if else
    }// fin foreach
}// fin fonction

// function secureInput($secure) {
//     $secure = trim($secure);
//     $secure = stripslashes($secure);
//     // $secure = mysqli_real_escape_string($secure);

//     return $secure;

// }


// FONCTION POUR VÉRIFIER QUE LE MEMBRE EST CONNECTÉ
function estConnecte() {
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}


?>