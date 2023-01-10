<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre à jour le texte du droit d'auteur</h2>
        <!--   For update copyright media -->
        <?php
   $footer = $pdoBLOG->query ( "SELECT * FROM footer WHERE id");

   while($copyright = $footer->fetch(PDO::FETCH_ASSOC)) {

                   echo "<p>Le footer actuel : $copyright[copyright]</p>";
           }
           ?>          

        <div class="block copyblock">
            <!--    For show social link from database-->
            <?php
            // Récupérer le copyright de la table footer
            // Tant que le copyright est récupéré
            //     Afficher le copyright
            ?>
            <form action="" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" value="" name="copyright" class="large" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Modifier" />
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