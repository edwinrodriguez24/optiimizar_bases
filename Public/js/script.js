function mostrarOpcionesLinea()
{
    $(".cantillanoOpcion, .cobroOpcion, .verMora, .verRepitente").addClass('d-none');
    $(".cantillanoOpcion, .cobroOpcion, .verMora, .verRepitente").find('input, select').val('');
    $("." + $(this).find('option:selected').attr('data-clase')).removeClass('d-none');
}

function mostrarOpcionesTipo()
{
    $(".verMora, .verRepitente").addClass('d-none');
    $(".verMora, .verRepitente").find('input, select').val('');
    $("." + $(this).find('option:selected').attr('data-clase')).removeClass('d-none');
}

function validarNuevaGestion(datos)
{
    var error = [];

    $.each($("#formNuevaGestion").serializeArray(), function (key, val) {
        if (val.value == '' && !$('#formNuevaGestion *[name="' + val.name + '"]').closest('div').hasClass('d-none')) {
            error.push('Indique el valor de ' + val.name);
        }
    });

    if (error.length === 0) {
        $.ajax({
            url: '/optiimizar_bases/Gestion/Controller.php',
            type: 'POST',
            data: $("#formNuevaGestion").serialize(),
            dataType: 'json',
            beforeSend: function () {
                $('#btnNuevaGestion').prop('disabled', true).html('Espere...');
            },
            success: function (jsonInfo) {
                if (jsonInfo.response === true) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Gestión Guardada',
                        showConfirmButton: false,
                        timer: 2000
                    }).then((result) => {
                        location.reload(true);
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Espera!',
                        html: 'Se ha presentado el siguiente inconveniente:<br>' + jsonInfo.message,
                        confirmButtonText: 'Continuar'
                    });
                }
            },
            error: function (a, b, c, d) {
                console.log(a, b, c, d);
            }
        });
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Espera!',
            html: 'Antes de continuar verifique los siguientes inconvenientes: <ul style="text-align: left;"><li>' + error.join('</li><li>') + '</li></ul>',
            confirmButtonText: 'Continuar'
        });
    }
}

function redirectjs(thisme)
{
    let datos = {};
    let href = $(thisme).attr("href");

    // formulario Seleccionado
    if (href === '' || href === undefined) {
        let form = $(thisme).closest('form');
        href = $(form).attr("action");
        datos = $(form).serialize();
    }

    $.ajax({
        url: href,
        type: 'POST',
        data: datos,
        beforeSend: function () {
            $("#seccionPrincipal").html('<h3>Cargando información, aguarde...</h3>');
        },
        success: function (data) {
            $("#seccionPrincipal").html(data);
        },
        error: function (a, b, c, d) {
            console.log(a, b, c, d);
        }
    });
}

function eventosIniciales()
{
    // Evento de Logueo
    $("#formNuevaGestion:not(.eventGestion)").addClass('eventGestion').on("submit", function (e) {
        e.preventDefault();
        return validarNuevaGestion();
    });

    $("#formNuevaGestion #linea:not(.eventLinea)").addClass('eventLinea').change(mostrarOpcionesLinea);
    $("#formNuevaGestion #tipo:not(.eventTipo)").addClass('eventTipo').change(mostrarOpcionesTipo);
    $("#formNuevaGestion #agente:not(.eventAgente)").addClass('eventAgente');
    if($("#formNuevaGestion #agente:not(.eventAgente)").length > 0){
        $("#formNuevaGestion #agente:not(.eventAgente)").select2();
    }
    $("#formNuevaGestion #select2-agente-container").closest('.select2').addClass('form-control');

    $("a.redirectjs:not(.eventRedirect)").addClass('eventRedirect').on("click", function (evt) {
        evt.preventDefault();
        
        $("#sidebar-nav").find('.nav-link').addClass('collapsed');
        $(this).removeClass('collapsed');
        
        return redirectjs(this);
    });
    $("form.redirectjs:not(.eventRedirect)").addClass('eventRedirect').on("submit", function (evt) {
        evt.preventDefault();
        return redirectjs(this);
    });
}

$(document).ready(function () {

    $(document).ajaxComplete(function () {
        eventosIniciales();
    });

    eventosIniciales();

    setInterval(function () {
        $("img[alt='www.000webhost.com']").closest('div').remove();
        $(".disclaimer").remove();
    }, 1000);
});