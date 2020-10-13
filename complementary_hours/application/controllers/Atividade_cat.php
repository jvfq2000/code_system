<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_cat extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
    }
    
    public function index(){
        $this->dados['mostrar'] = "tabela";
        $this->dados['sucesso'] = FALSE;
        $this->dados['linhas_atividade_cat'] = $this->campus->montar_tabela();
        $header['titulo'] = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar'] = "operacoes";
        $this->dados['pegou_ativ_cat'] = 'N';
        $this->dados['sucesso'] = TRUE;
        $header['titulo'] = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    

}
