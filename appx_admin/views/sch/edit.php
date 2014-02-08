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
                <br />
                <div class="form_cont_450">
                 <h1>Edit info</h1>
                <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <p>
                        <label>Name</label>
                            <input name="name" type="text" id="name" value="<?php echo set_value('name', $name1); ?>" />
                        
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>google_maps_lat</label>
                            <input type="text" name="google_maps_lat" id="google_maps_lat" value="<?php echo set_value('google_maps_lat', $google_maps_lat1); ?>"/>
                        
                        <?php echo form_error('google_maps_lat', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>google_maps_lng</label>
                            <input type="text" name="google_maps_lng" id="google_maps_lng" value="<?php echo set_value('google_maps_lng', $google_maps_lng1); ?>"/>
                        
                        <?php echo form_error('google_maps_lng', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>fee</label>
                            <input type="text" name="fee" id="fee" value="<?php echo set_value('fee', $fee1); ?>"/>
                        
                        <?php echo form_error('fee', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>domain</label>
                            <input type="text" name="domain" id="domain" value="<?php echo set_value('domain', $domain1); ?>" disabled="disabled"/>
                       
                        <?php echo form_error('domain', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>email</label>
                            <input type="text" name="email" id="email" value="<?php echo set_value('email', $email1); ?>"/>
                        
                        <?php echo form_error('email', '<div class="error">', '</div>'); ?>
                        </p>
                        <p>
                        <label>Logo</label>
                            <input type="file" name="logo" id="logo" /><img src='<?php echo $logo; ?>' width='40' height='40'/>
                        
                        <?php echo form_error('logo', '<div class="error">', '</div>'); ?>
                    </p>
                    <p>
                        <label>Country</label>
                            <?php echo $country_combo; ?>
                        
                        <?php echo form_error('country', '<div class="error">', '</div>'); ?>
                    </p>

                    <p>
                        <label>State</label>
                            <?php echo $state_combo; ?>
                        
                    </p>
                    <p>
                        <label>population</label>
                            <input name="population" type="text" id="population" value="<?php echo set_value('population', $population1); ?>" />
                        
                        <?php echo form_error('population', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>World Rank (0-100)</label>
                            <input name="rank" type="text" id="rank" value="<?php echo set_value('rank', $rank1); ?>" />
                        
                        <?php echo form_error('rank', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>State rank (0-100)</label>
                            <input name="state_rank" type="text" id="state_rank" value="<?php echo set_value('state_rank', $state_rank1); ?>" />
                        
                        <?php echo form_error('state_rank', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>Founded</label>
                            <input name="founded" type="text" id="founded" value="<?php echo set_value('founded', $founded1); ?>" />
                        
                        <?php echo form_error('founded', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>internacional</label>
                            <input name="internacional" type="text" id="internacional" value="<?php echo set_value('internacional', $internacional1); ?>" />
                        
                        <?php echo form_error('internacional', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                        <label>Public/private</label>
                            <?php echo $type_combo; ?>
                        
                        <?php echo form_error('type', '<div class="error">', '</div>'); ?>

                    </p>
                  <p>
                        
                            
                             <INPUT TYPE="image" SRC="<?php echo base_url(); ?>img/admin/submit.jpg" WIDTH="166"  HEIGHT="44" BORDER="0" ALT="SUBMIT!" name="button" id="button" value="Submit">
                       
                    </p>
                    </div>
                </form>
                
            </div>
        </div>
	<script>
          CKEDITOR.replace( 'info', {
            toolbarGroups: [
		{ name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
 																		// Line break - next group will be placed in new line.
 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
 		{ name: 'links' }
	]
        });
        CKEDITOR.instances['info'].resize(300, 300);
    </script>
    </body>
</html>
