<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Area_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertArea($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('tbl_word_no', $data2);
    }

    function getArea() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get('tbl_word_no');
        return $query->result();
    }
	
	function getAreaforsms() {
        //$this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get('tbl_word_no');
        return $query->result();
    }

    function getAreaById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tbl_word_no');
        return $query->row();
    }

    function updateArea($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('tbl_word_no', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('tbl_word_no');
    }

}
