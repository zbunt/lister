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
    
    
    
    
    
    
    <div id="main_holder" >
        <div id="themes_header">
            Izaberi temu gde zelis da kreiras post, ili je podeli sa prijat
        </div>
        <div id="themes_holder">

            <?php echo $themes; ?>
        </div>
        <div id="lists_holder">

        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
    
    
    

</body>
</html>