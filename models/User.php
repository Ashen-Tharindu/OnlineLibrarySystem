<?php
require_once 'config/database.php';

class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function register() {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name,email,password) VALUES (?,?,?)");
        return $stmt->execute([$this->name, $this->email, password_hash($this->password, PASSWORD_BCRYPT)]);
    }

    public function login() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE email=?");
        $stmt->execute([$this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($user && password_verify($this->password, $user['password'])) ? $user : false;
    }

    public function updatePassword($id, $newPass) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET password=? WHERE id=?");
        return $stmt->execute([password_hash($newPass, PASSWORD_BCRYPT), $id]);
    }
}
?>
