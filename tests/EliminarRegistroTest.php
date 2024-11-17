<?php

use PHPUnit\Framework\TestCase;

class EliminarRegistroTest extends TestCase {
    protected $conexion;

    // Configuración inicial: se ejecuta antes de cada prueba
    protected function setUp(): void {
        // Creamos un mock de la clase PDO para simular la conexión a la base de datos
        $this->conexion = $this->createMock(PDO::class);
    }

    // Test para eliminar registro exitoso
    public function testEliminarRegistroExitoso() {
        // Simulamos que el método query() devuelve un objeto PDOStatement (caso exitoso)
        $this->conexion->method('query')
                       ->willReturn($this->createMock(PDOStatement::class));

        // Requerimos el archivo con la función a probar
        require_once __DIR__ . '/../CRUD/eliminar.php';

        // Llamamos a la función eliminarRegistro con un ID válido
        $resultado = eliminarRegistro($this->conexion, 1);

        // Verificamos que el resultado sea true (registro eliminado exitosamente)
        $this->assertTrue($resultado);
    }

    // Test para eliminar registro fallido (cuando la consulta devuelve false)
    public function testEliminarRegistroFallido() {
        // Simulamos que el método query() devuelve false (caso fallido)
        $this->conexion->method('query')
                       ->willReturn(false);

        // Requerimos el archivo con la función a probar
        require_once __DIR__ . '/../CRUD/eliminar.php';

        // Llamamos a la función eliminarRegistro con un ID válido
        $resultado = eliminarRegistro($this->conexion, 1);

        // Verificamos que el resultado sea false (no se pudo eliminar)
        $this->assertFalse($resultado);
    }

    // Test para eliminar registro sin pasar el ID
    public function testEliminarRegistroSinId() {
        // Esperamos que se lance una excepción de tipo InvalidArgumentException
        $this->expectException(InvalidArgumentException::class);

        // Requerimos el archivo con la función a probar
        require_once __DIR__ . '/../CRUD/eliminar.php';

        // Llamamos a la función eliminarRegistro sin pasar el ID (null)
        eliminarRegistro($this->conexion, null); // Pasamos null como ID
    }
}

