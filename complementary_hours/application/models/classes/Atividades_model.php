<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividades_model extends CI_Model {
	private $atividade_id;
	private $quadro_id;
	private $atividade_cat_id;
	private $atividade_descricao;
	private $atividade_horas_min;
	private $atividade_horas_max;
	
	function __construct(){
		parent::__construct();
	}

	public function getAtividade_id(){
		return $this->atividade_id;
	}
	public function setAtividade_id($atividade_id){
		$this->atividade_id = $atividade_id;
	}
    
    public function getQuadro_id(){
		return $this->quadro_id;
	}
	public function setQuadro_id($quadro_id){
		$this->quadro_id = $quadro_id;
	}
    
    public function getAtividade_cat_id(){
		return $this->atividade_cat_id;
	}
	public function setAtividade_cat_id($atividade_cat_id){
		$this->atividade_cat_id = $atividade_cat_id;
	}
    
    public function getAtividade_descricao(){
		return $this->atividade_descricao;
	}
	public function setAtividade_descricao($atividade_descricao){
		$this->atividade_descricao = $atividade_descricao;
	}
    
    public function listar_atividades(){
		$this->db->select('atividade_id, atividade_descricao');
		$this->db->from('atividade');
		$this->db->order_by('atividade_descricao');
		$query = $this->db->get();
		return $query;
	}

    public function montar_options_atividade(){
		$options = "<option value=\"\">Selecione</option>";
		$atividade_lista = $this->listar_atividades();

		foreach($atividade_lista->result() as $atividades){
			$options .= "<option value=\"{$atividades->atividade_id}\">{$atividades->atividade_descricao}</option>";
		}
		return $options;
	}
}
