<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Cadastro de Apadrinhamentos</h4>

    </div>
    <div class="modal-body">
	    <div class="te"></div>
		<div class="table-responsive">
            
             <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Dados do apadrinhamento do - <?=$apadrinhamento->Animal?></th>
                    </tr>
                </thead>
                <tbody>
	                <?php if($apadrinhamento->foto): ?>
	                <tr>
		                <td class="text-center" colspan="2"><img width="50%" src="<?=base_url()?>assets/uploads/animais/<?=$apadrinhamento->foto?>"></td>
	                </tr>
	                <?php endif; ?>
                    <tr>
                        <td>Última atualização de pagamentos:</td>
                        <td><?=date('d/m/y', strtotime(@$apadrinhamento->DataStatus))?></td>
                    </tr>
                    <tr>
                        <td>Padrinho</td>
                        <td><b><?=@$apadrinhamento->Padrinho;?></b></td>
                    </tr>
                    <tr>
                        <td>Tipo de apadrinhamento</td>
                        <td><b><?=$apadrinhamento->tipo_apadrinhamento?></b></td>
                    </tr>
                    <tr>
                        <td>Valor</td>
                        <td>R$ <?=$apadrinhamento->valor?></td>
                    </tr>
                    <tr>
                        <td>Periodicidade</td>
                        <td><?php if($apadrinhamento->periodicidade == 'A') { echo "Anual"; } elseif($apadrinhamento->periodicidade == 'M') { echo "Mensal"; } elseif($apadrinhamento->periodicidade == 'U') { echo "Único"; }  else echo $apadrinhamento->periodicidade; ?></td>
                    </tr>
                    <tr>
                        <td>Status do pagamento</td>
                        <td><?php if($apadrinhamento->status == 3): ?><button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>&nbsp;<?php endif; ?><?=$this->utilidades->retorna_status($apadrinhamento->status);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>