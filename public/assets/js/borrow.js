// LibroTrack — Borrow Page JS | public/assets/js/borrow.js

// ── Student dropdown change ───────────────────────────────────────
function onStudentChange(select) {
    const option  = select.options[select.selectedIndex];
    const preview = document.getElementById('student-preview');

    if (!select.value) {
        preview.style.display = 'none';
        document.getElementById('input-studentID').value = '';
        return;
    }

    document.getElementById('input-studentID').value = select.value;

    const borrows = parseInt(option.dataset.borrows);
    preview.querySelector('.preview-name').textContent    = option.dataset.name;
    preview.querySelector('.preview-meta').textContent    = `${option.dataset.number} | ${option.dataset.course}`;
    preview.querySelector('.preview-status').textContent  = `Active borrows: ${borrows}`;
    preview.querySelector('.preview-badge').textContent   = 'Selected';
    preview.querySelector('.preview-badge').className     = 'badge badge--returned';
    preview.style.display = 'flex';
}

// ── Book dropdown change ──────────────────────────────────────────
function onBookChange(select) {
    const option  = select.options[select.selectedIndex];
    const preview = document.getElementById('book-preview');

    if (!select.value) {
        preview.style.display = 'none';
        document.getElementById('input-bookID').value = '';
        return;
    }

    document.getElementById('input-bookID').value = select.value;

    const available = parseInt(option.dataset.available);
    const copies    = parseInt(option.dataset.copies);

    preview.querySelector('.preview-name').textContent   = option.dataset.title;
    preview.querySelector('.preview-meta').textContent   = `${option.dataset.author} | ${option.dataset.genre}`;
    preview.querySelector('.preview-status').textContent = `Available: ${available} of ${copies} copies`;
    preview.querySelector('.preview-badge').textContent  = 'Available';
    preview.querySelector('.preview-badge').className    = 'badge badge--returned';
    preview.style.display = 'flex';
}

// ── Auto due date (7 days from borrow date) ───────────────────────
document.getElementById('borrow-date').addEventListener('change', function () {
    const borrow = new Date(this.value);
    borrow.setDate(borrow.getDate() + 7);
    document.getElementById('due-date').value = borrow.toISOString().split('T')[0];
});

// ── Set today as default dates on load ───────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('borrow-date').value = today;
    const due = new Date();
    due.setDate(due.getDate() + 7);
    document.getElementById('due-date').value = due.toISOString().split('T')[0];

    document.getElementById('student-preview').style.display = 'none';
    document.getElementById('book-preview').style.display    = 'none';

    const toast = document.querySelector('.toast');
    if (toast) setTimeout(() => toast.remove(), 4000);
});

// ── Form validation before submit ─────────────────────────────────
document.getElementById('borrow-form').addEventListener('submit', function (e) {
    if (!document.getElementById('input-studentID').value) {
        e.preventDefault();
        alert('Please select a student.');
        return;
    }
    if (!document.getElementById('input-bookID').value) {
        e.preventDefault();
        alert('Please select a book.');
    }
});