<?php
$hostname='db';
$user='root';
$password='root';
$database='dale_otra_vida';

$conn = new mysqli($hostname,$user,$password,$database);

if($conn-> connect_error) die("error en la conexión ".connect_error);

?>