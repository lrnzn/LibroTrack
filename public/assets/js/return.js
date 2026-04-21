// LibroTrack — Return Page JS | public/assets/js/return.js

const PENALTY_RATE = 5.00;

// ── Student dropdown change ───────────────────────────────────────
async function onStudentChange(select) {
    const option  = select.options[select.selectedIndex];
    const preview = document.getElementById('student-preview');

    resetBookSection();

    if (!select.value) {
        preview.style.display = 'none';
        return;
    }

    // Show student preview
    preview.querySelector('.preview-name').textContent   = option.dataset.name;
    preview.querySelector('.preview-meta').textContent   = `${option.dataset.number} | ${option.dataset.course}`;
    preview.querySelector('.preview-status').textContent = `Active borrows: ${option.dataset.borrows}`;
    preview.querySelector('.preview-badge').textContent  = 'Selected';
    preview.querySelector('.preview-badge').className    = 'badge badge--borrowed';
    preview.style.display = 'flex';

    // Load their active borrows into book dropdown
    await loadActiveBorrows(select.value);
}

async function loadActiveBorrows(studentID) {
    try {
        const res  = await fetch(`/librotrack/public/index.php?controller=Transaction&action=getActiveBorrows&studentID=${studentID}`);
        const data = await res.json();
        const select = document.getElementById('book-select');

        select.innerHTML = '<option value="">-- Select book to return --</option>';

        data.borrows.forEach(b => {
            const overdueTxt = b.daysOverdue > 0 ? ` — ⚠️ ${b.daysOverdue}d overdue` : '';
            const opt = document.createElement('option');
            opt.value                 = b.transactionID;
            opt.dataset.daysOverdue   = b.daysOverdue;
            opt.dataset.penaltyAmount = b.penaltyAmount;
            opt.dataset.dueDate       = b.dueDate;
            opt.dataset.title         = b.title;
            opt.textContent           = `${b.title} (Due: ${b.dueDate}${overdueTxt})`;
            select.appendChild(opt);
        });

        document.getElementById('book-select-group').style.display = 'block';
    } catch (e) {
        console.error('Failed to load borrows:', e);
    }
}

// ── Book dropdown change ──────────────────────────────────────────
let selectedDueDate = null;

function onBookChange(select) {
    const option = select.options[select.selectedIndex];

    resetReturnDetails();

    if (!select.value) return;

    selectedDueDate = option.dataset.dueDate;
    document.getElementById('input-transactionID').value = select.value;

    // Set return date to today and calculate penalty
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('return-date').value = today;

    document.getElementById('return-details').style.display = 'grid';
    document.getElementById('confirm-btn').style.display    = 'block';

    recalculatePenalty(today);
}

// ── Recalculate penalty when return date changes ──────────────────
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('return-date').addEventListener('change', function () {
        if (selectedDueDate) {
            recalculatePenalty(this.value);
        }
    });
});

function recalculatePenalty(returnDateStr) {
    if (!selectedDueDate) return;

    const dueDate    = new Date(selectedDueDate);
    const returnDate = new Date(returnDateStr);
    const diffMs     = returnDate - dueDate;
    const daysOverdue = diffMs > 0 ? Math.floor(diffMs / (1000 * 60 * 60 * 24)) : 0;
    const penalty     = daysOverdue * PENALTY_RATE;

    document.getElementById('input-daysOverdue').value = daysOverdue;

    if (daysOverdue > 0) {
        document.getElementById('overdue-days').textContent     = daysOverdue;
        document.getElementById('overdue-penalty').textContent  = `₱${penalty.toFixed(2)}`;
        document.getElementById('overdue-box').style.display    = 'block';
        document.getElementById('penalty-amount-display').value = `₱${penalty.toFixed(2)}`;
        document.getElementById('penalty-paid-group').style.display = 'block';
    } else {
        document.getElementById('overdue-box').style.display        = 'none';
        document.getElementById('penalty-amount-display').value     = 'No penalty';
        document.getElementById('penalty-paid-group').style.display = 'none';
    }
}

// ── Reset helpers ─────────────────────────────────────────────────
function resetBookSection() {
    const select = document.getElementById('book-select');
    select.innerHTML = '<option value="">-- Select student first --</option>';
    document.getElementById('book-select-group').style.display = 'none';
    resetReturnDetails();
}

function resetReturnDetails() {
    document.getElementById('input-transactionID').value        = '';
    document.getElementById('input-daysOverdue').value          = '0';
    document.getElementById('overdue-box').style.display        = 'none';
    document.getElementById('return-details').style.display     = 'none';
    document.getElementById('penalty-paid-group').style.display = 'none';
    document.getElementById('confirm-btn').style.display        = 'none';
}

// ── Init ──────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('student-preview').style.display    = 'none';
    document.getElementById('book-select-group').style.display  = 'none';
    document.getElementById('overdue-box').style.display        = 'none';
    document.getElementById('return-details').style.display     = 'none';
    document.getElementById('penalty-paid-group').style.display = 'none';
    document.getElementById('confirm-btn').style.display        = 'none';

    const toast = document.querySelector('.toast');
    if (toast) setTimeout(() => toast.remove(), 4000);
});