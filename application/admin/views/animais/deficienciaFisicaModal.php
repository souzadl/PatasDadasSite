<div class="modal fade" id="deficienciaFisicaDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alimentação Especial</h4>
            </div>            
            <div class="modal-body">
                <form id="deficienciaFisicaForm" class="formModal" role="form" action="<?= base_url() ?>admin.php/animais/salvarAlimentacaoEspecial" method="POST">
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <input type="text" name="descricao" class="form-control" required="required">
                    </div>
                    <div class="form-group">
                        <input type="submit" id="submitFormModal" class="btn btn-success" value="Salvar">
                    </div>    
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
