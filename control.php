<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$sql = 'SELECT * FROM users WHERE user= :user';
$stmt = $conexion->prepare($sql);
$stmt -> bindParam(':user',$_POST['usuario'],PDO::PARAM_STR);
$stmt->execute();

if($reg = $stmt->fetch()){
    if(password_verify($_POST['clave'],$reg['password'])){ // utilizamos "password_verify() para que comprueba si la clave encriptada de la base de datos es igual a la contraseña que ha tecleado el usuario en el login. Este método ya sabe cómo encriptar esta clave para poder compararlas
        $_SESSION['idusuario'] = $reg['id'];
        $_SESSION['usuario'] = $reg['user'];


        $sqlAcceso = 'INSERT INTO accesos (user_id,fechahora) VALUES(:id,:fechahora)';
        $stmtAcceso = $conexion->prepare($sqlAcceso);
        $stmtAcceso -> bindParam(':id',$reg['id'],PDO::PARAM_INT);
        $stmtAcceso -> bindParam(':fechahora',date('Y-m-d h:i:s'),PDO::PARAM_STR);
        $stmtAcceso -> execute();

        header('Location: portada.php');
    }else{
         header('Location: index.php');
    }
}else{
    header('Location: index.php');
}

