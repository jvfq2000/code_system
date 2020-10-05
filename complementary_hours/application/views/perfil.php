<script type="text/javascript">
	function mascara(telefone){ 
		if(telefone.value.length == 0){
			telefone.value = '(' + telefone.value; 
		}
		if(telefone.value.length == 3){
			telefone.value = telefone.value + ') '; 
		}
		if(telefone.value.length == 8){
			telefone.value = telefone.value + '-';
		}
	}
 (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
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
    
<br><br><br>
<main role="main" class="container-fluid">
    <div class="jumbotron shadow-sm pt-3 pb-5">
    <div style="float: right">
        <img src="<?php echo base_url('assets/img/logo_transparente.png'); ?>" width="270" height="230" style="margin-bottom: 5px"/><br/>
    </div>
    
    <div class="container">
        <h1 class="display-3" style="font-size: 50pt">
            <img class="rounded-circle" src="<?php echo base_url('assets/img/icone/usuario_neutro.png'); ?>" alt="Generic placeholder image" width="100" height="100">
			Olá, <?php echo $_SESSION['nome']; ?>!
        </h1>
        <p>
            Mantenha seus dados sempre atualizados, inclusive a foto de perfil.<br>
            Nada melhor que uma foto, para deixar o ambiente mais agradável!
			<img src="<?php echo base_url('assets/img/emoji/piscando.png');?>" height="40" width="40"/>
        </p>
        <br>
    </div>
  </div>
        <div class="col-12">
            <div class="accordion shadow" id="accordionExample">
                <div class="row mx-auto">
                    <div class="card-header rounded col-sm-3" id="headingOne">                    
                            <div class="row">
                                <img src="<?php echo base_url($pasta).$_SESSION['foto_perfil'];?>" class="rounded-circle mx-auto nav-link dropdown-toggle text-white" width="330" height="310" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                            </div>
                            <div class="row">
                                <a class="shadow-sm mx-auto col-8 btn btn-outline-primary text-left"  href="" role="button" data-toggle="modal" data-target="#modal_escolher_imagem">
                                    Alterar imagem
                                    <img src="<?php echo base_url('assets/img/icone/camera_perfil.png');?>" class="float-right" width="35" height="30"/>
                                </a>
                            </div>
                        <!--</form>-->
                    </div>
                
                    <div class="card-header rounded float-right col-sm-9" id="headingOne">  
                        <form name="formuser" class="form-group needs-validation" action="<?php echo base_url('Perfil/alterar');?>" method='POST' novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="firstName" name="nome" value="<?php echo "{$_SESSION['nome']}"; ?>" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="sobre_nome">Sobrenome</label>
                                <input type="text" class="form-control" id="lastName" name="sobrenome" value="<?php echo "{$_SESSION['sobrenome']}"; ?>" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_de_nascimento">Data de Nascimento</label>
                                <input type="date" class="form-control" id="dt_nascimento" value="<?php echo "{$_SESSION['nascimento']}"; ?>" name="dt_nascimento" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telefone">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo "{$_SESSION['telefone']}"; ?>" placeholder="(00) 00000-0000" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" required>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="campus">Campus</label>
                                <input type="text" class="form-control" id="campus" name="campus" value="<?php echo "{$_SESSION['campus']}"; ?>" required disabled>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="campus">Curso</label>
                                <input type="text" class="form-control" id="curso" name="curso" value="<?php echo "{$_SESSION['curso']}"; ?>" required disabled>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="@aluno.ifnmg.edu.br" name="email" value="<?php echo "{$_SESSION['email']}"; ?>" required disabled>
                                <div class="invalid-feedback">
                                    Campo obrigatorio!
                                </div>
                            </div>
                        </div>

                        <div id="alerts_ficam_aqui">

                        </div>
                        
                        <hr class="mb-4">
                        <div class="row">
                            <div class="col-6 mb-1">
                                 <button type="submit" class="shadow-sm col-12 btn btn-outline-primary btn-lg" role="button" id="gerenciar_dados">Salvar dados</button>
                            </div>
                            <div class="col-6 mb-1">
                                <button class="shadow-sm col-12 btn btn-outline-danger btn-lg" data-toggle="modal" type="button" data-toggle="modal" data-target="#modal_cancelar">Cancelar</button>
                            </div>  
                        </div>
                    </form>
                    </div>        
                
                </div>
            </div>
        </div>

        <div class="modal fade" name="modal_escolher_imagem" id="modal_escolher_imagem" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                           Atenção
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                            
                    <div class="modal-body">
                        Selecione a imagem
                    </div>
                            
                    <div class="modal-footer">
                        <form name="formuser" class="form-group needs-validation" action="<?php echo base_url('Perfil/alterar_foto');?>" method='POST' enctype="multipart/form-data" novalidate>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="arquivo" name="arquivo" aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Escolher arquivo</label>
                          </div>
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary" type="button" id="enviar" name="enviar">Enviar</button>
                          </div>
                        </div>
                        </form>
                    </div>
                    
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
                                    Atenção!
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
                        <?php if ($sucesso){ ?>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Entendi</button>
                            <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php  $this->load->view('include/modal_cancelar'); ?>
        
        <?php 
            if(($tentou)||($imagem)){ 
        ?>		
                <script>
                    $(document).ready(function(){
                        $('#modal_sucesso').modal('show');
                    });
                </script>
        <?php 
            } 
        ?>
        <script src="<?php echo base_url('assets/jquery/jquery.mask.js');?>"></script>
</main>
