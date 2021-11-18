<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Snw_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSnw($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('snw', $data2);
    }

    function getSnw() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by("id", "desc");
        $query = $this->db->get('snw');
        return $query->result();
    }

    function getSnwById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('snw');
        return $query->row();
    }

    function updateSnw($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('snw', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('snw');
    }
    
}
