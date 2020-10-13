<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {
	private $atividade_cat_id;
	private $campus_id;
	private $atividade_cat_descricao;
	private $atividade_cat_horas_max;
	private $pesquisa;

	function __construct(){
		parent::__construct();
	}

	public function getAtividade_cat_id(){
		return $this->atividade_cat_id;
	}
	public function setAtividade_cat_id($atividade_cat_id){
		$this->atividade_cat_id = $atividade_cat_id;
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}
	
	public function getAtividade_cat_descricao(){
		return $this->atividade_cat_descricao;
	}
	public function setAtividade_cat_descricao($atividade_cat_descricao){
		$this->atividade_cat_id = $atividade_cat_descricao;
	}
	
	public function getAtividade_cat_horas_max(){
		return $this->atividade_cat_horas_max;
	}
	public function setAtividade_cat_horas_max($atividade_cat_horas_max){
		$this->atividade_cat_horas_max = $atividade_cat_horas_max;
	}

    public function getPesquisa(){
		return $this->pesquisa;
	}
	public function setPesquisa($pesquisa){
		$this->pesquisa = $pesquisa;
	}

	public function cadastrar(){
		$dados_atividade_cat = array(
			"atividade_cat_id" => $this->getAtividade_cat_id()
			"curso_id" => $this->getCurso_id()
			"atividade_cat_descricao" => $this->getAtividade_cat_descricao()
			"atividade_cat_horas_max" => $this->getAtividade_cat_horas_max()
		);
		return $this->db->insert("atividade_cat",$dados_atividade_cat);
	}

    public function excluir(){
        return $this->db->delete('atividade_cat', array('atividade_cat_id' => $this->getAtividade_cat_id())); 
    }

    public function editar(){
        $dados = array(
            'atividade_cat_id' => $this->getAtividade_cat_id(),
            'campus_id' => $this->getCampus_id(),
            'atividade_cat_descricao' => $this->getAtividade_cat_descricao()
            'atividade_cat_horas_max' => $this->getAtividade_cat_horas_max(),
            );
        $where = "atividade_cat_id = {$this->getAtividade_cat_id()}";
        $query = $this->db->update_string('atividade_cat', $dados, $where);
        return $this->db->query($query);
    }

    public function pegar_atividade_cat(){
		$this->db->select('*');
		$this->db->from('atividade_cat');
        $this->db->where('atividade_cat_id', $this->getAtividade_cat_id());
		$query = $this->db->get();
		return $query;
	}

	public function listar(){
		$this->db->select('*');
		$this->db->from('atividade_cat');
		$this->db->order_by('atividade_cat_descricao');
		$query = $this->db->get();
		return $query;
	}

    public function listar_tabela(){
		$this->db->select('atividade_cat.*, campus.descricao');
		$this->db->from('atividade_cat');
        $this->db->join('campus', 'atividade_cat.campus_id = campus.campus_id');
		$this->db->order_by('campus_descricao, atividade_cat_descricao');
		$query = $this->db->get();
		return $query;
	}
	
    public function montar_campus(){
		$atividade_cat_lista = $this->listar_tabela();
        $linhas = "";

		foreach($atividade_cat_lista->result() as $atv_cat){
            $linhas .= "<tr>";
			$linhas .= "<td>{$atv_cat->campus_descricao}</td>";
            $linhas .= "<td>{$atv_cat->atividade_cat_descricao}</td>";
            $linhas .= "<td>{$atv_cat->atividade_cat_horas_max}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Gerenciar_atividade_cat/editar/')."{$campus->atividade_cat_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Gerenciar_atividade_cat/confirmacao/')."{$atividade_cat->atividade_cat_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";
		}
        
		return $linhas;
	}

    public function pesquisar(){
		$this->db->select('*');
		$this->db->from('atividade_cat');
        $this->db->join('campus', 'atividade_cat.campus_id = campus.campus_id');
        $this->db->like('atividade_cat_descricao',$this->getPesquisa());
		$this->db->order_by('campus_descricao, atividade_cat_descricao');
		$query = $this->db->get();
		return $query;
	}
}
