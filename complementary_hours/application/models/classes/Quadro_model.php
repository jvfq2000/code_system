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
		$dados = array(
			"quadro_id"        => $this->getQuadro_id(),
			"curso_id"         => $this->getCurso_id(),
			"campus_id"        => $this->getCampus_id(),
			"quadro_descricao" => $this->getQuadro_descricao(),
			"quadro_horas_max" => $this->getQuadro_horas_max()
		);
		return $this->db->insert("quadro",$dados);
	}
    
    public function editar(){
        $dados = array(
			"curso_id"         => $this->getCurso_id(),
			"campus_id"        => $this->getCampus_id(),
			"quadro_descricao" => $this->getQuadro_descricao(),
			"quadro_horas_max" => $this->getQuadro_horas_max()
		);
        $where = "quadro_id = {$this->getQuadro_id()}";
        $query = $this->db->update_string('quadro', $dados, $where);
        return $this->db->query($query);
    }
    
    public function excluir(){
        return $this->db->delete('quadro', array('quadro_id' => $this->getQuadro_id())); 
    }

    public function pesquisar(){
		$this->db->select('*');
		$this->db->from('quadro');
        $this->db->join('campus', 'campus.campus_id = quadro.campus_id');
        $this->db->join('curso', 'curso.curso_id = quadro.curso_id');
        $this->db->like('quadro_descricao',$this->getPesquisa());
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
    
    public function existe(){
        $this->db->select('quadro_id' , 'quadro_descricao');
        $this->db->from('quadro');
        $this->db->where('quadro_descricao',$this->getQuadro_descricao()) and $this->db->where('quadro_id',$this->getQuadro_id());
        $query = $this->db->get();
	    return ($query->num_rows() > 0); 
    }
    
	public function listar(){
		$this->db->select('*');
		$this->db->from('quadro');
		$this->db->order_by('quadro_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
	public function montar_options_quadro(){
		$options = "<option value=\"\">Selecione</option>";
		$quadro_lista = $this->listar();

		foreach($quadro_lista->result() as $quadro){
			$options .= "<option value=\"{$quadro->quadro_id}\">{$quadro->quadro_descricao}</option>";
		}
		return $options;
	}
    
    public function listar_quadro_tabela(){
		$this->db->select('quadro_id, campus_descricao, curso_descricao, quadro_descricao, quadro_horas_max');
		$this->db->from('quadro');
        $this->db->join('campus', 'campus.campus_id = quadro.campus_id');
        $this->db->join('curso', 'curso.curso_id = quadro.curso_id');
		$this->db->order_by('quadro_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
    public function montar_tabela(){
		$quadro_lista = $this->listar_quadro_tabela();
        $linhas = "";

		foreach($quadro_lista->result() as $quadro){
            $linhas .= "<tr>";
            $linhas .= "<td>{$quadro->campus_descricao}</td>";
			$linhas .= "<td>{$quadro->curso_descricao}</td>";
			$linhas .= "<td>{$quadro->quadro_descricao}</td>";
            $linhas .= "<td>{$quadro->quadro_horas_max}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerar_pdf/imprimir_quadro/')."{$quadro->quadro_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/impressora.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Quadro/editar/')."{$quadro->quadro_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Quadro/confirmacao/')."{$quadro->quadro_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";        
		}
        
		return $linhas;
	}
    
    public function montar_tabela_pesquisa(){
		$quadro_lista = $this->pesquisar();
        $linhas = "";

		foreach($quadro_lista->result() as $quadro){
            $linhas .= "<tr>";
            $linhas .= "<td>{$quadro->campus_descricao}</td>";
			$linhas .= "<td>{$quadro->curso_descricao}</td>";
			$linhas .= "<td>{$quadro->quadro_descricao}</td>";
            $linhas .= "<td>{$quadro->quadro_horas_max}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerar_pdf/imprimir_quadro/')."{$quadro->quadro_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/impressora.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Quadro/editar/')."{$quadro->quadro_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Quadro/confirmacao/')."{$quadro->quadro_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";        
		}
        
		return $linhas;
	}

    public function pegar_quadro_pdf(){
		$this->db->select('campus_descricao, quadro.quadro_id, atividade.atividade_id, atividade_descricao,                                           atividade.atividade_horas_min, atividade.atividade_horas_max, atividade_cat.atividade_cat_id,                               curso_descricao, atividade_descricao, atividade_cat_descricao, quadro_descricao, quadro_horas_max,');
		$this->db->from('atividade');
        $this->db->join('quadro', 'quadro.quadro_id = atividade.quadro_id');
        $this->db->join('campus', 'quadro.campus_id = campus.campus_id');
        $this->db->join('curso', 'quadro.curso_id = curso.curso_id');
        $this->db->join('atividade_cat', 'atividade.atividade_cat_id = atividade_cat.atividade_cat_id');
        $this->db->where('quadro.quadro_id', $this->getQuadro_id());
		$query = $this->db->get();
		return $query;
	}
}
