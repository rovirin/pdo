<?php
include('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$idp = $_GET['id']; 

$sql = "SELECT * FROM productos WHERE id = :idp"; 
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':idp',$idp,PDO::PARAM_INT);
$stmt->execute();

$r = $stmt->fetch();

?>
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
