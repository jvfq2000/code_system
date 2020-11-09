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
							<select class="custom-select" id="cat-atividade" name="cat-atividade">
							   <option value="">Selecione o campus!</option>
							</select>
						</div>

						<div class="col-md-8 mb-3">
							<label for="atividade_desc">Descrição da Atividade</label>
							<input type="text" class="form-control" id="atividade_desc" name="atividade_descricao" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4 mb-3">
							<label for="qtd_horas_min">Quantidade de horas minimas</label>
							<input type="number" step="0.01" class="form-control" id="qtd_horas_min" name="qtd_horas_min">
						</div>
						<div class="col-md-4 mb-3">
							<label for="qtd_horas_max">Quantidade de horas maximas</label>
							<input type="number" step="0.01" class="form-control" id="qtd_horas_max" name="qtd_horas_max">
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
									<th scope="col">Código Categoria</th>
									<th scope="col">Descrição da Atividade</th>
									<th scope="col">Horas minimas</th>
									<th scope="col">Horas maximas</th>
									<th scope="col">Menu</th>
								</tr>
							</thead>
							<tbody id="linhas_quadro">
								
							</tbody>
						</table>
					</div>
						<div class="col-md-12 mb-3">
							<input type="text" class="form-control invisible" id="atividade_json" name="atividade_json" value="">
						</div>

					<div class="row">
						<div class="col-6 mb-1">
							<button id="salvar" class="shadow-sm col-12 btn btn-outline-primary btn-lg" type="submit">Salvar</button>
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
						<?php if ($sucesso){ ?>
								<img src="<?php echo base_url('assets/img/icone/ok.png');?>" height="40" width="40"/>
								Tudo certo por aqui!
						<?php } else { ?>
								<img src="<?php echo base_url('assets/img/icone/erro.png');?>" height="40" width="40"/>
								Algo deu errado!
						<?php } ?>
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

		$("#add").click(function() {
			$("#linhas_quadro").prepend(
				'<tr>'+
					'<td>'+$("#cat-atividade").val()+'</td>'+
					'<td>'+$("#atividade_desc").val()+'</td>'+
					'<td>'+$("#qtd_horas_min").val()+'</td>'+
					'<td>'+$("#qtd_horas_max").val()+'</td>'+
					'<td><img src="<?php echo base_url('assets/img/icone/lixeira.png');?>" class="btnExcluir"/></td>'+
				'</tr>'
			);
			$(".btnExcluir").bind("click", excluir);

			atualizaInputAtividadeJson();
			//$.ajax({
			//	url: urlArmazenaAtividades,
			//	type: "POST",
			//	data: {atividades: JSON.stringify(arrayAtividade)},

			//	beforeSend : function(){
			//		alert('Antes de enviar');
			//	}
			//})
			//.done(function(atividades){
			//	alert(atividades);
			//})
			//.fail(function(){
			//	alert('Deu ruim maluco');
			//});
		});
		
		function excluir(){
			var atividade = $(this).parent().parent();
			atividade.remove();
			atualizaInputAtividadeJson();
		}

		function atualizaInputAtividadeJson(){
			var arrayAtividade = [];
			var novaAtividade = [];
			//let tr = $("tbody tr");
			//let td = $("tbody td");

			//for(var i = 0; i < tr.length; i++){
			//	arrayAtividade[i] = [tr[i][0].innerText, tr[i][1].innerText, tr[i][2].innerText, tr[i][3].innerText];
			//}

			$("tbody tr").each(function(){
				var td = $(this).children();
				novaAtividade = [];
				novaAtividade.push(
					$(td[0]).text(),
					$(td[1]).text(),
					$(td[2]).text(),
					$(td[3]).text()
				);
				arrayAtividade.push(novaAtividade);
			});

			atividade_json.value = JSON.stringify(arrayAtividade);
		}

//	(function() {
//		'use strict';
//		window.addEventListener('load', function() {
//		var forms = document.getElementsByClassName('needs-validation');
//		var validation = Array.prototype.filter.call(forms, function(form) {
//			form.addEventListener('submit', function(event) {
//
//			form.classList.add('was-validated');
//			}, false);
//		});
//		}, false);
//	})();
</script>
<?php  $this->load->view('include/modal_cancelar'); ?>
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
