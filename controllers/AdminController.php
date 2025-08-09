<?php
require_once 'models/Book.php';
require_once 'models/BorrowRecord.php';
require_once 'models/User.php';

class AdminController {
    public function report() {
        // Prevent duplicate session_start() warnings
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Check admin access
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header("Location: index.php");
            exit;
        }

        $book = new Book();
        $borrow = new BorrowRecord();

        $report = [
            'total_books'      => $book->countAll(),
            'borrowed_books'   => $borrow->countBorrowed(),
            'pending_returns'  => $borrow->countPendingReturns(),
            'total_fines'      => $borrow->calculateTotalFines(),
            'borrow_details'   => $borrow->allBorrowRecords()
        ];

        include 'views/admin/report.php';
    }
}
?>
