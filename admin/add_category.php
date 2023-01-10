<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Ajouter une nouvelle catégorie</h2>
        <div class="block copyblock">
            <?php
           if (!empty($_POST)) {
            // var_dump($_POST);
            $_POST['name'] = htmlspecialchars($_POST['name']);

         
            $insertion = executeRequete(" INSERT INTO category (name) VALUES (:name) ",
        
            array(
                ':name' => $_POST['name'],

             ));
        }
            ?>
            <form method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" required placeholder="Entrez le nom de la catégorie..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder" />
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