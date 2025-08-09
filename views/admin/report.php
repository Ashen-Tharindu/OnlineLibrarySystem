<?php include 'views/templates/header.php'; ?>
<h2>📊 Admin Reports</h2>

<div class="report-cards">
    <div class="card">
        <h3>Total Books</h3>
        <p><?= $report['total_books'] ?></p>
    </div>
    <div class="card">
        <h3>Borrowed Books</h3>
        <p><?= $report['borrowed_books'] ?></p>
    </div>
    <div class="card">
        <h3>Pending Returns</h3>
        <p><?= $report['pending_returns'] ?></p>
    </div>
    <div class="card">
        <h3>Collected Fines (₹)</h3>
        <p><?= $report['total_fines'] ?></p>
    </div>
</div>

<h3>📄 Borrowed Books Details</h3>
<table>
    <tr>
        <th>User</th>
        <th>Book</th>
        <th>Borrow Date</th>
        <th>Status</th>
        <th>Fine (₹)</th>
    </tr>
    <?php foreach($report['borrow_details'] as $r): ?>
    <tr>
        <td><?= $r['name'] ?></td>
        <td><?= $r['title'] ?></td>
        <td><?= $r['borrow_date'] ?></td>
        <td><?= ucfirst($r['status']) ?></td>
        <td style="color:<?= $r['fine'] > 0 ? 'red' : 'green' ?>;">
            <?= $r['fine'] > 0 ? $r['fine'] : 'No Fine' ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'views/templates/footer.php'; ?>
