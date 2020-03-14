<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	public function checar_usuario($usuario_email, $usuario_senha){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('usuario_email', $usuario_email);
		$this->db->where('usuario_senha', $usuario_senha);
		$this->db->join('pessoa', 'pessoa.usuario_id = usuario.usuario_id');
		$query = $this->db->get();
		return $query;
	}
}
