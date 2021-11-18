<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voter_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertVoter($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data3 = array_merge($data, $data1);
        $this->db->insert('voter', $data3);
    }

 function getDispostion() {
        $this->db->select('*');
        $this->db->from('tbl_dispostion');
        $query = $this->db->get();
        return $query->result();
    }
	
	function getward() {
        $this->db->select('*');
        $this->db->from('tbl_word_no');
        $query = $this->db->get();
        return $query->result();
    }
    function getVoter() {
        $this->db->select('voter.*,users.id as uid,users.username as created_by');
        $this->db->from('voter');
        $this->db->join('users','users.id=voter.ion_user_id','left');
        $this->db->where('voter.party_id', $this->session->userdata('party_id'));
        $this->db->order_by('voter.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getVoterBySearch($search) {
        $this->db->select('voter.*,users.id as uid,users.username as created_by');
        $this->db->from('voter');
        $this->db->join('users','users.id=voter.ion_user_id','left');
        $this->db->where('voter.party_id', $this->session->userdata('party_id'));
        $this->db->order_by('voter.id', 'desc');
        $this->db->like('voter.id', $search);
        $this->db->or_like('voter.name', $search);
        $query = $this->db->get();
        return $query->result();
    }

    function getVoterByLimit($limit, $start) {
         $this->db->select('voter.*,users.id as uid,users.username as created_by');
        $this->db->from('voter');
        $this->db->join('users','users.id=voter.ion_user_id','left');
        $this->db->where('voter.party_id', $this->session->userdata('party_id'));
        $this->db->order_by('voter.id', 'desc');
        $this->db->limit($limit, $start);
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

    function getVoterByLimitBySearch($limit, $start, $search) {
        $this->db->select('voter.*,users.id as uid,users.username as created_by');
        $this->db->from('voter');
        $this->db->join('users','users.id=voter.ion_user_id','left');
        $this->db->where('voter.party_id', $this->session->userdata('party_id'));

        $this->db->like('voter.id', $search);

        $this->db->order_by('voter.id', 'desc');

        $this->db->or_like('voter.name', $search);
        $this->db->or_like('voter.phone', $search);
        $this->db->or_like('voter.address', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getVoterById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('voter');
        return $query->row();
    }

    function getVoterByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('voter');
        return $query->row();
    }

    function getVoterByEmail($email) {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->where('email', $email);
        $query = $this->db->get('voter');
        return $query->row();
    }

    function updateVoter($id, $data) {
		$data1 = array('update_date' => date('d-m-y'));
		$data3 = array_merge($data, $data1);
        $this->db->where('id', $id);
        $this->db->update('voter', $data3);
    }
	
	function inserchengedisposition($data1,$id) {
	if($id==''){
$this->db->order_by('id', 'desc');
$query = $this->db->get('voter');
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
        $this->db->delete('voter');
    }

    function insertVoterCategory($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('voter_category', $data2);
    }

    function getVoterCategory() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->order_by("id", "desc");
        $query = $this->db->get('voter_category');
        return $query->result();
    }

    function getVoterCategoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('voter_category');
        return $query->row();
    }

    function updateVoterCategory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('voter_category', $data);
    }

    function deleteVoterCategory($id) {
        $this->db->where('id', $id);
        $this->db->delete('voter_category');
    }

    function updateIonUser($username, $email,$phone, $password, $id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
			'phone' => $phone,
            'password' => $password
        );
        $this->db->where('email', $id);
        $this->db->update('users', $uptade_ion_user);
    }

}
