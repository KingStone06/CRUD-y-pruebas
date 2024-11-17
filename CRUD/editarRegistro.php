<?php  
// editarRegistro.php
function editarRegistro($conexion, $id, $nombre, $correo) {
    if (!empty($nombre) && !empty($correo)) {
        // Preparar y ejecutar la consulta SQL
        $sql = $conexion->query("UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id=$id");

        // Verificar si la actualización fue exitosa
        if ($sql) {
            return "<div class='alert alert-success'>Registro editado correctamente</div>";
        } else {
            return "<div class='alert alert-danger'>Error al editar el registro</div>";
        }
    } else {
        return "<div class='alert alert-warning'>Hay campos vacíos</div>";
    }
}

?>