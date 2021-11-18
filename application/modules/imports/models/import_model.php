<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        // $this->load->library('Excel');
       
        // $this->load->helper('file');
         
    }

    // function insertData($data) {
    //     $this->db->insert_batch('student', $data);
    // }

    // function dataEntry($data, $tablename) {
    //     $data1 = array('party_id' => $this->session->userdata('party_id'));
    //     $data2 = array_merge($data, $data1);
    //     $this->db->insert($tablename, $data2);
    // }

    // function getTable($data) {
    //     $query = $this->db->list_fields($data);
    //     return $query;
    // }

    // function headerExist($data, $table) {
    //     foreach ($data as $data) {
    //         if ($this->db->field_exists($data, $table)) {

    //             $booleanValue[] = 'true';
    //         } else {
    //             $booleanValue[] = 'false';
    //         }
    //     }
    //     if (array_search('false', $booleanValue)) {
    //         return FALSE;
    //     } else {
    //         return TRUE;
    //     }
    // }

    // function headerExistclient($data, $table) {
    //     foreach ($data as $data1) {
    //         if ($this->db->field_exists($data1, $table) || $this->db->field_exists($data1, 'users')) {

    //             $booleanValue[] = 'true';
    //         } else {
    //             $booleanValue[] = 'false';
    //         }
    //     }
    //     if (array_search('false', $booleanValue)) {
    //         return FALSE;
    //     } else {
    //         return TRUE;
    //     }
    // }


    function csv_import_model(){
    $count=0;
        $fp = fopen($_FILES['filename']['tmp_name'],'r') or die("can't open file");
        while($csv_line = fgetcsv($fp,1024))
        {
            $count++;
            if($count == 1)
            {
                continue;
            }//keep this if condition if you want to remove the first row
            for($i = 0, $j = count($csv_line); $i < $j; $i++)
            {
                $insert_csv = array();
                $insert_csv['phone'] = $csv_line[0];//remove if you want to have primary key,
                $insert_csv['name'] = $csv_line[1];
                $insert_csv['email'] = $csv_line[2];
                $insert_csv['dob'] = $csv_line[3];
                $insert_csv['ward_no'] = $csv_line[4];
                $insert_csv['voter_id'] = $csv_line[5];
                $insert_csv['age'] = $csv_line[6];
                $insert_csv['address'] = $csv_line[7];
                $insert_csv['sex'] = $csv_line[8];

            }
            $i++;
            $data = array(
                'phone' => $insert_csv['phone'] ,
                'name' => $insert_csv['name'],
                'email' => $insert_csv['email'],
                'birthdate' => $insert_csv['dob'],
                'ward_no' => $insert_csv['ward_no'],
                'voter_id' => $insert_csv['voter_id'],
                'age' => $insert_csv['age'],
                'address' => $insert_csv['address'],
                'sex' => $insert_csv['sex'],
                'registration_time' =>'0',
                'party_id' =>'0',
                'voter_id_card' =>'0',
                'add_date' =>'0',

                 );
            $result = $this->db->insert('volunteer', $data);
        }
        fclose($fp) or die("can't close file");

        if($result){
            $this->session->set_userdata('msg','Added successfuly');
         redirect('imports/index');
        }

}
?>

