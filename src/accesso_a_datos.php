<?php

class depositarUsuario {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function existeEmail($email) {
        $stmt_check = $this->conn->prepare("SELECT email FROM usuario WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        return $result_check->num_rows > 0;
    }

    
    public function guardar(Usuario $usuario) {
        $stmt_insert = $this->conn->prepare(
            "INSERT INTO usuario (nombre, apellidos, email, password, direccion) VALUES (?, ?, ?, ?, ?)"
        );
        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword(); // Obtenemos el hash
        $direccion = $usuario->getDireccion();

        $stmt_insert->bind_param("sssss", $nombre, $apellidos, $email, $password, $direccion);
        return $stmt_insert->execute();
    }
}
?>