<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">            

            <input type="hidden" name="id_animal" value="<?= @$animal->id_animal ?>">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">   
                        <label>Nome</label>
                        <input tabindex="1" class="form-control" name="nome" placeholder="Digite o nome da animal" value="<?= @$animal->nome ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Sexo</label>
                        <br/>
                        <label class="radio-inline">
                            <input tabindex="3" type="radio" <?php
                            if (@$animal->sexo == "M"): echo 'checked="checked"';
                            endif;
                            ?> value="M" id="optionsRadiosInline2" name="sexo">Macho
                        </label>
                        <label class="radio-inline">
                            <input tabindex="3" type="radio" <?php
                            if (@$animal->sexo == "F"): echo 'checked="checked"';
                            endif;
                            ?> value="F" id="optionsRadiosInline3" name="sexo">Fêmea
                        </label>
                    </div>

                    <div class="form-group">
                        <?php
                        //$postDt = $this->input->post('data_nascimento');
                        //$postDt = str_replace('/', '-', $postDt);
                        if (@$animal->data_aparicao != "" || @$animal->data_aparicao != "0000-00-00") {
                            $aparicao = date('d/m/Y', strtotime(@$animal->data_aparicao));
                        }
                        ?>     
                        <label>Data de aparição</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="5" class="form-control datepicker" name="data_aparicao" placeholder="Selecione a data de aparição" value="<?= @$aparicao ?>">
                    </div>

                    <div class="form-group">
                        <label>Porte</label>
                        <select tabindex="7" name="porte" class="form-control">
                            <option value="">Selecione</option>
                            <option <?php if (@$animal->porte == "Filhote") echo "selected='selected'"; ?> value="Filhote">Filhote</option>
                            <option <?php if (@$animal->porte == "P") echo "selected='selected'"; ?> value="P">P</option>
                            <option <?php if (@$animal->porte == "M") echo "selected='selected'"; ?> value="M">M</option>
                            <option <?php if (@$animal->porte == "G") echo "selected='selected'"; ?> value="G">G</option>
                            <option <?php if (@$animal->porte == "GG") echo "selected='selected'"; ?> value="GG">GG</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Condicao</label>
                        <select tabindex="9" name="condicao" class="form-control">
                            <option value="">Selecione</option>
                            <option <?php if (@$animal->condicao == "DI") echo "selected='selected'"; ?> value="DI">Disponível</option>
                            <option <?php if (@$animal->condicao == "A") echo "selected='selected'"; ?> value="A">Adotado</option>
                            <option <?php if (@$animal->condicao == "D") echo "selected='selected'"; ?> value="D">Desaparecido</option>
                            <option <?php if (@$animal->condicao == "O") echo "selected='selected'"; ?> value="O">Óbito</option>
                            <option <?php if (@$animal->condicao == "I") echo "selected='selected'"; ?> value="I">Indisponível</option>
                        </select>
                    </div>

                    <div class="form-group" id="insercaoDeFotos">
                        <div class="form-group" id="inputDeFotos">   
                            <label>Foto</label>
                            <input tabindex="11" name="foto" type="file">
                            <?php if (@$animal->foto): ?>
                                <br/><img src="<?= base_url() ?>assets/uploads/animais/<?= $animal->foto ?>" style="width:20%;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group input">   
                        <label>Perfil no Instagram</label>
                        <input tabindex="13" class="form-control" name="perfil_instagram" placeholder="Link do perfil no Instagram" value="<?= @$animal->perfil_instagram ?>">
                        <p class="help-block">Insira a URL completa, com - <b>HTTPS://</b> -</p>
                    </div>

                    <div class="form-group">
                        <label>Saúde</label>
                        <div class="checkbox">
                            <label>
                                <input <?php if (@$animal->check_castrado == 'S') echo "checked='checked'"; ?> name="check_castrado" type="checkbox" value="S">Castrado 
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input <?php if (@$animal->check_vacinado == 'S') echo "checked='checked'"; ?> name="check_vacinado" type="checkbox" value="S">Vacinado 
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input <?php if (@$animal->check_vermifugado == 'S') echo "checked='checked'"; ?> name="check_vermifugado" type="checkbox" value="S">Vermifugado 
                            </label>
                        </div>
                    </div>


                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <?php
                        //$postDt = $this->input->post('data_nascimento');
                        //$postDt = str_replace('/', '-', $postDt);
                        if (@$animal->data_nascimento) {
                            $nascimento = date('d/m/Y', strtotime(@$animal->data_nascimento));
                        }
                        ?>   
                        <label>Data de nascimento</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="2" class="form-control datepicker" name="data_nascimento" placeholder="Selecione a data de nascimento" value="<?= @$nascimento ?>">
                    </div> 

                    <div class="form-group">
                        <label>Tipo</label>
                        <br/>
                        <label class="radio-inline">
                            <input tabindex="4" type="radio" <?php
                            if (@$animal->tipo == "C"): echo 'checked="checked"';
                            endif;
                            ?> value="C" id="optionsRadiosInline2" name="tipo">Cão
                        </label>
                        <label class="radio-inline">
                            <input tabindex="4" type="radio" <?php
                            if (@$animal->tipo == "G"): echo 'checked="checked"';
                            endif;
                            ?> value="G" id="optionsRadiosInline3" name="tipo">Gato
                        </label>
                    </div>

                    <div class="form-group">   
                        <label>Local de aparição</label>
                        <input tabindex="6" class="form-control" name="local_aparicao" placeholder="Digite o local de aparição" value="<?= @$animal->local_aparicao ?>">
                    </div>

                    <div class="form-group">
                        <label>Pelagem</label>
                        <select tabindex="8" name="pelagem" class="form-control">
                            <option value="">Selecione</option>
                            <option <?php if (@$animal->pelagem == "C") echo "selected='selected'"; ?> value="C">Curta</option>
                            <option <?php if (@$animal->pelagem == "L") echo "selected='selected'"; ?> value="L">Longa</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <?php
                        if (@$animal->data_condicao) {
                            $dtcondicao = date('d/m/Y', strtotime(@$animal->data_condicao));
                        }
                        ?>     
                        <label>Data da condição</label>
                        <input data-date-format="dd/mm/yyyy" tabindex="10" class="form-control datepicker" name="data_condicao" placeholder="Selecione a data de aparição" value="<?= @$dtcondicao ?>">
                    </div>

                    <div class="form-group">   
                        <label>Perfil Facebook</label>
                        <input tabindex="12" class="form-control" name="perfil_facebook" placeholder="Link do perfil no Facebook" value="<?= @$animal->perfil_facebook ?>">
                        <p class="help-block">Insira a URL completa, com - <b>HTTPS://</b> -</p>
                    </div>

                    <div class="form-group">   
                        <label>Album Facebook</label>
                        <input tabindex="14" class="form-control" name="album_facebook" placeholder="Link do album no Facebook" value="<?= @$animal->album_facebook ?>">
                        <p class="help-block">Insira a URL completa, com - <b>HTTPS://</b> -</p>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label>Temperamento</label>
                <textarea tabindex="15" class="form-control" name="temperamento" rows="5"><?= @$animal->temperamento ?></textarea>
            </div>

            <div class="form-group">
                <label>Observação</label>
                <textarea tabindex="16" class="form-control" name="observacao" rows="5"><?= @$animal->observacao ?></textarea>
            </div>

            <div class="form-group">
                <label>Observação privada (não vai para o site)</label>
                <textarea tabindex="17" class="form-control" name="observacao_privada" rows="5"><?= @$animal->observacao_privada ?></textarea>
            </div>

            <div class="form-group">
                <label>Tratamento</label>
                <textarea tabindex="18" class="form-control" name="tratamento" rows="5"><?= @$animal->tratamento ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" id="passsword2" class="btn btn-success" style="float:right;" value="Salvar">
            </div>            
        </div>
        <!-- /.panel-body -->
    </div>
</div>
<!-- /.col-lg-6 -->