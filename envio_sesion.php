<?php
require_once('config_db.php');
session_start();

if(isset($_POST['registro'])){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $direccion=$_POST['direccion'];

    $comprobarEmail=$conn -> query("SELECT email FROM usuario WHERE email ='$email'");
    if($comprobarEmail -> num_rows>0){
        $_SESSION['errores_registro']='Email ya registrado';
        //permite que la sesion no muera cuando metas el error
        $_SESSION['active_form']='register';

    } else {
        $conn->query("INSERT INTO usuario (nombre, apellidos, email, password, direccion) VALUES ('$nombre','$apellidos', '$email', '$password', '$direccion')");
    }
    header("location:index.php");
    exit();
} else{
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    
    $stmt = $conn->prepare("SELECT usuario_id, password FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if($resultado->numm_rows ===1){
        $usuario = $resultado->fetch_assoc();
        $hashed_password = $usuario['password'];

    }
}
?>