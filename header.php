<?php
$titulo;

function mostrarNombre(){
    if(isset($_SESSION['nombre'])){
        echo "Bienvenido ".$_SESSION['nombre'];
    }
}

function sesion(){
    if(isset($_SESSION['loggeado'])){
        echo "<li><a href='cerrar_sesion.php'>cerrar sesion</a></li>";
    } else {
        echo "<li><a href='iniciar_sesion.php'>iniciar sesion</a></li>";
    }

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$titulo?></title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<header class="cabecera">
        <div class="container">
            <div class="logo"><a href="./index.php"> Dale otra vida</a></div>
            <p><?mostrarNombre()?></p>
            <nav class="nav">
                <ul>
                    <li><a href="./lista_productos.php">Comprar</a></li>
                    <li><a href="#">Alquilar</a></li>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><?sesion()?></li>
                </ul>
            </nav>
        </div>
</header>
