<?php
require_once('config_db.php');

if(isset($_POST['registro'])){
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $email=$_POST['email'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $direccion=$_POST['role'];

    $comprobarEmail=$conn -> query("SELECT email FROM users WHERE email ='$email'");
    if($comprobarEmail -> num_rows>0){
        $_SESSION['errores_registro']='Email ya registrado';
        //permite que la sesion no muera cuando metas el error
        $_SESSION['active_form']='register';

    } else {
        $conn->query("INSERT INTO users (nombre, apellidos, email, password, role) VALUES ('$nombre','$apellidos', '$email', '$password', '$direccion')");
    }
    header("location:index.php");
    exit();
}

?>