<?php
declare(strict_types=1);

final class DB
{
    private static ?DB $instance = null;
    private \mysqli $conn;
    private bool $isConnected = false;
    
    private function __construct()
    {
        try {
           $host = getenv('DB_HOST') ?: 'geeta-mysql-server.mysql.database.azure.com';
            $port = getenv('DB_PORT') ?: '3306';
            $name = getenv('DB_NAME') ?: 'geeta-db';
            $user = getenv('DB_USER') ?: 'geetaadmin';
            $pass = getenv('DB_PASS') ?: '{lcU2-g7beaQCPC';
            
            // For Azure Database - SSL is REQUIRED
            $this->conn = new \mysqli();
            
            // Set SSL options - this is crucial for Azure
            $this->conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
            
            // Connect with SSL flag - MYSQLI_CLIENT_SSL is essential
            $connected = $this->conn->real_connect(
                $host, 
                $user, 
                $pass, 
                $name, 
                (int)$port,
                NULL,
                MYSQLI_CLIENT_SSL  // This flag forces SSL connection
            );
            
            if (!$connected || $this->conn->connect_error) {
                throw new \RuntimeException('Database connection failed: ' . $this->conn->connect_error);
            }
            
            $this->isConnected = true;
            
            // Verify SSL is actually being used
            $result = $this->conn->query("SHOW STATUS LIKE 'Ssl_cipher'");
            if ($result && $row = $result->fetch_assoc()) {
                if (empty($row['Value'])) {
                    throw new \RuntimeException('SSL connection is required but not established');
                }
            }
            
            // Set charset
            $charset = getenv('DB_CHARSET') ?: 'utf8mb4';
            if (!$this->conn->set_charset($charset)) {
                throw new \RuntimeException('Failed to set charset: ' . $this->conn->error);
            }
            
            // Set timezone
            $this->conn->query("SET time_zone = '+00:00'");
            
        } catch (\Exception $e) {
            $this->isConnected = false;
            throw $e;
        }
    }
    
    public static function getInstance(): DB
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    public function getConnection(): \mysqli
    {
        if (!$this->isConnected) {
            throw new \RuntimeException('Database is not connected');
        }
        return $this->conn;
    }
    
    public function isConnected(): bool
    {
        return $this->isConnected;
    }
    
    public function testConnection(): bool
    {
        if (!$this->isConnected) {
            return false;
        }
        return $this->conn->ping();
    }
}
