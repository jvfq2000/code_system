<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validar_email extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('classes/Usuario_model', 'usuario');
	}

	private function email_valido(){
		$dados['tentou']   = 'email';
		$dados['icone']    = base_url('assets/img/emoji/festa.png');
		$dados['mensagem'] = "Parabens!!! Confirmação de e-mail bem sucedida!";
		$this->load->view('login', $dados);
		$this->load->view('include/footer');
	}

	public function validar($id, $valido){
		if ($valido = 'true') {
			$this->usuario->setUsuario_id($id);
			$email_valido = $this->usuario->validar_email();

			if ($email_valido) {
				$this->email_valido();
			} else {
				echo "Ocorreu um erro ao validar o e-mail. Tente novamente!";
			}
		};
	}
}
