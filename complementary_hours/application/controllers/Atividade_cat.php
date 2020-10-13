<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_cat extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
    }
    
    public function index(){
        $this->dados['mostrar']       = "tabela";
        $this->dados['sucesso']       = FALSE;
        //$this->dados['linhas_campus'] = $this->campus->montar_tabela_campus();
        $header['titulo']             = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar']      = "operacoes";
        $this->dados['pegou_campus'] = 'N';
        $this->dados['sucesso']      = TRUE;
        $header['titulo']             = 'Categoria de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_cat', $this->dados);
		//$this->load->view('include/footer');
	}
    

}
