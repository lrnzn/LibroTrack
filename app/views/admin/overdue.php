<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Overdue & Penalties</title>
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
        <li><a href="borrow.php">Transactions</a></li>
        <li><a href="overdue.php" class="active">Overdue</a></li>
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
            <h1>Overdue & Penalty Tracking</h1>
            <p class="page-subtitle">Monitor overdue books and manage penalty records.</p>
        </div>
        <div class="penalty-rate">⚙️ Penalty Rate: <strong>₱5.00 / day</strong></div>
    </div>

    <!-- Stats -->
    <div class="stats-grid" style="grid-template-columns:repeat(4,1fr); margin-bottom:1.5rem;">
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info"><span class="stat-value">18</span><span class="stat-label">Overdue Books</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info"><span class="stat-value">₱385</span><span class="stat-label">Total Penalties</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-info"><span class="stat-value">₱210</span><span class="stat-label">Penalties Paid</span></div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">❌</div>
            <div class="stat-info"><span class="stat-value">₱175</span><span class="stat-label">Unpaid Penalties</span></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="toolbar">
        <input type="text" class="search-input" placeholder="🔍 Search by borrower name or book title...">
        <select class="filter-select">
            <option value="">All Penalty Status</option>
            <option>Unpaid</option>
            <option>Paid</option>
        </select>
        <select class="filter-select">
            <option value="">All Days Overdue</option>
            <option>1–3 days</option>
            <option>4–7 days</option>
            <option>8+ days</option>
        </select>
    </div>

    <!-- Table -->
    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Borrower</th>
                    <th>Book Title</th>
                    <th>Due Date</th>
                    <th>Days Overdue</th>
                    <th>Penalty</th>
                    <th>Paid</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pedro Reyes</td>
                    <td>Philippine History</td>
                    <td>Apr 03, 2025</td>
                    <td><span class="overdue-days">5 days</span></td>
                    <td>₱25.00</td>
                    <td><span class="badge badge--overdue">Unpaid</span></td>
                    <td><button class="btn-edit" onclick="markPaid()">✅ Mark Paid</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Lea Gomez</td>
                    <td>Biology Essentials</td>
                    <td>Mar 28, 2025</td>
                    <td><span class="overdue-days">3 days</span></td>
                    <td>₱15.00</td>
                    <td><span class="badge badge--overdue">Unpaid</span></td>
                    <td><button class="btn-edit" onclick="markPaid()">✅ Mark Paid</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ryan Torres</td>
                    <td>Physics for Engineers</td>
                    <td>Apr 02, 2025</td>
                    <td><span class="overdue-days">1 day</span></td>
                    <td>₱5.00</td>
                    <td><span class="badge badge--overdue">Unpaid</span></td>
                    <td><button class="btn-edit" onclick="markPaid()">✅ Mark Paid</button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Sofia Cruz</td>
                    <td>Sociology: A Brief Intro</td>
                    <td>Mar 25, 2025</td>
                    <td><span class="overdue-days">8 days</span></td>
                    <td>₱40.00</td>
                    <td><span class="badge badge--returned">Paid</span></td>
                    <td><span style="font-size:0.8rem; color:var(--text-muted);">—</span></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Marco Villanueva</td>
                    <td>Calculus Vol. 2</td>
                    <td>Mar 22, 2025</td>
                    <td><span class="overdue-days">6 days</span></td>
                    <td>₱30.00</td>
                    <td><span class="badge badge--returned">Paid</span></td>
                    <td><span style="font-size:0.8rem; color:var(--text-muted);">—</span></td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <span class="pagination-info">Showing 1–5 of 18 overdue records</span>
            <div class="pagination-controls">
                <button class="page-btn" disabled>← Prev</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

</main>

<script>
    function markPaid() {
        alert('Penalty marked as paid!');
    }
</script>

</body>
</html>