
$(function () {
    $("#example2").DataTable();
});

function agregarPersona(nombre, numero, telefono, direccion) {
    $("#client_number").val(numero);
    $("#client_name").val(nombre);
    $("#client_telefono").val(telefono);
    $("#client_address").val(direccion);
    alertify.success('El cliente se agregó correctamente!');

}

function quitarProducto(cod) {
    var cadena = "codigo=" + cod;
    $.ajax({
        type:"POST",
        url: urlweb + "api/SellGas/deleteProduct",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Producto Agregado');
                $('#table_products').load(urlweb + 'SellGas/table_productsGas');
            } else {
                alertify.error('Hubo Un Error');
            }
        }
    });
}

function preguntarSiNo(){
    var client_number = $('#client_number').val();
    var saleproductgas_direccion = $('#client_address').val();
    var saleproductgas_telefono = $('#client_telefono').val();
    var saleproduct_type = $('#type_sell').val();
    var saleproduct_naturaleza = $('#naturaleza_sell').val();
    var total = $('#montototal').val();
    var gravada = $('#gravada').val();
    var igv = $('#igv').val();
    var saleproduct_inafecta = $('#inafecta').val();
    var saleproduct_exonerada = $('#exonerada').val();
    var saleproduct_icbper = $('#icbper').val();
    var saleproduct_total = total;
    var saleproduct_gravada = gravada;
    var saleproduct_igv = igv;
    if (saleproduct_type == "07" || saleproduct_type == "08"){
        if (saleproduct_type == "07"){
            var tipo_nota = $('#TipoNotaCredito').val();
        } else{
            var tipo_nota = $('#TipoNotaDebito').val();
        }
    }


    alertify.confirm('Realizar Venta', '¿Esta seguro que desea realizar esta venta? Monto Total: s/.' + saleproduct_total,
        function(){ vender(client_number, saleproductgas_direccion, saleproductgas_telefono, saleproduct_type, saleproduct_naturaleza, saleproduct_exonerada, saleproduct_inafecta, saleproduct_icbper, saleproduct_total, saleproduct_gravada, saleproduct_igv, tipo_nota) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function preguntarSiNoA(id_saleproductgas){
    alertify.confirm('Anular Venta', '¿Esta seguro que desea anular esta venta? Una vez realizado, no se podrá deshacer.',
        function(){ anular(id_saleproductgas) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function vender(client_number, saleproductgas_direccion, saleproductgas_telefono, saleproduct_type, saleproduct_naturaleza, saleproduct_exonerada, saleproduct_inafecta, saleproduct_icbper, saleproduct_total, saleproduct_gravada, saleproduct_igv, tipo_nota){
    var cadena = "client_number=" + client_number +
        "&saleproductgas_direccion=" + saleproductgas_direccion +
        "&saleproductgas_telefono=" + saleproductgas_telefono +
        "&saleproduct_type=" + saleproduct_type +
        "&saleproduct_naturaleza=" + saleproduct_naturaleza +
        "&saleproduct_exonerada=" + saleproduct_exonerada +
        "&saleproduct_inafecta=" + saleproduct_inafecta +
        "&saleproduct_icbper=" + saleproduct_icbper +
        "&saleproduct_total=" + saleproduct_total +
        "&saleproduct_gravada=" + saleproduct_gravada +
        "&tipo_nota=" + tipo_nota +
        "&saleproduct_igv=" + saleproduct_igv;
    $.ajax({
        type:"POST",
        url: urlweb + "api/SellGas/sellProduct",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Realizada');
                location.href = urlweb + 'SellGas/viewSale/' + r;
            } else {
                alertify.error('No se pudo llevar acabo la venta');
            }
        }
    });
}

function anular(id_saleproductgas){
    var cadena = "id_saleproductgas=" + id_saleproductgas;
    $.ajax({
        type:"POST",
        url: urlweb + "api/SellGas/revokeSale",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Anulada');
                location.href = urlweb + 'SellGas/viewhistory';
            } else {
                alertify.error('No se pudo anular la venta');
            }
        }
    });
}

// de la vista pedidospendientes

function preguntarSiNoEntregar(id_saleproductgas){
    alertify.confirm('Entrega Realizada', '¿Esta seguro que desea realizar esta entrega?',
        function(){ entregado(id_saleproductgas) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function entregado(id_saleproductgas){
    var cadena = "id_saleproductgas=" + id_saleproductgas;
    $.ajax({
        type:"POST",
        url: urlweb + "api/SellGas/estadoentregado",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Pedido Entregado');
                location.href = urlweb + 'SellGas/pedidospendientes';
            } else {
                alertify.error('No se pudo Entregar el pedido');
            }
        }
    });
}

function preguntarSiNoCancelar(id_saleproductgas){
    alertify.confirm('Cancelar Pedido', '¿Esta seguro que desea Cancelar este Pedido?',
        function(){ Cancelar(id_saleproductgas) }
        , function(){ alertify.error('Operacion Cancelada')});
}
function Cancelar(id_saleproductgas){
    var cadena = "id_saleproductgas=" + id_saleproductgas;
    $.ajax({
        type:"POST",
        url: urlweb + "api/SellGas/revokeSale",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Pedido Cancelado');
                location.href = urlweb + 'SellGas/pedidospendientes';
            } else {
                alertify.error('No se pudo Cancelar el pedido');
            }
        }
    });
}

