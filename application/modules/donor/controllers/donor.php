<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donor extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('donor_model');
        if (!$this->ion_auth->in_group(array('admin'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['donors'] = $this->donor_model->getDonor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('donor', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addDonorView() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $data = array();
        $data['groups'] = $this->donor_model->getBloodBank();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_donor', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addDonor() {
        if ($this->ion_auth->in_group('Patient')) {
            redirect('home/permission');
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $age = $this->input->post('age');
        $sex = $this->input->post('sex');
        $phone = $this->input->post('phone');
        $profession = $this->input->post('profession');
        $email = $this->input->post('email');
        if ((empty($id))) {
            $add_date = date('m/d/y');
        } else {
            $add_date = $this->db->get_where('donor', array('id' => $id))->row()->add_date;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('age', 'age', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('sex', 'sex', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('profession', 'Profession', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[2]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['donor'] = $this->donor_model->getDonorById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_donor', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_donor', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $data = array();
            $data = array('name' => $name,
                'address' => $address,
                'age' => $age,
                'sex' => $sex,
                'phone' => $phone,
                'profession' => $profession,
                'email' => $email,
                'add_date' => $add_date
            );
            if (empty($id)) {
                $this->donor_model->insertDonor($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else {
                $this->donor_model->updateDonor($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            redirect('donor');
        }
    }

    function editDonor() {
        $data = array();
        $data['groups'] = $this->donor_model->getBloodBank();
        $id = $this->input->get('id');
        $data['donor'] = $this->donor_model->getDonorById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_donor', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDonorByJason() {
        $id = $this->input->get('id');
        $data['donor'] = $this->donor_model->getDonorById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->donor_model->deleteDonor($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('donor');
    }


}

/* End of file accountant.php */
/* Location: ./application/modules/accountant/controllers/accountant.php */
