<?php $this->load->view('includes/header.php'); ?>

<div id="ancora"></div>

<!-- ************ SETOR ************ -->
<section id="adotaveis">
    <div id="container" class="container">
        <ul id="scene" class="scene">
            <li class="layer lay1" data-depth="0.2"><img class="image1" src="<?= base_url() ?>assets/public/img/headers/patas-dadas-adotaveis-01.png"></li>
            <li class="layer lay4" data-depth="0.4"><img class="image2" src="<?= base_url() ?>assets/public/img/headers/patas-dadas-adotaveis-02.png"></li>
        </ul>
    </div>


    <?php if (@$animais->result()): ?>
        <div id="listagem">
            <div id="ancora2"></div>



            <?php $this->load->view('includes/menu-adotaveis.php'); ?>
            <div class="content" id="topContent" style="min-height: 700px;	">
                <h2 id="FilterText" class="absolute">Todos os nossos amigos disponíveis</h2>

                <div class="row">

                    <?php if ($this->agent->is_mobile()): ?>
                        <div id="ads" style="width: 80%; float: right;">
                        <?php else: ?>
                            <div id="ads">
                            <?php endif; ?>    	
                            <!-- Adotaveis - Topo -->
                            <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-6202805151194355"
                                 data-ad-slot="8957960229"
                                 data-ad-format="auto"></ins>
                        </div>


                        <ul class="lista-animais" <?php if ($this->agent->is_mobile()): ?> style="margin-top:10px;" <?php else: ?> style="margin-top:100px;" <?php endif; ?>>
                            <?php
                            foreach ($animais->result() as $row):
                                $titlePrev = $this->utilidades->sanitize_title_with_dashes($row->nome);
                                ?>
                                <li data-tipo="<?= $row->tipo ?>" data-porte="<?= $row->porte ?>" data-sexo="<?= $row->sexo ?>" data-padrinho-racao="<?= $row->padrinho_racao ?>" data-padrinho-vacinas="<?= $row->padrinho_vacinas ?>" data-padrinho-castracao="<?= $row->padrinho_castracao ?>" data-padrinho-antipulgas="<?= $row->padrinho_pulgas ?>">
                                    <figure style="background: url(<?= base_url() ?>assets/uploads/animais/<?= @$row->foto ?>);"></figure>
                                    <a href="<?= site_url() ?>adotaveis/<?= $titlePrev; ?>/<?= $row->id_animal ?>" class="box">
                                        <div class="top">
                                            <h3 class="namedog"><?= $row->nome ?></h3>
                                            <i></i>
                                        </div>                       
                                    </a>
                                    <div class="bottom">
                                        <p>Compartilhar</p>
                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= site_url() ?>adotaveis/<?= $titlePrev; ?>/<?= $row->id_animal ?>"><i class="facebook"></i></a>
                                        <a target="_blank" href="https://twitter.com/home?status=<?= site_url() ?>adotaveis/<?= $titlePrev; ?>/<?= $row->id_animal ?>"><i class="twitter"></i></a>
                                        <a target="_blank" href="https://plus.google.com/share?url=<?= site_url() ?>adotaveis/<?= $titlePrev; ?>/<?= $row->id_animal ?>"><i class="gplus"></i></a>
                                    </div> 							
                                </li>
                            <?php endforeach; ?>

                        </ul>			
                    </div>
                </div>
            </div>
        <?php endif; ?>
</section>
<!-- ************ SETOR END ************ -->

<input type="hidden" id="hiddenTipo" name="tipo" value="">
<input type="hidden" id="hiddenSexo" name="sexo" value="">
<input type="hidden" id="hiddenPorte" name="porte" value="">

<script>

    $('#filtroGatos').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-tipo!='G']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-tipo='G']").fadeIn();
            var count = $("li[data-tipo='G']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo gato encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos gatos").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroCaes').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-tipo!='C']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-tipo='C']").fadeIn();
            var count = $("li[data-tipo='C']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo cão encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos cães").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroTodos').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li").fadeIn();
        $("#FilterText").text("Todos os nossos amigos disponíveis").fadeIn();
        $('html, body').animate({
            scrollTop: $("#topContent").offset().top
        }, 400, 'swing');
    });

    $('#filtroFilhote').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-porte!='Filhote']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-porte='Filhote']").fadeIn();
            var count = $("li[data-porte='Filhote']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo filhote encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que são filhotes").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });
    $('#filtroP').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-porte!='P']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-porte='P']").fadeIn();
            var count = $("li[data-porte='P']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo de porte pequeno encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que são de porte pequeno").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });
    $('#filtroM').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-porte!='M']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-porte='M']").fadeIn();
            var count = $("li[data-porte='M']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo de porte médio encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que são de porte médio").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });
    $('#filtroG').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-porte!='G']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-porte='G']").fadeIn();
            var count = $("li[data-porte='G']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo de porte grande encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que são de porte grande").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });
    $('#filtroGG').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-porte!='GG']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-porte='GG']").fadeIn();
            var count = $("li[data-porte='GG']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo de porte extra grande encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que são de porte extra grande").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroMacho').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-sexo!='M']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-sexo='M']").fadeIn();
            var count = $("li[data-sexo='M']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo macho encontrado :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos machos").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });
    $('#filtroFemea').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-sexo!='F']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-sexo='F']").fadeIn();
            var count = $("li[data-sexo='F']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhuma amiga fêmea encontrada :(").fadeIn();
            } else {
                $("#FilterText").text(count + " amigas fêmeas").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    //filtros right ---
    //data-padrinho-racao data-padrinho-vacinas data-padrinho-castracao data-padrinho-antipulgas
    $('#filtroRacao').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-padrinho-racao!='0']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-padrinho-racao='0']").fadeIn();
            var count = $("li[data-padrinho-racao='0']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo precisando de padrinho de ração no momento :)").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que precisam de padrinho de ração").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroVacinas').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-padrinho-vacinas!='0']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-padrinho-vacinas='0']").fadeIn();
            var count = $("li[data-padrinho-vacinas='0']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo precisando de padrinho de vacinas no momento :)").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que precisam de padrinho de vacinas").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroCastracao').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-padrinho-castracao!='0']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-padrinho-castracao='0']").fadeIn();
            var count = $("li[data-padrinho-castracao='0']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo precisando de padrinho de castração no momento :)").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que precisam de padrinho de castração").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

    $('#filtroAntipulga').click(function () {
        $("ul.menuLateral").find("li").css('opacity', 0.3);
        $(this).css('opacity', 1);
        $("ul.lista-animais").find("li[data-padrinho-antipulgas!='0']").fadeOut().promise().done(function () {
            $("ul.lista-animais").find("li[data-padrinho-antipulgas='0']").fadeIn();
            var count = $("li[data-padrinho-antipulgas='0']").length;
            if (count == 0) {
                $("#FilterText").text("Nenhum amigo precisando de padrinho de anti pulgas no momento :)").fadeIn();
            } else {
                $("#FilterText").text(count + " amigos que precisam de padrinho de anti pulgas").fadeIn();
            }
            $('html, body').animate({
                scrollTop: $("#topContent").offset().top
            }, 400, 'swing');
        });
    });

<?php if ($this->uri->segment(2) == "apadrinhamento-de-racao"): ?>
        $('#filtroRacao').click();
<?php endif; ?>
<?php if ($this->uri->segment(2) == "apadrinhamento-de-castracao"): ?>
        $('#filtroCastracao').click();
<?php endif; ?>
<?php if ($this->uri->segment(2) == "apadrinhamento-de-vacinas"): ?>
        $('#filtroVacinas').click();
<?php endif; ?>
<?php if ($this->uri->segment(2) == "apadrinhamento-de-anti-pulgas"): ?>
        $('#filtroAntipulga').click();
<?php endif; ?>

<?php if ($pagescript == 'listaadotaveis'): ?>
        $(document).ready(function () {

            var navigations = $('#ancora');
            pos = navigations.offset();

            $(window).scroll(function () {
                if ($(this).scrollTop() > pos.top + navigations.height()) {
                    $('.menuLateral').removeClass('absolute');
                    $('.menuLateral').addClass('fixed fadeInDown animated_a');
                } else if ($(this).scrollTop() <= pos.top) {
                    $('.menuLateral').addClass('absolute');
                    $('.menuLateral').removeClass('fixed fadeInDown animated_a');
                }
            });


            $(window).scroll(function () {
                if ($(this).scrollTop() > pos.top + navigations.height()) {
                    $('#FilterText').removeClass('absolute');
                    $('#FilterText').addClass('fixed fadeInDown animated_a');
                } else if ($(this).scrollTop() <= pos.top) {
                    $('#FilterText').addClass('absolute');
                    $('#FilterText').removeClass('fixed fadeInDown animated_a');
                }
            });



        });
<?php endif; ?>


</script>

<?php $this->load->view('includes/footer.php'); ?>