<?php
    if ($titulo == "Gerenciar Campus") {
        $caminho = "Gerenciar_campus";
    } else if($titulo == "Gerenciar Cursos"){
        $caminho = "Gerenciar_curso";
    }else{
        $caminho = "";
    }
?>

<div class="modal fade" name="modal_cancelar" id="modal_cancelar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <img src="<?php echo base_url('assets/img/icone/atencao.png');?>" height="40" width="40"/>
                    Atenção!
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
                    
            <div class="modal-body">
                Deseja realmente cancelar?
            </div>
                    
            <div class="modal-footer">
	             <a class="btn btn-secondary"  href="<?php echo base_url($caminho);?>" role="button">Sim</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Não</button>
            </div>
            
        </div>
    </div>
</div>