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

		function validarSenha(){
			var senha = document.getElementById('senha').value;
			var repetir_senha = document.getElementById('repetir_senha').value;

			if(senha == "" || senha.length <= 5 || repetir_senha != senha){
				$("#modal_senha").modal();
				event.preventDefault();
			}
		}

		$(function(){
			$("#campus").change(function(){
				let campus_id = $("#campus").val();
				let urlMostrarCursos = "<?php echo base_url('Novo_usuario/ajax_mostrar_cursos');?>";
				
				console.log(urlMostrarCursos);
				console.log(campus_id);
				
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
			});
                });
                            
		(function() {
		    'use strict';
		    window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
			    form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				    event.preventDefault();
				    event.stopPropagation();
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
                    <form name="formuser" class="form-group needs-validation" action="Novo_usuario/cadastrar" method='POST' novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" name="nome" value="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sobre_nome">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" name="sobrenome" value="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_de_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dt_nascimento" placeholder="" value="" name="dt_nascimento" required>
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
                              <label for="campus">Curso</label>
                              <select class="custom-select" id="curso" name="curso" required disabled>
					<option value="">Selecione o campus acima</option>
                              </select>
                              <div class="invalid-feedback">
                                Campo obrigatorio!
                              </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="@aluno.ifnmg.edu.br" name="email" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" placeholder="" legth="6" name="senha" id="senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="repetir_senha">Confirmar Senha</label>
                                <input type="password" class="form-control" placeholder="" legth="6" name="repetir_senha" id="repetir_senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mb-4">
                        
                        <div class="row">
                            <div class="col-6 mb-1">
                                <button class="shadow-sm col-12 btn btn-outline-primary btn-lg" data-toggle="modal" type="submit" data-toggle="modal" onclick="validarSenha();">Salvar</button>
                            </div>
                            <div class="col-6 mb-1">
                                <button class="shadow-sm col-12 btn btn-outline-danger btn-lg" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_generico">Cancelar</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" name="modal_generico" id="modal_generico" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                            
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                            
		          <div class="modal-body">
                        <?php
                            if($tentou){
                                echo $mensagem;
                            } else {
                        ?>
                                Deseja realmente cancelar?
                        <?php   } ?>
                    </div>
                            
                    <div class="modal-footer">
			             <a class="btn btn-primary"  href="<?php echo base_url();?>" role="button">
                            <?php
                                if($tentou){
                                    echo "Efetuar Login";
                                } else {
                            ?>
                                    Sim
                            <?php   } ?>
                        </a>
                        <a class="btn btn-primary"  href="<?php echo base_url('Novo_usuario');?>" role="button">
                            <?php
                                if($tentou){
                                    echo "Voltar";
                                } else {
                            ?>
                                    Não
                            <?php   } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" name="modal_senha" id="modal_senha" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                            
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Senha Inválida!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                            
			<div class="modal-body">
                                A senha deve possuir mais de 6 caracteres, verifique também se os campos "Senha" e "Confirmar Senha" estão iguais!
			</div>
                            
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"  data-dismiss="modal">
				Entendi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php 
            if($tentou){ 
        ?>		
                <script>
                    $(document).ready(function(){
                        $('#modal_generico').modal('show');
                    });
                </script>
        <?php 
            } 
        ?>

        <script src="<?php echo base_url('assets/jquery/jquery.mask.js');?>"></script>
