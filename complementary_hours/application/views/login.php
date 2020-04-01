<!DOCTYPE html>
<html lang="pt_br">
	<head>
        <meta charset="utf-8">
        <title>Login</title>
		<link
			href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>"
			rel="stylesheet"
			integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
			crossorigin="anonymous"
		>

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
            body{
			background-image:url("<?php echo base_url('assets/img/fundo_login.png'); ?>");
				background-attachment:fixed;
				background-size:100%;
				background-repeat:no-repeat;
        	}
        </style>

        <link href="floating-labels.css" rel="stylesheet">
    </head>
    <body>
        <div class="col-12">
            <br>
            <br>
            <div class="accordion col-12 row" id="accordionExample">
			<div class="float-left col-6">
			<h1 class="text-white font-weight-bold">
            	<p class="text-left"></br></br> 
					Complementary Hours, veio para facilitar sua vida!</br></br>
				</p>
			</h1>
            <h4 class="text-white font-weight-bold">
				<p class="text-left"> 
					Chega de assinar formulários e imprimir certificados.</br></br>
					Descomplique sua vida com a gente!
                </p>
			</h4>
		</div>
		<div class="card-header rounded mx-auto col-4 bg-white float-rigth" id="headingOne">
        	<img src="<?php echo base_url('assets/img/logo.jpeg');?>" width="200" height="190" class="rounded mx-auto d-block"/>

			<?php if($tentou){ ?>
				<div class="alert alert-danger" role="alert">
					<?php
						echo $mensagem;
					?>
				</div>
			<?php } ?>
            <form class="needs-validation" novalidate action="<?php echo base_url('Login/autenticar');?>" method="POST">
            	<div class="row">
                	<div class="col-md-12 mb-2">
                		<label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="email@example.com" required autofocus>
                        <div class="invalid-feedback">
                        	Informe um e-mail válido!
                        </div>
					</div>
				</div>   
                        
                <div class="row">
                	<div class="col-md-12 mb-2">
                    	<label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" placeholder="Password"  required autofocus>
                        <div class="invalid-feedback">
                        	Informe uma senha!
                        </div>
					</div>
				</div>
                <br>
                <div class="form-group">
					<div class="form-check">
						<input type="checkbox" class="form-check-input" id="dropdownCheck">
                        <label for="dropdownCheck">
                        	Mantenha-me conectado
                        </label>
                        <a class="float-right text-dark" href="#">Esqueceu a senha?</a>
					</div>
                </div>
                <br>
				<button type="submit" class="shadow rounded mx-auto d-block btn btn-primary col-md-6">
					Login
				</button>
			</form>
            <script>
            (function() {
            	'use strict';
                window.addEventListener('load', function() {
                	var forms = document.getElementsByClassName('needs-validation');
                	var validation = Array.prototype.filter.call(forms, function(form) {
						form.addEventListener(
							'submit',
							function(event) {
                        		if (form.checkValidity() === false) {
                            		event.preventDefault();
                                	event.stopPropagation();
								}
                            	form.classList.add('was-validated');
							},
							false
						);
                    });
				}, false);
			})();
			</script>
            <br>
            <a class="text-center rounded mx-auto d-block col-12 text-dark" href="<?php echo base_url('Novo_usuario')?>">Novo por aqui? Cadastre-se!</a>
    	</div>
	</div>
