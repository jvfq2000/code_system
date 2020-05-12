<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	private $usuario_id;
	private $usuario_email;
	private $usuario_senha;
	private $usuario_nivel;

	function __construct(){
		parent::__construct();
	}

	public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}

	public function getUsuario_email(){
		return $this->usuario_email;
	}
	public function setUsuario_email($usuario_email){
		$this->usuario_email = $usuario_email;
	}

	public function getUsuario_senha(){
		return $this->usuario_senha;
	}
	public function setUsuario_senha($usuario_senha){
		$this->usuario_senha = $usuario_senha;
	}

	public function getUsuario_nivel(){
		return $this->usuario_nivel;
	}
	public function setUsuario_nivel($usuario_nivel){
		$this->usuario_nivel = $usuario_nivel;
	}	

	public function cadastrar(){
		$dados_usuario = array(
			"usuario_email" => $this->getUsuario_email(),
			"usuario_senha" => password_hash($this->getUsuario_senha(), PASSWORD_DEFAULT)
		);
		return $this->db->insert("usuario",$dados_usuario);
	}

	public function get_id_ultimo_cadastro(){
		return $this->db->insert_id();
	}
	
	public function email_existe(){
        $this->db->select('usuario_email');
        $this->db->from('usuario');
        $this->db->where('usuario_email',$this->getUsuario_email());
        $query = $this->db->get();
	    return ($query->num_rows() > 0); 
    }

    public function validar_email(){
    	$dados = array('usuario_validou_email' => 'S');
    	$where = "usuario_id = {$this->getUsuario_id()}";
        $query = $this->db->update_string('usuario', $dados, $where);
        return $this->db->query($query);
    }
}
