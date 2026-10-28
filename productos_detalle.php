<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

if(isset($_GET['idproducto'])){
    if(!$_GET['idproducto']>0){
        header('Location: productos.php');
    }
}

$idp = $_GET['idproducto']; 

$sql = "SELECT * FROM productos WHERE id = :idp"; 
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':idp',$idp,PDO::PARAM_INT);
$stmt->execute();

if(!$r = $stmt->fetch()){
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
    <h1><?php echo $r['producto'] ?></h1>    

    <table>
        <tr>
            <th>Precio:</th>
            <td><?php echo $r['precio'] ?></td>
        </tr>
        <tr>
            <th>Stock:</th>
            <td><?php echo $r['stock'] ?></td>
        </tr>
        <tr>
            <th>Foto:</th>
            <td><img src="img/<?php echo $r['foto'] ?>" width="300" alt="<?php echo $r['producto'] ?>"></td>
        </tr>

    </table>

</body>
</html>