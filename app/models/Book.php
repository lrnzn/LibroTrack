<?php

require_once __DIR__ . "/../../config/database.php";

class Book
{
    private mysqli $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // ── READ: Get all books with available copies ──────────────────────────
    public function getAll(string $search = '', string $genre = '', string $status = ''): array
    {
        $conditions = ["1=1"];
        $params     = [];
        $types      = '';

        if ($search !== '') {
            $conditions[] = "(b.title LIKE ? OR b.author LIKE ? OR b.isbn LIKE ?)";
            $like = "%{$search}%";
            array_push($params, $like, $like, $like);
            $types .= 'sss';
        }

        if ($genre !== '') {
            $conditions[] = "b.genre = ?";
            $params[]      = $genre;
            $types        .= 's';
        }

        $where = implode(' AND ', $conditions);

        $havingClause = '';
        if ($status === 'available') {
            $havingClause = 'HAVING available > 0';
        } elseif ($status === 'borrowed') {
            $havingClause = 'HAVING available = 0';
        }

        $sql = "
            SELECT
                b.bookID,
                b.title,
                b.author,
                b.isbn,
                b.genre,
                b.copies,
                b.location,
                b.description,
                b.dateAdded,
                (b.copies - COALESCE(
                    (SELECT COUNT(*) FROM tbl_transaction t
                     WHERE t.bookID = b.bookID AND t.status = 'borrowed'), 0
                )) AS available
            FROM tbl_books b
            WHERE {$where}
            {$havingClause}
            ORDER BY b.dateAdded DESC
        ";

        $stmt = $this->db->prepare($sql);
        if ($params) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // ── READ: Get single book by ID ────────────────────────────────────────
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT b.*,
                (b.copies - COALESCE(
                    (SELECT COUNT(*) FROM tbl_transaction t
                     WHERE t.bookID = b.bookID AND t.status = 'borrowed'), 0
                )) AS available
            FROM tbl_books b
            WHERE b.bookID = ?
        ");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    // ── READ: Get all distinct genres ─────────────────────────────────────
    public function getGenres(): array
    {
        $result = $this->db->query("SELECT DISTINCT genre FROM tbl_books ORDER BY genre");
        return array_column($result->fetch_all(MYSQLI_ASSOC), 'genre');
    }

    // ── READ: Stats counts ─────────────────────────────────────────────────
    public function getStats(): array
    {
        $row = $this->db->query("
            SELECT
                COUNT(*) AS total_books,
                SUM(copies) AS total_copies,
                (SELECT COUNT(*) FROM tbl_transaction WHERE status = 'borrowed') AS currently_borrowed
            FROM tbl_books
        ")->fetch_assoc();
        $row['available_copies'] = (int)$row['total_copies'] - (int)$row['currently_borrowed'];
        return $row;
    }

    // ── CREATE ─────────────────────────────────────────────────────────────
    public function create(array $data): bool|string
    {
        if (!empty($data['isbn'])) {
            $chk = $this->db->prepare("SELECT bookID FROM tbl_books WHERE isbn = ?");
            $chk->bind_param('s', $data['isbn']);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                return "A book with this ISBN already exists.";
            }
        }

        $title    = trim($data['title']);
        $author   = trim($data['author']);
        $isbn     = !empty($data['isbn'])        ? trim($data['isbn'])        : null;
        $genre    = trim($data['genre']);
        $copies   = (int) $data['copies'];
        $location = !empty($data['location'])    ? trim($data['location'])    : null;
        $desc     = !empty($data['description']) ? trim($data['description']) : null;

        $stmt = $this->db->prepare(
            "INSERT INTO tbl_books (title, author, isbn, genre, copies, location, description)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssssiss', $title, $author, $isbn, $genre, $copies, $location, $desc);
        return $stmt->execute() ? true : $this->db->error;
    }

    // ── UPDATE ─────────────────────────────────────────────────────────────
    public function update(int $id, array $data): bool|string
    {
        if (!empty($data['isbn'])) {
            $chk = $this->db->prepare("SELECT bookID FROM tbl_books WHERE isbn = ? AND bookID != ?");
            $chk->bind_param('si', $data['isbn'], $id);
            $chk->execute();
            if ($chk->get_result()->num_rows > 0) {
                return "Another book already uses this ISBN.";
            }
        }

        // Guard: copies cannot be less than currently borrowed
        $chk2 = $this->db->prepare(
            "SELECT COUNT(*) AS cnt FROM tbl_transaction WHERE bookID = ? AND status = 'borrowed'"
        );
        $chk2->bind_param('i', $id);
        $chk2->execute();
        $borrowed = (int) $chk2->get_result()->fetch_assoc()['cnt'];
        if ((int)$data['copies'] < $borrowed) {
            return "Cannot set copies to {$data['copies']} — {$borrowed} " .
                   ($borrowed === 1 ? 'copy is' : 'copies are') . " currently borrowed.";
        }

        $title    = trim($data['title']);
        $author   = trim($data['author']);
        $isbn     = !empty($data['isbn'])        ? trim($data['isbn'])        : null;
        $genre    = trim($data['genre']);
        $copies   = (int) $data['copies'];
        $location = !empty($data['location'])    ? trim($data['location'])    : null;
        $desc     = !empty($data['description']) ? trim($data['description']) : null;

        $stmt = $this->db->prepare(
            "UPDATE tbl_books
             SET title=?, author=?, isbn=?, genre=?, copies=?, location=?, description=?
             WHERE bookID=?"
        );
        $stmt->bind_param('ssssissi', $title, $author, $isbn, $genre, $copies, $location, $desc, $id);
        return $stmt->execute() ? true : $this->db->error;
    }

    // ── DELETE ─────────────────────────────────────────────────────────────
    public function delete(int $id): bool|string
    {
        $chk = $this->db->prepare(
            "SELECT COUNT(*) AS cnt FROM tbl_transaction WHERE bookID = ? AND status = 'borrowed'"
        );
        $chk->bind_param('i', $id);
        $chk->execute();
        $cnt = (int) $chk->get_result()->fetch_assoc()['cnt'];
        if ($cnt > 0) {
            return "Cannot delete — {$cnt} " . ($cnt === 1 ? 'copy is' : 'copies are') . " currently borrowed.";
        }

        $stmt = $this->db->prepare("DELETE FROM tbl_books WHERE bookID = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute() ? true : $this->db->error;
    }
}