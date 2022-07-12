<?php
include_once '../Config/ConexionRayo.php';

# Conecto con la Base de Datos
$ConexionRayo = new ConexionRayo();
$consultasPivot = $ConexionRayo->consultasPivot();
?>
<!DOCTYPE html>
<html>
    <head>
        <!--General -->
        <meta charset="utf-8">
        <meta charset=UTF-8>
        <title>::: PIVOTE :::</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta http-equiv="Expires" content="0">
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <!--Fin General -->
        <!--Librerias CSS -->
        <link href="/optiimizar_bases/Public/lib/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/solid.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/css/select2.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/optiimizar_bases/Public/lib/pivottable/dist/pivot.css">
        <!-- Fin Estilos -->
        <!--Librerias JS -->
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.all.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/js/select2.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/particleground/particleground.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/plotly-basic-latest.min.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/pivot.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/pivot.es.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/pivottable/dist/plotly_renderers.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/tableexport/FileSaver.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/tableexport/xlsx.full.min.js"></script>
        <script type="text/javascript" src="/optiimizar_bases/Public/lib/tableexport/tableexport.min.js"></script>
        <script src="/optiimizar_bases/Public/js/script.js"></script>
        <!-- Fin Librerias JS -->
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <nav class="navbar col-md-12" style="background: #595959 !important">
                    <a class="navbar-brand text-white col-md-5" href="#" style="font-size: 35px; padding: 0px; line-height: 1; margin: 0px; margin-bottom: 5px;">
                        <span class="principalTitle"><i class="fa fa-table"></i> Pivotes</span>
                        <span class="loadingTitle d-none"><i class="fa fa-refresh fa-spin"></i> Cargando Pivote...</span>
                    </a>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 mt-2">
                    <h4>Seleccione los Datos para la Tabla</h4>
                    <select id="cambiarInformeBusqueda" class="form-control">
                        <option value="">-- Seleccione Información --</option>
                        <?php foreach ($consultasPivot as $infoPivot): ?>
                            <option value="<?= $infoPivot['id_consulta'] ?>"><?= $infoPivot['nombre_consulta'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div id="outputBtn" class="col-md-12 d-none mt-2">
                    <button type="button" class="btn btn-warning" id="btnActualizarRegistros">
                        <i class="fa fa-refresh"></i> Actualizar Registros
                    </button>
                    <button type="button" class="btn btn-success" id="btnActivarExporte">
                        <i class="fa fa-download"></i> Activar Exporte
                    </button>
                </div>
            </div>
            <div id="output" class="mt-2" style="margin-bottom: 60px; left: 5px; position: relative;"></div>
        </div>
        <script type="text/javascript">
            // This example adds Plotly chart renderers.
            var derivers = $.pivotUtilities.derivers;
            var renderers = $.extend($.pivotUtilities.renderers, $.pivotUtilities.plotly_renderers);

            function cambiarInformePivot()
            {
                var valor = this.value;
                if (valor == '') {
                    $("#output").html('');
                    $("#outputBtn").addClass('d-none');
                } else {

                    // Consulto los Datos
                    $.ajax({
                        url: '/optiimizar_bases/Admin/Controller.php',
                        type: 'POST',
                        data: {action: 'consultas_pivot', id_consulta: valor},
                        dataType: 'json',
                        beforeSend: function () {
                            $(".principalTitle").addClass('d-none');
                            $(".loadingTitle").removeClass('d-none');
                        },
                        success: function (jsonData) {

                            console.log(jsonData);

                            $("#output").pivotUI(jsonData, {
                                renderers: renderers,
                                rowOrder: "value_a_to_z",
                                colOrder: "value_z_to_a"
                            }, true, "es");

                            $("#outputBtn").removeClass('d-none');

                            Swal.fire({
                                icon: 'success',
                                title: 'Consulta Realizada',
                                showConfirmButton: false,
                                timer: 2000
                            });

                            $(".loadingTitle").addClass('d-none');
                            $(".principalTitle").removeClass('d-none');

                        },
                        error: function (a, b, c, d) {
                            console.log(a, b, c, d);
                        }
                    });

                }
            }

            function actualizarRegistros()
            {
                $("#cambiarInformeBusqueda").change();
            }

            function activarExporte()
            {
                let table = $(".pvtTable:first");
                if (table.length > 0) {
                    let name = $('#cambiarInformeBusqueda').find('option:selected').text();
                    var caption = table.find('caption');
                    table.find('caption').remove();

                    TableExport(table[0], {
                        filename: name,
                        sheetname: " Pivot",
                        escape: 'false',
                        bootstrap: true,
                        excelstyles: ['background-color', 'color', 'font-weight', 'border']
                    });

                    caption = table.find('caption');
                    caption.css({"width": "100%", "padding-top": "0px", "position": "absolute", "top": "-49px", "left": "180px"});
                    caption.find('button').addClass('btn btn-info').css("margin", "3px");
                } else {
                    Swal.fire({
                        type: 'warning',
                        title: 'Indique una consulta o use en modo tabla antes de habilitar el exporte!',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }

            $(document).ready(function () {

                // Asigno Evento
                $("#cambiarInformeBusqueda").on("change", cambiarInformePivot);
                $("#btnActualizarRegistros").on("click", actualizarRegistros);
                $("#btnActivarExporte").on("click", activarExporte);

                $(".elementsDestroy").remove();
            });
        </script>
    </body>
</html>
