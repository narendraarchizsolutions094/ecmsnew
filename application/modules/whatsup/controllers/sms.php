<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('sms_model');
        $this->load->model('voter/voter_model');
        $this->load->model('area/area_model');
        $this->load->model('donor/donor_model');
        $this->load->model('volunteer/volunteer_model');
    }

    public function index() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['sms'] = $this->sms_model->getProfileById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('profile', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function sendView() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['voters'] = $this->voter_model->getVoter();
        $data['areas'] = $this->area_model->getAreaforsms();
        $data['sms'] = $this->sms_model->getSmsSettingsById($id);
        $data['teams'] = $this->volunteer_model->getVolunteer();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('sendview', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function settings() {
        $data = array();
        $id = $this->ion_auth->get_user_id();
        $data['settings'] = $this->sms_model->getSmsSettingsById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    public function addNewSettings() {

        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $api_id = $this->input->post('api_id');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Password Field
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('api_id', 'Api Id', 'trim|required|min_length[5]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $id = $this->ion_auth->get_user_id();
            $data['sms'] = $this->sms_model->getSmsSettingsById($id);
            $this->load->view('home/dashboard'); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {
            $data = array();
            $data = array(
                'username' => $username,
                'password' => $password,
                'api_id' => $api_id,
                'user' => $this->ion_auth->get_user_id(),
                'party_id'=>$this->session->userdata('user_id')
            );
            if (empty($this->sms_model->getSmsSettingsById($id)->username)) {
                $this->sms_model->addSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->sms_model->updateSmsSettings($data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('sms/settings');
        }
    }

    function send() {
        $userId = $this->ion_auth->get_user_id();
        $is_v_v = $this->input->post('radio');
        $smsSettings = $this->sms_model->getSmsSettings();
        $username = $smsSettings->username;
        $password = $smsSettings->password;
        $api_id = $smsSettings->api_id;

        if ($is_v_v == 'allvoter') {
            $voters = $this->voter_model->getvoter();
            foreach ($voters as $voter) {
                $to[] = $voter->phone;
            }
            $recipient = 'All Voter';
        }

        if ($is_v_v == 'allvolunteer') {
            $volunteers = $this->volunteer_model->getVolunteer();
            foreach ($volunteers as $volunteer) {
                $to[] = $volunteer->phone;
            }
            $recipient = 'All Volunteer';
        }

        if ($is_v_v == 'donor') {
            $donors = $this->donor_model->getDonor();
            foreach ($donors as $donor) {
                $to[] = $donor->phone;
            }
            $recipient = 'All Donors';
        }

        if ($is_v_v == 'areaWiseVolunteeer') {
            $area = $this->input->post('area');
            $volunteers = $this->volunteer_model->getVolunteer();
            foreach ($volunteers as $volunteer) {
                if ($volunteer->area == $area) {
                    $to[] = $volunteer->phone;
					
                }
            }
            $recipient = 'All Volunteers From ' . $this->area_model->getAreaById($area)->name;
        }


        if ($is_v_v == 'single_voter') {
            $voter = $this->input->post('voter');

            $voter_detail = $this->voter_model->getVoterById($voter);
            $single_voter_phone = $voter_detail->phone;
            $recipient = 'Voter Id: ' . $voter_detail->id . '<br> Voter Name: ' . $voter_detail->name . '<br> Voter Phone: ' . $voter_detail->phone;
        }

        if (!empty($single_voter_phone)) {
            $to = $single_voter_phone;
        } else {
            if (!empty($to)) {
                $to = implode(',', $to);
            }
        }
        // $message = urlencode("Test Message");
        if (!empty($to)) {
			//print_r($to);exit;
            $message = $this->input->post('message');
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'==&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data = array();
            $date = time();
            $data = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data);
            $this->session->set_flashdata('feedback', 'Message Sent');
        } else {
            $this->session->set_flashdata('feedback', 'Not Sent');
        }
        redirect('sms/sendView');
    }

    function sendSmsToSpecificVolunteer() {
        $userId = $this->ion_auth->get_user_id();
        $smsSettings = $this->sms_model->getSmsSettingsById($userId);
        $username = $smsSettings->username;
        $password = $smsSettings->password;
        $api_id = $smsSettings->api_id;

        $to = $this->input->post('number');
        $message = $this->input->post('message');
        $recipient = $this->input->post('volunteer_namee') . '<br>' . $this->input->post('number');
        if (!empty($to)) {
            $message = $this->input->post('message');
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);
            $data = array();
            $date = time();
            $data = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient
            );
            $this->sms_model->insertSms($data);
            $this->session->set_flashdata('feedback', 'Message Sent');
        } else {
            $this->session->set_flashdata('feedback', 'Message Failed');
        }
        redirect('volunteer');
    }

    function sendVolunteerAreaWise() {
        $area_id = $this->input->post('area_id');
        $userId = $this->ion_auth->get_user_id();
        $volunteers = $this->volunteer_model->getVolunteer();
        $smsSettings = $this->sms_model->getSmsSettingsById($userId);
        $username = $smsSettings->username;
        $password = $smsSettings->password;
        $api_id = $smsSettings->api_id;
        foreach ($volunteers as $volunteer) {
            if ($volunteer->area == $area_id) {
                $to[] = $volunteer->phone;
            }
        }
        if (!empty($to)) {
            $to = implode(',', $to);
            $message = $this->input->post('message');
            // $message = urlencode("Test Message");
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);
            $this->session->set_flashdata('feedback', 'Message Sent');
        } else {
            $this->session->set_flashdata('feedback', 'Message Failed');
        }
        redirect('sms/sendView');
    }

  

    function sendSmsDuringVoterRegistration($voter) {
        $smsSettings = $this->sms_model->getSmsSettings();
        $username = $smsSettings->username;
        $password = $smsSettings->password;
        $api_id = $smsSettings->api_id;

        $voter_detail = $this->voter_model->getVoterById($voter);

        $recipient_p = 'Voter Id: ' . $voter_detail->id . '<br> Voter Name: ' . $voter_detail->name . '<br> Voter Phone: ' . $voter_detail->phone;

        // $message = urlencode("Test Message");
        if (!empty($voter)) {
            $to = $voter_detail->phone;
            $message = 'Voter Registration' . $voter_detail->name . 'is successfully registerred';
            $message1 = urlencode($message);
            file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '==&to=' . $to . '&content=' . $message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
            $data_p = array();
            $date = time();
            $data_p = array(
                'message' => $message, 
                'date' => $date,
                'recipient' => $recipient_p,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data_p);
        }
    }

    function sent() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data['sents'] = $this->sms_model->getSms();
        } else {
            $current_user_id = $this->ion_auth->user()->row()->id;
            $data['sents'] = $this->sms_model->getSmsByUser($current_user_id);
        }

        $this->load->view('home/dashboard');
        $this->load->view('sms', $data);
        $this->load->view('home/footer');
    }

    function delete() {
        $id = $this->input->get('id');
        $this->sms_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('sms/sent');
    }

}

/* End of file profile.php */
/* Location: ./application/modules/profile/controllers/profile.php */
