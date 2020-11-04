<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_aluno_model extends CI_Model {
	private $aluno_ati_id;
	private $campus_id;
	private $curso_id;
	private $aluno_id;
	private $atividade_id;
	private $aluno_ati_descricao;
	private $aluno_ati_doc;
    private $aluno_ati_qtd_horas;
    private $aluno_ati_comprovado;
    private $aluno_ati_justificativa;
    private $aluno_ati_semestre;
    private $aluno_ati_ano;
    private $aluno_ati_qtd_horas_aprovadas;
    private $aluno_ati_visto;

	function __construct(){
		parent::__construct();
	}

	public function getAluno_ati_id(){
		return $this->aluno_ati_id;
	}
	public function setAluno_ati_id($aluno_ati_id){
		$this->aluno_ati_id = $aluno_ati_id;
	}
    
    public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus($campus_id){
		$this->campus_id = $campus_id;
	}

    public function getCurso_id(){
		return $this->curso_id;
	}
	public function setCurso($curso_id){
		$this->curso_id = $curso_id;
	}
    
    public function getAluno_id(){
		return $this->aluno_id;
	}
	public function setAluno_id($aluno_id){
		$this->aluno_id = $aluno_id;
	}
    
    public function getAtividade_id(){
		return $this->atividade_id;
	}
	public function setAtividade_id($atividade_id){
		$this->atividade_id = $atividade_id;
	}
    
    public function getAluno_ati_descricao(){
		return $this->aluno_ati_descricao;
	}
	public function setAluno_ati_descricao($aluno_ati_descricao){
		$this->aluno_ati_descricao = $aluno_ati_descricao;
	}

    public function getAluno_ati_doc(){
		return $this->aluno_ati_doc;
	}
	public function setAluno_ati_doc($aluno_ati_doc){
		$this->aluno_ati_doc = $aluno_ati_doc;
	}

    public function getAluno_ati_qtd_horas(){
		return $this->aluno_ati_qtd_horas;
	}
	public function setAluno_ati_qtd_horas($aluno_ati_qtd_horas){
		$this->aluno_ati_qtd_horas = $aluno_ati_qtd_horas;
	}

    public function getAluno_ati_comprovado(){
		return $this->aluno_ati_comprovado;
	}
	public function setAluno_ati_comprovado($aluno_ati_comprovado){
		$this->aluno_ati_comprovado = $aluno_ati_comprovado;
	}
    
    public function getAluno_ati_justificativa(){
		return $this->aluno_ati_justificativa;
	}
	public function setAluno_ati_justificativa($aluno_ati_justificativa){
		$this->aluno_ati_justificativa = $aluno_ati_justificativa;
	}

    public function getAluno_ati_semestre(){
		return $this->aluno_ati_semestre;
	}
	public function setAluno_ati_semestre($aluno_ati_semestre){
		$this->aluno_ati_semestre = $aluno_ati_semestre;
	}
    
    public function getAluno_ati_ano(){
		return $this->aluno_ati_ano;
	}
	public function setAluno_ati_ano($aluno_ati_ano){
		$this->aluno_ati_ano = $aluno_ati_ano;
	}

    public function getAluno_ati_qtd_horas_aprovadas(){
		return $this->aluno_ati_qtd_horas_aprovadas;
	}
	public function setAluno_ati_qtd_horas_aprovadas($aluno_ati_qtd_horas_aprovadas){
		$this->aluno_ati_qtd_horas_aprovadas = $aluno_ati_qtd_horas_aprovadas;
	}

    public function getAluno_ati_visto(){
		return $this->aluno_ati_visto;
	}
	public function setAluno_ati_visto($aluno_ati_visto){
		$this->aluno_ati_visto = $aluno_ati_visto;
	}

    
	public function cadastrar(){
		$dados_atividade_aluno = array(
			"campus_id" => $this->getCampus_id(),
			"curso_id" => $this->getCurso_id(),
			"aluno_id" => $this->getAluno_id(),
			"atividade_id" => $this->getAtividade_id(),
			"aluno_ati_id" => $this->getAluno_ati_descricao(),
			"aluno_ati_doc" => $this->getAluno_ati_doc(),
			"aluno_ati_qtd_horas" => $this->getAluno_ati_qtd_horas(),
			"aluno_ati_comprovado" => $this->getAluno_ati_comprovado(),
			"aluno_ati_justificativa" => $this->getAluno_ati_justificativa(),
			"aluno_ati_semestre" => $this->getAluno_ati_semestre(),
			"aluno_ati_ano" => $this->getAluno_ati_ano(),
			"aluno_ati_qtd_horas_aprovadas" => $this->getAluno_ati_qtd_horas_aprovadas(),
			"aluno_ati_visto" => $this->getAluno_ati_visto(),
		);
		return $this->db->insert("aluno_ati",$dados_atividade_aluno);
	}
    
    
}
