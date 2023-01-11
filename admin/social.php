<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';


//4 TRAITEMENT DE MISE À JOUR DES RESEAUX
if ( !empty($_POST) ) {//not empty
    // debug($_POST);

    if ( !isset($_POST['facebook']) || !filter_var($_POST['facebook'], FILTER_VALIDATE_URL) ){
        $contenu .='<div class="alert alert-warning">Il manque l\'url de facebook ou il n\'es pas conforme !</div>';
    }

    if ( !isset($_POST['github']) || !filter_var($_POST['github'], FILTER_VALIDATE_URL)) {
        $contenu .='<div class="alert alert-warning">Il manque l\'url de github ou il n\'es pas conforme !</div>';
    }

    if ( !isset($_POST['skype']) || !filter_var($_POST['skype'], FILTER_VALIDATE_URL)) {
        $contenu .='<div class="alert alert-warning">Il manque l\'url de skype ou il n\'es pas conforme !</div>';
    }

    if ( !isset($_POST['linkedin']) || !filter_var($_POST['linkedin'], FILTER_VALIDATE_URL)) {
        $contenu .='<div class="alert alert-warning">Il manque l\'url de linkedin ou il n\'es pas conforme !</div>';
    }

    if ( !isset($_POST['google']) || !filter_var($_POST['google'], FILTER_VALIDATE_URL)) {
        $contenu .='<div class="alert alert-warning">Il manque l\'url de google ou il n\'es pas conforme !</div>';
    }

    if (empty($contenu)) {

    $_POST['facebook'] = htmlspecialchars($_POST['facebook']); // pour se prémunir des failles et des failles XSS
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

    if ($update) {
        $confirmation .= '<div class="alert alert-success">Le ou les URL ont été mise à jour</div>';
    } else {
        $erreur .= '<div class="alert alert-danger">Erreur lors de la mise à jour...</div>';
    }
}
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

        <?php echo $contenu, $confirmation; ?>
        </div>
    </div>
</div>
<?php
require_once 'includes/footer.php';
?>