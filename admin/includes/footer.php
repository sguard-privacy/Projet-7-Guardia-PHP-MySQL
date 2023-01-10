<div class="clear">
</div>
</div>
<div class="clear">
</div>
<div id="site_info">
    <!--    For show social link from database-->
    <?php
                        $copyright = $pdoBLOG->query ( "SELECT * FROM footer WHERE id='1'"); 
            
                        while($footer = $copyright->fetch(PDO::FETCH_ASSOC)) {


                            echo "<p>$footer[copyright]<p>";
                         }
                         ?>
</div>
</body>
</html>

