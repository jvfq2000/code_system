<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_cat extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
        $this->load->model('classes/Atividade_cat_model', 'categoriaAtividade');
        $this->load->model('classes/Campus_model', 'campus');
        $this->dados['campus_options'] = $this->campus->montar_options_campus();

        $this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
        $this->dados['excluiu']        = FALSE;
        $this->dados['pegou_atividade_cat']  = 'N';
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar'] = "tabela";
        $this->dados['sucesso'] = FALSE;
        $this->dados['tentou']        = FALSE;
        $this->dados['linhas_atividade_cat'] = $this->categoriaAtividade->montar_categoria_atividade();
        $header['titulo'] = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar'] = "operacoes";
        $this->dados['tentou']        = FALSE;
        $this->dados['sucesso'] = FALSE;
        $header['titulo'] = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function cadastrar(){
        $this->dados['tentou']        = TRUE;
        $this->dados['sucesso']       = FALSE;
		$this->dados['mensagem']      = "Erro ao cadastrar, tente novamente!";
        
        $this->categoriaAtividade->setAtividade_cat_descricao($this->input->post("categoria_descricao"));
        $this->categoriaAtividade->setCampus_id($this->input->post("campus"));
        
		if(!$this->categoriaAtividade->categoria_existe()){
            $this->categoriaAtividade->setCampus_id($this->input->post("campus"));
            $this->categoriaAtividade->setAtividade_cat_horas_max($this->input->post("qtd_horas"));
				
            $categoria_cadastrada       = $this->categoriaAtividade->cadastrar();
            $this->dados['sucesso']  = TRUE;
            $this->dados['mensagem'] = "Categoria de Atividade cadastrada com sucesso!";        
        }else {
            $this->dados['sucesso']  = FALSE;
			$this->dados['mensagem'] = "Uma categoria já foi cadastrada com esse nome, verifique as informações e tente novamente!";
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Categoria de Atividaes';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function editar($atividade_cat_id){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Categoria de Atividaes';
        $this->dados['pegou_atividade_cat']  = 'S';
        
        $this->categoriaAtividade->setAtividade_cat_id($atividade_cat_id);
        $result = $this->categoriaAtividade->pegar_atividade_cat();
        $atividade_cat_result = $result->row_array();
        
        $this->dados['atividade_cat_id'] = $atividade_cat_result['atividade_cat_id'];
        $this->dados['atividade_cat_descricao'] = $atividade_cat_result['atividade_cat_descricao'];
        $this->dados['campus_id'] = $atividade_cat_result['campus_id'];
        $this->dados['atividade_cat_horas_max'] = $atividade_cat_result['atividade_cat_horas_max'];
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function salvar_edicao($atividade_cat_id){
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao Salvar, tente novamente!";

        $this->categoriaAtividade->setAtividade_cat_id($atividade_cat_id);
        $this->categoriaAtividade->setAtividade_cat_descricao($this->input->post("categoria_descricao"));
        
		if(!$this->categoriaAtividade->categoria_existe()){
            $this->categoriaAtividade->setCampus_id($this->input->post("campus"));
            $this->categoriaAtividade->setAtividade_cat_horas_max($this->input->post("qtd_horas"));
				
            $categoria_cadastrada       = $this->categoriaAtividade->editar();
            $this->dados['sucesso']  = TRUE;
            $this->dados['mensagem'] = "Alteração realizada com sucesso!";        
        }else {
            $this->dados['sucesso']  = FALSE;
			$this->dados['mensagem'] = "Uma categoria já foi cadastrada com esse nome, verifique as informações e tente novamente!";
        }
        $this->index();
    }
    
     public function excluir($atividade_cat_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']        = 'Categoria de Atividades';
        $this->dados['mensagem'] = "Categoria de atividade excluida com sucesso!";
        $this->dados['sucesso']  = FALSE;
        
        $this->categoriaAtividade->setAtividade_cat_id($atividade_cat_id);
        $categoria_excluida = $this->categoriaAtividade->excluir();
        $this->dados['linhas_atividade_cat'] = $this->categoriaAtividade->montar_categoria_atividade();
         
        if ($categoria_excluida) {
            $this->dados['sucesso']  = TRUE;
            $this->dados['tentou']   = TRUE;
            $this->dados['excluiu']   = TRUE;
            $this->dados['mensagem'] = "Categoria de atividade excluida com sucesso!";
        }
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function confirmacao($atividade_cat_id){
        $this->dados['link_confirmou'] = base_url('Atividade_cat/excluir/').$atividade_cat_id;
        $this->dados['link_cancelou']  = base_url('Atividade_cat');
        $this->dados['titulo']         = 'Confirmação';
        
        $this->load->view('include/header', $this->dados);
		$this->load->view('include/modal_excluir', $this->dados);
        $this->load->view('include/footer');
	}
    
     public function pesquisar(){
        $this->categoriaAtividade->setPesquisa($this->input->post("pesquisar"));
        $this->categoriaAtividade->pesquisar();
        
        $this->dados['mostrar']      = "tabela";
        $this->dados['linhas_atividade_cat'] = $this->categoriaAtividade->montar_tabela_pesquisa();
        $header['titulo']            = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}

}
