<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_model extends CI_Model {
	private $campus_id;
	private $campus_descricao;
	private $campus_cidade;
	private $campus_estado;

	function __construct(){
		parent::__construct();
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}

	public function getCampus_descricao(){
		return $this->campus_descricao;
	}
	public function setCampus_descricao($campus_descricao){
		$this->campus_descricao = $campus_descricao;
	}

	public function getCampus_cidade(){
		return $this->campus_cidade;
	}
	public function setCampus_cidade($campus_cidade){
		$this->campus_cidade = $campus_cidade;
	}

	public function getCampus_estado(){
		return $this->campus_estado;
	}
	public function setCampus_estado($campus_estado){
		$this->campus_estado = $campus_estado;
	}

	public function cadastrar(){
		$dados_campus = array(
			"campus_descricao" => $this->getCampus_descricao(),
			"campus_cidade" => $this->getCampus_cidade(),
			"campus_estado" => $this->getCampus_estado()
		);
		return $this->db->insert("campus",$dados_campus);
	}
}
