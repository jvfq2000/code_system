<br>
<br>
<br>
<div class="jumbotron shadow-sm pt-3 pb-5">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/regulamento.png'); ?>" alt="Generic placeholder image" width="100" height="100">
            Visualizar Regulamentos!
        </h1>
        <p>
            Veja os regulamentos do seu curso aqui.<br>
            Fique por dentro de todos os seus direitos e deveres!
        </p>
        <br>
    </div>
  </div>
<div class="shadow card-header rounded mx-auto col-sm-11" id="headingOne">
    
    <br>
        <div class="card-deck">
            <?php echo $regulamento; ?>
        </div>
    <br>
    <div class="row">
        <div class="col-12 mb-1">
            <a class="shadow-sm col-12 btn btn-outline-danger btn-lg"  href="<?php echo base_url('Home');?>" role="button">Voltar</a>
        </div>
    </div>
    
</div>