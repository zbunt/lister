<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Theme extends CI_Controller {

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

	public function index($id=0){

            global $user;
            $id+=0;
            if($id==0){
                redirect();
            }
            
            $theme = New Themes_lib($id);
            
            
                $this->load->library('html/head_lib');
                $data["head"]=$this->head_lib->Get();   

                $this->load->library('html/popups_lib');
                $data["popups"]=$this->popups_lib->Get();  
                
                
                
                if ($this->account_model->logged_in())
                {  
                    $data["popups"].= $this->load->view('html/theme/add_post_popups',array('theme_id'=>$id),true);
                }         
                
                
                /*
                $params = array('id_sections' => $id_sections);
                $this->load->library('menu_lib', $params);
                $menu = $this->menu_lib;
                $params = array('menu' => $menu);
                $this->load->library('header_lib', $params);
                 */
                
                $this->load->library('html/header_lib');
                $header=$this->header_lib; 
                $data['header'] = $header->show_header();
                
                $current_url = current_url();
                $data["theme_fb_link"]='<a href="http://www.facebook.com/sharer.php?u='.$current_url.'" target="_blank">#</a>';
                $data["theme_tw_link"]='<a href="http://twitter.com/home?status=Currently reading '.$current_url.'" title="Click to share this post on Twitter">Share on Twitter</a>';
                $data["theme_gpl_link"]='<a href="https://plus.google.com/share?url='.$current_url.'">#</a>';

                $data["posts"]="";
                if($theme->posts_ids){
                    foreach ($theme->posts_ids as $post_id){
                        $post_id+=0;
                        $post = new Posts_lib($post_id);

                        if($post->active){

                            $link=base_url()."post/".$post->id."/".url_title($post->name).".html";
                            $picture="";
                            $on_click="";
                            switch ($theme->type) {
                                case "picture":
                                    $folder=substr($post->item, 30, 2);
                                    $picture=base_url()."uploads/posts/".$folder."/".$post->item;
                                    $picture="<img class='item_picture' src='".$picture."'/>";
                                    break;
                                case "video":
                                    $picture=thumb_from_video_link($post->item);
                                    $picture="<img class='item_picture' src='".$picture."'/>";
                                    $on_click="onClick=\"insert_video(".$post->id.");\"";

                                    break;
                                case "text":
                                    break;
                                default:
                                    break;
                            }
                            
                            $data_post["post"]=$post;
                            $data_post["link"]=$link;
                            $data_post["picture"]=$picture;
                            $data_post["on_click"]=$on_click;
                            
                            $data_post["user_avatar"]=base_url()."img/avatar.jpg";
                            $data_post["user_name"]= $post->get_username_who_posted();
                            $data_post["user_days_ago"]=time_elapsed_string($post->created_date);
                            $data_post["likes"]=$post->likes;
                            $data_post["comments"]=$post->no_of_comments;
                            if($this->account_model->logged_in())
                            {
                                if($post->is_user_liked_this_post($user['id']))
                                {
                                    $data_post["on_click_likes"]="";
                                }
                                else
                                {
                                    $data_post["on_click_likes"]="onClick=\"insert_like(".$post->id.");\"";
                                }   
                            }
                            else
                            {
                                $data_post["on_click_likes"]="onClick=\"show_popup('#login_popup');\"";
                            }
                            
                            $current_url = $link; 
                            $data_post["fb_link"]='<a href="http://www.facebook.com/sharer.php?u='.$current_url.'" target="_blank">#</a>';
                            $data_post["tw_link"]='<a href="http://twitter.com/home?status=Currently reading '.$current_url.'" title="Click to share this post on Twitter">Share on Twitter</a>';
                            $data_post["gpl_link"]='<a href="https://plus.google.com/share?url='.$current_url.'">#</a>';

                            $data_post["on_click_comments"]="onClick=\"insert_comment(".$post->id.");\"";
                            $data["posts"].= $this->load->view('html/theme/post_theme',$data_post,true);
                        }  
                    } 
                }
                
                
                $data["theme"]=$theme;
                
		$this->load->view('theme',$data);
  
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */