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
        $_POST['title'] = htmlspecialchars($_POST['title']);
        $_POST['body'] = htmlspecialchars($_POST['body']);
        $_POST['author'] = htmlspecialchars($_POST['author']);
        $_POST['tags'] = htmlspecialchars($_POST['tags']);

    
        $image = '';
         if(!empty($_FILES['image']['name'])) {
            $image = 'uploads/' .$_FILES['image']['name'];
            copy($_FILES['image']['tmp_name'], '' .$image);
            } // fin du traitement photo
     
        $newpost = executeRequete(" INSERT INTO post (title, body, author, tags, category_id, image) VALUES (:title, :body, :author, :tags, :category_id, :image) ",
    
        array(
            ':title' => $_POST['title'],
            ':body' => $_POST['body'],
            ':author' => $_POST['author'],
            ':tags' => $_POST['tags'],
            ':category_id' => $_POST['category_id'],
            ':image' => $image,
         ));
    }
        ?>
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