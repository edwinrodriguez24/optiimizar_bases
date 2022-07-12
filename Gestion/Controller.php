<?php

date_default_timezone_set('America/Bogota');

include_once '../Config/ConexionRayo.php';

$ConexionRayo = new ConexionRayo();

$accion = filter_input(INPUT_POST, 'action');

if($accion === 'guardarGestion'){
    
    $arrayRegistros = [
        'agente' => filter_input(INPUT_POST, 'agente'), 
        'cedula' => filter_input(INPUT_POST, 'cedula'), 
        'linea' => filter_input(INPUT_POST, 'linea'), 
        'tipo' => filter_input(INPUT_POST, 'tipo'), 
        'mora' => filter_input(INPUT_POST, 'mora'), 
        'repitentes' => filter_input(INPUT_POST, 'repitentes'), 
        'fechaGestion' => filter_input(INPUT_POST, 'fechaGestion'), 
    ];
    
    $afectados = $ConexionRayo->insertarGestion($arrayRegistros);
    
    echo json_encode(['response' => ($afectados > 0), 'message' => "Registros afectados {$afectados}"]);
}