<?php
class Database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $database = 'api_users';

    private $connection;
    private static $instance = null;

    private function __construct()
    {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->database;
            $options = [
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ];
            $this->connection = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            die(json_encode([
                'success' => false,
                'message' => 'Database connection failed: ' . $e->getMessage()
            ]));
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    private function __clone() {}
    private function __wakeup() {}
}
?>
