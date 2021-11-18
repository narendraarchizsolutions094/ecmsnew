<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        
		ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

		parent::__construct();
		
		
        $this->load->library('Ion_auth');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('settings_model');
        $this->load->library('upload');
        $this->load->library('sma');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
        $this->load->model('ion_auth_model');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
	
    }

    public function index() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('settings', $data);
        $this->load->view('home/footer'); // just the footer file
    }
	
	public function savecity(){
		
		$this->form_validation->set_rules("city", "trim|required|callback_checkcity");
		$this->form_validation->set_rules("state", "trim|required");
		
		if($this->form_validation->run()){
			
			$arr = array("city" => $this->input->post("city", true),
						 "state_id"  => $this->input->post("state", true)
						 );
			
			$ret = $this->db->insert("cities", $arr);			
		
			if($ret){
				
				$this->session->set_flashdata('message', 'Successfully city added');
				
			}else{
				$this->session->set_flashdata('message', 'Failed to city');
				
			}
		
		}else{
			$this->session->set_flashdata('message', validation_errors());
		}
		redirect("settings/cities/", "refresh");
		
	}
/*	public function markread($type = ""){
		
		if($type == "notice"){
			
			$updarr = array("status" => 1);
				
		} 	
	} */
	function checkcity($city){
		
		$tot =  $this->db->where("city", $city)->count_all_results('cities');
		
		if($tot > 0){
			
			$this->form_validation->set_message('checkcity', "City already exists.");
			return false;
		}else{
			return true;
		}
		
	}
	
	function ward($wardno = ""){
		
		if(isset($_POST["wardno"])){
			
			$this->addward();
		}
		
		$data = array();
		$this->load->model("common_model");
        $data['state']  = $this->common_model-> get_result("states", array(), "name ASC");
		
		//$data['city'] 	= $this->common_model-> get_result("cities", $wharr, "city ASC");
        $this->load->view('home/dashboard'); // just the header file
		
		if(!empty($wardno) and strtolower($wardno) == "new") {
		
			$this->load->view('wardno', $data);	
			
		}else if(!empty($wardno)){
			
			$this->db->select("*");
			$this->db->where(array("id" => $wardno, "party_id" => $this->session->userdata('party_id')));
			$this->db->from("tbl_word_no");
			$wardarr = $this->db->get()->row();
			$data["wards"] = $wardarr; 
			if(!empty($wardarr->state)){
				
				$this->db->select("id,city as name");
				$this->db->where(array("state_id" => $wardarr->state));
				$this->db->from("cities");
				$data['city'] = $this->db->get()->result();
			
			}
		
			$this->load->view('wardno', $data);
		}else{
			
			$this->db->select("wrd.*,city.city as city_name,state.name as state_name");
			$this->db->where("wrd.party_id", $this->session->userdata('party_id'));
			$this->db->from("tbl_word_no wrd");
			$this->db->join("cities city ","city.id = wrd.city", "LEFT");
			$this->db->join("states state","state.id = wrd.state","LEFT");
			$data['wards'] = $this->db->get()->result();
		
		
			//$data['wards']  = $this->common_model-> get_result("tbl_word_no", array(), "w_name ASC");
			$this->load->view('all-ward', $data);
		}
		
        
        $this->load->view('home/footer'); // just the footer file
		
	}
	
	public function userright($user = ""){
		
		$this->load->view('home/dashboard');
		$this->load->view('permission');
		$this->load->view('home/footer');
	}
	
	public function cities($state = "", $extr = ""){
		
		$this->load->model("common_model");
		if(!empty($state)){
			
			$wharr = array("state_id" => $state);
		}else{
			$wharr = array();
		}
		$data['state']   = $this->common_model-> get_result("states", array(), "name ASC");
		$data['cities']  = $this->common_model-> get_result("cities", $wharr, "city ASC");
		$data["filter"]  = $state;
		$this->load->view('home/dashboard');
		
		if(empty($state)){
			
			$this->load->view('all-city', $data);
			
		}else if(strtolower($state) == "new"){
			
			$this->load->view('update-city', $data);		
			
		}else if(strtolower($state) == "edit"){
			
			$data["ucity"] = $this->db->select("*")->where("id" , $extr)->get("cities")->row();
			$this->load->view('update-city', $data);		
			
		}else{
			
			$this->load->view('all-city', $data);	
			
		}
		
		
		$this->load->view('home/footer');
	}
	public function states(){
		
		$this->load->model("common_model");

		$data['state']  = $this->common_model-> get_result("states", array(), "name ASC");
		$this->load->view('home/dashboard');
		$this->load->view('all-states', $data);
		$this->load->view('home/footer');
	}
	
	private function addward(){
		
		$this->form_validation->set_rules("wardno", "Ward Number", "trim|required");
		$this->form_validation->set_rules("city", "City", "trim|required");
		$this->form_validation->set_rules("state", "State", "trim|required");
		
		if($this->form_validation->run()){
			
				$insarr = array("w_name" => $this->input->post("wardno", true),
								"city"   	=> $this->input->post("city", true), 
								"state" 	=> $this->input->post("state", true),
								);
			$wardid = "";			
			if(isset($_POST['wardid'])) {			
					
				$wardid = $this->input->post("wardid", true);
							$this->db->where("id" , $wardid);
							$this->db->where("party_id" , $this->session->userdata('party_id'));
							
				$ret 	= $this->db->update("tbl_word_no", $insarr);
					
			}else{
				$insarr['party_id'] = $this->session->userdata('party_id');
				$insarr['added_by'] = $this->session->userdata('user_id');
				
				$ret = $this->db->insert("tbl_word_no", $insarr);
			}
			if($ret){
				//$this->session->set_mes
				redirect("settings/ward/".$wardid , "refresh");
			}
			
		}
	
		
		
	}
	 
	function load($type = ""){
		
		$content = $this->input->post("content", true);
		$this->load->model("common_model");
		
		if($type == "city"){
			
		//	$arr  = $this->db->select("id,city as name")->where("state_id", $content)->from("cities") ->order_by("city ASC");
			$arr  = $this->common_model->load_result("id,city as name", "cities" , array("state_id" => $content)  , "city");
			
		}
		if($type == "ward"){
			
			$arr  = $this->common_model->load_result("id,w_name as name", "tbl_word_no" , array("city" => $content)  , "w_name");

		}
		echo $this->db->last_query();
		if(!empty($arr)){
			
			foreach($arr as $ind => $val){
				
				?><option value = "<?php echo $val-> id; ?>"><?php echo $val-> name; ?></option><?php
			}
		}
		
	}

    public function update() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $logo = $this->input->post('logo');
        $buyer = $this->input->post('buyer');
        $p_code = $this->input->post('p_code');

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'rtrim|equired|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field   
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('logo', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('settings', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {

                $file_name = $_FILES['img_url']['name'];
                $file_name_pieces = explode('_', $file_name);
                $new_file_name = '';
                $count = 1;
                foreach ($file_name_pieces as $piece) {
                    if ($count !== 1) {
                        $piece = ucfirst($piece);
                    }

                    $new_file_name .= $piece;
                    $count++;
                }
                $config = array(
                    'file_name' => $new_file_name,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1768",
                    'max_width' => "2024"
                );

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'logo' => $img_url
                    );
                } else {
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                    );
                }
                //$error = array('error' => $this->upload->display_errors());

                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', 'Updated');
                // Loading View
                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', 'Email Required!');
            redirect('settings', 'refresh');
        }
    }

    function backups() {
        $data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
        $data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
        $data['settings'] = $this->settings_model->getSettings();

        //$bc = array(array('link' => site_url('settings'), 'page' => lang('settings')), array('link' => '#', 'page' => lang('backups')));
        //$meta = array('page_title' => lang('backups'), 'bc' => $bc);
        // $this->page_construct('settings/backups', $this->data, $meta);
        $this->load->view('home/dashboard', $data);
        $this->load->view('backups', $data);
        $this->load->view('home/footer');
    }

    function language() {

        $data['settings'] = $this->settings_model->getSettings();

        //$bc = array(array('link' => site_url('settings'), 'page' => lang('settings')), array('link' => '#', 'page' => lang('backups')));
        //$meta = array('page_title' => lang('backups'), 'bc' => $bc);
        // $this->page_construct('settings/backups', $this->data, $meta);
        $this->load->view('home/dashboard', $data);
        $this->load->view('language', $data);
        $this->load->view('home/footer');
    }

    function changeLanguage() {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $language_settings = $this->input->post('language_settings');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('settings', $data);
            $this->load->view('home/footer'); // just the footer file
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'language' => $language,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($language_settings)) {
                redirect('settings/language');
            } else {
                redirect('');
            }
        }
    }

    function selectPaymentGateway() {
        $id = $this->input->post('id');
        $payment_gateway = $this->input->post('payment_gateway');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'payment_gateway' => $payment_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', 'Updated');
            if (!empty($payment_gateway)) {
                redirect('pgateway');
            } else {
                redirect('');
            }
        }
    }

    function backup_database() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'hms_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = & $back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->session->set_flashdata('message', 'Database backup Successfull !');
        redirect("settings/backups");

        /* 	
          $this->load->dbutil();
          $backup = $this->dbutil->backup();
          $this->load->helper('file');
          write_file('Downloads.sql', $backup);
          $this->load->helper('download');
          force_download('backup.zip', $backup); */
    }

    function backup_files() {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $data = array_diff(scandir(FCPATH), array('..', '.', 'files')); // 'files' folder will be excluded here with '.' and '..'
        foreach ($data as $d) {
            $path = FCPATH . $d;
            if (is_dir($path))
                $this->zip->read_dir($path, false);
            if (is_file($path))
                $this->zip->read_file($path, false);
        }
        $filename = 'file-backup-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->archive(FCPATH . 'files/backups/' . $filename);
        $this->session->set_flashdata('message', 'Application backup Successfull !');
        redirect("settings/backups");
        exit();
    }

    /* function backup_files()
      {
      if (!$this->ion_auth->in_group('admin')) {
      $this->session->set_flashdata('error', lang('access_denied'));
      redirect("home/permission");
      }
      $this->load->dbutil();
      $backup = $this->dbutil->backup();
      $this->load->helper('file');

      $filename = 'file-backup-' . date("Y-m-d-H-i-s");
      $this->sma->zip("./", './files/backups/', $filename);
      $this->session->set_flashdata('message', lang('backup_saved'));
      redirect("settings/backups");
      exit();
      } */

    function restore_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        $this->db->conn_id->multi_query($file);
        $this->db->conn_id->close();
        $this->session->set_flashdata('message', 'Restoring of Backup Successfull');
        redirect('settings/backups');
    }

    function download_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = 'db_backup_' . date('Y_m_d_H_i_s') . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        $this->session->set_flashdata('info', 'Restoring of Application Successfull');
        redirect("settings/backups");
        exit();
    }

    function delete_database($dbfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        $this->session->set_flashdata('info', 'Deleting of Database Successfull');
        redirect("settings/backups");
    }

    function delete_backup($zipfile) {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        $this->session->set_flashdata('info', 'Deleting of App Backup Successfull');
        redirect("settings/backups");
    }
	


}

/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */


