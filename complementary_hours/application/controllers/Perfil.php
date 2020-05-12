<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	private $dados;

	function __construct(){
		parent::__construct();

		$this->load->model('classes/Usuario_model', 'usuario');
		$this->load->model('classes/Pessoa_model', 'pessoa');
        
		$this->dados['tentou']         = FALSE;
		$this->dados['pasta']          = base_url('Arquivos/Fotos_perfil/');
		$this->dados['sucesso']        = FALSE;
        $this->dados['imagem']         = FALSE;
		$this->dados['mensagem']       = "";
	}
	
	public function index(){
        
        $header['titulo']             = 'Perfil';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('perfil', $this->dados);
		$this->load->view('include/footer');
	}
    
    
    
    public function alterar(){
        
        $this->dados['tentou']   = TRUE;
        $this->dados['imagem']   = FALSE;
        
        $this->pessoa->setPessoa_id($_SESSION['pessoa_id']);
        $this->pessoa->setPessoa_nome($this->input->post("nome"));
        $this->pessoa->setPessoa_sobrenome($this->input->post("sobrenome"));
        $this->pessoa->setPessoa_data_nascimento($this->input->post("dt_nascimento"));
        $this->pessoa->setPessoa_telefone($this->input->post("telefone"));
        $this->pessoa->alterar();
        
        $_SESSION['nome'] = $this->pessoa->getPessoa_nome();
        $_SESSION['sobrenome'] = $this->pessoa->getPessoa_sobrenome();
        $_SESSION['nascimento'] = $this->pessoa->getPessoa_data_nascimento();
        $_SESSION['telefone'] = $this->pessoa->getPessoa_telefone();
        
        $this->dados['sucesso']  = TRUE;
        $this->dados['mensagem'] = "Dados alterados com sucesso!";

		$this->alterar_usuario();
    }
    public function alterar_usuario(){
        
        $header['titulo']             = 'Perfil';
        
        $this->load->view('include/header', $header);
		$this->load->view('include/menu');
		$this->load->view('perfil', $this->dados);
		$this->load->view('include/footer');
	}
    
    public function alterar_foto(){

        
        $this->dados['imagem']   = FALSE;
        if(isset($_POST['enviar'])){
            $formatos = array("png", "jpg", "jpeg");
            $extencao = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
            
            if(in_array($extencao, $formatos)){
                //system("chown 777 " . "Arquivos/Fotos_perfil/" . "");
                //chown ("Arquivos/Fotos_perfil/", 777);
                //$pasta = "Arquivos/Fotos_perfil/";
                $nome_arquivo_temporario = $_FILES['arquivo']['tmp_name'];
                $novo_nome_arquivo = uniqid().".$extencao";
                
                unlink($this->dados['pasta'].$_SESSION['foto_perfil']);
                
                if(move_uploaded_file($nome_arquivo_temporario, $this->dados['pasta'].$novo_nome_arquivo)){
                    
                    $this->pessoa->setPessoa_id($_SESSION['pessoa_id']);
                    $this->pessoa->setPessoa_foto_perfil($novo_nome_arquivo);
                    $this->pessoa->inserir_foto_pefil();
                    
                    $_SESSION['foto_perfil'] = $this->pessoa->getPessoa_foto_perfil();
                    
                    $this->dados['mensagem'] = "Foto salva com sucesso!";
                    $this->dados['imagem']   = TRUE;
                }else{
                    $this->dados['mensagem'] = "Erro ao enviar imagem";
                    $this->dados['imagem']   = TRUE;
                }
                
            }else{
                $this->dados['mensagem'] = "formato de imagem invalido";
            }
        }
        $this->dados['tentou']   = TRUE;
        $this->dados['sucesso']  = TRUE;

		$this->alterar_usuario();
    }
}