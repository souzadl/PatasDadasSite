<div class="modal fade" id="historicoPesoDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Histórico de peso</h4>
            </div>            
            <div class="modal-body">
                <form id="historicoPesoForm" class="formModal" role="form" action="<?= base_url() ?>admin.php/animais/salvarHistoricoPeso" method="POST">
                    <input type="hidden" name="id_animal" value="<?= @$animal->id_animal ?>">
                    <input type="hidden" name="id_prontuario" value="<?= @$prontuario->id_prontuario ?>">
                    <div class="form-group">
                        <label for="descricao">Data de aferição</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="1" class="form-control datepicker" name="data_afericao" placeholder="Selecione a data de aferição"  required="required">
                    </div>
                    <div class="form-group">
                        <label for="descricao">Peso</label>
                        <input tabindex="2" class="form-control" name="peso" placeholder="Digite o peso do animal" required="required">
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
