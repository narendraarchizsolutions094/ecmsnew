<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voter extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('voter_model');
        $this->load->model('donor/donor_model');
        $this->load->model('finance/finance_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
        $this->load->model('volunteer/volunteer_model');
        $this->load->model('area/area_model');
        $this->load->module('paypal');
        $this->load->library('Ion_auth');
        if (!$this->ion_auth->in_group(array('admin', 'Volunteer','users','Voter'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['areas'] = $this->area_model->getArea();
        $data['categorys'] = $this->voter_model->getVoterCategory();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('voter', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        if ($this->ion_auth->in_group(array('Voter'))) {
            redirect('home/permission');
        }
        $data = array();
        $data['areas'] = $this->area_model->getArea();
        $data['categorys'] = $this->voter_model->getVoterCategory();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
$id=$this->session->userdata('party_id');
print_r($id);exit;
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
        $area = $this->input->post('area');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $voter_id = $this->input->post('voter_id');
        if (empty($voter_id)) {
            $voter_id = rand(10000, 1000000);
        }
        if ((empty($id))) {
            $add_date = date('d-m-y');
            $registration_time = time();
        } else {
            $add_date = $this->voter_model->getVoterById($id)->add_date;
            $registration_time = $this->voter_model->getVoterById($id)->registration_time;
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
                $this->session->set_flashdata('feedback', 'Validation Error !');
                redirect("voter/voterDetails?id=$id");
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['categorys'] = $this->voter_model->getVoterCategory();
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
                    'area' => $area,
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
					'img_url1' => $img_url1,
					'age' => $age,
                    'name' => $name,
                    'category' => $category,
                    'contacted' => $contacted,
                    'email' => $email,
                    'address' => $address,
                    'area' => $area,
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
                    'area' => $area,
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
				
				
				$data1 = array(
				'party_id' => $this->session->userdata('party_id'),
				'disposition' => $contacted,
				'remark' => $remark,
				'created_by' => $this->session->userdata('user_id'),
				
			);
			
			
            }

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Voter
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('voter/voter');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $email,$phone, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->voter_model->insertVoter($data);
					
                    $voter_user_id = $this->db->get_where('voter', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $this->session->userdata('user_id'));
                    $this->voter_model->updateVoter($voter_user_id, $id_info);
                    $this->voter_model->inserchengedisposition($data1,$id);
                    $this->party_model->addPartyIdToIonUser($ion_user_id, $this->party_id);

                    if (!empty($sms)) {
                        $this->sms->sendSmsDuringVoterRegistration($voter_user_id);
                    }




                    $this->session->set_flashdata('feedback', 'Added');
                }
                //    }
            } else { // Updating Voter
                $ion_user_id = $this->db->get_where('voter', array('id' => $id))->row()->email;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('email' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->voter_model->updateIonUser($username, $email,$phone, $password, $ion_user_id);
                $this->voter_model->updateVoter($id, $data);
				$this->voter_model->inserchengedisposition($data1,$id);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            if (!empty($redirect)) {
                redirect('finance/addPaymentView');
            } else {
                redirect('voter');
            }
        }
    }

    function editVoter() {
        $data = array();
        $id = $this->input->get('id');
        $data['voter'] = $this->voter_model->getVoterById($id);
        $data['volunteers'] = $this->volunteer_model->getVolunteer();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editVoterByJason() {
        $id = $this->input->get('id');
        $data['voter'] = $this->voter_model->getVoterById($id);
        echo json_encode($data);
    }

    function getVoterByJason() {
        $id = $this->input->get('id');
        $data['voter'] = $this->voter_model->getVoterById($id);

        $area = $data['voter']->area;
        $data['area'] = $this->area_model->getAreaById($area);

        if (!empty($data['voter']->birthdate)) {
            $birthDate = strtotime($data['voter']->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        echo json_encode($data);
    }

    function voterDetails($id='') {
        $data = array();
        $data['areas'] = $this->area_model->getArea();
		$data['Dispostion'] = $this->voter_model->getDispostion();
        $data['categorys'] = $this->voter_model->getVoterCategory();
        $data['voter'] = $this->voter_model->getVoterById($id);
		$data['all_voter'] = $this->voter_model->getVoter($id);
		$data['all_ward'] = $this->voter_model->getward();
        $data['volunteers'] = $this->volunteer_model->getVolunteer();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['patient'] = $this->voter_model->getVoterById($id);
		$data['timeline'] = $this->voter_model->gettimelineById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details_voter', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('myInvoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }


    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('voter', array('id' => $id))->row();
        $path = $user_data->img_url;
		$path1 = $user_data->img_url1;

        if (!empty($path || $path1)) {
            unlink($path);
			unlink($path1);
        }
        $ion_user_id = $user_data->email;
        $this->db->where('email', $ion_user_id);
        $this->db->delete('users');
        $this->voter_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('voter');
    }

    public function voterCategory() {
        $data['categorys'] = $this->voter_model->getVoterCategory();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('voter_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addVotercategoryView() {
        $data = array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_voter_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addVoterCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        $this->form_validation->set_rules('category', 'Voter Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Description Field
        $this->form_validation->set_rules('description', 'Voter Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("voter/editVoterCategory?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new_voter_category', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description,
            );


            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Voter
                $this->voter_model->insertVoterCategory($data);
                redirect('voter/voterCategory');
            } else { // Updating Voter
                $this->voter_model->updateVoterCategory($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect('voter/voterCategory');
            }
            // Loading View
        }
    }

    function getVoterCatory() {
        $data['voter'] = $this->voter_model->getVoter();
        $this->load->view('voter', $data);
    }

    function editVoterCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['category'] = $this->voter_model->getVoterCategoryById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_voter_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editVotercategoryByJason() {
        $id = $this->input->get('id');
        $data['category'] = $this->voter_model->getVoterCategoryById($id);
        echo json_encode($data);
    }

    function deleteVoterCategory() {
        $data = array();
        $id = $this->input->get('id');
        $this->voter_model->deleteVoterCategory($id);
        redirect('voter/voterCategory');
    }

    function getVoter() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
            
       if ($limit == -1) {
            if (!empty($search)) {
                $data['voters'] = $this->voter_model->getVoterBysearch($search);
            } else {
                $data['voters'] = $this->voter_model->getVoter();
            }
        } else {
            if (!empty($search)) {
                $data['voters'] = $this->voter_model->getVoterByLimitBySearch($limit, $start, $search);
            } else {
                $data['voters'] = $this->voter_model->getVoterByLimit($limit, $start);
            }
        }
        foreach ($data['voters'] as $voter) {
           $chec_box='<input type="checkbox" name="email_send[]" class="checkbox1" value="' . $voter->id . '">';


             $options2 = ' <a class="btn detailsbutton inffo" title="' . lang('info') . '"  href="' .base_url().'voter/voterDetails/'.$voter->id . '"><i class="fa fa-eye"> </i> </a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Laboratorist', 'Nurse', 'Volunteer','Voter'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="voter/delete?id=' . $voter->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash-o"></i></a>';
            }

            $options6 = ' <a class="btn detailsbutton inffo" title="' . lang('info') . '"  href="' .base_url().'voter/voterDetails/'.$voter->id . '"><i class="fa fa-eye"> </i> </a>';

            if ($this->ion_auth->in_group(array('admin','Voter'))) {
                $info[] = array(
                    $chec_box,
                    $voter->voter_id,
                    $voter->name,
                    $voter->phone,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,
                    $options6 . ' ' . $options5,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                $info[] = array(
                    $chec_box,
                    $voter->voter_id,
                    $voter->name,
                    $voter->phone,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,
                    $options6 . ' ' . $options4,
                        //  $options2
                );
            }

            if ($this->ion_auth->in_group(array('Volunteer'))) {
                $info[] = array(
                    $chec_box,
                    $voter->voter_id,
                    $voter->name,
                    $voter->phone,
                    $voter->created_by,
					$voter->add_date,
					$voter->update_date,
                    $options6 . ' ' . $options3,
                        //  $options2
                );
            }
        }

        if (!empty($data['voters'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('voter')->num_rows(),
                "recordsFiltered" => $this->db->get('voter')->num_rows(),
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

/* End of file voter.php */
    /* Location: ./application/modules/voter/controllers/voter.php */
    