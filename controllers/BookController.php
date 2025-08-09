<?php
require_once 'models/Book.php';

class BookController {
    public function list() {
        $book = new Book();
        $books = $book->getAll();
        include 'views/books/list.php';
    }

    public function search() {
        $keyword = $_GET['q'] ?? '';
        $book = new Book();
        $results = $book->search($keyword);
        header('Content-Type: application/json');
        echo json_encode($results);
    }

    public function add() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['user']['role'] != 'admin') { header('Location: index.php'); exit; }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book = new Book();
            $book->add($_POST['title'], $_POST['author'], $_POST['category']);
            header('Location: index.php?controller=book&action=list');
        } else {
            include 'views/books/add.php';
        }
    }

    public function edit() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['user']['role'] != 'admin') { header('Location: index.php'); exit; }

        $book = new Book();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $book->edit($_POST['id'], $_POST['title'], $_POST['author'], $_POST['category']);
            header('Location: index.php?controller=book&action=list');
        } else {
            $bookId = $_GET['id'];
            $bookData = $book->getById($bookId);
            include 'views/books/edit.php';
        }
    }

    public function delete() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['user']['role'] != 'admin') { header('Location: index.php'); exit; }

        $book = new Book();
        $book->delete($_GET['id']);
        header('Location: index.php?controller=book&action=list');
    }
}
?>
