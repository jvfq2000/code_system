<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Cadastro de cursos</title>

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
        

    </head>
    
    <body class="bg-white">
        <div class="col-12">
            <br>
            <div class="accordion" id="accordionExample">
                <div class="shadow card-header rounded mx-auto col-sm-7" id="headingOne">
                    <form name="formuser" class="form-group needs-validation" action="<?php
                                                                                    if($pegou_curso == 'S') {
                                                                                        echo base_url('Gerenciar_curso/salvar_edicao/').$curso_id;
                                                                                    } else {
                                                                                        echo base_url('Gerenciar_curso/cadastrar');
                                                                                    }?>" method='POST'novalidate>
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
                            <div class="col-md-12 mb-3">
                                <label for="curso_desc">Nome do curso</label>
                                <input type="text" class="form-control" id="curso_desc" name="curso_descricao" value="<?php if($pegou_curso == 'S') {echo $curso_descricao;}?>" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="quantidade">Quantidade de periodos</label>
                                <input type="number" class="form-control" id="quantidade" value="<?php if($pegou_curso == 'S') {echo $curso_qtd_periodos;}?>" name="curso_qtd_periodos" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
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
        
<div class="modal fade" name="modal_sucesso" id="modal_sucesso" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?php if ($tentou){ ?>
                            <img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
                            Tudo certo por aqui!
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
                        <a type="button" class="btn btn-primary " href="<?php echo base_url('Gerenciar_curso/novo');?>">Novo curso</a>
                        <a type="button" class="btn btn-danger " href="<?php echo base_url('Gerenciar_curso');?>">Sair</a>
                <?php 
                    } 
                ?>
            </div>

        </div>
    </div>
</div>
<?php  $this->load->view('include/modal_cancelar'); ?>
<?php 
    if($tentou){ 
?>	
<script>
    $(document).ready(function(){
        $('#modal_sucesso').modal('show');
    });
</script>
<?php 
    }

?>