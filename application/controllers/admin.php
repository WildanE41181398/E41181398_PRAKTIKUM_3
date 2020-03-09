<?php 
//Class Admin
class Admin extends CI_Controller{

	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			//Mengalihkan ke controller login
			redirect(base_url("login"));
		}
	}

	function index(){
		//Memuat view v_admin
		$this->load->view('v_admin');
	}
}