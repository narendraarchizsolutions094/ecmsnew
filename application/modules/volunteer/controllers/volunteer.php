<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Volunteer extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('volunteer_model');
        $this->load->model('area/area_model');
        $this->load->model('voter/voter_model');
		$this->load->model('voter_model');
        $this->load->model('donor/donor_model');
        $this->load->model('finance/finance_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
		        $this->load->database();
       /*--- if (!$this->ion_auth->in_group(array('admin', 'Volunteer'))) {
            redirect('home/permission');
        }*/
    }

public function user_notice() {

        $data['notices'] = $this->volunteer_model->getNotice();
        $data['settings'] = $this->volunteer_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('notice/user_notice', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function index() {
        $data['volunteers'] = $this->volunteer_model->getVolunteer();
        $data['areas'] = $this->area_model->getArea();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('volunteer', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $data['areas'] = $this->area_model->getArea();
		 
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

	$id = $this->input->post('id');
        $redirect = $this->input->get('redirect');
        $name = $this->input->post('name');
        if(!empty($this->input->post('password'))){
			$password = $this->input->post('password');
		}else{
        $password = '12345';
		}

        $category = $this->input->post('category');
        $contacted = $this->input->post('contacted');
        
        $marital_status = $this->input->post('optradio');
        $ward_no = $this->input->post('wardno');
        $remark = $this->input->post('remark');
        $age = $this->input->post('age');
        $voter_id = $this->input->post('voter_id');		
		
        $sms = $this->input->post('sms');
     //   $area = $this->input->post('area');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $voter_id = $this->input->post('voter_id');
			$Anniversary = $this->input->post('Anniversary');
        if (empty($voter_id)) {
            $voter_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('d-m-y');
            $registration_time = time();
        } else {
            $add_date = $this->volunteer_model->getVolunteerById($id)->add_date;
            $registration_time = $this->volunteer_model->getVolunteerById($id)->registration_time;
        }


        $email = $this->input->post('email');
        if (empty($email)) {
            $email = $name . '@archizsolutions.com';
        }



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Volunteer Field
        //   $this->form_validation->set_rules('volunteer', 'Volunteer', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', validation_errors());
                redirect('volunteer');
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['categorys'] = $this->volunteer_model->getVolunteerCategory();
                $data['areas'] = $this->area_model->getArea();
                $data['volunteers'] = $this->volunteer_model->getVolunteer();
                $data['groups'] = $this->donor_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
       $file_name = 'img'.time();

           
            $config = array(
                'file_name' => $file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
               // 'overwrite' => False,
              //  'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                //'max_height' => "1768",
               // 'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'voter_id' => $voter_id,
                    'img_url' => $img_url,
					'age' => $age,
                    'name' => $name,
                    'category' => $category,
                    'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                   // 'area' => $area,
				   'universary_date' => $Anniversary,
                    'phone' => $phone,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
                );
				
				$data1 = array(
				'party_id' => $this->session->userdata('party_id'),
				'disposition' => $contacted,
				'remark' => $remark,
				'created_by' => $this->session->userdata('user_id'),
				
			);
			$file_name = 'img'.time();
			  $config = array(
                'file_name' => $file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                //'overwrite' => False,
               // 'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
               // 'max_height' => "1768",
               // 'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url1')) {
				$path = $this->upload->data();
                $img_url1 = "uploads/" . $path['file_name'];
				
				$data = array();
                $data = array(
                    'voter_id' => $voter_id,
                    'img_url' => $img_url,
					'voter_id_card' => $img_url1,
					'age' => $age,
                    'name' => $name,
                    'category' => $category,
                    'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                    //'area' => $area,
					'universary_date' => $Anniversary,
                    'phone' => $phone,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
                );
				
				$data1 = array(
				'party_id' => $this->session->userdata('party_id'),
				'disposition' => $contacted,
				'remark' => $remark,
				'created_by' => $this->session->userdata('user_id'),
				
			);
			}	
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'voter_id' => $voter_id,
                    'name' => $name,
					'age' => $age,
                    'category' => $category,
                    'contacted' => $contacted,
                    'email' => $email,
                   // 'area' => $area,
                    'address' => $address,
                    'phone' => $phone,
                    'sex' => $sex,
					'marital_status' => $marital_status,
					'ward_no' => $ward_no,
                    'birthdate' => $birthdate,
                    'bloodgroup' => $bloodgroup,
                    'add_date' => $add_date,
                    'registration_time' => $registration_time
                );
			
            }
			$data1 = array(
				'party_id' => $this->session->userdata('party_id'),
				'disposition' => $contacted,
				'remark' => $remark,
				'created_by' => $this->session->userdata('user_id'),
				
			);
			
			 if ($this->ion_auth->in_group(array('admin'))) {
				$position_array=array();
				$position_array = array(
				'team_positon_id' => implode(',',$this->input->post('position')),
				'user_id' => $id,
                 );   
			   }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Voter
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('volunteer');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->volunteer_model->insertVolunteer($data);
					
                    $voter_user_id = $this->db->get_where('volunteer', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $this->session->userdata('user_id'));
					
                    $this->volunteer_model->updateVolunteer($voter_user_id, $id_info);
                    $this->volunteer_model->inserchengedisposition($data1,$id);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $this->party_id);
                  
                    if (!empty($sms)) {
                        $this->sms->sendSmsDuringVoterRegistration($voter_user_id);
                    }
                      if ($this->ion_auth->in_group(array('admin'))) {
				     $position_array=array();
				     $position_array = array(
				     'team_positon_id' => implode(',',$this->input->post('position')),
				     'user_id' => $voter_user_id,
                     );   

						  
                       if(!empty($this->input->post('position'))){
						 $this->db->insert('tbl_team_position',$position_array);  
					   }
					  }

                    $this->session->set_flashdata('feedback', 'Added');
                }
                //    }
            } else { // Updating Voter
                $ion_user_id = $this->db->get_where('volunteer', array('id' => $id))->row()->email;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('email' => $ion_user_id))->row()->password;
                } else {
                   $password = $this->ion_auth_model->hash_password($password);
                }
               // $this->volunteer_model->updateIonUser($username, $email, $password, $id);
			   //echo $id;
			    //$password = $this->ion_auth_model->hash_password($password);
		//print_r($email);exit;
			   $this->volunteer_model->updateIonUser($username, $email,$phone, $password, $ion_user_id);
                $this->volunteer_model->updateVolunteer($id, $data);
				$this->volunteer_model->inserchengedisposition($data1,$id);
				if ($this->ion_auth->in_group(array('admin'))){
					$ion_user_id = $this->db->get_where('tbl_team_position', array('user_id' => $id))->row();
					if(!empty($ion_user_id)){
                       if(!empty($this->input->post('position'))){
						 $this->db->where('user_id',$id);
						 $this->db->update('tbl_team_position',$position_array);
					   }
					  }else{
						 if(!empty($this->input->post('position'))){
						 $this->db->insert('tbl_team_position',$position_array);
					   }
					  }
				}
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            
                redirect('volunteer');
            
        }
    }

    function editVolunteer($id='') {
        $data = array();
        $data['areas'] = $this->area_model->getArea();
		$data['Dispostion'] = $this->volunteer_model->getDispostion();
        $data['categorys'] = $this->volunteer_model->getVolunteerCategory();
        $data['voter'] = $this->volunteer_model->getVolunteerById($id);
		$data['all_voter'] = $this->volunteer_model->getVolunteer($id);
		$data['all_ward'] = $this->volunteer_model->getward();
        $data['volunteers'] = $this->volunteer_model->getVolunteer();
        $data['groups'] = $this->donor_model->getBloodBank();
       // $data['patient'] = $this->volunteer_model->getVolunteerById($id);
		$data['timeline'] = $this->volunteer_model->gettimelineById($id);
		$data['position'] = $this->db->get('tbl_position')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function details() {

        $data = array();

        if ($this->ion_auth->in_group(array('Volunteer'))) {
            $volunteer_ion_id = $this->ion_auth->get_user_id();
            $id = $this->volunteer_model->getVolunteerByIonUserId($volunteer_ion_id)->id;
        } else {
            redirect('home');
        }

        $data['volunteer'] = $this->volunteer_model->getVolunteerById($id);
        $data['voters'] = $this->voter_model->getVoter();
        $data['volunteers'] = $this->volunteer_model->getVolunteer();

        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editVolunteerByJason() {
        $id = $this->input->get('id');
        $data['volunteer'] = $this->volunteer_model->getVolunteerById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('volunteer', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->email;
        $this->db->where('email', $ion_user_id);
        $this->db->delete('users');
        $this->volunteer_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('volunteer');
    }

    function getVolunteer() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['volunteers'] = $this->volunteer_model->getVolunteerBysearch($search);
            } else {
             //   $data['volunteers'] = $this->volunteer_model->getVolunteer();
            }
        } else {
            if (!empty($search)) {
                $data['volunteers'] = $this->volunteer_model->getVolunteerByLimitBySearch($limit, $start, $search);
            } else {
                $data['volunteers'] = $this->volunteer_model->getVolunteerByLimit($limit, $start);
            }
        }
   // print_r($data['volunteers']);
        foreach ($data['volunteers'] as $voter){
			$name='';
			      $explode_position=explode(',',$voter->team_positon);
                 foreach ($explode_position as $pos) {
            	$name.= $this->db->get_where('tbl_position', array('id' => $pos))->row()->degination.' ';	
		         }
           $chec_box='<input type="checkbox" name="email_send[]" class="checkbox1" value="' . $voter->id . '">';

             
             $options2 = ' <a class="btn detailsbutton inffo" title="' . lang('info') . '"  href="' .base_url().'volunteer/editVolunteer/'.$voter->id . '"><i class="fa fa-eye"> </i> </a>';
          

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Volunteer','Voter'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="volunteer/delete?id=' . $voter->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i></a>';
            }

            $options6 = ' <a class="btn detailsbutton inffo" title="' . lang('info') . '"  href="' .base_url().'volunteer/editVolunteer/'.$voter->id . '"><i class="fa fa-eye"> </i> </a>';

            if ($this->ion_auth->in_group(array('admin','Voter'))) {
                $info[] = array(
                    $chec_box,
                    $voter->id,
                    $voter->name,
                    $voter->phone,
					$voter->word_name,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,$name,
                    $options6 . ' ' . $options5,
					
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $info[] = array(
                    $chec_box,
                    $voter->id,
                    $voter->name,
                    $voter->phone,
					$voter->word_name,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,$name,
                    $options6 . ' ' . $options4,
				    
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Volunteer'))) {
                $info[] = array(
                    $chec_box,
                    $voter->id,
                    $voter->name,
                    $voter->phone,
					$voter->word_name,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,$name,
                    $options6 . ' ' . $options3,
					
                        //  $options2
                );
            }
        }

        if (!empty($data['volunteers'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('volunteer')->num_rows(),
                "recordsFiltered" => $this->db->get('volunteer')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

}

/* End of file volunteer.php */
/* Location: ./application/modules/volunteer/controllers/volunteer.php */