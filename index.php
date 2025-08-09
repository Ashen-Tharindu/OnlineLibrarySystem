<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// AUTO CREATE ADMIN IF NOT EXISTS
require_once "config/database.php";
$db = new Database();
$conn = $db->connect();
$check = $conn->query("SELECT COUNT(*) FROM users WHERE role='admin'");
if ($check->fetchColumn() == 0) {
    $name = "Admin";
    $email = "admin@library.com";
    $password = password_hash("Admin@123", PASSWORD_BCRYPT);
    $role = "admin";
    $stmt = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
    $stmt->execute([$name, $email, $password, $role]);
    echo "<p style='color:green'>✅ Default admin created! Email: admin@library.com | Pass: Admin@123</p>";
}

// MVC Routing
$controller = $_GET['controller'] ?? 'user';
$action = $_GET['action'] ?? 'login';

require_once "controllers/" . ucfirst($controller) . "Controller.php";
$class = ucfirst($controller) . "Controller";
$obj = new $class();

if (method_exists($obj, $action)) {
    $obj->$action();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found - Action '$action' not found.";
    exit();
}
?>
