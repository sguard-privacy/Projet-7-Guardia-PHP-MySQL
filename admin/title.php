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

            if (!empty($_POST) ) {//not empty
                // debug($_POST);
                if ( !isset($_POST['title']) || strlen($_POST['title']) < 5 || strlen($_POST['title']) > 30) {
                    $contenu .='<div class="alert alert-warning">La Titre du site doit faire entre 5 et 30 caractères</div>';
                }

                if (empty($contenu)) {

                $_POST['title'] = htmlspecialchars($_POST['title']);// pour se prémunir des failles et des faille XSS
            
                $upload_name = $_FILES['logo']['name'];
                $upload_ext = substr($upload_name, strrpos($upload_name, '.') + 1);
                $upload_size = $_FILES['logo']['size'];
    
                if (($upload_ext == "jpg" || $upload_ext == "JPG" || $upload_ext == "jpeg" || $upload_ext == "JPEG" || $upload_ext == "png" || $upload_ext == "PNG") && ($upload_size < 1848567)) {
    
    
                    $logo = '';
                     if(!empty($_FILES['logo']['name'])) {
                        $logo = 'uploads/' .$_FILES['logo']['name'];
                        copy($_FILES['logo']['tmp_name'], '' .$logo);
                        } 
    
    
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $logo)) {
                        $erreur .='<div class="alert alert-warning">Seul les images au format jpeg, jpg, png et 1 Mo de taille sont autorisées</div>';
                    }
    
                }
    

                $resultat = $pdoBLOG->prepare( " UPDATE title SET title = :title, logo = :logo " );// requete préparée avec des marqueurs
            
                $resultat->execute( array(
                    ':title' => $_POST['title'],
                    ':logo' => $logo,
                ));

                if ($resultat) {
                    $confirmation .= '<div class="alert alert-success">Le titre et/ou logo ont été mise à jour</div>';
                } else {
                    $erreur .= '<div class="alert alert-danger">Erreur lors de la mise à jour...</div>';
                }
            }

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
                            echo "<label>Titre du site Web (entre 5 et 30 caractères)</label>";
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
                            echo "<input type=\"file\" name=\"logo\" />";
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
                <?php echo $confirmation, $contenu; ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php
require_once 'includes/footer.php';
?>