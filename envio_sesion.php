<?php
session_start();
require_once('config_db.php');

/* ========== REGISTRO ========== */
if (isset($_POST['registro'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $direccion = $_POST['direccion'];

    $stmt_check = $conn->prepare("SELECT email FROM usuario WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $_SESSION['errores_registro'] = 'Email ya registrado';
        $_SESSION['active_form'] = 'registro';
        header("Location: iniciar_sesion.php");
        exit();
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO usuario (nombre, apellidos, email, password, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssss", $nombre, $apellidos, $email, $password, $direccion);
        $stmt_insert->execute();
        header("Location: index.php");
        exit();
    }
}

/* ========== LOGIN ========== */
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['errores_sesion'] = 'Por favor, rellene todos los campos.';
        $_SESSION['active_form'] = 'login';
        header("Location: iniciar_sesion.php");
        exit();
    }

    $stmt = $conn->prepare("SELECT usuario_id, password, nombre FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $hashed_password = $usuario['password'];

        if (password_verify($password, $hashed_password)) {
            $_SESSION['loggeado'] = true;
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            header("Location: index.php");
            exit();
        }
    }

    $_SESSION['errores_sesion'] = 'Email o contraseña incorrectos.';
    $_SESSION['active_form'] = 'login';
    header("Location: iniciar_sesion.php");
    exit();
}
?>