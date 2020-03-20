<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {
	private $base;

	function __construct(){
		parent::__construct();
	}

	public function getBase(){
		return $this->base;
	}

	public function setBase($base){
		$this->base = $base;
	}

	public function cadastrar(){
		$dados_base = array(
			"base" => $this->getBase()
		);
		return $this->db->insert("base",$dados_base);
	}
}
