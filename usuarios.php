<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$sql = 'SELECT * FROM users';
$stmt = $conexion->prepare($sql);
$stmt->execute();

$resultado = '';
while($reg = $stmt->fetch()){
    $resultado.= '<div>';
        $resultado.= '<a href="usuarios_gestion.php?id='.$reg['id'].'">Editar</a> -';
        $resultado.= '<a href="usuarios_pwd.php?id='.$reg['id'].'">Cambiar Contraseña</a> -';
        $resultado.= $reg['user'];
    $resultado.= '</div>';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $resultado ?>
</body>
</html>