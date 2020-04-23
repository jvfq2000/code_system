<br><br><br>
<main role="main" class="container-fluid">
    <div class="jumbotron shadow-sm pt-3 pb-5">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/diploma.png'); ?>" alt="Generic placeholder image" width="100" height="100">
            Gerenciar Cursos!
        </h1>
        <p>
            Como administrador do nosso sistema, você pode: incluir, alterar, excluir e pesquisar.<br>
            Quanto maior a permissão, maior a responsabilidade!
        </p>
        <br>
    </div>
  </div>
    <div id="view">
        <?php 
            if ($mostrar == "tabela") {
                $this->load->view('include/gerenciar_curso/tabela');
            }
            if ($mostrar == "operacoes") {
                $this->load->view('include/gerenciar_curso/operacoes');
            }
        ?>
    </div>
</main>

