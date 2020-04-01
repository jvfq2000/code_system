<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model {
	private $curso_id;
	private $curso_descricao;
	private $curso_qtd_periodos;

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

	public function cadastrar(){
		$dados_curso = array(
			"campus_id"          => $this->getCampus_id(),
			"curso_descricao"    => $this->getCurso_descricao(),
			"curso_qtd_periodos" => $this->getCurso_qtd_periodos()
		);
		return $this->db->insert("curso",$dados_curso);
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
}
