<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertTeam($data) {
         $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('team', $data2);
    }

    function getTeam() {
        //$this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by("id", "asc");
        $query = $this->db->get('team');
        return $query->result();
    }

    function getTeamById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('team');
        return $query->row();
    }
	function gettimelinebyTeamById($id) {
        $this->db->where('team_id', $id);
		$this->db->order_by("id", "desc");
        $query = $this->db->get('tbl_conversation');
        return $query->result();
    }

    function updateTeam($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('team', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('team');
    }
	
	function updateTeamtimline($data) {
        $this->db->insert('tbl_conversation', $data);
    }
	
	function getTeamlatest() {
		$this->db->distinct();
		$this->db->where('created_date', date('Y-m-d'));
        $query = $this->db->get('tbl_conversation');
        return $query->result();
    }
function getTeamvol($id) {
		$this->db->where('id', $id);
        $query = $this->db->get('team');
        return $query->result();
    }
}
