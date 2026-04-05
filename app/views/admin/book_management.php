<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Book Management</title>
    <link rel="stylesheet" href="../../../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../../../public/assets/css/books.css">
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

<main class="main-content">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1>Book Management</h1>
            <p class="page-subtitle">Add, edit, or remove books from the library catalog.</p>
        </div>

            <button class="btn-primary" onclick="openModal()">➕ Add New Book</button>

            <div class="view-toggle">
                <a href="book_management.php" class="view-btn active">📋 Management</a>
                <a href="book_catalog.php" class="view-btn">📚 Catalog</a>
            </div>
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

    <!-- Books Table -->
    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Copies</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Introduction to Computing</td>
                    <td>Peter Norton</td>
                    <td>Science & Technology</td>
                    <td>978-0-07-352702-4</td>
                    <td>5</td>
                    <td><span class="badge badge--returned">4</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️ Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Calculus Vol. 2</td>
                    <td>James Stewart</td>
                    <td>Mathematics</td>
                    <td>978-0-538-49790-9</td>
                    <td>3</td>
                    <td><span class="badge badge--returned">3</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️ Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Philippine History</td>
                    <td>Teodoro Agoncillo</td>
                    <td>History</td>
                    <td>978-971-8845-00-6</td>
                    <td>4</td>
                    <td><span class="badge badge--overdue">0</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️ Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Data Structures & Algorithms</td>
                    <td>Robert Lafore</td>
                    <td>Science & Technology</td>
                    <td>978-0-672-32453-8</td>
                    <td>2</td>
                    <td><span class="badge badge--borrowed">1</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️ Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Biology Essentials</td>
                    <td>Neil Campbell</td>
                    <td>Science & Technology</td>
                    <td>978-0-321-74983-3</td>
                    <td>6</td>
                    <td><span class="badge badge--returned">6</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️ Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <span class="pagination-info">Showing 1–5 of 1,240 books</span>
            <div class="pagination-controls">
                <button class="page-btn" disabled>← Prev</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span>...</span>
                <button class="page-btn">248</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

</main>

<!-- Add/Edit Modal -->
<div class="modal-overlay" id="modal-overlay" onclick="closeModal()"></div>
<div class="modal" id="modal">
    <div class="modal-header">
        <h2 id="modal-title">Add New Book</h2>
        <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
        <form action="#" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label>Book Title</label>
                    <input type="text" name="title" placeholder="Enter book title">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" placeholder="Enter author name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>ISBN</label>
                    <input type="text" name="isbn" placeholder="e.g. 978-0-07-352702-4">
                </div>
                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre">
                        <option value="">Select genre</option>
                        <option>Science & Technology</option>
                        <option>History</option>
                        <option>Literature</option>
                        <option>Mathematics</option>
                        <option>Engineering</option>
                        <option>Social Science</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Number of Copies</label>
                    <input type="number" name="copies" placeholder="e.g. 3" min="1">
                </div>
                <div class="form-group">
                    <label>Shelf Location</label>
                    <input type="text" name="location" placeholder="e.g. Section A, Row 3">
                </div>
            </div>
            <div class="form-group">
                <label>Description (optional)</label>
                <textarea name="description" rows="3" placeholder="Brief description of the book..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary">Save Book</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="delete-overlay" onclick="closeDelete()"></div>
<div class="modal modal--sm" id="delete-modal">
    <div class="modal-header">
        <h2>Delete Book</h2>
        <button class="modal-close" onclick="closeDelete()">✕</button>
    </div>
    <div class="modal-body">
        <p class="delete-msg">Are you sure you want to delete <strong>Introduction to Computing</strong>? This action cannot be undone.</p>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeDelete()">Cancel</button>
            <button class="btn-delete-confirm">🗑️ Delete</button>
        </div>
    </div>
</div>

<script>
    function openModal(mode = 'add') {
        document.getElementById('modal-title').textContent = mode === 'edit' ? 'Edit Book' : 'Add New Book';
        document.getElementById('modal-overlay').classList.add('active');
        document.getElementById('modal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modal-overlay').classList.remove('active');
        document.getElementById('modal').classList.remove('active');
    }

    function confirmDelete() {
        document.getElementById('delete-overlay').classList.add('active');
        document.getElementById('delete-modal').classList.add('active');
    }

    function closeDelete() {
        document.getElementById('delete-overlay').classList.remove('active');
        document.getElementById('delete-modal').classList.remove('active');
    }
</script>

</body>
</html>