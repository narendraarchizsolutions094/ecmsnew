<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSettings($party_settings_data) {
        $this->db->insert('settings', $party_settings_data);
    }

    function getSettings() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get('settings');
        return $query->row();
    }

    function updateSettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('settings', $data);
    }

    function updateSettingsByHId($id, $data) {
        $this->db->where('party_id', $id);
        $this->db->update('settings', $data);
    }

    function getSettingsByHId($id) {
        $this->db->where('party_id', $id);
        $query = $this->db->get('settings');
        return $query->row();
    }

}
