<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class web_from extends MX_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('area_model');
        
        
    }

    public function index() {
        $data['areas'] = $this->area_model->getArea();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('area', $data);
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
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field    
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[1000]|xss_clean');
        // Validating Address Field   
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['area'] = $this->area_model->getAreaById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'description' => $description
            );
            if (empty($id)) {     // Adding New area
                $this->area_model->insertArea($data);
                $this->session->set_flashdata('feedback', 'Added');
            } else { // Updating area
                $this->area_model->updateArea($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
            }
            // Loading View
            redirect('area');
        }
    }

    function getArea() {
        $data['areas'] = $this->area_model->getArea();
        $this->load->view('area', $data);
    }

    function editArea() {
        $data = array();
        $id = $this->input->get('id');
        $data['area'] = $this->area_model->getAreaById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAreaByJason() {
        $id = $this->input->get('id');
        $data['area'] = $this->area_model->getAreaById($id);
        echo json_encode($data);
    }

    function delete() {
        $id = $this->input->get('id');
        $this->area_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('area');
    }

}

/* End of file area.php */
/* Location: ./application/modules/area/controllers/area.php */
