    <div class="header_slide">
        <div class="header_bottom_left">
            <div class="categories">
                <ul>
                    <h3>Categories</h3>
                    <?php
                        $getAll_category = $cat->getAll_active_category();
                        if($getAll_category){
                            while ($result_getAll = $getAll_category->fetch_assoc()){
                    ?>
                    <li><a href="productbycat.php?catId=<?php echo $result_getAll['catId'] ?>"><?php echo $result_getAll['catName'] ?></a></li>
                    <?php
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="header_bottom_right">
            <section class="slider">
                <div class="flexslider">
                    <ul class="slides">
                        <?php
                            $get_slider = $slider->show_slider();
                            if($get_slider){
                                while ($result_slider = $get_slider->fetch_assoc()){
                        ?>
                        <li><img src="admin/uploads/<?php echo $result_slider['image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>" /></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </section>
        </div>
        <div class="clear"></div><br>
    </div>
</div>