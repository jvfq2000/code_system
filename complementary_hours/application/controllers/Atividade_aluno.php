<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_aluno extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
        $this->load->model('classes/Atividade_aluno_model', 'atividadeAluno');
        $this->load->model('classes/Campus_model', 'campus');
        $this->load->model('classes/Atividades_model', 'atividade');
        $this->dados['pasta']          = 'assets/files/atividades/';
        $this->dados['atividades_options'] = $this->atividade->montar_options_atividade();

        $this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar'] = "tabela";
        $this->dados['sucesso'] = FALSE;
        $this->dados['tentou']        = FALSE;
//        $this->dados['pegou_campus'] = 'N';
//        $this->dados['linhas_atividade_cat'] = $this->categoriaAtividade->montar_categoria_atividade();
        $header['titulo'] = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function novo(){
        $this->dados['mostrar'] = "operacoes";
        $this->dados['tentou']        = FALSE;
        $this->dados['sucesso'] = FALSE;
        $header['titulo'] = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function cadastrar(){
        $this->dados['tentou']        = TRUE;
        $this->dados['sucesso']       = FALSE;
		$this->dados['mensagem']      = "Erro ao cadastrar, tente novamente!";
        
        $this->atividadeAluno->setCampus($_SESSION['campus_id']);
        $this->atividadeAluno->setCurso($_SESSION['curso_id']);
        $this->atividadeAluno->setAluno_id($_SESSION['pessoa_id']);
        
        if(isset($_POST['enviar'])){
            $formatos = array("pdf");
            $arquivos = $_FILES['arquivos'];
            $nomes_arquivos = $arquivos['name'];
            
            for($i = 0; $i < count($nomes_arquivos); $i++){
                $this->atividadeAluno->setAtividade_id($this->input->post("atividade"));
                $this->atividadeAluno->setAluno_ati_descricao($this->input->post("atividade_descricao"));
                $this->atividadeAluno->setAluno_ati_qtd_horas($this->input->post("qtd_horas"));
                $this->atividadeAluno->setAluno_ati_comprovado($this->input->post("comprovado"));
                $this->atividadeAluno->setAluno_ati_justificativa($this->input->post("justificativa"));
                $this->atividadeAluno->setAluno_ati_semestre($this->input->post("semestre"));
                $this->atividadeAluno->setAluno_ati_ano($this->input->post("ano"));
                $this->atividadeAluno->setAluno_ati_qtd_horas_aprovadas($this->input->post("qtd_horas_aprovadas"));
                $this->atividadeAluno->setAluno_ati_visto($this->input->post("visto"));

                $extensao = explode('.', $nomes_arquivos[$i]);
                $extensao = end($extensao);
                $nomes_arquivos[$i] = uniqid().".$extensao";
                
                if(in_array($extensao, $formatos)){
                    $move = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $this->dados['pasta'].$nomes_arquivos[$i]);
                    $this->atividadeAluno->setAluno_ati_doc($nomes_arquivos[$i]);
                    $atividade_cadastrada       = $this->atividadeAluno->cadastrar();
                    $this->dados['sucesso']  = TRUE;
                    $this->dados['mensagem'] = "Atividade cadastrada com sucesso!";  
                } else{
                    $this->dados['tentou_salvar']        = TRUE;
                    $this->dados['mensagem'] = "Erro ao enviar arquivo, certifique-se de que o formato do seu arquivo seja PDF";
                }
            }
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo'] = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
    }
    
   
}
