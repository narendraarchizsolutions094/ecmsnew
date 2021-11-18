<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');
require_once(APPPATH.'libraries/Format.php');
//require APPPATH . 'libraries/Format.php';
//namespace Restserver\Libraries;
class MY_Controller extends REST_Controller {
	function __construct()
	{
		parent::__construct();
		
	}
}