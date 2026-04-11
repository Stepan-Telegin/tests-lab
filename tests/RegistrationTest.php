<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../www/Registration.php';

class RegistrationTest extends TestCase
{
    private $pdoMock;
    private $registration;

    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);
        $this->registration = new Registration($this->pdoMock);
    }

    public function testAdd(): void
    {
        $stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO masterclass_registrations (name, birthdate, topic, materials, format) VALUES (?, ?, ?, ?, ?)")
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('execute')
            ->with(["Ivan", "2000-01-01", "Web", 1, "Online"]);

        $this->registration->add("Ivan", "2000-01-01", "Web", 1, "Online");

        $this->assertTrue(true);
    }

    public function testGetAll(): void
    {
        $expected = [
            ["id" => 1, "name" => "Ivan"]
        ];

        $stmtMock = $this->createMock(PDOStatement::class);

        $this->pdoMock->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM masterclass_registrations")
            ->willReturn($stmtMock);

        $stmtMock->expects($this->once())
            ->method('fetchAll')
            ->willReturn($expected);

        $result = $this->registration->getAll();

        $this->assertEquals($expected, $result);
    }
}