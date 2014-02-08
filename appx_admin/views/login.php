
<html>
    <?php echo $head; ?>
    
    <body style="background-color: #cccccc;">
        <?php echo $error_message; ?>
        <div id="login_form">
            <form id="form1" name="form1" method="post" action="<?php echo base_url(); ?>admin.php">
                <input name="username" type="text"  id="l_username" maxlength="14" placeholder="username"/>
                <input name="password" type="password"  id="l_password" maxlength="14" placeholder="password"/>
                <input type="image" src='<?php echo base_url(); ?>img/admin/login_btn.jpg' alt='submit' name='submit' id="l_submit"/>
            </form>
        </div>
    </body>
</html>