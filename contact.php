<?php 
require_once "includes/bdd.php";
require_once "includes/fonction.php";
require_once "includes/header.php";


// TRAITEMENT DU FORMULAIRE DU CONTACT


if (!empty($_POST)) {

    if ( !isset($_POST['denomination']) || strlen($_POST['denomination']) < 2 || strlen($_POST['denomination']) > 40) {
        // !isset n'est pas isset, .= concaténation puis affectation, || ou, strlen string length longueur chainbe de caractère
        $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre dénomination doit faire entre 2 et 40 caractères</div>';
    }
    if ( !isset($_POST['objet']) || strlen($_POST['objet']) < 6 || strlen($_POST['objet']) > 25) {
        $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">l\'Objet doit faire entre 6 et 25 caractères </div>';
    }
  
    if ( !isset($_POST['mail']) || strlen($_POST['mail']) > 50 || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        // filter_var filtre une variable, et dans ce filtre on passe la constante prédéfinie (EN MAJUSCULE) qui vérifie que c'est bien au format email
        $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre email n\'est pas conforme</div>';
    }

    if ( !isset($_POST['message']) || strlen($_POST['message']) < 15 || strlen($_POST['message']) > 300 ) {
        // filter_var filtre une variable, et dans ce filtre on passe la constante prédéfinie (EN MAJUSCULE) qui vérifie que c'est bien au format email
        $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Votre message doit faire entre 15 et 300 caractères</div>';
    }

    // if ( check_token($_POST['g-recaptcha-response'], reCAPTCHAback) ) {
    //     // $confirmation .='<div class="fw-bolder text-center" style="background-color: #1abc9c; border-radius: 8px; margin: 10px; padding: 10px;">Validation ReCAPTCHA.</div>';
    // } else {
    //     $erreur .='<div class="fw-bolder text-center comments" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">ReCAPTCHA: Erreur relative à la sécurité, veuillez confirmer que vous n\'êtes pas un robot.</div>';
    // }

    
    if (empty($erreur)) {

    
    $_POST['denomination'] = htmlspecialchars($_POST['denomination']);
    $_POST['objet'] = htmlspecialchars($_POST['objet']);
    $_POST['mail'] = htmlspecialchars($_POST['mail']);
    $_POST['telephone'] = htmlspecialchars($_POST['telephone']);
    $_POST['message'] = htmlspecialchars($_POST['message']);


        // adapter la requete en fonction de la bdd
    $contact = executeRequete(" INSERT INTO php_blog WHERE contacts (denomination, objet, mail, telephone, message) VALUES (:denomination, :objet, :mail, :telephone, :message)",

    array(
    ':denomination' => $_POST['denomination'],
    ':objet' => $_POST['objet'],
    ':mail' => $_POST['mail'],
    ':telephone' => $_POST['telephone'],
    ':message' => $_POST['message'],
    ));

    } else {
        $confirmation .='<div class="fw-bolder text-center" style="background-color: #dc3545; border-radius: 8px; margin: 10px; padding: 10px;">Erreur lors de l\'envoi du message</div>';
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
                    <h2 class="title text-uppercase"><span class="line_double mx-auto color_default">contact</span>Entrez en contact</h2>
                    <span class="sub_title"></span>
                    <?php
                    //                        Show validation message
                    if (isset($error)) {
                        echo "<span style=\"color: red\"> $error</span>";
                    }
                    if (isset($msg)) {
                        echo "<span style=\"color: green\"> $msg</span>";
                    }
                    ?>
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
                                        <textarea class="form-control" name="message" rows="7" placeholder="Message"></textarea>
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
        </div>
    </div>
</section>
<!--	End Contact
===================================================-->

<?php include "includes/footer.php"; ?>