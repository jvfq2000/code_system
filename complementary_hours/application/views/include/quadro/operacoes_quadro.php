<div class="col-12">
    <div class="accordion" id="accordionExample">
        <div class="shadow card-header rounded mx-auto col-sm-11" id="headingOne">
            <form name="formuser" class="form-group needs-validation"
                action="<?php if($pegou_quadro == 'S') {
                        echo base_url('Quadro/salvar_edicao/').$quadro_id;
                    } else {
                        echo base_url('Quadro/cadastrar');
                    }?>"
                method='POST'novalidate>
                <h1 class="text-center">
                    Quadro
                </h1>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="campus">Campus</label>
                        <select class="custom-select" id="campus" name="campus" required>
                           <?php echo $campus_options; ?>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                
                    <div class="col-md-6 mb-2">
                        <label for="curso">Curso</label>
                        <select class="custom-select" id="curso" name="curso" required>
                           <option value="">Selecione o campus!</option>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-9 mb-3">
                        <label for="quadro_desc">Descrição do Quadro</label>
                        <input type="text" class="form-control" id="quadro_descricao" name="quadro_descricao" value="" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="qtd_horas">Quantidade de horas</label>
                        <input type="number" step="0.01" class="form-control" id="qtd_horas" name="qtd_horas" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <br>
                <h1 class="text-center">
                    Atividades
                </h1>
                <hr class="mb-4">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="cat-atividade">Categoria atividades</label>
                        <select class="custom-select" id="cat-atividade" name="cat-atividade" required>
                           <option value="">Selecione o campus!</option>
                        </select>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="atividade_desc">Descrição da Atividade</label>
                        <input type="text" class="form-control" id="atividade_desc" name="atividade_descricao" value="" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="qtd_horas_min">Quantidade de horas minimas</label>
                        <input type="number" step="0.01" class="form-control" id="qtd_horas_min" name="qtd_horas_min" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="qtd_horas_max">Quantidade de horas maximas</label>
                        <input type="number" step="0.01" class="form-control" id="qtd_horas_max" name="qtd_horas_max" required>
                        <div class="invalid-feedback">
                            Campo obrigatorio!
                        </div>
                    </div>
                    <div id="add" class="col-md-4 mb-3">
                        <br>
                        <button class="shadow-sm col-12 btn btn-outline-primary btn-lg" type="button">Adicionar</button>
                    </div>
                </div>
                    
                <hr class="mb-4">
                <div style="overflow: auto; height: 400px;">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Categoria atividade</th>
                                <th scope="col">Descrição da Atividade</th>
                                <th scope="col">Horas minimas</th>
                                <th scope="col">Horas maximas</th>
                            </tr>
                        </thead>
                        <tbody id="linhas_quadro">
                            
                        </tbody>
                    </table>
                </div>
                   
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
<script>
    src="<?php echo base_url('assets/jquery/jquery.mask.js');?>";
    let linhas_atividade = '';

    $("#add").click(function() {
        linhas_atividade = linhas_atividade +
            '<tr>'+
                '<td>teste</td>'+
                '<td>teste</td>'+
                '<td>teste</td>'+
                '<td>teste</td>'+
            '<tr>';

        $("#linhas_quadro").html(linhas_atividade);
    });
</script>
<?php  $this->load->view('include/modal_cancelar'); ?>
<?php 
    //if($tentou){ 
?>	
<script>
  /*  $(document).ready(function(){
        $('#modal_sucesso').modal('show');
    });*/
</script>
<?php 
?>
