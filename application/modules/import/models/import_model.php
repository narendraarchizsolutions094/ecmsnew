<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    function insertData($data) {
        $this->db->insert_batch('student', $data);
    }

    function dataEntry($data, $tablename) {
        $data1 = array('party_id' => $this->session->userdata('party_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert($tablename, $data2);
    }

    function getTable($data) {
        $query = $this->db->list_fields($data);
        return $query;
    }

    function headerExist($data, $table) {
        foreach ($data as $data) {
            if ($this->db->field_exists($data, $table)) {

                $booleanValue[] = 'true';
            } else {
                $booleanValue[] = 'false';
            }
        }
        if (array_search('false', $booleanValue)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function headerExistclient($data, $table) {
        foreach ($data as $data1) {
            if ($this->db->field_exists($data1, $table) || $this->db->field_exists($data1, 'users')) {

                $booleanValue[] = 'true';
            } else {
                $booleanValue[] = 'false';
            }
        }
        if (array_search('false', $booleanValue)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>

