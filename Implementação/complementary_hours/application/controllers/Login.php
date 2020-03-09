<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('login');
	}

	public function cadastro(){
		$this->load->view('cadastro');
	}
}
