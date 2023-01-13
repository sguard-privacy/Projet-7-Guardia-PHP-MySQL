<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';

$requete = $pdoBLOG->query( " SELECT * FROM contact " );
// debug($resultat);
$contact = $requete->rowCount();
// debug($nbr_commentaires);



?>
<div class="grid_10">

  <div class="box round first grid">
    <h2> Dashbord</h2>
    <div class="block">
      <p>Bonjour Administrateur,<p>
      <p>Vous avez <?php echo $contact; ?> message.<p>
        <hr>


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
                                <?php while ( $message = $requete->fetch( PDO::FETCH_ASSOC )) { ?>
                                    <a href="mail-single.html" class="m-r-10"><?php echo $message['subject']; ?></a>
                                    <span class="badge bg-blue"><?php echo $message['name']; ?></span>
                                </div>
                                <p class="msg"><?php echo $message['message']; ?></p>
                            </div>
                            <div class="card-body">
                              <?php // echo"reponse.php?id=$message[id]"?>
                            </div>
                        </div>
                    </li>
                    <hr>
                    <?php } ?>
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