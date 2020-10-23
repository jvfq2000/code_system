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
        $this->load->model('classes/Atividade_cat_model', 'atividade_cat');
        
        $this->dados['mostrar']        = "";
        $this->dados['tentou']         = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['sucesso']        = FALSE;
		$this->dados['pegou_curso']    = 'S';
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar'] = "tabela";
        $this->dados['sucesso'] = FALSE;
        $this->dados['linhas_quadro'] = $this->quadro->montar_tabela();
        $header['titulo'] = 'Quadro de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('quadro', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['campus_options'] = $this->campus->montar_options_campus();
        $this->dados['mostrar']      = "operacoes";
        $this->dados['pegou_quadro'] = 'N';
        $this->dados['sucesso']      = TRUE;
        $header['titulo']            = 'Quadro de Atividades';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('quadro', $this->dados);
		$this->load->view('include/footer');
	}

    public function ajax_mostrar_cursos(){
        $campus_id = $this->input->post('id');
        echo $this->curso->montar_options_curso($campus_id);
    }

    public function ajax_mostrar_categorias(){
        $campus_id = $this->input->post('id');
        echo $this->atividade_cat->montar_options_categoria($campus_id);
    }
}
