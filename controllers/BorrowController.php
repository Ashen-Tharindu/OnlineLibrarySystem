<?php
require_once 'models/BorrowRecord.php';
require_once 'models/Book.php';

class BorrowController {
    public function list() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=login");
            exit();
        }
        $borrow = new BorrowRecord();
        $records = $borrow->userBorrows($_SESSION['user']['id']);
        include 'views/borrows/list.php';
    }

    public function borrow() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $borrow = new BorrowRecord();
            $borrow->borrowBook($_SESSION['user']['id'], $_POST['book_id']);
            header('Location: index.php?controller=borrow&action=list');
            exit();
        } else {
            include 'views/borrows/borrow.php';
        }
    }

    public function returnBook() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=user&action=login");
            exit();
        }
        $borrow = new BorrowRecord();
        $borrow->returnBook($_GET['id']);
        header('Location: index.php?controller=borrow&action=list');
        exit();
    }
}
?>
