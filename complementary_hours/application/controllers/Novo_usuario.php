<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novo_usuario extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
		$this->load->model('classes/Usuario_model', 'usuario');
		$this->load->model('classes/Pessoa_model', 'pessoa');

		$this->dados['tentou']   = FALSE;
		$this->dados['mensagem'] = "";
	}
	
	public function index(){
		$this->load->view('novo_usuario', $this->dados);
		$this->load->view('include/footer');
	}

	public function cadastrar(){
		$this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao cadastrar, tente novamente!";

		$this->usuario->setUsuario_email($this->input->post('email'));
		$this->usuario->setUsuario_senha($this->input->post('senha'));

		if(!$this->usuario->email_existe()){
			$usuario_cadastrado = $this->usuario->cadastrar();
		
			if($usuario_cadastrado){
				$this->pessoa->setUsuario_id($this->usuario->get_id_ultimo_cadastro());
				$this->pessoa->setCampus_id($this->input->post("campus"));
				$this->pessoa->setCurso_id($this->input->post("curso"));
				$this->pessoa->setPessoa_nome($this->input->post("nome"));
				$this->pessoa->setPessoa_sobrenome($this->input->post("sobrenome"));
				$this->pessoa->setPessoa_data_nascimento($this->input->post("dt_nascimento"));
				$this->pessoa->setPessoa_telefone($this->input->post("telefone"));
				$pessoa_cadastrada = $this->pessoa->cadastrar();

				if($pessoa_cadastrada){
					$this->dados['tentou']   = TRUE;
					$this->dados['mensagem'] = "Cadastro realizado com sucesso!";
				}
			}
		}else {
			$this->dados['tentou']   = TRUE;
			$this->dados['mensagem'] = "Um usuário já foi cadastrado com esse email, verifique suas informações e tente novamente!";
		}
		$this->index();
	}
}
