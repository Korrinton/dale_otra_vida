<?php
$titulo_pagina = "Historial de Alquileres";
include_once('header.php');
?>
<link rel="stylesheet" href="./css/productos.css">

<h2>Historial de Alquileres</h2>

<?php
include_once('config_db.php');

$sql = "SELECT alquiler_id, usuario_id, telefono_id, fecha_inicio, fecha_final 
        FROM alquiler 
        ORDER BY fecha_inicio DESC";

$resultado = $conn->query($sql);
$arrayAlquileres = [];

while ($alquiler = $resultado->fetch_object()) {
    $arrayAlquileres[] = $alquiler; 
}

$resultado->close();
$conn->close();

echo "<div class='productos'>";

foreach ($arrayAlquileres as $alq) {
    $fecha_inicio = date("d/m/Y", strtotime($alq->fecha_inicio));
    $fecha_final = $alq->fecha_final ? date("d/m/Y", strtotime($alq->fecha_final)) : "En curso";

    echo "
        <div class='producto-item'>
            <div class='reparacion-info'>
                <h3>Alquiler #{$alq->alquiler_id}</h3>
                <p><strong>Usuario ID:</strong> {$alq->usuario_id}</p>
                <p><strong>Teléfono ID:</strong> {$alq->telefono_id}</p>
                <p><strong>Inicio:</strong> {$fecha_inicio}</p>
                <p><strong>Fin:</strong> {$fecha_final}</p>
            </div>
        </div>
    ";
}

echo "</div>";
?>