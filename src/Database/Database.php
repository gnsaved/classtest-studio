<?php

namespace ClassTest\Database;

use PDO;
use PDOException;

class Database {
    private static $instance = null;
    private $connection;
    private $config;
    
    private function __construct() {
        $this->config = require __DIR__ . '/../../config/config.php';
        $this->connect();
    }
    
    private function connect() {
        $dbConfig = $this->config['database'];
        
        try {
            if ($dbConfig['driver'] === 'sqlite') {
                $dbPath = $dbConfig['sqlite']['path'];
                $dir = dirname($dbPath);
                
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
                
                $this->connection = new PDO("sqlite:$dbPath");
            } else {
                $mysql = $dbConfig['mysql'];
                $dsn = sprintf(
                    "mysql:host=%s;port=%d;dbname=%s;charset=%s",
                    $mysql['host'],
                    $mysql['port'],
                    $mysql['database'],
                    $mysql['charset']
                );
                
                $this->connection = new PDO(
                    $dsn,
                    $mysql['username'],
                    $mysql['password']
                );
            }
            
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    public function query($sql, $params = []) {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function fetchOne($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    public function execute($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
    
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }
    
    public function commit() {
        return $this->connection->commit();
    }
    
    public function rollback() {
        return $this->connection->rollback();
    }
}
