<?php
$titulo_pagina = "Historial de Reparaciones";
include_once('header.php');
?>
<link rel="stylesheet" href="./css/productos.css">

<h2>Historial de Reparaciones</h2>

<?php
include_once('config_db.php');

$sql = "SELECT reparacion_id, fecha_inicio, fecha_final, trabajador_id 
        FROM reparacion 
        ORDER BY fecha_inicio DESC";

$resultado = $conn->query($sql);
$arrayReparaciones = [];

while ($reparacion = $resultado->fetch_object()) {
    $arrayReparaciones[] = $reparacion; 
}

$resultado->close();
$conn->close();

echo "<div class='productos'>"; // Reutilizamos la clase 'productos' para el grid

foreach ($arrayReparaciones as $rep) {
    $fecha_inicio = date("d/m/Y", strtotime($rep->fecha_inicio));
    $fecha_final = $rep->fecha_final ? date("d/m/Y", strtotime($rep->fecha_final)) : "En curso";

    echo "
        <div class='producto-item'>
            <div class='reparacion-info'>
                <h3>Reparación #{$rep->reparacion_id}</h3>
                <p><strong>Inicio:</strong> {$fecha_inicio}</p>
                <p><strong>Fin:</strong> {$fecha_final}</p>
                <p><strong>Trabajador ID:</strong> {$rep->trabajador_id}</p>
            </div>
        </div>
    ";
}

echo "</div>";
?>