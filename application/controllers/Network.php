<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends CI_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->library('datatables');
		$this->load->model('Login_model','login');
		$this->load->helper('Lookup_helper'); //helpers
		$this->load->model('Dbase_lookup','lookup');
		$this->load->model('Admin_model','Admin'); 
	}
	
	public function index()
	{
		if((!empty($this->session->userdata('logged_in'))))
		{
			$this->load->view('templates_report/header/header');
			$this->load->view('templates_report/body/network');
			$this->load->view('templates_report/footer/footer');
		} else {
	      redirect('login');
	    }
	}
}