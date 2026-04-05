<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Transaction History</title>
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
            <h1>Transaction History</h1>
            <p class="page-subtitle">Complete log of all borrowing and returning activities.</p>
        </div>
        <div class="view-toggle">
            <a href="borrow.php" class="view-btn">📤 Borrow</a>
            <a href="return.php" class="view-btn">📥 Return</a>
            <a href="history.php" class="view-btn active">🕘 History</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid" style="grid-template-columns:repeat(4,1fr); margin-bottom:1.5rem;">
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-info"><span class="stat-value">1,842</span><span class="stat-label">Total Transactions</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info"><span class="stat-value">257</span><span class="stat-label">Currently Borrowed</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📥</div>
            <div class="stat-info"><span class="stat-value">1,567</span><span class="stat-label">Returned</span></div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info"><span class="stat-value">18</span><span class="stat-label">Overdue</span></div>
        </div>
    </div>

    <!-- Filters -->
    <div class="toolbar">
        <input type="text" class="search-input" placeholder="🔍 Search by borrower name or book title...">
        <input type="date" class="filter-select" title="From date">
        <input type="date" class="filter-select" title="To date">
        <select class="filter-select">
            <option value="">All Status</option>
            <option>Borrowed</option>
            <option>Returned</option>
            <option>Overdue</option>
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
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Return Date</th>
                    <th>Penalty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1842</td>
                    <td>Juan dela Cruz</td>
                    <td>Introduction to Computing</td>
                    <td>Mar 25, 2025</td>
                    <td>Apr 08, 2025</td>
                    <td>—</td>
                    <td>—</td>
                    <td><span class="badge badge--borrowed">Borrowed</span></td>
                </tr>
                <tr>
                    <td>1841</td>
                    <td>Maria Santos</td>
                    <td>Calculus Vol. 2</td>
                    <td>Mar 24, 2025</td>
                    <td>Mar 31, 2025</td>
                    <td>Mar 30, 2025</td>
                    <td>—</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
                <tr>
                    <td>1840</td>
                    <td>Pedro Reyes</td>
                    <td>Philippine History</td>
                    <td>Mar 20, 2025</td>
                    <td>Apr 03, 2025</td>
                    <td>—</td>
                    <td>₱25.00</td>
                    <td><span class="badge badge--overdue">Overdue</span></td>
                </tr>
                <tr>
                    <td>1839</td>
                    <td>Ana Lim</td>
                    <td>Data Structures</td>
                    <td>Mar 22, 2025</td>
                    <td>Apr 10, 2025</td>
                    <td>—</td>
                    <td>—</td>
                    <td><span class="badge badge--borrowed">Borrowed</span></td>
                </tr>
                <tr>
                    <td>1838</td>
                    <td>Carlo Mendoza</td>
                    <td>English for Academic</td>
                    <td>Mar 18, 2025</td>
                    <td>Mar 25, 2025</td>
                    <td>Mar 24, 2025</td>
                    <td>—</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
                <tr>
                    <td>1837</td>
                    <td>Lea Gomez</td>
                    <td>Biology Essentials</td>
                    <td>Mar 15, 2025</td>
                    <td>Mar 28, 2025</td>
                    <td>Mar 31, 2025</td>
                    <td>₱15.00</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <span class="pagination-info">Showing 1–6 of 1,842 transactions</span>
            <div class="pagination-controls">
                <button class="page-btn" disabled>← Prev</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span>...</span>
                <button class="page-btn">307</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

</main>
</body>
</html>