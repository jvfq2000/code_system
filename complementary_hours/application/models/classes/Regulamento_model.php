<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulamento_model extends CI_Model {
	private $regulamento_id;
	private $campus_id;
	private $curso_id;
	private $regulamento_descricao;
	private $regulamento_caminho;
	private $regulamento_ano;
	private $pesquisa;

	function __construct(){
		parent::__construct();
	}
	
	public function getRegulamento_id(){
		return $this->regulamento_id;
	}
	public function setRegulamento_id($regulamento_id){
		$this->regulamento_id = $regulamento_id;
	}

	public function getCampus_id(){
		return $this->campus_id;
	}
	public function setCampus_id($campus_id){
		$this->campus_id = $campus_id;
	}

	public function getCurso_id(){
		return $this->curso_id;
	}
	public function setCurso_id($curso_id){
		$this->curso_id = $curso_id;
	}

	public function getRegulamento_descricao(){
		return $this->regulamento_descricao;
	}
	public function setRegulamento_descricao($regulamento_descricao){
		$this->regulamento_descricao = $regulamento_descricao;
	}
    
    public function getRegulamento_caminho(){
		return $this->regulamento_caminho;
	}
	public function setRegulamento_caminho($regulamento_caminho){
		$this->regulamento_caminho = $regulamento_caminho;
	}
    
    public function getRegulamento_ano(){
		return $this->regulamento_ano;
	}
	public function setRegulamento_ano($regulamento_ano){
		$this->regulamento_ano = $regulamento_ano;
	}
    
    public function getPesquisa(){
		return $this->pesquisa;
	}
	public function setPesquisa($pesquisa){
		$this->pesquisa = $pesquisa;
	}
    
	public function cadastrar(){
		$dados_regulamento = array(
			"regulamento_id"         => $this->getRegulamento_id(),
			"campus_id"              => $this->getCampus_id(),
			"curso_id"               => $this->getCurso_id(),
            "regulamento_descricao"  => $this->getRegulamento_descricao(),
            "regulamento_caminho"    => $this->getRegulamento_caminho(),
            "regulamento_ano"        => $this->getRegulamento_ano()
		);
        return $this->db->insert("regulamento", $dados_regulamento);
	}
    
    
    public function listar_regulamentos($regulamento_id){
		$this->db->select('*');
		$this->db->from('regulamento');
		$this->db->where('regulamento_id', $regulamento_id);
		$this->db->order_by('regulamento_descricao');
		$query = $this->db->get();
		return $query;
	}
    
    public function listar_regulamentos_tabela(){
		$this->db->select('regulamento_id, curso_descricao, campus_descricao, regulamento_descricao, regulamento_ano');
		$this->db->from('regulamento');
        $this->db->join('campus', 'campus.campus_id = regulamento.campus_id');
        $this->db->join('curso', 'curso.curso_id = regulamento.curso_id');
		$this->db->order_by('regulamento_descricao');
		$query = $this->db->get();
		return $query;
	}	
    
    public function editar_curso(){
        $dados = array(
                'campus_id' => $this->getCampus_id(),
                'curso_descricao' => $this->getCurso_descricao(),
                'curso_qtd_periodos' => $this->getCurso_qtd_periodos()
            );
        $where = "campus_id = {$this->getCampus_id()}";
        $query = $this->db->update_string('curso', $dados, $where);
        return $this->db->query($query);
    }

    public function montar_tabela_regulamento(){
		$regulamento_lista = $this->listar_regulamentos_tabela();
        $linhas = "";

		foreach($regulamento_lista->result() as $regulamento){
            $linhas .= "<tr>";
            $linhas .= "<td>{$regulamento->campus_descricao}</td>";
			$linhas .= "<td>{$regulamento->curso_descricao}</td>";
            $linhas .= "<td>{$regulamento->regulamento_descricao}</td>";
            $linhas .= "<td>{$regulamento->regulamento_ano}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Regulamento/editar/')."{$regulamento->regulamento_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Regulamento/confirmacao/')."{$regulamento->regulamento_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";        
		}
        
		return $linhas;
	}
    
    public function pegar_regulamento(){
		$this->db->select('*');
		$this->db->from('regulamento');
        $this->db->join('campus', 'campus.campus_id = regulamento.campus_id');
        $this->db->join('curso', 'curso.curso_id = regulamento.curso_id');
        $this->db->where('regulamento_id', $this->getRegulamento_id());
		$query = $this->db->get();
		return $query;
	}
    
    public function pesquisar(){
		$this->db->select('*');
		$this->db->from('regulamento');
        $this->db->join('campus', 'campus.campus_id = regulamento.campus_id');
        $this->db->join('curso', 'curso.curso_id = regulamento.curso_id');
        $this->db->like('regulamento_descricao',$this->getPesquisa());
		$this->db->order_by('regulamento_descricao');
		$query = $this->db->get();
		return $query;
	}
    
     public function montar_tabela_pesquisa(){
		$regulamentos_lista = $this->pesquisar();
        $linhas = "";

		foreach($regulamentos_lista->result() as $regulamento){
            $linhas .= "<tr>";
            $linhas .= "<td>{$regulamento->campus_descricao}</td>";
			$linhas .= "<td>{$regulamento->curso_descricao}</td>";
            $linhas .= "<td>{$regulamento->regulamento_descricao}</td>";
            $linhas .= "<td>{$regulamento->regulamento_ano}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Regulamento/editar/')."{$regulamento->regulamento_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Regulamento/confirmacao/')."{$regulamento->regulamento_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";          
		}
        
		return $linhas;
	}
  
    public function alterar(){
        $dados = array(
                        "regulamento_id"         => $this->getRegulamento_id(),
                        "campus_id"              => $this->getCampus_id(),
                        "curso_id"               => $this->getCurso_id(),
                        "regulamento_descricao"  => $this->getRegulamento_descricao(),
                        "regulamento_caminho"    => $this->getRegulamento_caminho(),
                        "regulamento_ano"        => $this->getRegulamento_ano()
                    );
    	$where = "regulamento_id = {$this->getRegulamento_id()}";
        $query = $this->db->update_string('regulamento', $dados, $where);
        return $this->db->query($query);
    }
    
    public function excluir(){
        return $this->db->delete('regulamento', array('regulamento_id' => $this->getRegulamento_id())); 
    }
    
    
    public function pegar_regulamento_curso(){
		$this->db->select('regulamento_descricao, regulamento_ano, regulamento_caminho');
		$this->db->from('regulamento');
        $this->db->join('curso', 'curso.curso_id = regulamento.curso_id');
        $this->db->where('curso.curso_id', $this->getCurso_id());
		$query = $this->db->get();
		return $query;
	}
    
    public function montar_ano(){
        $anos_lista = $this->pegar_regulamento_curso();
        $linhas = "";
        
		foreach($anos_lista->result() as $ano){
            $linhas .= "<div class=\"card\">";
                $linhas .= "<div class=\"card-body\">";
                    $linhas .= "<h5 class=\"card-title text-center\"><img src=\"".base_url('assets/img/icone/regulamento.png')."\" style=\"width:40px;\" height=\"39\" class=\"card-img-top\">{$ano->regulamento_descricao}</h5>";
                    $linhas .= "<hr class=\"featurette-divider\">";
                    $linhas .= "<p class=\"card-text text-center\">{$ano->regulamento_ano}</p>";
                $linhas .= "</div>";
                $linhas .= "<div class=\"card-footer\">";
                $linhas .= "<small class=\"text-muted\"><a href=\"".base_url('assets/files/regulamento/')."{$ano->regulamento_caminho}\" class=\"btn btn-primary col-sm-12\">Visualizar regulamento</a></small>";
                $linhas .= "</div>";
            $linhas .= "</div>";
                        
		}
		return $linhas;
    }
    
    public function verificar_ano(){
		$this->db->select('regulamento.regulamento_descricao, regulamento.regulamento_ano, campus.campus_descricao, curso.curso_descricao');
		$this->db->from('regulamento');
        $this->db->join('campus', 'campus.campus_id = regulamento.campus_id');
        $this->db->join('curso', 'curso.curso_id = regulamento.curso_id');
        $this->db->where('regulamento.regulamento_descricao', $this->getRegulamento_descricao());
        $this->db->where('campus.campus_id', $this->getCampus_id());
        $this->db->where('curso.curso_id', $this->getCurso_id());
        $this->db->where('regulamento.regulamento_ano', $this->getRegulamento_ano());
		$query = $this->db->get();
        return ($query->num_rows() > 0);
	}
    
}
