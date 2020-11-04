<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');

		$this->dados['tentou']   = 'não';
		$this->dados['mensagem'] = "";
		$this->dados['icone']    = "";
	}

	public function index(){
		if(isset($_SESSION['logado']) && $_SESSION['logado'] == TRUE){
			redirect(base_url('Home'));
		}
		$this->load->view('login', $this->dados);
		$this->load->view('include/footer');
	}

	private function falha_na_autenticacao(){
		$this->dados['tentou']   = 'sim';
		$this->dados['icone']    = base_url('assets/img/emoji/monoculo.png');
		$this->dados['mensagem'] = "Email ou senha incorretos, tente novamente!";
		$this->index();
	}

	private function email_invalido(){
		$this->dados['tentou']   = 'email';
		$this->dados['icone']    = base_url('assets/img/emoji/piscando.png');
		$this->dados['mensagem'] = "E-mail não confirmado! Te enviamos um link de confirmação. Verifique seu e-mail!";
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
                    'pessoa_id' => $dados['pessoa_id'],
					'nome'      => $dados['pessoa_nome'],
					'foto_perfil' => $dados['pessoa_foto_perfil'],
					'sobrenome' => $dados['pessoa_sobrenome'],
                    'nascimento'=> $dados['pessoa_data_nascimento'],
                    'campus_id'    => $dados['campus_id'],
					'campus'    => $dados['campus_descricao'],
					'curso_id'     => $dados['curso_id'],
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
