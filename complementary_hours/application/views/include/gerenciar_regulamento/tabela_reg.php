<div class="shadow card-header rounded mx-auto col-sm-12" id="headingOne">
    
    <form class="form-inline mt-2 mt-md-0" action="<?php echo base_url('Regulamento/pesquisar/');?>" method='POST' novalidate>
        <input class="form-control col-11 mr-sm-2" type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
    <br>
    
    <div style="overflow: auto; height: 400px;">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Campus</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Descrição Regulamento</th>
                    <th scope="col">Ano Regulamento</th>
                    <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $linhas; ?>
            </tbody>
        </table>
    </div>
    <br>
    <div class="row">
        <div class="col-6 mb-1">
            <a class="shadow-sm col-12 btn btn-outline-primary btn-lg"  href="<?php echo base_url('Regulamento/novo/');?>" role="button">Novo</a>
        </div>
        <div class="col-6 mb-1">
            <a class="shadow-sm col-12 btn btn-outline-danger btn-lg"  href="<?php echo base_url('Home');?>" role="button">Voltar</a>
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
               <?php
                    if($excluiu){
                ?>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Entendi</button>
                <?php
                    }else if ($tentou){ 
                ?>
                        <a type="button" class="btn btn-primary" href="<?php echo base_url('Regulamento/novo/');?>">Cadastrar regulemento</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Entendi</button>
                    <?php 
                    }
                ?>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        <?php if($tentou){ ?>  
        $('#modal_sucesso').modal('show');
         <?php } ?>
    });
</script>
