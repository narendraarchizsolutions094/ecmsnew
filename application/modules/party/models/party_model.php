<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Party_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function partyId() {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            if ($this->ion_auth->in_group(array('admin'))) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $party_id = $this->db->get_where('party', array('ion_user_id' => $current_user_id))->row()->id;
                return $party_id;
            } else {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
                $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
                $group_name = strtolower($group_name);
                $party_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->party_id;
                return $party_id;
            }
        }
    }

    function addPartyIdToIonUser($ion_user_id, $party_id) {
        $party_ion_id = $this->getPartyById($party_id)->ion_user_id;
        $uptade_ion_user = array(
            'party_ion_id' => $party_ion_id,
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function insertParty($data) {
        $this->db->insert('party', $data);
    }

    function getParty() {
        $query = $this->db->get('party');
        return $query->result();
    }

    function getPartyById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('party');
        return $query->row();
    }
    
     function getPartyByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('party');
        return $query->row();
    }

    function updateParty($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('party', $data);
    }

    function activate($id, $data) {
        $this->db->where('id', $id);
        $this->db->or_where('party_ion_id', $id);
        $this->db->update('users', $data);
    }

    function deactivate($id, $data) {
        $this->db->where('party_ion_id', $id);
        $this->db->or_where('id', $id);
        $this->db->update('users', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('party');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getPartyId($current_user_id) {
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        $party_id = $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->party_id;
        return $party_id;
    }

}
