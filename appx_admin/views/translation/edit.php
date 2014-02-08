<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <?php echo $head; ?>

    <body>

        <div id="header">
        	
            <div id="head_welcome">Welcome <?php echo $_SESSION['scrv_admin_username']; ?></div>
        	<div id="head_admpanel">Admin Panel</div>
        </div>

        <div id="container">
            <div id="left">

                <?php echo $mainmenu; ?>






            </div>

            <div id="right"> 
                
                <div class="form_cont_450">
                <h1>Edit translation</h1>
                
                School : <?php echo $sch_name; ?><br/>
                Language : <?php echo $lang_name; ?>
                <br /><hr />
                <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <p>
                        <label>Name of school</label>
                            <input name="name" type="text" id="name" value="<?php echo set_value('name',$name1); ?>" />
                        
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>City</label>
                            <input type="text" name="city" id="city" value="<?php echo set_value('city',$city1); ?>"/>
                        
                        <?php echo form_error('city', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>Address</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address',$address1); ?>"/>
                       
                        <?php echo form_error('address', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>Famous alumni
                            <textarea rows="4" cols="50" name="alumni" id="alumni" class="ckeditor"><?php echo set_value('alumni',$alumni1); ?></textarea>
                        </label>
                        <?php echo form_error('alumni', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>Text for google maps (info box)</label>
                            <input type="text" name="google_maps_text" id="google_maps_text" value="<?php echo set_value('google_maps_text',$google_maps_text1); ?>"/>
                        
                        <?php echo form_error('google_maps_text', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>NBA team</label>
                            <input type="text" name="nba_team_closest" id="nba_team_closest" value="<?php echo set_value('nba_team_closest',$nba_team_closest1); ?>"/>
                        
                        <?php echo form_error('nba_team_closest', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>Precent students</label>
                            <input type="text" name="percent_students" id="percent_students" value="<?php echo set_value('percent_students',$percent_students1); ?>"/>
                        
                        <?php echo form_error('percent_students', '<div class="error">', '</div>'); ?>
                       
                     
                       
                    </p>
                   
                    <p>
                        <label>Weather link</label>
                            <input name="weather" type="text" id="weather" value="<?php echo set_value('weather',$weather1); ?>" />
                        
                        <?php echo form_error('weather', '<div class="error">', '</div>'); ?>

                    </p>
                   
                    
                    </div>
                     <div class="form_cont_450">
                     <p>
                        <label>Info text
                            <textarea rows="4" cols="50" name="info" id="info" class="ckeditor"><?php echo set_value('info',$info1); ?></textarea>
                        </label>
                        <?php echo form_error('info', '<div class="error">', '</div>'); ?>
                    </p>
                    
                    <p>
                        
                            
                             <INPUT TYPE="image" SRC="<?php echo base_url(); ?>img/admin/submit.jpg" WIDTH="166"  HEIGHT="44" BORDER="0" ALT="SUBMIT!" name="button" id="button" value="Submit">
                       
                    </p>
                    </div>
                </form>
                <br />
                <br />
            </div>
        </div>
        
    <script>
         
    </script>
    </body>
</html>