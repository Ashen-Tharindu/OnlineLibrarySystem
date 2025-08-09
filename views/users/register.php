<?php include 'views/templates/header.php'; ?>
<div class="form-container">
    <h2>📝 Register</h2>
    <form method="POST" action="index.php?controller=user&action=register">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php?controller=user&action=login">Login here</a></p>
</div>
<?php include 'views/templates/footer.php'; ?>
