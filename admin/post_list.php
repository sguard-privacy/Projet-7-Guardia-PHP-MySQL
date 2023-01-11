<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">SL No</th>
                        <th width="13%">Titre du post</th>
                        <th width="25%">Description</th>
                        <th width="10%">Categorie</th>
                        <th width="10%">Image</th>
                        <th width="10%">Autheur</th>
                        <th width="5%">Tags</th>
                        <th width="10%">Date</th>
                        <th width="12%"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     // debug($_GET);
                if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id'])) {
                    $supprimer = $pdoBLOG->prepare( " DELETE FROM post WHERE id = :id " );
    
                    $supprimer->execute(array(
                        ':id' => $_GET['id']
                    ));
    
                    if ($supprimer->rowCount() == 0) {
                        $contenu .= '<div class="alert alert-danger"> Erreur de suppression</div>';
                    } else {
                        $contenu .= '<div class="alert alert-success"> POST supprimé</div>';
                    }
                    }

                      $select = $pdoBLOG->query( " SELECT * FROM post " );
                      
          
                        while ( $post = $select->fetch( PDO::FETCH_ASSOC )) { ?>
                    
                    <tr class="odd gradeX">
                        <td><?php echo $post['id']; ?></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['body']; ?></td>
                        <td></td>
                        <td><img src="<?php echo $post['image']; ?>" height="40px" width="80px" alt="photos du post"></td>
                        <td><?php echo $post['author']; ?></td>
                        <td><?php echo $post['tags']; ?></td>
                        <td><?php echo $post['date']; ?></td>
                        <td><a href="edit_post.php?id=<?php echo $post['id']; ?>">Modifier</a>
                            || <a onclick="return confirm('Êtes-vous sûr de vouloir supprimer le Post ?')" href="?action=supprimer&id=<?php echo $post['id']; ?>">Supprimer</a></td>
                            <?php   } ?>
                    </tr>
                    
                </tbody>
                
            </table>
        </div>
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