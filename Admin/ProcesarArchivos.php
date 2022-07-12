<?php
include_once '../Config/ConexionRayo.php';

# Conecto con la Base de Datos
$ConexionRayo = new ConexionRayo();

if (isset($_FILES['archivo_procesar'])):

    try {

        # Defino Variables
        $separador = ',';
        $lineseparator = "\n";
        $rutaFile = $_FILES['archivo_procesar']['tmp_name'];
        $delimitadores = $_POST['delimitador'];
        $limiteCampos = $_POST['limite_campos'];
        $grupoConsulta = $_POST['grupo_consulta'];

        # Invalido los Errores SQL
        $consqlSession = "SET SESSION sql_mode = ''";
        $ConexionRayo->ejecutarDatos($consqlSession);

        # Cargo el Archivo
        $consqlTruncate = "TRUNCATE TABLE `cargue2`";
        $ConexionRayo->ejecutarDatos($consqlTruncate);

        # Variables de Insercion de Datos
        $x = 0;
        $arrayInsert = [];
        $reemplazar = true;
        $consqlInsert = "INSERT INTO `cargue2` (_reemplazar_) VALUES ";

        $file = fopen($rutaFile, 'r');
        $count = 0;
        while (($line = fgets($file, 8198)) !== false) {

            $info = str_replace($delimitadores, '|&|', $line);
            $array = explode('|&|', $info);

            foreach ($array as $key => $val) {
                if ($val === '') {
                    unset($array[$key]);
                }
            }

            $array = array_values($array);

            if (!empty($limiteCampos)) {
                $final = [];
                for ($z = 0; $z <= $limiteCampos; $z++) {
                    $final[] = (isset($array[$z])) ? $array[$z] : '';
                }
            } else {
                $final = $array;
            }

            if ($reemplazar) {
                $reemplazar = false;

                $z = 0;
                $reemplazo = [];
                foreach ($final as $campo) {
                    $z++;
                    $reemplazo[] = 'campo' . $z;
                }

                $consqlInsert = "INSERT INTO `cargue2` (" . implode(', ', $reemplazo) . ") VALUES ";
                $limiteCampos = --$z;
            }

            $arrayInsert[] = "('" . implode("', '", $final) . "')";

            if (count($arrayInsert) > 500) {
                $count += 500;
                $consqlGeneral = $consqlInsert . implode(', ', $arrayInsert);
                $x += $ConexionRayo->ejecutarDatos($consqlGeneral);
                $arrayInsert = [];
            }
        }

        if (count($arrayInsert) > 0) {
            $count += count($arrayInsert);
            $consqlGeneral = $consqlInsert . implode(', ', $arrayInsert);
            $x += $ConexionRayo->ejecutarDatos($consqlGeneral);
            $arrayInsert = [];
        }

        fclose($file);

        $consqlConsulta = "SELECT * FROM consultas where estado = 1 AND grupo = '{$grupoConsulta}'";
        $objectResult = $ConexionRayo->obtenerDatos($consqlGeneral);
        $arrayConsulta = (empty($objectResult)) ? [] : $objectResult->fetchAll();
        foreach ($arrayConsulta as $consulta) {
            $ConexionRayo->ejecutarDatos($consulta['query']);
        }

        $consqlSelect = "SELECT * FROM cargue2";
        $objectResult2 = $ConexionRayo->obtenerDatos($consqlSelect);
        $arrayDatos = (empty($objectResult2)) ? [] : $objectResult2->fetchAll();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Excel Procesado.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        ?>


        <table border="1" cellpadding="3" style="border-collapse: collapse;">
            <?php foreach ($arrayDatos as $key => $array): ?>
                <?php if ($key === 0): ?>
                    <tr>
                        <?= '<td style="width:100px">' . implode('</td><td style="width:100px">', array_keys($array)) . '</td></tr>' ?>
                    </tr>
                <?php endif; ?>
                <tr>
                    <?= '<td style="width:100px">' . implode('</td><td style="width:100px">', $array) . '</td></tr>' ?>
                </tr>
            <?php endforeach; ?>
        </table>


        <?php
    } catch (PDOException $e) {
        die("Error en base de datos: " . $e->getMessage());
    } catch (Exception $e) {
        die("Error en base de datos: " . $e->getMessage());
    }


else:
    
    $infoGrupo = $ConexionRayo->consultarGrupoConsultas();
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
            <title>Cargues Rayo CR</title>
        </head>
        <body>
            <div class="container">
                <h1 class="mt-4 text-center text-success">Cargues Rayo CR</h1>
                <div class="row">
                    <div class="col-md-8 offset-2 border pt-3 pb-3">
                        <form action="/optiimizar_bases/Admin/ProcesarArchivos.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="archivo_procesar" class="form-label">
                                    <strong>Seleccione el Archivo:</strong>
                                </label>
                                <input type="file" id="archivo_procesar" name="archivo_procesar" class="form-control" required="required">
                            </div>
                            <div class="mb-3">
                                <label for="limite_campos" class="form-label">
                                    <strong>Indique el limite de columnas <small>(Solo si aplica)</small>:</strong>
                                </label>
                                <input type="number" id="limite_campos" name="limite_campos" min="0" max="80" value="0" class="form-control" required="required">
                            </div>
                            <div class="mb-3">
                                <label for="grupo_consulta" class="form-label">
                                    <strong>Indique el grupo de consultas a aplicar:</strong>
                                </label>
                                <select class="form-control"id="grupo_consulta" name="grupo_consulta" required="required">
                                    <option value="">-- Seleccione --</option>
                                    <?php foreach ($infoGrupo as $grupo): ?>
                                        <option value="<?= $grupo['id_grupo'] ?>"><?= $grupo['nombre_grupo'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="limite_campos" class="form-label">
                                    <strong>Indique el delimitador a usar <small>(Puede seleccionar mas de uno)</small>:</strong>
                                </label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del1" name="delimitador[]">
                                    <label class="form-check-label" for="del1">Punto y Coma <strong class="text-info">(;)</strong></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del2" name="delimitador[]">
                                    <label class="form-check-label" for="del2">Coma <strong class="text-info">(,)</strong></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del3" name="delimitador[]">
                                    <label class="form-check-label" for="del3">Tabulación <strong class="text-info">(\t)</strong></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del4" name="delimitador[]">
                                    <label class="form-check-label" for="del4">Espacios <strong class="text-info">( )</strong></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del5" name="delimitador[]">
                                    <label class="form-check-label" for="del5">Pipe <strong class="text-info">(|)</strong></label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="del6" name="delimitador[]">
                                    <label class="form-check-label" for="del6">Guión <strong class="text-info">(-)</strong></label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button id="btnCargar" type="submit" class="btn btn-success btn-lg">
                                    <i class="fa fa-upload"></i> Cargar
                                </button>
                            </div>
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
<?php
endif;
?>