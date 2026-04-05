<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — My Borrowed Books</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/assets/css/books.css">
    <link rel="stylesheet" href="../../../public/assets/css/borrowers.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">
        <img src="../../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge nav-role-badge--student">Student</span>
    </div>
    <ul class="nav-links">
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="catalog.php">Browse Books</a></li>
        <li><a href="my_borrowed.php" class="active">My Borrowed</a></li>
        <li><a href="my_history.php">My History</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">🎓</span>
        <span class="nav-username">Juan dela Cruz</span>
        <a href="../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>My Borrowed Books</h1>
            <p class="page-subtitle">Your currently borrowed books and due dates.</p>
        </div>
        <a href="catalog.php" class="btn-primary">🔍 Browse More Books</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid stats-grid--student" style="margin-bottom:1.5rem;">
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info"><span class="stat-value">2</span><span class="stat-label">Currently Borrowed</span></div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info"><span class="stat-value">1</span><span class="stat-label">Overdue</span></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-info"><span class="stat-value">1 / 3</span><span class="stat-label">Borrow Slots Used</span></div>
        </div>
    </div>

    <!-- Overdue Warning Banner -->
    <div class="overdue-warning" style="margin-bottom:1.5rem; font-size:0.9rem;">
        ⚠️ You have <strong>1 overdue book</strong>. Please return it immediately to avoid additional penalties.
    </div>

    <!-- Borrowed Books Cards -->
    <div class="borrowed-cards">

        <!-- Overdue Card -->
        <div class="borrowed-card borrowed-card--overdue">
            <div class="borrowed-card-icon">📖</div>
            <div class="borrowed-card-info">
                <h3>Philippine History</h3>
                <p class="borrowed-author">Teodoro Agoncillo</p>
                <p class="borrowed-meta">Borrowed: Mar 20, 2025 &nbsp;|&nbsp; Location: Section B, Row 2</p>
            </div>
            <div class="borrowed-card-status">
                <span class="badge badge--overdue">Overdue</span>
                <div class="due-info due-info--overdue">
                    <span class="due-label">Was due</span>
                    <span class="due-date">Apr 03, 2025</span>
                    <span class="due-penalty">Penalty: ₱25.00</span>
                </div>
            </div>
        </div>

        <!-- Active Card -->
        <div class="borrowed-card borrowed-card--active">
            <div class="borrowed-card-icon">📖</div>
            <div class="borrowed-card-info">
                <h3>Introduction to Computing</h3>
                <p class="borrowed-author">Peter Norton</p>
                <p class="borrowed-meta">Borrowed: Mar 25, 2025 &nbsp;|&nbsp; Location: Section A, Row 1</p>
            </div>
            <div class="borrowed-card-status">
                <span class="badge badge--borrowed">Borrowed</span>
                <div class="due-info">
                    <span class="due-label">Due on</span>
                    <span class="due-date">Apr 08, 2025</span>
                    <span class="due-days">4 days left</span>
                </div>
            </div>
        </div>

    </div>

    <!-- Empty slot reminder -->
    <div class="card" style="margin-top:1.5rem; text-align:center; padding:2rem; border: 2px dashed var(--cream-dark);">
        <p style="font-size:2rem; margin-bottom:0.5rem;">➕</p>
        <p style="color:var(--text-muted); font-size:0.9rem;">You can still borrow <strong>1 more book</strong>.</p>
        <a href="catalog.php" class="btn-primary" style="display:inline-block; margin-top:1rem;">Browse Books</a>
    </div>

</main>
</body>
</html>