<?php
include ('lib.php');
$conexion = conectarse($servidor,$usuarioservidor,$claveservidor,$opcionesPDO);

$sql = 'SELECT * FROM clientes';
$stmt = $conexion->prepare($sql);
$stmt->execute();

$resultado = '';

while ($r = $stmt->fetch()) {
    $resultado .= '<tr>';

    if ($r['baja'] == 1) {
        $color = 'red';
    } else {
        $color = 'green';
    }

    $resultado .= '<td class="estado" data-id="' . $r['id'] . '" data-baja="' . $r['baja'] . '" style="color:' . $color . '; cursor:pointer;">' . $r['baja'] . '</td>';
    $resultado .= '<td>' . $r['nombre'] . '</td>';
    $resultado .= '</tr>';
}

echo '<table border="1">';
echo '<tr><th>Estado</th><th>Nombre</th></tr>';
echo $resultado;
echo '</table>';
?>
<script src="libestado.js"></script>
