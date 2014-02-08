<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    
<body>
    
<head>
    <?php echo $head; ?>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

</head>
<div id="header">
        	
            <div id="head_welcome">Welcome <?php echo $_SESSION['scrv_admin_username']; ?></div>
        	<div id="head_admpanel">Admin Panel</div>
        </div>

<div id="container">
	<div id="left">
    
   <?php echo $mainmenu; ?>
    
    
    
    
    
    </div>

	<div id="right"> <h1>Gallery</h1>
    <br />

      <br />
     <div id="gallery_cont">
     
     <?php echo $output; ?>
     
     
     
     </div>
      
                                                                                                                    
</div>
</div>

</body>
</html>
 