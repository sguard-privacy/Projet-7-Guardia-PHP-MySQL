<div class="col-md-5 col-lg-4">
    <div class="blog_sidebar">
        <div class="widget mb_60 d-inline-block p_30 bg_white full_row wow animated slideInUp">
            <h3 class="widget_title mb_30 text-capitalize">Suivez moi</h3>
            <div class="socal_media">
                <ul>
                <?php
                        $social = $pdoBLOG->query ( "SELECT * FROM social WHERE id='1'"); 
            
                        while($reseau = $social->fetch(PDO::FETCH_ASSOC)) {


                            echo "<li><a href=\"$reseau[facebook]\" target=\"_blank\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"$reseau[github]\" target=\"_blank\"><i class=\"fa fa-github\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"$reseau[skype]\" target=\"_blank\"><i class=\"fa fa-skype\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"$reseau[linkedin]\" target=\"_blank\"><i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"$reseau[google]\" target=\"_blank\"><i class=\"fa fa-google\" aria-hidden=\"true\"></i></a></li>";
                         }
                         ?>
                </ul>
            </div>
        </div>
    </div>
</div>