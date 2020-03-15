<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('cadastro_model');
	}
	public function cadastrar(){
		
		$cadastrar_usuario = array(
			'usuario_email' => $this->input->post('email'),
			'usuario_senha' => $this->input->post('senha')
		);
        
        if(!$this->cadastro_model->verificarEmail($cadastrar_usuario['usuario_email'])){
            $usuario_id = $this->cadastro_model->salvarUsuario($cadastrar_usuario);
            $cadastrar_pessoa = array(
                'usuario_id'  		 => $usuario_id,
                'pessoa_nome' 		 => $this->input->post("nome"),
                'pessoa_sobrenome' 	 => $this->input->post("sobrenome"),
                'pessoa_data_nascimento' => $this->input->post("dt_nascimento"),
                'pessoa_telefone' 	 => $this->input->post("telefone"),
                'pessoa_curso' 	     => $this->input->post("curso"),
                'pessoa_campus' 	 => $this->input->post("campus")
            );
            $this->cadastro_model->salvarPessoa($cadastrar_pessoa);
            $this->load->view('sucesso');
        } else {
            echo 'Usuário já cadastrado';
        }
    }
}
