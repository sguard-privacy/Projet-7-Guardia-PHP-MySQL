<div class="col-md-5 col-lg-4">
    <div class="blog_sidebar">
        <div class="widget mb_60 d-inline-block p_30 bg_white full_row wow animated slideInUp">
            <h3 class="widget_title mb_30 text-capitalize">Suivez moi</h3>
            <div class="socal_media">
                <ul>
                <?php
                        $social = $pdoBLOG->query ( "SELECT * FROM social WHERE id='1'"); 
            
                        while($reseau = $social->fetch(PDO::FETCH_ASSOC)) {


                            echo "<li><a href=\"<?php echo $reseau[facebook] ?>\" target=\"_blank\"><i class=\"fa fa-facebook\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"<?php echo $reseau[github] ?>\" target=\"_blank\"><i class=\"fa fa-github\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"<?php echo $reseau[skype] ?>\" target=\"_blank\"><i class=\"fa fa-skype\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"<?php echo $reseau[linkedin] ?>\" target=\"_blank\"><i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i></a></li>";
                            echo "<li><a href=\"<?php echo $reseau[google] ?>\" target=\"_blank\"><i class=\"fa fa-google\" aria-hidden=\"true\"></i></a></li>";
                         }
                         ?>
                </ul>
            </div>
        </div>
        <div class="widget mb_60 d-inline-block p_30 primary_link bg_white full_row wow animated slideInUp">
            <h3 class="widget_title mb_30 text-capitalize">Categories</h3>
            <div class="category_sidebar">
            <?php
                //                Show category & count post 
                $category = $pdoBLOG->query ("SELECT category.name,category.category_id,COUNT(post.id) FROM post
                            RIGHT JOIN category ON post.category_id = category.category_id
                            GROUP BY name");

                    while($result = $category->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <ul>
                            <li><a href="posts.php?category=<?php echo $result['category_id']; ?>"><?php echo $result['name']; ?></a>
                                <span><?php echo $result['COUNT(post.id)'];  ?> </span>
                            </li>
                        <?php  } ?> <!--end while-->
                        </ul>
            </div>
        </div>
        <div class="widget mb_60 d-inline-block p_30 primary_link bg_white full_row wow animated slideInUp">
            <h3 class="widget_title mb_30 text-capitalize">Postes Récents</h3>
            <div class="recent_post">
                <ul>
                    <?php
                    $post = $pdoBLOG->query ("SELECT * FROM post ORDER BY id DESC limit 5");

                        while($result = $category->fetch(PDO::FETCH_ASSOC)) {

                            echo "<li class=\"mb_30\">";
                            echo    "<a href=\"post_details.php?id=$result[id]\">";
                            echo        "<div class=\"post_img\"><img src=\"admin/$result[image]\" alt=\"image\"></div>";
                            echo        "<div class=\"recent_post_content\">";
                            echo    "<h6>$result[body]</h6>";
                            echo        "<span class=\"color_gray\">$result[date]</span>";
                            echo    "</div>";
                            echo    "</a>";
                            echo "</li>";
                  } ?> <!--end while-->

                </ul>
            </div>
        </div>
    </div>
</div>