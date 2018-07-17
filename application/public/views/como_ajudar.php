<?php $this->load->view('includes/header.php'); ?>

<!-- ************ SETOR ************ -->
<section id="ajudar">

    <div id="container" class="container">
        <ul id="scene" class="scene">
            <li class="layer lay1" data-depth="0.2"><img class="image1" src="<?= base_url() ?>assets/public/img/headers/patas-dadas-adotaveis-07.png"></li>
            <li class="layer lay4" data-depth="0.4"><img class="image2" src="<?= base_url() ?>assets/public/img/headers/patas-dadas-adotaveis-08.png"></li>
        </ul>
    </div>

    <div class="content">
        <div class="row">            
            <ul class="box">
                <li><h2>Doações Mensais</h2><i class="racao"></i></li>
                <li>
                    <p>Você sabia que pode ajudar o patas dadas com doações mensais a partir de 1 real?</p><br>
                    <a class="btn" href="https://apoia.se/patasdadas" target="_blank">quero apoiar o <b>Patas Dadas</b></a>
                </li>
            </ul>    
        </div>
        <div class="row">

            <?php if ($this->agent->is_mobile()): ?>
                <div id="ads" style="margin-top: 15px; margin-bottom: 0px; float: left; width: 100%;">
                <?php else: ?>
                    <div id="ads" style="float:left; width: 100%; margin-bottom: 60px; text-align: center;">
                    <?php endif; ?>

                    <!-- Adotaveis - Topo -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-6202805151194355"
                         data-ad-slot="8957960229"
                         data-ad-format="auto"></ins>
                </div>

                <ul class="box">
                    <li>&nbsp</li>
                    <li>
                        <p>
                            Se você quer ajudar os nossos cães e não sabe como, tornar-se um padrinho é uma boa opção. <br><br/>
                            Com a nossa Campanha de Apadrinhamento, você pode escolher um dos nossos cães e ajudar no custo da sua alimentação, vacina ou castração. <br><br/>
                            O padrinho, então, doa o valor que gastamos com seu afilhado.
                        </p>
                    </li>
                </ul>	
                <ul class="box">
                    <li><h2>Apadrinhamento de Ração</h2><i class="racao"></i></li>
                    <li>
                        <p>Os valores gastos com ração (por mês) são os seguintes:</p><br>
                        <p><b>Filhote:</b> ± 4kg de ração mensais = R$ 30,00</p><br>
                        <p><b>Cães de porte pequeno:</b> ± 8kg de ração mensais = R$ 30,00</p><br>
                        <p><b>Cães de porte médio:</b> ± 15kg de ração mensais = R$ 50,00</p><br>
                        <p><b>Cães de porte grande:</b> ± 25kg de ração mensais = R$ 70,00</p><br>
                        <p><b>Cães de porte GG:</b> ± 25kg de ração mensais = R$ 70,00</p><br>
                        <p><small>*O porte de cada cão está especificado nas fotos individuais do cão!</small></p>
                        <a class="btn" href="<?= site_url() ?>adotaveis/apadrinhamento-de-racao">quero ser padrinho de <b>ração</b></a>
                    </li>
                </ul>

                <ul class="box">
                    <li><h2>Apadrinhamento de Vacinas</h2><i class="vacinas"></i></li>
                    <li>
                        <p>
                            Além da ração, os cães precisam receber <b>ANUALMENTE</b> uma dose da vacina polivalente e da vacina antirrábica. O padrinho de vacinação realiza apenas um depósito no ano, referente ao valor das vacinas de seu afilhado. Os valores da vacina são os seguintes:
                        </p>
                        <br>
                        <p><b>Polivalente</b> = R$ 35,00</p><br/>
                        <p><b>+ Anti-rábica </b> = R$ 20,00&nbsp;&nbsp;&nbsp;</p><br/>
                        <p><b>TOTAL</b> = R$ 55,00 <b>ANUAIS</b></p><br/>
                        <a class="btn" href="<?= site_url() ?>adotaveis/apadrinhamento-de-vacinas">quero ser padrinho de <b>vacinas</b></a>
                    </li>
                </ul>

                <ul class="box">
                    <li><h2>Apadrinhamento de Castração</h2><i class="castracao"></i></li>
                    <!-- <li>
                            <p>
                                    A castração dos animais depende do peso, girando entre R$ 80,00 e R$ 140,00. Por isso, estipulamos o valor de R$ 100,00 para os padrinhos de castração.
                            </p>
                            <p><b>Castração</b> = R$ 100,00 <b>PAGAMENTO ÚNICO</b></p><br/>
                            <a class="btn" href="<?= site_url() ?>adotaveis/apadrinhamento-de-castracao">quero ser padrinho de <b>castração</b></a>
                    </li> -->

                    <li>
                        <p>
                            A castração dos animais depende do peso, girando entre R$ 95,00 e R$ 325,00.
                        </p><br>
                        <p>
                            <b>Castração Cães:</b>
                        </p><br><br>
                        <p><b>Macho até 10kg</b> (P) - R$ 195,00</p><br>
                        <p><b>Macho até 20kg (M)</b>- R$ 225,00</p><br>
                        <p><b>Macho até 30kg (G)</b> - R$ 245,00</p><br>
                        <p><b>Macho até 40kg (GG)</b> - R$ 275,00</p><br><br>
                        <p><b>Femea até 10kg (P)</b> - R$ 245,00</p><br>
                        <p><b>Femea até 20kg (M)</b> - R$ 275,00</p><br>
                        <p><b>Femea até 30kg (G)</b> - R$ 295,00</p><br>
                        <p><b>Femea até 40kg (GG)</b> - R$ 325,00</p><br><br>
                        <p><b>Castração Gatos:</b></p><br><br>
                        <p><b>Macho:</b> R$ 95,00</p><br>
                        <p><b>Femea:</b> R$ 245,00</p><br>

                        <a class="btn" href="<?= site_url() ?>adotaveis/apadrinhamento-de-castracao">quero ser padrinho de <b>castração</b></a>
                    </li>
                </ul>

                <ul class="box">
                    <li><h2>Apadrinhamento de Antipulgas</h2><i class="antipulgas"></i></li>
                    <li>
                        <p>
                            Evitar pulgas e carrapatos não é apenas uma questão de higiene, mas também de saúde, visto que esses animais transmitem diversas doenças para nossos amigos. Por isso, tentamos sempre manter o antipulga de nossos animais em dia (e é muito dificil controlar a população de pulgas e carrapatos no canil). Se você tem interesse em ajudar a manter um cão saudável e pronto para a adoção, seja um/uma padrinho/madrinha de antipulgas.
                        </p>
                        <br/>
                        <p><b>Cão sem coceira</b> = R$ 30,00 <b>MENSAIS</b></p><br/>
                        <a class="btn" href="<?= site_url() ?>adotaveis/apadrinhamento-de-anti-pulgas">quero ser padrinho de <b>Antipulgas</b></a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="rosa">
            <div class="row">
                <ul>
                    <li>
                        <h3>Voluntariado</h3>
                        <p>
                            Diversas são as formas que você pode ajudar! Temos voluntários que ajudam nas tarefas no canil, nos eventos, no transporte dos animais e doações, na confecção de material gráfico, nos banhos e passeios e muito mais!<br><br>
                            Para tornar-se um voluntário Patas Dadas, envie email para <a href="mailto:voluntarios@patasdadas.com.br">voluntarios@patasdadas.com.br</a>
                        </p>
                    </li>
                    <li>
                        <h3>Parcerias</h3>
                        <p>
                            Estamos sempre em busca de empresas para firmar parcerias! Atendimento veterinário, castração, venda de produtos com % de doação para o Patas Dadas, doação de produtos da empresa, etc.<br><br> 
                            Envie email para <a href="mailto:contato@patasdadas.com.br">contato@patasdadas.com.br</a> e conversaremos uma parceria que favoreça os dois lados!
                        </p>
                    </li>
                    <li>
                        <h3>Doação em Dinheiro</h3>
                        <p>
                            Os abandonos são constantes e, infelizmente, os gastos também! Por isso, toda e qualquer doação é bem vinda e muito importante!<br><br>

                        </p>
                        <p>
                            <!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
                        <form action="https://pagseguro.uol.com.br/checkout/v2/donation.html" method="post">
                            <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                            <input type="hidden" name="currency" value="BRL" />
                            <input type="hidden" name="receiverEmail" value="engel.laureen@gmail.com" />
                            <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/209x48-doar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                        </form>
                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                        </p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="content">
            <div class="row">

                <ul class="box">
                    <!-- <li class="agenda">
                            <h2>Agendas e Calendários 2016</h2>
                            <figure style="background: url(<?= base_url() ?>assets/public/img/lojinha/01.jpg);"></figure>
                            <a class="btn" title="Lojinha" href="<?= site_url() ?>lojinha">Comprar</a>
                    </li> -->
                    <?php if (@$pontos): ?>
                        <li><h2>Pontos de coleta de doações</h2></li>
                        <li>
                            <p>Veja abaixo os locais que são ponto de coleta de doação para o Patas Dadas:</p><br>
                            <div>
                                <?php foreach ($pontos as $row): ?>
                                    <p><span></span><b><?= $row->ponto ?>:</b> <?= $row->endereco ?> - <?= $row->cidade ?>/<?= $row->estado ?></p><br>
                                <?php endforeach; ?>
                            </div>
                            <p>Pode ser um ponto de coleta? Envie email para <a href="mailto:contato@patasdadas.com.br">contato@patasdadas.com.br</a></p><br>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
</section>
<!-- ************ SETOR END ************ -->

<?php $this->load->view('includes/footer.php'); ?>