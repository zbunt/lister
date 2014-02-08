<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Edit_form_lib {


    private $value = null;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        
        global $user;
        

        
        
        
                            $ext=$user['ext'];
                            $img=$user['img'];
                            $folder = substr($img, -2); 
                            
                                if($img!=""){
                                        $image_pom=  base_url()."slike/users/".$folder."/".$img.".".$ext;
                                }else{
                                    $image_pom=  base_url()."img/account/no_image.jpg";
                                }
                                        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        $query2=$CI->common_model->get_countries();
        
        $options=array();
        $options[""]="Država";
        if ($query2->num_rows()>0){
                foreach ($query2->result() as $row){
                    $options[$row->country_id]=$row->short_name;
                }
        }
        if(isset($_POST['country'])){
            $def=$_POST['country'];
        }else{
            $def=$user['country'];
        }
        $country=form_dropdown('country', $options, $def,'id="country"');
        
        
        
        
        
        

        

        $options=array();
        $options[0]="--";
        for ($i=1;$i<32;$i++){ 
            $j=substr('0'.$i, -2); 
            $options[$j]=$j;
        }
        if(isset($_POST['day'])){
            $def=$_POST['day'];
        }else{
            $def=date("d",  strtotime($user['birthday']));
        }
        $day=form_dropdown('day', $options, $def,'id="day"');
        
        
        $options=array();
        $options[0]="--";
        for ($i=1;$i<13;$i++){ 
            $j=substr('0'.$i, -2); 
            $options[$j]=$j;
        }
        if(isset($_POST['month'])){
            $def=$_POST['month'];
        }else{
            $def=date("m",  strtotime($user['birthday']));
        }
        $month=form_dropdown('month', $options, $def,'id="month"');
        
        
        $options=array();
        $options[0]="--";
        for ($i=date('Y')-10;$i>date('Y')-100;$i--){ 
            $options[$i]=$i;				
        }
        if(isset($_POST['year'])){
            $def=$_POST['year'];
        }else{
            $def=date("Y",  strtotime($user['birthday']));
        }
        $year=form_dropdown('year', $options, $def,'id="year"');
        

        
        $options=array();
        $options[""]="Pol";
        $options[1]="Muški";
        $options[0]="Ženski";
        
        
        
        if(isset($_POST['gender'])){
            $def=$_POST['gender'];
        }else{
            $def=0+$user['gender'];
        }
        $gender=form_dropdown('gender', $options, $def,'id="gender"');

        
        
        if(isset($_POST['username2'])){
            $username=set_value('username2');
        }else{
            $username=$user['username'];
        }

        if(isset($_POST['first_name'])){
            $first_name=set_value('first_name');
        }else{
            $first_name=$user['first_name'];
        }
        
        if(isset($_POST['last_name'])){
            $last_name=set_value('last_name');
        }else{
            $last_name=$user['last_name'];
        }
        
        if(isset($_POST['email'])){
            $email=set_value('email');
        }else{
            $email=$user['email'];
        }
        
        if(isset($_POST['city'])){
            $city=set_value('city');
        }else{
            $city=$user['city'];
        }
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
			$con='
                            

                                        <div id="form_edit_holder">
                                        

<div id="title1">
    O Vama
</div>                                   
<div id="title2">
    Izmenite podatke o sebi
</div>















                                                        <form action="'.base_url().'account/edit" method="post" enctype="multipart/form-data" name="form_edit" id="form_edit">
                                                            






                                                           <div id="first_name_holder">
                                                           <input type="text" name="first_name" id="first_name" value="'. $first_name .'" size="28"  class="reg defText"   title="Ime" rel="reg2"/>
                                                            '. form_error('first_name', '<div class="error">', '</div>').'
                                                           </div>
                                                           
                                                           <div id="last_name_holder">
                                                           <input type="text" name="last_name" id="last_name" value="'. $last_name .'" size="28"  class="reg defText"   title="Prezime" rel="reg2"/>
                                                            '. form_error('last_name', '<div class="error">', '</div>').'
                                                            </div>  

                                                               

                                                           <input type="text" name="email" value="'. $email .'" size="28"  class="reg defText"   title="E-mail" rel="reg2"/>
                                                            '. form_error('email', '<div class="error">', '</div>').'

                                                           <input type="text" name="username2" value="'.  $username .'" size="28"  class="reg defText"   title="Korisničko ime" rel="reg2"  autocomplete="off"/>
                                                            '. form_error('username2', '<div class="error">', '</div>').'








<!--
                                                            Password:
                                                          <input type="password" name="password" value="'. set_value('password').'" size="28"   class="reg defText"   title="Ime" rel="reg2" />
                                                            '. form_error('password', '<div class="error">', '</div>').'
                                                                <br>
                                                            Password Confirmation:
                                                          <input type="password" name="password_conf" value="'. set_value('password_conf').'" size="28"   class="reg defText"   title="Ime" rel="reg2" />
                                                            '. form_error('password_conf', '<div class="error">', '</div>').'
                                                                <br>
                                                                -->





                                                            <div id="datum_rodjenja_holder">
                                                            <div id="datum_rodjenja_title">
                                                                datum rodjenja:
                                                            </div>
                                                            
                                                            '.$day.'
                                                            '.$month.'
                                                           '.$year.'
                                                               </div>
                                                            '. form_error('year', '<div class="error">', '</div>').'



                                                                <div id="gender_holder">
                                                                '.$gender.'
                                                                    </div>
                                                                '. form_error('gender', '<div class="error">', '</div>').'
                                                                    



                                                              <div id="country_holder">
                                                                '.$country.'
                                                                    </div>
                                                            '. form_error('country', '<div class="error">', '</div>').'
                                                                
                                                                

                                                           <input type="text" name="city" value="'. $city .'" size="28"  class="reg defText"   title="grad" rel="reg2" />
                                                            '. form_error('city', '<div class="error">', '</div>').'
                                                           



                                                            <div id="slika_holder">
                                                                <div id="slika_img">
                                                                    <img src="'.$image_pom.'"/>
                                                                </div>
                                                                <div id="slika_file">
                                                                    <input type="file" id="file" name="file" class="nice" />
                                                                </div>
                                                            </div>
                                                            
                                                            '. form_error('file', '<div class="error">', '</div>').'



                                                            <!--<input type="submit" name="submit" value="Register Account"  class="buttonRed" />-->
                                                            <div id="form_edit_btn"  onClick="validate_edit();" >

                                                            </div>







				<div class="mainClear"></div>

                                    </div>














                            ';
	 
        
                        $js='
       <script>                     

            $("#gender").dropkick();
            $("#country").dropkick();
            $("#year").dropkick();
            $("#month").dropkick();
            $("#day").dropkick();
            

            $(".nice").nicefileinput({ 
                label : "Okačite Vašu sliku" // Spanish label
            });


        </script>


';

        $this->value =$con.$js;

    }

    public function Get() {
        $this->Set();
        return $this->value;
    }

}

?>
