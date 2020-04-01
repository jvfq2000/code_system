<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends CI_Model {
	private $aluno_id;
	private $usuario_id;
	private $aluno_ano_inicio_curso;

	function __construct(){
		parent::__construct();
	}

	public function getAluno_id(){
		return $this->aluno_id;
	}
	public function setAluno_id($aluno_id){
		$this->aluno_id = $aluno_id;
	}

	public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_curso = $usuario_id;
	}

	public function getAluno_ano_inicio_curso(){
		return $this->aluno_ano_inicio_curso;
	}
	public function setAluno_ano_inicio_curso($aluno_ano_inicio_curso){
		$this->aluno_ano_inicio_curso = $aluno_ano_inicio_curso;
	}
	
	public function cadastrar(){
		$dados_aluno = array(
			"usuario_id" => $this->getUsuario_id(),
			"aluno_ano_inicio_curso" => $this->getAluno_ano_inicio_curso()
		);
		return $this->db->insert("aluno",$dados_aluno);
	}
}
