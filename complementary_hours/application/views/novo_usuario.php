<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Novo Usuário</title>

        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

        </style>

        <script src="<?php echo base_url('assets/jquery/jquery.min.js');?>"></script>
        <script type="text/javascript">
		function mascara(telefone){ 
                	if(telefone.value.length == 0){
                    		telefone.value = '(' + telefone.value; 
                	}
                	if(telefone.value.length == 3){
                		telefone.value = telefone.value + ') '; 
                	}
                	if(telefone.value.length == 8){
                		telefone.value = telefone.value + '-';
                	}
		}

        //função para carregar os cursos de acordo com o campus selecionado, utilizando ajax
		$(function(){
			$("#campus").change(function(){
				let campus_id = $("#campus").val();
				let urlMostrarCursos = "<?php echo base_url('Novo_usuario/ajax_mostrar_cursos');?>";
				
                if (campus_id == '') {
                    $("#curso").html("<option value=\"\">Selecione o campus acima!</option>");
                    $("#curso").attr("disabled");
                
               } else {
    				$.ajax({
    					url        : urlMostrarCursos,
    					type       : "POST",
    					data       : {id : campus_id},

    					beforeSend : function(){
    						$("#curso").html("<option value=\"\">Carregando cursos ...</option>");
    					}
    				})
    				.done(function(cursos){
                        $("#curso").html(cursos);
                        $("#curso").removeAttr("disabled");
    				})
    				.fail(function(){
    					$("#curso").html("Ops! Houve um erro ao carregar.");
    				});
                }
			});
        });
                            
		(function() {
		    'use strict';
		    window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
			    form.addEventListener('submit', function(event) {
                var senha = $("#senha").val();
                var repetir_senha = $("#repetir_senha").val();

                var email_separar = $("#email").val();
                var email_array   = email_separar.split("@");
                console.log(email_separar, email_array[1]);
				
                if (form.checkValidity() === false) {
				    event.preventDefault();
				    event.stopPropagation();
				} else if(email_array[1] != "aluno.ifnmg.edu.br" && email_array[1] != "ifnmg.edu.br"){
                    $("#alerts_ficam_aqui").html(
                        "<div class=\"alert alert-info\" role=\"alert\">"
                        +"Cadastre-se utilizando seu e-mail institucional! <b>exemplo@aluno.ifnmg.edu.br</b>"
                        +"<img src=\"<?php echo base_url('assets/img/emoji/nerd.png');?>\" width=\"35\" height=\"35\"/>"
                        +"</div>"
                    );
                    event.preventDefault();
                    event.stopPropagation();
                } else if(senha == "" || senha.length <= 5){
                    $("#alerts_ficam_aqui").html(
                        "<div class=\"alert alert-info\" role=\"alert\">"
                        +"Para sua segurança, a senha deve ter no mínimo 6 caracteres!"
                        +"<img src=\"<?php echo base_url('assets/img/emoji/timido.png');?>\" width=\"35\" height=\"35\"/>"
                        +"</div>"
                    );
                    event.preventDefault();
                    event.stopPropagation();
                } else if(repetir_senha != senha){
                    $("#alerts_ficam_aqui").html(
                        "<div class=\"alert alert-danger\" role=\"alert\">"
                        +"Ops! Acho que os campos \"Senha\" e \"Confirmar Senha\" <b>não</b> estão iguais!"
                        +"<img src=\"<?php echo base_url('assets/img/emoji/pensando.png');?>\" width=\"35\" height=\"35\"/>"
                        +"</div>"
                    );
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    $("#alerts_ficam_aqui").html(
                        "<div class=\"alert alert-success\" role=\"alert\">"
                        +"Muito bem! Aguarde um pouquinho enquanto ajeitamos tudo para você!"
                        +"<img src=\"<?php echo base_url('assets/img/emoji/romantico.png');?>\" width=\"35\" height=\"35\"/>"
                        +"</div>"
                    );
                }
				form.classList.add('was-validated');
			    }, false);
			});
		    }, false);
		})();
                            
	</script>

    </head>
    
    <body class="bg-white">
        <div class="col-12">
	    <img src="<?php echo base_url('assets/img/logo_cadastro.png');?>" height="160" width="500" class="rounded mx-auto d-block"/>
            <br>
            <div class="accordion" id="accordionExample">
                <div class="shadow card-header rounded mx-auto col-sm-7" id="headingOne">
                    <form name="formuser" class="form-group needs-validation" action="<?php echo base_url('Novo_usuario/cadastrar');?>" method='POST' novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="firstName" name="nome" value="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sobre_nome">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" name="sobrenome" value="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_de_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dt_nascimento" value="" name="dt_nascimento" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00) 00000-0000" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="campus">Campus</label>
                                <select class="custom-select" id="campus" name="campus" required>
					               <?php echo $campus_options; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="curso">Curso</label>
                                <select class="custom-select" id="curso" name="curso" required disabled>
    					           <option value="">Selecione o campus acima!</option>
                                </select>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="exemplo@ifnmg.edu.br" name="email" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="repetir_senha">Confirmar Senha</label>
                                <input type="password" class="form-control" placeholder="" name="repetir_senha" id="repetir_senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div id="alerts_ficam_aqui">

                        </div>
                        
                        <hr class="mb-4">
                        
                        <div class="row">
                            <div class="col-6 mb-1">
                                <button class="shadow-sm col-12 btn btn-outline-primary btn-lg" type="submit">Salvar</button>
                            </div>
                            <div class="col-6 mb-1">
                                <button class="shadow-sm col-12 btn btn-outline-danger btn-lg" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" name="modal_confirmar_email" id="modal_confirmar_email" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            <?php if ($sucesso){ ?>
                                    <img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
                                    Falta pouco <?php echo $nome ?>!
                            <?php } else { ?>
                                    <img src="<?php echo base_url('assets/img/icone/erro.png');?>" height="45" width="45"/>
                                    Algo de errado, não está certo!
                            <?php } ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                            
                    <div class="modal-body">
                        <?php 
                            echo $mensagem;
                        ?>
                    </div>
                            
                    <div class="modal-footer">
                        <?php if ($sucesso){ ?>
                                    <a class="btn btn-primary"  href="<?php echo base_url();?>" role="button">Efetuar Login</a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cadastrar Outro</button>
                            <?php } else { ?>
                                    <a class="btn btn-primary"  href="<?php echo base_url();?>" role="button">Efetuar Login</a>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Novo usuario</button>
                            <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
		<?php $this->load->view('include/modal_cancelar'); ?>

        <?php 
            if($tentou){ 
        ?>		
                <script>
                    $(document).ready(function(){
                        $('#modal_confirmar_email').modal('show');
                    });
                </script>
        <?php 
            } 
        ?>

        <script src="<?php echo base_url('assets/jquery/jquery.mask.js');?>"></script>
