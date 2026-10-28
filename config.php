<?php
$servidor = 'mysql:host=localhost;dbname=tienda;port=3306;charset=utf8';
$usuarioservidor = 'tienda';
$claveservidor = 'patata';
$opcionesPDO = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
