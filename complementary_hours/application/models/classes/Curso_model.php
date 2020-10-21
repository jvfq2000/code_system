<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {
	private $curso_id;
	private $curso_descricao;
	private $curso_qtd_periodos;
	private $pesquisa;

	function __construct(){
		parent::__construct();
	}

	public function getCurso_id(){
		return $this->curso_id;
	}
	public function setCurso_id($curso_id){
		$this->curso_id = $curso_id;
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}

	public function getCurso_descricao(){
		return $this->curso_descricao;
	}
	public function setCurso_descricao($curso_descricao){
		$this->curso_descricao = $curso_descricao;
	}

	public function getCurso_qtd_periodos(){
		return $this->curso_qtd_periodos;
	}
	public function setCurso_qtd_periodos($curso_qtd_periodos){
		$this->curso_qtd_periodos = $curso_qtd_periodos;
	}	
    public function getPesquisa(){
		return $this->pesquisa;
	}
	public function setPesquisa($pesquisa){
		$this->pesquisa = $pesquisa;
	}
    
	public function cadastrar(){
		$dados_curso = array(
			"campus_id"          => $this->getCampus_id(),
			"curso_descricao"    => $this->getCurso_descricao(),
			"curso_qtd_periodos" => $this->getCurso_qtd_periodos()
		);
		return $this->db->insert("curso",$dados_curso);
	}
    
    public function curso_existe(){
        $this->db->select('campus_id' , 'curso_descricao');
        $this->db->from('curso');
        $this->db->where('curso_descricao',$this->getCurso_descricao()) and $this->db->where('campus_id',$this->getCampus_id());
        $query = $this->db->get();
	    return ($query->num_rows() > 0); 
    }
    
	public function listar_cursos($campus_id){
		$this->db->select('curso_id, curso_descricao');
		$this->db->from('curso');
		$this->db->where('campus_id', $campus_id);
		$this->db->order_by('curso_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
	public function montar_options_curso($campus_id){
		$options = "<option value=\"\">Selecione</option>";
		$curso_lista = $this->listar_cursos($campus_id);

		foreach($curso_lista->result() as $curso){
			$options .= "<option value=\"{$curso->curso_id}\">{$curso->curso_descricao}</option>";
		}
		return $options;
	}
    
    public function listar_cursos_tabela(){
		$this->db->select('curso_id, curso_descricao, curso_qtd_periodos, campus_descricao');
		$this->db->from('curso');
        $this->db->join('campus', 'campus.campus_id = curso.campus_id');
		$this->db->order_by('curso_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
    
    public function pegar_curso(){
		$this->db->select('curso_id, campus_id, curso_descricao, curso_qtd_periodos');
		$this->db->from('curso');
        $this->db->where('curso_id', $this->getCurso_id());
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
