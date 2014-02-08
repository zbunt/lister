<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mainmenu {

        
    public function Get($type=0) {

        switch ($type) {
            case 0:
            $con ='
                
                <div class="menuitem"><a href="'.base_url().index_page().'/home">Home</a></div>    
                <div class="menuitem">Dinamic</div>
                    <ul>
                        <li><a href="'.base_url().index_page().'/admin/teme">Teme</a></li>
                        <li><a href="'.base_url().index_page().'/admin/postovi">Postovi</a></li>
                        <li><a href="'.base_url().index_page().'/admin/flaged_posts">Flagovani postovi</a></li>
                        <li><a href="'.base_url().index_page().'/admin/top_lists">Top liste</a></li>
                        <li><a href="'.base_url().index_page().'/admin/comments">Komentari</a></li>
                    </ul>                                    
                                   
                <div class="menuitem">Static</div>
                <ul>
                    <li><a href="'.base_url().index_page().'/admin/password">Change password</a></li>
                    <li><a href="'.base_url().index_page().'/home/logout">Logout</a></li>
                    
                </ul>
                ';

                break;
            
           
            default:
                break;
        }
        
        
        
        
        
        
        
        
        return $con;
        
    }
    
    
}

?>
