<?php 
//format du mail("adresse@domaine.extension","Sujet du message ou objet","message")

$destinataire = "ggonzalez@guardiaschool.fr";
$objet = "test";
$message = "ceci est un message";
$headers = "Content-Type: text/plain; charset=utf-8\r\n";
$headers .= "From: jtencule@guardiaschool.fr\r\n";

if ( function_exists( 'mail' ) )                    // On vérifie si la fonction mail() peut-être appelée
    echo "La fonction mail() est dispo, va être utilisée.\n";
else
    echo "mail() est indispo, vérifiez le code.\n";

if (mail($destinataire, $objet, $message,$headers)) // si la fonction mail est éxecutée ou non
    echo "Le mail est envoyé !";
else 
    echo "Problème d'envoi du mail";
?>