<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validar_email extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('classes/Usuario_model', 'usuario');
	}

	public function validar($id, $valido){
		if ($valido = 'true') {
			$this->usuario->setUsuario_id($id);
			$email_valido = $this->usuario->Validar_email();

			if ($email_valido) {
				redirect('Login/email_valido');
			} else {
				echo "Ocorreu um erro ao validar o e-mail. Tente novamente!";
			}
		};
	}
}
