<div class="page-header">
    <span id='nombre_cliente'><?php echo $user->cliente->razon_social ?></span>
    <span class='saldo' id='saldo_total'>$0.00</span>
    <span class="label label-info" id="gran_total">Gran Total</span>
</div>


    <div class="row">

        <div align="center">
                <?php
                echo $partial_movimientos_pendientes;
                echo $partial_facturas_pendientes;
                 ?>
            <?php
                echo anchor('/reportes/dashboard','Imprimir Reporte', array('class'=>'btn btn-success'));
            ?>
        </div>
    </div>


<script language="javascript">
    $(document).ready(function() {
        var facturado  = parseFloat(document.getElementById('saldo_facturado_hidden').value);
        var sinfacturar  = parseFloat(document.getElementById('saldo_sinfacturar_hidden').value);

        var grantotal = facturado + sinfacturar;

        $('#saldo_total').text(grantotal);
        $('#saldo_total').formatCurrency();
    });
</script>