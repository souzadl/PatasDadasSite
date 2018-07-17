<div class="col-lg-6" >
    <div class="panel panel-default">
        <div class="panel-heading">
            Deficiências Físicas
            <a href="#" data-toggle="modal" data-target="#deficienciaFisicaDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
        </div>    
        <div class="panel-body">
            <ul id="lista_deficiencia_fisica">
                <?php foreach ($deficienciasFisicas as $deficiencia) {
                    echo "<li>".$deficiencia->descricao." <a href=\"#\" class=\"del\" id=\"apagarDeficienciaFisica/".$deficiencia->id."\"><i class=\"fa fa-trash\"></i></a></li>";
                }?>                   
            </ul>
        </div>
    </div>        
</div>
