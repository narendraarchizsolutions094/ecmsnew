<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('donation_model');
        $this->load->model('donor/donor_model');
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['donors'] = $this->donor_model->getDonor();
        $data['donations'] = $this->donation_model->getDonation();
        $data['groups'] = $this->donation_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('donation', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addDonationView() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['donors'] = $this->donor_model->getDonor();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_donation', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addDonation() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $donor = $this->input->post('donor');
        $date = $this->input->post('date');

        if (!empty($date)) {
            $date = strtotime($date);
        } else {
            $date = time();
        }

        $type = $this->input->post('type');
        $amount = $this->input->post('amount');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('donor', 'Donor', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[2]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['groups'] = $this->donation_model->getBloodBank();
                $data['donation'] = $this->donation_model->getDonationById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_donation', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['groups'] = $this->donation_model->getBloodBank();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_donation', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('donor' => $donor,
                'date' => $date,
                'type' => $type,
                'amount' => $amount,
            );
            if (empty($id)) {
                $this->donation_model->insertDonation($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->donation_model->updateDonation($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('donation');
        }
    }

    function editDonation() {
        $data = array();
        $data['groups'] = $this->donation_model->getBloodBank();
        $id = $this->input->get('id');
        $data['donation'] = $this->donation_model->getDonationById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_donation', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDonationByJason() {
        $id = $this->input->get('id');
        $data['donation'] = $this->donation_model->getDonationById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->donation_model->deleteDonation($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('donation');
    }

}

/* End of file accountant.php */
/* Location: ./application/modules/accountant/controllers/accountant.php */
