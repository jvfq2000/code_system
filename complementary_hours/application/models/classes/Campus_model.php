<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campus_model extends CI_Model {
	private $campus_id;
	private $campus_descricao;
	private $estado_id;
	private $cidade_id;

	function __construct(){
		parent::__construct();
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}

	public function getCampus_descricao(){
		return $this->campus_descricao;
	}
	public function setCampus_descricao($campus_descricao){
		$this->campus_descricao = $campus_descricao;
	}

	public function getCidade_id(){
		return $this->cidade_id;
	}
	public function setCidade_id($cidade_id){
		$this->cidade_id = $cidade_id;
	}

	public function getEstado_id(){
		return $this->estado_id;
	}
	public function setEstado_id($estado_id){
		$this->estado_id = $estado_id;
	}

	public function cadastrar(){
		$dados_campus = array(
            "estado_id" => $this->getEstado_id(),
            "cidade_id" => $this->getCidade_id(),
			"campus_descricao" => $this->getCampus_descricao()
		);
		return $this->db->insert("campus",$dados_campus);
	}
    
    public function excluir(){
        return $this->db->delete('campus', array('campus_id' => $this->getCampus_id())); 
    }
    
    public function campus_existe(){
        $this->db->select('campus_descricao');
        $this->db->from('campus');
        $this->db->where('campus_descricao',$this->getCampus_descricao());
        $query = $this->db->get();
	    return ($query->num_rows() > 0); 
    }
    
    public function pegar_campus(){
		$this->db->select('campus_id, campus_descricao, cidade_id, estado_id');
		$this->db->from('campus');
        $this->db->where('campus_id', $this->getCampus_id());
		$query = $this->db->get();
		return $query;
	}
    
    public function editar_campus(){
        $this->db->where('campus_id',$this->getCampus_id());
        return $this->db->update(
        	'campus',array(
            'cidade_id' => $this->getCidade_id(),
            'estado_id' => $this->getEstado_id(),
            'campus_descricao' => $this->getCampus_descricao()
            )
        );
    }
    
	public function listar_campus(){
		$this->db->select('campus_id, campus_descricao, estado_id,cidade_id');
		$this->db->from('campus');
		$this->db->order_by('campus_descricao');
		$query = $this->db->get();
		return $query;
	}

	public function montar_options_campus(){
		$options = "<option value=\"\">Selecione</option>";
		$campus_lista = $this->listar_campus();

		foreach($campus_lista->result() as $campus){
			$options .= "<option value=\"{$campus->campus_id}\">{$campus->campus_descricao}</option>";
		}
		return $options;
	}
    
    public function listar_campus_tabela(){
		$this->db->select('campus_id, campus_descricao, estado_nome, cidade_nome');
		$this->db->from('campus');
        $this->db->join('estado', 'estado.estado_id = campus.estado_id');
        $this->db->join('cidade', 'cidade.cidade_id = campus.cidade_id');
		$this->db->order_by('campus_descricao');
		$query = $this->db->get();
		return $query;
	}
    
    public function montar_tabela_campus(){
		$campus_lista = $this->listar_campus_tabela();
        $linhas = "";

		foreach($campus_lista->result() as $campus){
            $linhas .= "<tr>";
			$linhas .= "<td>{$campus->campus_descricao}</td>";
            $linhas .= "<td>{$campus->estado_nome}</td>";
            $linhas .= "<td>{$campus->cidade_nome}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerenciar_campus/editar/')."{$campus->campus_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Gerenciar_campus/confirmacao/')."{$campus->campus_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";
		}
        
		return $linhas;
	}
}
