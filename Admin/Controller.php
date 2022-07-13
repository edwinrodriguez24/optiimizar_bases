<?php

include_once '../Config/ConexionRayo.php';

$ConexionRayo = new ConexionRayo();

$accion = filter_input(INPUT_POST, 'action');

if($accion === 'consultas_pivot'){
    
    # DEfino Variables
    $idConsulta = filter_input(INPUT_POST, 'id_consulta');
    
    # Consulto Informacion de la Consulta
    $objtConsulta = $ConexionRayo->consultasPivot($idConsulta);
    $infoConsulta = $objtConsulta->fetchAll(PDO::FETCH_ASSOC);
    
    # Ejecuto la Consulta
    $objectDato = $ConexionRayo->obtenerDatos($infoConsulta[0]['query']);
    $arrayDatos = (empty($objectDato)) ? [] : $objectDato->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($arrayDatos, JSON_NUMERIC_CHECK);
}