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

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
?>