<?php
	if($_SESSION['nivel'] == 3){
		$tipoUsuario = 'Administrador';
	
	} else if($_SESSION['nivel'] == 2){
		$tipoUsuario = 'Coordenador';
	
	} else {
		$tipoUsuario = 'Aluno';
	}
?>
	<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark col-12">
		<a class="navbar-brand" href="#">Home</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarsExampleDefault">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Regulamentos<span class="sr-only">(current)</span></a>
				</li>
      			<li class="nav-item active">
        			<a class="nav-link" href="#">Gerenciar Horas<span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item active">
        			<a class="nav-link" href="#">Relatórios<span class="sr-only">(current)</span></a>
				</li> 
      			<li class="nav-item active">
        			<a class="nav-link" href="#">Gerenciar Datas<span class="sr-only">(current)</span></a>
      			</li> 
      			<li class="nav-item active">
        			<a class="nav-link" href="#">Gerenciar Usuários<span class="sr-only">(current)</span></a>
      			</li> 
    		</ul>
      		<div class="dropleft">
        		<img src="<?php echo base_url('assets/img/logo.jpeg');?>" class="rounded-circle nav-link dropdown-toggle text-white" width="65" height="50" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
        		<div class="dropdown-menu" style="width:18rem;">
                <ul class="list-group list-group-flush">
                    <div class="row">
                        <img src="<?php echo base_url('assets/img/logo.jpeg');?>" class="rounded-circle nav-link dropdown-toggle text-white" width="65" height="50" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
                        <a class="floar-right">
			<?php echo "{$tipoUsuario}: {$_SESSION['nome']}"; ?><br>
			<?php echo $_SESSION['email']; ?>
                        </a><br>
                    </div>
                    <li class="list-group-item">
                        <a class="dropdown-item" href="#">Perfil</a>
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
