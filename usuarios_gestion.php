<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

if(!empty($_POST['user'])){ // Si se recibe por POST un valor de 'user' es que recibimos datos del formulario
    if(empty($_POST['id'])){ // Si el campo 'id' está vacío, es que los datos recibidos son de un nuevo usuario que hay que insertar
        
        $pwdCifrada = password_hash($_POST['password'],PASSWORD_BCRYPT); // Encriptamos la contraseña usando "password_hash", que tiene dos parámetros: el dato a encriptar (es decir, la contraseña) y el algoritmo de encriptación.

        $sqlInsert = 'INSERT INTO users (user,password,permiso) VALUES(:user,:password,:permiso)';
        $stmt = $conexion->prepare($sqlInsert);
        $stmt->bindParam(':user',$_POST['user'],PDO::PARAM_STR);
        $stmt->bindParam(':password',$pwdCifrada,PDO::PARAM_STR);
        $stmt->bindParam(':permiso',$_POST['permiso'],PDO::PARAM_STR);
        $stmt->execute();

        $nuevoId = $conexion->lastInsertId();

        header('Location: usuarios_detalle.php?id='.$nuevoId);

    }else{ // Si no, es que los datos recibidos son de un usuario ya existente y hay que actualizarlos
        $sqlUpdate = 'UPDATE users SET user=:user,permiso=:permiso WHERE id=:id';
        $stmt = $conexion->prepare($sqlUpdate);
        $stmt->bindParam(':id',$_POST['id'],PDO::PARAM_INT);
        $stmt->bindParam(':user',$_POST['user'],PDO::PARAM_STR);
        $stmt->bindParam(':permiso',$_POST['permiso'],PDO::PARAM_STR);
        $stmt->execute();

        header('Location: usuarios_detalle.php?id='.$_POST['id']);
    }
}

$reg = array('id'=>'','user'=>'','password'=>'','permiso'=>''); // Inicializamos el array '$reg' para que no dé error al ser usado en los value de los campos del formulario, si es un alta de nuevo usuario.
if(isset($_GET['id'])){
    if($_GET['id']>0){
        $sql = 'SELECT * FROM users WHERE id= :id';
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id',$_GET['id'],PDO::PARAM_INT);
        $stmt->execute();

        $reg = $stmt->fetch();
    }
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
    <form name="formu" id="formu" action="usuarios_gestion.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $reg['id']?>">
        <div>
            <label for="user">Usuario:</label>
            <input type="text" name="user" id="user" value="<?php echo $reg['user']?>">
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="text" name="password" id="password" value="<?php echo $reg['password']?>">
        </div>
        <div>
            <label for="permiso">Permiso:</label>
            <input type="text" name="permiso" id="permiso" value="<?php echo $reg['permiso']?>">
        </div>
        <div>
            <input type="submit" value="ENVIAR">
        </div>
    </form>
</body>
</html>