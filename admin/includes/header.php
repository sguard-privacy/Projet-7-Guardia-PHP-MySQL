<?php

require_once 'includes/bdd.php';
require_once 'includes/fonction.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

if (estconnecte()){
    $id = $_SESSION['user']['id'];
    // debug($_SESSION);
  }
  
  if (!estConnecte()) {
    header('location:login.php');
  }

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/php; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>

</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <!--               For show blog title  & logo from database-->
                <?php
                $title = $pdoBLOG->query("SELECT * FROM title WHERE id='1'");
                if ($title) {
                    while ($result = $title->fetch(PDO::FETCH_ASSOC)) {

                ?>
                        <div class="floatleft logo">
                            <img src="<?php echo $result['logo'] ?>" alt="Logo" />
                        </div>
                        <div class="floatleft middle">
                            <h1><?php echo $result['title'] ?></h1>
                            <p>Administrateur</p>
                        </div>
                <?php }
                } ?>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
                            session_destroy();
                        }
                        ?>
                        <ul class="inline-ul floatleft">
                            <li>Admin</li>
                         <?php echo  '<li><a href="' .RACINE_SITE. 'login.php?action=deconnexion">Déconnexion</a></li>'; ?>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Tableau de bord</span></a> </li>
                <!--            <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>-->
                <!--            <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>-->
                <li class="ic-grid-tables"><a href="inbox.php"><span>Boite de réception
                  <?php
                            //                count unseen messages
                         //    $message = $pdoBLOG->query("SELECT * FROM contact WHERE status ='0'");
                          //   if ($message) {
                              //   $count = mysqli_num_rows($message);
                              //   echo "(" . $count . ")";
                          //   } else {
                             //    "(0)";
                          //   }
                             ?>
                        </span> </a>
                </li>
                <li class="ic-charts"><a target="_blank" href="../index.php"><span>Visiter le site</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>