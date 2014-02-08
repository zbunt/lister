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
                <h1>Add new translation</h1>
                Major : <?php echo $major_name; ?><br/>
                Language : <?php echo $lang_name; ?>
                <br /><hr />
                
                <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    <p>
                        <label>Traslation of major</label>
                            <input name="name" type="text" id="name" value="<?php echo set_value('name'); ?>" />
                        
                        <?php echo form_error('name', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>&nbsp;</p>
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
         
        CKEDITOR.instances['alumni'].resize(300, 300);
		
		CKEDITOR.instances['info'].resize(300, 300);
    </script>
    </body>
</html>
