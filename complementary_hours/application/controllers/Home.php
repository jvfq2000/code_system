<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($_SESSION['logado'] !== TRUE){
			redirect(base_url());
		}
	}

	public function index(){
		$this->load->view('include/header');
		$this->load->view('include/menu');
		$this->load->view('home');
		$this->load->view('include/footer');
	}

}
