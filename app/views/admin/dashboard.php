<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Admin Dashboard</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
</head>
<body>

<!-- Top Navigation -->
<nav class="navbar">
    <div class="nav-brand">
        <img src="../../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge">Admin</span>
    </div>
    <ul class="nav-links">
        <li><a href="admin_dashboard.php" class="active">Dashboard</a></li>
        <li><a href="book_management.php">Books</a></li>
        <li><a href="borrowers.php">Borrowers</a></li>
        <li><a href="borrow.php">Transactions</a></li>
        <li><a href="overdue.php">Overdue</a></li>
        <li><a href="reports.php">Reports</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">👩‍💼</span>
        <span class="nav-username">Librarian</span>
        <a href="../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Dashboard</h1>
            <p class="page-subtitle">Welcome back! Here's what's happening in the library today.</p>
        </div>
        <div class="header-date"><?php echo date('F d, Y'); ?></div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📖</div>
            <div class="stat-info">
                <span class="stat-value">1,240</span>
                <span class="stat-label">Total Books</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-info">
                <span class="stat-value">983</span>
                <span class="stat-label">Available</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info">
                <span class="stat-value">257</span>
                <span class="stat-label">Borrowed</span>
            </div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info">
                <span class="stat-value">18</span>
                <span class="stat-label">Overdue</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <span class="stat-value">412</span>
                <span class="stat-label">Borrowers</span>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">

        <!-- Recent Transactions -->
        <div class="card">
            <div class="card-head">
                <h2>Recent Transactions</h2>
                <a href="transactions.php" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Borrower</th>
                        <th>Book Title</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Juan dela Cruz</td>
                        <td>Introduction to Computing</td>
                        <td>Apr 01, 2025</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                    <tr>
                        <td>Maria Santos</td>
                        <td>Calculus Vol. 2</td>
                        <td>Mar 30, 2025</td>
                        <td><span class="badge badge--returned">Returned</span></td>
                    </tr>
                    <tr>
                        <td>Pedro Reyes</td>
                        <td>Philippine History</td>
                        <td>Mar 28, 2025</td>
                        <td><span class="badge badge--overdue">Overdue</span></td>
                    </tr>
                    <tr>
                        <td>Ana Lim</td>
                        <td>Data Structures</td>
                        <td>Mar 27, 2025</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                    <tr>
                        <td>Carlo Mendoza</td>
                        <td>English for Academic</td>
                        <td>Mar 25, 2025</td>
                        <td><span class="badge badge--returned">Returned</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Right Column -->
        <div class="right-col">

            <!-- Overdue Alert -->
            <div class="card card--alert">
                <div class="card-head">
                    <h2>⚠️ Overdue Books</h2>
                    <a href="overdue.php" class="card-link">Manage →</a>
                </div>
                <ul class="overdue-list">
                    <li>
                        <div class="overdue-info">
                            <span class="overdue-name">Pedro Reyes</span>
                            <span class="overdue-book">Philippine History</span>
                        </div>
                        <span class="overdue-days">5 days</span>
                    </li>
                    <li>
                        <div class="overdue-info">
                            <span class="overdue-name">Lea Gomez</span>
                            <span class="overdue-book">Biology Essentials</span>
                        </div>
                        <span class="overdue-days">3 days</span>
                    </li>
                    <li>
                        <div class="overdue-info">
                            <span class="overdue-name">Ryan Torres</span>
                            <span class="overdue-book">Physics for Engineers</span>
                        </div>
                        <span class="overdue-days">1 day</span>
                    </li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-head">
                    <h2>Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <a href="borrow.php" class="action-btn">📤 Borrow Book</a>
                    <a href="return.php" class="action-btn">📥 Return Book</a>
                    <a href="book_management.php" class="action-btn">➕ Add Book</a>
                    <a href="borrowers.php" class="action-btn">👤 Add Borrower</a>
                </div>
            </div>

        </div>
    </div>

</main>

</body>
</html>