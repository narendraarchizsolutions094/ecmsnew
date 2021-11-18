<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donation_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDonation($data) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('donation', $data2);
    }

    function getDonation() {
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $query = $this->db->get('donation');
        return $query->result();
    }

    function getDonationByDate($date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('donation');
        $this->db->where('party_id', $this->session->userdata('party_id'));
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get();
        return $query->result();
    }

    function getDonationById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('donation');
        return $query->row();
    }

    function updateDonation($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('donation', $data);
    }

    function deleteDonation($id) {
        $this->db->where('id', $id);
        $this->db->delete('donation');
    }

    function getBloodBank() {
        $query = $this->db->get('bankb');
        return $query->result();
    }

    function getBloodBankById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bankb');
        return $query->row();
    }

    function updateBloodBank($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('bankb', $data);
    }

}
