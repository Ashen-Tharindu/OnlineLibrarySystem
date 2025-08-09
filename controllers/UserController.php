<?php
require_once 'models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $loggedUser = $user->login();
            if ($loggedUser) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = $loggedUser;
                header("Location: index.php?controller=book&action=list");
                exit();
            } else {
                $error = "Invalid credentials";
                include 'views/users/login.php';
            }
        } else {
            include 'views/users/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            $user->register();
            header("Location: index.php?controller=user&action=login");
            exit();
        } else {
            include 'views/users/register.php';
        }
    }

    public function profile() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        header("Location: index.php?controller=user&action=login");
        exit();
    }
    $user = $_SESSION['user']; // Fetch logged in user data
    include 'views/users/profile.php';
}


    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header("Location: index.php?controller=user&action=login");
        exit();
    }
}
?>
