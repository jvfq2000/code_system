<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gerar_pdf extends CI_Controller {

	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
        
        $this->load->library('pdf_gerar');
        $this->load->model('classes/Atividade_aluno_model', 'atividadeAluno');
        $this->load->model('classes/Quadro_model', 'quadro');
     
    }
    
    public function index(){
        $header['titulo'] = 'Gerar pdf';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerar_pdf');
		$this->load->view('include/footer');
    }
    
    public function imprimir($aluno_ati_id){
        $header['titulo'] = 'Gerar pdf';
        
        $this->atividadeAluno->setAluno_ati_id($aluno_ati_id);
        $query = $this->atividadeAluno->pegar_atividade();
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerar_pdf', ['query'=>$query]);
		$this->load->view('include/footer');
    }
    
    public function imprimir_quadro($quadro_id){
        $header['titulo'] = 'Gerar pdf quadro';
        
        $this->quadro->setQuadro_id($quadro_id);
        $query = $this->quadro->pegar_quadro_pdf();
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerar_pdf_quadro', ['query'=>$query]);
		$this->load->view('include/footer');
    }
   
}
