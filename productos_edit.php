<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

if(isset($_GET['idproducto'])){
    if(!$_GET['idproducto']>0){
        header('Location: productos.php');
    }
}


if(!empty($_POST['producto'])){ 
    $sqlUpdate = 'UPDATE productos SET producto=:producto, precio=:precio, stock=:stock, foto=:foto WHERE id=:idproducto';
    $stmtUpdate = $conexion->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':producto',$_POST['producto'],PDO::PARAM_STR);
    $stmtUpdate->bindParam(':precio',$_POST['precio'],PDO::PARAM_STR);
    $stmtUpdate->bindParam(':stock',$_POST['stock'],PDO::PARAM_INT);
    $stmtUpdate->bindParam(':foto',$_POST['foto'],PDO::PARAM_STR);
    $stmtUpdate->bindParam(':idproducto',$_GET['idproducto'],PDO::PARAM_INT);
    $stmtUpdate->execute();
    header('Location: productos_detalle.php?idproducto='.$_GET['idproducto']);
}


$sql = 'SELECT * FROM productos WHERE id=:idproducto';
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':idproducto',$_GET['idproducto'],PDO::PARAM_INT);
$stmt->execute();

if(!$r = $stmt -> fetch()){
   header('Location: productos.php');
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
    
<form name="formu" id="formu" action="productos_edit.php?idproducto=<?php echo $_GET['idproducto']?>" method="POST">
    <div>
        <label for="producto">Producto:</label>
        <input type="text" name="producto" id="producto" value="<?php echo $r['producto'] ?>">
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="<?php echo $r['precio'] ?>">
    </div>
    <div>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="<?php echo $r['stock'] ?>">
    </div>
    <div>
        <label for="foto">Foto:</label>
        <input type="text" name="foto" id="foto" value="<?php echo $r['foto'] ?>">
    </div>
    <div>
        <input type="submit" value="ENVIAR">
    </div>
</form>

</body>
</html>