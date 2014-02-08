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

	<div id="right"> <h1><?php echo $message; ?></h1>
    <br />
    
    
                                                                                                                    
</div>
</div>

</body>
</html>
 