<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
    
    public function listar_cidade($estado_id){
		$this->db->select('cidade_id, cidade_nome');
		$this->db->from('cidade');
		$this->db->where('estado_id', $estado_id);
		$this->db->order_by('cidade_nome');
		$query = $this->db->get();
		return $query;
	}	

	public function montar_options_cidade($estado_id){
		$options = "<option value=\"\">Selecione</option>";
		$cidades_lista = $this->listar_cidade($estado_id);

		foreach($cidades_lista->result() as $cidade){
			$options .= "<option value=\"{$cidade->cidade_id}\">{$cidade->cidade_nome}</option>";
		}
		return $options;
	}
}