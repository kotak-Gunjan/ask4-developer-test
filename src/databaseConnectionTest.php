<?php

require_once 'C://Users/Gunjan/Downloads/ask4-developer-test/ask4-developer-test/src/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testDatabaseConnection()
    {
        // Replace these values with your actual database configuration
        $host = 'localhost';
        $username = 'root';
        $password = 'root';
        $database = 'ask4';

        // Attempt to connect to the database
        $conn = new mysqli($host, $username, $password, $database);

        // Check if connection was successful
        $this->assertInstanceOf(mysqli::class, $conn);
        $this->assertTrue($conn->connect_errno === 0, 'Failed to connect to MySQL: ' . $conn->connect_error);

        // Close the database connection
        $conn->close();
    }
}
