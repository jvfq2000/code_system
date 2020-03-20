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
			"curso_descricao" => $this->getCurso_descricao(),
			"curso_qtd_periodos" => $this->getCurso_qtd_periodos()
		);
		return $this->db->insert("curso",$dados_curso);
	}
}
