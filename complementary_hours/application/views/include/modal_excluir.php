<?php

?>

<div class="modal fade" name="modal_excluir" id="modal_excluir" tabindex="-1" role="dialog">
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
                Deseja realmente excluir?
            </div>
                    
            <div class="modal-footer">
                <a class="btn btn-primary" href="<?php echo $link_confirmou;?>" role="button">Sim</a>
                <a class="btn btn-secondary"  href="<?php echo $link_cancelou;?>" role="button">Não</a>
            </div>
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#modal_excluir').modal('show');
    });
</script>
