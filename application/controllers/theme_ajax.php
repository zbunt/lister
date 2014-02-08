<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Theme_ajax extends CI_Controller
{
    
    
        function __construct()
        {
                parent::__construct();
                
                global $user;
                $user_obj = $this->user_lib;
                $user_obj->login();
                if($user_obj->check_user()){
                    $user = $user_obj->get_user();
                }   
        }
	
        function index()
        {
            
	}

        public function items_show_more(){
            
            $id_sections=0;
            if(isset($_POST['id_sections'])){
                $id_sections = 0 + $_POST['id_sections'];
            }
            $num=0;
            if(isset($_POST['num'])){
                $num = 0 + $_POST['num'];
            }
            
            
            $img_width=0;
            if(isset($_POST['img_width'])){
                $img_width = 0 + $_POST['img_width'];
            }            
            

            $query=$this->common_model->get_items($id_sections,$num);
            
            $con="";
            foreach($query->result() as $row)
            {
                    $id=$row->id;
                    $title=$row->title;
                    $img=$row->img;
                    $width=$row->width;
                    $height=$row->height;
                    $id_teme=0+$row->id_teme;
                    
                    $row_teme=$this->common_model->get_teme($id_teme);
                    
                    $tema="";
                    if($row_teme){
                        $tema=$row_teme->name;
                    }
                    
                    if($width==0){
                        continue;
                    }
                    $img_height=$height/$width*$img_width;
                    
                    
                    $site=$row->site;

                    $url=  base_url().'item/no/'.$id."/".  url_title($title).".html";
                    $link='<a href="'. $url.'" >'.$title.'</a>';

                    
                    
                    
                    
                    

                    $disqus="";
                    
                    
                    $loader = base_url() . 'img/loader.gif';
                    $loader_css = 'url('+base_url()+'img/loader.gif) no-repeat center 50%';
                    
                    
                    
                    
                    
                    
                    $folder="0".$id;
                    $folder=substr($folder, -2);
                    $folder=  base_url()."slike/items/".$folder."/";
                    $jpg_url =  $folder . $id . ".jpg";
                    
                    
                    
                    
                    
                    
                    
                    
                    $con.='
                        <div class="item_holder">
                            <div class="item_header">
                                <div class="item_tema">
                                    '.$tema.'
                                </div>
                                <div class="item_site">
                                    Site: '.$site.'
                                </div>
                                <div class="item_title">
                                    '.$link.'
                                </div>
                                <div class="item_comments_nav">
                                    <div class="item_comments_btn">

                                    </div>
                                    <div class="item_comments_num">
                                        55
                                    </div>
                                </div>
                                <!--
                                <div class="item_comments">
                                    '.$disqus.'
                                </div>
                                -->




                            </div>
                            
                            <div class="item_item_social">
                                <div id="'.$id.'" class="item" style="height:'.$img_height.'px;" width2="'.$width.'" height2="'.$height.'" src2="'.$img.'">
                                    
                                    <div id="item_loader_'.$id.'" style="height:'.$img_height.'px;background:url('.$jpg_url.') no-repeat center 50%;background-size:contain;" ></div>
                                    <div id="item_loader2_'.$id.'" class="item_loader" style="height:'.$img_height.'px;" ></div>
                                        
                                </div>
                                <div class="item_social">
                                    <div class="item_social_tab">
                                        <div class="item_social_vertical">
                                            <div class="item_social_ico">
                                                <img src="' . base_url() . 'img/like_ico.png" />
                                            </div>
                                            <div class="item_social_text">
                                                5465
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item_social_tab">
                                        <div class="item_social_vertical item_border_top">
                                            <div class="item_social_ico">
                                                <img src="' . base_url() . 'img/comments_ico.png" />
                                            </div>
                                            <div class="item_social_text">
                                                34
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item_social_tab">
                                        
                                        <div class="item_social_vertical item_border_top">
                                            <div class="item_social_ico">
                                                <img src="' . base_url() . 'img/share_ico.png" />
                                            </div>
                                            <div class="item_social_text">
                                                556
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>






';
                    

            }

            echo $con;
            
            
        }//end function
        
        
        
        
        
        
        
        
        
        
	function picture_submit()
	{

            $theme_id=0;
            if(isset($_POST['theme_id'])){
                $theme_id = 0+$_POST['theme_id'];
            }
            if($theme_id==0){
                        echo "error 34765!";
                        exit;
            }
            
            
            
            global $user;


                $error="";
                if($this->account_model->logged_in()){//ulogovan user
                    
                    
                    $id_user=$user['id']+0;

                    $name="";
                    if(isset($_POST['name'])){
                        $name = sqlesc($_POST['name'],false);
                    }
                    
                    $text="";
                    if(isset($_POST['text'])){
                        $text = sqlesc($_POST['text'],false);
                    }



                    if($name==""){
                        echo "Name required!";
                        exit;
                    }
                    if($text==""){
                        echo "Text required!";
                        exit;
                    }
                    if(!isset($_FILES['file'])){
                        echo "Img required!";
                        exit;
                    }
                    
                    

                                $file_name=rand_sha1(32);
                                //$first_letter=substr($file_name, 0, 1);
                                
                                //$imgname=get_random_md5();
                                $dirname=substr($file_name, -2);
                                $dir_name='uploads/posts/'.$dirname."/";
                                
				$config['file_name'] = $file_name;
				$config['upload_path'] = $dir_name;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1024';
				//$config['max_width']  = '1024';
				//$config['max_height']  = '1024';
				//$config['encrypt_name']  = TRUE;
                                
                                
                                
                                if(!is_dir($dir_name)){
                                    if(!mkdir($dir_name , 0777))
                                    {
                                       echo "Failed to create directory...$dir_name<br><br>";
                                       exit;
                                    }
                                }
                                
                                
                                
                                
                                
				$this->load->library('upload', $config);
		
				$field_name = "file";
				if ( $this->upload->do_upload($field_name))
				{
                                    
                                    $data['upload_data'] = $this->upload->data();
                                    $arr=getimagesize($data['upload_data']['full_path']);
                                    if ($arr[0]>=300 && $arr[1]>=100){

                                                                $this->load->library('image_lib');


                                                                //make max image width or height = 720px
                                                                
                                                                if ($data['upload_data']['image_width']>610 || $data['upload_data']['image_height']>610){
                                                                        
                                                                    
                                                                        $config2['image_library'] = 'gd2';
                                                                        $config2['source_image'] = $data['upload_data']['full_path'];
                                                                        $config2['create_thumb'] = FALSE;
                                                                        $config2['maintain_ratio'] = TRUE;
                                                                        $config2['width'] = 610;
                                                                        $config2['height'] = 610;


                                                                        $this->image_lib->initialize($config2);

                                                                        if (!$this->image_lib->resize())
                                                                        {
                                                                                $error =  $this->image_lib->display_errors();
                                                                                echo $error;
                                                                                exit;

                                                                        }

                                                                        $this->image_lib->clear();


                                                                }
                                                                $item=$data['upload_data']['orig_name'];
                                                                $created_date=date("Y-m-d H:i:s");
                                                               
                                                                
                                                                $data=array(
                                                                    'name'=>$name,
                                                                    'text'=>$text,
                                                                    'item'=>$item,
                                                                    //'flaged'=>
                                                                    'id_user'=>$id_user,
                                                                    //'likes'=>
                                                                    'created_date'=>$created_date,
                                                                    'active'=>1,
                                                                    'themes_id'=>$theme_id
                                                                    //'is_in_top_list'=>
                                                                    //'sort_in_top_list'=>
                                                                    
                                                                );
                                                                $this->posts_model->insertPost('posts',$data);
                                                                
                                                                
                                    }else{
                                            if(@unlink($data['upload_data']['full_path'])){
                                                    echo 'Minimalna dimenzija slike mora biti 300x100px!';
                                                    exit;
                                            }else{
                                                    echo 'Problem width deletting image, Minimalna dimenzija slike mora biti 300x100px !';
                                                    exit;
                                            }
                                    } 
                                    

				}else{
                                    $error = $this->upload->display_errors();
                                    echo $error;
                                    exit;

				}
                                
                                
                    
      
                                
                }else{
                    echo "error not logged user 655745";
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                

	}
        
        
        
        
        
        
        
        
	function video_submit()
	{


            $theme_id=0;
            if(isset($_POST['theme_id'])){
                $theme_id = 0+$_POST['theme_id'];
            }
            if($theme_id==0){
                        echo "error 34765!";
                        exit;
            }
            
            global $user;

            

                $error="";
                if($this->account_model->logged_in()){//ulogovan user
                    
                    
                    $id_user=$user['id']+0;

                    $name="";
                    if(isset($_POST['name'])){
                        $name = sqlesc($_POST['name'],false);
                    }
                    
                    $text="";
                    if(isset($_POST['text'])){
                        $text = sqlesc($_POST['text'],false);
                    }

                    $item="";
                    if(isset($_POST['item'])){
                        $item = sqlesc($_POST['item'],false);
                    }

                    if($name==""){
                        echo "Name required!";
                        exit;
                    }
                    if($text==""){
                        echo "Text required!";
                        exit;
                    }
                    if($item==""){
                        echo "Video link required!";
                        exit;
                    }
                    
                    $valid = preg_match("/^(http\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $item);
                    if (!$valid) {
                        echo "Video link nije validan youtube link!";
                        exit;
                    }
                    
                    
                    
                    
                    

                    $created_date=date("Y-m-d H:i:s");

                    $data=array(
                        'name'=>$name,
                        'text'=>$text,
                        'item'=>$item,
                        //'flaged'=>
                        'id_user'=>$id_user,
                        //'likes'=>
                        'created_date'=>$created_date,
                        'active'=>1,
                        'themes_id'=>$theme_id
                        //'is_in_top_list'=>
                        //'sort_in_top_list'=>

                    );




                    $this->posts_model->insertPost('posts',$data);


      
                                
                }else{
                    echo "error not logged user 655745";
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                

	}
        
        
	function text_submit()
	{


            $theme_id=0;
            if(isset($_POST['theme_id'])){
                $theme_id = 0+$_POST['theme_id'];
            }
            if($theme_id==0){
                        echo "error 34765!";
                        exit;
            }
            
            global $user;

            

                $error="";
                if($this->account_model->logged_in()){//ulogovan user
                    
                    
                    $id_user=$user['id']+0;

                    $name="";
                    if(isset($_POST['name'])){
                        $name = sqlesc($_POST['name'],false);
                    }
                    
                    $text="";
                    if(isset($_POST['text'])){
                        $text = sqlesc($_POST['text'],false);
                    }



                    if($name==""){
                        echo "Name required!";
                        exit;
                    }
                    if($text==""){
                        echo "Text required!";
                        exit;
                    }



                    $created_date=date("Y-m-d H:i:s");

                    $data=array(
                        'name'=>$name,
                        'text'=>$text,
                        //'item'=>'',
                        //'flaged'=>
                        'id_user'=>$id_user,
                        //'likes'=>
                        'created_date'=>$created_date,
                        'active'=>1,
                        'themes_id'=>$theme_id
                        //'is_in_top_list'=>
                        //'sort_in_top_list'=>

                    );




                    $this->posts_model->insertPost('posts',$data);


      
                                
                }else{
                    echo "error not logged user 655745";
                }
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                                

	}
        
        
        
	function insert_video()
	{
                    $id=0;
                    if(isset($_POST['id'])){
                        $id = 0+$_POST['id'];
                    }
         

                    
                    
                    $post = new Posts_lib($id);
                    /*echo $id."[video=".$post->item."]";
                    exit;*/

                    $video=format_text("[video=".$post->item."]");
                    echo $video;
        }
        
        
        
        
        
        
        

        
        
}











/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */