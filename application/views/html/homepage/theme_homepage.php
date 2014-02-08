
        <?php
            $id=0+$theme->id;
            $name=$theme->name;
            $picture=$theme->background_picture;
            $class="";
            if($theme->size=="velika"){
                $class="large";
            }
            $picture="<img class='theme_picture_homepage ". $class."' src='".$picture."'/>";
            
            $link=base_url()."theme/".$id."/".url_title($name).".html";
            
            
        ?>

        <div class="theme_homepage <?php echo $class; ?>" >
            <div class="theme_comments_homepage">
                739
            </div>
            <a href="<?php echo $link; ?>" >
                <div class="theme_title_homepage <?php echo $class; ?>">
                    <?php echo $name; ?>
                </div>
            </a>
            
            <?php echo $picture; ?>
        </div>
