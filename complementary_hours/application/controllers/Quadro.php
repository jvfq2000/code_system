<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quadro extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }

        $this->load->model('classes/Quadro_model', 'quadro');
        $this->load->model('classes/Campus_model', 'campus');
        $this->load->model('classes/Curso_model', 'curso');
        
        $this->dados['mostrar']        = "";
        $this->dados['tentou']         = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['sucesso']        = FALSE;
		$this->dados['pegou_curso']    = 'S';
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar']       = "tabela";
        $this->dados['sucesso']       = FALSE;
        $this->dados['linhas_quadro'] = $this->quadro->montar_tabela();
        $this->dados['campus_options']= $this->campus->montar_options_campus();
        $header['titulo']             = 'Quadro de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('quadro', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar']      = "operacoes";
        $this->dados['pegou_campus'] = 'N';
        $this->dados['sucesso']      = TRUE;
        $header['titulo']            = 'Quadro de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('quadro', $this->dados);
		$this->load->view('include/footer');
	}
}
