<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novo_usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('classes/Usuario_model', 'usuario');
		$this->load->model('classes/Pessoa_model', 'pessoa');
	}
	
	public function index(){
		$dados = array(
			"tentou" => FALSE
		);
		$this->load->view('novo_usuario', $dados);
		$this->load->view('include/footer');
	}

	public function cadastrar(){
		$dados = array(
			"tentou"   => TRUE,
			"mensagem" => "Erro ao cadastrar, tente novamente!",
		);
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
					$dados = array(
						"tentou"   => TRUE,
						"mensagem" => "Cadastro realizado com sucesso!"
					);
				}
			}
		}else {
            $dados = array(
				"tentou"   => TRUE,
				"mensagem" => "Este usuário já foi cadastrado!"
			);
        }
		$this->load->view('novo_usuario', $dados);
	}
}
