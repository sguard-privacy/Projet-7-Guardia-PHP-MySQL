<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'includes/header.php';
require_once 'includes/sidebar.php';
require_once "../includes/phpmailer/Exception.php";
require_once "../includes/phpmailer/PHPMailer.php";
require_once "../includes/phpmailer/SMTP.php";

// Récupération du message par son ID
if ( isset($_GET['id'])) {

    $message = $pdoBLOG->prepare(" SELECT * FROM contact WHERE id AND id = :id ");
    $message->execute(array(
      ':id' => $_GET['id']
    ));
    // debug($annonce->rowCount());
  if ($message->rowCount() == 0) { // si le rowCount est égal à 0 c'est qu'il n'y a pas de message
    header('location:index.php');// redirection vers la page de départ
    exit();// arrêt du script
    }
    $reponse = $message->fetch(PDO::FETCH_ASSOC);//je passe les infos dans une variable

    } else {
    header('location:index.php');// si j'arrive sur la page sans rien dans l'url
    exit();// arrêt du script  
  }


// TRAITEMENT DU FORMULAIRE DU CONTACT

if (!empty($_POST)) {


            if ($_POST) {

                $mail = new PHPMailer(true);

                $mailmessage = $_POST['message'];
                $maildest = $_POST['email'];

                
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
                    $mail->addAddress($maildest);

                    // Expediteur
                    $mail->setFrom("soutenance@sleyter.net");

                    // Contenu du mail
                    $mail->Subject = "Une réponse à votre demande";
                    $mail->Body = "$mailmessage";

                    // envoi
                    $mail->send();

                    if ($mail) {
                        $confirmation .='<div class="alert alert-success">Votre Réponse a bien été envoyé.</div>  ';
                    } else {
                        $confirmation .='<div class="alert alert-danger">Erreur lors de l\'envoi du message !</div>';
                    }

            }        
   
}



?>
<div class="grid_10">

  <div class="box round first grid">
    <h2> Dashbord</h2>


<div class="container" style="padding-top: 50px;">
<section class="content inbox">
    <div class="container-fluid">       
        <div class="row clearfix">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <ul class="mail_list list-group list-unstyled">
                    <li class="list-group-item">
                        <div class="media">
                            <div class="media-body">
                                <div class="media-heading">
                                    <?php echo "<a href=\"mail-single.html\" class=\"m-r-10\">$reponse[subject]</a>" ?>
                                 <?php echo "<span class=\"badge bg-blue\">$reponse[name]</span>" ?>
                                </div>
                               <?php echo "<p class=\"msg\">$reponse[message]</p>" ?>
                            </div>
                            <div class="container px-5 my-5">
                                <form id="contactForm" method="POST">
                                    <div class="form-floating mb-3">
                                   <?php echo "<input class=\"form-control\" type=\"hidden\" value=\"$reponse[email]\" name=\"dest\"/>" ?>
                                        <textarea class="form-control" id="reponse" type="text" placeholder="Réponse" style="height: 10rem;" required></textarea>
                                        <label for="reponse">Réponse</label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button>
                                    </div>
                                </form>
                                <?php $confirmation; ?>
                            </div>
                        </div>
                    </li>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>
 </div>
    </div>
  </div>
</div>

<?php
require_once 'includes/footer.php';
?>