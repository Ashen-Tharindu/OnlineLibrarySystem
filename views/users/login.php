<?php include 'views/templates/header.php'; ?>
<div class="form-container">
    <h2>🔑 Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="index.php?controller=user&action=login">
        <input type="email" name="email" placeholder="Email" required><br>
        
        <div style="position: relative;">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span id="togglePassword" style="position:absolute; right:10px; top:8px; cursor:pointer;">👁️</span>
        </div>
        <br>

        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="index.php?controller=user&action=register">Register here</a></p>
</div>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        togglePassword.textContent = type === 'password' ? '👁️' : '🙈'; // Change icon
    });
</script>

<?php include 'views/templates/footer.php'; ?>
