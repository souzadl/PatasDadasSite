<div class="panel panel-default">
    <div class="panel-heading">
        Saúde
    </div>    
    <div class="panel-body">
        <div class="col-lg-6" >
            <div class="panel panel-default" style="min-height: 289px;">
                <div class="panel-heading">
                    Histórico de peso
                    <a href="#" data-toggle="modal" data-target="#historicoPesoDialog"><i class="fa fa-plus-circle"></i></a>
                </div>    
                <div class="panel-body">
                    <table id="tableHistoricosPeso" class="table">
                        <thead>
                            <tr>
                                <th>Data de aferição</th>
                                <th>Peso</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (@$historicosPeso as $historico): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($historico->data_afericao))  ?></td>
                                <td><?= $historico->peso ?></td>
                                <td><a href="#"><i class="fa fa-trash"></i></a></td>
                            </tr>    
                            <?php endforeach; ?>
                        </tbody>
                    </table>                            
                </div>
            </div>        
        </div>    
        <?php $this->load->view('animais/doencaCronica.php'); ?>      
        <?php $this->load->view('animais/alimentacaoEspecial.php'); ?>  
        <?php $this->load->view('animais/deficienciaFisica.php'); ?> 
   
        <div class="col-lg-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Medicações
                    <a href="#" data-toggle="modal" data-target="#medicacoesDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
                </div>    
                <div class="panel-body">
                    <!--
                    <table>
                        <thead>
                            <tr>
                                <th>Medicação</th>
                                <th>Uso</th>
                                <th>Dosagem</th>
                                <th>Frequência</th>
                                <th>Contínuo</th>
                                <th>Início</th>
                                <th>Término</th>
                                <th></th>
                            <tr>
                        </thead>
                        <tbody>
                            <tr id="medicacoes_origem">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><a href="#"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        </tbody>
                    </table>-->
                </div>
            </div>        
        </div>         
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Checklist
    </div>    
    <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
                <input type="checkbox" name="aptoAdocao"> Apto para adoção      
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input type="checkbox" name="aptoEvento"> Apto para evento       
            </div>        
        </div>    
        
        <div class="col-lg-12" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Alterações de saúde    
                    <a href="#" data-toggle="modal" data-target="#alteracoesSaudeDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
                </div>    
                <div class="panel-body">
                </div>
            </div>        
        </div>          
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vacinas
                    <a href="#" data-toggle="modal" data-target="#vacinasDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
                </div>    
                <div class="panel-body">
                    <i class="fa fa-circle fa-fw" style="color: greenyellow;"></i>Próxima 25/05/2019
                    
                </div>
            </div>        
        </div>    
        <div class="col-lg-3" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Seresto
                    <a href="#" data-toggle="modal" data-target="#serestosDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
                </div>    
                <div class="panel-body">
                    <i class="fa fa-circle fa-fw" style="color: yellow;"></i>Próxima 25/05/2019
                    
                </div>
            </div>        
        </div>     
        <div class="col-lg-3" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Vermífugos
                    <a href="#" data-toggle="modal" data-target="#vermifugosDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
                </div>    
                <div class="panel-body">
                    <i class="fa fa-circle fa-fw" style="color: red;"></i>Próxima 25/05/2019

                </div>
            </div>        
        </div> 
        <div class="col-lg-3" >
            <div class="panel panel-default">
                <div class="panel-heading">
                    Castração
                </div>    
                <div class="panel-body">
                    <i class="fa fa-circle fa-fw" style="color: greenyellow;"></i>Castrado<br>
                    <div class="form-group"> 
                        <input type="checkbox" name="castradoPorPatas"> Castrado Por Patas Dadas
                    </div>    
                    <div class="form-group"> 
                        <label for="clinica">Clínica</label>
                        <select name="clinica" class="form-control">
                            <option value="">Selecione</option>
                        </select>                
                    </div>
                </div>
            </div>        
        </div>           
    </div>
</div>
