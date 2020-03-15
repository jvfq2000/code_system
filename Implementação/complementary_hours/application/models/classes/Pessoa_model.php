<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_model extends CI_Model {
	private $pessoa_id;
	private $usuario_id;
	private $campus_id;
	private $curso_id;
	private $pessoa_nome;
	private $pessoa_sobrenome;
	private $pessoa_data_nascimento;
	private $pessoa_telefone;

	function __construct(){
		parent::__construct();
	}
	
	public function getPessoa_id(){
		return $this->pessoa_id;
	}
	public function setPessoa_id($pessoa_id){
		$this->pessoa_id = $pessoa_id;
	}
	
	public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
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

	public function getPessoa_nome(){
		return $this->pessoa_nome;
	}
	public function setPessoa_nome($pessoa_nome){
		$this->pessoa_nome = $pessoa_nome;
	}

	public function getPessoa_sobrenome(){
		return $this->pessoa_sobrenome;
	}
	public function setPessoa_sobrenome($pessoa_sobrenome){
		$this->pessoa_sobrenome = $pessoa_sobrenome;
	}

	public function getPessoa_data_nascimento(){
		return $this->pessoa_data_nascimento;
	}
	public function setPessoa_data_nascimento($pessoa_data_nascimento){
		$this->pessoa_data_nascimento = $pessoa_data_nascimento;
	}

	public function getPessoa_telefone(){
		return $this->pessoa_telefone;
	}
	public function setPessoa_telefone($pessoa_telefone){
		$this->pessoa_telefone = $pessoa_telefone;
	}

	public function cadastrar(){
		$dados_pessoa = array(
			"usuario_id"             => $this->getUsuario_id(),
			"campus_id"              => $this->getCampus_id(),
			"curso_id"               => $this->getCurso_id(),
			"pessoa_nome"            => $this->getPessoa_nome(),
			"pessoa_sobrenome"       => $this->getPessoa_sobrenome(),
			"pessoa_data_nascimento" => $this->getPessoa_data_nascimento(),
			"pessoa_telefone"        => $this->getPessoa_telefone(),
		);
		return $this->bd->insert("pessoa", dados_pessoa);
	}
}
