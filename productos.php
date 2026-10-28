<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

if(isset($_GET['idborra'])){
    if($_GET['idborra']>0){
        $sqlBorra = 'DELETE FROM productos WHERE id = :idborra;';
        $stmtBorra = $conexion->prepare($sqlBorra);
        $stmtBorra -> bindParam(':idborra',$_GET['idborra'],PDO::PARAM_INT);
        $stmtBorra -> execute();

        header('Location: productos.php');
    }
}


$sql = 'SELECT * FROM productos';
$stmt = $conexion->prepare($sql);
$stmt -> execute();

$resultado = '';

while($r = $stmt->fetch()){

    $resultado.= '<tr>';
        $resultado.= '<td>'.$r['id'].'</td>';
        $resultado.= '<td><div class="paradetalle" data-id="'.$r['id'].'">'.$r['producto'].'</div></td>';
        $resultado.= '<td>'.$r['precio'].'</td>';
        $resultado.= '<td>'.$r['stock'].'</td>';
        $resultado.= '<td><img src="img/'.$r['foto'].'" width="150" alt="'.$r['producto'].'"></td>';
        $resultado.= '<td><a href="productos.php?idborra='.$r['id'].'">Borrar</a></td>';
        $resultado.= '<td><a href="productos_edit.php?idproducto='.$r['id'].'">Editar</a></td>';
        $resultado.= '<td><a href="productos_detalle.php?idproducto='.$r['id'].'">Detalle</a></td>';
    $resultado.= '</tr>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Foto</th>
            <th>-</th>
        </tr>

        <?php echo $resultado ?>

    </table>

    <div id="infodetalle"></div>

    <script src="js/libmodal.js" type="text/javascript"></script>
</body>
</html>