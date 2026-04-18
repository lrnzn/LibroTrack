// LibroTrack — Return Page JS | public/assets/js/return.js

const PENALTY_RATE = 5.00;
let selectedStudentID = null;

// ── Student lookup ────────────────────────────────────────────────
let studentTimer = null;
document.getElementById('student-search').addEventListener('input', function () {
    clearTimeout(studentTimer);
    const val = this.value.trim();
    resetBookSelect();
    if (val.length < 3) {
        document.getElementById('student-preview').style.display = 'none';
        selectedStudentID = null;
        return;
    }
    studentTimer = setTimeout(() => lookupStudent(val), 400);
});

async function lookupStudent(query) {
    try {
        const res  = await fetch(`/LibroTrack/public/index.php?controller=Transaction&action=findStudent&q=${encodeURIComponent(query)}`);
        const data = await res.json();
        const preview = document.getElementById('student-preview');

        if (data.success) {
            const s = data.student;
            selectedStudentID = s.studentID;
            preview.querySelector('.preview-name').textContent   = `${s.fname} ${s.lname}`;
            preview.querySelector('.preview-meta').textContent   = `${s.studentNumber} | ${s.course}`;
            preview.querySelector('.preview-status').textContent = `Active borrows: ${s.active_borrows}`;
            preview.querySelector('.preview-badge').textContent  = s.active_borrows > 0 ? 'Has Borrows' : 'No Borrows';
            preview.querySelector('.preview-badge').className    = s.active_borrows > 0 ? 'badge badge--borrowed' : 'badge badge--returned';
            preview.style.display = 'flex';

            if (s.active_borrows > 0) {
                loadActiveBorrows(s.studentID);
            }
        } else {
            selectedStudentID = null;
            preview.querySelector('.preview-name').textContent   = 'Student not found';
            preview.querySelector('.preview-meta').textContent   = query;
            preview.querySelector('.preview-status').textContent = '';
            preview.querySelector('.preview-badge').textContent  = 'Not Found';
            preview.querySelector('.preview-badge').className    = 'badge badge--overdue';
            preview.style.display = 'flex';
        }
    } catch (e) {
        console.error('Student lookup failed:', e);
    }
}

async function loadActiveBorrows(studentID) {
    try {
        const res  = await fetch(`/LibroTrack/public/index.php?controller=Transaction&action=getActiveBorrows&studentID=${studentID}`);
        const data = await res.json();
        const select = document.getElementById('book-select');

        select.innerHTML = '<option value="">-- Select borrowed book --</option>';
        data.borrows.forEach(b => {
            const overdue = b.daysOverdue > 0 ? ` — OVERDUE ${b.daysOverdue}d` : '';
            const opt = document.createElement('option');
            opt.value                    = b.transactionID;
            opt.dataset.daysOverdue      = b.daysOverdue;
            opt.dataset.penaltyAmount    = b.penaltyAmount;
            opt.textContent              = `${b.title} (Due: ${b.dueDate}${overdue})`;
            select.appendChild(opt);
        });

        document.getElementById('book-select-group').style.display = 'block';
    } catch (e) {
        console.error('Failed to load borrows:', e);
    }
}

function resetBookSelect() {
    document.getElementById('book-select-group').style.display = 'none';
    document.getElementById('overdue-box').style.display       = 'none';
    document.getElementById('return-details').style.display    = 'none';
    document.getElementById('penalty-paid-group').style.display = 'none';
    document.getElementById('confirm-btn').style.display       = 'none';
    document.getElementById('input-transactionID').value       = '';
}

function checkOverdue() {
    const select     = document.getElementById('book-select');
    const option     = select.options[select.selectedIndex];
    const txID       = select.value;
    const daysOverdue = parseInt(option.dataset.daysOverdue || 0);
    const penalty    = parseFloat(option.dataset.penaltyAmount || 0);

    document.getElementById('input-transactionID').value = txID;
    document.getElementById('input-daysOverdue').value   = daysOverdue;

    if (!txID) {
        resetBookSelect();
        document.getElementById('book-select-group').style.display = 'block';
        return;
    }

    // Set return date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('return-date').value = today;

    if (daysOverdue > 0) {
        document.getElementById('overdue-days').textContent    = daysOverdue;
        document.getElementById('overdue-penalty').textContent = `₱${penalty.toFixed(2)}`;
        document.getElementById('overdue-box').style.display   = 'block';
        document.getElementById('penalty-amount-display').value = `₱${penalty.toFixed(2)}`;
        document.getElementById('penalty-paid-group').style.display = 'block';
    } else {
        document.getElementById('overdue-box').style.display        = 'none';
        document.getElementById('penalty-paid-group').style.display = 'none';
    }

    document.getElementById('return-details').style.display = 'grid';
    document.getElementById('confirm-btn').style.display    = 'block';
}

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