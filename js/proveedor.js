function preguntarSiNo(id){
    alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?',
        function(){ deleter(id) }
        , function(){ alertify.error('Operacion Cancelada')});
}

function deleter(id){
    var cadena = "id=" + id;
    $.ajax({
        type:"POST",
        url: urlweb + "api/Proveedor/delete",
        data : cadena,
        success:function (r) {
            if(r==1){
                alertify.success('Registro Eliminado');
                location.reload();
            } else {
                alertify.error('No se pudo realizar porque el producto del proveedor se vendió');
            }
        }
    });
}


function save() {
    var valor = "correcto";
    var ruc_proveedor = $('#ruc_proveedor').val();
    var nombre_provee = $('#nombre_provee').val();
    var contacto_provee = $('#contacto_provee').val();
    var telefono_provee = $('#telefono_provee').val();
    var direccion_provee = $('#direccion_provee').val();

    if(ruc_proveedor == ""){
        alertify.error('El campo Numero de RUC o DNI está vacío');
        $('#ruc_proveedor').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#ruc_proveedor').css('border','');
    }

    if(nombre_provee == ""){
        alertify.error('El campo Nombre Proveedor está vacío');
        $('#nombre_provee').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#nombre_provee').css('border','');
    }

    if(contacto_provee == ""){
        alertify.error('El campo Nombre de Contacto está vacío');
        $('#contacto_provee').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#contacto_provee').css('border','');
    }

    if(telefono_provee == ""){
        alertify.error('El campo Telefono está vacío');
        $('#telefono_provee').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#telefono_provee').css('border','');
    }

    if(direccion_provee == ""){
        alertify.error('El campo Direccion está vacío');
        $('#direccion_provee').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#direccion_provee').css('border','');
    }


    if (valor == "correcto"){
        var cadena = "ruc_proveedor=" + ruc_proveedor +
            "&nombre_provee=" + nombre_provee +
            "&contacto_provee=" + contacto_provee +
            "&telefono_provee=" + telefono_provee +
            "&direccion_provee=" + direccion_provee;
        $.ajax({
            type:"POST",
            url: urlweb + "api/Proveedor/save",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Proveedor/all';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Proveedor con ese número de RUC o DNI ya existe");
                        $('#ruc_proveedor').css('border','solid red');
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}