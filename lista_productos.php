<?php
    session_start(); 
    
    if (!isset($_SESSION['loggeado']) || $_SESSION['loggeado'] !== true) {
        // Si no está logeado, lo redirige a la página de inicio
        header("Location: index.php"); 
        exit;
    } 
   

    $titulo_pagina = "Productos";
     include_once('header.php');

?>
 <link rel="stylesheet" href="./css/productos.css">
    
    <form action="resumen.php" method="POST" id="carritoForm">
        <input type="hidden" name="carrito_data" id="carritoInput">
        
        <h2>Lista de Productos</h2>

<?php
    include_once('config_db.php');

    $sql = "SELECT aparato_id, tipo_aparato, nombre, marca, precio, estado_reacondicionado, imagen FROM aparato_electronico WHERE alquilado=True";
    //puntero, objeto resultado
    $resultado = $conn->query($sql);
    //guardamos los resultados en un array
    $arrayProductos = [];
            while($producto = $resultado->fetch_object()) {
                $arrayProductos[] = $producto; 
            }

    $resultado->close();
    echo "<div class='productos'>";

    foreach($arrayProductos as $producto){
        
        //convertimos los datos binarios en una imagen
        $contenido_binario = $producto->imagen; 
        $imagen_base64 = base64_encode($contenido_binario);
        $mime_type = 'image/webp'; 
        $data_uri = "data:{$mime_type};base64,{$imagen_base64}";

        //cramos cada producto
        echo "
            <div class='producto-item' 
                datos-id='{$producto->aparato_id}'
                datos-estado_reacondicionado='{$producto->estado_reacondicionado}'
                >
                <form method='POST' action='confirmar.php'>
                    <img src='$data_uri' alt='$producto->nombre'>
                    <label> {$producto->nombre} </label>
                    <label> €{$producto->precio} </label>
                    <label> {$producto->tipo_aparato} </label>
                    <label> {$producto->estado_reacondicionado} </label>
                    <label> {$producto->precio} </label>
                    <input type='text' hidden name='{$producto->aparato_id}' id='{$producto->aparato_id}'>
                    <button type='submit'>comprar</comprar>
                </form>
            </div>
        ";
    }
    $conn->close();
    echo "</div>";
?>

