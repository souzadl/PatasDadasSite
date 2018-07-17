
	<p>
		<span>Oba, você vai ser meu dindo :)</span><br>
		Agora basta preencher os dados e clicar em - <b>APADRINHAR</b> - e você será redirecionado <br/>
		para o site do nosso parceiro, totalmente seguro e fácil!
	</p>
	<div class="left">
		<p>
			Padrinho de: <?=$padrinho->tipo_apadrinhamento?><br/>
			Valor: R$ <?=$padrinho->valor?><br/>
			Periodicidade: <?php if($padrinho->periodicidade == 'U') echo "Pagamento ÚNICO"; if($padrinho->periodicidade == 'A') echo "Pagamento ANUAL"; if($padrinho->periodicidade == 'M') echo "Pagamento MENSAL"; ?>
		</p>
	</div>
	<div class="right">
		<form name="FormApadrinhamento" id="FormApadrinhamento" method="post" action="<?=site_url()?>adotaveis/apadrinhamento">
			<input type="hidden" name="id_animal" value="<?=$id_animal?>">
			<input type="hidden" name="id_apadrinhamento_tipo" value="<?=$padrinho->id_apadrinhamento_tipo?>">
			<input type="hidden" name="valor" value="<?=$padrinho->valor?>">
			<input type="hidden" name="periodicidade" value="<?=$padrinho->periodicidade?>">
			<p>
				<input class="field" type="text" name="nome" placeholder="digite o seu nome" required><br/>
				<input class="field" type="email" name="email" placeholder="digite o seu e-mail" required>
				<a href="javascript: enviaApadrinhamento();" class="adotar">apadrinhar</a>
			</p>
		</form>
	</div>
	<p><b>Atenção:</b><br>Seu nome aparecerá em nosso site como padrinho somente depois da confirmação do pagamento!</p>
	<div class="fechar_right" onClick="closeModalPadrinho();" title="Clique para fechar"></div>
	
	<script>
		function enviaApadrinhamento ()
		{
			$("#FormApadrinhamento").submit();
		}
	</script>