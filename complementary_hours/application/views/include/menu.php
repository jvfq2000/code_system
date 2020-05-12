<?php
	if($_SESSION['nivel'] == 4){
		$tipoUsuario = 'Administrador';
	
	} else if($_SESSION['nivel'] == 3){
		$tipoUsuario = 'Coordenador de Curso';
	
	} else if($_SESSION['nivel'] == 2){
        $tipoUsuario = 'Coordenador de Horas';
    
    } else {
		$tipoUsuario = 'Aluno';
	}
?>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top ">
		<a class="navbar-brand" href="<?php echo base_url();?>">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="barra_de_menu">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link btn-outline-secondary" href="#">Regulamentos<span class="sr-only">(current)</span></a>
				</li>

      			<li class="nav-item">
        			<a class="nav-link btn-outline-secondary" href="#">Relatórios<span class="sr-only">(current)</span></a>
				</li> 

                <?php if($_SESSION['nivel'] > 1){ ?>
      			<li class="nav-item dropdown">
        			<a class="nav-link dropdown-toggle btn-outline-secondary" href="#" id="dropdown_gerenciar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Gerencial
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown_gerenciar">
                        <?php if($_SESSION['nivel'] > 3){ ?>
                        <a class="dropdown-item" href="<?php echo base_url('Gerenciar_campus');?>">Gerenciar Campus</a>
                        <a class="dropdown-item" href="<?php echo base_url('Gerenciar_curso');?>">Gerenciar Cursos</a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>
                        <a class="dropdown-item" href="#">Gerenciar Regulamentos</a>
                    </div>
      			</li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link btn-outline-secondary" href="<?php echo base_url('Objetivos');?>">Objetivos<span class="sr-only">(current)</span></a>
                </li> 
    		</ul>
      		<div class="dropleft">
        		<img src="<?php echo base_url('Arquivos/Fotos_perfil/'.$_SESSION['foto_perfil']);?>" class="rounded-circle nav-link dropdown-toggle text-white" width="65" height="50" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
        		<div class="dropdown-menu dropdown-menu-right" style="width:18rem;">
                <ul class="list-group list-group-flush">
                    <div class="row">
                        <img src="<?php echo base_url('Arquivos/Fotos_perfil/'.$_SESSION['foto_perfil']);?>" class="rounded-circle nav-link dropdown-toggle text-white" width="65" height="50" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                        <a class="floar-right">
                            <?php echo "{$tipoUsuario}<br>{$_SESSION['nome']}"; ?><br>
                            <?php echo $_SESSION['email']; ?>
                        </a><br>
                    </div>
                    <li class="list-group-item">
                        <a class="dropdown-item" href="<?php echo base_url('Perfil')?>">Perfil</a>
                        <a class="dropdown-item" href="<?php echo base_url('login')?>" type="button" data-toggle="modal" data-target="#confirmacao">Sair</a>
                    </li>
                </ul>
        	</div>
		</div>
	</nav>

	<div class="modal fade" id="confirmacao" tabindex="-1" role="dialog">
    	<div class="modal-dialog" role="document">
        	<div class="modal-content">                
            	<div class="modal-header">
                	<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span>&times;</span>
                    </button>
                </div>
                            
                <div class="modal-body">
                	Deseja realmente sair?
                </div>
                            
                <div class="modal-footer">
                	<a class="btn btn-primary"  href="<?php echo base_url('login/logout');?>" role="button">Sim</a>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Não</button>
                </div>
			</div>
		</div>
	</div>
