<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertEvent($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('event', $data2);
    }

    function getEvent() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by("id", "desc");
        $query = $this->db->get('event');
        return $query->result();
    }

    function getEventForCalendar() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('event');
        return $query->result();
    }

    function getEventById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('event');
        return $query->row();
    }

    function updateEvent($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('event', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('event');
    }

}
