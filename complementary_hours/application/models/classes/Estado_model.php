<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
    
    public function listar_estados(){
		$this->db->select('estado_id, estado_nome');
		$this->db->from('estado');
		$this->db->order_by('estado_nome');
		$query = $this->db->get();
		return $query;
	}
    
    public function montar_options_estado(){
		$options = "<option value=\"\">Selecione</option>";
		$estados_lista = $this->listar_estados();

		foreach($estados_lista->result() as $estado){
			$options .= "<option value=\"{$estado->estado_id}\">{$estado->estado_nome}</option>";
		}
		return $options;
	}
}
    ?>