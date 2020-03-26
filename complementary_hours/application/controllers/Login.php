<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');

		$this->dados['tentou']   = FALSE;
		$this->dados['mensagem'] = "";
	}

	public function index(){
		$this->load->view('login', $this->dados);
		$this->load->view('include/footer');
	}
	
	function autenticar() {
		$usuario_email = $this->input->post('email',TRUE);
		$usuario_senha = $this->input->post('senha',TRUE);
		$result        = $this->Login_model->checar_usuario($usuario_email, $usuario_senha);
		if($result->num_rows() > 0) {
			$dados     = $result->row_array();
			$dados_sessao = array(
				'nome'      => $dados['pessoa_nome'],
				'sobrenome' => $dados['pessoa_sobrenome'],
				'campus'    => $dados['campus_descricao'],
				'curso'     => $dados['curso_descricao'],
				'telefone'  => $dados['pessoa_telefone'],
				'email'     => $dados['usuario_email'],
				'senha'     => $dados['usuario_senha'],
				'nivel'     => $dados['usuario_nivel'],
				'logado'    => TRUE
			);
	
			$this->session->set_userdata($dados_sessao);
			redirect(base_url('Home'));
	
		} else {
			$this->dados['tentou']   = TRUE;
			$this->dados['mensagem'] = "Ops! Não conseguimos te encontrar, tente novamente!";
			$this->index();
		}
	}

	function logout() {
		$this->session->sess_destroy();
			redirect(base_url());
	}
}
