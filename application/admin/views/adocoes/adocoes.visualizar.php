<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Cadastro de Adocoes</h4>

    </div>
    <div class="modal-body">
	    <div class="te"></div>
		<div class="table-responsive">
            
             <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Dados do adoção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Última atualização do adocao:</td>
                        <td><?=date('d/m/y H:i:s', strtotime(@$adocao->data_alteracao))?></td>
                    </tr>
                    <tr>
                        <td>Quem enviou?</td>
                        <td>
	                        <b><?=@$adocao->Adotador;?></b>
                        	<br/><b><?=@$adocao->email;?></b>
                        	<br/><b><?=@$adocao->telefone;?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>Animal</td>
                        <td><b><?=$adocao->Animal?></b>
                        <br/>
                        <img style="width:200px;" src="<?=base_url()?>assets/uploads/animais/<?=$adocao->foto?>"></td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>