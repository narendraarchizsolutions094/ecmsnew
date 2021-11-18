<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('area/area_model');
        $this->load->model('voter/voter_model');
        if (!$this->ion_auth->in_group(array('admin', 'Volunteer'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['events'] = $this->event_model->getEvent();
        $data['areas'] = $this->area_model->getArea();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('event', $data);
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
        $organiser = $this->input->post('organiser');
        $location = $this->input->post('location');
        $contact = $this->input->post('contact');
        $date = $this->input->post('date');
        $s_time = $this->input->post('s_time');
        $e_time = $this->input->post('e_time');
        $subject = $this->input->post('subject');
        $description = $this->input->post('description');
        $guests = $this->input->post('guests');
        $event_id = $this->input->post('p_id');
        if (empty($event_id)) {
            $event_id = rand(10000, 1000000);
        }


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('organiser', 'Organiser', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('location', 'Location', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Volunteer Field
        $this->form_validation->set_rules('contact', 'Contact', 'trim|min_length[5]|max_length[100]|xss_clean');
        // Validating Name Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('subject', 'Subject', 'trim|min_length[3]|max_length[100]|xss_clean');
        // Validating Volunteer Field
        $this->form_validation->set_rules('description', 'Description', 'trim|min_length[3]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('guests', 'Guests', 'trim|min_length[3]|max_length[500]|xss_clean');
        // Validating Phone Field          

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("event/editEvent?id=$id");
            } else {
                $data = array();
                $data['areas'] = $this->area_model->getArea();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            $data = array();
            $data = array(
                'event_id' => $event_id,
                'organiser' => $organiser,
                'location' => $location,
                'contact' => $contact,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'subject' => $subject,
                'description' => $description,
                'guests' => $guests,
            );
            if (empty($id)) {     // Adding New Event
                $this->event_model->insertEvent($data);
                $this->session->set_flashdata('feedback', 'Event Added');
                redirect('event');
            } else { // Updating Event
                $this->event_model->updateEvent($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                redirect('event');
            }
        }
    }

    function getEventByJasonn() {
        $query = $this->event_model->getEvent();
        $jsonevents = array();
        foreach ($query as $entry) {
            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $entry->description,
                'start' => $entry->s_time,
                'end' => $entry->e_time,
                'color' => '#' . rand(100000, 999999),
            );

            echo json_encode($jsonevents);
        }
    }

    function getEvent() {
        $data['event'] = $this->event_model->getEvent();
        $this->load->view('event', $data);
    }

    function getEventByJason() {
        if ($this->ion_auth->in_group(array('Volunteer'))) {
            $volunteer_ion_id = $this->ion_auth->get_user_id();
            $volunteer = $this->db->get_where('volunteer', array('ion_user_id' => $volunteer_ion_id))->row()->id;
            $query = $this->appointment_model->getAppointmentByVolunteer($volunteer);
        } else {
            $query = $this->event_model->getEventForCalendar();
        }
        $jsonevents = array();

        foreach ($query as $entry) {

            //   $time_slot = $entry->time_slot;
            //   $time_slot_new = explode(' To ', $time_slot);



            $start_time = $entry->s_time;
            $end_time = $entry->e_time;

            $start_time = explode(' ', $start_time);
            $end_time = explode(' ', $end_time);


            if ($start_time[1] == 'AM') {
                $start_time_second = explode(':', $start_time[0]);
                $day_start_time_second = $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
            } else {
                $start_time_second = explode(':', $start_time[0]);
                $day_start_time_second = 12 * 60 * 60 + $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
            }

            if ($end_time[1] == 'AM') {
                $end_time_second = explode(':', $end_time[0]);
                $day_end_time_second = $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
            } else {
                $end_time_second = explode(':', $end_time[0]);
                $day_end_time_second = 12 * 60 * 60 + $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
            }


            $info = '<br/>' . lang('event') . ': ' . $entry->subject . '<br/>' . lang('remarks') . ': ' . $entry->description;

            $final_s_time = strtotime($entry->date) + $day_start_time_second;
            $final_e_time = strtotime($entry->date) + $day_end_time_second;

            if (!empty($entry->date)) {
                $date = strtotime($entry->date);
                if ($final_s_time > time()) {
                    $color = 'yellowgreen';
                } elseif($final_s_time < time() && $final_e_time > time()) {
                    $color = 'blue';
                }elseif($final_s_time < time() && $final_e_time < time()){
                    $color = '#32A3CF';
                }
            }



            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $info,
                'start' => date('Y-m-d H:i:s', strtotime($entry->date) + $day_start_time_second),
                'end' => date('Y-m-d H:i:s', strtotime($entry->date) + $day_end_time_second),
                'color' => $color,
            );
        }

        echo json_encode($jsonevents);

        //  echo json_encode($data);
    }

    function editEvent() {
        $data = array();
        $id = $this->input->get('id');
        $data['event'] = $this->event_model->getEventById($id);
        $data['areas'] = $this->area_model->getArea();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editEventByJason() {
        $id = $this->input->get('id');
        $data['event'] = $this->event_model->getEventById($id);
        echo json_encode($data);
    }

    function eventDetails() {
        $data = array();
        $id = $this->input->get('id');
        $data['event'] = $this->event_model->getEventById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $this->event_model->delete($id);
        $this->session->set_flashdata('feedback', 'Deleted');
        redirect('event');
    }

}

/* End of file event.php */
    /* Location: ./application/modules/event/controllers/event.php */
    