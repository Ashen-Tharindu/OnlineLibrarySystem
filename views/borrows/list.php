<?php include 'views/templates/header.php'; ?>

<h2>📄 Borrow History & Fines</h2>

<div class="table-responsive shadow-sm rounded">
<table class="table table-striped table-hover align-middle">
    <thead class="table-primary">
        <tr>
            <th>Book</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Fine (₹)</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($records as $r): ?>
    <tr>
        <td><?= $r['title'] ?></td>
        <td><?= htmlspecialchars($r['borrow_date']) ?></td>
        <td><?= htmlspecialchars($r['return_date'] ?? '-') ?></td>
        <td>
            <?php 
                $status = strtolower($r['status']);
                if($status == 'borrowed') echo '<span class="badge bg-warning text-dark">Borrowed</span>';
                elseif($status == 'returned') echo '<span class="badge bg-success">Returned</span>';
                elseif($status == 'overdue') echo '<span class="badge bg-danger">Overdue</span>';
                else echo '<span class="badge bg-secondary">'.htmlspecialchars(ucfirst($status)).'</span>';
            ?>
        </td>
        <td style="color: <?= ($r['fine'] > 0) ? 'red' : 'green' ?>; font-weight: 600;">
            <?= ($r['fine'] > 0) ? number_format($r['fine'],2) : 'No Fine' ?>
        </td>
        <td>
            <?php if ($status == 'borrowed'): ?>
                <a href="index.php?controller=borrow&action=returnBook&id=<?= $r['id'] ?>" 
                   class="btn btn-sm btn-success"
                   onclick="return confirm('Return this book?')">Return</a>
            <?php else: ?> 
                <span class="text-success fw-bold">✔ Returned</span> 
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php include 'views/templates/footer.php'; ?>
