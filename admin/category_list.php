<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
              $requete = $pdoBLOG->query( " SELECT * FROM category " );
            //   debug($requete);
            //   $nbr_category = $requete->rowCount();
            //   debug($nbr_produits); 
            

              while ( $category = $requete->fetch( PDO::FETCH_ASSOC )) { ?>
              
              <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>N. De série</th>
                        <th>Nom Catégorie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                // 6 SUPPRESSION D'UNE CATEGORY
                // debug($_GET);
                if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['category_id'])) {
                $supprimer = $pdoBLOG->prepare( " DELETE FROM category WHERE category_id = :category_id " );

                $supprimer->execute(array(
                    ':category_id' => $_GET['category_id']
                ));

                if ($supprimer->rowCount() == 0) {
                    $contenu .= '<div class="alert alert-danger"> Erreur de suppression</div>';
                } else {
                    $contenu .= '<div class="alert alert-success"> Membre supprimé</div>';
                }
                }

                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $category['category_id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td><a href="edit_category.php?category_id=<?php echo $category['category_id']; ?>">Modifier</a>
                            <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer?')" href="?action=supprimer&category_id=<?php echo $category['category_id']; ?>">Supprimer</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
                <!-- fermeture de la boucle -->
            <?php   }
            ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>

<?php
require_once 'includes/footer.php';
?>