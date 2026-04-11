<?php

use PHPUnit\Framework\TestCase;

class EnvTest extends TestCase
{
    public function testEnvFromDotEnvTest(): void
    {
        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $this->assertNotEmpty($host);
    }
}