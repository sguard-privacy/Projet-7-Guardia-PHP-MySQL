<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once "includes/header.php";
// require_once "includes/recaptcha.php";
require_once "includes/phpmailer/Exception.php";
require_once "includes/phpmailer/PHPMailer.php";
require_once "includes/phpmailer/SMTP.php";


// TRAITEMENT DU FORMULAIRE DU CONTACT

if (!empty($_POST)) {

    if (!isset($_POST['name']) || strlen($_POST['name']) < 2 || strlen($_POST['name']) > 40) {
        // !isset n'est pas isset, .= concaténation puis affectation, || ou, strlen string length longueur chainbe de caractère
        $erreur .= '<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre dénomination doit faire entre 2 et 40 caractères</div>';
    }
    if (!isset($_POST['subject']) || strlen($_POST['subject']) < 3 || strlen($_POST['subject']) > 25) {
        $erreur .= '<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">l\'Objet doit faire entre 3 et 25 caractères </div>';
    }

    if (!isset($_POST['email']) || strlen($_POST['email']) > 50 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        // filter_var filtre une variable, et dans ce filtre on passe la constante prédéfinie (EN MAJUSCULE) qui vérifie que c'est bien au format email
        $erreur .= '<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre email n\'est pas conforme</div>';
    }

    if (!isset($_POST['message']) || strlen($_POST['message']) < 15 || strlen($_POST['message']) > 3000) {
        // filter_var filtre une variable, et dans ce filtre on passe la constante prédéfinie (EN MAJUSCULE) qui vérifie que c'est bien au format email
        $erreur .= '<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre message doit faire entre 15 et 300 caractères</div>';
    }

        // if ( check_token($_POST['g-recaptcha-response'], reCAPTCHAback) ) {
        // $confirmation .='<div class="fw-bolder text-center" style="background-color: #1abc9c; border-radius: 8px; margin: 10px; padding: 10px;">Validation ReCAPTCHA.</div>';
        // } else {
        //     $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Vous êtes un robot</div>';
        // }



    if (empty($erreur)) {


        $_POST['name'] = htmlspecialchars($_POST['name']);
        $_POST['subject'] = htmlspecialchars($_POST['subject']);
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['message'] = htmlspecialchars($_POST['message']);


        // adapter la requete en fonction de la bdd
        $contact = executeRequete(" INSERT INTO  contact (name, subject, email, message) VALUES (:name, :subject, :email, :message)",

            array(
                ':name' => $_POST['name'],
                ':subject' => $_POST['subject'],
                ':email' => $_POST['email'],
                ':message' => $_POST['message'],
            ));


            if ($contact) {
                $confirmation .='<div class="alert alert-success">Votre Message a bien été envoyé, nous vous répondrons sous 48 heures</div>  ';
            } else {
                $confirmation .='<div class="alert alert-danger">Erreur lors de l\'envoi du message !</div>';
            }

            if ($contact) {

                $mail = new PHPMailer(true);
                $mailPOST = $_POST['email'];
                $namePOST = $_POST['name'];

                
                    // configuration 

                    // On configure le SMTP
                    // $mail->isSMTP();
                    $mail->Host = "smtp.hostinger.com";
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'soutenance@sleyter.net';
                    $mail->Password = 'Guardia92*';

                    // Encodage
                    $mail->CharSet = "utf-8";

                    // Destinataire
                    $mail->addAddress($mailPOST);

                    // Expediteur
                    $mail->setFrom("soutenance@sleyter.net");

                    // Contenu du mail
                    $mail->Subject = "Nous avons bien reçu votre message";
                    $mail->Body = "Cher(e) $namePOST,

                    Nous avons bien reçu votre message de contact via notre formulaire en ligne. Nous vous remercions de votre intérêt pour notre blog. Nous allons étudier votre message avec attention et nous reviendrons vers vous dès que possible. Si vous avez fourni des informations de contact, nous vous répondrons via ces moyens. Sinon, nous utiliserons l'adresse email que vous avez fournie sur le formulaire.

                    Si vous avez des questions urgentes ou si vous souhaitez nous fournir des informations supplémentaires, n'hésitez pas à nous contacter directement à l'adresse suivante : soutenance@sleyter.net.
                    Nous espérons avoir de vos nouvelles prochainement.        
                    Cordialement,";

                    // envoi
                    $mail->send();

            }        
   }
}
?>




<!--    Page Banner Start
==================================================-->
<section class="banner background9 overlay_three full_row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="banner_text text-center">
                    <h1 class="page_banner_title color_white text-uppercase">Blog</h1>
                    <div class="breadcrumbs m-auto d-inline-block">
                        <ul>
                            <li class="hover_gray"><a href="index.php">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    Page Banner End
==================================================-->

<!--	Start Contact
    ===================================================-->
<section id="contact" class="py_80 full_row bg_white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="section_title_1 text-center mx-auto pb_60 wow animated slideInUp">
                    <h2 class="title text-uppercase"><span
                            class="line_double mx-auto color_default">contact</span>Entrez en contact</h2>
                    <span class="sub_title"></span>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-md col-lg">
                        <form class="form contact_message wow animated fadeInRight" action="" method="POST">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="name" placeholder="Votre nom" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="subject" placeholder="Objet" />
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="7"
                                            placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input class="btn btn-default" value="Envoyer" type="submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php echo $confirmation, $erreur; ?>
        </div>
    </div>
</section>
<!--	End Contact
===================================================-->

<?php include "includes/footer.php"; ?>