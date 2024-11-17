<?php

if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["id"]) and !empty($_POST["nombre"]) and !empty($_POST["correo"])) {

        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];

        $sql = $conexion->query("insert into usuarios(id,nombre,correo) values ($id,'$nombre','$correo')");
        if ($sql == 1) {
            echo '<div class="alert alert-success">Persona registrada correctamente</div>';
        } else {
          //  echo '<div class="alert alert-danger">Error al registrar</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Algun campo esta vacio</div>';
    }
}
?>