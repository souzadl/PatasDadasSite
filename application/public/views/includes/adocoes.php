	<!-- ************ MODAL AJUDA ************ -->
	<script>
		function openModalPadrinho(tipo) {
			$( "#contentAjax" ).load( "<?=site_url()?>adotaveis/apadrinhar/"+tipo+"/<?=$animal->id_animal?>" ).promise().done(function() {
				$('#modalPadrinho').fadeIn('slow');
			});
			
		}      
		function closeModalPadrinho() {
			$('#modalPadrinho').fadeOut('slow');
		}
	</script>
	
	<div id="modalPadrinho" class="ajuda amare" style="display:none;">
		<div class="black" onClick="closeModalPadrinho();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">
				
			</div>
		</div>
	</div>