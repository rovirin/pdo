<?php
include('lib.php');

if(!empty($_POST['producto'])){ 

    $conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

    $sql = 'INSERT INTO productos (producto,precio,stock,foto) VALUES(:producto,:precio,:stock,:foto);';
    $stmt = $conexion->prepare($sql);
    $stmt -> bindParam(':producto',$_POST['producto'],PDO::PARAM_STR);
    $stmt -> bindParam(':precio',$_POST['precio'],PDO::PARAM_STR);
    $stmt -> bindParam(':stock',$_POST['stock'],PDO::PARAM_INT);
    $stmt -> bindParam(':foto',$_POST['foto'],PDO::PARAM_STR);
    $stmt->execute();

    $idnuevo = $conexion->lastInsertId();
    
    header('Location: productos_detalle.php?idproducto='.$idnuevo);
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
    
<form name="formu" id="formu" action="productos_alta.php" method="POST">
    <div>
        <label for="producto">Producto:</label>
        <input type="text" name="producto" id="producto">
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio">
    </div>
    <div>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock">
    </div>
    <div>
        <label for="foto">Foto:</label>
        <input type="text" name="foto" id="foto">
    </div>
    <div>
        <input type="submit" value="ENVIAR">
    </div>
</form>

</body>
</html>