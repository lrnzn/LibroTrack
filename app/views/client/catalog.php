<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Browse Books</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/assets/css/books.css">
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
        <li><a href="catalog.php" class="active">Browse Books</a></li>
        <li><a href="my_borrowed.php">My Borrowed</a></li>
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
            <h1>Browse Books</h1>
            <p class="page-subtitle">Search and explore the library catalog.</p>
        </div>
        <div class="view-toggle">
            <button class="view-btn active" id="btn-grid" onclick="switchView('grid')">⊞ Grid</button>
            <button class="view-btn" id="btn-list" onclick="switchView('list')">☰ List</button>
        </div>
    </div>

    <!-- Search & Filter -->
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
            <option>Unavailable</option>
        </select>
    </div>

    <!-- Grid View -->
    <div class="books-grid" id="books-grid">
        <?php
        $books = [
            ['title'=>'Introduction to Computing',    'author'=>'Peter Norton',     'genre'=>'Science & Technology','available'=>4,'copies'=>5],
            ['title'=>'Calculus Vol. 2',              'author'=>'James Stewart',    'genre'=>'Mathematics',         'available'=>3,'copies'=>3],
            ['title'=>'Philippine History',           'author'=>'Teodoro Agoncillo','genre'=>'History',             'available'=>0,'copies'=>4],
            ['title'=>'Data Structures & Algorithms', 'author'=>'Robert Lafore',    'genre'=>'Science & Technology','available'=>1,'copies'=>2],
            ['title'=>'Biology Essentials',           'author'=>'Neil Campbell',    'genre'=>'Science & Technology','available'=>6,'copies'=>6],
            ['title'=>'Physics for Engineers',        'author'=>'Serway & Jewett',  'genre'=>'Engineering',         'available'=>2,'copies'=>4],
            ['title'=>'English for Academic Purposes','author'=>'Ken Hyland',       'genre'=>'Literature',          'available'=>5,'copies'=>5],
            ['title'=>'Sociology: A Brief Intro',     'author'=>'Richard Schaefer', 'genre'=>'Social Science',      'available'=>3,'copies'=>3],
        ];
        foreach ($books as $book):
            $status = $book['available']===0 ? 'unavailable' : ($book['available']<=1 ? 'low' : 'available');
            $badge  = $book['available']===0 ? 'badge--overdue' : ($book['available']<=1 ? 'badge--borrowed' : 'badge--returned');
            $label  = $book['available']===0 ? 'Unavailable' : "Available: {$book['available']}/{$book['copies']}";
            $btnDisabled = $book['available']===0 ? 'disabled style="opacity:0.5;cursor:not-allowed;"' : '';
        ?>
        <div class="book-card book-card--<?= $status ?>">
            <div class="book-cover"><span class="book-cover-icon">📖</span></div>
            <div class="book-info">
                <h3 class="book-title"><?= $book['title'] ?></h3>
                <p class="book-author"><?= $book['author'] ?></p>
                <span class="book-genre"><?= $book['genre'] ?></span>
                <span class="badge <?= $badge ?>"><?= $label ?></span>
                <button class="borrow-btn" <?= $btnDisabled ?> onclick="openBorrowModal('<?= addslashes($book['title']) ?>')">
                    <?= $book['available']===0 ? '❌ Unavailable' : '📤 Request Borrow' ?>
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- List View -->
    <div class="card" id="books-list" style="display:none;">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Title</th><th>Author</th><th>Genre</th><th>Availability</th><th>Action</th></tr>
            </thead>
            <tbody>
                <?php foreach ($books as $i => $book):
                    $badge = $book['available']===0 ? 'badge--overdue' : ($book['available']<=1 ? 'badge--borrowed' : 'badge--returned');
                ?>
                <tr>
                    <td><?= $i+1 ?></td>
                    <td><?= $book['title'] ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['genre'] ?></td>
                    <td><span class="badge <?= $badge ?>"><?= $book['available']===0 ? 'Unavailable' : "{$book['available']}/{$book['copies']}" ?></span></td>
                    <td>
                        <?php if ($book['available'] > 0): ?>
                        <button class="btn-edit" style="background:#E8F5EE;color:#2E7D52;" onclick="openBorrowModal('<?= addslashes($book['title']) ?>')">📤 Request</button>
                        <?php else: ?>
                        <span style="font-size:0.8rem;color:var(--text-muted);">Unavailable</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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

<!-- Borrow Request Modal -->
<div class="modal-overlay" id="modal-overlay" onclick="closeModal()"></div>
<div class="modal modal--sm" id="modal">
    <div class="modal-header">
        <h2>Request to Borrow</h2>
        <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
        <p style="font-size:0.9rem; color:var(--text-muted); margin-bottom:1rem;">You are requesting to borrow:</p>
        <p style="font-weight:600; font-size:1rem; color:var(--brown-dark); margin-bottom:1.5rem;" id="modal-book-title"></p>
        <div class="form-group">
            <label>Preferred Pickup Date</label>
            <input type="date" value="2025-04-05">
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-primary" onclick="closeModal()">📤 Submit Request</button>
        </div>
    </div>
</div>

<script>
    function switchView(view) {
        const isGrid = view === 'grid';
        document.getElementById('books-grid').style.display = isGrid ? 'grid' : 'none';
        document.getElementById('books-list').style.display = isGrid ? 'none' : 'block';
        document.getElementById('btn-grid').classList.toggle('active', isGrid);
        document.getElementById('btn-list').classList.toggle('active', !isGrid);
    }
    function openBorrowModal(title) {
        document.getElementById('modal-book-title').textContent = title;
        document.getElementById('modal-overlay').classList.add('active');
        document.getElementById('modal').classList.add('active');
    }
    function closeModal() {
        document.getElementById('modal-overlay').classList.remove('active');
        document.getElementById('modal').classList.remove('active');
    }
</script>
</body>
</html>