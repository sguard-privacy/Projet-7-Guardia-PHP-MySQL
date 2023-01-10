<?php require_once "includes/header.php"; ?>

<!--    Page Banner Start
    ==================================================-->
<section class="banner background9 overlay_three full_row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="banner_text text-center">
                    <h1 class="page_banner_title color_white text-uppercase">Blog</h1>
                    <div class="breadcrumbs m-auto d-inline-block">
                        <ul>
                            <li class="hover_gray"><a href="index.php">Accueil</a></li>
                            <li><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                            <li class="color-default">Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--    Page Banner End
    ==================================================-->


<!--    Blog Post Start
==================================================-->
<section class="blog_area py_80 bg_secondery full_row">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                <div class="blog_list mb_60">
                    <?php
                    $post = $pdoBLOG->query ("SELECT * FROM post ORDER BY id DESC");


                    while($result = $post->fetch(PDO::FETCH_ASSOC)) {

                            echo "<div class=\"blog_item mb_30 wow animated slideInUp\">";
                                echo "<div class=\"blog_img overlay_one\"><img src=\"admin/$result[image]\" alt=\"image\"></div>";
                                echo "<div class=\"blog_content bg_white\">";
                                    echo "<div class=\"blog_title\">";
                                        echo "<a class=\"color_primary\" href=\"post_details.php?id=echo $result[id];\">";
                                            echo "<h5>$result[title]</h5>";
                                        echo "</a>";
                                    echo "</div>";
                                    echo "<p class=\"mt_15 mb_30\">$result[body]</p>";

                                    echo "<div class=\"admin\">";
                                        echo "<img src=\"images/about/02.jpg\" alt=\"image\">";
                                        echo "<span class=\"color_white\">By - echo $result[author]</span>";
                                    echo "</div>";
                                    echo "<div class=\"date float-right color_primary\"> $result[date]</div>";
                                echo "</div>";
                            echo "</div>";
                           } ?>
                </div>
            </div>
            <?php
            include "includes/sidebar.php";
            ?>
        </div>
    </div>
</section>
<!--    Blog Post End
==================================================-->
<?php include "includes/footer.php"; ?>