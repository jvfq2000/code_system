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

    </head>
    
    <body class="bg-white">
        <div class="col-12">
            <img src="<?php echo base_url('assets/img/top-complementary_hours.png');?>" class="rounded mx-auto d-block"/>
            <br>
            <div class="accordion" id="accordionExample">
                <div class="card-header rounded mx-auto col-sm-7" id="headingOne">
                    <form class="form-group needs-validation" action="Cadastro_usuario/cadastrar" method='POST' novalidate>
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
                                <input type="date" class="form-control" id="firstName" placeholder="" value="" name="dt_nascimento" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" id="telefone" placeholder="" name="telefone" value="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-md-12 mb-2">
                              <label for="campus">Campus</label>
                              <select class="custom-select" name="campus"required>
                                <option selected disabled value="">Selecione</option>
                                <option value="1">Instituto Federal do Norte de Minas Gerais Campus Arinos</option>
                              </select>
                              <div class="invalid-feedback">
                                Campo obrigatorio!
                              </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-12 mb-2">
                              <label for="campus">Curso</label>
                              <select class="custom-select" name="curso"required>
                                <option selected disabled value="">Selecione</option>
                                <option value="1">Bacharelado em Administração</option>
                                <option value="2">Bacharelado em Agronomia</option>
                                <option value="3">Bacharelado em Sistemas de Informação</option>
                                <option value="4">Tecnologia em Gestão Ambiental</option>
                                <option value="5">Tecnologia em Produção de Grãos</option>
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
                                <input type="password" class="form-control" id="senha" placeholder="" name="senha" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="repetir_senha">Repetir Senha</label>
                                <input type="password" class="form-control" id="lastName" placeholder="" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mb-4">
                        
                        <div class="row">
                            <div class="col-6 mb-5">
                                <button class="col-12 btn btn-primary btn-lg" type="submit">Salvar</button>
                            </div>
                          
                            <div class="col-6 mb-5">
                                <button class="col-12 btn btn-danger btn-lg" data-toggle="modal" type="button" data-toggle="modal" data-target="#confirmacao">Cancelar</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="confirmacao" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                            
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                            
                    <div class="modal-body">
                        Deseja realmente cancelar?
                    </div>
                            
                    <div class="modal-footer">
                        <a class="btn btn-primary"  href="<?php echo base_url('login');?>" role="button">Sim</a>
                        <button type="button" class="btn btn-primary"  data-dismiss="modal">Não</button>
                    </div>
                </div>
            </div>
        </div>
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
        <script src="<?php echo base_url('assets/jquery/jquery.slim.min.js');?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js');?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    </body>
</html>
