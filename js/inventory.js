function preguntarSiNo(id){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este producto?',
        function(){ eliminar(id) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function eliminar(id){
    var cadena = "id=" + id;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Inventory/deleteProduct",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Producto Eliminado');
                location.reload();
            } else {
                alertify.error('No se pudo realizar');
            }
        }
    });
}