<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<?php
// 3 RÉCEPTION DES INFORMATIONS D'UN POST avec GET
// debug($_GET);
if ( isset($_GET['id']) ) {// on demande le détail du post
    // debug($_GET);
    $resultat = $pdoBLOG->prepare( " SELECT * FROM post WHERE id = :id" );
    $resultat->execute(array(
      ':id' => $_GET['id']// on associe le marqueur vide à l'id
    ));
    // debug($resultat->rowCount());
      if ($resultat->rowCount() == 0) { // si le rowCount est égal à 0 c'est qu'il n'y a pas de post
          header('location:post_list.php');// redirection vers la page de départ
          exit();// arrêt du script
      }  
      $post = $resultat->fetch(PDO::FETCH_ASSOC);//je passe les infos dans une variable
      // debug($fiche);// ferme if isset accolade suivante
      } else {
      header('location:post_list.php');// si j'arrive sur la page sans rien dans l'url
      exit();// arrête du script
  }

//4 TRAITEMENT DE MISE À JOUR D'UN POST
if ( !empty($_POST) ) {//not empty
  // debug($_POST);

  if ( !isset($_POST['title']) || strlen($_POST['title']) < 2 || strlen($_POST['title']) > 20) {
    $contenu .='<div class="alert alert-warning">Le Titre doit faire entre 2 et 20 caractères</div>';
    }

    if ( !isset($_POST['body']) || strlen($_POST['body']) < 20 || strlen($_POST['body']) > 1500) {
        $contenu .='<div class="alert alert-warning">Le message doit faire entre 20 et 1500 caractères</div>';
    }

    if ( !isset($_POST['author']) || strlen($_POST['author']) < 2 || strlen($_POST['author']) > 30) {
        $contenu .='<div class="alert alert-warning">L\'auteur doit faire entre 2 et 30 caractères</div>';
    }

    if ( !isset($_POST['tags']) || strlen($_POST['tags']) < 2 || strlen($_POST['tags']) > 15) {
        $contenu .='<div class="alert alert-warning">Le Tags doit faire entre 2 et 15 caractères</div>';
    }

if (empty($contenu)) {

  $_POST['title'] = htmlspecialchars($_POST['title']);
  $_POST['body'] = htmlspecialchars($_POST['body']);
  $_POST['author'] = htmlspecialchars($_POST['author']);
  $_POST['tags'] = htmlspecialchars($_POST['tags']);

  $upload_name = $_FILES['image']['name'];
  $upload_ext = substr($upload_name, strrpos($upload_name, '.') + 1);
  $upload_size = $_FILES['image']['size'];

  if (($upload_ext == "jpg" || $upload_ext == "JPG" || $upload_ext == "jpeg" || $upload_ext == "JPEG" || $upload_ext == "png" || $upload_ext == "PNG") && ($upload_size < 1848567)) {


      $image = '';
       if(!empty($_FILES['image']['name'])) {
          $image = 'uploads/' .$_FILES['image']['name'];
          copy($_FILES['image']['tmp_name'], '' .$image);
          } 


      if (!move_uploaded_file($_FILES['image']['tmp_name'], $image)) {
          $erreur .='<div class="alert alert-warning">Seul les images au format jpeg, jpg, png et 1 Mo de taille sont autorisées</div>';
      }

  }




  $resultat = $pdoBLOG->prepare( " UPDATE post SET title = :title, body = :body, author = :author, tags = :tags, image = :image WHERE id = :id " );// requete préparée avec des marqueurs

  $resultat->execute( array(
      ':title' => $_POST['title'],
      ':body' => $_POST['body'],
      ':author' => $_POST['author'],
      ':tags' => $_POST['tags'],
      ':image' => $image,
      ':id' => $_GET['id'],
  ));

  if ($resultat) {
    $confirmation .= '<div class="alert alert-success">Le Post a été mise à jour</div>';
    } else {
        $erreur .= '<div class="alert alert-danger">Erreur lors de la mise à jour</div>';
    }
}
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Ajouter un nouveau post</h2>

        <div class="block">
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
                                     $requete = $pdoBLOG->query( " SELECT * FROM category " );
                                     
                         
                                    while ( $select = $requete->fetch( PDO::FETCH_ASSOC )) {
                                ?>
                                 <option value="<?php echo $select['category_id']; ?>"><?php echo $select['name']; ?></option>
                                <?php   } ?>
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
                            <?php echo $confirmation, $contenu; ?>
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