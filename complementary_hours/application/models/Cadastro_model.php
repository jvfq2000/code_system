<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Cadastro_model extends CI_Model{
        
        public function salvarUsuario($cadastrar_usuario){
                $this->db->insert('usuario',$cadastrar_usuario);  
                return $this->db->insert_id();
        }
        
        public function salvarPessoa($cadastrar_pessoa){
            $this->db->insert('pessoa',$cadastrar_pessoa);   
        }
        
        public function verificarEmail($usuario_email){
            $this->db->where('usuario_email',$usuario_email);
            return $this->db->get('usuario')->row_array();
        }
       
    }






?>