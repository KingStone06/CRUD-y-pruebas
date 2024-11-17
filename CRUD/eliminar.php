<?php

function eliminarRegistro($conexion, $id) {
    if ($id === null) {
        throw new InvalidArgumentException('ID es requerido');
    }

    $sql = $conexion->query("DELETE FROM usuarios WHERE id=$id");
    
    if ($sql) {
        return true; // Usuario eliminado exitosamente
    } else {
        return false; // No se pudo eliminar
    }
}
