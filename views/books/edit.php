<?php include 'views/templates/header.php'; ?>
<h2>✏ Edit Book</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $bookData['id'] ?>">
    <input type="text" name="title" value="<?= $bookData['title'] ?>" required><br>
    <input type="text" name="author" value="<?= $bookData['author'] ?>" required><br>
    <input type="text" name="category" value="<?= $bookData['category'] ?>" required><br>
    <button type="submit">Update Book</button>
</form>
<?php include 'views/templates/footer.php'; ?>
