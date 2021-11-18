<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('profile_model');
		$this->load->model('volunteer/volunteer_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
		//echo $this->session->userdata('email');
		$data['all_ward'] = $this->volunteer_model->getward();
		$data['voter'] = $this->volunteer_model->getVolunteerByemail($this->session->userdata('email'));
		//print_r($data['voter']);exit();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('view_profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	public function edit_profile() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['profile'] = $this->profile_model->getProfileById($id);
		//echo $this->session->userdata('email');
		$data['all_ward'] = $this->volunteer_model->getward();
		$data['voter'] = $this->volunteer_model->getVolunteerByemail($this->session->userdata('email'));
		//print_r($data['voter']);exit();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
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
					redirect('profile'.$party_id.'/'.$user_id);
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
				         if (!$this->ion_auth->in_group(array('admin'))) {
				   $this->volunteer_model->updateVolunteer($exist_phone, $data);
						 }
				  $idemail=$email;
				   $password = $this->ion_auth_model->hash_password($password);
				  $this->volunteer_model->updateIonUser($username, $email, $password, $idemail);
				    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
				   //print_r($email);exit;
				   $this->volunteer_model->inserchengedisposition($data1,$exist_phone);
                    $this->session->set_flashdata('feedback', 'Updated');
				   redirect('profile');
			   
            
        }
        }

	
}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
