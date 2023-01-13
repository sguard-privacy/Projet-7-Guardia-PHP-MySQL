<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Ajouter un nouveau post</h2>
        <?php
       if (!empty($_POST)) {
        // var_dump($_POST);

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

        


     
        $newpost = executeRequete(" INSERT INTO post (title, body, author, tags, category_id, image) VALUES (:title, :body, :author, :tags, :category_id, :image) ",
    
        array(
            ':title' => $_POST['title'],
            ':body' => $_POST['body'],
            ':author' => $_POST['author'],
            ':tags' => $_POST['tags'],
            ':category_id' => $_POST['category_id'],
            ':image' => $image,
         ));

         if ($newpost) {
            $confirmation .= '<div class="alert alert-success">Le Post a été publier sur le site</div>';
        } else {
            $erreur .= '<div class="alert alert-danger">Erreur lors de la publication</div>';
        }
    }
}       ?>
        <div class="block">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" placeholder="Entrez le titre du post" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                        <select id="select" name="category_id">
                                <option>Select Category </option>
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
                            <label>Télecharger une image</label>
                        </td>
                        <td>
                            <input type="file" name="image" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Nom de l'auteur</label>
                        </td>
                        <td>
                            <input type="text" name="author" placeholder="Entrez le nom de l'auteur." />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Tags</label>
                        </td>
                        <td>
                            <input type="text" name="tags" placeholder="Entrez le tag ici ..." />
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder" />
                            <?php echo $confirmation, $contenu, $erreur; ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<?php
require_once 'includes/footer.php';
?>