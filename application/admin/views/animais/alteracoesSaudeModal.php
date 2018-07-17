<div class="modal fade" id="alteracoesSaudeDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alterações de saúde</h4>
            </div>            
            <div class="modal-body">
                <form id="alteracoesSaudeForm" class="formModal" role="form" action="<?= base_url() ?>admin.php/animais/salvarAlimentacaoEspecial" method="POST">
                    <div class="form-group">
                        <label for="alteracao">Alteração</label>
                        <input tabindex="1" class="form-control" name="alteracao" placeholder="Digite a alteração de saúde" required="required">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select tabindex="2" class="form-control" name="status" required="required">
                            <option value="">Selecione</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="3" class="form-control datepicker" name="data" placeholder="Selecione a data"  required="required">
                    </div>                    
                    <div class="form-group">
                        <label for="observacao">Observação</label>
                        <textarea tabindex="4" class="form-control" name="observacao"></textarea>
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
