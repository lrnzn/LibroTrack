<?php if (!defined("LIBROTRACK")) { header("Location: /librotrack/public/index.php?controller=Auth&action=login"); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Borrow Book</title>
    <link rel="stylesheet" href="/librotrack/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/books.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/borrowers.css">
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
        <img src="/librotrack/public/assets/img/logo.gif" alt="LibroTrack" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge">Admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="/librotrack/public/index.php?controller=Dashboard&action=index">Dashboard</a></li>
        <li><a href="/librotrack/public/index.php?controller=Book&action=index">Books</a></li>
        <li><a href="/librotrack/public/index.php?controller=Borrower&action=index">Borrowers</a></li>
        <li><a href="/librotrack/public/index.php?controller=Transaction&action=index" class="active">Transactions</a></li>
        <li><a href="/librotrack/public/index.php?controller=Overdue&action=index">Overdue</a></li>
        <li><a href="/librotrack/public/index.php?controller=Report&action=index">Reports</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">👩‍💼</span>
        <span class="nav-username">Librarian</span>
        <a href="/librotrack/public/index.php?controller=Auth&action=logout" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>Borrow Book</h1>
            <p class="page-subtitle">Record a new borrowing transaction.</p>
        </div>
        <div class="view-toggle">
            <a href="/librotrack/public/index.php?controller=Transaction&action=index"      class="view-btn active">📤 Borrow</a>
            <a href="/librotrack/public/index.php?controller=Transaction&action=returnPage" class="view-btn">📥 Return</a>
            <a href="/librotrack/public/index.php?controller=Transaction&action=history"    class="view-btn">🕘 History</a>
        </div>
    </div>

    <div class="transaction-layout">

        <!-- Borrow Form -->
        <div class="card transaction-form">
            <div class="card-head"><h2>New Borrow Transaction</h2></div>
            <form action="/librotrack/public/index.php?controller=Transaction&action=borrow"
                  method="POST" id="borrow-form">
                <input type="hidden" name="studentID" id="input-studentID">
                <input type="hidden" name="bookID"    id="input-bookID">

                <!-- Student Select -->
                <div class="form-group">
                    <label>Select Student *</label>
                    <select id="student-select" onchange="onStudentChange(this)">
                        <option value="">-- Select a student --</option>
                        <?php foreach ($students as $s): ?>
                            <option value="<?= $s['studentID'] ?>"
                                data-name="<?= htmlspecialchars($s['fname'] . ' ' . $s['lname']) ?>"
                                data-number="<?= htmlspecialchars($s['studentNumber']) ?>"
                                data-course="<?= htmlspecialchars($s['course']) ?>"
                                data-borrows="<?= $s['active_borrows'] ?>">
                                <?= htmlspecialchars($s['lname'] . ', ' . $s['fname']) ?>
                                — <?= htmlspecialchars($s['studentNumber']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Student Preview -->
                <div class="info-preview" id="student-preview">
                    <div class="preview-icon">🎓</div>
                    <div class="preview-details">
                        <strong class="preview-name"></strong>
                        <span class="preview-meta"></span>
                        <span class="preview-status"></span>
                    </div>
                    <span class="badge preview-badge"></span>
                </div>

                <!-- Book Select -->
                <div class="form-group">
                    <label>Select Book *</label>
                    <select id="book-select" onchange="onBookChange(this)">
                        <option value="">-- Select a book --</option>
                        <?php foreach ($books as $b): ?>
                            <option value="<?= $b['bookID'] ?>"
                                data-title="<?= htmlspecialchars($b['title']) ?>"
                                data-author="<?= htmlspecialchars($b['author']) ?>"
                                data-genre="<?= htmlspecialchars($b['genre']) ?>"
                                data-available="<?= $b['available'] ?>"
                                data-copies="<?= $b['copies'] ?>">
                                <?= htmlspecialchars($b['title']) ?>
                                (<?= $b['available'] ?>/<?= $b['copies'] ?> available)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Book Preview -->
                <div class="info-preview" id="book-preview">
                    <div class="preview-icon">📖</div>
                    <div class="preview-details">
                        <strong class="preview-name"></strong>
                        <span class="preview-meta"></span>
                        <span class="preview-status"></span>
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
                <a href="/librotrack/public/index.php?controller=Transaction&action=history" class="card-link">View all →</a>
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

<script src="/librotrack/public/assets/js/borrow.js"></script>
</body>
</html>