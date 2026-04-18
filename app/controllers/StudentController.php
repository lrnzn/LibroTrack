<?php

class StudentController
{
    private function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    // ── Student Dashboard ──────────────────────────────────────────────────
    public function index(): void
    {
        require __DIR__ . "/../views/client/dashboard.php";
    }

    // ── Browse Book Catalog ────────────────────────────────────────────────
    public function catalog(): void
    {
        require __DIR__ . "/../views/client/catalog.php";
    }

    // ── My Borrowed Books ──────────────────────────────────────────────────
    public function borrowed(): void
    {
        require __DIR__ . "/../views/client/my_borrowed.php";
    }

    // ── My Borrow History ──────────────────────────────────────────────────
    public function history(): void
    {
        require __DIR__ . "/../views/client/my_history.php";
    }
}