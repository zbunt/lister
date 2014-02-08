var base_url="http://www.bizlifehost.com/";




function get_states(){
       
    var country_id=$("#country").val();    
    
    //alert(country_id);
    
    
    
    $.ajax({
        url:"http://www.bizlifehost.com/admin.php/ajax/state",
            cache:false,
            global: false,
           type: "POST",
           data: "id_country=" + country_id,
        success:function(result){
            
                if(result==""){
                    alert("Uspesno ste se logovali !");
                    
                }else{
                    //alert(result);
                    $('#state').html("");
                    $('#state').html(result);
                }
        }
    }); 
    
}



$(document).ready(function() {
    
   $(".del_confirm").click(function() {
        
        //remove_del_confirmation();
        
        link = $(this).attr("link");
        
        $('body').append('<div id="blackout" onClick="remove_del_confirmation();">&nbsp;asdasda</div>')
        $('body').append('<div id="del_confirm_holder">WARNING!!!<br>ARE YOU SURE?<HR></div>')
        $('#del_confirm_holder').append('<a href="'+link+'" id="del_conf_yes">YES</a>');
        $('#del_confirm_holder').append('<a href="#" id="del_conf_no" onClick="remove_del_confirmation();">NO</a>');

    }); 
    
});

    
function remove_del_confirmation(){
    
    $('#blackout').remove();
    $('#del_confirm_holder').remove();
    
    
} 