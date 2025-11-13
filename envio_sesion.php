<?php
require_once('config_db.php');
session_start();

if(isset($_POST['registro'])){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $direccion=$_POST['direccion'];

    /*es importante usar sentencias preparadas para tratar las inyecciones de sql como 
    datos puros y no como código sql
    */
    $stmt_check = $conn->prepare("SELECT email FROM usuario WHERE email = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();



    if($result_check -> num_rows>0){
        $_SESSION['errores_registro']='Email ya registrado';
        //permite que la sesion no muera cuando metas el error
        $_SESSION['active_form']='register';

    } else {
        $stmt_insert = $conn->prepare("INSERT INTO usuario (nombre, apellidos, email, password, direccion) VALUES (?, ?, ?, ?, ?)");
        $stmt_insert->bind_param("sssss", $nombre, $apellidos, $email, $password, $direccion);
        $stmt_insert->execute();
    }
    header("location:index.php");
    exit();

} if(isset($_POST['login'])){
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    //pedimos el usuario y la contraseña
    $stmt = $conn->prepare("SELECT usuario_id, password, nombre FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
   if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        $hashed_password = $usuario['password'];

        if(password_verify($password, $hashed_password)){
            $_SESSION['loggeado']= true;
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            header('Location:index.php');
        }
    } 
} 
?>