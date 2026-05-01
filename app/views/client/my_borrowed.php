<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — My Borrowed Books</title>
    <link rel="stylesheet" href="/librotrack/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/books.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/borrowers.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">
        <img src="/librotrack/public/assets/img/logo.gif" alt="LibroTrack" class="brand-icon">
        <span class="nav-title">LibroTrack</span>
        <span class="nav-role-badge nav-role-badge--student">Student</span>
    </div>
    <ul class="nav-links">
        <li><a href="/librotrack/public/index.php?controller=Student&action=index">Home</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=catalog">Browse Books</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=borrowed" class="active">My Borrowed</a></li>
        <li><a href="/librotrack/public/index.php?controller=Student&action=history">My History</a></li>
        <li><a href="/librotrack/public/index.php?controller=Profile&action=index">Profile</a></li>
    </ul>
    <div class="nav-user">
        <span class="nav-avatar">
            <?php if ($profilePicUrl): ?>
                <img src="<?= htmlspecialchars($profilePicUrl) ?>" alt="Profile" class="nav-profile-pic">
            <?php else: ?>
                🎓
            <?php endif; ?>
        </span>
        <span class="nav-username"><?= htmlspecialchars($student['fname']) ?></span>
        <a href="/librotrack/public/index.php?controller=Auth&action=logout" class="nav-logout">Logout</a>
    </div>
</nav>

<main class="main-content">

    <div class="page-header">
        <div>
            <h1>My Borrowed Books</h1>
            <p class="page-subtitle">Your currently borrowed books and due dates.</p>
        </div>
        <a href="/librotrack/public/index.php?controller=Student&action=catalog" class="btn-primary">🔍 Browse More Books</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid stats-grid--student" style="margin-bottom:1.5rem;">
        <div class="stat-card">
            <div class="stat-icon">📤</div>
            <div class="stat-info">
                <span class="stat-value"><?= $stats['active_borrows'] ?></span>
                <span class="stat-label">Currently Borrowed</span>
            </div>
        </div>
        <div class="stat-card <?= $stats['overdue_count'] > 0 ? 'stat-card--warning' : '' ?>">
            <div class="stat-icon">⚠️</div>
            <div class="stat-info">
                <span class="stat-value"><?= $stats['overdue_count'] ?></span>
                <span class="stat-label">Overdue</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📚</div>
            <div class="stat-info">
                <span class="stat-value"><?= $stats['active_borrows'] ?> / 3</span>
                <span class="stat-label">Borrow Slots Used</span>
            </div>
        </div>
    </div>

    <!-- Overdue Warning -->
    <?php if ((int)$stats['overdue_count'] > 0): ?>
    <div class="overdue-warning" style="margin-bottom:1.5rem;font-size:0.9rem;">
        ⚠️ You have <strong><?= $stats['overdue_count'] ?> overdue book<?= $stats['overdue_count'] != 1 ? 's' : '' ?></strong>.
        Please return <?= $stats['overdue_count'] == 1 ? 'it' : 'them' ?> immediately to avoid additional penalties.
    </div>
    <?php endif; ?>

    <!-- Borrowed Book Cards -->
    <?php if (empty($activeBorrows)): ?>
        <div class="card" style="text-align:center;padding:3rem;">
            <p style="font-size:2.5rem;margin-bottom:0.75rem;">📭</p>
            <p style="color:var(--text-muted);">You have no active borrows.</p>
            <a href="/librotrack/public/index.php?controller=Student&action=catalog"
               class="btn-primary" style="display:inline-block;margin-top:1rem;">Browse Books</a>
        </div>
    <?php else: ?>
    <div class="borrowed-cards">
        <?php foreach ($activeBorrows as $b):
            $isOverdue  = (int)$b['daysOverdue'] > 0;
            $daysLeft   = (int)$b['daysLeft'];
            $cardClass  = $isOverdue ? 'borrowed-card--overdue' : 'borrowed-card--active';
        ?>
        <div class="borrowed-card <?= $cardClass ?>">
            <div class="borrowed-card-icon">
                <?php if (!empty($b['cover_image'])): ?>
                    <img src="/librotrack/public/assets/img/covers/<?= htmlspecialchars($b['cover_image']) ?>"
                         alt="cover" style="width:56px;height:72px;object-fit:cover;border-radius:6px;">
                <?php else: ?>
                    📖
                <?php endif; ?>
            </div>
            <div class="borrowed-card-info">
                <h3><?= htmlspecialchars($b['title']) ?></h3>
                <p class="borrowed-author"><?= htmlspecialchars($b['author']) ?></p>
                <p class="borrowed-meta">
                    Borrowed: <?= date('M d, Y', strtotime($b['borrowDate'])) ?>
                    <?php if (!empty($b['location'])): ?>
                        &nbsp;|&nbsp; Location: <?= htmlspecialchars($b['location']) ?>
                    <?php endif; ?>
                </p>
            </div>
            <div class="borrowed-card-status">
                <?php if ($isOverdue): ?>
                    <span class="badge badge--overdue">Overdue</span>
                    <div class="due-info due-info--overdue">
                        <span class="due-label">Was due</span>
                        <span class="due-date"><?= date('M d, Y', strtotime($b['dueDate'])) ?></span>
                        <span class="due-penalty">Penalty: ₱<?= number_format($b['penaltyAmount'], 2) ?></span>
                    </div>
                <?php else: ?>
                    <span class="badge badge--borrowed">Borrowed</span>
                    <div class="due-info">
                        <span class="due-label">Due on</span>
                        <span class="due-date"><?= date('M d, Y', strtotime($b['dueDate'])) ?></span>
                        <span class="due-days">
                            <?= $daysLeft > 0 ? "{$daysLeft} day" . ($daysLeft != 1 ? 's' : '') . ' left' : 'Due today!' ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if ((int)$stats['slots_remaining'] > 0): ?>
    <div class="card" style="margin-top:1.5rem;text-align:center;padding:2rem;border:2px dashed var(--cream-dark);">
        <p style="font-size:2rem;margin-bottom:0.5rem;">➕</p>
        <p style="color:var(--text-muted);font-size:0.9rem;">
            You can still borrow <strong><?= $stats['slots_remaining'] ?> more book<?= $stats['slots_remaining'] != 1 ? 's' : '' ?></strong>.
        </p>
        <a href="/librotrack/public/index.php?controller=Student&action=catalog"
           class="btn-primary" style="display:inline-block;margin-top:1rem;">Browse Books</a>
    </div>
    <?php endif; ?>
    <?php endif; ?>

</main>
</body>
</html>