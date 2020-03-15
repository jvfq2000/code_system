
<!DOCTYPE html>
<html lang="pt_br">
    <head>
        <meta charset="utf-8">

        <title>Login</title>

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
            body{
                background: url("assets/img/fundo_login.png") no-repeat;
        }
        </style>

        <link href="floating-labels.css" rel="stylesheet">
    </head>
    <body>
        <div class="col-12">
            <br>
            <br>
            <div class="accordion col-12 row" id="accordionExample">
                <h1 class="col-6 text-white font-weight-bold">
                    <p class="text-justify"> 
                        <br>
                        <br>
                        O Complementary Hours veio para facilitar sua vida.
                        <br>
                        <br>
                        Utilize agora e se organize! 
                    </p>
                </h1>
                <div class="card-header rounded mx-auto col-4 bg-white float-right" id="headingOne">
                    <img src="<?php echo base_url('assets/img/logo_reduzida.jpg');?>" width="200" height="150" class="rounded mx-auto d-block"/>
                    <form class="needs-validation" novalidate action="login/autenticar" method="POST">
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
                        <button type="submit" class="rounded mx-auto d-block btn btn-primary col-6">Login</button>
                    </form>
                    <script>
                        // Example starter JavaScript for disabling form submissions if there are invalid fields
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
                    <br>
                    <a class="text-center rounded mx-auto d-block col-12 text-dark" href="<?php echo base_url('cadastro')?>">Novo por aqui?             Cadastre-se!</a>
                </div>
            </div>
        </div>
    </body>
</html>
