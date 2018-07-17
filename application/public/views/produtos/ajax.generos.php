
		<?php if(@$generos): foreach (@$generos as $row): ?>
		<option value="<?=$row->id_produto_estoque?>"><?=$row->genero?></option>
		<?php endforeach; else:  ?>
		<option value="">Produto indisponível</option>
		<?php endif; ?>
