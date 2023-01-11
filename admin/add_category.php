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

            if ( !isset($_POST['name']) || strlen($_POST['name']) < 2 || strlen($_POST['name']) > 20) {
                $contenu .='<div class="alert alert-warning">La Catégorie doit faire entre 2 et 20 caractères</div>';
            }

            if (empty($contenu)) {

            $_POST['name'] = htmlspecialchars($_POST['name']);

         
            $insertion = executeRequete(" INSERT INTO category (name) VALUES (:name) ",
        
            array(
                ':name' => $_POST['name'],

             ));

            if ($insertion) {
                $confirmation .= '<div class="alert alert-success">La catégorie a été ajouter </div>';
            } else {
                $erreur .= '<div class="alert alert-danger">Erreur lors de l\'insertion...</div>';
            }
        }
    }
            ?>
            <form method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Nom de la catégorie (entre 2 et 20 caractères)" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Sauvegarder" />
                            <?php echo $contenu, $confirmation, $erreur; ?>
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