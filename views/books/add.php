<?php include 'views/templates/header.php'; ?>
<h2>➕ Add Book</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="text" name="author" placeholder="Author" required><br>
    <input type="text" name="category" placeholder="Category" required><br>
    <button type="submit">Add Book</button>
</form>
<?php include 'views/templates/footer.php'; ?>
