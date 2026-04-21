<?php
$recentReturns  = $recentReturns  ?? [];
$activeStudents = $activeStudents ?? [];
$flash          = $flash          ?? '';
$flash_type     = $flash_type     ?? 'success';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Return Book</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
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
            <h1>Return Book</h1>
            <p class="page-subtitle">Process a book return transaction.</p>
        </div>
        <div class="view-toggle">
            <a href="/librotrack/public/index.php?controller=Transaction&action=index"      class="view-btn">📤 Borrow</a>
            <a href="/librotrack/public/index.php?controller=Transaction&action=returnPage" class="view-btn active">📥 Return</a>
            <a href="/librotrack/public/index.php?controller=Transaction&action=history"    class="view-btn">🕘 History</a>
        </div>
    </div>

    <div class="transaction-layout">

        <!-- Return Form -->
        <div class="card transaction-form">
            <div class="card-head"><h2>Process Return</h2></div>

            <?php if (empty($activeStudents)): ?>
                <div style="text-align:center;padding:2rem;color:var(--text-muted);">
                    <div style="font-size:2.5rem;margin-bottom:0.75rem;">📭</div>
                    <p>No students currently have active borrows.</p>
                </div>
            <?php else: ?>
            <form action="/librotrack/public/index.php?controller=Transaction&action=processReturn"
                  method="POST">
                <input type="hidden" name="transactionID" id="input-transactionID">
                <input type="hidden" name="daysOverdue"   id="input-daysOverdue" value="0">

                <!-- Student Select -->
                <div class="form-group">
                    <label>Select Student *</label>
                    <select id="student-select" onchange="onStudentChange(this)">
                        <option value="">-- Select a student --</option>
                        <?php foreach ($activeStudents as $s): ?>
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

                <!-- Book Select (populated via JS after student is chosen) -->
                <div class="form-group" id="book-select-group">
                    <label>Select Book to Return *</label>
                    <select id="book-select" onchange="onBookChange(this)">
                        <option value="">-- Select student first --</option>
                    </select>
                </div>

                <!-- Overdue Warning -->
                <div class="overdue-warning" id="overdue-box">
                    ⚠️ This book is <strong id="overdue-days"></strong> days overdue.
                    Penalty: <strong id="overdue-penalty"></strong> (₱5.00/day)
                </div>

                <!-- Return Details -->
                <div class="form-row" id="return-details">
                    <div class="form-group">
                        <label>Return Date *</label>
                        <input type="date" name="returnDate" id="return-date" required>
                    </div>
                    <div class="form-group">
                        <label>Penalty Amount</label>
                        <input type="text" id="penalty-amount-display" readonly
                               style="background:#FDECEA;color:#C0392B;font-weight:500;">
                    </div>
                </div>

                <div class="form-group" id="penalty-paid-group">
                    <label>Penalty Status</label>
                    <select name="penalty_paid">
                        <option value="0">Not yet paid</option>
                        <option value="1">Paid</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary" id="confirm-btn"
                        style="width:100%;margin-top:0.5rem;">
                    ✅ Confirm Return
                </button>
            </form>
            <?php endif; ?>
        </div>

        <!-- Recent Returns -->
        <div class="card">
            <div class="card-head">
                <h2>Recent Returns</h2>
                <a href="/librotrack/public/index.php?controller=Transaction&action=history" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr><th>Borrower</th><th>Book</th><th>Returned</th><th>Penalty</th></tr>
                </thead>
                <tbody>
                    <?php if (empty($recentReturns)): ?>
                        <tr><td colspan="4" style="text-align:center;color:var(--text-muted);">No returns yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recentReturns as $r): ?>
                        <tr>
                            <td><?= htmlspecialchars($r['studentName']) ?></td>
                            <td><?= htmlspecialchars($r['bookTitle']) ?></td>
                            <td><?= date('M d', strtotime($r['returnDate'])) ?></td>
                            <td>
                                <?php if ($r['penaltyAmount']): ?>
                                    <span class="badge badge--overdue">₱<?= number_format($r['penaltyAmount'], 2) ?></span>
                                <?php else: ?>
                                    <span class="badge badge--returned">None</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</main>

<script src="/librotrack/public/assets/js/return.js"></script>
</body>
</html>