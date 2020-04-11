<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function checar_usuario($usuario_email){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->join('pessoa', 'pessoa.usuario_id = usuario.usuario_id');
		$this->db->join('curso', 'pessoa.curso_id = curso.curso_id');
		$this->db->join('campus', 'pessoa.campus_id = campus.campus_id');
		$this->db->where('usuario_email', $usuario_email);
		$query = $this->db->get();
		return $query;
	}
}
