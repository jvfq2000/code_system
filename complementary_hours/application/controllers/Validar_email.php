<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validar_email extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('classes/Usuario_model', 'usuario');
	}

	public function validar($id, $email, $valido){
		if ($valido) {
			$this->usuario->setUsuario_id($id);
			$this->usuario->setUsuario_email($email);
			$this->usuario->Validar_email();
		};
	}
}
