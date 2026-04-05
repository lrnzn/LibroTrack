<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Return Book</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/assets/css/books.css">
    <link rel="stylesheet" href="../../../public/assets/css/borrowers.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">
        <img src="../../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge">Admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="book_management.php">Books</a></li>
        <li><a href="borrowers.php">Borrowers</a></li>
        <li><a href="borrow.php" class="active">Transactions</a></li>
        <li><a href="overdue.php">Overdue</a></li>
        <li><a href="reports.php">Reports</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">👩‍💼</span>
        <span class="nav-username">Librarian</span>
        <a href="../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>Return Book</h1>
            <p class="page-subtitle">Process a book return transaction.</p>
        </div>
        <div class="view-toggle">
            <a href="borrow.php" class="view-btn">📤 Borrow</a>
            <a href="return.php" class="view-btn active">📥 Return</a>
            <a href="history.php" class="view-btn">🕘 History</a>
        </div>
    </div>

    <div class="transaction-layout">

        <!-- Return Form -->
        <div class="card transaction-form">
            <div class="card-head">
                <h2>Process Return</h2>
            </div>

            <form action="#" method="POST">

                <div class="form-group">
                    <label>Student Number</label>
                    <input type="text" id="student-search" placeholder="Enter student number (e.g. 2021-00123)" oninput="searchStudent()">
                </div>

                <!-- Student Preview -->
                <div class="info-preview" id="student-preview">
                    <div class="preview-icon">🎓</div>
                    <div class="preview-details">
                        <strong>Pedro Reyes</strong>
                        <span>2020-00789 &nbsp;|&nbsp; BSED</span>
                        <span class="preview-status">Active borrows: 1</span>
                    </div>
                    <span class="badge badge--overdue">Has Overdue</span>
                </div>

                <!-- Book Selection from active borrows -->
                <div class="form-group" id="book-select-group" style="display:none;">
                    <label>Select Book to Return</label>
                    <select id="book-select" onchange="checkOverdue()">
                        <option value="">-- Select borrowed book --</option>
                        <option value="overdue">Philippine History (Due: Apr 03 — OVERDUE)</option>
                    </select>
                </div>

                <!-- Overdue Warning -->
                <div class="overdue-warning" id="overdue-box" style="display:none;">
                    ⚠️ This book is <strong>5 days overdue</strong>. Penalty: <strong>₱25.00</strong> (₱5.00/day)
                </div>

                <div class="form-row" id="return-details" style="display:none;">
                    <div class="form-group">
                        <label>Return Date</label>
                        <input type="date" id="return-date" value="2025-04-04">
                    </div>
                    <div class="form-group">
                        <label>Penalty Amount</label>
                        <input type="text" value="₱25.00" readonly style="background:#FDECEA; color:#C0392B; font-weight:500;">
                    </div>
                </div>

                <div class="form-group" id="penalty-paid-group" style="display:none;">
                    <label>Penalty Status</label>
                    <select>
                        <option>Not yet paid</option>
                        <option>Paid</option>
                    </select>
                </div>

                <div class="form-group" id="notes-group" style="display:none;">
                    <label>Notes (optional)</label>
                    <textarea rows="2" placeholder="Any additional notes..."></textarea>
                </div>

                <button type="submit" class="btn-primary" id="confirm-btn" style="width:100%; margin-top:0.5rem; display:none;">✅ Confirm Return</button>
            </form>
        </div>

        <!-- Recent Returns -->
        <div class="card">
            <div class="card-head">
                <h2>Recent Returns</h2>
                <a href="history.php" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Borrower</th>
                        <th>Book</th>
                        <th>Returned</th>
                        <th>Penalty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Maria Santos</td>
                        <td>Calculus Vol. 2</td>
                        <td>Apr 02</td>
                        <td><span class="badge badge--returned">None</span></td>
                    </tr>
                    <tr>
                        <td>Carlo Mendoza</td>
                        <td>English for Academic</td>
                        <td>Apr 01</td>
                        <td><span class="badge badge--returned">None</span></td>
                    </tr>
                    <tr>
                        <td>Lea Gomez</td>
                        <td>Biology Essentials</td>
                        <td>Mar 31</td>
                        <td><span class="badge badge--overdue">₱15.00</span></td>
                    </tr>
                    <tr>
                        <td>Ryan Torres</td>
                        <td>Physics for Engineers</td>
                        <td>Mar 30</td>
                        <td><span class="badge badge--returned">None</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</main>

<script>
    function searchStudent() {
        const val = document.getElementById('student-search').value;
        const found = val.length > 3;
        document.getElementById('student-preview').style.display = found ? 'flex' : 'none';
        document.getElementById('book-select-group').style.display = found ? 'block' : 'none';
    }

    function checkOverdue() {
        const val = document.getElementById('book-select').value;
        const isOverdue = val === 'overdue';
        document.getElementById('overdue-box').style.display = isOverdue ? 'block' : 'none';
        document.getElementById('return-details').style.display = val ? 'grid' : 'none';
        document.getElementById('penalty-paid-group').style.display = isOverdue ? 'block' : 'none';
        document.getElementById('notes-group').style.display = val ? 'block' : 'none';
        document.getElementById('confirm-btn').style.display = val ? 'block' : 'none';
    }

    document.getElementById('student-preview').style.display = 'none';
    document.getElementById('book-select-group').style.display = 'none';
</script>

</body>
</html>