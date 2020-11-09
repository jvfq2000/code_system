<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulamento extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
		$this->load->model('classes/Regulamento_model', 'regulamento');
		$this->load->model('classes/Campus_model', 'campus');
		$this->load->model('classes/Curso_model', 'curso');

		$this->dados['campus_options'] = $this->campus->montar_options_campus();
		$this->dados['linhas']         = $this->regulamento->montar_tabela_regulamento();
        $this->dados['pasta']          = 'assets/files/regulamento/';
		$this->dados['tentou']         = FALSE;
		$this->dados['tentou_salvar']  = FALSE;
        $this->dados['pegou_regulamento']  = 'N';
		$this->dados['sucesso']        = FALSE;
		$this->dados['excluiu']        = FALSE;
		$this->dados['mensagem']       = "";
	}
	
	public function index(){
		$this->dados['mostrar']       = "tabela";
        $this->dados['sucesso']       = FALSE;
        $header['titulo']             = 'Gerenciar Regulamentos';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
	}

	public function ajax_mostrar_cursos(){
		$campus_id = $this->input->post('id');
		echo $this->curso->montar_options_curso($campus_id);
	}

    public function novo(){
        $this->dados['mostrar']      = "operacoes";
        $this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
        $header['titulo']            = 'Gerenciar Regulamentos';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
	}
    
	public function cadastrar(){
		$this->dados['mensagem']      = "Erro ao cadastrar, tente novamente!";
        
        if(isset($_POST['enviar'])){
            $formatos = array("pdf");
            $arquivos = $_FILES['arquivos'];
            $nomes_arquivos = $arquivos['name'];
            
            for($i = 0; $i < count($nomes_arquivos); $i++){

                $this->regulamento->setCampus_id($this->input->post("campus"));
                $this->regulamento->setCurso_id($this->input->post("curso"));
                $this->regulamento->setRegulamento_descricao($this->input->post("regulamento_descricao"));
                $this->regulamento->setRegulamento_ano($this->input->post("regulamento_ano"));
                
                if(!$this->regulamento->verificar_ano()){
                    $extensao = explode('.', $nomes_arquivos[$i]);
                    $extensao = end($extensao);
                    $nomes_arquivos[$i] = uniqid().".$extensao";

                    if(in_array($extensao, $formatos)){
                        $move = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $this->dados['pasta'].$nomes_arquivos[$i]);
                        $this->regulamento->setRegulamento_caminho($nomes_arquivos[$i]);
                        $this->regulamento->cadastrar();
                        $this->dados['sucesso']        = TRUE;
                        $this->dados['mensagem'] = "Regulamento cadastrado com sucesso";
                    } else{
                        $this->dados['tentou_salvar']        = TRUE;
                        $this->dados['mensagem'] = "Erro ao enviar arquivo, certifique-se de que o formato do seu arquivo seja PDF";
                    }    
                }else{
                    $this->dados['tentou_salvar']        = TRUE;
                    $this->dados['mensagem'] = "Regulamento ja cadastrado";
                }
            }
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Gerenciar Regulamentos';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function editar($regulamento_id){
        $this->dados['mostrar']       = "operacoes";
        $header['titulo']             = 'Gerenciar Regulamentos';
        $this->dados['pegou_regulamento']  = 'S';
        
        $this->regulamento->setRegulamento_id($regulamento_id);
        $result = $this->regulamento->pegar_regulamento();
        $regulamento_result = $result->row_array();
        
        $this->dados['regulamento_id']        = $regulamento_result['regulamento_id'];
        $this->dados['campus_id']        = $regulamento_result['campus_id'];
        $this->dados['curso_id']        = $regulamento_result['curso_id'];
        $this->dados['regulamento_descricao'] = $regulamento_result['regulamento_descricao'];
        $this->dados['regulamento_ano']       = $regulamento_result['regulamento_ano'];
		$this->dados['curso_options'] = $this->curso->montar_options_curso($regulamento_result['campus_id']);

        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function salvar_edicao($regulamento_id){
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao salvar, tente novamente!";
        
        $this->regulamento->setRegulamento_id($regulamento_id);
        $result = $this->regulamento->pegar_regulamento();
        $regulamento_result = $result->row_array();

        $this->dados['regulamento_id']        = $regulamento_result['regulamento_id'];
        $this->dados['campus_id']        = $regulamento_result['campus_id'];
        $this->dados['regulamento_descricao'] = $regulamento_result['regulamento_descricao'];
        $this->dados['regulamento_ano']       = $regulamento_result['regulamento_ano'];
        $this->dados['curso_options'] = $this->curso->montar_options_curso($regulamento_result['campus_id']);
        
        $this->regulamento->setRegulamento_id($regulamento_id);
        $this->regulamento->setCampus_id($this->input->post("campus"));
        $this->regulamento->setCurso_id($this->input->post("curso"));
        $this->regulamento->setRegulamento_descricao($this->input->post("regulamento_descricao"));
        $this->regulamento->setRegulamento_ano($this->input->post("regulamento_ano"));
  
        if(isset($_POST['enviar'])){
            $formatos = array("pdf");
            $arquivos = $_FILES['arquivos'];
            $nomes_arquivos = $arquivos['name'];
            
            for($i = 0; $i < count($nomes_arquivos); $i++){
                $extensao = explode('.', $nomes_arquivos[$i]);
                $extensao = end($extensao);
                $nomes_arquivos[$i] = uniqid().".$extensao";
                
                if(in_array($extensao, $formatos)){
                    $move = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $this->dados['pasta'].$nomes_arquivos[$i]);
                    $this->regulamento->setRegulamento_caminho($nomes_arquivos[$i]);
                    $this->regulamento->alterar();
                    $this->dados['sucesso']        = TRUE;
                    $this->dados['mensagem'] = "Regulamento alterado com sucesso";
                } else{
                    $this->dados['tentou_salvar']        = TRUE;
                    $this->dados['mensagem'] = "Erro ao enviar arquivo, certifique-se de que o formato do seu arquivo seja PDF";
                }
            }
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Gerenciar Regulamentos';
        $this->dados['pegou_regulamento']  = 'S';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function excluir($regulamento_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']        = 'Gerenciar Regulamentos';
        $this->dados['mensagem'] = "Erro ao cadastrar, tente novamente!";
        $this->dados['sucesso']  = FALSE;
        
        
        $this->regulamento->setRegulamento_id($regulamento_id);
        $regulamento_excluido = $this->regulamento->excluir();
        $this->dados['linhas']         = $this->regulamento->montar_tabela_regulamento();
        
        if ($regulamento_excluido) {
            $this->dados['sucesso']  = TRUE;
            $this->dados['tentou']   = TRUE;
            $this->dados['excluiu']  = TRUE;
            $this->dados['mensagem'] = "Regulamento excluido com sucesso!";
        }
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
	}
    public function confirmacao($regulamento_id){
        
        $this->dados['link_confirmou'] = base_url('Regulamento/excluir/').$regulamento_id;
        $this->dados['link_cancelou']  = base_url('Regulamento');
        $this->dados['titulo']         = 'Confirmação';
        
        $this->dados['linhas']         = $this->regulamento->montar_tabela_regulamento();
        $this->load->view('include/header', $this->dados);
		$this->load->view('include/modal_excluir', $this->dados);
        $this->load->view('include/footer');
	}
    
    public function pesquisar(){
        $this->regulamento->setPesquisa($this->input->post("pesquisar"));
        $this->regulamento->pesquisar();
        
        $this->dados['mostrar']       = "tabela";
        $this->dados['sucesso']       = FALSE;
        $this->dados['linhas']        = $this->regulamento->montar_tabela_pesquisa();
        $header['titulo']             = 'Gerenciar Regulamento';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('gerenciar_regulamento', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function visualizar(){
        $header['titulo']             = 'Visualizar regulamento';

        $this->regulamento->setCurso_id($_SESSION['curso_id']);
        $result = $this->regulamento->pegar_regulamento_curso();
        $this->dados['regulamento'] = $this->regulamento->montar_ano();
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('regulamentos', $this->dados);
		$this->load->view('include/footer');
    }
}
