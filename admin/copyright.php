<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre à jour le texte du droit d'auteur</h2>
        <!--   For update copyright media -->
        <?php

if ( !empty($_POST) ) {//not empty
    // debug($_POST);

    if ( !isset($_POST['copyright']) || strlen($_POST['copyright']) < 5 || strlen($_POST['copyright']) > 30) {
        $contenu .='<div class="alert alert-warning">La Copyright du site doit faire entre 5 et 30 caractères</div>';
    }

    if (empty($contenu)) {

      $_POST['copyright'] = htmlspecialchars($_POST['copyright']);// pour se prémunir des failles et des failles XSS
  
  
    $update = $pdoBLOG->prepare( " UPDATE footer SET copyright = :copyright WHERE id" );// requete préparée avec des marqueurs
  
    $update->execute( array(
        ':copyright' => $_POST['copyright'],

    ));


    if ($update) {
        $confirmation .= '<div class="alert alert-success">Le copyright a été mise à jour </div>';
    } else {
        $erreur .= '<div class="alert alert-danger">Erreur lors de la mise à jour...</div>';
    }
  }
}
   $footer = $pdoBLOG->query ( "SELECT * FROM footer WHERE id");

   while($copyright = $footer->fetch(PDO::FETCH_ASSOC)) {

                   echo "<p>Le footer actuel : $copyright[copyright]</p>";
           }
           ?>          

        <div class="block copyblock">
            <!--    For show social link from database-->
            <p>Pour la mise à jour, le copyright doit faire entre 5 et 30 caractères</p>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="" name="copyright" class="large" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Modifier" />
                            <?php echo $contenu, $confirmation; ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>