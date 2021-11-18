<?php

class Imports extends MX_Controller {

public function __construct() {
        parent::__construct();

        
      //  $this->load->model('modules/imports/models/import_model','import_model');
        $this->load->helper('file');

         
    }

    function index() {
 
            $this->load->view('home/dashboard');
            $this->load->view('imports/import');
           $this->load->view('home/footer');
        
    }

    function indexDynamic() {
        
		$count=0;
        
		$fp = fopen($_FILES['filename']['tmp_name'],'r') or die("can't open file");
        
		$scs = $fail = $ofail = "";
		
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
			$wardid  = $this->db->select("id")->where(array('party_id'=>  $this->session->userdata("admin_id"), "w_name" => $insert_csv['ward_no']))->get("tbl_word_no")->row();
		
			$cntuser = $this->db->where(['email'=>  $insert_csv['email']])->from("users")->count_all_results();
			
			
			
			if($cntuser > 0){
				
				$fail .= $insert_csv['email'].", ";
				
				continue;
			} 
			
			
			if(!empty($wardid)){
				$wardno =$wardid->id;
			}else{
				$wardno =$wardid->$insert_csv['ward_no'];
			}
			
            $data_volun = array(
                'phone' 	=> $insert_csv['phone'] ,
                'name' 		=> $insert_csv['name'],
                'email' 	=> $insert_csv['email'],
                'birthdate' => $insert_csv['dob'],
                'ward_no' 	=> $wardno,
                'voter_id' 	=> $insert_csv['voter_id'],
                'age' 		=> $insert_csv['age'],
                'address' 	=> $insert_csv['address'],
                'sex' 		=> $insert_csv['sex'],
                'registration_time' =>'0',
                'party_id' => $this->session->userdata('party_id'),
                'voter_id_card' =>'0',
                'ion_user_id'=>$this->session->userdata('user_id'),
                'add_date' 	=>	date('d-m-y'),
			);
			
            $result_volun = $this->db->insert('volunteer', $data_volun);

            $data_user = array(
                'phone' => $insert_csv['phone'] ,
                'username' => $insert_csv['name'],
                'password' => '$2y$08$5jIr2TMd/gcjt4fIyA28puE6whqC6qMtZIdmZdwh1KQF6iwfOPIZG',
                'first_name' => $insert_csv['name'],
                'email' => $insert_csv['email'],
                'party_ion_id' => $this->session->userdata('user_id'),
				"party_id"     => $this->session->userdata('admin_id'),
                'ip_address' => $this->getIp(),
                //'created_on' => date('d-m-y'),
               );
			
            $result_user = $this->db->insert('users', $data_user);
			
			$insert_id = $this->db->insert_id();
			
			$updarr =  array("user_no" => $insert_id);
			
			$this->db->where("email", $insert_csv['email'])->update("volunteer", $updarr);
			
			$ret = $this->db->affected_rows();
			
			if($ret){
				
				$scs .= $insert_csv['email'].", ";
			}else{
				$ofail .= $insert_csv['email'].", ";
			}
			
			
        }
        fclose($fp) or die("can't close file");

       /// if($result){
		   
		   $failmsg = (!empty($fail))? $fail."already exists" : "";
		   $scsmsg = (!empty($scs))? $scs."  Successfully added" :"";

		   $this->session->set_userdata('msg', $scsmsg."<br />".$failmsg ); 
		  
            
         redirect('imports/index');


    }

    private function getIp() {
        
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}
?>

