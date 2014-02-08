<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $head; ?>   
    </head>
    <body>
        <a id="top" name="top"></a>
        <div id='back_to_top' onClick="scrol_to_element('top');"><img src='<?php echo base_url() ?>img/back_to_top.jpg'/></div>
        <div id="mask"></div>
        <?php echo $popups; ?>

        <?php echo $header; ?>

        <?php
        if ($this->account_model->logged_in()) {//ulogovan user
            $popup = '#add_' . $theme->type . '_popup';
        } else {
            $popup = '#login_popup';
        }

        switch ($theme->type) {
            case 'picture':
                $text = "Dodaj sliku";

                break;
            case 'video':
                $text = "Dodaj video";

                break;
            case 'text':
                $text = "Dodaj tekst";

                break;

            default:
                break;
        }
        ?>
        
        <div id="main_holder" >

            <div id="main_holder_left">
                <div id="theme_title">
                    <?php echo $theme->name; ?>
                </div>
                <!--<div id="theme_subtitle">
                    <div id ="theme_add" onclick="show_popup('<?php echo $popup; ?>');">
                        <?php echo $text; ?>
                    </div>
                    <div id="theme_social">
                        <div id="social_email"></div>
                        <div id="social_gpl"></div>
                        <div id="social_twitter"></div>
                        <div id="social_fb"></div>
                    </div>
                </div>-->
                <div id="theme_sort">

                </div>
                <div id="items_holder">
                    <?php echo $posts; ?>
                </div>
            </div>
            <div id="main_holder_right">

            </div>
        </div>















    </body>
</html>