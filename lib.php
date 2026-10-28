<?php
include('config.php');
function conectarse($servidor, $usuarioservidor, $claveservidor, $opcionesPDO) {
    try {
        $conectado = new PDO($servidor, $usuarioservidor, $claveservidor, $opcionesPDO);
    } catch (PDOException $e) {
        echo "Error al conectar con la base de datos: " . $e->getMessage();  
        exit;
    }
    return $conectado;
}

date_default_timezone_set('Europe/Madrid');