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
                <h1>Change password</h1>
                
               
                <br /><hr />
                <form action="<?php echo current_url(); ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
                  <p>
                    <label>Old Password</label>
                          <input name="old_pass" type="password" id="old_pass" />
                        
                      <?php echo form_error('old_pass', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>
                    <label>New Password</label>
                          <input name="new_pass" type="password" id="new_pass" />
                        
                      <?php echo form_error('new_pass', '<div class="error">', '</div>'); ?>

                    </p>
                  <p>
                    <label>Retype New Password</label>
                        <input name="new_pass2" type="password" id="new_pass2" />
                        
                    <?php echo form_error('new_pass2', '<div class="error">', '</div>'); ?>

                    </p>
                    <p>

                             <INPUT TYPE="image" SRC="<?php echo base_url(); ?>img/admin/submit.jpg" WIDTH="166"  HEIGHT="44" BORDER="0" ALT="SUBMIT!" name="button" id="button" value="Submit">
                  </p>

                </form>
                <br />
                <br />
            </div>
        </div>
        
    <script>
         
    </script>
    </body>
</html>