<?php
class Usuario {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function registrar($id, $nombre, $correo) {
        if (empty($id) || empty($nombre) || empty($correo)) {
            return '<div class="alert alert-warning">Algún campo está vacío</div>';
        }

        $sql = $this->conexion->query("INSERT INTO usuarios(id, nombre, correo) VALUES ($id, '$nombre', '$correo')");

        if ($sql == 1) {
            return '<div class="alert alert-success">Persona registrada correctamente</div>';
        } else {
            return '<div class="alert alert-danger">Error al registrar</div>';
        }
    }
}
