<?php

require_once __DIR__ . "/../models/Report.php";

class ReportController
{
    private Report $report;

    public function __construct()
    {
        $this->report = new Report();
    }

    public function index(): void
    {
        $month  = $_GET['month'] ?? '';
        $year   = $_GET['year']  ?? '';

        $stats          = $this->report->getStats($month, $year);
        $mostBorrowed   = $this->report->getMostBorrowed(5, $month, $year);
        $topBorrowers   = $this->report->getTopBorrowers(5, $month, $year);
        $byGenre        = $this->report->getBorrowsByGenre();
        $availableMonths = $this->report->getAvailableMonths();

        $stats = array_merge(
            ['total_transactions' => 0, 'total_books' => 0, 'total_borrowers' => 0, 'total_penalties' => 0],
            $stats
        );

        require __DIR__ . "/../views/admin/reports.php";
    }
}
