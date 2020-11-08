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
    
    public function listar_atividades($quadro_id){
		$this->db->select('atividade_id, atividade_descricao');
		$this->db->from('atividade');
        $this->db->where('quadro_id', $quadro_id);
		$this->db->order_by('atividade_descricao');
		$query = $this->db->get();
		return $query;
	}

    public function montar_options_atividade($quadro_id){
		$options = "<option value=\"\">Selecione</option>";
		$atividades_lista = $this->listar_atividades($quadro_id);

		foreach($atividades_lista->result() as $atividade){
			$options .= "<option value=\"{$atividade->atividade_id}\">{$atividade->atividade_descricao}</option>";
		}
		return $options;
	}
    
     public function listar_cat($atividade_id){
		$this->db->select('*');
		$this->db->from('atividade');
        $this->db->join('atividade_cat', 'atividade_cat.atividade_cat_id = atividade.atividade_cat_id');
		$this->db->where('atividade_id', $atividade_id);
		$this->db->order_by('atividade_cat_descricao');
		$query = $this->db->get();
		return $query;
	}	

	public function montar_options_cat($quadro_id){
		$options = "<option value=\"\">Selecione</option>";
		$categoria_lista = $this->listar_cat($quadro_id);

		foreach($categoria_lista->result() as $categoria){
			$options .= "<option value=\"{$categoria->atividade_cat_id}\">{$categoria->atividade_cat_descricao}</option>";
		}
		return $options;
	}
}
