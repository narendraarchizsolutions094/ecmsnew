<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('notice/notice_model');
        $this->load->model('event/event_model');
        $this->load->model('home_model');
    }

    public function index() {
        if ($this->ion_auth->in_group(array('admin'))) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
            $data['notices'] = $this->notice_model->getNotice();
            $data['expenses'] = $this->finance_model->getExpense();
            $data['this_month']['expense'] = $this->finance_model->thisMonthExpense();
            $data['this_day']['expense'] = $this->finance_model->thisDayExpense();
            $data['this_year']['expense'] = $this->finance_model->thisYearExpense();
            $data['this_year']['expense_per_month'] = $this->finance_model->getExpensePerMonthThisYear();

            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer', $data);
        } else if($this->ion_auth->in_group(array('superadmin'))){
            $data['partys'] = $this->party_model->getParty();
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }else{
			redirect('team','refresh');
		}
    }

    public function permission() {
        $this->load->view('permission');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
