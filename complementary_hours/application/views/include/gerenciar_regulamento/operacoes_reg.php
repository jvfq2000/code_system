<script>
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
    
    
    
    $(document).ready(function() {
      $("#regulamento_ano").keyup(function() {
          $("#regulamento_ano").val(this.value.match(/[0-9]*/));
      });
    });
    
    $(function(){
			$("#campus").change(function(){
				let campus_id = $("#campus").val();
				let urlMostrarCursos = "<?php echo base_url('Regulamento/ajax_mostrar_cursos');?>";
				
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
    
</script>
   
<div class="col-12">
    <div class="accordion" id="accordionExample">
        <div class="shadow card-header rounded mx-auto col-sm-7" id="headingOne">
           <form name="formuser" class="form-group needs-validation" action="<?php if($pegou_regulamento == 'S') {
                                                                                                    echo base_url('Regulamento/salvar_edicao/').$regulamento_id;
                                                                                                } else {
                                                                                                    echo base_url('Regulamento/cadastrar');
                                                                                                }   
                        ?>" method='POST' enctype="multipart/form-data" novalidate>
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
                            <select class="custom-select" id="curso" name="curso" required>
                               <?php if($pegou_regulamento == 'S') {
                                    echo $curso_options;
                                } else {
                                    echo '<option value="">Selecione o estado acima!</option>';
                                }?> 
                            </select>
                            <div class="invalid-feedback">
                                Campo obrigatorio!
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="regulamento_descricao">Descrição do Regulamento</label>
                            <input type="text" class="form-control" id="regulamento_descricao" name="regulamento_descricao" placeholder="" value="<?php if($pegou_regulamento == "S"){echo $regulamento_descricao;}?>" required>
                            <div class="invalid-feedback">
                                Campo obrigatorio!
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="regulamento_ano">Ano do Regulamento</label>
                            <input type="text" class="form-control" id="regulamento_ano" name="regulamento_ano" placeholder="" value="<?php if($pegou_regulamento == "S"){echo $regulamento_ano;}?>" maxlength="4" pattern="([0-9]{4})" required>
                            <div class="invalid-feedback">
                                Campo obrigatorio!
                            </div>
                        </div>
                    </div>

                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="arquivo" name="arquivos[]" aria-describedby="inputGroupFileAddon04" multiple>
                    <label class="custom-file-label" for="inputGroupFile04">Escolher arquivo</label>
                  </div>
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary" type="button" id="enviar" name="enviar">Salvar</button>
                    <button class="shadow-sm btn btn-outline-danger btn" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
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
                    <?php if ($sucesso){ ?>
                            <img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
                            Tudo certo por aqui!
                    <?php } else { ?>
                            <img src="<?php echo base_url('assets/img/icone/erro.png');?>" height="40" width="40"/>
                            Algo deu errado!
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
                <?php
                    if(($excluiu)||($tentou_salvar)){
                ?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <?php
                    }else if ($sucesso){ 
                ?>
                        <a type="button" class="btn btn-primary" href="<?php echo base_url('Regulamento/novo/');?>">Novo Regulamento</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                        <a type="button" class="btn btn-danger " href="<?php echo base_url('Regulamento');?>">Sair</a>
                    <?php 
                    }
                ?>
            </div>

        </div>
    </div>
</div>

<?php  $this->load->view('include/modal_cancelar'); ?>
<?php 
    if(($tentou_salvar)||($sucesso)){ 
?>	
<script>
    $(document).ready(function(){
        $('#modal_sucesso').modal('show');
    });
</script>
<?php 
    }
?>

<script>
    $("#campus").val("<?php echo $campus_id?>");
    $("#curso").val("<?php echo $curso_id?>");
</script>