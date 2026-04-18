<?php
$recentBorrows = $recentBorrows ?? [];
$flash         = $flash         ?? '';
$flash_type    = $flash_type    ?? 'success';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Borrow Book</title>
    <link rel="stylesheet" href="/LibroTrack/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/LibroTrack/public/assets/css/books.css">
    <link rel="stylesheet" href="/LibroTrack/public/assets/css/borrowers.css">
</head>
<body>

<?php if (!empty($flash)): ?>
<div class="toast toast--<?= htmlspecialchars($flash_type) ?>">
    <?= $flash_type === 'success' ? '✅' : '❌' ?>
    <?= htmlspecialchars($flash) ?>
</div>
<?php endif; ?>

<nav class="navbar">
    <div class="nav-brand">
        <img src="/LibroTrack/public/assets/img/logo.gif" alt="LibroTrack" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge">Admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="/LibroTrack/public/index.php?controller=Dashboard&action=index">Dashboard</a></li>
        <li><a href="/LibroTrack/public/index.php?controller=Book&action=index">Books</a></li>
        <li><a href="/LibroTrack/public/index.php?controller=Borrower&action=index">Borrowers</a></li>
        <li><a href="/LibroTrack/public/index.php?controller=Transaction&action=index" class="active">Transactions</a></li>
        <li><a href="/LibroTrack/public/index.php?controller=Overdue&action=index">Overdue</a></li>
        <li><a href="/LibroTrack/public/index.php?controller=Report&action=index">Reports</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">👩‍💼</span>
        <span class="nav-username">Librarian</span>
        <a href="/LibroTrack/public/index.php?controller=Auth&action=logout" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>Borrow Book</h1>
            <p class="page-subtitle">Record a new borrowing transaction.</p>
        </div>
        <div class="view-toggle">
            <a href="/LibroTrack/public/index.php?controller=Transaction&action=index"      class="view-btn active">📤 Borrow</a>
            <a href="/LibroTrack/public/index.php?controller=Transaction&action=returnPage" class="view-btn">📥 Return</a>
            <a href="/LibroTrack/public/index.php?controller=Transaction&action=history"    class="view-btn">🕘 History</a>
        </div>
    </div>

    <div class="transaction-layout">

        <!-- Borrow Form -->
        <div class="card transaction-form">
            <div class="card-head"><h2>New Borrow Transaction</h2></div>
            <form action="/LibroTrack/public/index.php?controller=Transaction&action=borrow"
                  method="POST" id="borrow-form">
                <input type="hidden" name="studentID" id="input-studentID">
                <input type="hidden" name="bookID"    id="input-bookID">

                <div class="form-group">
                    <label>Student Number</label>
                    <input type="text" id="student-search" placeholder="Enter student number (e.g. 2021-00123)" autocomplete="off">
                </div>

                <div class="info-preview" id="student-preview">
                    <div class="preview-icon">🎓</div>
                    <div class="preview-details">
                        <strong class="preview-name"></strong>
                        <span class="preview-meta"></span>
                        <span class="preview-status preview-status"></span>
                    </div>
                    <span class="badge preview-badge"></span>
                </div>

                <div class="form-group">
                    <label>Book ISBN or Title</label>
                    <input type="text" id="book-search" placeholder="Enter ISBN or search book title" autocomplete="off">
                </div>

                <div class="info-preview" id="book-preview">
                    <div class="preview-icon">📖</div>
                    <div class="preview-details">
                        <strong class="preview-name"></strong>
                        <span class="preview-meta"></span>
                        <span class="preview-status preview-status"></span>
                    </div>
                    <span class="badge preview-badge"></span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Borrow Date *</label>
                        <input type="date" name="borrowDate" id="borrow-date" required>
                    </div>
                    <div class="form-group">
                        <label>Due Date *</label>
                        <input type="date" name="dueDate" id="due-date" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary" style="width:100%;margin-top:0.5rem;">
                    ✅ Confirm Borrow
                </button>
            </form>
        </div>

        <!-- Recent Borrows -->
        <div class="card">
            <div class="card-head">
                <h2>Recent Borrows</h2>
                <a href="/LibroTrack/public/index.php?controller=Transaction&action=history" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr><th>Borrower</th><th>Book</th><th>Due Date</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <?php if (empty($recentBorrows)): ?>
                        <tr><td colspan="4" style="text-align:center;color:var(--text-muted);">No active borrows yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recentBorrows as $r):
                            $isOverdue  = strtotime($r['dueDate']) < time();
                            $badgeClass = $isOverdue ? 'badge--overdue' : 'badge--borrowed';
                            $label      = $isOverdue ? 'Overdue' : 'Borrowed';
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($r['studentName']) ?></td>
                            <td><?= htmlspecialchars($r['bookTitle']) ?></td>
                            <td><?= date('M d', strtotime($r['dueDate'])) ?></td>
                            <td><span class="badge <?= $badgeClass ?>"><?= $label ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<script src="/LibroTrack/public/assets/js/borrow.js"></script>
</body>
</html>