<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<style>
    .left {
        float: left;
        width: 60%;
    }

    .right {
        float: left;
        width: 40%;
    }

    .right img {
        height: 140px;
        width: 150px;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre à jour le titre et la description du site</h2>
        <!--            For Update website Title & Logo-->
        <?php

            if ( !empty($_POST) ) {//not empty
                // debug($_POST);
                $_POST['title'] = htmlspecialchars($_POST['title']);// pour se prémunir des failles et des injections SQL
            
                $logo = '';
                if(!empty($_FILES['logo']['name'])) {
                   $logo = 'uploads/' .$_FILES['logo']['name'];
                   copy($_FILES['logo']['tmp_name'], '' .$logo);
                   } // fin du traitement photo

                $resultat = $pdoBLOG->prepare( " UPDATE title SET title = :title, logo = :logo " );// requete préparée avec des marqueurs
            
                $resultat->execute( array(
                    ':title' => $_POST['title'],
                    ':logo' => $logo,
                ));
            }

        ?>


        <!--               For show blog title  & logo from database-->
        <div class="block sloginblock">
            <div class="left">
            <?php
            $title = $pdoBLOG->query ( "SELECT * FROM title");
            while($update = $title->fetch(PDO::FETCH_ASSOC)) {

                echo "<form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">";
                echo "<table class=\"form\">";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Titre du site Web</label>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"text\" value=\"$update[title]\" name=\"title\" class=\"medium\" />";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Télécharger le logo</label>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"file\" name=\"logo\" accept=\"image/png, image/jpeg\"/>";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"submit\" name=\"submit\" Value=\"Modifier\" />";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            echo "</form>";
        echo "</div>";
            echo "<div class=\"right\">";
                echo "<img src=\"$update[logo]\" alt=\"logo\">";
            echo "</div>";

            }
                ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php
require_once 'includes/footer.php';
?>