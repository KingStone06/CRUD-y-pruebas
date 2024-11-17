<?php
// tests/EditarRegistroTest.php

use PHPUnit\Framework\TestCase;

// Incluir el archivo que contiene la función editarRegistro
require_once __DIR__ . '/../CRUD/editarRegistro.php';



class EditarRegistroTest extends TestCase
{
    private $conexionMock;

    protected function setUp(): void
    {
        // Crear un mock de la conexión PDO
        $this->conexionMock = $this->createMock(PDO::class);
    }

    // Prueba de edición exitosa
    public function testEditarRegistroExitoso()
    {
        // Simular un PDOStatement para la consulta exitosa
        $pdoStatementMock = $this->createMock(PDOStatement::class);
        $this->conexionMock->method('query')
            ->willReturn($pdoStatementMock);

        // Llamar a la función editarRegistro
        $result = editarRegistro($this->conexionMock, 1, 'Nuevo Nombre', 'nuevo@correo.com');
        
        // Verificar que el mensaje de éxito sea el esperado
        $this->assertStringContainsString('Registro editado correctamente', $result);
    }

    // Prueba de edición con campos vacíos
    public function testEditarRegistroConCamposVacios()
    {
        // Llamar a la función editarRegistro con valores vacíos
        $result = editarRegistro($this->conexionMock, 1, '', '');
        
        // Verificar que el mensaje de advertencia sea el esperado
        $this->assertStringContainsString('Hay campos vacíos', $result);
    }

    // Prueba de fallo en la actualización
    public function testEditarRegistroFallido()
    {
        // Simular que la consulta devuelve false (fallo)
        $this->conexionMock->method('query')
            ->willReturn(false);

        // Llamar a la función editarRegistro
        $result = editarRegistro($this->conexionMock, 1, 'Nuevo Nombre', 'nuevo@correo.com');
        
        // Verificar que el mensaje de error sea el esperado
        $this->assertStringContainsString('Error al editar el registro', $result);
    }
}
