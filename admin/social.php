<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';


// 3 RÉCEPTION DES INFORMATIONS D'UN EMPLOYÉ AVEC $_GET
// debug($_GET);


//4 TRAITEMENT DE MISE À JOUR D'UN EMPLOYÉ
if ( !empty($_POST) ) {//not empty
    // debug($_POST);
    $_POST['facebook'] = htmlspecialchars($_POST['facebook']);// pour se prémunir des failles et des injections SQL
	$_POST['github'] = htmlspecialchars($_POST['github']);
	$_POST['skype'] = htmlspecialchars($_POST['skype']);
	$_POST['linkedin'] = htmlspecialchars($_POST['linkedin']);
	$_POST['google'] = htmlspecialchars($_POST['google']);


	$update = $pdoBLOG->prepare( " UPDATE social SET facebook = :facebook, github = :github, skype = :skype, linkedin = :linkedin, google = :google " );// requete préparée avec des marqueurs

	$update->execute( array(
		':facebook' => $_POST['facebook'],
        ':github' => $_POST['github'],
        ':skype' => $_POST['skype'],
        ':linkedin' => $_POST['linkedin'],
        ':google' => $_POST['google'],


	));

}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Mettre à jour les médias sociaux</h2>
        <!--   For update social media -->
                        <?php
            $social = $pdoBLOG->query ( "SELECT * FROM social WHERE id");

            while($link = $social->fetch(PDO::FETCH_ASSOC)) {


            echo "<form action=\"\" method=\"POST\">";
            echo "<table class=\"form\">";
                echo "<tr>";
                    echo "<td>";

                            echo "<label>Facebook</label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type=\"text\" name=\"facebook\" value=\"$link[facebook]\" class=\"medium\" />";
                            echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "<label>Github</label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type=\"text\" name=\"github\" value=\"$link[github]\" class=\" medium\" />";
                            echo "</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td>";
                            echo "<label>Skype</label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type=\"text\" name=\"skype\" value=\"$link[skype]\" class=\"medium\" />";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td>";
                            echo "<label>LinkedIn</label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type=\"text\" name=\"linkedin\" value=\"$link[linkedin]\" class=\"medium\" />";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td>";
                            echo "<label>Google </label>";
                            echo "</td>";
                            echo "<td>";
                            echo "<input type=\"text\" name=\"google\" value=\"$link[google]\" class=\"medium\" />";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td>";
                            echo "<input type=\"submit\" name=\"submit\" Value=\"Modifier\" />";
                            echo "</td>";
                            echo "</tr>";
                            echo "</table>";
                        echo "</form>";
                    }
                    ?>


        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>