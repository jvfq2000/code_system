<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novo_usuario extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
		if($_SESSION['logado'] === TRUE){
			redirect(base_url('Home'));
		}
		$this->load->model('classes/Usuario_model', 'usuario');
		$this->load->model('classes/Pessoa_model', 'pessoa');
		$this->load->model('classes/Campus_model', 'campus');
		$this->load->model('classes/Curso_model', 'curso');

		$this->dados['campus_options'] = $this->campus->montar_options_campus();
		$this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
		$this->dados['mensagem']       = "";
	}
	
	public function index(){
		$this->load->view('novo_usuario', $this->dados);
		$this->load->view('include/footer');
	}

	public function ajax_mostrar_cursos(){
		$campus_id = $this->input->post('id');
		echo $this->curso->montar_options_curso($campus_id);
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
				    $this->load->library('email');
				    $config['protocol']='smtp';
                    $config['smtp_host']='ssl://smtp.googlemail.com';
                    $config['smtp_port']='465';
                    $config['smtp_timeout']='60';
                    $config['smtp_user']='complementaryhours.codesystem@gmail.com';
                    $config['smtp_pass']='cschad123';
                    $config['charset']='utf-8';
                    $config['newline']="\r\n";
                    $config['mailtype'] = 'html';
                    
                    $this->email->initialize($config);
					$this->email->from('complementaryhours.codesystem@gmail.com', 'Complementary Hours');
					$this->email->to($this->usuario->getUsuario_email());
					$this->email->subject('Confirmação de E-mail');
					
					$imagem = base_url('assets/img/logo_cadastro.png');
					$this->email->attach($imagem);
					$imagem_id = $this->email->attachment_cid($imagem);
					
					$this->email->message('Olá, '.$this->pessoa->getPessoa_nome().'! Estamos muito felizes por ter você conosco!<br><br>'
						.'Click <a href="'.base_url("Validar_email/validar/".$this->pessoa->getUsuario_id()."/true").'">aqui</a> para confirmar seu e-mail e finalizar o cadastro.<br>'
						.'<img src="imagem_id:'.$imagem_id.'" alt="Logo" />');
					$email_enviado = $this->email->send();

					$this->dados['tentou']   = TRUE;
					$this->dados['sucesso']  = TRUE;
					$this->dados['nome']     = $this->pessoa->getPessoa_nome();
					if ($email_enviado) {
						$this->dados['mensagem'] = "Estamos quase lá! Para finalizar-mos o cadastro, acesse seu e-mail e click no link de confirmação que te enviamos!";
					} else {
						$this->dados['mensagem'] = "Estamos quase lá! Infelizmente tentamos te enviar um email, mas o servidor parou, entre em contato com a gente atravéz do e-mail: complementaryhours.codesystem@gmail.com! Se possível envie um print dessa tela e qual e-mail tentou cadastrar para liberarmos seu acesso!";
					}
				}
			}
		}else {
			$this->dados['tentou']   = TRUE;
			$this->dados['sucesso']  = FALSE;
			$this->dados['mensagem'] = "Um usuário já foi cadastrado com esse email, verifique suas informações e tente novamente!";
		}
		$this->index();
	}
}