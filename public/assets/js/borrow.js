// LibroTrack — Borrow Page JS | public/assets/js/borrow.js

let selectedStudentID = null;
let selectedBookID    = null;

// ── Student lookup ────────────────────────────────────────────────
let studentTimer = null;
document.getElementById('student-search').addEventListener('input', function () {
    clearTimeout(studentTimer);
    const val = this.value.trim();
    if (val.length < 3) {
        hidePreview('student-preview');
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
            document.getElementById('input-studentID').value = s.studentID;
            preview.querySelector('.preview-name').textContent  = `${s.fname} ${s.lname}`;
            preview.querySelector('.preview-meta').textContent  = `${s.studentNumber} | ${s.course}`;
            preview.querySelector('.preview-status').textContent = `Active borrows: ${s.active_borrows}`;
            preview.querySelector('.preview-badge').textContent  = 'Found';
            preview.querySelector('.preview-badge').className    = 'badge badge--returned';
            preview.style.display = 'flex';
        } else {
            selectedStudentID = null;
            document.getElementById('input-studentID').value = '';
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

// ── Book lookup ───────────────────────────────────────────────────
let bookTimer = null;
document.getElementById('book-search').addEventListener('input', function () {
    clearTimeout(bookTimer);
    const val = this.value.trim();
    if (val.length < 2) {
        hidePreview('book-preview');
        selectedBookID = null;
        return;
    }
    bookTimer = setTimeout(() => lookupBook(val), 400);
});

async function lookupBook(query) {
    try {
        const res  = await fetch(`/LibroTrack/public/index.php?controller=Transaction&action=findBook&q=${encodeURIComponent(query)}`);
        const data = await res.json();
        const preview = document.getElementById('book-preview');

        if (data.success) {
            const b = data.book;
            selectedBookID = b.bookID;
            document.getElementById('input-bookID').value = b.bookID;
            preview.querySelector('.preview-name').textContent   = b.title;
            preview.querySelector('.preview-meta').textContent   = `${b.author} | ${b.genre}`;
            preview.querySelector('.preview-status').textContent = `Available: ${b.available} of ${b.copies} copies`;

            if (b.available > 0) {
                preview.querySelector('.preview-badge').textContent = 'Available';
                preview.querySelector('.preview-badge').className   = 'badge badge--returned';
            } else {
                preview.querySelector('.preview-badge').textContent = 'Unavailable';
                preview.querySelector('.preview-badge').className   = 'badge badge--overdue';
                selectedBookID = null;
                document.getElementById('input-bookID').value = '';
            }
            preview.style.display = 'flex';
        } else {
            selectedBookID = null;
            document.getElementById('input-bookID').value = '';
            preview.querySelector('.preview-name').textContent   = 'Book not found';
            preview.querySelector('.preview-meta').textContent   = query;
            preview.querySelector('.preview-status').textContent = '';
            preview.querySelector('.preview-badge').textContent  = 'Not Found';
            preview.querySelector('.preview-badge').className    = 'badge badge--overdue';
            preview.style.display = 'flex';
        }
    } catch (e) {
        console.error('Book lookup failed:', e);
    }
}

function hidePreview(id) {
    document.getElementById(id).style.display = 'none';
}

// ── Auto due date (7 days from borrow date) ───────────────────────
document.getElementById('borrow-date').addEventListener('change', function () {
    const borrow = new Date(this.value);
    borrow.setDate(borrow.getDate() + 7);
    document.getElementById('due-date').value = borrow.toISOString().split('T')[0];
});

// ── Set today as default borrow date ─────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('borrow-date').value = today;
    const due = new Date();
    due.setDate(due.getDate() + 7);
    document.getElementById('due-date').value = due.toISOString().split('T')[0];

    document.getElementById('student-preview').style.display = 'none';
    document.getElementById('book-preview').style.display    = 'none';

    // Toast auto-dismiss
    const toast = document.querySelector('.toast');
    if (toast) setTimeout(() => toast.remove(), 4000);
});

// ── Form validation before submit ─────────────────────────────────
document.getElementById('borrow-form').addEventListener('submit', function (e) {
    if (!document.getElementById('input-studentID').value) {
        e.preventDefault();
        alert('Please select a valid student first.');
        return;
    }
    if (!document.getElementById('input-bookID').value) {
        e.preventDefault();
        alert('Please select an available book first.');
    }
});