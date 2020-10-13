<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quadro_model extends CI_Model {
	private $quadro_id;
	private $campus_id;
	private $curso_id;
	private $quadro_descricao;
	private $quadro_horas_max;

	function __construct(){
		parent::__construct();
	}
	
	public function getQuadro_id(){
		return $this->quadro_id;
	}
	public function setQuadro_id($quadro_id){
		$this->quadro_id = $quadro_id;
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}

	public function getCurso_id(){
		return $this->curso_id;
	}
	public function setCurso_id($curso_id){
		$this->curso_id = $curso_id;
	}

	public function getQuadro_descricao(){
		return $this->quadro_descricao;
	}
	public function setQuadro_descricao($quadro_descricao){
		$this->quadro_descricao = $quadro_descricao;
	}

	public function getQuadro_horas_max(){
		return $this->quadro_horas_max;
	}
	public function setQuadro_horas_max($quadro_horas_max){
		$this->quadro_horas_max = $quadro_horas_max;
	}
    
	public function cadastrar(){
		$dados_quadro = array(
			"quadro_id"        => $this->getQuadro_id(),
			"curso_id"         => $this->getCurso_id(),
			"campus_id"        => $this->getCampus_id(),
			"quadro_descricao" => $this->getQuadro_descricao(),
			"quadro_horas_max" => $this->getQuadro_horas_max()
		);
		return $this->db->insert("quadro",$dados_quadro);
	}
    
    public function quadro_existe(){
        $this->db->select('quadro_id' , 'quadro_descricao');
        $this->db->from('quadro');
        $this->db->where('quadro_descricao',$this->getQuadro_descricao()) and $this->db->where('quadro_id',$this->getQuadro_id());
        $query = $this->db->get();
	    return ($query->num_rows() > 0); 
    }
    
	public function listar_quadro(){
		$this->db->select('quadro_id, quadro_descricao');
		$this->db->from('quadro');
		$this->db->order_by('quadro_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
	public function montar_options_quadro(){
		$options = "<option value=\"\">Selecione</option>";
		$quadro_lista = $this->listar_quadros();

		foreach($quadro_lista->result() as $quadro){
			$options .= "<option value=\"{$quadro->quadro_id}\">{$quadro->quadro_descricao}</option>";
		}
		return $options;
	}
    
    public function listar_quadros_tabela(){
		$this->db->select('quadro_id, quadro_descricao, quadro_qtd_periodos, quadro_descricao');
		$this->db->from('quadro');
		$this->db->order_by('quadro_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
    
    public function pegar_quadro(){
		$this->db->select('quadro_id, quadro_descricao, quadro_qtd_periodos');
		$this->db->from('quadro');
        $this->db->where('quadro_id', $this->getQuadro_id());
		$query = $this->db->get();
		return $query;
	}
    
    public function editar_curso(){
        $dados = array(
                'campus_id' => $this->getCampus_id(),
                'curso_descricao' => $this->getCurso_descricao(),
                'curso_qtd_periodos' => $this->getCurso_qtd_periodos()
            );
        $where = "campus_id = {$this->getCampus_id()}";
        $query = $this->db->update_string('curso', $dados, $where);
        return $this->db->query($query);
    }
    
     public function excluir(){
        return $this->db->delete('curso', array('curso_id' => $this->getCurso_id())); 
    }
    
    
    public function montar_tabela_curso(){
		$cursos_lista = $this->listar_cursos_tabela();
        $linhas = "";

		foreach($cursos_lista->result() as $curso){
            $linhas .= "<tr>";
            $linhas .= "<td>{$curso->campus_descricao}</td>";
			$linhas .= "<td>{$curso->curso_descricao}</td>";
            $linhas .= "<td>{$curso->curso_qtd_periodos}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerenciar_curso/editar/')."{$curso->curso_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Gerenciar_curso/confirmacao/')."{$curso->curso_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";        
		}
        
		return $linhas;
	}
    
    public function pesquisar(){
		$this->db->select('*');
		$this->db->from('curso');
        $this->db->join('campus', 'campus.campus_id = curso.campus_id');
        $this->db->like('curso_descricao',$this->getPesquisa());
		$this->db->order_by('curso_descricao');
		$query = $this->db->get();
		return $query;
	}
    
     public function montar_tabela_pesquisa(){
		$cursos_lista = $this->pesquisar();
        $linhas = "";

		foreach($cursos_lista->result() as $curso){
            $linhas .= "<tr>";
            $linhas .= "<td>{$curso->campus_descricao}</td>";
			$linhas .= "<td>{$curso->curso_descricao}</td>";
            $linhas .= "<td>{$curso->curso_qtd_periodos}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerenciar_curso/editar/')."{$curso->curso_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Gerenciar_curso/confirmacao/')."{$curso->curso_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";        
		}
        
		return $linhas;
	}
}
