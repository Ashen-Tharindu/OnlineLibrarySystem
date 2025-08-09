<?php
require_once 'config/database.php';

class Book {
    private $conn;
    private $table = 'books';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM $this->table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($keyword) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE title LIKE ? OR author LIKE ?");
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($title, $author, $category) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (title,author,category,available) VALUES (?,?,?,1)");
        return $stmt->execute([$title, $author, $category]);
    }

    public function edit($id, $title, $author, $category) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET title=?, author=?, category=? WHERE id=?");
        return $stmt->execute([$title, $author, $category, $id]);
    }

    public function countAll() {
    $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM $this->table");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
