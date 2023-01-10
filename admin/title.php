<?php
require_once 'includes/header.php';
require_once 'includes/sidebar.php';
?>
<style>
    .left {
        float: left;
        width: 60%;
    }

    .right {
        float: left;
        width: 40%;
    }

    .right img {
        height: 140px;
        width: 150px;
    }
</style>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Mettre à jour le titre et la description du site</h2>
        <!--            For Update website Title & Logo-->
        <?php

        ?>


        <!--               For show blog title  & logo from database-->
        <div class="block sloginblock">
            <div class="left">
            <?php
            $title = $pdoBLOG->query ( "SELECT * FROM title");
            while($update = $title->fetch(PDO::FETCH_ASSOC)) {

                echo "<form action=\"\" method=\"POST\" enctype=\"multipart/form-data\">";
                echo "<table class=\"form\">";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Titre du site Web</label>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"text\" value=\"$update[title]\" name=\"title\" class=\"medium\" />";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                            echo "<label>Télécharger le logo</label>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"file\" name=\"logo\" />";
                        echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                        echo "<td>";
                        echo "</td>";
                        echo "<td>";
                            echo "<input type=\"submit\" name=\"submit\" Value=\"Modifier\" />";
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
            echo "</form>";

            }
                ?>
            </div>
            <div class="right">
                <img src="" alt="logo">
            </div>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php
require_once 'includes/footer.php';
?>