
<script>
    $(function(){
        $("#quadro").change(function(){
            let quadro_id = $("#quadro").val();
            let urlMostrarCategorias = "<?php echo base_url('Atividade_aluno/ajax_mostrar_categoria');?>";

            if (quadro_id == '') {
                $("#categoria").html("<option value=\"\">Selecione o quadro acima!</option>");
                $("#categoria").attr("disabled");

           } else {
                $.ajax({
                    url        : urlMostrarCategorias,
                    type       : "POST",
                    data       : {id : quadro_id},

                    beforeSend : function(){
                        $("#categoria").html("<option value=\"\">Carregando categorias de atividades ...</option>");
                    }
                })
                .done(function(categorias){
                    $("#categoria").html(categorias);
                    $("#categoria").removeAttr("disabled");
                })
                .fail(function(){
                    $("#atividade").html("Ops! Houve um erro ao carregar.");
                });
            }
        });
    }); 
    
    $(function(){
			$("#categoria").change(function(){
				let categoria_id = $("#categoria").val();
                let urlMostrarAtividades = "<?php echo base_url('Atividade_aluno/ajax_mostrar_atividade');?>";
				
                if (categoria_id == '') {
                    $("#atividade").html("<option value=\"\">Selecione a categoria acima!</option>");
                    $("#atividade").attr("disabled");
                
               } else {
    				$.ajax({
                        url        : urlMostrarAtividades,
    					type       : "POST",
    					data       : {id : categoria_id    },

    					beforeSend : function(){
    						$("#atividade").html("<option value=\"\">Carregando atividades ...</option>");
    					}
    				})
    				.done(function(atividades){
                        $("#atividade").html(atividades);
                        $("#atividade").removeAttr("disabled");
    				})
    				.fail(function(){
    					$("#categoria").html("Ops! Houve um erro ao carregar.");
    				});
                }
			});
        });
   /* function mascara(qtd_horas){ 
                if(qtd_horas.value.length == 2){
                        qtd_horas.value = ':' + qtd_horas.value; 
                }
    }*/
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
      $("#ano").keyup(function() {
          $("#ano").val(this.value.match(/[0-9]*/));
      });
    });
    
    function verifica(value){
        if(value == "Não"){
            $("#justificativa").removeAttr("disabled");
        }
    };
    
    function verificou(value){
        if(value == "Sim"){
            $("#qtd_horas_aprovadas").removeAttr("disabled");
        }
    };
</script>
   
<div class="col-12">
    <div class="accordion" id="accordionExample">
        <div class="shadow card-header rounded mx-auto col-sm-7" id="headingOne">
            <form name="formuser" class="form-group needs-validation"
                action="<?php if($pegou_atividade == 'S') {
                        echo base_url('Atividade_aluno/salvar_edicao/').$aluno_ati_id;
                    } else {
                        echo base_url('Atividade_aluno/cadastrar');
                    }   
                        ?>"
                method='POST' enctype="multipart/form-data" novalidate>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="quadro">Quadro</label>
                        <select class="custom-select" id="quadro" name="quadro" required>
                            <?php echo $quadro_options; ?>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="categoria">Categoria da atividade</label>
                        <select class="custom-select" id="categoria" name="categoria" required>
                            <?php if($pegou_atividade == 'S') {
                                echo $atividade_cat_options;
                            } else {
                                echo '<option value="">Selecione o quadro acima!</option>';
                            }?> 
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="atividade">Atividade</label>
                        <select class="custom-select" id="atividade" name="atividade" required>
                            <?php if($pegou_atividade == 'S') {
                                echo $atividade_options;
                            } else {
                                echo '<option value="">Selecione a atividade acima!</option>';
                            }?> 
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="atividade_descricao">Descrição atividade</label>
                        <input type="text" class="form-control" id="atividade_descricao" name="atividade_descricao" value="<?php if($pegou_atividade == 'S') {echo $aluno_ati_descricao;}?>" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtd_horas">Quantidade de horas</label>
                        <input type="number" class="form-control" id="qtd_horas" name="qtd_horas" placeholder="" value="<?php if($pegou_atividade == 'S') {echo $aluno_ati_qtd_horas;}?>" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-2">
                        <label for="comprovado">Comprovado</label>
                        <select class="custom-select" id="comprovado" name="comprovado" onchange="verifica(this.value)" required>
                        <option>Selecione</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>

                </div>
                
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="justificativa">Justificativa</label>
                        <textarea class="form-control" id="justificativa" name="justificativa" rows="5" value="<?php if($pegou_atividade == 'S') {echo $aluno_ati_justificativa;}?>" required disabled></textarea>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="semestre">Semestre</label>
                        <select class="custom-select" id="semestre" name="semestre" required>
                        <option>Selecione</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="ano">Ano</label>
                        <input type="text" class="form-control" id="ano" name="ano" placeholder="" value="<?php if($pegou_atividade == "S"){echo $aluno_ati_ano;}?>" maxlength="4" pattern="([0-9]{4})" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="visto">Visto pelo cordenador</label>
                        <select class="custom-select" id="visto" name="visto" onchange="verificou(this.value)" required <?php if($_SESSION['nivel'] < 3){ ?>disabled <?php }?>>
                        <option>Selecione</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-3">
                        <label for="qtd_horas_aprovadas">Horas aprovadas</label>
                        <input type="number" class="form-control" id="qtd_horas_aprovadas" name="qtd_horas_aprovadas" placeholder="" value="<?php if($pegou_atividade == 'S') {echo $aluno_ati_qtd_horas_aprovadas;}?>" required disabled>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <?php if($pegou_atividade == 'S'){ 
                if($_SESSION['nivel'] == 1){ ?>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile04">Escolher arquivo</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary" type="button" id="enviar" name="enviar">Salvar</button>
                        <button class="shadow-sm btn btn-outline-danger btn" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                  </div>
                </div>
                <?php } else if(($_SESSION['nivel'] == 2) || ($_SESSION['nivel'] == 4)){ ?>
                    <div class="input-group">
                    <div class="custom-file">
                        <a type="button" class="btn btn-primary col-11" href="<?php echo base_url('assets/files/atividades/').$aluno_ati_doc;?>">Visualizar documento</a>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary" type="button" id="enviar" name="enviar">Salvar</button>
                        <button class="shadow-sm btn btn-outline-danger btn" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                  </div>
                </div>
                <?php } ?>
                <?php if($_SESSION['nivel'] == 3){ ?>
                  <button class="shadow-sm btn btn-outline-danger btn col-12" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                <?php } 
                } else { ?>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo" aria-describedby="inputGroupFileAddon04">
                        <label class="custom-file-label" for="inputGroupFile04">Escolher arquivo</label>
                    </div>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-primary" type="button" id="enviar" name="enviar">Salvar</button>
                        <button class="shadow-sm btn btn-outline-danger btn" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                  </div>
                </div>
                <?php } ?>
                <hr class="mb-4">
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
                    if($excluiu){
                ?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <?php
                    }else if ($tentou){ 
                ?>
                        <a type="button" class="btn btn-primary" href="<?php echo base_url('Atividade_aluno/novo/');?>">Nova atividade</a>
                        <a type="button" class="btn btn-danger " href="<?php echo base_url('Atividade_aluno/');?>">Sair</a>
                    <?php 
                    }
                ?>
            </div>

        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/jquery/jquery.mask.js');?>"></script>
<?php  $this->load->view('include/modal_cancelar'); ?>
<?php 
    if(($tentou)||($sucesso)){ 
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
    $("#quadro").val("<?php echo $quadro_id?>");
    $("#atividade").val("<?php echo $atividade_id?>");
    $("#categoria").val("<?php echo $atividade_cat_id?>");
    $("#comprovado").val("<?php echo $aluno_ati_comprovado?>");
    $("#semestre").val("<?php echo $aluno_ati_semestre?>");
    $("#visto").val("<?php echo $aluno_ati_visto?>");
</script>