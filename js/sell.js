
$(function () {
    $("#example2").DataTable();
});

function agregarPersona(nombre, numero, direccion) {
    $("#client_number").val(numero);
    $("#client_name").val(nombre);
    $("#client_address").val(direccion);
    alertify.success('El cliente se agregó correctamente!');

}

function quitarProducto(cod) {
    var cadena = "codigo=" + cod;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Sell/deleteProduct",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Producto Agregado');
                $('#table_products').load(urlweb + 'Sell/table_products');
            } else {
                alertify.error('Hubo Un Error');
            }
        }
    });
}

function preguntarSiNo(total){
    var client_number = $('#client_number').val();
    var saleproduct_type = $('#type_sell').val();
    var saleproduct_total = total;
    alertify.confirm('Realizar Venta', '¿Esta seguro que desea realizar esta venta? Monto Total: s/.' + saleproduct_total,
        function(){ vender(client_number , saleproduct_type, saleproduct_total) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function preguntarSiNoA(id_saleproduct){
    alertify.confirm('Anular Venta', '¿Esta seguro que desea anular esta venta? Una vez realizado, no se podrá deshacer.',
        function(){ anular(id_saleproduct) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function vender(client_number , saleproduct_type, saleproduct_total){
    var cadena = "client_number=" + client_number +
        "&saleproduct_type=" + saleproduct_type +
        "&saleproduct_total=" + saleproduct_total;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Sell/sellProduct",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Realizada');
                location.href = urlweb + 'Sell/viewSale/' + r;
            } else {
                alertify.error('No se pudo llevar acabo la venta');
            }
        }
    });
}

function anular(id_saleproduct){
    var cadena = "id_saleproduct=" + id_saleproduct;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Sell/revokeSale",
        data : cadena,
        success:function (r) {
            if(r!=2){
                alertify.success('Venta Realizada');
                location.href = urlweb + 'Sell/viewhistory/';
            } else {
                alertify.error('No se pudo anular la venta');
            }
        }
    });
}