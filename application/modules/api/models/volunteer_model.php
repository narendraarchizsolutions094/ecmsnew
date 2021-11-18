<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Volunteer_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
		$this->load->helper('security');
		$this->load->library("form_validation");
    }
	
	public function insertVolunteer($arr){
		
	    $this->db->insert('volunteer', $arr);
		return $this->db->insert_id(); 
	}

	public function get_voterlist($id){
		
	$this->db->select('*');
    $this->db->from('voter');
    $this->db->where('ion_user_id',$id);
    return $this->db->get()->result_array();
	}

	public function get_volunteerlist($id){
		
	$this->db->select('*');
    $this->db->from('volunteer');
    $this->db->where('ion_user_id',$id);
    return $this->db->get()->result_array();
	}

	public function get_qrcodelist($id){
		
	$this->db->select('*');
    $this->db->from('qr_code');
    $this->db->where('user_id',$id);
    return $this->db->get()->result_array();
	}

	public function get_wardno(){
		
	$this->db->select('*');
    $this->db->from('tbl_word_no');
    $this->db->where('party_id','433');
    return $this->db->get()->result_array();
	}

	public function get_category(){
		
	$this->db->select('*');
    $this->db->from('voter_category');
    $this->db->where('party_id','433');
    return $this->db->get()->result_array();
	}

}

?>