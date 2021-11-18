<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*use Restserver\Libraries\REST_Controller;
*/
/*require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
namespace Restserver\Libraries;*/
error_reporting(E_ALL);
ini_set('display_errors', 1); //ADD this line.
class Client extends MY_Controller {
    
    function __construct()
    {
        parent::__construct();  
     //   $this->load->helper('security'); 
      $this->load->model(array('Auth_model','Volunteer_model'));    
      $this->load->library(array('ion_auth','form_validation'));  
    }
    
    public function view_post(){ 
      echo "string";
      exit();
    }


    public function reg_post(){ 
        
    $this->form_validation->set_rules('mobile','mobile','required');    
    $this->form_validation->set_message('required', 'Invalid %s');
    
    if ($this->form_validation->run() == true) {

       $mobile  = $this->input->post('mobile');  
       $res = $this->Auth_model->check_mob($mobile);
       
       if($res){
           
           // $this->set_response([
           //              'status'=>false,
           //              'msg' => "Mobile already exists",

           //               ], MY_Controller::HTTP_OK);     

         // $this->response('status'=>false,'msg'=>'Mobile already exists', 200);
   
         $array = array(

                'status'=>false,
                'msg'   =>'Mobile already exists'
               );
       	 $this->response($array, 200);

       }
       else{

          $otp = mt_rand(100000,999999);
           
          $arr = array(
               'phone_no' =>$mobile,
               'otp' =>$otp,
              );
              
         
              
        $row = $this->Auth_model->register('tbl_otp',$arr);
       
        if ($row) {
          
          
        $array = array(

                'status'=>true,
                'msg'   =>'Registration Successful!OTP sent to your registered mobile'
               );
       	 $this->response($array, 200);

  //      	 $msg='Namskar ! '.$otp.' is one time password (OTP) for login  to ecms';
		// $this->ion_auth->smssend($phone,$msg);

}
else{

         $array = array(

                'status'=>false,
                'msg'   =>'Error!'
               );
       	 $this->response($array, 200);

        }

      }
      
      }else{

       $array = array(

                'status'=>false,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200);

      }
  }



  public function verifyotp_post(){
      
     $this->form_validation->set_rules('otp','otp','required');
     $this->form_validation->set_rules('mobile','mobile','required');    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

       $otp  = $this->input->post('otp');
        $mobile  = $this->input->post('mobile'); 
      
        $row = $this->Auth_model->verify_otp($otp,$mobile);
       
        if ($row) {
                     
         $name = 'demouser';
	     $password = password_hash('12345',PASSWORD_BCRYPT);

        
		// $party_id = $this->input->post('party_id');
		// $user_id = $this->input->post('user_id');
		// $email = $this->input->post('email');
       
            $email = $name . '@archizsolutions.com';
               
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $mobile,
                    'add_date' => date('d-m-y'),
                    'party_id'=>'433',
                   );

                  $data1 = array(
                  
                  'username'=>$name,
                  'password'=>$password,
                  'email'   =>$email,
                  'phone'   =>$mobile,
                  'party_ion_id'=>'433',
                  'ip_address'=>$this->getIp()


                  ); 	
					
					 $dfg = 5;
					$res_reg = $this->Auth_model->register('users',$data1);
                   // $res_reg = $this->ion_auth->register($name,$password,$email,$dfg);
                   // $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $res_vol = $this->Volunteer_model->insertVolunteer($data);
                    // $volunteer_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    // $id_info = array('ion_user_id' => $user_id);
                    // $this->volunteer_model->updateVolunteer($volunteer_user_id, $id_info);
                    // $this->party_model->addPartyIdToIonUser($ion_user_id, $party_id);

                if($res_reg && $res_vol){
                     $array = array(

                     'status'=>true,
                     'msg'   =>"OTP Verified Successfuly and registered successfuly"
                   );
       	         $this->response($array, 200); 


                    }
                 else{

                   $array = array(

                     'status'=>false,
                     'msg'   =>"Error!"
                   );
       	           $this->response($array, 200); 
                  }

        }
        else{

         $array = array(

                'status'=>false,
                'msg'   =>"Error!"
               );
       	 $this->response($array, 200); 

        }

      }else{

         $array = array(

                'status'=>false,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }
         
  }


  public function loginotpverification_post(){

     $this->form_validation->set_rules('mobile','Mobile','required');
    // $this->form_validation->set_rules('password','Password','required');
     $this->form_validation->set_rules('otp','OTP','required');    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

       $mobile  = $this->input->post('mobile');
       $otp  = $this->input->post('otp'); 
       //$otp  = $this->input->post('otp');
      
        //$row = $this->Auth_model->verify_otp($otp);
       
                  
        $row = $this->Auth_model->verify_otp($otp,$mobile);
       
        if ($row) {
          
             $array = array(

                'status'=>true,
                'msg'   =>"OTP Verified Successfuly"
               );
       	  $this->response($array, 200); 

      }

      else{
 
           $array = array(

                'status'=>false,
                'msg'   =>"OTP is not verified"
               );
       	  $this->response($array, 200); 

      }
}

  else{

         $array = array(

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }

}
  

   public function resendotp_post(){

          $mobile = $this->input->post("mobile");
          $otp = mt_rand(100000,999999);
           
          $arr = array(
               'phone_no' =>$mobile,
               'otp'      =>$otp,
              );
                   
        $row = $this->Auth_model->register('tbl_otp',$arr);
       
        if ($row) {
          
          
        $array = array(

                'status'=>true,
                'msg'   =>'OTP sent to your registered mobile'
               );
       	 $this->response($array, 200);

  }else{

       $array = array(

                'status'=>false,
                'msg'   =>'Error!'
               );
       	 $this->response($array, 200);

  }

}


public function loginwithpassword_post(){
     $this->form_validation->set_rules('mobileemail','mobileemail','required'); 
     $this->form_validation->set_rules('password','Password','required');    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {
       
       $mobileemail  = $this->input->post('mobileemail');
       $pw  = $this->input->post('password'); 
       
       $res =  $this->Auth_model->login($mobileemail,$pw);
              
        if ($res) {
          
             $array = array(

                'status'=>true,
                'msg'   =>" Logged in Successfuly"
               );
       	  $this->response($array, 200); 

      }

      else{
 
           $array = array(

                'status'=>false,
                'msg'   =>"Invalid Credentials!"
               );
       	  $this->response($array, 200); 

      }
}

  else{

         $array = array(

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }

}





//............................Get IP address....................


private function getIp() {
		
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

}