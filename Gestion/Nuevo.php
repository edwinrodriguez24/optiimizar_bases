<?php

include_once '../Config/ConexionRayo.php';

$ConexionRayo = new ConexionRayo();
$infoAgentes = $ConexionRayo->consultarAgentes();
?>
<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="/optiimizar_bases/Public/lib/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/fontawesome-free-6.1.1-web/css/solid.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.css" rel="stylesheet">
        <link href="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/css/select2.css" rel="stylesheet">
        <title>Nueva Gestión</title>
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5 text-center text-primary">Ingresar Gestión</h1>
            <div class="row">
                <div class="col-md-8 offset-2 border pt-3 pb-3">
                    <form id="formNuevaGestion" action="#">
                        <input type="hidden" name="action" value="guardarGestion">
                        <input type="hidden" name="fechaGestion" value="<?= date('Y-m-d H:i:s') ?>">
                        <div class="mb-3">
                            <label for="agente" class="form-label">
                                <strong>Agente:</strong>
                            </label>
                            <select class="form-control"id="agente" name="agente">
                                <option value="">-- Seleccione --</option>
                                <?php foreach($infoAgentes as $agente): ?>
                                    <option value="<?= $agente['id_agente'] ?>"><?= $agente['nombre'] ?> (<?= $agente['extension'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cedula" class="form-label">
                                <strong>Cédula Cliente:</strong>
                            </label>
                            <input type="text" class="form-control" id="cedula" name="cedula">
                        </div>
                        <div class="mb-3">
                            <label for="linea" class="form-label">
                                <strong>Linea:</strong>
                            </label>
                            <select class="form-control" id="linea" name="linea">
                                <option value="">-- Seleccione --</option>
                                <option value="linea" data-clase="cobroOpcion">Cobros</option>
                                <option value="cantillano" data-clase="cantillanoOpcion">Cantillano</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none cobroOpcion">
                            <label for="mora" class="form-label">
                                <strong>Tipo:</strong>
                            </label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="">-- Seleccione --</option>
                                <option value="mora" data-clase="verMora">Mora</option>
                                <option value="plp">PLP</option>
                                <option value="repitentes" data-clase="verRepitente">Repitentes</option>
                                <option value="primerizos">Primerizos</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none verMora">
                            <label for="mora" class="form-label">
                                <strong>Mora:</strong>
                            </label>
                            <select class="form-control" id="mora" name="mora">
                                <option value="">-- Seleccione --</option>
                                <option value="10 a 14 Dias">10 a 14 Dias</option>
                                <option value="30 a 45 Dias">30 a 45 Dias</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none verRepitente">
                            <label for="repitentes" class="form-label">
                                <strong>Repitentes:</strong>
                            </label>
                            <select class="form-control" id="repitentes" name="repitentes">
                                <option value="">-- Seleccione --</option>
                                <option value="Mas de 10">Mas de 10</option>
                                <option value="4 a 9">4 a 9</option>
                                <option value="2 a 3">2 a 3</option>
                            </select>
                        </div>
                        <div class="text-center">
                            <button id="btnNuevaGestion" type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-check"></i> Insertar
                            </button>
                        </div>
                        <h3 class="statusRegister mt-2 text-center text-danger text-capitalize"></h3>
                    </form>
                </div>
            </div>
        </div>
        <script src="/optiimizar_bases/Public/lib/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
        <script src="/optiimizar_bases/Public/lib/jquery-3.6/jquery-3.6.0.min.js"></script>
        <script src="/optiimizar_bases/Public/lib/sweetalert2-11.4.19/sweetalert2.all.js"></script>
        <script src="/optiimizar_bases/Public/lib/select2-4.1.0-rc.0/js/select2.js"></script>
        <script src="/optiimizar_bases/Public/js/script.js"></script>
    </body>
</html>