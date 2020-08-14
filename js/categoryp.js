function save() {
    var valor = "correcto";
    var categoryp_name = $('#categoryp_name').val();
    var categoryp_description = $('#categoryp_description').val();


    if(categoryp_name == ""){
        alertify.error('El campo Nombre Categoria está vacío');
        $('#categoryp_name').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#categoryp_name').css('border','');
    }

    if(categoryp_description == ""){
        alertify.error('El campo Descripción Categoria está vacío.');
        $('#categoryp_description').css('border','solid red');
        valor = "incorrecto";
    } else {
        $('#categoryp_description').css('border','');
    }

    if (valor == "correcto"){
        var cadena = "categoryp_name=" + categoryp_name +
            "&categoryp_description=" + categoryp_description;
        $.ajax({
            type:"POST",
            url: urlweb + "api/Categoryp/save",
            data: cadena,
            success:function (r) {
                switch (r) {
                    case "1":
                        alertify.success("¡Guardado!");
                        location.href = urlweb +  'Categoryp/all';
                        break;
                    case "2":
                        alertify.error("Fallo el envio");
                        break;
                    default:
                        alertify.error("ERROR DESCONOCIDO");
                }
            }
        });
    }

}