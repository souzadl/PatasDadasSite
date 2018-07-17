<?php $this->load->view('includes/header.php'); ?>

	<?php $this->load->view('includes/adocoes.php'); ?>
	
	<?php if($this->uri->segment(4) == 'formulario-adocao-enviado'): ?>
	<!-- ************ MODAL SUCESSO DE ADOÇÃO ************ -->
	<script>
		
		ga('send', 'event', 'Adocao', 'Enviado', 'Geral');
		
		function openModalSucessoAdocao() {
			$('#modalSucessoAdocao').fadeIn('slow');
			
		}      
		function closeModalSucessoAdocao() {
			$('#modalSucessoAdocao').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalSucessoAdocao" class="ajuda amare" style="display:none;">
		<div class="black" onClick="closeModalSucessoAdocao();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>Pai? Mãe? Estamos quase lá :)</span><br>
				</p>

				<p><b>Atenção:</b><br>Após o envio, aguarde nossa equipe entrar em contato!</p>
				<div class="fechar_right" onClick="closeModalSucessoAdocao();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	<script>openModalSucessoAdocao();</script>
	<?php endif; ?>
	
	<?php if($this->uri->segment(4) == 'apadrinhamento-realizado'): ?>
	<!-- ************ MODAL SUCESSO DE ADOÇÃO ************ -->
	<script>
		
		ga('send', 'event', 'Apadrinhamento', 'Enviado', 'Geral');
		
		function openModalSucessoApadrinhamento() {
			$('#modalSucessoApadrinhamento').fadeIn('slow');
			
		}      
		function closeModalSucessoApadrinhamento() {
			$('#modalSucessoApadrinhamento').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalSucessoApadrinhamento" class="ajuda adotavel" style="display:none;">
		<div class="black" onClick="closeModalSucessoApadrinhamento();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>Obrigado de coração Padrinho :)</span><br>
				</p>

				<p><b>Atenção:</b><br>Seu nome aparecerá em nosso site como padrinho somente depois da confirmação do pagamento!</p>
				<div class="fechar_right" onClick="closeModalSucessoApadrinhamento();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	<script>openModalSucessoApadrinhamento();</script>
	<?php endif; ?>
	
	<?php if($this->uri->segment(4) == 'adocao-realizada'): ?>
	<!-- ************ MODAL SUCESSO DE ADOÇÃO ************ -->
	<script>
		ga('send', 'event', 'Adocao', 'Enviado', 'Geral');
		
		function openModalSucessoAdoocao() {
			$('#modalSucessoAdoocao').fadeIn('slow');
			
		}      
		function closeModalSucessoAdoocao() {
			$('#modalSucessoAdoocao').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalSucessoAdoocao" class="ajuda adotavel" style="display:none;">
		<div class="black" onClick="closeModalSucessoAdoocao();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>Obrigado por querer me adotar :)</span><br>
				</p>

				<p><b>Atenção:</b><br>Nossa equipe entrará em contato com você!</p>
				<div class="fechar_right" onClick="closeModalSucessoAdoocao();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	<script>openModalSucessoAdoocao();</script>
	<?php endif; ?>
	
	<?php if($this->uri->segment(4) == 'adocao-nao-realizada'): ?>
	<!-- ************ MODAL SUCESSO DE ADOÇÃO ************ -->
	<script>
		
		ga('send', 'event', 'Adocao - Falha', 'Falhou', 'Geral');
		
		function openModalSucessoAdoocaoNaoRealizada() {
			$('#modalSucessoAdoocaoNaoRealizada').fadeIn('slow');
			
		}      
		function closeModalSucessoAdoocaoNaoRealizada() {
			$('#modalSucessoAdoocaoNaoRealizada').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalSucessoAdoocaoNaoRealizada" class="ajuda adotavel" style="display:none;">
		<div class="black" onClick="closeModalSucessoAdoocaoNaoRealizada();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>-- ALGO DEU ERRADO --</span><br>
				</p>

				<p><b>Atenção:</b><br>Tente novamente e se o problema persistir, entre em contato por e-mail.</p>
				<div class="fechar_right" onClick="closeModalSucessoAdoocaoNaoRealizada();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	<script>openModalSucessoAdoocaoNaoRealizada();</script>
	<?php endif; ?>
	
	<!-- ************ MODAL FORMULÁRIO DE ADOÇÃO ************ -->
	<script>
		function openModalQueroAdotar() {
			$('#modalQueroAdotar').fadeIn('slow');
			
		}      
		function closeModalQueroAdotar() {
			$('#modalQueroAdotar').fadeOut('slow');
		}
		
	</script>
	
	<div id="modalQueroAdotar" class="ajuda amare adotarer" style="display:none;">
		<div class="black" onClick="closeModalQueroAdotar();" title="Clique para fechar"></div>
		<div class="row">
			<div id="contentAjax" class="center">	
				<p>
					<span>Sou lindo(a) né? Me adota? Me leva pra casa?</span><br>
					<small>Preencha os dados abaixo e aguarde nossa equipe entrar em contato com você</small>
				</p>
				<form name="FormAdocao" id="FormAdocao" method="post" action="<?=site_url()?>adotaveis/adocao">
					<div class="left">
							<input type="hidden" name="id_animal" value="<?=$animal->id_animal?>">
							<p>
								<input type="hidden" name="url" value="<?=current_url()?>">
								<input type="hidden" name="id_animal" value="<?=$animal->id_animal?>">
								<input class="field" type="text" name="nome" id="nome" placeholder="digite o seu nome" required><br/>
								<input class="field" type="email" name="email" id="email" placeholder="digite o seu e-mail" required><br/>
								<input class="field" type="text" name="telefone" id="telefone" placeholder="digite o seu telefone" required>
							</p>
					</div>
					<div class="right">
						<a href="javascript: enviarAdocao();" class="adotar">ADOTAR</a>
					</div>
				</form>

				<p><b>Atenção:</b><br>Após o envio, aguarde nossa equipe entrar em contato!</p>
				<div class="fechar_right" onClick="closeModalQueroAdotar();" title="Clique para fechar"></div>
			</div>
		</div>
	</div>
	
	

	<!-- ************ SETOR ************ -->
	<section id="adotaveis-interna">
		<div class="top" >
			<div class="row">
				<h2><?=@$animal->nome?></h2>
				<figure style="background: url(<?=base_url()?>assets/uploads/animais/<?=@$animal->foto?>);"></figure>
				<?php if(@$next): $titleNext = $this->utilidades->sanitize_title_with_dashes($next->nome); ?><a class="next" id="nextAnimal" href="<?=site_url()?>adotaveis/<?=$titleNext;?>/<?=$next->id_animal?>"></a><?php endif; ?>
				<?php if(@$previous): $titlePrev = $this->utilidades->sanitize_title_with_dashes($previous->nome); ?><a class="prev" id="prevAnimal" href="<?=site_url()?>adotaveis/<?=$titlePrev;?>/<?=$previous->id_animal?>"></a><?php endif; ?>
			</div>
		</div>
		
		<div class="row">
			<div class="content">
				<ul>
					<li>
						<i class="porte"></i>
						<p><b>Porte: </b><?=@$animal->porte?></p>
					</li>
					<li>
						<i class="sexo"></i>
						<p><b>Sexo: </b><?php if($animal->sexo == "M") echo "Macho"; else echo "Fêmea"; ?></p>
					</li>
					<li>
						<i class="idade"></i>
						<p><b>Idade aproximada: </b>
							<?php 
								$dogIdade = date_diff(date_create("$animal->data_nascimento"), date_create('today'))->y;
								$dogIdadeM = date_diff(date_create("$animal->data_nascimento"), date_create('today'))->m; 
								if($dogIdade == 0) 
								{ 
									//echo $dogIdade->format("%M meses");
									if ($dogIdadeM == 1) {
										echo  "$dogIdadeM mês";
									}
									else {
										echo "$dogIdadeM meses";
									}
								} 
								else 
								{ 
									if ($dogIdade == 1) echo $dogIdade." ano"; else echo $dogIdade." anos";
								}  
							?></p>
					</li>
					<li>
						<i class="saude"></i>
						<p><b>saúde: </b></p>
						<?php if(@$animal->check_vacinado == 'S'): ?>
						<p class="check"><span></span>Vacinado(a)</p>
						<?php endif; ?>
						<?php if(@$animal->check_vermifugado == 'S'): ?>
						<p class="check"><span></span>Vermifugado(a)</p>
						<?php endif; ?>
						<?php if(@$animal->check_castrado == 'S'): ?>
						<p class="check"><span></span>Castrado(a)</p>
						<?php endif; ?>
					</li>
					<li>
						<i class="temperamento"></i>
						<p><b>temperamento: </b><?=$animal->temperamento?></p>
					</li>
				</ul>
				<ul>
					<p><?=@$animal->observacao?></p>
				</ul>

				<?php if($this->agent->is_mobile()): ?>
				<div id="ads" style="margin-top: 17px; float: left; width: 100%;">
				<?php else: ?>
				<div id="ads" style="float:left; width: 100%; margin-top: 30px; text-align: center;">
				<?php endif; ?>
			    	
					<!-- Adotaveis - Topo -->
					<ins class="adsbygoogle"
					     style="display:block"
					     data-ad-client="ca-pub-6202805151194355"
					     data-ad-slot="8957960229"
					     data-ad-format="auto"></ins>
			    </div>
			
				<div class="images">
					<?php if($fotos): $cont=0; foreach($fotos as $foto): $cont++; ?>
					<?php if($cont < 3): if($cont == 1) $class = 'one'; else if ($cont == 2) $class = 'two'; ?>
					<ul class="image-<?=$class?>">
						<figure style="background: url(<?=base_url()?>assets/uploads/animais/galeria/<?=$foto->imagem?>);"></figure>
					</ul>
					<?php 
						
						elseif($cont == 3): 
							$imgthree = $foto->imagem; 
					
						endif;	
					?>
					<?php endforeach; endif; ?>
					<ul class="image-tree">
						<li>
							<?php if($animal->album_facebook): ?>
							<a target="_blank" href="<?=$animal->album_facebook?>">
								<i class="fa fa-facebook-square"></i>
								<p><b>mais fotos</b><br>no meu álbum Facebook</p>
							</a>
							<?php endif; ?>
							<?php 
								if($animal->perfil_instagram): 
									$r = $animal->perfil_instagram;
									$r = explode('/', $r);	
							?>
							<a target="_blank" href="<?=$animal->perfil_instagram?>">
								<i class="fa fa-instagram"></i>
								<p><b>me segue no insta</b><br>@<?=$r[3]?></p>
							</a>
							<?php endif; ?>
						</li>
						<?php if(@$imgthree): ?>
						<figure style="background: url(<?=base_url()?>assets/uploads/animais/galeria/<?=$imgthree?>);"></figure>
						<?php endif; ?>
					</ul>
				</div>
				<div class="icones">  
					<div class="<?php if(@$animal->padrinho_racao != 0) { echo "active"; $racao = $this->model->getPadrinho($animal->padrinho_racao); } ?>">
						<i class="racao"></i>
						<p>Padrinho de<br><b>ração</b></p>
						<?php if(@$racao->id_padrinho): ?>
						<p class="exp"><?=$racao->nome?></p>
						<?php else: ?>
						<?php if($animal->porte == 'Filhote') { $idPorte = 1; } if($animal->porte == 'P') { $idPorte = 2; } if($animal->porte == 'M') { $idPorte = 3; } if($animal->porte == 'G') { $idPorte = 4; } if($animal->porte == 'GG') { $idPorte = 5; } ?>
						<p class="exp">Ainda Sem :(<br><a onClick="openModalPadrinho(<?=@$idPorte?>);" style="cursor:pointer;">Seja meu dindo</a></p>
						<?php endif; ?>
					</div>
				
					<div class="<?php if(@$animal->padrinho_pulgas != 0) { echo "active"; $pulgas = $this->model->getPadrinho($animal->padrinho_pulgas); } ?>">
						<i class="antipulgas"></i>
						<p>Padrinho de<br><b>anti pulgas</b></p>
						<?php if(@$pulgas->id_padrinho): ?>
						<p class="exp"><?=$pulgas->nome?></p>
						<?php else: ?>
						<p class="exp">Ainda Sem :(<br><a onClick="openModalPadrinho(8);" style="cursor:pointer;">Seja meu dindo</a></p>
						<?php endif; ?>
					</div>
				
					<div class="<?php if(@$animal->padrinho_castracao != 0){ echo "active"; $castracao = $this->model->getPadrinho($animal->padrinho_castracao); } ?>">
						<i class="castracao"></i>
						<p>Padrinho de<br><b>castração</b></p>
						<?php if(@$castracao->id_padrinho): ?>
						<p class="exp"><?=$castracao->nome?></p>
						<?php else: ?>
						<p class="exp">Ainda Sem :(<br><a onClick="openModalPadrinho(6);" style="cursor:pointer;">Seja meu dindo</a></p>
						<?php endif; ?>
					</div>
				
					<div class="<?php if(@$animal->padrinho_vacinas != 0) { echo "active"; $vacinas = $this->model->getPadrinho($animal->padrinho_vacinas); } ?>">
						<i class="vacinas"></i>
						<p>Padrinho de<br><b>vacinas</b></p>
						<?php if(@$vacinas->id_padrinho): ?>
						<p class="exp"><?=$vacinas->nome?></p>
						<?php else: ?>
						<p class="exp">Ainda Sem :(<br><a onClick="openModalPadrinho(7);" style="cursor:pointer;">Seja meu dindo</a></p>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="right">
					<a class="addthis_button_compact compartilhar">
						<p>compartilhar</p>
					</a>
<!-- 					<a href="#" class="compartilhar"><p>compartilhar</p></a> -->
					<a href="javascript:openModalQueroAdotar();" class="adotar"><i></i><p>adotar</p></a>
				</div>
			</div>
		</div>
	
	</section>
	<!-- ************ SETOR END ************ -->
	
	<script>
		$("body").on("keypress", function(e){
		    if(e.keyCode === 37) 
		    {
			   var sitelink = $("#prevAnimal").attr('href');
		       window.location.href = sitelink;  
		    }
		    else if(e.keyCode === 39) 
		    {
			   var sitelink = $("#nextAnimal").attr('href');
		       window.location.href = sitelink;  
		    }   
		});
		
		function enviarAdocao ()
		{
			$("#FormAdocao").submit();
		}
	</script>

<?php $this->load->view('includes/footer.php'); ?>