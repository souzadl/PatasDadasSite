<div class="col-lg-12" id="FotosAnchor">
    <div class="panel panel-default">
        <!--<div class="panel-heading">
            Galeria de Fotos                           
        </div>-->

        <!-- /.panel-heading -->
        <div class="panel-body">
            <form id="FormItem" role="form" method="post" action="<?= base_url() ?>admin.php/animais/salvarGaleria" enctype="multipart/form-data">
                <input type="hidden" name="id_animal" value="<?= @$animal->id_animal ?>">

                <div class="alert alert-danger">
                    APENAS 3 FOTOS por animal - Tamanho ideal para imagens: 1000px (JPG otimizado para web)
                </div>

                <div id="insercaoDeFotos">
                    <div class="form-group" id="inputDeFotos">   
                        <label>Fotos (selecione as imagens segurando CONTROL)</label>
                        <input tabindex="19" multiple name="imagem[]" type="file">
                    </div>
                </div>                   
                <div class="form-group">
                    <input type="submit" id="enviar" class="btn btn-success" style="float:right;" value="Salvar">
                </div>
            </form>
        </div>
        <!-- /.panel-body -->
        <div class="panel-body">
            <?php
            if (@$fotos): echo "<ul style='display:inline;' width:100%>";
                foreach ($fotos as $row):
                    ?>
                    <li class="text-center" style="display:inline; float:left; width: 20%">
                        <img class="img-thumbnail" width="90%" src="<?= base_url() ?>assets/uploads/animais/galeria/<?= $row->imagem ?>" /><br/>
                        <button onclick="location.href = '<?= base_url() ?>admin.php/animais/excluirFoto/<?= $row->id_animal_galeria ?>/<?= $animal->id_animal ?>';" class="btn btn-outline btn-danger btn-xs" type="button">EXCLUIR</button>

                    </li>
                <?php endforeach; ?>
                </ul>

            <?php endif; ?>
        </div>

    </div>
</div>
<!-- /.col-lg-12 -->