
var base_url="http://www.sajtdzije.com/lister/";

$(document).ready(function(){
 

    $('#themes_holder').isotope({
      // options
      itemSelector : '.theme_homepage',
            masonry: { 
                columnWidth: 191
            }
          
      //layoutMode : 'fitRows'
    });
 
 
 
});

    function show_popup(selector){

        $(".popup").fadeOut("slow", function() {

        });
        
        $("#mask").fadeIn("slow", function() {
            $(selector).css("display","block");
        });
        $("#mask").attr("onClick","hide_popup('"+selector+"');")
        
        


    }
    
    function hide_popup(selector){

        $(selector).fadeOut("slow", function() {
            $("#mask").css("display","none");
        });

    }




function signup(){
    

    
    var name = $('#name').val();
    var email = $('#email_signup').val();
    var password = $('#password_signup').val();
    var password2 = $('#password_signup2').val();
    
    
    
   
    $("#signup_popup_message_error").html("<img width='50px' src='"+base_url+"img/loading2.gif' />");        
             
                                                
    $.ajax({
            url: base_url+"account/signup",
            cache:false,
            global: false,
            type: "POST",
            data: "name="+name+"&email="+email+"&password="+password+"&password2="+password2,
            success: function(data) {
                if (data == ""){
                    /*
                    $('#message_popup_title').html('Message');
                    $('#message_popup_message').html('Check your email and confirm your account!');
                    show_popup('#message_popup');*/
                    window.location = base_url;
                }else{
                    $('#signup_popup_message_error').html(data);
                }
            }
    });
    
    
    return false;
    
//$('#frm_error_login').html('<br /><br />' + lsuccess + '<br /><br />');
}

function login(){
    

    var email = $('#email').val();
    var password = $('#password').val();
    var remember_me = document.getElementById("remember_me").checked;
    
    
    $("#login_popup_message_error").html("<img width='50px' src='"+base_url+"img/loading2.gif' />");        
             
                                                
    $.ajax({
            url: base_url+"account/login",
            cache:false,
            global: false,
            type: "POST",
            data: "email="+email+"&password="+password+"&remember_me="+remember_me,
            success: function(data) {
                if (data == ""){
                    /*
                    $('#message_popup_title').html('Message');
                    $('#message_popup_message').html('Check your email and confirm your account!');
                    show_popup('#message_popup');*/
                    window.location = base_url;
                }else{
                    $('#login_popup_message_error').html(data);
                }
            }
    });
    
    
    return false;
    
//$('#frm_error_login').html('<br /><br />' + lsuccess + '<br /><br />');
}






function picture_submit(theme_id){

    
    $("#add_picture_popup_message_error").html("<img width='50px' src='"+base_url+"img/loading2.gif' />");  

    

    /*
    var mesto = $('#mesto').val();
    
    */
   
   /*
    var chk1= ($('#pravilnik').is(':checked'))?1:0;
    var chk2= ($('#chc').is(':checked'))?1:0;
    */


    var url = base_url + 'theme_ajax/picture_submit';

    var uf = document.getElementById('form_picture');
    var form_data = new FormData(uf);  
    /*
        form_data.append("chk1", chk1);
        form_data.append("chk2", chk2);
    */
    
    form_data.append("theme_id", theme_id);
    
    
    
    
    $.ajax({
        url: url,
        data: form_data,
        dataType: false,
        processData: false,
        contentType: false,
        async: false,
        type: 'POST',
        success: function(data){
            if (data == ""){
                window.location = base_url;
            }else{
                $('#add_picture_popup_message_error').html(data);
            }
        }
    });
    
    
    
    return false;
    

}



function video_submit(theme_id){

    
    $("#add_video_popup_message_error").html("<img width='50px' src='"+base_url+"img/loading2.gif' />");  

    

    /*
    var mesto = $('#mesto').val();
    
    */
   
   /*
    var chk1= ($('#pravilnik').is(':checked'))?1:0;
    var chk2= ($('#chc').is(':checked'))?1:0;
    */


    var url = base_url + 'theme_ajax/video_submit';

    var uf = document.getElementById('form_video');
    var form_data = new FormData(uf);  
    /*
        form_data.append("chk1", chk1);
        form_data.append("chk2", chk2);
    */
   
    form_data.append("theme_id", theme_id);
    
    
    
    
    
    $.ajax({
        url: url,
        data: form_data,
        dataType: false,
        processData: false,
        contentType: false,
        async: false,
        type: 'POST',
        success: function(data){
            if (data == ""){
                window.location = base_url;
            }else{
                $('#add_video_popup_message_error').html(data);
            }
        }
    });
    
    
    
    return false;
    

}




function text_submit(theme_id){

    
    $("#add_text_popup_message_error").html("<img width='50px' src='"+base_url+"img/loading2.gif' />");  

    

    /*
    var mesto = $('#mesto').val();
    
    */
   
   /*
    var chk1= ($('#pravilnik').is(':checked'))?1:0;
    var chk2= ($('#chc').is(':checked'))?1:0;
    */


    var url = base_url + 'theme_ajax/text_submit';

    var uf = document.getElementById('form_text');
    var form_data = new FormData(uf);  
    /*
        form_data.append("chk1", chk1);
        form_data.append("chk2", chk2);
    */
   
    form_data.append("theme_id", theme_id);
    
    
    
    
    
    $.ajax({
        url: url,
        data: form_data,
        dataType: false,
        processData: false,
        contentType: false,
        async: false,
        type: 'POST',
        success: function(data){
            if (data == ""){
                window.location = base_url;
            }else{
                $('#add_text_popup_message_error').html(data);
            }
        }
    });
    
    
    
    return false;
    

}





function insert_video(id){
    

    var url = base_url + 'theme_ajax/insert_video';

    
    
    $.ajax({
        url: url,
        cache:false,
        global: false,
        type: "POST",
        data: "id="+id,
        success: function(data){
            if (data == ""){
                alert("error 3243");
            }else{
                $('#item_'+id).html(data);
            }
        }
    });
    
    
    
    return false;
    

}



function insert_like(post_id){
    
    
    var url = base_url + 'post_ajax/like';

    
    
    $.ajax({
        url: url,
        cache:false,
        global: false,
        type: "POST",
        data: "post_id="+post_id,
        success: function(data){
                                    
            if (data == "ok"){
               
               old = $('#likeid_'+post_id).html();
               new_val = parseInt(old) + 1;
               $('#likeid_'+post_id).html(new_val);
               $('#likeid_'+post_id).attr('onclick','').unbind('click');
               
            }else{
                alert('FAIL');
            }
        }
    });
    
    
    
}
function insert_comment(post_id){
    alert("function insert_comment("+post_id+")");
}