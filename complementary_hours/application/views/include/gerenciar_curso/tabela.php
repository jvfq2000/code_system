<div class="shadow card-header rounded mx-auto col-sm-11" id="headingOne">
    <form class="form-inline mt-2 mt-md-0" action="<?php echo base_url('Gerenciar_curso/pesquisar/');?>" method='POST' novalidate>
        <input class="form-control col-9 mr-sm-2" type="text" id="pesquisar" name="pesquisar" placeholder="Pesquisar" aria-label="Search">
        <button class="btn btn-outline-success col-2 my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>
    <br>
<<<<<<< HEAD
    <div style="overflow: auto; height: 400px;">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Campus</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Periodos</th>
                    <th scope="col">Menu</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $linhas_curso; ?>
            </tbody>
        </table>
    </div>
=======
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Campus</th>
                <th scope="col">Curso</th>
                <th scope="col">Periodos</th>
                <th scope="col">Menu</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $linhas_curso; ?>
        </tbody>
    </table>
>>>>>>> c8a4d3601e1949aa89539df9dbcd4b367e792094
    <br>
    <div class="row">
        <div class="col-6 mb-1">
            <a class="shadow-sm col-12 btn btn-outline-primary btn-lg"  href="<?php echo base_url('Gerenciar_curso/novo/');?>" role="button">Novo</a>
        </div>
        <div class="col-6 mb-1">
            <a class="shadow-sm col-12 btn btn-outline-danger btn-lg"  href="<?php echo base_url('Home');?>" role="button">Voltar</a>
        </div>
    </div>
    <br>
</div>

<div class="modal fade" name="modal_sucesso" id="modal_sucesso" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?php if ($sucesso){ ?>
                            <img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
                            Tudo certo por aqui!
                    <?php } 
                    ?>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                <?php 
                        } 
                ?>
            </div>

        </div>
    </div>
</div>
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
