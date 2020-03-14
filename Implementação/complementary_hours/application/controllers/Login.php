<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index(){
		$this->load->view('login');
		$this->load->view('include/footer');
	}
	
	function autenticar() {
                $usuario_email = $this->input->post('email',TRUE);
                $usuario_senha = $this->input->post('senha',TRUE);
                $result        = $this->Login_model->checar_usuario($usuario_email, $usuario_senha);
                if($result->num_rows() > 0) {
                        $dados     = $result->row_array();
                        $dados_sessao = array(
                                'nome'      => $dados['pessoa_nome'],
                                'sobrenome' => $dados['pessoa_sobrenome'],
                                'campus'    => $dados['pessoa_campus'],
                                'curso'     => $dados['pessoa_curso'],
                                'telefone'  => $dados['pessoa_telefone'],
                                'email'     => $dados['usuario_email'],
                                'senha'     => $dados['usuario_senha'],
                                'nivel'     => $dados['usuario_nivel'],
                                'logado'    => TRUE
                        );
			$this->session->set_userdata($dados_sessao);
			redirect('Home');
		} else {
                        echo "<script>alert('Acesso Negado');history.go(-1);</script>";
                }
                $this->load->view('login');
        }

        function logout() {
                $this->session->sess_destroy();
                redirect(base_url());
        }

}
