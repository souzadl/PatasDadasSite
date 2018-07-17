

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?= base_url() ?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?= base_url() ?>assets/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- 	<script src="<?= base_url() ?>assets/admin/bower_components/datepicker/js/bootstrap-datepicker.js"></script>  -->

<!-- DataTables JavaScript -->
<script src="<?= base_url() ?>assets/admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

<script src="<?= base_url() ?>assets/admin/js/jquery.maskMoney.js" type="text/javascript"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?= base_url() ?>assets/admin/js/bootbox-master/bootbox.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= base_url() ?>assets/admin/dist/js/sb-admin-2.js"></script>



<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[0, "desc"]]
        });

        $('.add').click(function () {
            idOrigem = '#' + $(this).attr('id') + '_origem';
            myOri = $(idOrigem);
            myDest = myOri.parent();

            newObj = myOri.clone().appendTo(myDest);
            if (newObj.is("div")) {
                newObj.find('input.datepicker').removeClass('hasDatepicker').datepicker();
            }
            if (newObj.is("input") && newObj.hasClass('datepicker')) {
                newObj.removeClass('hasDatepicker').datepicker();
            }
            return false;
        });
        
        $(".formModal").submit(function(e){            
            e.preventDefault();
            var form = $(this);
            var postData = form.serializeArray();
            var formURL = form.attr("action");            
            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data, textStatus, jqXHR) {                    
                    json = eval("(" + data + ")");
                    $(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');                    
                    $('.modal .close').click();   

                    if(form.attr("id") == "historicoPesoForm"){
                        $('#tableHistoricosPeso tbody').append("<tr><td>"+json.data_afericao+"</td><td>"+json.peso+"</td><td><a href=\"#\"><i class=\"fa fa-trash\"></i></a></td></tr>");
                    }

                    if(form.attr("id") == "doencaCronicaForm"){
                        $('#lista_doencas_cronicas').append("<li>"+json.descricao+" <a href=\"#\"><i class=\"fa fa-trash\"></i></a></li>");
                    }
                    if(form.attr("id") == "alimentacaoEspecialForm"){
                        $('#lista_alimentacao_especial').append("<li>"+json.descricao+" <a href=\"#\"><i class=\"fa fa-trash\"></i></a></li>");
                    }    
                    if(form.attr("id") == "deficienciaFisicaForm"){
                        $('#lista_deficiencia_fisica').append("<li>"+json.descricao+" <a href=\"#\"><i class=\"fa fa-trash\"></i></a></li>");
                    }                      
                },
                error: function (jqXHR, status, error) {
                    console.log(status + ": " + error);
                }
            });            
        });
    });

    $(function () {
        $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy",
            yearRange: "1930:2016"
        });
    });

    function ConfirmExcluir()
    {
        bootbox.confirm("Are you sure?", function (result) {
            Example.show("Confirm result: " + result);
        });
    }
</script>

</body>
</html>