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
    
    //função para carregar os cursos de acordo com o campus selecionado, utilizando ajax
    $(function(){
        $("#campus").change(function(){
            let campus_id = $("#campus").val();
            let urlMostrarCursos = "<?php echo base_url('Novo_usuario/ajax_mostrar_cursos');?>";
            
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


<br><br><br>
<main role="main" class="container-fluid">
    <div class="jumbotron shadow-sm pt-3 pb-5">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/quadro.png'); ?>" alt="Generic placeholder image" width="100" height="100">
            Quadro de Atividades!
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
                $this->load->view('include/quadro/tabela_quadro');
            }
            if ($mostrar == "operacoes") {
                $this->load->view('include/quadro/operacoes_quadro');
            }
        ?>
    </div>
</main>
