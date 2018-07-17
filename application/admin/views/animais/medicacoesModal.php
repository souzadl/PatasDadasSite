<div class="modal fade" id="medicacoesDialog" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Medicações</h4>
            </div>            
            <div class="modal-body">
                <form id="medicacoesForm" class="formModal" role="form" action="<?= base_url() ?>admin.php/animais/salvarAlimentacaoEspecial" method="POST">
                    <div class="form-group">
                        <label for="medicacao">Medicação</label>
                        <input tabindex="1" class="form-control" name="medicacao" placeholder="Digite a medicação do animal" required="required">
                    </div>
                    <div class="form-group">
                        <label for="uso">Uso</label>
                        <select tabindex="2" class="form-control" name="uso" required="required">
                            <option value="">Selecione</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="dosagem">Dosagem</label>
                        <input tabindex="3" class="form-control" name="dosagem" placeholder="Digite a dosagem da medicação" required="required">
                    </div>      
                    <div class="form-group">
                        <label for="frequencia">Frequência</label>
                        <input tabindex="4" class="form-control" name="frequencia" placeholder="Digite a frequência da medicação" required="required">
                    </div> 
                    <div class="form-group">
                        <label for="continuo">Contínuo</label>
                        <select tabindex="5" class="form-control" name="continuo" required="required">
                            <option value="">Selecione</option>
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="inicio">Início</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="6" class="form-control datepicker" name="inicio" placeholder="Selecione a data de início"  required="required">
                    </div>                      
                    <div class="form-group">
                        <label for="termino">Término</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="7" class="form-control datepicker" name="termino" placeholder="Selecione a data de início"  required="required">
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
