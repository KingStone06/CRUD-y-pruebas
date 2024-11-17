<?php

use PHPUnit\Framework\TestCase;

// Incluir el archivo Usuario.php desde el directorio src
require_once __DIR__ . '/../CRUD/Usuario.php';  // Ajustar la ruta

class UsuarioTest extends TestCase
{
    private $conexionMock;
    private $pdoStatementMock;

    protected function setUp(): void
    {
        // Crear un mock para la conexión de la base de datos (PDO)
        $this->conexionMock = $this->createMock(PDO::class);

        // Crear un mock para PDOStatement
        $this->pdoStatementMock = $this->createMock(PDOStatement::class);
    }

    public function testRegistrarUsuarioExitoso()
    {
        // Configurar el mock de la consulta para que devuelva un objeto PDOStatement
        $this->conexionMock->method('query')->willReturn($this->pdoStatementMock);

        // Simulamos que la consulta fue exitosa
        $this->pdoStatementMock->method('rowCount')->willReturn(1);  // 1 fila afectada

        $usuario = new Usuario($this->conexionMock);
        $resultado = $usuario->registrar(1, 'Juan Perez', 'juan@example.com');

        // Verificar que el mensaje de éxito sea el esperado
        $this->assertEquals('<div class="alert alert-success">Persona registrada correctamente</div>', $resultado);
    }

    public function testRegistrarUsuarioConCamposVacios()
    {
        // Configurar el mock de la consulta para que devuelva un objeto PDOStatement
        $this->conexionMock->method('query')->willReturn($this->pdoStatementMock);

        // Simulamos que la consulta no afectó filas, ya que los campos están vacíos
        $this->pdoStatementMock->method('rowCount')->willReturn(0);  // 0 filas afectadas

        $usuario = new Usuario($this->conexionMock);
        $resultado = $usuario->registrar('', '', '');

        // Verificar que el mensaje de advertencia sea el esperado
        $this->assertEquals('<div class="alert alert-warning">Algún campo está vacío</div>', $resultado);
    }

    public function testRegistrarUsuarioFallido()
    {
        // Configurar el mock de la consulta para que devuelva un objeto PDOStatement
        $this->conexionMock->method('query')->willReturn($this->pdoStatementMock);

        // Simulamos que la consulta falló
        $this->pdoStatementMock->method('rowCount')->willReturn(0);  // 0 filas afectadas

        $usuario = new Usuario($this->conexionMock);
        $resultado = $usuario->registrar(1, 'Juan Perez', 'juan@example.com');

        // Verificar que el mensaje de error sea el esperado
        $this->assertEquals('<div class="alert alert-danger">Error al registrar</div>', $resultado);
    }
}
