<?php
# 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
$consqlSelect = filter_input(INPUT_POST, 'query');
?>
<html>
    <head>

    </head>
    <body>
        <div style="text-align: center;">
            <form action="/optiimizar_bases/Admin/QueryBasic.php" method="post" class="redirectjs">
                <h2>Indique la consulta</h2>
                <textarea name="query" style="width: 90%; height: 200px"><?= $consqlSelect ?></textarea>
                <br><br><br>
                <button type="submit" style="border: 0px hidden; background-color: #0066FF; color: #FFFFFF; padding: 10px; font-size: 15px">Comenzar</button>
            </form>
        </div>

        <?php
        if (!empty($consqlSelect)):

            $host = 'localhost';
            $username = 'id19221151_rayocr';
            $database = 'id19221151_rayo';
            $password = 'R4y0Cr2417*2022';
            
            if($_SERVER['HTTP_HOST'] === 'localhost'){
                $host = 'localhost';
                $username = 'root';
                $database = 'rayo';
                $password = 'root';
            }

            try {

                # Conecto con la Base de Datos
                $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password,
                        array(
                    PDO::MYSQL_ATTR_LOCAL_INFILE => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::MYSQL_ATTR_FOUND_ROWS => true,
                    PDO::ATTR_PERSISTENT => true
                        )
                );

                # Invalido los Errores SQL
                $consqlSession = "SET SESSION sql_mode = ''";
                $pdo->exec($consqlSession);

                # Ejecuto la Consulta
                $arrayDatos = $pdo->query($consqlSelect)->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table class="table table-bordered mt-2" border="1" cellpadding="3" style="border-collapse: collapse;">
                <?php foreach ($arrayDatos as $key => $array): ?>
                        <?php if ($key === 0): ?>
                            <tr>
                            <?= '<th style="width:100px; text-align: center; background-color: #f0f0f0;  padding: 8px;">' . implode('</th><th style="width:100px; text-align: center; background-color: #f0f0f0; padding: 8px;">', array_keys($array)) . '</th></tr>' ?>
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
            endif;
            ?>
    </body>
</html>