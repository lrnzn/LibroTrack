<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — My Borrow History</title>
    <link rel="stylesheet" href="/librotrack/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/books.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/borrowers.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">
        <img src="/librotrack/public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge nav-role-badge--student">Student</span>
    </div>
    <ul class="nav-links">
        <li><a href="/librotrack/public/index.php?controller=Student&action=index">Home</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=catalog">Browse Books</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=borrowed">My Borrowed</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=history" class="active">My History</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">🎓</span>
        <span class="nav-username">Juan dela Cruz</span>
        <a href="/librotrack/public/index.php?controller=Auth&action=logout" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>My Borrow History</h1>
            <p class="page-subtitle">A complete record of all your past borrowing transactions.</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid stats-grid--student" style="margin-bottom:1.5rem;">
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-info"><span class="stat-value">14</span><span class="stat-label">Total Books Borrowed</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">✅</div>
            <div class="stat-info"><span class="stat-value">12</span><span class="stat-label">Returned on Time</span></div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info"><span class="stat-value">2</span><span class="stat-label">Returned Late</span></div>
        </div>
    </div>

    <!-- Filter -->
    <div class="toolbar">
        <input type="text" class="search-input" placeholder="🔍 Search by book title...">
        <select class="filter-select">
            <option value="">All Status</option>
            <option>Borrowed</option>
            <option>Returned</option>
            <option>Overdue</option>
        </select>
        <input type="date" class="filter-select" title="From date">
        <input type="date" class="filter-select" title="To date">
    </div>

    <!-- History Table -->
    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrowed</th>
                    <th>Due Date</th>
                    <th>Returned</th>
                    <th>Penalty</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>14</td>
                    <td>Philippine History</td>
                    <td>Teodoro Agoncillo</td>
                    <td>Mar 20, 2025</td>
                    <td>Apr 03, 2025</td>
                    <td>—</td>
                    <td>₱25.00</td>
                    <td><span class="badge badge--overdue">Overdue</span></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Introduction to Computing</td>
                    <td>Peter Norton</td>
                    <td>Mar 25, 2025</td>
                    <td>Apr 08, 2025</td>
                    <td>—</td>
                    <td>—</td>
                    <td><span class="badge badge--borrowed">Borrowed</span></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Calculus Vol. 2</td>
                    <td>James Stewart</td>
                    <td>Feb 10, 2025</td>
                    <td>Feb 17, 2025</td>
                    <td>Feb 17, 2025</td>
                    <td>—</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Data Structures & Algorithms</td>
                    <td>Robert Lafore</td>
                    <td>Jan 15, 2025</td>
                    <td>Jan 22, 2025</td>
                    <td>Jan 25, 2025</td>
                    <td>₱15.00</td>
                    <td><span class="badge badge--returned">Returned Late</span></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Biology Essentials</td>
                    <td>Neil Campbell</td>
                    <td>Dec 05, 2024</td>
                    <td>Dec 12, 2024</td>
                    <td>Dec 12, 2024</td>
                    <td>—</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>English for Academic Purposes</td>
                    <td>Ken Hyland</td>
                    <td>Nov 20, 2024</td>
                    <td>Nov 27, 2024</td>
                    <td>Nov 26, 2024</td>
                    <td>—</td>
                    <td><span class="badge badge--returned">Returned</span></td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <span class="pagination-info">Showing 1–6 of 14 transactions</span>
            <div class="pagination-controls">
                <button class="page-btn" disabled>← Prev</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

</main>
</body>
</html>