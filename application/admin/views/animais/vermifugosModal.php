<div class="modal fade" id="vermifugosDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vermífugos</h4>
            </div>            
            <div class="modal-body">
                <form id="vermifugosForm" class="formModal" role="form" action="<?= base_url() ?>admin.php/animais/salvarAlimentacaoEspecial" method="POST">
                    <div class="form-group">
                        <label for="vacina">Vermífugo</label>
                        <input tabindex="1" class="form-control" name="vacina" placeholder="Digite o nome do vermífugo" required="required">
                    </div>
                    <div class="form-group">
                        <label for="data">Data</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="3" class="form-control datepicker" name="data" placeholder="Selecione a data"  required="required">
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
