<?php

use PHPUnit\Framework\TestCase;

class LecturaUsuariosTest extends TestCase
{
    protected $conexion;

    protected function setUp(): void
    {
        // Creamos un mock de la conexión PDO
        $this->conexion = $this->createMock(PDO::class);
    }

    public function testLeerUsuariosExitoso()
    {
        // Datos de prueba que simularemos que devuelve la base de datos
        $datosPrueba = [
            ['id' => 1, 'nombre' => 'Juan', 'correo' => 'juan@example.com'],
            ['id' => 2, 'nombre' => 'Maria', 'correo' => 'maria@example.com'],
        ];

        // Creamos un mock de PDOStatement
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')
             ->willReturnOnConsecutiveCalls(
                 (object) $datosPrueba[0],  // Primer usuario
                 (object) $datosPrueba[1],  // Segundo usuario
                 false                       // No hay más usuarios
             );

        // Configuramos el mock de la conexión para que query devuelva el mock de PDOStatement
        $this->conexion->method('query')
                       ->willReturn($stmt);

        // Llamada a la función que obtiene los usuarios
        $usuarios = [];
        $sql = $this->conexion->query("SELECT * FROM usuarios");
        while ($usuario = $sql->fetch()) {
            $usuarios[] = $usuario;
        }

        // Verificación de los resultados
        $this->assertCount(2, $usuarios);  // Debería haber 2 usuarios
        $this->assertEquals('Juan', $usuarios[0]->nombre);  // El nombre del primer usuario debería ser 'Juan'
        $this->assertEquals('Maria', $usuarios[1]->nombre);  // El nombre del segundo usuario debería ser 'Maria'
    }

    public function testLeerUsuariosSinResultados()
    {
        // Simulamos que no hay usuarios
        $stmt = $this->createMock(PDOStatement::class);
        $stmt->method('fetch')
             ->willReturn(false); // No devuelve usuarios

        $this->conexion->method('query')
                       ->willReturn($stmt);

        $usuarios = [];
        $sql = $this->conexion->query("SELECT * FROM usuarios");
        while ($usuario = $sql->fetch()) {
            $usuarios[] = $usuario;
        }

        // Verificación de que no se obtuvieron usuarios
        $this->assertCount(0, $usuarios);  // No debe haber usuarios
    }
}

