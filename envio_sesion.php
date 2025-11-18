<?php
session_start();
require_once('config_db.php');
require_once 'db_conexion.php'; 
require_once 'src/Usuario.php';
require_once 'src/accesso_a_datos.php';

/* ========== REGISTRO ========== */
if (isset($_POST['registro'])) {
   
    $depositar_usuario= new depositarUsuario($conn);
    $email = $_POST['email'];

    if ($depositar_usuario->existeEmail($email)) {
        $_SESSION['errores_registro'] = 'Email ya registrado';
        $_SESSION['active_form'] = 'registro';
        header("Location: iniciar_sesion.php");
        exit();
    } else {
       $nuevoUsuario = new Usuario(
            $_POST['nombre'],
            $_POST['apellidos'],
            $email,
            $_POST['password'],
            $_POST['direccion']);
        
        $depositar_usuario->guardar($nuevoUsuario);       
        header("Location: index.php");
        exit();
    }
    
}
/* ========== LOGIN ========== */
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $ver_usuario= new repositarioUsuario($conn);

    if (empty($email) || empty($password)) {
        $_SESSION['errores_sesion'] = 'Por favor, rellene todos los campos.';
        $_SESSION['active_form'] = 'login';
        header("Location: iniciar_sesion.php");
        exit();
    }

    if ($ver_usuario->existeEmail($email)) {
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