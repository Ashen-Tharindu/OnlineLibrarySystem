<?php
require_once 'config/database.php';

class BorrowRecord {
    private $conn;
    private $table = 'borrow_records';

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function borrowBook($user_id, $book_id) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (user_id, book_id, borrow_date) VALUES (?,?,CURDATE())");
        return $stmt->execute([$user_id, $book_id]);
    }

    public function returnBook($id) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET return_date=CURDATE(), status='returned' WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function userBorrows($user_id) {
        $stmt = $this->conn->prepare("
            SELECT br.*, b.title, 
            CASE 
                WHEN br.status='borrowed' AND DATEDIFF(CURDATE(), br.borrow_date) > 14 THEN (DATEDIFF(CURDATE(), br.borrow_date)-14)*10
                WHEN br.status='returned' AND DATEDIFF(br.return_date, br.borrow_date) > 14 THEN (DATEDIFF(br.return_date, br.borrow_date)-14)*10
                ELSE 0
            END as fine
            FROM $this->table br 
            JOIN books b ON br.book_id=b.id 
            WHERE br.user_id=? ORDER BY br.borrow_date DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countBorrowed() {
    $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM $this->table WHERE status='borrowed'");
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countPendingReturns() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total FROM $this->table WHERE status='borrowed'");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function calculateTotalFines() {
        $stmt = $this->conn->query("
            SELECT SUM(
                CASE 
                    WHEN status='returned' AND DATEDIFF(return_date, borrow_date) > 14 
                        THEN (DATEDIFF(return_date, borrow_date)-14)*10
                    WHEN status='borrowed' AND DATEDIFF(CURDATE(), borrow_date) > 14 
                        THEN (DATEDIFF(CURDATE(), borrow_date)-14)*10
                    ELSE 0
                END
            ) AS total_fine 
            FROM $this->table
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_fine'] ?? 0;
    }

    public function allBorrowRecords() {
        $stmt = $this->conn->query("
            SELECT br.*, b.title, u.name,
            CASE 
                WHEN br.status='returned' AND DATEDIFF(return_date, borrow_date) > 14 
                    THEN (DATEDIFF(return_date, borrow_date)-14)*10
                WHEN br.status='borrowed' AND DATEDIFF(CURDATE(), borrow_date) > 14 
                    THEN (DATEDIFF(CURDATE(), borrow_date)-14)*10
                ELSE 0
            END AS fine
            FROM $this->table br 
            JOIN books b ON br.book_id=b.id
            JOIN users u ON br.user_id=u.id
            ORDER BY br.borrow_date DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
