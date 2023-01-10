<?php
require_once 'includes/bdd.php';
require_once 'includes/fonction.php';
require_once 'includes/header.php';
require_once 'includes/sidebar.php';


// 3 RÉCEPTION DES INFORMATIONS D'UN EMPLOYÉ AVEC $_GET
// debug($_GET);
if ( isset($_GET['id']) ) {// on demande le détail
      // debug($_GET);
      $social = $pdoBLOG->prepare( " SELECT * FROM social WHERE 1  " );
      $social->execute(array(
        ':id' => $_GET['id']// on associe le marqueur vide
      ));

		$link = $social->fetch(PDO::FETCH_ASSOC);//je passe les infos dans une variable
		// debug($fiche);// ferme if isset accolade suivante

	}

//4 TRAITEMENT DE MISE À JOUR D'UN EMPLOYÉ
if ( !empty($_POST) ) {//not empty
    // debug($_POST);
    $_POST['facebook'] = htmlspecialchars($_POST['facebook']);// pour se prémunir des failles et des injections SQL
	$_POST['github'] = htmlspecialchars($_POST['github']);
	$_POST['skype'] = htmlspecialchars($_POST['skype']);
	$_POST['linkedin'] = htmlspecialchars($_POST['linkedin']);
	$_POST['google'] = htmlspecialchars($_POST['google']);


	$update = $pdoBLOG->prepare( " UPDATE social SET facebook = :facebook, github = :github, skype = :skype, linkedin = :linkedin, google = :google, WHERE id = :id" );// requete préparée avec des marqueurs

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

        <div class="block">
            <!--     For show social link from database-->

            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Facebook</label>
                        </td>
                        <td>
                            <input type="text" name="facebook" value="<?php echo $link['facebook']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Github</label>
                        </td>
                        <td>
                            <input type="text" name="github" value="<?php echo $link['github']; ?>" class=" medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Skype</label>
                        </td>
                        <td>
                            <input type="text" name="skype" value="<?php echo $link['skype']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>LinkedIn</label>
                        </td>
                        <td>
                            <input type="text" name="linkedin" value="<?php echo $link['linkedin']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Google </label>
                        </td>
                        <td>
                            <input type="text" name="google" value="<?php echo $link['google']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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