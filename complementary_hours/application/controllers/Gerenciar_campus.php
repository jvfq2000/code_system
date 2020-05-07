<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerenciar_campus extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }

        $this->load->model('classes/Campus_model', 'campus');
        $this->load->model('classes/Estado_model', 'estado');
        $this->load->model('classes/Cidade_model', 'cidade');
        
        $this->dados['estado_options'] = $this->estado->montar_options_estado();
        $this->dados['mostrar']        = "";
        $this->dados['tentou']         = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['sucesso']        = FALSE;
		$this->dados['pegou_campus']   = 'S';
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar']       = "tabela";
        $this->dados['sucesso']       = FALSE;
        $this->dados['linhas_campus'] = $this->campus->montar_tabela_campus();
        $header['titulo']             = 'Gerenciar Campus';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_campus', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar']      = "operacoes";
        $this->dados['pegou_campus'] = 'N';
        $this->dados['sucesso']      = TRUE;
        $header['titulo']            = 'Gerenciar Campus';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_campus', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function cadastrar(){
        $this->dados['pegou_campus']  = 'N';
        $this->dados['tentou']        = TRUE;
        $this->dados['sucesso']       = FALSE;
		$this->dados['mensagem']      = "Erro ao cadastrar, tente novamente!";
        
        $this->campus->setCampus_descricao($this->input->post("campus_descricao"));
        
		if(!$this->campus->campus_existe()){
            $this->campus->setCidade_id($this->input->post("cidade"));
            $this->campus->setEstado_id($this->input->post("estado"));
				
            $campus_cadastrado       = $this->campus->cadastrar();
            $this->dados['sucesso']  = TRUE;
            $this->dados['mensagem'] = "Campus cadastrado com sucesso!";        
        }else {
            $this->dados['sucesso']  = FALSE;
			$this->dados['mensagem'] = "Um campus já foi cadastrado com esse nome, verifique as informações e tente novamente!";
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Gerenciar Campus';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_campus', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function ajax_mostrar_cidades(){
		$estado_id = $this->input->post('id');
		echo $this->cidade->montar_options_cidade($estado_id);
	}
    
    public function editar($campus_id){
        $this->dados['mostrar']       = "operacoes";
        $header['titulo']             = 'Gerenciar Campus';
        $this->dados['pegou_campus']  = 'S';
        
        $this->campus->setCampus_id($campus_id);
        $result = $this->campus->pegar_campus();
        $campus_result = $result->row_array();
        
        $this->dados['campus_id']        = $campus_result['campus_id'];
        $this->dados['campus_descricao'] = $campus_result['campus_descricao'];
        $this->dados['estado_id']        = $campus_result['estado_id'];
        $this->dados['cidade_id']        = $campus_result['cidade_id'];
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_campus', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function salvar_edicao($campus_id){
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao salvar, tente novamente!";

        $this->campus->setCampus_id($campus_id);
        $this->campus->setCampus_descricao($this->input->post("campus_descricao"));
           
        $this->campus->setCidade_id($this->input->post("cidade"));
        $this->campus->setEstado_id($this->input->post("estado"));
        
        $campus_alterado         = $this->campus->editar_campus();
        $this->dados['mensagem'] = "Campus alterado com sucesso!";        
        $this->index();
    }
    
    public function excluir($campus_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']        = 'Gerenciar Campus';
        $this->dados['mensagem'] = "Erro ao cadastrar, tente novamente!";
        $this->dados['sucesso']  = FALSE;
        
        
        $this->campus->setCampus_id($campus_id);
        $campus_excluido = $this->campus->excluir();
        
        if ($campus_excluido) {
            $this->dados['sucesso']  = TRUE;
            $this->dados['tentou']   = TRUE;
            $this->dados['excluiu']  = TRUE;
            $this->dados['mensagem'] = "Campus excluido com sucesso!";
        }
        
        $this->dados['linhas_campus'] = $this->campus->montar_tabela_campus();
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_campus', $this->dados);
		$this->load->view('include/footer');
	}
    public function confirmacao($curso_id){
        
        $this->dados['link_confirmou'] = base_url('Gerenciar_campus/excluir/').$curso_id;
        $this->dados['link_cancelou']  = base_url('Gerenciar_campus');
        $this->dados['titulo']         = 'Confirmação';
        
        $this->load->view('include/header', $this->dados);
		$this->load->view('include/modal_excluir', $this->dados);
        $this->load->view('include/footer');
	}

}
