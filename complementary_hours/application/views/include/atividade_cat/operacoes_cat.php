<script>
    function mascara(qtd_horas){ 
                if(qtd_horas.value.length == 2){
                        qtd_horas.value = ':' + qtd_horas.value; 
                }
    }
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
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
   
<div class="col-12">
    <div class="accordion" id="accordionExample">
        <div class="shadow card-header rounded mx-auto col-sm-7" id="headingOne">
            <form name="formuser" class="form-group needs-validation"
                action="<?php if($pegou_campus == 'S') {
                        echo base_url('Gerenciar_campus/salvar_edicao/').$campus_id;
                    } else {
                        echo base_url('Gerenciar_campus/cadastrar');
                    }?>"
                method='POST'novalidate>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="campus_desc">Descrição da Categoria</label>
                        <input type="text" class="form-control" id="campus_desc" name="campus_descricao" value="" required>
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
                    <div class="col-md-12 mb-3">
                        <label for="qtd_horas">Quantidade de horas</label>
                        <input type="text" class="form-control" id="qtd_horas" name="qtd_horas" placeholder="__:__" data-mask="00:00" data-mask-selectonfocus="true" required>
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
                    <?php// if ($sucesso){ ?>
                            <img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
                            Tudo certo por aqui!
                    <?php //} else { ?>
                            <img src="<?php echo base_url('assets/img/icone/erro.png');?>" height="40" width="40"/>
                            Algo deu errado!
                    <?php //} ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <?php
                //    echo $mensagem;
                ?>
            </div>

            <div class="modal-footer">
                <?php
                  //  if($excluiu){
                ?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <?php
                    //}else if ($tentou){ 
                ?>
                        <a type="button" class="btn btn-secondary" href="<?php echo base_url('Atividade_cat/novo/');?>">Cadastrar cursos</a>
                        <a type="button" class="btn btn-primary" href="<?php echo base_url('Gerenciar_campus/novo/');?>">Novo campus</a>
                        <a type="button" class="btn btn-danger " href="<?php echo base_url('Gerenciar_campus');?>">Sair</a>
                    <?php 
                    //}
                ?>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery.mask.js');?>"></script>
<?php  $this->load->view('include/modal_cancelar'); ?>
<?php 
    //if($tentou){ 
?>	
<script>
    $(document).ready(function(){
        $('#modal_sucesso').modal('show');
    });
</script>
<?php 
    //}

    //PAROU EM ENVIAR OS DADOS PARA O EDITAR!

?>
