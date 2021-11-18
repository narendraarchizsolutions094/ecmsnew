<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Volunteer_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertVolunteer($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('volunteer', $data2);
    }
	function insertVolunteers($data) { 
        $this->db->insert('volunteer', $data);
    }
	
	function getNotice() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('notice');
        return $query->result();
    }
	function getSettings() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get('settings');
        return $query->row();
    }

   function getVolunteer() {
	    $this->db->select('volunteer.*,users.id as uid,users.username as created_by,tbl_word_no.w_name as word_name,tbl_team_position.user_id as tuid,tbl_team_position.team_positon_id as team_positon');
        $this->db->from('volunteer');
		$this->db->join('users','users.id=volunteer.ion_user_id','left');
        $this->db->join('tbl_word_no','tbl_word_no.id=volunteer.ward_no','left');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
        if ($this->ion_auth->in_group(array('admin'))) {
			 $this->db->where('volunteer.party_id', $this->session->userdata('party_id'));
		  }else{
		$this->db->where('volunteer.ion_user_id', $this->session->userdata('user_id'));
		  }
       // $this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get();
        return $query->result();
    }

function getward() {
        $this->db->select('*');
        $this->db->from('tbl_word_no');
        $query = $this->db->get();
        return $query->result();
    }
	
	function gettimelineById($id) {
         $this->db->select('*');
        $this->db->from('tbl_timline');
        $this->db->where('user_id', $id);
        $this->db->order_by('t_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getVolunteerBySearch($search) {
       $this->db->select('volunteer.*,users.id as uid,users.username as created_by,tbl_word_no.w_name as word_name,tbl_team_position.user_id as tuid,tbl_team_position.team_positon_id as team_positon');
        $this->db->from('volunteer');
		$this->db->join('users','users.id=volunteer.ion_user_id','left');
        $this->db->join('tbl_word_no','tbl_word_no.id=volunteer.ward_no','left');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
       
		if ($this->ion_auth->in_group(array('admin'))) {
			 $this->db->where('volunteer.party_id', $this->session->userdata('party_id'));
		  }else{
		$this->db->where('volunteer.ion_user_id', $this->session->userdata('user_id'));
		  }
        $this->db->order_by('volunteer.id', 'desc');
        $this->db->like('volunteer.id', $search);
		$this->db->or_like('tbl_word_no.w_name', $search);
        $this->db->or_like('volunteer.name', $search);
        $this->db->or_like('volunteer.phone', $search);
        $this->db->or_like('volunteer.address', $search);
        $this->db->or_like('volunteer.email', $search);
        $this->db->or_like('volunteer.area', $search);
		
        $query = $this->db->get();
        return $query->result();
    }

    function getVolunteerByLimit($limit, $start) {
		
		$this->db->select('volunteer.*,users.id as uid,users.username as created_by,tbl_word_no.w_name as word_name,tbl_team_position.user_id as tuid,tbl_team_position.team_positon_id as team_positon');
        $this->db->from('volunteer');
		$this->db->join('users','users.id=volunteer.ion_user_id','left');
        $this->db->join('tbl_word_no','tbl_word_no.id=volunteer.ward_no','left');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
       if ($this->ion_auth->in_group(array('admin'))) {
			 $this->db->where('volunteer.party_id', $this->session->userdata('party_id'));
		  }else{
		$this->db->where('volunteer.ion_user_id', $this->session->userdata('user_id'));
		  }
        $this->db->order_by('volunteer.id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

function getVolunteerCategory() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by("id", "desc");
        $query = $this->db->get('voter_category');
        return $query->result();
    }

    function getVolunteerByLimitBySearch($limit, $start, $search) {
      $this->db->select('volunteer.*,users.id as uid,users.username as created_by,tbl_word_no.w_name as word_name,tbl_team_position.user_id as tuid,tbl_team_position.team_positon_id as team_positon');
        $this->db->from('volunteer');
		$this->db->join('users','users.id=volunteer.ion_user_id','left');
        $this->db->join('tbl_word_no','tbl_word_no.id=volunteer.ward_no','left');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
        if ($this->ion_auth->in_group(array('admin'))) {
			 $this->db->where('volunteer.party_id', $this->session->userdata('party_id'));
		  }else{
		$this->db->where('volunteer.ion_user_id', $this->session->userdata('user_id'));
		  }
         $this->db->order_by('volunteer.id', 'desc');
         $this->db->like('volunteer.id', $search);
		 $this->db->or_like('tbl_word_no.w_name', $search);
        $this->db->or_like('volunteer.name', $search);
        $this->db->or_like('volunteer.phone', $search);
        $this->db->or_like('volunteer.address', $search);
        $this->db->or_like('volunteer.email', $search);
        $this->db->or_like('volunteer.area', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getVolunteerById($id) {
		$this->db->select('volunteer.*,volunteer.id as vol_id');
        $this->db->from('volunteer');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
		$this->db->where('volunteer.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
	 function getVolunteerByemail($id) {
		$this->db->select('*,volunteer.phone as vphone');
        $this->db->from('volunteer');
		$this->db->join('users','users.email=volunteer.email','left');
		$this->db->join('tbl_team_position','tbl_team_position.user_id=volunteer.id','left');
		$this->db->where('users.email', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getVolunteerByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('volunteer');
        return $query->row();
    }

    function updateVolunteer($id, $data) {
		$data1 = array('update_date' => date('d-m-y'));
		$data2 = array_merge($data, $data1);
        $this->db->where('id', $id);
        $this->db->update('volunteer', $data2);
    }
	
	function updatenewpassword($email,$new_password) {
        $this->db->set('password', $new_password);
        $this->db->where('email', $email);
        $this->db->update('users');
    }
	
	function updateVolunteers2($id, $data) {
		$data1 = array('update_date' => date('d-m-y'));
		$data2 = array_merge($data, $data1);
        $this->db->where('phone', $id);
        $this->db->update('volunteer', $data2);
    }

function getDispostion() {
        $this->db->select('*');
        $this->db->from('tbl_dispostion');
        $query = $this->db->get();
        return $query->result();
    }

function inserchengedisposition($data1,$id) {
	if($id==''){
      $this->db->order_by('id', 'desc');
      $query = $this->db->get('volunteer');
      $result=$query->row();
		$data2 = array('user_id' => $result->id);
	   }else{
	  $data2 = array('user_id' => $id);	
	   }
		$data3 = array_merge($data1, $data2);
        $this->db->insert('tbl_timline', $data3);
    }


    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('volunteer');
    }

    function updateIonUser($username, $email,$phone, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
			'phone' => $phone,
            'password' => $password
        );
        $this->db->where('email', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
