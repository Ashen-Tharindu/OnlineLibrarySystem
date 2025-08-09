<?php include 'views/templates/header.php'; ?>

<style>
  .profile-container {
    max-width: 480px;
    margin: 40px auto;
    background: #fefefe;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    padding: 30px 40px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  .profile-header {
    text-align: center;
    margin-bottom: 25px;
  }

  .profile-header h2 {
    font-weight: 700;
    font-size: 28px;
    color: #3b82f6; /* Blue */
  }

  .profile-info p {
    font-size: 16px;
    margin: 15px 0;
    color: #444;
  }

  .profile-info strong {
    color: #2563eb; /* Darker Blue */
    width: 100px;
    display: inline-block;
  }

  .btn-logout {
    display: inline-block;
    margin-top: 30px;
    background: #ef4444; /* Red */
    color: white;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 600;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .btn-logout:hover {
    background: #b91c1c; /* Dark Red */
  }

  /* Responsive */
  @media (max-width: 520px) {
    .profile-container {
      padding: 20px 25px;
      margin: 20px;
    }
    .profile-header h2 {
      font-size: 24px;
    }
    .profile-info p {
      font-size: 14px;
    }
    .btn-logout {
      padding: 10px 20px;
      font-size: 14px;
    }
  }
</style>

<div class="profile-container">
  <div class="profile-header">
    <h2>👤 User Profile</h2>
  </div>

  <div class="profile-info">
    <p><strong>Name:</strong> <?= htmlspecialchars($user['name']); ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']); ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars(ucfirst($user['role'])); ?></p>
  </div>

  <a href="index.php?controller=user&action=logout" class="btn-logout">Logout</a>
</div>

<?php include 'views/templates/footer.php'; ?>
