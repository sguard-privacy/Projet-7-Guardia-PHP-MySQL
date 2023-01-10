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
                      $select = $pdoBLOG->query( " SELECT * FROM post, category " );
                      
          
                        while ( $post = $select->fetch( PDO::FETCH_ASSOC )) { ?>
                    
                    <tr class="odd gradeX">
                        <td></td>
                        <td><?php echo $post['title']; ?></td>
                        <td><?php echo $post['body']; ?></td>
                        <td><?php echo $post['category_id']; ?></td>
                        <td><img src="<?php echo $post['image']; ?>" height="40px" width="80px" alt="photos du post"></td>
                        <td><?php echo $post['author']; ?></td>
                        <td><?php echo $post['tags']; ?></td>
                        <td><?php echo $post['date']; ?></td>
                        <td><a href="edit_post.php?edit_postid=">Modifier</a>
                            || <a onclick="return confirm('Etes vous sur de vouloir supprimer ?')" href="delete_post.php?del_postid=">Supprimer</a></td>
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