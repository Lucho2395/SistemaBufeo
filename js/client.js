function save() {
    var valor = "correcto";
    var client_name = $('#client_name').val();
    var client_type = $('#client_type').val();
    var client_number = $('#client_number').val();
    var client_address = $('#client_address').val();
    var client_telephone = $('#client_telephone').val();
    var tipo_documento = $('#tipò_documento').val();


    if(tipo_documento == ""){
        alertify.error('El campo Nombre Cliente está vacío');
        $('#tipò_documento').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#tipò_documento').css('border','');
    }

    if(client_name == ""){
        alertify.error('El campo Nombre Cliente está vacío');
        $('#client_name').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#client_name').css('border','');
    }

    if(client_type == ""){
        alertify.error('No se ha Seleccionado un Tipo de Cliente');
        $('#client_type').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#client_type').css('border','');
    }

    if(client_number == ""){
        alertify.error('El campo RUC o DNI está vacío');
        $('#client_number').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#client_number').css('border','');
    }

    if(client_address == ""){
        if(client_type == "EMPRESA"){
            alertify.error('El campo Dirección está vacío');
            $('#client_address').css('border','solid red');
            valor = "incorrecto";
        }
    } else {
        $('#client_address').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "client_name=" + client_name +
            "&client_type=" + client_type +
            "&client_number=" + client_number +
            "&client_address=" + client_address +
            "&client_telephone=" + client_telephone +
            "&tipo_documento=" + tipo_documento;
        $.ajax({
            type:"POST",
            url: urlweb + "api/Client/save",
            data: cadena,
            success:function (r) {

                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Client/all';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    case "3":
                        alertify.error("El Cliente con ese número de RUC o DNI ya existe");
                        $('#client_number').css('border','solid red');
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}