<?php

require_once __DIR__ . "/../models/Dashboard.php";

class DashboardController
{
    private Dashboard $dashboard;

    public function __construct()
    {
        $this->dashboard = new Dashboard();
    }

    public function index(): void
    {
        $stats        = $this->dashboard->getStats();
        $stats        = array_merge(
            ['total_books' => 0, 'available_copies' => 0, 'currently_borrowed' => 0, 'overdue' => 0, 'total_borrowers' => 0],
            $stats
        );
        $transactions = $this->dashboard->getRecentTransactions();
        $overdueBooks = $this->dashboard->getOverdueBooks();

        require __DIR__ . "/../views/admin/dashboard.php";
    }
}