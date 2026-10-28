<?php
include('lib.php');

$resultado = '';

if(!empty($_GET['dni'])){
    $conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

    $sql = 'SELECT * FROM clientes WHERE dni=:dni';
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':dni',$_GET['dni'],PDO::PARAM_STR);
    $stmt->execute();
    
    if($reg = $stmt->fetch()){
        $resultado = $reg['nombre'].'_'.$reg['apellido1'].'_'.$reg['apellido2'];
    }

}

echo $resultado;