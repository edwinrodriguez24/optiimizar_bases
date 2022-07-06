<?php
# 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
?>
<html>
    <head>

    </head>
    <body>
        <?php
        if (isset($_FILES['archivo_procesar'])):


            $host = 'localhost';
            $username = 'root';
            $database = 'rayo';
            $password = 'root';

            try {

                # Conecto con la Base de Datos
                $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password,
                        array(
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        )
                );

                # Defino Variables
                $separador = ',';
                $lineseparator = "\n";
                $rutaFile = $_FILES['archivo_procesar']['tmp_name'];
                $delimitadores = $_POST['delimitador'];
                $limiteCampos = $_POST['limite_campos'];
                $grupoConsulta = $_POST['grupo_consulta'];
                
                # Invalido los Errores SQL
                $consqlSession ="SET SESSION sql_mode = ''";
                $pdo->exec($consqlSession);
                
                # Cargo el Archivo
                $consqlTruncate = "TRUNCATE TABLE `cargue2`";
                $pdo->exec($consqlTruncate);

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
                        $x += $pdo->exec($consqlGeneral);
                        $arrayInsert = [];
                    }
                }
                
                if (count($arrayInsert) > 0) {
                    $count += count($arrayInsert);
                    $consqlGeneral = $consqlInsert . implode(', ', $arrayInsert);
                    $x += $pdo->exec($consqlGeneral);
                    $arrayInsert = [];
                }
                
                fclose($file);

                $consqlConsulta = "SELECT * FROM consultas where estado = 1 AND grupo = '{$grupoConsulta}'";
                $arrayConsulta = $pdo->query($consqlConsulta)->fetchAll(PDO::FETCH_ASSOC);
                foreach($arrayConsulta as $consulta){
                    $pdo->exec($consulta['query']);
                }

                $consqlSelect = "SELECT * FROM cargue2";
                $arrayDatos = $pdo->query($consqlSelect)->fetchAll(PDO::FETCH_ASSOC);
                
                header("Content-type: application/vnd-ms-excel");
                header("Content-Disposition: attachment; filename=Excel Procesado.xls");
                header("Pragma: no-cache");
                header("Expires: 0");
                ?>

                
                <table border="1" cellpadding="3" style="border-collapse: collapse;">
                    <?php foreach($arrayDatos as $key => $array): ?>
                        <?php if($key === 0): ?>
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
            ?>

            <div style="text-align: center;">
                <form action="/optiimizar_bases/ProcesarArchivos.php" method="post" enctype="multipart/form-data">
                    <h2>Indique el archivo a procesar</h2>
                    <input type="file" name="archivo_procesar">
                    <br><br><h2>Limite de columnas a cargar</h2>
                    <input type="number" name="limite_campos" min="0" value="0">
                    <br><br><h2>Grupo de Consultas</h2>
                    <input type="number" name="grupo_consulta" min="0" value="0">
                    <br><br><h2>Indique el delimitador</h2>
                    <br><input type="checkbox" id="del1" name="delimitador[]" value=";"><label for="del1">Punto y Coma <strong>(;)</strong></label>
                    <br><br><input type="checkbox" id="del2" name="delimitador[]" value=","><label for="del2">Coma <strong>(,)</strong></label>
                    <br><br><input type="checkbox" id="del3" name="delimitador[]" value="\t"><label for="del3">Tabulación <strong>(\t)</strong></label>
                    <br><br><input type="checkbox" id="del4" name="delimitador[]" value=" "><label for="del4">Espacios <strong>( )</strong></label>
                    <br><br><input type="checkbox" id="del5" name="delimitador[]" value="|"><label for="del5">Pipe <strong>(|)</strong></label>
                    <br><br><br>
                    <button type="submit" style="border: 0px hidden; background-color: #0066FF; color: #FFFFFF; padding: 10px; font-size: 15px">Comenzar</button>
                </form>
            </div>

        <?php
        endif;
        ?>
    </body>
</html>