<br><br><br>
<main role="main" class="container-fluid">
    <div class="jumbotron shadow-sm pt-3 pb-5">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/escola.png'); ?>" alt="Generic placeholder image" width="100" height="100">
            Categoria de Atividades!
        </h1>
        <p>
            Nessa página você pode: incluir, alterar, excluir e pesquisar.<br>
            Quanto maior a permissão, maior a responsabilidade!
        </p>
        <br>
    </div>
  </div>
    <div id="view">
        <?php 
            if ($mostrar == "tabela") {
                $this->load->view('include/atividade_cat/tabela_cat');
            }
            if ($mostrar == "operacoes") {
                $this->load->view('include/atividade_cat/operacoes_cat');
            }
        ?>
    </div>
</main>
