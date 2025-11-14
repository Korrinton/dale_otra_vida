<?php
session_start();
require_once 'config_db.php';

if (!isset($_SESSION['user_id'])) {
    die('Error de autenticación');
}

if (isset($_POST['publicar_alquiler'])) {
    $tipo_aparato = $_POST['tipo_aparato'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'] ?? '';
    $precio = $_POST['precio'];
    $estado = $_POST['estado_reacondicionado'];
    $descripcion = $_POST['descripcion'] ?? '';
    $id_usuario = $_POST['id_usuario'];
    }

    $sql = "INSERT INTO producto_electronico 
            (tipo_aparato, marca, precio, estado_reacondicionado, descripcion, foto, alquilado, id_usuario) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$tipo_aparato, $marca, $modelo, $precio, $estado, $descripcion, $foto_nombre, $id_usuario]);

    $_SESSION['mensaje_exito'] = '¡Producto puesto en alquiler correctamente!';
    header('Location: mis_productos.php');
    exit;

?>