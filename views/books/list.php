<?php include 'views/templates/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📚 Book List</h2>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <a href="index.php?controller=book&action=add" class="btn btn-success">
            <i class="bi bi-plus-lg"></i> Add Book
        </a>
    <?php endif; ?>
</div>

<div class="mb-3">
    <input type="text" id="searchBox" class="form-control" placeholder="🔍 Search books...">
</div>

<div id="bookResults" class="table-responsive shadow-sm rounded">
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>📖 Title</th>
                <th>✍ Author</th>
                <th>🏷 Category</th>
                <th>📦 Status</th>
                <th class="text-center">⚙ Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($books as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['title']) ?></td>
                    <td><?= htmlspecialchars($b['author']) ?></td>
                    <td><?= htmlspecialchars($b['category']) ?></td>
                    <td>
                        <span class="badge <?= $b['available'] ? 'bg-success' : 'bg-danger' ?>">
                            <?= $b['available'] ? 'Available' : 'Borrowed' ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <a href="index.php?controller=book&action=edit&id=<?= $b['id'] ?>" class="btn btn-warning btn-sm">
                                ✏ Edit
                            </a>
                            <a href="index.php?controller=book&action=delete&id=<?= $b['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete book?')">
                                🗑 Delete
                            </a>
                        <?php else: ?>
                            <?php if ($b['available']): ?>
                                <form method="POST" action="index.php?controller=borrow&action=borrow" class="d-inline">
                                    <input type="hidden" name="book_id" value="<?= $b['id'] ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Borrow</button>
                                </form>
                            <?php else: ?>
                                <span class="text-muted">Unavailable</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'views/templates/footer.php'; ?>
