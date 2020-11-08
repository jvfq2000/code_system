<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atividade_aluno_model extends CI_Model {
	private $aluno_ati_id;
	private $campus_id;
	private $curso_id;
	private $atividade_id;
    private $usuario_id;
	private $aluno_ati_descricao;
	private $aluno_ati_doc;
    private $aluno_ati_qtd_horas;
    private $aluno_ati_comprovado;
    private $aluno_ati_justificativa;
    private $aluno_ati_semestre;
    private $aluno_ati_ano;
    private $aluno_ati_qtd_horas_aprovadas;
    private $aluno_ati_visto;
    private $pesquisa;

	function __construct(){
		parent::__construct();
	}

	public function getAluno_ati_id(){
		return $this->aluno_ati_id;
	}
	public function setAluno_ati_id($aluno_ati_id){
		$this->aluno_ati_id = $aluno_ati_id;
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
    
    public function getAtividade_id(){
		return $this->atividade_id;
	}
	public function setAtividade_id($atividade_id){
		$this->atividade_id = $atividade_id;
	}
    
    public function getUsuario_id(){
		return $this->usuario_id;
	}
	public function setUsuario_id($usuario_id){
		$this->usuario_id = $usuario_id;
	}
    
    public function getAluno_ati_descricao(){
		return $this->aluno_ati_descricao;
	}
	public function setAluno_ati_descricao($aluno_ati_descricao){
		$this->aluno_ati_descricao = $aluno_ati_descricao;
	}

    public function getAluno_ati_doc(){
		return $this->aluno_ati_doc;
	}
	public function setAluno_ati_doc($aluno_ati_doc){
		$this->aluno_ati_doc = $aluno_ati_doc;
	}

    public function getAluno_ati_qtd_horas(){
		return $this->aluno_ati_qtd_horas;
	}
	public function setAluno_ati_qtd_horas($aluno_ati_qtd_horas){
		$this->aluno_ati_qtd_horas = $aluno_ati_qtd_horas;
	}

    public function getAluno_ati_comprovado(){
		return $this->aluno_ati_comprovado;
	}
	public function setAluno_ati_comprovado($aluno_ati_comprovado){
		$this->aluno_ati_comprovado = $aluno_ati_comprovado;
	}
    
    public function getAluno_ati_justificativa(){
		return $this->aluno_ati_justificativa;
	}
	public function setAluno_ati_justificativa($aluno_ati_justificativa){
		$this->aluno_ati_justificativa = $aluno_ati_justificativa;
	}

    public function getAluno_ati_semestre(){
		return $this->aluno_ati_semestre;
	}
	public function setAluno_ati_semestre($aluno_ati_semestre){
		$this->aluno_ati_semestre = $aluno_ati_semestre;
	}
    
    public function getAluno_ati_ano(){
		return $this->aluno_ati_ano;
	}
	public function setAluno_ati_ano($aluno_ati_ano){
		$this->aluno_ati_ano = $aluno_ati_ano;
	}

    public function getAluno_ati_qtd_horas_aprovadas(){
		return $this->aluno_ati_qtd_horas_aprovadas;
	}
	public function setAluno_ati_qtd_horas_aprovadas($aluno_ati_qtd_horas_aprovadas){
		$this->aluno_ati_qtd_horas_aprovadas = $aluno_ati_qtd_horas_aprovadas;
	}

    public function getAluno_ati_visto(){
		return $this->aluno_ati_visto;
	}
	
    public function setAluno_ati_visto($aluno_ati_visto){
		$this->aluno_ati_visto = $aluno_ati_visto;
	}

    public function getPesquisa(){
		return $this->pesquisa;
	}
	
    public function setPesquisa($pesquisa){
		$this->pesquisa = $pesquisa;
	}
    
	public function cadastrar(){
		$dados_atividade_aluno = array(
			"campus_id"                     => $this->getCampus_id(),
			"curso_id"                      => $this->getCurso_id(),
			"atividade_id"                  => $this->getAtividade_id(),
            "usuario_id"                    => $this->getUsuario_id(),
			"aluno_ati_descricao"           => $this->getAluno_ati_descricao(),
			"aluno_ati_doc"                 => $this->getAluno_ati_doc(),
			"aluno_ati_qtd_horas"           => $this->getAluno_ati_qtd_horas(),
			"aluno_ati_comprovado"          => $this->getAluno_ati_comprovado(),
			"aluno_ati_justificativa"       => $this->getAluno_ati_justificativa(),
			"aluno_ati_semestre"            => $this->getAluno_ati_semestre(),
			"aluno_ati_ano"                 => $this->getAluno_ati_ano(),
			"aluno_ati_qtd_horas_aprovadas" => $this->getAluno_ati_qtd_horas_aprovadas(),
			"aluno_ati_visto"               => $this->getAluno_ati_visto(),
		);
		return $this->db->insert("aluno_ati",$dados_atividade_aluno);
	}
    
    public function listar_tabela(){
		$this->db->select('campus_descricao, curso_descricao, aluno_ati_id, pessoa_nome, pessoa_sobrenome,                                              atividade_descricao, aluno_ati_descricao, aluno_ati_qtd_horas, aluno_ati_comprovado,                                        aluno_ati_justificativa, aluno_ati_semestre, aluno_ati_ano, aluno_ati_doc, aluno_ati_qtd_horas_aprovadas,                    aluno_ati_visto');
		$this->db->from('aluno_ati');
        $this->db->join('usuario', 'aluno_ati.usuario_id = usuario.usuario_id');
        $this->db->join('pessoa', 'usuario.usuario_id = pessoa.usuario_id');
        $this->db->join('campus', 'aluno_ati.campus_id = campus.campus_id');
        $this->db->join('curso', 'aluno_ati.curso_id = curso.curso_id');
        $this->db->join('atividade', 'aluno_ati.atividade_id = atividade.atividade_id');
		$this->db->order_by('atividade_descricao, aluno_ati_descricao');
		$query = $this->db->get();
		return $query;
	}
	
    public function montar_atividades(){
		$atividade_lista = $this->listar_tabela();
        $linhas = "";

		foreach($atividade_lista->result() as $atv){
            $linhas .= "<tr>";
			$linhas .= "<td>{$atv->campus_descricao}</td>";
            $linhas .= "<td>{$atv->curso_descricao}</td>";
            $linhas .= "<td>{$atv->pessoa_nome} " . " {$atv->pessoa_sobrenome}</td>";
            $linhas .= "<td>{$atv->aluno_ati_descricao}</td>";
            $linhas .= "<td>{$atv->aluno_ati_semestre}</td>";
            $linhas .= "<td>{$atv->aluno_ati_ano}</td>";
            $linhas .= "<td><a href=\"".base_url('assets/files/atividades/')."{$atv->aluno_ati_doc}\" class=\"badge badge-success\" />Documento</a></td>";
            $linhas .= "<td>{$atv->aluno_ati_qtd_horas_aprovadas}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Atividade_aluno/editar/')."{$atv->aluno_ati_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Atividade_aluno/confirmacao/')."{$atv->aluno_ati_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";
		}
        
		return $linhas;
	}
    
    public function editar(){
        $dados = array(
			"aluno_ati_id"                  => $this->getAluno_ati_id(),
			"atividade_id"                  => $this->getAtividade_id(),
			"aluno_ati_descricao"           => $this->getAluno_ati_descricao(),
			"aluno_ati_qtd_horas"           => $this->getAluno_ati_qtd_horas(),
			"aluno_ati_comprovado"          => $this->getAluno_ati_comprovado(),
			"aluno_ati_semestre"            => $this->getAluno_ati_semestre(),
			"aluno_ati_ano"                 => $this->getAluno_ati_ano(),
			"aluno_ati_qtd_horas_aprovadas" => $this->getAluno_ati_qtd_horas_aprovadas(),
			"aluno_ati_visto"               => $this->getAluno_ati_visto(),
            );
        $where = "aluno_ati_id = {$this->getAluno_ati_id()}";
        $query = $this->db->update_string('aluno_ati', $dados, $where);
        return $this->db->query($query);
    }
    
    public function pegar_atividade(){
		$this->db->select('campus_descricao, quadro.quadro_id, atividade.atividade_id, atividade_cat.atividade_cat_id,                                  curso_descricao, aluno_ati_id, pessoa_nome, pessoa_sobrenome, atividade_descricao, aluno_ati_descricao,                      atividade_cat_descricao, quadro_descricao, aluno_ati_qtd_horas, aluno_ati_comprovado,                                        aluno_ati_justificativa, aluno_ati_semestre, aluno_ati_ano, aluno_ati_doc, aluno_ati_qtd_horas_aprovadas,                    aluno_ati_visto');
		$this->db->from('aluno_ati');
        $this->db->join('usuario', 'aluno_ati.usuario_id = usuario.usuario_id');
        $this->db->join('pessoa', 'usuario.usuario_id = pessoa.usuario_id');
        $this->db->join('campus', 'aluno_ati.campus_id = campus.campus_id');
        $this->db->join('curso', 'aluno_ati.curso_id = curso.curso_id');
        $this->db->join('atividade', 'aluno_ati.atividade_id = atividade.atividade_id');
        $this->db->join('atividade_cat', 'atividade.atividade_cat_id = atividade_cat.atividade_cat_id');
        $this->db->join('quadro', 'atividade.quadro_id = quadro.quadro_id');
        $this->db->where('aluno_ati_id', $this->getAluno_ati_id());
		$query = $this->db->get();
		return $query;
	}
    
    public function excluir(){
        return $this->db->delete('aluno_ati', array('aluno_ati_id' => $this->getAluno_ati_id())); 
    }
    
    public function pesquisar(){
		$this->db->select('campus_descricao, curso_descricao, aluno_ati_id, pessoa_nome, pessoa_sobrenome,                                              atividade_descricao, aluno_ati_descricao, aluno_ati_qtd_horas, aluno_ati_comprovado,                                        aluno_ati_justificativa, aluno_ati_semestre, aluno_ati_ano, aluno_ati_doc, aluno_ati_qtd_horas_aprovadas,                    aluno_ati_visto');
		$this->db->from('aluno_ati');
        $this->db->join('usuario', 'aluno_ati.usuario_id = usuario.usuario_id');
        $this->db->join('pessoa', 'usuario.usuario_id = pessoa.usuario_id');
        $this->db->join('campus', 'aluno_ati.campus_id = campus.campus_id');
        $this->db->join('curso', 'aluno_ati.curso_id = curso.curso_id');
        $this->db->join('atividade', 'aluno_ati.atividade_id = atividade.atividade_id');
        $this->db->like('aluno_ati_descricao',$this->getPesquisa());
		$this->db->order_by('atividade_descricao, aluno_ati_descricao');
		$query = $this->db->get();
		return $query;
	}
    
    public function montar_tabela_pesquisa(){
		$atividade_lista = $this->pesquisar();
        $linhas = "";

		foreach($atividade_lista->result() as $atv){
            $linhas .= "<tr>";
			$linhas .= "<td>{$atv->campus_descricao}</td>";
            $linhas .= "<td>{$atv->curso_descricao}</td>";
            $linhas .= "<td>{$atv->pessoa_nome} " . " {$atv->pessoa_sobrenome}</td>";
            $linhas .= "<td>{$atv->aluno_ati_descricao}</td>";
            $linhas .= "<td>{$atv->aluno_ati_semestre}</td>";
            $linhas .= "<td>{$atv->aluno_ati_ano}</td>";
            $linhas .= "<td><a href=\"".base_url('assets/files/atividades/')."{$atv->aluno_ati_doc}\" class=\"badge badge-success\" />Documento</a></td>";
            $linhas .= "<td>{$atv->aluno_ati_qtd_horas_aprovadas}</td>";
            $linhas .= "<td><div class=\"row\"><a href=\"".base_url('Atividade_aluno/editar/')."{$atv->aluno_ati_id}\" />";
            $linhas .= "<img src=\"".base_url('assets/img/icone/editar.png')."\" class=\"nav-link\" width=\"55\" height=\"40\" /></a>";
            $linhas .= "<a href=\"".base_url('Atividade_aluno/confirmacao/')."{$atv->aluno_ati_id}\"/>";
            $linhas .= "<img src=\"".base_url('assets/img/icone/lixeira.png')."\" class=\"nav-link\" width=\"55\" height=\"39\" /></a></td>";
            $linhas .= "</div><tr>";
		}
        
		return $linhas;
	}
}
