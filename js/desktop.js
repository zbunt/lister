

$(document).ready(function(){

        $(window).scroll(function() {
            refresh_gifs_src();
        });
        
        $( window ).resize(function() {
            refresh_gifs_size();
            refresh_gifs_src();
        });

 

 
 
});

function scrol_to_element(id){
     id='#'+id;
     $('html,body').animate({
         scrollTop: $(id).offset().top
     }, 500);
}
   
function refresh_gifs_src(){
    
    var id=0;
    var folder="";
    var src_loader="";
    var num=0;
    var src2="";
    var height=0;
    var window_height=$(window).height();

    var img_height=0;//na ekranu
    var img_width=get_img_width();


    //var loader = base_url + 'img/loader.gif';

    //var loader_css = 'url('+base_url+'img/loader.gif) no-repeat center 50%';
    $(".item").each(function(index,obj) {
        num = parseInt($(this).offset().top-$(window).scrollTop());

        img_height = parseInt($(this).css("height"));

        if(num>-img_height && num<window_height){
            //$(this).html('<div class="item_loader" style="height:'+img_height+'px;width:'+img_width+'px;" ></div>');
            
            
            
            /*
            id = $(this).attr("id");
            $(this).html('<div id="item_loader_'+id+'" style="height:'+img_height+'px;width:'+img_width+'px;" ></div>');
            folder = "0" + id;
            folder = folder.substr(folder.length - 2);
            src_loader = base_url+'slike/'+folder+'/'+id+'.jpg';
            $('#item_loader_'+id).css("background",'url('+src_loader+') no-repeat center 50%');
            $('#item_loader_'+id).css("background-size","contain");
            */
            
            
            
            
            //$(this).attr("src",loader);
            
            //$(this).css("background",loader_css);
            src2 = $(this).attr("src2");
            $(this).css("background",'url('+src2+') no-repeat center 50%');
            $(this).css("background-size","contain");
        }else{
            /*$(this).html("");*/
            $(this).css("background","");
            //$(this).attr("src","");  
        }
        
        
        
        
        
    }); 
    
}




function refresh_gifs_size(){
    var id=0;
    var width=0;
    var height=0;
    var window_height=$(window).height();
    var window_width=$(window).width();

    var img_height=0;//na ekranu
    var img_width=get_img_width();

    var mq = window.matchMedia( "(min-width: 720px)" );
    var TF_mq = mq.matches;
    $(".item").each(function(index,obj){
        width = parseInt($(this).attr("width2"));
        height = parseInt($(this).attr("height2"));
        img_height=height/width*img_width;
        $(this).css("height",img_height+"px");
        
        id = $(this).attr("id");
        $('#item_loader_'+id).css("height",img_height+"px");
        $('#item_loader2_'+id).css("height",img_height+"px");
        
        if (TF_mq) {
            $(this).next().css("height",img_height+"px");
        }else{
            $(this).next().css("height","75px");
        }
        
        
    }); 
    
    $("#aaa").html(document.body.clientWidth+" - "+window_width);

}



function get_img_width(){
    var img_width=0;

    var mq = window.matchMedia( "(min-width: 720px)" );
    if (mq.matches) {
            img_width=500;
    }
    else {
            // window width is less than 720px  
            img_width=$(window).width();
    }
    return img_width;
} 
   
   
   
