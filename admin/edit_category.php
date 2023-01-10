<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<?php
// 3 RÉCEPTION DES INFORMATIONS D'UN EMPLOYÉ AVEC $_GET
// debug($_GET);
if ( isset($_GET['category_id']) ) {// on demande le détail d'un employé
    // debug($_GET);
    $resultat = $pdoBLOG->prepare( " SELECT * FROM category WHERE category_id = :category_id" );
    $resultat->execute(array(
      ':category_id' => $_GET['category_id']// on associe le marqueur vide à l'id_employes
    ));
    // debug($resultat->rowCount());
      if ($resultat->rowCount() == 0) { // si le rowCount est égal à 0 c'est qu'il n'y a pas d'employé
          header('location:category_list.php');// redirection vers la page de départ
          exit();// arrêtedu script
      }  
      $category = $resultat->fetch(PDO::FETCH_ASSOC);//je passe les infos dans une variable
      // debug($fiche);// ferme if isset accolade suivante
      } else {
      header('location:edit_category.php');// si j'arrive sur la page sans rien dans l'url
      exit();// arrête du script
  }

//4 TRAITEMENT DE MISE À JOUR D'UNE CATEGORY
if ( !empty($_POST) ) {//not empty
  // debug($_POST);
    $_POST['name'] = htmlspecialchars($_POST['name']);// pour se prémunir des failles et des injections SQL


  $resultat = $pdoBLOG->prepare( " UPDATE category SET name = :name WHERE category_id = :category_id " );// requete préparée avec des marqueurs

  $resultat->execute( array(
      ':name' => $_POST['name'],
      ':category_id' => $_GET['category_id'],
  ));
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <form method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $category['name']; ?>" class="medium" />
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