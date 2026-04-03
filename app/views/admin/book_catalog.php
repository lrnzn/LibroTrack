<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Book Catalog</title>
    <link rel="stylesheet" href="../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../public/assets/css/books.css">
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="book_management.php" class="active">Books</a></li>
        <li><a href="borrowers.php">Borrowers</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="overdue.php">Overdue</a></li>
        <li><a href="reports.php">Reports</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">👩‍💼</span>
        <span class="nav-username">Librarian</span>
        <a href="../../login.php" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Book Catalog</h1>
            <p class="page-subtitle">Browse the complete library collection.</p>
        </div>
        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="view-btn active" id="btn-grid" onclick="switchView('grid')">⊞ Grid</button>
            <button class="view-btn" id="btn-list" onclick="switchView('list')">☰ List</button>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="toolbar">
        <input type="text" class="search-input" placeholder="🔍 Search by title, author, or ISBN...">
        <select class="filter-select">
            <option value="">All Genres</option>
            <option>Science & Technology</option>
            <option>History</option>
            <option>Literature</option>
            <option>Mathematics</option>
            <option>Engineering</option>
            <option>Social Science</option>
        </select>
        <select class="filter-select">
            <option value="">All Status</option>
            <option>Available</option>
            <option>Borrowed</option>
        </select>
    </div>

    <!-- Grid View -->
    <div class="books-grid" id="books-grid">
        <?php
        $books = [
            ['title' => 'Introduction to Computing',    'author' => 'Peter Norton',       'genre' => 'Science & Technology', 'available' => 4, 'copies' => 5],
            ['title' => 'Calculus Vol. 2',              'author' => 'James Stewart',       'genre' => 'Mathematics',          'available' => 3, 'copies' => 3],
            ['title' => 'Philippine History',           'author' => 'Teodoro Agoncillo',   'genre' => 'History',              'available' => 0, 'copies' => 4],
            ['title' => 'Data Structures & Algorithms', 'author' => 'Robert Lafore',       'genre' => 'Science & Technology', 'available' => 1, 'copies' => 2],
            ['title' => 'Biology Essentials',           'author' => 'Neil Campbell',       'genre' => 'Science & Technology', 'available' => 6, 'copies' => 6],
            ['title' => 'Physics for Engineers',        'author' => 'Serway & Jewett',     'genre' => 'Engineering',          'available' => 2, 'copies' => 4],
            ['title' => 'English for Academic Purposes','author' => 'Ken Hyland',          'genre' => 'Literature',           'available' => 5, 'copies' => 5],
            ['title' => 'Sociology: A Brief Intro',     'author' => 'Richard Schaefer',    'genre' => 'Social Science',       'available' => 3, 'copies' => 3],
        ];

        foreach ($books as $book):
            $status = $book['available'] === 0 ? 'unavailable' : ($book['available'] <= 1 ? 'low' : 'available');
            $badge  = $book['available'] === 0 ? 'badge--overdue' : ($book['available'] <= 1 ? 'badge--borrowed' : 'badge--returned');
            $label  = $book['available'] === 0 ? 'Unavailable' : "Available: {$book['available']}/{$book['copies']}";
        ?>
        <div class="book-card book-card--<?= $status ?>">
            <div class="book-cover">
                <span class="book-cover-icon">📖</span>
            </div>
            <div class="book-info">
                <h3 class="book-title"><?= $book['title'] ?></h3>
                <p class="book-author"><?= $book['author'] ?></p>
                <span class="book-genre"><?= $book['genre'] ?></span>
                <span class="badge <?= $badge ?>"><?= $label ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- List View (hidden by default) -->
    <div class="card" id="books-list" style="display:none;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Copies</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $i => $book):
                    $badge = $book['available'] === 0 ? 'badge--overdue' : ($book['available'] <= 1 ? 'badge--borrowed' : 'badge--returned');
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['genre'] ?></td>
                    <td><?= $book['copies'] ?></td>
                    <td><span class="badge <?= $badge ?>"><?= $book['available'] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <span class="pagination-info">Showing 1–8 of 1,240 books</span>
        <div class="pagination-controls">
            <button class="page-btn" disabled>← Prev</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span>...</span>
            <button class="page-btn">155</button>
            <button class="page-btn">Next →</button>
        </div>
    </div>

</main>

<script>
    function switchView(view) {
        const grid = document.getElementById('books-grid');
        const list = document.getElementById('books-list');
        const btnGrid = document.getElementById('btn-grid');
        const btnList = document.getElementById('btn-list');

        if (view === 'grid') {
            grid.style.display = 'grid';
            list.style.display = 'none';
            btnGrid.classList.add('active');
            btnList.classList.remove('active');
        } else {
            grid.style.display = 'none';
            list.style.display = 'block';
            btnGrid.classList.remove('active');
            btnList.classList.add('active');
        }
    }
</script>

</body>
</html>