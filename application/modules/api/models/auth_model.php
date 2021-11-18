<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

public function login($mobileemail,$pw){
     //  print_r($data);exit;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('phone',$mobileemail);
        $this->db->or_where('email',$mobileemail);
        $result = $this->db->get()->row_array();

            if ($result){
                //Compare the password attempt with the password we have stored.                
              $validPassword = password_verify($pw, $result['password']);
               
                if($validPassword){
                   return $result;
                }
            }
            else{
                
                return false;
            }
        
    }
    public function check_mob($mob) {
    $this->db->select('phone_no');
    $this->db->from('tbl_otp');
    $this->db->where('phone_no',$mob);
    return $this->db->get()->row_array();
    }

   public function register($table,$arr){
        
        $this->db->insert($table, $arr);
        return $this->db->insert_id(); 
    }


    public function verify_otp($otp,$mobile){
         $query = $this->db->query("select otp from tbl_otp where otp={$otp} and phone_no={$mobile}");
        
            $result= $query->row_array();
            $otp1 = $result['otp'];
            //$match = count($result);
            if($otp===$otp1){
                return true;
            }
            else{
                return false;
            }
}

public function get_userid($mobile){

    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('phone',$mobile);
    return $this->db->get()->row_array();

}


}
?>