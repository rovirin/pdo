<?php
include ('lib.php');

$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$id = $_GET['id'];
$baja = $_GET['baja'];

$sql = 'UPDATE clientes SET baja = :baja WHERE id = :id';
$stmt = $conexion->prepare($sql);

$stmt->bindParam(':baja', $baja);
$stmt->bindParam(':id', $id);

$stmt->execute();

echo 'ok';
?>
