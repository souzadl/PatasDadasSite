<div class="col-lg-6" >
    <div class="panel panel-default">
        <div class="panel-heading">
            Doença crônica
            <a href="#" data-toggle="modal" data-target="#doencaCronicaDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
        </div>    
        <div class="panel-body">
            <ul id="lista_doencas_cronicas">
                <?php foreach ($doencasCronicas as $doenca) {
                    echo "<li>".$doenca->descricao." <a href=\"#\"><i class=\"fa fa-trash\"></i></a></li>";
                }?>
            </ul>
        </div>
    </div>        
</div>

