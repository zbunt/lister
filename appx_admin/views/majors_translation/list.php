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

            <div id="right"> <h1>Majors translation</h1>
                <br />
                
                <?php echo anchor('majors_trans/add_m', 'Add new major', 'title="Add new school" class="bigbutton"'); ?>
                <br /><br /><br />
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabela">

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        
                        <th scope="col">Translation Actions</th>
                        
                    </tr>
                    <tr>
                        
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php echo $table; ?>
                </table>


            </div>
        </div>

    </body>
</html>
