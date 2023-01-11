<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<?php
// 3 RÉCEPTION DES INFORMATIONS D'UN EMPLOYÉ AVEC $_GET
// debug($_GET);
if ( isset($_GET['id']) ) {// on demande le détail d'un employé
    // debug($_GET);
    $resultat = $pdoBLOG->prepare( " SELECT * FROM post WHERE id = :id" );
    $resultat->execute(array(
      ':id' => $_GET['id']// on associe le marqueur vide à l'id_employes
    ));
    // debug($resultat->rowCount());
      if ($resultat->rowCount() == 0) { // si le rowCount est égal à 0 c'est qu'il n'y a pas d'employé
          header('location:post_list.php');// redirection vers la page de départ
          exit();// arrêt du script
      }  
      $post = $resultat->fetch(PDO::FETCH_ASSOC);//je passe les infos dans une variable
      // debug($fiche);// ferme if isset accolade suivante
      } else {
      header('location:post_list.php');// si j'arrive sur la page sans rien dans l'url
      exit();// arrête du script
  }

//4 TRAITEMENT DE MISE À JOUR D'UNE CATEGORY
if ( !empty($_POST) ) {//not empty
  // debug($_POST);
  $_POST['title'] = htmlspecialchars($_POST['title']);
  $_POST['body'] = htmlspecialchars($_POST['body']);
  $_POST['author'] = htmlspecialchars($_POST['author']);
  $_POST['tags'] = htmlspecialchars($_POST['tags']);

  $image = '';
  if(!empty($_FILES['image']['name'])) {
     $image = 'uploads/' .$_FILES['image']['name'];
     copy($_FILES['image']['tmp_name'], '' .$image);
     } // fin du traitement photo



  $resultat = $pdoBLOG->prepare( " UPDATE post SET title = :title, body = :body, author = :author, tags = :tags, image = :image WHERE id = :id " );// requete préparée avec des marqueurs

  $resultat->execute( array(
      ':title' => $_POST['title'],
      ':body' => $_POST['body'],
      ':author' => $_POST['author'],
      ':tags' => $_POST['tags'],
      ':image' => $image,
      ':id' => $_GET['id'],
  ));
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Ajouter un nouveau post</h2>

        <div class="block">
            <?php
            // Récupérer le post de la table post
            // Tant que le post est récupéré
            //     Afficher les valeurs de title, category_id, author, tags, body et image dans les champs correspondants
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $post['title']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Categories</label>
                        </td>
                        <td>
                            <select id="select" name="category_id">
                                <option>Selectionner une catégorie</option>
                                <?php
                                // Récupérer les catégories de la table category
                                // Tant que les catégories sont récupérées
                                //     Afficher les catégories dans la liste déroulante
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Télécharger une image</label>
                        </td>
                        <td>
                            <img src="<?php echo $post['image']; ?>" height="60px" width="100px" alt="">
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom de l'auteur</label>
                        </td>
                        <td>
                            <input type="text" name="author" value="<?php echo $post['author']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" value="<?php echo $post['tags']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Contenu</label>
                        </td>
                        <td>
                            <textarea class="" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php
require_once 'includes/footer.php';
?>