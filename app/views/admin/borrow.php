<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Borrow Book</title>
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
        <<a href="../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>Borrow Book</h1>
            <p class="page-subtitle">Record a new borrowing transaction.</p>
        </div>
        <!-- Tab Switch -->
        <div class="view-toggle">
            <a href="borrow.php" class="view-btn active">📤 Borrow</a>
            <a href="return.php" class="view-btn">📥 Return</a>
            <a href="history.php" class="view-btn">🕘 History</a>
        </div>
    </div>

    <div class="transaction-layout">

        <!-- Borrow Form -->
        <div class="card transaction-form">
            <div class="card-head">
                <h2>New Borrow Transaction</h2>
            </div>

            <form action="#" method="POST">

                <div class="form-group">
                    <label>Student Number</label>
                    <div class="input-search-wrap">
                        <input type="text" id="student-search" placeholder="Enter student number (e.g. 2021-00123)" oninput="searchStudent()">
                    </div>
                </div>

                <!-- Student Info Preview -->
                <div class="info-preview" id="student-preview">
                    <div class="preview-icon">🎓</div>
                    <div class="preview-details">
                        <strong>Juan dela Cruz</strong>
                        <span>2021-00123 &nbsp;|&nbsp; BSIT</span>
                        <span class="preview-status">Active borrows: 2 / 3 allowed</span>
                    </div>
                    <span class="badge badge--borrowed">Found</span>
                </div>

                <div class="form-group">
                    <label>Book ISBN or Title</label>
                    <input type="text" id="book-search" placeholder="Enter ISBN or search book title" oninput="searchBook()">
                </div>

                <!-- Book Info Preview -->
                <div class="info-preview" id="book-preview">
                    <div class="preview-icon">📖</div>
                    <div class="preview-details">
                        <strong>Introduction to Computing</strong>
                        <span>Peter Norton &nbsp;|&nbsp; Science & Technology</span>
                        <span class="preview-status">Available: 4 of 5 copies</span>
                    </div>
                    <span class="badge badge--returned">Available</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Borrow Date</label>
                        <input type="date" id="borrow-date" value="2026-04-04">
                    </div>
                    <div class="form-group">
                        <label>Due Date</label>
                        <input type="date" id="due-date" value="2026-04-11">
                    </div>
                </div>

                <div class="form-group">
                    <label>Notes (optional)</label>
                    <textarea rows="2" placeholder="Any additional notes..."></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width:100%; margin-top:0.5rem;">✅ Confirm Borrow</button>
            </form>
        </div>

        <!-- Recent Transactions -->
        <div class="card">
            <div class="card-head">
                <h2>Recent Borrows</h2>
                <a href="history.php" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Borrower</th>
                        <th>Book</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan dela Cruz</td>
                        <td>Intro to Computing</td>
                        <td>Apr 08</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                    <tr>
                        <td>Ana Lim</td>
                        <td>Data Structures</td>
                        <td>Apr 10</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                    <tr>
                        <td>Pedro Reyes</td>
                        <td>Philippine History</td>
                        <td>Apr 03</td>
                        <td><span class="badge badge--overdue">Overdue</span></td>
                    </tr>
                    <tr>
                        <td>Maria Santos</td>
                        <td>Calculus Vol. 2</td>
                        <td>Apr 06</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</main>

<script>
    function searchStudent() {
        const val = document.getElementById('student-search').value;
        document.getElementById('student-preview').style.display = val.length > 3 ? 'flex' : 'none';
    }

    function searchBook() {
        const val = document.getElementById('book-search').value;
        document.getElementById('book-preview').style.display = val.length > 2 ? 'flex' : 'none';
    }

    // Auto set due date 7 days from borrow date
    document.getElementById('borrow-date').addEventListener('change', function () {
        const borrow = new Date(this.value);
        borrow.setDate(borrow.getDate() + 7);
        document.getElementById('due-date').value = borrow.toISOString().split('T')[0];
    });

    // Hide previews initially
    document.getElementById('student-preview').style.display = 'none';
    document.getElementById('book-preview').style.display = 'none';
</script>

</body>
</html>