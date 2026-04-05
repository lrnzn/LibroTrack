<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Reports</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/assets/css/books.css">
    <link rel="stylesheet" href="../../../public/assets/css/borrowers.css">
    <link rel="stylesheet" href="../../../public/assets/css/reports.css">
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
        <li><a href="overdue.php">Overdue</a></li>
        <li><a href="reports.php" class="active">Reports</a></li>
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
            <h1>Reports</h1>
            <p class="page-subtitle">Library activity summaries and statistics.</p>
        </div>
        <div class="toolbar" style="margin-bottom:0;">
            <select class="filter-select">
                <option>April 2025</option>
                <option>March 2025</option>
                <option>February 2025</option>
            </select>
            <button class="btn-primary">🖨️ Print Report</button>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="stats-grid" style="grid-template-columns:repeat(4,1fr); margin-bottom:1.75rem;">
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-info"><span class="stat-value">142</span><span class="stat-label">Transactions This Month</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📖</div>
            <div class="stat-info"><span class="stat-value">1,240</span><span class="stat-label">Total Books</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info"><span class="stat-value">412</span><span class="stat-label">Active Borrowers</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-info"><span class="stat-value">₱385</span><span class="stat-label">Total Penalties</span></div>
        </div>
    </div>

    <div class="content-grid">

        <!-- Most Borrowed Books -->
        <div class="card">
            <div class="card-head">
                <h2>📚 Most Borrowed Books</h2>
                <span style="font-size:0.8rem; color:var(--text-muted);">This month</span>
            </div>
            <table class="data-table">
                <thead>
                    <tr><th>Rank</th><th>Book Title</th><th>Author</th><th>Times Borrowed</th></tr>
                </thead>
                <tbody>
                    <tr><td>🥇 1</td><td>Introduction to Computing</td><td>Peter Norton</td><td><span class="report-count">28</span></td></tr>
                    <tr><td>🥈 2</td><td>Philippine History</td><td>Teodoro Agoncillo</td><td><span class="report-count">21</span></td></tr>
                    <tr><td>🥉 3</td><td>Calculus Vol. 2</td><td>James Stewart</td><td><span class="report-count">18</span></td></tr>
                    <tr><td>4</td><td>Data Structures</td><td>Robert Lafore</td><td><span class="report-count">15</span></td></tr>
                    <tr><td>5</td><td>Biology Essentials</td><td>Neil Campbell</td><td><span class="report-count">12</span></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Right column -->
        <div class="right-col">

            <!-- Most Active Borrowers -->
            <div class="card">
                <div class="card-head">
                    <h2>👥 Top Borrowers</h2>
                    <span style="font-size:0.8rem; color:var(--text-muted);">This month</span>
                </div>
                <table class="data-table">
                    <thead>
                        <tr><th>Name</th><th>Course</th><th>Borrows</th></tr>
                    </thead>
                    <tbody>
                        <tr><td>Juan dela Cruz</td><td>BSIT</td><td><span class="report-count">7</span></td></tr>
                        <tr><td>Ana Lim</td><td>BSBA</td><td><span class="report-count">5</span></td></tr>
                        <tr><td>Maria Santos</td><td>BSCS</td><td><span class="report-count">4</span></td></tr>
                        <tr><td>Carlo Mendoza</td><td>BSIT</td><td><span class="report-count">4</span></td></tr>
                    </tbody>
                </table>
            </div>

            <!-- Genre Summary -->
            <div class="card">
                <div class="card-head">
                    <h2>📊 Borrows by Genre</h2>
                </div>
                <div class="genre-bars">
                    <div class="genre-bar-item">
                        <span class="genre-label">Science & Technology</span>
                        <div class="genre-bar-wrap">
                            <div class="genre-bar" style="width:72%;">72%</div>
                        </div>
                    </div>
                    <div class="genre-bar-item">
                        <span class="genre-label">History</span>
                        <div class="genre-bar-wrap">
                            <div class="genre-bar" style="width:48%; background:var(--brown-warm);">48%</div>
                        </div>
                    </div>
                    <div class="genre-bar-item">
                        <span class="genre-label">Mathematics</span>
                        <div class="genre-bar-wrap">
                            <div class="genre-bar" style="width:35%; background:var(--brown-light);">35%</div>
                        </div>
                    </div>
                    <div class="genre-bar-item">
                        <span class="genre-label">Engineering</span>
                        <div class="genre-bar-wrap">
                            <div class="genre-bar" style="width:20%; background:#C49A6C;">20%</div>
                        </div>
                    </div>
                    <div class="genre-bar-item">
                        <span class="genre-label">Literature</span>
                        <div class="genre-bar-wrap">
                            <div class="genre-bar" style="width:15%; background:#D4B896;">15%</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>
</body>
</html>