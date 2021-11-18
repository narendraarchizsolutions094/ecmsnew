<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Party extends MX_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('sms/sms_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
        $this->load->model('party_model');
        $this->db->where('party_id', 'superadmin');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        ;
        $this->load->model('settings/settings_model');
       
    }

    public function index() {
        $data['partys'] = $this->party_model->getParty();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('party', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $language = $this->input->post('language');

        $language_array = array('english', 'spanish', 'french', 'italian', 'portuguese');

        if (!in_array($language, $language_array)) {
            $language = 'english';
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[50]|xss_clean');

        // Validating Phone Field           
        $this->form_validation->set_rules('language', 'Language', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("party/editParty?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone
            );

            $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Party
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', 'This Email Address Is Already Registered');
                    redirect('party/addNewView');
                } else {
                    $dfg = 10;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->party_model->insertParty($data);
                    $party_user_id = $this->db->get_where('party', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->party_model->updateParty($party_user_id, $id_info);
                    $party_settings_data = array();
                    $party_settings_data = array('party_id' => $party_user_id,
                        'title' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'language' => $language,
                        'system_vendor' => 'Election Campaign management System',
                        'discount' => 'flat',
                        'currency' => '$'
                    );
                    $this->settings_model->insertSettings($party_settings_data);
                   

                    $data_sms = array();
                    $data_sms = array(
                        'username' => 'Your ClickAtell Username',
                        'password' => 'Your ClickAtell Password',
                        'api_id' => 'Your ClickAtell Api Id',
                        'user' => $this->ion_auth->get_user_id(),
                        'party_id' => $party_user_id
                    );

                    $this->sms_model->addSmsSettings($data_sms);
                    $this->session->set_flashdata('feedback', 'New Party Created');
                }
            } else { // Updating Party
                $ion_user_id = $this->db->get_where('party', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->party_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->party_model->updateParty($id, $data);



                $party_settings_data = array();
                $party_settings_data = array(
                    'language' => $language,
                );
                $this->settings_model->updateSettingsByHId($id, $party_settings_data);


                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('party');
        }
    }

    function getParty() {
        $data['partys'] = $this->party_model->getParty();
        $this->load->view('party', $data);
    }

    function activate() {
        $party_id = $this->input->get('party_id');
        $data = array('active' => 1);
        $this->party_model->activate($party_id, $data);
        $this->session->set_flashdata('feedback', 'Activated');
        redirect('party');
    }

    function deactivate() {
        $party_id = $this->input->get('party_id');
        $data = array('active' => 0);
        $this->party_model->deactivate($party_id, $data);
        $this->session->set_flashdata('feedback', 'Deactivated');
        redirect('party');
    }

    function editParty() {
        $data = array();
        $id = $this->input->get('id');
        $data['party'] = $this->party_model->getPartyById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPartyByJason() {
        $id = $this->input->get('id');
        $data['party'] = $this->party_model->getPartyById($id);
        $data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('party', array('id' => $id))->row();
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->party_model->delete($id);
        redirect('party');
    }

}

/* End of file party.php */
/* Location: ./application/modules/party/controllers/party.php */
