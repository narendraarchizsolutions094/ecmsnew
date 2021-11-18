<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/*use Restserver\Libraries\REST_Controller;
*/
/*require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
namespace Restserver\Libraries;*/
// error_reporting(E_ALL);
// ini_set('display_errors', 1); //ADD this line.
class Volunteer_details extends MY_Controller{

 function __construct()
    {
        parent::__construct();  
     //   $this->load->helper('security'); 
      $this->load->model(array('Auth_model','Volunteer_model'));    
      $this->load->library(array('ion_auth','form_validation'));  
      $this->load->library('file_upload');
    }
    
   
public function volunteerlisting_post(){

    $this->form_validation->set_rules('mobile','Mobile','required');
    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

       $mobile  = $this->input->post('mobile');
              
       $res =  $this->Auth_model->get_userid($mobile);
              
        if ($res) {
          
            $id = $res['id'];

          $result =  $this->Volunteer_model->get_volunteerlist($id);
          if($result){

       	 
         $this->response([

                  'status'=>true,
              
                  'volunteer'=>$result,  
            
               
               ],200);
          }
           else{
 
           $array = array(

                'status'=>false,
                'msg'   =>"Not Available"
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
}

  else{

         $array = array(

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }

}


public function voterlist_post(){

    $this->form_validation->set_rules('mobile','Mobile','required');
    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

       $mobile  = $this->input->post('mobile');
              
      $res =  $this->Auth_model->get_userid($mobile);
              
      if ($res) {
          
            $id = $res['id'];

      $result =  $this->Volunteer_model->get_voterlist($id);
      if($result){

         $this->response([

                  'status'=>true,
              
                  'voter'=>$result,  
            
               
               ],200);
          }
           else{
 
           $array = array(

                'status'=>false,
                'msg'   =>"Not Available"
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
}

  else{

         $array = array(

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }

}


public function qrcodelist_post(){

 $this->form_validation->set_rules('mobile','Mobile','required');
    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

      $mobile  =  $this->input->post('mobile');
              
      $res     =  $this->Auth_model->get_userid($mobile);
              
      if ($res) {
          
       $id = $res['id'];
       
      $result =  $this->Volunteer_model->get_qrcodelist($id);
      if($result){

         $this->response([

                  'status'=>true,
              
                  'QR Code'=>$result,  
            
               
               ],200);
          }
           else{
 
           $array = array(

                'status'=>false,
                'msg'   =>"Not Available"
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
}

  else{

         $array = array(

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }
}


public function voteradd_post(){


     $this->form_validation->set_rules('name','Name','required');
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('age','Age','required');
    $this->form_validation->set_rules('voter_id','Voter Id','required');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('voter_cat','Voter Category','required');
    $this->form_validation->set_rules('contacted','Contacted','required');
    $this->form_validation->set_rules('address','Address','required');
    $this->form_validation->set_rules('mobile','Phone','required');
    $this->form_validation->set_rules('sex','Gender','required');
    $this->form_validation->set_rules('birthdate','Birthdate','required');
    $this->form_validation->set_rules('ward_no','Ward No','required');
    $this->form_validation->set_rules('marital_status','Marital Status','required');
    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {
     
         $data = array();
     	 $path = './uploads/';
            if(!file_exists($path))
            {
              mkdir($path);
            }
            $config['upload_path']   = $path; 
            $config['allowed_types'] = 'jpeg|jpg|png'; 
            $config['max_size']      = 3486000; 
            $config['encrypt_name']  = true; 

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
        
            $this->upload->do_upload('image');

            $fileData = $this->upload->data();
            $userpic = $path.$fileData['file_name'];
         
            // print_r($userpic);exit;
            // $this->upload->clear();
            $config1['upload_path']   = $path; 
            $config1['allowed_types'] = 'jpeg|jpg|png'; 
            $config1['max_size']      = 3486000; 
            $config1['encrypt_name']  = true; 
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
            $this->upload->do_upload('votercard_img');

            $fileData1 = $this->upload->data();
            $voterid = $path.$fileData1['file_name'];
           
      
      $arr  = array(

         'img_url'=>$userpic,
         'img_url1'=>$voterid,
      	 'name'=> $this->input->post('name'),
      	 'email'=> $this->input->post('email'),
      	 'age'=> $this->input->post('age'),
      	 'voter_id'=> "123435",
      	 'category'=> $this->input->post('voter_cat'),
      	 'contacted'=> $this->input->post('contacted'),
      	 'address'=> $this->input->post('address'),
      	 'phone'=> $this->input->post('mobile'),
      	 'sex'=> $this->input->post('sex'),
      	 'birthdate'=> $this->input->post('birthdate'),
      	 'ward_no'=> $this->input->post('ward_no'),
      	 'bloodgroup'=> $this->input->post('bloodgroup'),
      	 'marital_status'=> $this->input->post('marital_status'),
      	 'how_added'=> $this->input->post('remark'),
      	 'add_date'=>date('d-m-Y'),
      	 'party_id'=>'433'

          );
        
         $arr1  = array(
         'ip_address'=>$this->getIp(),
      	 'username'=> $this->input->post('name'),
      	 'password'=> password_hash($this->input->post('password'),PASSWORD_BCRYPT),
      	 'email'=> $this->input->post('email'),
      	 'phone'=> $this->input->post('mobile'),
      	 );


              
      $res_voter =  $this->Auth_model->register('voter',$arr);
      $res_user =  $this->Auth_model->register('users',$arr1);        
      if ($res_voter) {
          
           $array = array(

                'status'=>true,
                'msg'   =>"Voter Added Successfuly"
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

                'status'=>true,
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }


}

public function volunteeradd_post(){


    $this->form_validation->set_rules('name','Name','required');
    $this->form_validation->set_rules('email','Email','required');
    $this->form_validation->set_rules('age','Age','required');
    $this->form_validation->set_rules('voter_id','Voter Id','required');
    $this->form_validation->set_rules('password','Password','required');
    $this->form_validation->set_rules('voter_cat','Voter Category','required');
    $this->form_validation->set_rules('contacted','Contacted','required');
    $this->form_validation->set_rules('address','Address','required');
    $this->form_validation->set_rules('mobile','Phone','required');
    $this->form_validation->set_rules('sex','Gender','required');
    $this->form_validation->set_rules('birthdate','Birthdate','required');
    $this->form_validation->set_rules('ward_no','Ward No','required');
    $this->form_validation->set_rules('marital_status','Marital Status','required');
    
     $this->form_validation->set_message('required', 'Invalid %s');
    
     if ($this->form_validation->run() == true) {

     	 $mobile  =  $this->input->post('volunteermobile');
              
       $res     =  $this->Auth_model->get_userid($mobile);

       $data = array();
       $path = './uploads/';
            if(!file_exists($path))
            {
              mkdir($path);
            }
            $config['upload_path']   = $path; 
            $config['allowed_types'] = 'jpeg|jpg|png'; 
            $config['max_size']      = 3486000; 
            $config['encrypt_name']  = true; 

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
        
            $this->upload->do_upload('image');

            $fileData = $this->upload->data();
            $userpic = $path.$fileData['file_name'];
         
            // print_r($userpic);exit;
            // $this->upload->clear();
            $config1['upload_path']   = $path; 
            $config1['allowed_types'] = 'jpeg|jpg|png'; 
            $config1['max_size']      = 3486000; 
            $config1['encrypt_name']  = true; 
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
            $this->upload->do_upload('votercard_img');

            $fileData1 = $this->upload->data();
            $voterid = $path.$fileData1['file_name'];


        $arr  = array(
         'img_url'=> $userpic,
      	 'name'=> $this->input->post('name'),
      	 'email'=> $this->input->post('email'),
      	 'age'=> $this->input->post('age'),
      	 'voter_id'=> $this->input->post('voter_id'),
      	 'category'=> $this->input->post('voter_cat'),
      	 'contacted'=> $this->input->post('contacted'),
      	 'address'=> $this->input->post('address'),
      	 'phone'=> $this->input->post('mobile'),
      	 'sex'=> $this->input->post('sex'),
      	 'birthdate'=> $this->input->post('birthdate'),
      	 'ward_no'=> $this->input->post('ward_no'),
      	 'bloodgroup'=> $this->input->post('bloodgroup'),
      	 'marital_status'=> $this->input->post('marital_status'),
      	 'voter_id_card'=>$voterid,
      	 'ion_user_id'=> $res['id'],
      	 'add_date'=>date('d-m-Y'),
      	 'party_id'=>'433'

          );
        
         $arr1  = array(
         'ip_address'=>$this->getIp(),
      	 'username'=> $this->input->post('name'),
      	 'password'=> password_hash($this->input->post('password'),PASSWORD_BCRYPT),
      	 'email'=> $this->input->post('email'),
      	 'phone'=> $this->input->post('mobile'),
      	 );


              
      $res_voter =  $this->Auth_model->register('volunteer',$arr);
      $res_user =  $this->Auth_model->register('users',$arr1);        
      if ($res_voter && $res_user) {
          
           $array = array(

                'status'=>true,
                'msg'   =>"Volunteer Added Successfuly"
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
                'msg'   =>str_replace(array("\n", "\r"), ' ', strip_tags(validation_errors()))
               );
       	 $this->response($array, 200); 

      }

}


public function wardno_post(){


	$res = $this->Volunteer_model->get_wardno();
	if($res){

     $array = array(

                'status'=>true,
                'wardno'   =>$res
               );
       	 $this->response($array, 200); 

	}
	else{

		$array = array(

                'status'=>true,
                'msg'   =>"Error!"
               );
       	 $this->response($array, 200); 
	}
}

public function category_post(){


	$res = $this->Volunteer_model->get_category();
	if($res){

     $array = array(

                'status'=>true,
                'wardno'   =>$res
               );
       	 $this->response($array, 200); 

	}
	else{

		$array = array(

                'status'=>true,
                'msg'   =>"Error!"
               );
       	 $this->response($array, 200); 
	}
}



// ........................Get Ip address......................................................................................

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

?>