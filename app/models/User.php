<?php
require_once 'app/configs/Database.php';

class User
{
    private $db;
    private $table = 'users';

    public function __construct()
    {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }


    public function create($name, $email, $password)
    {
        try {
           $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO {$this->table} (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':name'     => $name,
                ':email'    => $email,
                ':password' => $hashedPassword
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Email already exists");
            }
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function read()
    {
        try {
            $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
?>