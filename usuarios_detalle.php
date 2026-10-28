<?php
include('lib.php');
$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

if(isset($_GET['id'])){
    if($_GET['id']>0){
        $sql = 'SELECT * FROM users WHERE id= :id';
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id',$_GET['id'],PDO::PARAM_INT);
        $stmt->execute();

        $reg = $stmt->fetch();
    }
}else{
    header('Location: usuarios.php');
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
    <div>
        Usuario: <?php echo $reg['user'] ?>
    </div>
    <div>
        Contraseña: <?php echo $reg['password'] ?>
    </div>
    <div>
        Permiso: <?php echo $reg['permiso'] ?>
    </div>
</body>
</html>