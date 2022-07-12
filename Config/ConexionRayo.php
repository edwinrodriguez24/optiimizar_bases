<?php

class ConexionRayo {

    /*
    private $user = "id19221151_rayocr";
    private $passw = "R4y0Cr2417*2022";
    private $host = "localhost";
    private $db = "id19221151_rayo";
    */
    private $user = "epiz_32125557";
    private $passw = "oxIY5v089uGTiO3";
    private $host = "sql311.epizy.com";
    private $db = "epiz_32125557_rayo";
    private $conexion;

    public function __construct()
    {
        if($_SERVER['HTTP_HOST'] === 'localhost'){
            
            $this->user = "root";
            $this->passw = "root";
            $this->host = "localhost";
            $this->db = "rayo";
        }
        
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_FOUND_ROWS => true,
            PDO::ATTR_PERSISTENT => true
        );

        try {
            $this->conexion = new PDO(
                    'mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->passw, $options
            );
        } catch (PDOException $e) {
            print 'Error: ' . $e->getMessage();
            die();
        }
    }

    public function close() {
        $this->conexion = null;
    }
    
    public function obtenerDatos($query)
    {
        $object = $this->conexion->query($query);
        return (!empty($object)) ? $object : [];
    }
    
    public function ejecutarDatos($query)
    {
        return $this->conexion->exec($query);
    }

    public function consultarAgentes()
    {
        $consqlSelect = "SELECT * FROM agente WHERE estado = 1";
        return $this->obtenerDatos($consqlSelect);
    }

    public function consultarGrupoConsultas()
    {
        $consqlSelect = "SELECT * FROM grupo WHERE estado = 1";
        return $this->obtenerDatos($consqlSelect);
    }

    public function consultasPivot($idConsulta = '')
    {
        $consqlSelect = "
                    SELECT * 
                    FROM consultas_pivot 
                    WHERE estado = 1";
        if(!empty($idConsulta)){
            $consqlSelect .= " AND id_consulta = {$idConsulta}";
        }
        return $this->obtenerDatos($consqlSelect);
    }
    
    public function insertarGestion($arrayRegistros)
    {
        ini_set('display_errors', "1");
        $consqlInsert = "
            INSERT INTO `gestion_rayo`(`fecha_registro`, `fecha_gestion`, `agente`, `cedula`, `linea`, `tipo`, `mora`, `recipiente`)
            VALUES ('".date('Y-m-d H:i:s')."', '{$arrayRegistros['fechaGestion']}', '{$arrayRegistros['agente']}', '{$arrayRegistros['cedula']}', '{$arrayRegistros['linea']}', '{$arrayRegistros['tipo']}', '{$arrayRegistros['mora']}', '{$arrayRegistros['repitentes']}')";
        return $this->ejecutarDatos($consqlInsert);
    }
}
