<?php
// 1-Variables de connexion à la BDD
$host = 'localhost';// le chemin vers le serveur de données
$database = 'u643944377_blog';// le nom de la BDD
$user = 'u643944377_soutenance';// le nom d'utilisateur pour se connecter
$psw = 'Soutenance_GUARDIA92';// mdp PC XAMPP

// Retourne une instance de PDO. La signature de la fonction getInstancePDO implique que l'objet doit être nécessairement de type PDO
// Sinon une erreur sera levée
$pdoBLOG = new PDO('mysql:host='.$host.';dbname='.$database,$user,$psw,
array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,// pour afficher les warnings SQL dans le navigateur
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',// pour définir le charset des échanges avec la BDD
));
// 2- OUVERTURE DE SESSION
session_start();
// Informations de la session passées en variables




//3- CHEMIN DU SITE DANS UNE CONSTANTE
// ici on définit le chemin absolu dans une constante, on écrira tous les chemins src et href avec cette constante
// chez l'hébergeur on écrira ce qui suit
// define('RACINE_SITE', '/');
define('RACINE_SITE', '');


//4- UNE VARIABLE POUR LES MESSAGES
$contenu = '';
$confirmation = '';
$erreur = '';


require_once 'fonction.php';
?>