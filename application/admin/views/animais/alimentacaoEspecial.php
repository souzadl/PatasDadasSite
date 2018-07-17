<div class="col-lg-6" >
    <div class="panel panel-default">
        <div class="panel-heading">
            Alimentações Especiais
            <a href="#" data-toggle="modal" data-target="#alimentacaoEspecialDialog"><i class="fa fa-plus-circle fa-fw"></i></a>
        </div>    
        <div class="panel-body">
            <ul id="lista_alimentacao_especial">
                <?php foreach ($alimentacaoEspecial as $alimentacao) {
                    echo "<li>".$alimentacao->descricao." <a href=\"#\" class=\"del\" id=\"apagarAlimentacaoEspecial/".$alimentacao->id."\"><i class=\"fa fa-trash\"></i></a></li>";
                }?>                
            </ul>
        </div>
    </div>        
</div>

