<?php

require_once "includes/bdd.php";
require_once "includes/fonction.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!--===== Meta Tag =====-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Runaway - Personal Portfolio HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="business, agency, blog, cv, creative, html, one page, personal, portfolio, resume, responsive, bootstrap, photography, designer, developer">
    <meta name="author" content="root">

    <!--	Css Links
   ==================================================-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon.css">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/color.css" id="color-change">

    <!-- Favicon
   ==================================================-->
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon.ico">

    <!--	Title
  ==================================================-->
    <title>PHP Blog</title>

</head>

<body id="top" class="page-load">
    <!--	Start Back to top
=================================================-->
    <a href="#" id="scroll" style="display: none;"><span></span></a>
    <!--    End Back to top
==================================================-->


    <!-- Wrapper Start
==================================================-->
    <div id="page_wrapper">
        <div class="row">
            <!-- Start Nav Menu
        ==============================================-->
            <header class="main_nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg navbar-light w-100">
                        <!--               For show blog title  & logo from database-->
                        <?php
                        $title = $pdoBLOG->query ( "SELECT * FROM title WHERE id='1'"); 
            
                        while($info = $title->fetch(PDO::FETCH_ASSOC)) {


                            echo "<a class=\"navbar-brand p_0\" href=\"index.php#top\"><img class=\"nav-logo\" src=\"admin/$info[logo]\" style=\"height: 50px; width: 60px;\" alt=\"logo\"> <span>$info[title]</span></a>";
                         }
                         ?>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                                <?php If(estConnecte()){ ?>
                                    <li class="nav-item"><a class="nav-link" href="../soutenancephp/admin/index.php">Espace Admin</a></li>  
                                <?php } else { ?>
                                <li class="nav-item"><a class="nav-link" href="../soutenancephp/admin/login.php">Connexion</a></li>    
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- End Nav Menu