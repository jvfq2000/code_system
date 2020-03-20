<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor_model extends CI_Model {
	private $professor_id;
	private $usuario_id;

	function __construct(){
		parent::__construct();
	}

	public function getProfessor_id(){
		return $this->professor_id;
	}
	public function setProfessor_id($professor_id){
		$this->professor_id = $professor_id;
	}

	public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_curso = $usuario_id;
	}

	public function cadastrar(){
		$dados_professor = array(
			"usuario_id" => $this->getUsuario_id()
		);
		return $this->db->insert("professor",$dados_professor);
	}
}
