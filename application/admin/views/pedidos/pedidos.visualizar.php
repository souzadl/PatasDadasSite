<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Cadastro de Pedidos</h4>

    </div>
    <div class="modal-body">
	    <div class="te"></div>
		<div class="table-responsive">
            
             <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Dados do pedido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Última atualização do pedido:</td>
                        <td><?=date('d/m/y H:i:s', strtotime(@$pedido->data_alteracao))?></td>
                    </tr>
                    <tr>
                        <td>Data do pedido</td>
                        <td><b><?=@$pedido->data_pedido;?></b></td>
                    </tr>
                    <tr>
                        <td>Valor total</td>
                        <td><b>R$ <?=$pedido->valor_total?></b></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php if($pedido->status == 3): ?><button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>&nbsp;<?php endif; ?><?=$this->utilidades->retorna_status($pedido->status);?></td>
                    </tr>
                    <?php if(@$itens): ?>
                    <tr>
	                    <td>Itens do Pedido</td>
	                    <td>
		                    <?php foreach ($itens as $row): ?>
		                    <?=$row->titulo?> - [ Tamanho: <?=$row->tamanho?> | Genero: <?=$row->genero?> ] <br/>QTD: [ <?=$row->quantidade?> ] - R$ <?=$row->ValorNoPedido?><br/><br/>
		                    <?php endforeach; ?>
	                    </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
	</div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>