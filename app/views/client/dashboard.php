<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Student Dashboard</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
</head>
<body>

<!-- Top Navigation -->
<nav class="navbar">
    <div class="nav-brand">
        <img src="../../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge nav-role-badge--student">Student</span>
    </div>
    <ul class="nav-links">
        <li><a href="student_dashboard.php" class="active">Home</a></li>
        <li><a href="catalog.php">Browse Books</a></li>
        <li><a href="my_borrowed.php">My Borrowed</a></li>
        <li><a href="my_history.php">My History</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">🎓</span>
        <span class="nav-username">Juan dela Cruz</span>
        <a href="../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<!-- Main Content -->
<main class="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Hello, Juan! 👋</h1>
            <p class="page-subtitle">Here's a summary of your library activity.</p>
        </div>
        <div class="header-date"><?php echo date('F d, Y'); ?></div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid stats-grid--student">
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info">
                <span class="stat-value">2</span>
                <span class="stat-label">Currently Borrowed</span>
            </div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info">
                <span class="stat-value">1</span>
                <span class="stat-label">Overdue</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-info">
                <span class="stat-value">14</span>
                <span class="stat-label">Total Borrowed (All Time)</span>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">

        <!-- My Borrowed Books -->
        <div class="card">
            <div class="card-head">
                <h2>My Borrowed Books</h2>
                <a href="my_borrowed.php" class="card-link">View all →</a>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Borrowed</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Introduction to Computing</td>
                        <td>Peter Norton</td>
                        <td>Mar 25, 2025</td>
                        <td>Apr 08, 2025</td>
                        <td><span class="badge badge--borrowed">Borrowed</span></td>
                    </tr>
                    <tr>
                        <td>Philippine History</td>
                        <td>Teodoro Agoncillo</td>
                        <td>Mar 20, 2025</td>
                        <td>Apr 03, 2025</td>
                        <td><span class="badge badge--overdue">Overdue</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- Overdue Warning -->
            <div class="overdue-warning">
                ⚠️ <strong>Philippine History</strong> is overdue! Please return it as soon as possible to avoid penalties.
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-col">

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-head">
                    <h2>Quick Actions</h2>
                </div>
                <div class="quick-actions">
                    <a href="catalog.php" class="action-btn">🔍 Browse Books</a>
                    <a href="my_borrowed.php" class="action-btn">📖 My Books</a>
                    <a href="my_history.php" class="action-btn">🕘 My History</a>
                </div>
            </div>

            <!-- Library Announcement -->
            <div class="card card--announcement">
                <div class="card-head">
                    <h2>📢 Announcement</h2>
                </div>
                <ul class="announcement-list">
                    <li>
                        <span class="announcement-date">Apr 1</span>
                        <span class="announcement-text">Library will be closed on April 9 (Araw ng Kagitingan).</span>
                    </li>
                    <li>
                        <span class="announcement-date">Mar 28</span>
                        <span class="announcement-text">New books added: Engineering & Technology section.</span>
                    </li>
                    <li>
                        <span class="announcement-date">Mar 25</span>
                        <span class="announcement-text">Maximum borrow limit is now 3 books per student.</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

</main>

</body>
</html>