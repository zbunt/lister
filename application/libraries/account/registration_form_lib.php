<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Registration_form_lib {


    private $value = null;

    public function __construct() {
    }

    public function Set() {
            $this->Data();
    }

    private function Data() {
        
        $CI = & get_instance();
        

        
        
        $query2=$CI->common_model->get_countries();
        
        $options=array();
        $options[""]="država";
        if ($query2->num_rows()>0){
                foreach ($query2->result() as $row){
                    $options[$row->country_id]=$row->short_name;
                }
        }
        if(isset($_POST['country'])){
            $def=$_POST['country'];
        }else{
            $def="";
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
            $def='0';
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
            $def='0';
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
            $def='0';
        }
        $year=form_dropdown('year', $options, $def,'id="year"');
        

        
        $options=array();
        $options[""]="pol";
        $options[1]="muški";
        $options[0]="ženski";
        
        
        
        if(isset($_POST['gender'])){
            $def=$_POST['gender'];
        }else{
            $def="";
        }
        $gender=form_dropdown('gender', $options, $def,'id="gender"');

        
        
        
        
if(isset($_POST["first_name1"])){
     $first_name=sqlesc($_POST["first_name1"],false);
}else{
    $first_name=set_value('first_name');
}

if(isset($_POST["last_name1"])){
     $last_name=sqlesc($_POST["last_name1"],false);
}else{
    $last_name=set_value('last_name');
}

if(isset($_POST["email1"])){
     $email=sqlesc($_POST["email1"],false);
}else{
    $email=set_value('email');
}    
        
        
        
        $con='
            <div id="korak_2_header">
            
            </div>
            



            ';
        
			$con.='

                                        <div id="form_register_holder">
                                        

<div id="title1">
    O Vama
</div>                                   
<div id="title2">
    Recite nam nešto više o sebi
</div>



                                                        <form action="'.base_url().'account/register" method="post" enctype="multipart/form-data" name="form_register" id="form_register">
                                                            
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

                                                           <input type="text" name="username2" value="'. set_value('username2').'" size="28"  class="reg defText"   title="Korisničko ime" rel="reg2"  autocomplete="off"/>
                                                            '. form_error('username2', '<div class="error">', '</div>').'

                                                          <input type="password" name="password2" value="'. set_value('password2').'" size="28"   class="reg defText"   title="Lozinka" rel="reg2" autocomplete="off" />
                                                            '. form_error('password2', '<div class="error">', '</div>').'

                                                          <input type="password" name="password2_conf" value="'. set_value('password2_conf').'"  size="28" class="reg defText"   title="Potvrda lozinke" rel="reg2" />
                                                            '. form_error('password2_conf', '<div class="error">', '</div>').'
                                                                



                                                                
                                                                <div id="gender_holder">
                                                                '.$gender.'
                                                                    </div>
                                                                '. form_error('gender', '<div class="error">', '</div>').'
                                                                    





                                                            <div id="datum_rodjenja_holder">
                                                            <div id="datum_rodjenja_title">
                                                                datum rodjenja:
                                                            </div>
                                                            
                                                            '.$day.'
                                                            '.$month.'
                                                           '.$year.'
                                                               </div>
                                                            '. form_error('year', '<div class="error">', '</div>').'






                                                                    <div id="country_holder">
                                                                '.$country.'
                                                                    </div>
                                                            '. form_error('country', '<div class="error">', '</div>').'
                                                                
                                                                

                                                           <input type="text" name="city" value="'. set_value('city').'" size="28"  class="reg defText"   title="grad" rel="reg2" />
                                                            '. form_error('city', '<div class="error">', '</div>').'
                                                           

                                                            <div id="slika_holder">
                                                            <input type="file" id="file" name="file" class="nice" />
                                                            </div>
                                                            '. form_error('file', '<div class="error">', '</div>').'
                                                              



                                                        <div id="form_reg_btn"  onClick="validate_reg();" >

                                                                <!--<input type="button" name="submit" value="Login" class="buttonRed" onClick="validate_login();" />-->
                                                        </div>
                                                        


                                                            </form>

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
