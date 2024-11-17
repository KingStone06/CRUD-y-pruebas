<?php

use PHPUnit\Framework\TestCase;
use App\Database;

class DatabaseTest extends TestCase {
    private $db;

    protected function setUp(): void {
        $this->db = new Database("localhost", "root", "12345678", "prueba");
    }

    public function testConnectionIsSuccessful() {
        $connection = $this->db->getConnection();
        $this->assertNotNull($connection, "La conexión no debería ser nula.");
    }

    public function testConnectionThrowsExceptionForInvalidCredentials() {
        $this->expectException(Exception::class);
        new Database("localhost", "invalid_user", "wrong_password", "prueba");
    }
}
