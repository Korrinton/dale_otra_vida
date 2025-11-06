<?php
session_start();
include_once("header.php");


$errors=[
    'login'-> $_SESSION['login_eror'] ?? '',
    'register'-> $_SESSION['register_error'] ?? ''
];

$activeForm=$_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error){
    return !empty($error)?"<p class='error-message'>$error</p>":'';
}
function isActiveForm($formName,$activeForm){
    return $formName ===$activeForm ?'active': '';
}
?>

<link rel="stylesheet" href="./css/iniciar_sesion.css">
<div class="container" >
    <form method="POST" action="envio_sesion.php" class='form-box <?= isActiveForm('login',$activeForm);?>' id="login-form">
        <legend class="titulo">Login</legend>
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" id="password" name="password"  placeholder="contaseña">
        <button type="submit" name="login">Login</button>
        <div>
            <p class="registro">¿No tiene cuenta?  <a href="#" onclick="showForm('register-form')">Cree una cuenta</a></p>
        </div>
        </form>
    
        <form method="POST" action="envio_sesion.php"  class='form-box <?= isActiveForm('registro',$activeForm);?>' id="register-form">
        <legend class="titulo">Registro</legend>
        <input type="text" id="nombre" name="nombre" placeholder="nombre">
        <input type="text" id="apellidos" name="apellidos" placeholder="apellidos">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" id="password" name="password"  placeholder="contaseña">
        <input type="password" id="password_repetir" name="password_repetir"  placeholder="repetir contaseña">
        <div id="error-password" class='error-message'>Las contraseñas no coinciden.</div>
        <button type="submit" name="register">register</button>
        <div>
            <p class="register">¿Tiene una cuenta? <a href="#" onclick="showForm('login-form')">Inicie sesion</a></p>
        </div>
</form>
</div>
<script src="./js/iniciar_sesion.js"></script>

<?php

require_once('footer.php');
?>