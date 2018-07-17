<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Cadastro de Animais</h4>

    </div>
    <div class="modal-body">
	    <div class="te"></div>
		<div class="table-responsive">
            
             <table class="table table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Dados do animal</th>
                    </tr>
                </thead>
                <tbody>
	                <?php if($animal->foto): ?>
	                <tr>
		                <td class="text-center" colspan="2"><img width="50%" src="<?=base_url()?>assets/uploads/animais/<?=$animal->foto?>"></td>
	                </tr>
	                <?php endif; ?>
                    <tr>
                        <td>Cadastrado em</td>
                        <td><?=date('d/m/y', strtotime(@$animal->data_cadastro))?></td>
                    </tr>
                    <tr>
                        <td>Nome / Tipo</td>
                        <td><b><?=@$animal->nome;?> / <?php if($animal->tipo == 'C') echo "Cachorro"; elseif($animal->tipo == 'G') echo "Gato"; ?></b></td>
                    </tr>
                    <tr>
                        <td>Nascimento</td>
                        <td><b><?=date('d/m/y', strtotime(@$animal->data_nascimento))?> - <?php echo date_diff(date_create("$animal->data_nascimento"), date_create('today'))->y; ?> anos</b></td>
                    </tr>
                    <tr>
                        <td>Aparição</td>
                        <td>Data: <b><?=date('d/m/y', strtotime(@$animal->data_aparicao))?></b> &nbsp; Local: <b><?=$animal->local_aparicao?></b></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td><?php if($animal->sexo == 'M') echo "Macho"; elseif ($animal->sexo == 'F') echo "Fêmea"; ?></td>
                    </tr>
                    <tr>
                        <td>Porte</td>
                        <td><?=$animal->porte?></td>
                    </tr>
                    <tr>
                        <td>Pelagem</td>
                        <td><?php if($animal->pelagem == 'C') echo "Curta"; elseif ($animal->pelagem == 'L') echo "Longa"; ?></td>
                    </tr>
                    <tr>
                        <td>Condição</td>
                        <td>Condição: <b><?php if($animal->condicao == 'A') echo 'Adotado'; if($animal->condicao == 'O') echo 'Óbito'; if($animal->condicao == 'D') echo 'Desaparecido'; if($animal->condicao == 'DI') echo 'Disponível'; if($animal->condicao == 'I') echo 'Indisponível'; ?></b> &nbsp; Data condição: <b><?=date('d/m/y', strtotime(@$animal->data_condicao))?></b></td>
                    </tr>
                    <tr>
                        <td>Temperamento</td>
                        <td><?=@$animal->temperamento;?></td>
                    </tr>
                    <tr>
                        <td>Observação</td>
                        <td><?=@$animal->observacao;?></td>
                    </tr>
                    <tr>
                        <td>Observação Priv.</td>
                        <td><?=@$animal->observacao_privada;?></td>
                    </tr>
                    <tr>
                        <td>Tratamento</td>
                        <td><?=@$animal->tratamento;?></td>
                    </tr>
                    <tr>
                        <td>Redes Sociais</td>
                        <td>
	                        <?php if($animal->perfil_facebook): ?><a href="<?=@$animal->perfil_facebook;?>">Perfil Facebook</a><br/><?php endif; ?>
	                        <?php if($animal->perfil_instagram): ?><a href="<?=@$animal->perfil_instagram;?>">Perfil Instragram</a><br/><?php endif; ?>
	                        <?php if($animal->album_facebook): ?><a href="<?=@$animal->album_facebook;?>">Álbum Facebook</a><br/><?php endif; ?>
	                    </td>
                    </tr>
                    <?php if(@$vacinas): ?>
                    <tr>
	                    <td>Vacinas</td>
	                    <td>
		                    <?php foreach ($vacinas as $row): ?>
		                    <?=$row->vacina?> - <?=date('d/m/y', strtotime(@$row->data))?><br/>
		                    <?php endforeach; ?>
	                    </td>
                    </tr>
                    <?php endif; ?>
                    <?php if(@$vermifugos): ?>
                    <tr>
	                    <td>Vermífugos</td>
	                    <td>
		                    <?php foreach ($vermifugos as $row): ?>
		                    <?=$row->vermifugo?> - <?=date('d/m/y', strtotime(@$row->data))?><br/>
		                    <?php endforeach; ?>
	                    </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
	</div>
    <div class="modal-footer">
	    <button class="btn btn-primary btn-default" onclick="location.href='<?=base_url()?>admin.php/animais/editar/<?=$animal->id_animal?>'" type="button">Editar dados</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
    </div>
</div>