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
        $this->db->insert('qr_code', $data2);
    }

    function getArea() {
		$this->db->select('qr_code.*,users.id as uid,users.username as created_by');
        $this->db->from('users');
        $this->db->join('qr_code','users.id=qr_code.assign_id');
		  if ($this->ion_auth->in_group(array('admin'))) {
        $this->db->where('qr_code.party_id', $this->session->userdata('party_id'));
		  }else{
		$this->db->where('qr_code.assign_id', $this->session->userdata('user_id'));
		  }
        $query = $this->db->get();
        return $query->result();
    }
	 function getUser() {
		$this->db->select('volunteer.*,users.id as uid,users.username as created_by');
        $this->db->from('volunteer');
		$this->db->join('users','users.email=volunteer.email');
        $this->db->where('users.party_id', $this->session->userdata('party_id'));
        $query = $this->db->get();
        return $query->result();
    }

    function getAreaById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('qr_code');
        return $query->row();
    }

    function updateArea($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('area', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('qr_code');
    }

}
