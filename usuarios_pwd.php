<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$alerta='';

if(!empty($_POST['password'])){
    
    $claveEncriptada = password_hash($_POST['password'],PASSWORD_BCRYPT);

    $sql = 'UPDATE users SET password=:password WHERE id=:id';
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':password',$claveEncriptada,PDO::PARAM_STR);
    $stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
    $stmt->execute();

    $alerta.= "alert('CONTRASEÑA ACTUALIZADA');";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onLoad="<?php echo $alerta ?>">
    <form name="formu" id="formu" action="usuarios_pwd.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']?>">

        <label for="password">Nueva contraseña: </label>
        <input type ="text" name="password" id="password"> 
        <input type="submit" value="Guardar contraseña">
    </form>
</body>
</html>