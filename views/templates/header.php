<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<meta charset="UTF-8">
<title>Online Library System</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="sidebar">
    <h2>📚 Library</h2>
    <ul>
        <li><a href="index.php?controller=book&action=list">Books</a></li>
        <li><a href="index.php?controller=borrow&action=list">Borrowed</a></li>
        <li><a href="index.php?controller=user&action=profile">Profile</a></li>
        <li><a href="index.php?controller=user&action=logout">Logout</a></li>
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
            <li><a href="index.php?controller=admin&action=report">📊 Admin Report</a></li>
        <?php endif; ?>
    </ul>
</nav>
<main class="content">
