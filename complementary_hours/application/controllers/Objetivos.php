<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class objetivos extends CI_Controller {

	function __construct(){
		parent::__construct();
		if($_SESSION['logado'] !== TRUE){
			redirect(base_url());
		}
	}

	public function index(){
		$header['titulo'] = 'Objetivos';
		$this->load->view('include/header',$header);
		$this->load->view('include/menu');
		$this->load->view('objetivos');
		$this->load->view('include/footer');
	}
}