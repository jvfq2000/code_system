<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');

		$this->dados['tentou']   = FALSE;
		$this->dados['mensagem'] = "";
		$this->dados['icone']    = "";
	}

	public function index(){
		$this->load->view('login', $this->dados);
		$this->load->view('include/footer');
	}

	private function falha_na_autenticacao(){
		$this->dados['tentou']   = TRUE;
		$this->dados['icone']    = base_url('assets/img/emoji/monoculo');
		$this->dados['mensagem'] = "Email ou senha incorretos, tente novamente!";
		$this->index();
	}

	private function email_valido(){
		$this->dados['tentou']   = 'email';
		$this->dados['icone']    = base_url('assets/img/emoji/festa');
		$this->dados['mensagem'] = "E-mail validado com sucesso!";
		$this->index();
	}

	private function email_invalido(){
		$this->dados['tentou']   = 'email';
		$this->dados['icone']    = base_url('assets/img/emoji/piscando');
		$this->dados['mensagem'] = "Falta validar seu e-mail! Caso não tenha recebido o link de confirmação, ele já deve estar chegando!";
		$this->index();
	}
	
	public function autenticar() {
		$usuario_email = $this->input->post('email',TRUE);
		$usuario_senha = $this->input->post('senha',TRUE);
		$result        = $this->Login_model->checar_usuario($usuario_email);

		if ($result->num_rows() > 0) {
			$dados = $result->row_array();

			if (password_verify($usuario_senha, $dados['usuario_senha'])) {
				if ($dados['usuario_validou_email'] === 'S') {
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
				} else { $this->email_invalido(); }

			} else { $this->falha_na_autenticacao(); }

		} else { $this->falha_na_autenticacao(); }
	}

	function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
