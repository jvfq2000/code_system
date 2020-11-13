<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_aluno extends CI_Controller {

    private $dados;
    
	function __construct(){
		parent::__construct();
        if($_SESSION['logado'] !== TRUE){
            redirect(base_url());
        }
        $this->load->model('classes/Quadro_model', 'quadro');
        $this->load->model('classes/Atividades_model', 'atividade');
        $this->load->model('classes/Atividade_aluno_model', 'atividadeAluno');
        
        $this->dados['pasta']          = 'assets/files/atividades/';
        
        $this->dados['quadro_options'] = $this->quadro->montar_options_quadro();

        $this->dados['pegou_atividade']  = 'N';
        $this->dados['tentou']         = FALSE;
		$this->dados['sucesso']        = FALSE;
        $this->dados['excluiu']        = FALSE;
		$this->dados['mensagem']       = "";
    }
    
    public function index(){
        $this->dados['mostrar'] = "tabela";
        $this->dados['sucesso'] = FALSE;
        $this->dados['tentou']        = FALSE;
        
        if($_SESSION['nivel'] == 1){
            $this->atividadeAluno->setUsuario_id($_SESSION['usuario_id']);
            $result = $this->atividadeAluno->pegar_atividade();
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades_aluno();
        }else if(($_SESSION['nivel'] == 2)||($_SESSION['nivel'] == 3)){
            $this->atividadeAluno->setCurso_id($_SESSION['curso_id']);
            $result = $this->atividadeAluno->pegar_atividade_curso();
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades_curso();
        }else{
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades();
        }
        
        $header['titulo'] = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function ajax_mostrar_atividade(){
		$cat_id = $this->input->post('cat_id');
		$qua_id = $this->input->post('qua_id');
		echo $this->atividade->montar_options_atividade($qua_id,$cat_id);
	}
    
    public function ajax_mostrar_categoria(){
        $quadro_id = $this->input->post('id');
		echo $this->atividade->montar_options_cat($quadro_id);
	}
    public function novo(){
        $this->dados['mostrar'] = "operacoes";
        $this->dados['tentou']        = FALSE;
        $this->dados['sucesso'] = FALSE;
        $header['titulo'] = 'Atividades do aluno';
        $this->dados['nivel'] = $_SESSION['nivel'];
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
        
    public function cadastrar(){
        $this->dados['tentou']        = TRUE;
        $this->dados['sucesso']       = FALSE;
		$this->dados['mensagem']      = "Erro ao cadastrar, tente novamente!";
        
        $this->atividadeAluno->setCampus_id($_SESSION['campus_id']);
        $this->atividadeAluno->setCurso_id($_SESSION['curso_id']);
        $this->atividadeAluno->setUsuario_id($_SESSION['usuario_id']);        
        $this->atividadeAluno->setAtividade_id($this->input->post("atividade"));
        $this->atividadeAluno->setAluno_ati_descricao($this->input->post("atividade_descricao"));
        $this->atividadeAluno->setAluno_ati_qtd_horas($this->input->post("qtd_horas"));
        $this->atividadeAluno->setAluno_ati_comprovado($this->input->post("comprovado"));
        $this->atividadeAluno->setAluno_ati_justificativa($this->input->post("justificativa"));
        $this->atividadeAluno->setAluno_ati_semestre($this->input->post("semestre"));
        $this->atividadeAluno->setAluno_ati_ano($this->input->post("ano"));
        $this->atividadeAluno->setAluno_ati_qtd_horas_aprovadas($this->input->post("qtd_horas_aprovadas"));
        $this->atividadeAluno->setAluno_ati_visto($this->input->post("visto"));
        
        if(isset($_POST['enviar'])){
            $formatos = array("pdf" , "txt" , "jpg" , "png" , "jpeg");
            $extencao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
            
            if(in_array($extencao, $formatos)){
                $nome_arquivo_temporario = $_FILES['arquivo']['tmp_name'];
                $novo_nome_arquivo = uniqid().".$extencao";
                
                /*if($_SESSION['foto_perfil'] != 'logo.jpeg'){
                    unlink($this->dados['pasta'].$_SESSION['foto_perfil']);
                }*/
                if(move_uploaded_file($nome_arquivo_temporario, $this->dados['pasta'].$novo_nome_arquivo)){
                    $this->atividadeAluno->setAluno_ati_doc($novo_nome_arquivo);
                    $atividade_cadastrada       = $this->atividadeAluno->cadastrar();
                    
                    $this->dados['sucesso']  = TRUE;
                    $this->dados['mensagem'] = "Atividade cadastrada com sucesso!";  
                }else{
                    $this->dados['tentou_salvar']        = TRUE;
                    $this->dados['mensagem'] = "Erro ao enviar arquivo, certifique-se de que o formato do seu arquivo seja pdf, txt, jpg, png ou jpeg";
                }
            }else{
                $this->dados['tentou_salvar']        = TRUE;
                $this->dados['mensagem'] = "Erro ao enviar arquivo, certifique-se de que o formato do seu arquivo seja pdf, txt, jpg, png ou jpeg";
            }
        }
        
        $this->dados['mostrar'] = "operacoes";
        $header['titulo'] = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function editar($aluno_ati_id){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Atividades do aluno';
        $this->dados['pegou_atividade']  = 'S';
        
        $this->atividadeAluno->setAluno_ati_id($aluno_ati_id);
        $result = $this->atividadeAluno->pegar_atividade();
        $atividade_result = $result->row_array();
        
        $this->dados['aluno_ati_id']                  = $atividade_result['aluno_ati_id'];
        $this->dados['atividade_cat_id']              = $atividade_result['atividade_cat_id'];
        $this->dados['atividade_cat_descricao']       = $atividade_result['atividade_cat_descricao'];
        $this->dados['aluno_ati_descricao']           = $atividade_result['aluno_ati_descricao'];
        $this->dados['quadro_id']                     = $atividade_result['quadro_id'];
        $this->dados['atividade_id']                  = $atividade_result['atividade_id'];
        $this->dados['atividade_descricao']           = $atividade_result['atividade_descricao'];
        $this->dados['quadro_descricao']              = $atividade_result['quadro_descricao'];
        $this->dados['aluno_ati_qtd_horas']           = $atividade_result['aluno_ati_qtd_horas'];
        $this->dados['aluno_ati_comprovado']          = $atividade_result['aluno_ati_comprovado'];
        $this->dados['aluno_ati_justificativa']       = $atividade_result['aluno_ati_justificativa'];
        $this->dados['aluno_ati_semestre']            = $atividade_result['aluno_ati_semestre'];
        $this->dados['aluno_ati_ano']                 = $atividade_result['aluno_ati_ano'];
        $this->dados['aluno_ati_doc']                 = $atividade_result['aluno_ati_doc'];
        $this->dados['aluno_ati_qtd_horas_aprovadas'] = $atividade_result['aluno_ati_qtd_horas_aprovadas'];
        $this->dados['aluno_ati_visto']               = $atividade_result['aluno_ati_visto'];
        $this->dados['atividade_options'] = $this->atividade->montar_options_atividade($atividade_result['quadro_id']);
        $this->dados['atividade_cat_options'] = $this->atividade->montar_options_cat($atividade_result['atividade_id']);
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function salvar_edicao($aluno_ati_id){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Atividades do aluno';
        $this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao Salvar, tente novamente!";
        
        $this->atividadeAluno->setAluno_ati_id($aluno_ati_id);
        
        $this->atividadeAluno->setAtividade_id($this->input->post("atividade"));
        $this->atividadeAluno->setAluno_ati_descricao($this->input->post("atividade_descricao"));
        $this->atividadeAluno->setAluno_ati_qtd_horas($this->input->post("qtd_horas"));
        $this->atividadeAluno->setAluno_ati_comprovado($this->input->post("comprovado"));
        $this->atividadeAluno->setAluno_ati_semestre($this->input->post("semestre"));
        $this->atividadeAluno->setAluno_ati_ano($this->input->post("ano"));
        $this->atividadeAluno->setAluno_ati_qtd_horas_aprovadas($this->input->post("qtd_horas_aprovadas"));
        $this->atividadeAluno->setAluno_ati_visto($this->input->post("visto"));

        $atividade_alterada       = $this->atividadeAluno->editar();
        $this->dados['sucesso']  = TRUE;
        $this->dados['mensagem'] = "Alteração realizada com sucesso!";        
            
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
    }
    
    public function excluir($aluno_ati_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']       = 'Atividades do aluno';
        $this->dados['sucesso']  = FALSE;
        
        
        $this->atividadeAluno->setAluno_ati_id($aluno_ati_id);
        $atividade_excluida = $this->atividadeAluno->excluir();
        
        if($_SESSION['nivel'] == 1){
            $this->atividadeAluno->setUsuario_id($_SESSION['usuario_id']);
            $result = $this->atividadeAluno->pegar_atividade();
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades_aluno();
        }else if(($_SESSION['nivel'] == 2)||($_SESSION['nivel'] == 3)){
            $this->atividadeAluno->setCurso_id($_SESSION['curso_id']);
            $result = $this->atividadeAluno->pegar_atividade_curso();
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades_curso();
        }else{
            $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_atividades();
        }
        
        
        $this->dados['sucesso']  = TRUE;
        $this->dados['tentou']   = TRUE;
        $this->dados['excluiu']  = TRUE;
        $this->dados['mensagem'] = "Atividade excluida com sucesso!";
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
    public function confirmacao($aluno_ati_id){
        $this->dados['link_confirmou'] = base_url('Atividade_aluno/excluir/').$aluno_ati_id;
        $this->dados['link_cancelou']  = base_url('Atividade_aluno');
        $this->dados['titulo']         = 'Confirmação';
        
        $this->load->view('include/header', $this->dados);
		$this->load->view('include/modal_excluir', $this->dados);
        $this->load->view('include/footer');
	}
    
    public function pesquisar(){
        $this->atividadeAluno->setPesquisa($this->input->post("pesquisar"));
        $this->atividadeAluno->pesquisar();
        
        $this->dados['mostrar']      = "tabela";
        $this->dados['linhas_atividade'] = $this->atividadeAluno->montar_tabela_pesquisa();
        $header['titulo']       = 'Atividades do aluno';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('atividade_aluno', $this->dados);
		$this->load->view('include/footer');
	}
   
}
