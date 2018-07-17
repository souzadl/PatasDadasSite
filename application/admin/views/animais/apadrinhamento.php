<div class="col-lg-12" id="ApadrinhamentoAnchor">
    <div class="panel panel-default">
        <!--<div class="panel-heading">
            Apadrinhamento                        
        </div>-->
        <!-- /.panel-heading -->
        <div class="panel-body">
            <form id="FormAnimal" role="form" method="post" action="<?= base_url() ?>admin.php/animais/salvarApadrinhamento" enctype="multipart/form-data">
                <input type="hidden" name="id_animal" value="<?= @$animal->id_animal ?>">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Ração</label>
                            <select tabindex="24" name="padrinho_racao" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($padrinhos->result() as $row): ?>
                                    <option <?php if (@$row->id_padrinho == @$animal->padrinho_racao) echo "selected='selected'"; ?> value="<?= $row->id_padrinho ?>"><?= $row->nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <label>Castração</label>
                            <select tabindex="26" name="padrinho_castracao" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($padrinhos->result() as $row): ?>
                                    <option <?php if (@$row->id_padrinho == @$animal->padrinho_castracao) echo "selected='selected'"; ?> value="<?= $row->id_padrinho ?>"><?= $row->nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>      
                    </div>

                    <div class="col-lg-6">

                        <div class="form-group">
                            <label>Vacinas</label>
                            <select tabindex="25" name="padrinho_vacinas" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($padrinhos->result() as $row): ?>
                                    <option <?php if (@$row->id_padrinho == @$animal->padrinho_vacinas) echo "selected='selected'"; ?> value="<?= $row->id_padrinho ?>"><?= $row->nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Anti Pulgas</label>
                            <select tabindex="27" name="padrinho_pulgas" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($padrinhos->result() as $row): ?>
                                    <option <?php if (@$row->id_padrinho == @$animal->padrinho_pulgas) echo "selected='selected'"; ?> value="<?= $row->id_padrinho ?>"><?= $row->nome ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>  

                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" id="passsword2" class="btn btn-success" style="float:right;" value="Salvar">
                </div>
            </form>
        </div>
        <!-- /.panel-body -->
    </div>
</div>
<!-- /.col-lg-6 -->