<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Borrower Management</title>
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
        <li><a href="borrowers.php" class="active">Borrowers</a></li>
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

    <div class="page-header">
        <div>
            <h1>Borrower Management</h1>
            <p class="page-subtitle">Manage registered student borrowers.</p>
        </div>
        <button class="btn-primary" onclick="openModal()">➕ Add Borrower</button>
    </div>

    <!-- Stats -->
    <div class="stats-grid" style="grid-template-columns: repeat(3,1fr); margin-bottom:1.5rem;">
        <div class="stat-card">
            <div class="stat-icon">👥</div>
            <div class="stat-info">
                <span class="stat-value">412</span>
                <span class="stat-label">Total Borrowers</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info">
                <span class="stat-value">87</span>
                <span class="stat-label">Currently Borrowing</span>
            </div>
        </div>
        <div class="stat-card stat-card--warning">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info">
                <span class="stat-value">18</span>
                <span class="stat-label">With Overdue Books</span>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="toolbar">
        <input type="text" class="search-input" placeholder="🔍 Search by name, student number, or course...">
        <select class="filter-select">
            <option value="">All Courses</option>
            <option>BSIT</option>
            <option>BSCS</option>
            <option>BSED</option>
            <option>BSBA</option>
            <option>BSME</option>
            <option>BSECE</option>
        </select>
        <select class="filter-select">
            <option value="">All Status</option>
            <option>Active</option>
            <option>With Overdue</option>
        </select>
    </div>

    <!-- Table -->
    <div class="card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Student No.</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Active Borrows</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Juan dela Cruz</td>
                    <td>2021-00123</td>
                    <td>BSIT</td>
                    <td>juan.delacruz@email.com</td>
                    <td>2</td>
                    <td><span class="badge badge--borrowed">Active</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-edit" onclick="viewBorrower()" style="background:#E8F5EE;color:#2E7D52;">👁 View</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Maria Santos</td>
                    <td>2021-00456</td>
                    <td>BSCS</td>
                    <td>maria.santos@email.com</td>
                    <td>0</td>
                    <td><span class="badge badge--returned">No Borrow</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-edit" onclick="viewBorrower()" style="background:#E8F5EE;color:#2E7D52;">👁 View</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Pedro Reyes</td>
                    <td>2020-00789</td>
                    <td>BSED</td>
                    <td>pedro.reyes@email.com</td>
                    <td>1</td>
                    <td><span class="badge badge--overdue">Overdue</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-edit" onclick="viewBorrower()" style="background:#E8F5EE;color:#2E7D52;">👁 View</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ana Lim</td>
                    <td>2022-00321</td>
                    <td>BSBA</td>
                    <td>ana.lim@email.com</td>
                    <td>1</td>
                    <td><span class="badge badge--borrowed">Active</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-edit" onclick="viewBorrower()" style="background:#E8F5EE;color:#2E7D52;">👁 View</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Carlo Mendoza</td>
                    <td>2023-00654</td>
                    <td>BSIT</td>
                    <td>carlo.mendoza@email.com</td>
                    <td>0</td>
                    <td><span class="badge badge--returned">No Borrow</span></td>
                    <td class="action-col">
                        <button class="btn-edit" onclick="openModal('edit')">✏️ Edit</button>
                        <button class="btn-edit" onclick="viewBorrower()" style="background:#E8F5EE;color:#2E7D52;">👁 View</button>
                        <button class="btn-delete" onclick="confirmDelete()">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="pagination">
            <span class="pagination-info">Showing 1–5 of 412 borrowers</span>
            <div class="pagination-controls">
                <button class="page-btn" disabled>← Prev</button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span>...</span>
                <button class="page-btn">83</button>
                <button class="page-btn">Next →</button>
            </div>
        </div>
    </div>

</main>

<!-- Add/Edit Modal -->
<div class="modal-overlay" id="modal-overlay" onclick="closeModal()"></div>
<div class="modal" id="modal">
    <div class="modal-header">
        <h2 id="modal-title">Add Borrower</h2>
        <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
        <form action="#" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" placeholder="Enter middle name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label>Name Extension</label>
                    <input type="text" placeholder="e.g. Jr., Sr., III">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Student Number</label>
                    <input type="text" placeholder="e.g. 2021-00123">
                </div>
                <div class="form-group">
                    <label>Course</label>
                    <select>
                        <option value="">Select course</option>
                        <option>BSIT</option>
                        <option>BSCS</option>
                        <option>BSED</option>
                        <option>BSBA</option>
                        <option>BSME</option>
                        <option>BSECE</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" placeholder="Enter email address">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-primary">Save Borrower</button>
            </div>
        </form>
    </div>
</div>

<!-- View Borrower Modal -->
<div class="modal-overlay" id="view-overlay" onclick="closeView()"></div>
<div class="modal" id="view-modal">
    <div class="modal-header">
        <h2>Borrower Details</h2>
        <button class="modal-close" onclick="closeView()">✕</button>
    </div>
    <div class="modal-body">
        <div class="borrower-profile">
            <div class="borrower-avatar">👤</div>
            <div class="borrower-details">
                <h3>Juan dela Cruz</h3>
                <p>2021-00123 &nbsp;|&nbsp; BSIT</p>
                <p>juan.delacruz@email.com</p>
            </div>
        </div>
        <div class="borrower-stats">
            <div class="b-stat"><span>2</span><small>Active Borrows</small></div>
            <div class="b-stat"><span>14</span><small>Total Borrowed</small></div>
            <div class="b-stat b-stat--warn"><span>1</span><small>Overdue</small></div>
        </div>
        <h4 style="margin: 1rem 0 0.5rem; font-family: 'Playfair Display', serif; font-size:1rem;">Current Borrows</h4>
        <table class="data-table">
            <thead>
                <tr><th>Book Title</th><th>Due Date</th><th>Status</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>Introduction to Computing</td>
                    <td>Apr 08, 2025</td>
                    <td><span class="badge badge--borrowed">Borrowed</span></td>
                </tr>
                <tr>
                    <td>Philippine History</td>
                    <td>Apr 03, 2025</td>
                    <td><span class="badge badge--overdue">Overdue</span></td>
                </tr>
            </tbody>
        </table>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeView()">Close</button>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal-overlay" id="delete-overlay" onclick="closeDelete()"></div>
<div class="modal modal--sm" id="delete-modal">
    <div class="modal-header">
        <h2>Remove Borrower</h2>
        <button class="modal-close" onclick="closeDelete()">✕</button>
    </div>
    <div class="modal-body">
        <p class="delete-msg">Are you sure you want to remove <strong>Juan dela Cruz</strong> from the system? This action cannot be undone.</p>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeDelete()">Cancel</button>
            <button class="btn-delete-confirm">🗑️ Remove</button>
        </div>
    </div>
</div>

<script>
    function openModal(mode = 'add') {
        document.getElementById('modal-title').textContent = mode === 'edit' ? 'Edit Borrower' : 'Add Borrower';
        document.getElementById('modal-overlay').classList.add('active');
        document.getElementById('modal').classList.add('active');
    }
    function closeModal() {
        document.getElementById('modal-overlay').classList.remove('active');
        document.getElementById('modal').classList.remove('active');
    }
    function viewBorrower() {
        document.getElementById('view-overlay').classList.add('active');
        document.getElementById('view-modal').classList.add('active');
    }
    function closeView() {
        document.getElementById('view-overlay').classList.remove('active');
        document.getElementById('view-modal').classList.remove('active');
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