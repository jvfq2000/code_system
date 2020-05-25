<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerenciar_curso extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
        
        $this->load->model('classes/Curso_model', 'curso');
        $this->load->model('classes/Campus_model', 'campus');
        
        $this->dados['campus_options'] = $this->campus->montar_options_campus();
        $this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar']      = "tabela";
        $this->dados['linhas_curso'] = $this->curso->montar_tabela_curso();
        $header['titulo']            = 'Gerenciar Cursos';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_curso', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Gerenciar Cursos';
        $this->dados['pegou_curso'] = 'N';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_curso', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function cadastrar(){
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao cadastrar, tente novamente!";
        
        $this->curso->setCampus_id($this->input->post("campus"));
        $this->curso->setCurso_descricao($this->input->post("curso_descricao"));
        
        if(!$this->curso->curso_existe()){
            
            $this->curso->setCurso_qtd_periodos($this->input->post("curso_qtd_periodos"));
			$curso_cadastrado = $this->curso->cadastrar();
            
            $this->dados['mensagem'] = "Curso cadastrado com sucesso!";
		}else {
			$this->dados['mensagem'] = "Um curso deste campus já foi cadastrado com esse nome, verifique as informações e tente novamente!";
		}
        $this->dados['sucesso']  = TRUE;
		$this->novo();
    }
    
    public function editar($curso_id){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Gerenciar Cursos';
        $this->dados['pegou_curso']  = 'S';
        
        $this->curso->setCurso_id($curso_id);
        $result = $this->curso->pegar_curso();
        $curso_result = $result->row_array();
        
        $this->dados['curso_id'] = $curso_result['curso_id'];
        $this->dados['curso_descricao'] = $curso_result['curso_descricao'];
        $this->dados['curso_qtd_periodos'] = $curso_result['curso_qtd_periodos'];
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_curso', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function salvar_edicao($curso_id){
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao Salvar, tente novamente!";

        $this->curso->setCurso_id($curso_id);
        
        $this->curso->setCampus_id($this->input->post("campus"));
        $this->curso->setCurso_descricao($this->input->post("curso_descricao"));
        
        if(!$this->curso->curso_existe()){
            
            $this->curso->setCurso_qtd_periodos($this->input->post("curso_qtd_periodos"));
			$curso_cadastrado = $this->curso->editar_curso();
            
            $this->dados['sucesso']        = TRUE;
            $this->dados['mensagem'] = "Curso Alterado com sucesso!";
		}else {
			$this->dados['mensagem'] = "Um curso deste campus já foi cadastrado com esse nome, verifique as informações e tente novamente!";
		}
        $this->index();
    }
    
    public function excluir($curso_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']        = 'Gerenciar Cursos';
        $this->dados['mensagem'] = "Curso excluido com sucesso!";
        $this->dados['sucesso']  = FALSE;
        
        $this->curso->setCurso_id($curso_id);
        $curso_excluido = $this->curso->excluir();
        
        if ($curso_excluido) {
            $this->dados['sucesso']  = TRUE;
            $this->dados['tentou']   = TRUE;
            $this->dados['excluiu']   = TRUE;
            $this->dados['mensagem'] = "Curso excluido com sucesso!";
        }
        
        $this->dados['linhas_curso'] = $this->curso->montar_tabela_curso();
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_curso', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function confirmacao($curso_id){
        $this->dados['link_confirmou'] = base_url('Gerenciar_curso/excluir/').$curso_id;
        $this->dados['link_cancelou']  = base_url('Gerenciar_curso');
        $this->dados['titulo']         = 'Confirmação';
        
        $this->load->view('include/header', $this->dados);
		$this->load->view('include/modal_excluir', $this->dados);
        $this->load->view('include/footer');
	}
    
    public function pesquisar(){
        $this->curso->setPesquisa($this->input->post("pesquisar"));
        $this->curso->pesquisar();
        
        $this->dados['mostrar']      = "tabela";
        $this->dados['linhas_curso'] = $this->curso->montar_tabela_pesquisa();
        $header['titulo']            = 'Gerenciar Cursos';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_curso', $this->dados);
		$this->load->view('include/footer');
	}

}

