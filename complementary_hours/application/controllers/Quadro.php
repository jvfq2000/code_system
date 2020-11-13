<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quadro extends CI_Controller {

    private $dados;
	private $atividades;
    
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
        $header['titulo']             = 'Quadro de Atividades';
        
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
    
	public function cadastrar(){
		$this->dados['tentou']   = TRUE;
		$this->dados['mensagem'] = "Erro ao cadastrar, tente novamente!";

		$this->quadro->setCampus_id($this->input->post('campus'));
		$this->quadro->setCurso_id($this->input->post('curso'));
		$this->quadro->setQuadro_descricao($this->input->post('quadro_descricao'));
		$this->quadro->setQuadro_horas_max($this->input->post('qtd_horas'));

		if(!$this->quadro->existe()){
			$quadro_cadastrado = $this->quadro->cadastrar();
			$idQuandro = $this->quadro->get_id_ultimo_cadastro();
			if($quadro_cadastrado){
				$this->atividades = json_decode($this->input->post('atividade_json'), true);
				for($i=0; $i < (is_array($this->atividades) ? count($this->atividades) : 0); $i++){
					$dados_atividade = array(
						"atividade_cat_id" => $this->atividades[$i][0],
						"atividade_descricao" => $this->atividades[$i][1],
						"atividade_horas_min" => $this->atividades[$i][2],
						"atividade_horas_max" => $this->atividades[$i][3],
						"quadro_id" => $idQuandro
					);
					$this->db->insert("atividade",$dados_atividade);
				}
			}
			$this->dados['tentou']   = TRUE;
			$this->dados['sucesso']  = TRUE;
			$this->dados['mensagem'] = "Cadastro realizado com sucesso!";
		}else {
			$this->dados['tentou']   = TRUE;
			$this->dados['sucesso']  = FALSE;
			$this->dados['mensagem'] = "Um usuário já foi cadastrado com esse email, verifique suas informações e tente novamente!";
		}
		$this->index();
	}

    public function editar($quadro_cat_id){
        $this->dados['mostrar'] = "operacoes";
        $header['titulo']       = 'Quadro de Atividades';
        $this->dados['pegou_atividade_cat']  = 'S';
        
        $this->quadro->setQuadro_id($quadro_id);
        $result = $this->quadro->pegar_quadro();
        $quadro_result = $result->row_array();
        
        $this->dados['quadro_id'] = $quadro_result['quadro_id'];
        $this->dados['quadro_descricao'] = $quadro_result['quadro_descricao'];
        $this->dados['campus_id'] = $quadro_result['campus_id'];
        $this->dados['curso_id'] = $quadro_result['curso_id'];
        $this->dados['quadro_horas_max'] = $quadro_result['quadro_horas_max'];
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('quadro', $this->dados);
		$this->load->view('include/footer');
	}
	
	public function excluir($quadro_id){
        $this->dados['mostrar']  = "tabela";
        $header['titulo']        = 'Quadro de Atividades';
        $this->dados['mensagem'] = "Erro ao excluir Quadro de Atividades!";
        $this->dados['sucesso']  = FALSE;
        
        $this->quadro->setQuadro_id($quadro_id);
        $quadro_excluido = $this->quadro->excluir();
        $this->dados['linhas_quadro'] = $this->quadro->montar_tabela();
         
        if ($quadro_excluido) {
            $this->dados['sucesso']  = TRUE;
            $this->dados['tentou']   = TRUE;
            $this->dados['excluiu']   = TRUE;
			$this->dados['mensagem'] = "Quadro de Atividades excluido com sucesso!";
        }
        
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
