<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->model('volunteer/volunteer_model');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
	/*	elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
        */        
		else
		{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			// $this->_render_page('auth/index', $data);
                        redirect('home', 'refresh');
		}
	}
    //*-----web form----
	function web_from($id1='',$id2='')
	{   
		
		
	          $data['id1']=$id1;
	          $data['id2']=$id2;
			  $data['getword'] = $this->ion_auth->getword($id1);
              $this->load->view('web_from', $data);
	}
	function register($id1='',$id2='')
	{         $data['id1']=433;
	          $data['id2']=867;
			  $data['getword'] = $this->ion_auth->getword('433');
              $this->load->view('register', $data);
	}
	
	public function verify_otp() {
		$otp = $this->input->post('otp');
        $phone = $this->input->post('phone');
		$password = base64_decode($this->input->post('password'));
        $data1 = $this->input->post('data1');
		$data2 = $this->input->post('data2');
		$this->db->where('phone_no',base64_decode($phone));
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$exist_otp = $this->db->get('tbl_otp')->row()->otp;
		
		if($exist_otp==$otp){
			$register=json_decode(base64_decode($data1));
			$register1=json_decode(base64_decode($data2));
			
			 $register2 = array_merge($register, $register1);
			 $username=$register->name;
			 $email=$register->email;;
			 $user_id=$register->ion_user_id;
			 $party_id=$register->party_id;
			 $dfg = 5;
					$this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->volunteer_model->insertVolunteers($register);
                    $volunteer_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $user_id);
                    $this->volunteer_model->updateVolunteer($volunteer_user_id, $id_info);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $party_id);
					
                    $this->session->set_flashdata('feedback', 'Your details submitted successfully.');
				
					redirect('auth/register/');
		}else{
		            $this->session->set_flashdata('feedback1','Invalid otp');
			        $datas['from1']=$data1;
				    $datas['from2']=$data2;
					$datas['phone']=$phone;
					$datas['password']=base64_encode($password);
                    $this->load->view('otp', $datas);
		}
     
	}			
	public function addNewuser() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
		if(!empty($this->input->post('password'))){
			   $password = $this->input->post('password');
		}else{
			  $password = '12345';
		}
        
        $marital_status = $this->input->post('optradio');
        $ward_no = $this->input->post('wardno');
        $dob = $this->input->post('dob');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
		$age = $this->input->post('age');
        $birthdate = $this->input->post('birthdate');
        $voter_id = $this->input->post('voter_id');
		$Voterid = $this->input->post('Voterid');
		$party_id = $this->input->post('party_id');
		$user_id = $this->input->post('user_id');
		$Anniversary = $this->input->post('Anniversary');
        
        $email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@archizsolutions.com';
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
        $exist_phone = $this->db->get_where('volunteer', array('phone' => $phone))->row()->id;
        if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('feedback1', validation_errors());
			   redirect('auth/register/');
        } else {
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'add_date' => date('d-m-y'),
					'party_id' => $party_id,
					'ion_user_id' => $user_id,
                   );
            
			$data1 = array(
				'user_id' => $user_id,
				'party_id' => $party_id,
				'disposition' =>'updated',
				'remark' => json_encode($data),
				'created_by' => $user_id,
				
			     );
            $username = $this->input->post('name');
	             $otp = rand(100000,999999);
	           if(empty($exist_phone)){
				   $otp_detail=array(
				   'phone_no' => $phone,
				   'otp' => $otp
				   );
				   $datas['from1']=base64_encode(json_encode($data));
				    $datas['from2']=base64_encode(json_encode($data1));
					$datas['phone']=base64_encode($phone);
					$datas['password']=base64_encode($password);
				    $this->db->insert('tbl_otp',$otp_detail);
					$msg='Namskar ! '.$otp.' is one time password (OTP) for login  to ecms';
					$this->ion_auth->smssend($phone,$msg);
					$this->ion_auth->sendwhatsapp('91'.$phone,$msg);
				    $datas['getword'] = 'OTP';
					//print_r($datas['from2']);exit();
                   $this->load->view('otp', $datas);
                  
                } else {
                      $this->session->set_flashdata('feedback1', 'This User already exits.Please SignIn');
                    redirect('auth/register/');  
                  					  
						
					/*
					 $dfg = 5;
					$this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->volunteer_model->insertVolunteer($data);
                    $volunteer_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $user_id);
                    $this->volunteer_model->updateVolunteer($volunteer_user_id, $id_info);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $party_id);
					
						
						 $this->session->set_flashdata('feedback', 'Your details submitted successfully.');

                   
					redirect('auth/register/');*/
			   }
            
        }
        }
		
		public function signupNewuser() {
        
        $phone = $this->input->post('phone');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[12]|xss_clean');
		$exist_phone = $this->db->get_where('volunteer', array('phone' => $phone))->row()->id;
        if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('feedback1', validation_errors());
			   redirect('auth/register/');
        } else {
            $phone = $this->input->post('phone');
	             $otp = rand(100000,999999);
	           if(empty($exist_phone)){
				   $otp_detail=array(
				   'phone_no' => $phone,
				   'otp' => $otp
				   );
				    $this->db->insert('tbl_otp',$otp_detail);
					$msg='Namskar ! '.$otp.' is one time password (OTP) for login  to ecms';
					$this->ion_auth->smssend($phone,$msg);
					$this->ion_auth->sendwhatsapp('91'.$phone,$msg);
				    $datas['phone'] = $phone;
                   $this->load->view('registers', $datas);
                  
                } else {
					$datas['phone'] = $phone;
                     $this->_render_page('auth/login', $datas); 
                   // redirect('auth/login/.'$phone');  
			   }
            
        }
        }
		
		public function resend_otp() {
        
        $phone = $this->uri->segment(3);
	             $otp = rand(100000,999999);
				   $otp_detail=array(
				   'phone_no' => $phone,
				   'otp' => $otp
				   );
				    $this->db->insert('tbl_otp',$otp_detail);
					$msg='Namskar ! '.$otp.' is one time password (OTP) for login  to ecms';
					$this->ion_auth->smssend($phone,$msg);
					$this->ion_auth->sendwhatsapp('91'.$phone,$msg);
				    $datas['phone'] = $phone;
                   $this->load->view('registers', $datas);
        }

	/*public function verify_otp_signup() {
		$otp = $this->input->post('otp');
        $phone = $this->input->post('phone');
		$this->db->where('phone_no',$phone);
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$exist_otp = $this->db->get('tbl_otp')->row()->otp;
		
		if($exist_otp==$otp){
				    
					$data['phone'] = $phone;
					$data['id1']=433;
	                $data['id2']=867;
			        $data['getword'] = $this->ion_auth->getword('433');
					$this->load->view('regier_data',$data);
		}else{
		            $this->session->set_flashdata('feedback1','Invalid otp');
					$datas['phone'] = $phone;
                    $this->load->view('registers',$datas);
		}
     
	}*/
	
	
		public function signup_addNewuser() {
		$otp = $this->input->post('otp');
        $phone = $this->input->post('phone');
		$this->db->where('phone_no',$phone);
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$exist_otp = $this->db->get('tbl_otp')->row()->otp;
		
		if($exist_otp==$otp){
        $name = 'demouser';
		if(!empty($this->input->post('password'))){
			   $password = $this->input->post('password');
		}else{
			  $password = '12345';
		}
        $phone = $this->input->post('phone');
		$party_id = $this->input->post('party_id');
		$user_id = $this->input->post('user_id');
		$email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@archizsolutions.com';
        }
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'add_date' => date('d-m-y'),
					'party_id' => $party_id,
					'ion_user_id' => $user_id,
                   );	
					
					 $dfg = 5;
					$this->ion_auth->register($name, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->volunteer_model->insertVolunteer($data);
                    $volunteer_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $user_id);
                    $this->volunteer_model->updateVolunteer($volunteer_user_id, $id_info);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $party_id);

              if ($this->ion_auth->login($phone, $password))
			{
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');
			}
			}else{
		            $this->session->set_flashdata('feedback1','Invalid otp');
					$datas['phone'] = $phone;
                    $this->load->view('registers',$datas);
		}
        }
	
	
	 public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
		if(!empty($this->input->post('password'))){
			   $password = $this->input->post('password');
		}else{
			  $password = '12345';
		}
        
        $marital_status = $this->input->post('optradio');
        $ward_no = $this->input->post('wardno');
        $dob = $this->input->post('dob');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
		$age = $this->input->post('age');
        $birthdate = $this->input->post('birthdate');
        $voter_id = $this->input->post('voter_id');
		$Voterid = $this->input->post('Voterid');
		$party_id = $this->input->post('party_id');
		$user_id = $this->input->post('user_id');
		$Anniversary = $this->input->post('Anniversary');
        
        $email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@archizsolutions.com';
        }
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field

        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Volunteer Field
       // $this->form_validation->set_rules('Voterid', 'Voter Id','is_unique[volunteer.voter_id]');
        $exist_phone = $this->db->get_where('volunteer', array('phone' => $phone))->row()->id;
        if ($this->form_validation->run() == FALSE) {
               $this->session->set_flashdata('feedback1', validation_errors());
					redirect('auth/web_from/'.$party_id.'/'.$user_id);
        } else {
             $filename = "img" . date('d-m-Y_H_i_s');;

            $config = array(
                'file_name' => $file_name,
                'upload_path' =>$_SERVER["DOCUMENT_ROOT"]."/uploads/",
				 'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                
               );
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url ="/uploads/".$path['file_name'];
                $data = array();
                $data = array(
                    'voter_id' => $Voterid,
                    'img_url' => $img_url,
                    'name' => $name,
                      // 'category' => $category,
                   // 'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                    'age' => $age,
                    'phone' => $phone,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $dob,
					'universary_date' => $Anniversary,
                    'add_date' => date('d-m-y'),
                    'registration_time' => time(),
					'party_id' => $party_id,
					'ion_user_id' => $user_id,
                );
			$filename = "img" . date('d-m-Y_H_i_s');;

            $config = array(
                'file_name' => $file_name,
                'upload_path' =>$_SERVER["DOCUMENT_ROOT"]."/uploads/",
				 'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                
               );
            $this->load->library('Upload', $config);
            $this->upload->initialize($config);	
			if ($this->upload->do_upload('voter_id')){
				$path = $this->upload->data();
                $img_url1 ="/uploads/".$path['file_name'];
				    $path = $this->upload->data();
                //$img_url ="/uploads/".$path['file_name'];
                $data = array();
                $data = array(
                    'voter_id' => $Voterid,
                    'img_url' => $img_url,
                    'name' => $name,
                     'voter_id_card' => $img_url1,
                   // 'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                    'age' => $age,
                    'phone' => $phone,
					'universary_date' => $Anniversary,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $dob,
                    'add_date' => date('d-m-y'),
                    'registration_time' => time(),
					'party_id' => $party_id,
					'ion_user_id' => $user_id,
                );
				$status_done=1;
			
			}
            
             			
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'voter_id' => $Voterid,
                    'img_url' => $img_url,
                    'name' => $name,
                   // 'category' => $category,
                   // 'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                    'age' => $age,
                    'phone' => $phone,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $dob,
					'universary_date' => $Anniversary,
                    'add_date' => date('d-m-y'),
                    'registration_time' => time(),
					'party_id' => $party_id,
					'ion_user_id' => $user_id,
                );
            }
			$data1 = array(
				'user_id' => $user_id,
				'party_id' => $party_id,
				'disposition' =>'updated',
				'remark' => json_encode($data),
				'created_by' => $user_id,
				
			     );
            $username = $this->input->post('name');
    // Addin
	           if(empty($exist_phone)){
                if ($this->ion_auth->email_check($email)) {
					 $data['getword'] = $this->ion_auth->getword($party_id);
                    $this->session->set_flashdata('feedback1', 'This Email Address Is Already Registered');
                    redirect('auth/web_from/'.$party_id.'/'.$user_id);
                } else {
                    $dfg = 5;			
					$this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->volunteer_model->insertVolunteer($data);
                    $volunteer_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $user_id);
                    $this->volunteer_model->updateVolunteer($volunteer_user_id, $id_info);
                   // $this->voter_model->inserchengedisposition($data1);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $party_id);
					if($status_done==1){
						$data_qr = array(
                        'name' => $name,
                        'assign_id' => $ion_user_id,
				        'qr_url' => 'http://whichsoftwareadvisor.com/auth/web_from/'.$party_id.'/'.$ion_user_id,
				          'user_id' => $user_id,
						'party_id' => $party_id,
                        );
						$message='http://whichsoftwareadvisor.com/auth/web_from/'.$party_id.'/'.$ion_user_id;
						$this->db->insert('qr_code',$data_qr);
						$this->ion_auth->smssend($phone,$message);
						$this->ion_auth->sendwhatsapp('91'.$phone,$message);
						$varhtml='Your details submitted successfully QR-code send to mobile your number<br><img  height="100px"  width="100px" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=&choe=UTF-8" /><br>
						<a href="https://api.whatsapp.com/send?text='.$message.'">Share</a>';
						$s=base64_encode($varhtml);
						$this->session->set_flashdata('feedback3', $s);
					}else{
						
						 $this->session->set_flashdata('feedback', 'Your details submitted successfully.');
					     }
					
                   
					redirect('auth/web_from/'.$party_id.'/'.$user_id);
			   }}else{
				   
				   $this->volunteer_model->updateVolunteer($exist_phone, $data);
				  // echo $email;
				  $idemail='';
				  $password = $this->ion_auth_model->hash_password($password);
				  $this->volunteer_model->updateIonUser($username, $email, $password, $idemail);
				    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
				   //print_r($email);exit;
				   $this->volunteer_model->inserchengedisposition($data1,$exist_phone);
            
				   if($status_done==1){
						$data_qr = array(
                        'name' => $name,
                        'assign_id' => $ion_user_id,
				        'qr_url' => 'http://whichsoftwareadvisor.com/auth/web_from/'.$party_id.'/'.$ion_user_id,
				        'user_id' => $user_id,
						'party_id' => $party_id,
                        );
						$message='http://whichsoftwareadvisor.com/auth/web_from/'.$party_id.'/'.$ion_user_id;
						$this->db->insert('qr_code',$data_qr);
						$this->ion_auth->smssend($phone,$message);
						$this->ion_auth->sendwhatsapp('91'.$phone,$message);
						
						$varhtml='Your details submitted successfully QR-code send to mobile your number<br><img  height="100px"  width="100px" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=&choe=UTF-8" /><br>
						<a href="https://api.whatsapp.com/send?text='.$message.'">Share</a>';
						$s=base64_encode($varhtml);
						$this->session->set_flashdata('feedback3', $s);
					}else{
						$this->session->set_flashdata('feedback', 'Your details updated successfully.Update full details for get QR-Code');
						///$this->session->set_flashdata('feedback',$);
					}
				   redirect('auth/web_from/'.$party_id.'/'.$user_id);
			   }
            
        }
        }

	
	

	//log the user in
	function login()
	{  
            if ($this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('home');
		}
		$data['title'] = "Login";
$identity=$this->input->post('identity');
$pass=$this->input->post('password');
if(!empty($identity) && empty($pass)){
	$identity = $this->input->post('identity');
		$exist_phone = $this->db->get_where('volunteer', array('phone' => $identity))->row()->id;
            $identity = $this->input->post('identity');
	             $otp = rand(100000,999999);
	           if(!empty($exist_phone)){
				   $otp_detail=array(
				   'phone_no' => $identity,
				   'otp' => $otp
				   );
				    $this->db->insert('tbl_otp',$otp_detail);
					$msg='Namskar ! '.$otp.' is one time password (OTP) for login  to ecms';
					$this->ion_auth->smssend($identity,$msg);
					$this->ion_auth->sendwhatsapp('91'.$identity,$msg);
				    $datas['phone'] = $identity;
                   $this->load->view('registers', $datas);
                  
                } else {
					$this->session->set_flashdata('feedback', 'You are not register User Enter Mobile to register');
				    redirect('auth/register', 'refresh'); 
			   }
		
		}else{
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('feedback', 'You are not register User Enter Mobile to register');
				redirect('auth/register', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			$this->_render_page('auth/login', $data);
		}
	}
	}

	//log the user out
	function logout()
	{
		$data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->_render_page('auth/change_password', $data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}


function forgoten_password() {
		
        $email = $this->input->post('email');
        //resetting user password here
        $password =  rand(100000000,20000000000);
        // Checking credential for admin
        $query = $this->db->get_where('users' , array('email' => $email));
		
        if ($query->num_rows() > 0)
        {
			$result = $query->result();
			$email  = $result[0]->email;
		$querys = $this->db->get_where('volunteer' , array('email' => $email));
        if ($querys->num_rows() > 0)
        {
			$results = $querys->result();
			$phone  = $results[0]->phone;
            //$this->ion_auth->smssend($phone,$password);
		
		//$this->volunteer_model->updatenewpassword($email,$password);
        $this->session->set_flashdata('message', 'please check your messagebox for new password');
		redirect('auth/login', 'refresh');
    }
		}
}	
	//forgot password
	function forgot_password()
	{
		//setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') == 'username' )
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			//setup the input
			$data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $data);
		}
		else
		{
			// get identity from username or email
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			}
			else
			{
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}
	            	if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') == 'username')
		            	{
                                   $this->ion_auth->set_message('forgot_password_username_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_message('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->messages());
                		redirect("auth/forgot_password", 'refresh');
            		}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;

				//render
				$this->_render_page('auth/reset_password', $data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	//create a new user
	function create_user()
	{
		$data['title'] = "Create User";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$tables = $this->config->item('tables','ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'));
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'));
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

			$this->_render_page('auth/create_user', $data);
		}
	}

	//edit a user
	function edit_user($id)
	{
		$data['title'] = "Edit User";

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				//update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}

					}
				}

			//check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	//redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	//redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		//display the edit user form
		$data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['user'] = $user;
		$data['groups'] = $groups;
		$data['currentGroups'] = $currentGroups;

		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->_render_page('auth/edit_user', $data);
	}

	// create a new group
	function create_group()
	{
		$data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $data);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
    function editVolunteerByJason() {
        $id = $this->input->get('id');
        $data['volunteer'] = $this->ion_auth->getVolunteerById($id);
        echo json_encode($data);
    }
	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}

}
