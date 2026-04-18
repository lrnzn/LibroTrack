<?php

require_once __DIR__ . "/../models/User.php";

class AuthController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    // ── SHOW: Login page ──────────────────────────────────────────────────
    public function login(): void
    {
        require __DIR__ . "/../views/login.php";
    }

    // ── HANDLE: Login form submission ─────────────────────────────────────
    public function authenticate(): void
    {
        $role     = $_POST['role'] ?? 'librarian';
        $password = $_POST['password'] ?? '';

        // Student role uses student_id field, librarian uses username field
        $username = $role === 'student'
            ? trim($_POST['student_id'] ?? '')
            : trim($_POST['username']   ?? '');

        if (empty($username) || empty($password)) {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=login&error=" .
                urlencode("Please fill in all fields."));
        }

        // For students, also allow login by student number
        if ($role === 'student') {
            $user = $this->user->authenticateStudent($username, $password);
        } else {
            $user = $this->user->authenticate($username, $password);
        }

        if (!$user) {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=login&error=" .
                urlencode("Invalid username or password."));
        }

        // Role mismatch — student trying librarian tab or vice versa
        $expectedRole = $role === 'student' ? 'student' : 'admin';
        if ($user['role'] !== $expectedRole) {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=login&error=" .
                urlencode("Invalid username or password."));
        }

        session_start();
        $_SESSION['userID']   = $user['userID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];
        $_SESSION['name']     = $user['name'];

        if ($user['role'] === 'admin') {
            $this->redirect("/librotrack/public/index.php?controller=Dashboard&action=index");
        } else {
            $this->redirect("/librotrack/public/index.php?controller=Student&action=index");
        }
    }

    // ── SHOW: Register page ───────────────────────────────────────────────
    public function register(): void
    {
        require __DIR__ . "/../views/signup.php";
    }

    // ── HANDLE: Signup form submission ────────────────────────────────────
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=register");
        }

        require_once __DIR__ . "/../models/Student.php";

        // Basic validation
        $required = ['fname', 'lname', 'studentNumber', 'course', 'email', 'username', 'password', 'confirm_password'];
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                $this->redirect("/librotrack/public/index.php?controller=Auth&action=register&error=" .
                    urlencode("Please fill in all required fields."));
            }
        }

        if ($_POST['password'] !== $_POST['confirm_password']) {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=register&error=" .
                urlencode("Passwords do not match."));
        }

        // Re-use Student model for creation (handles user + student records)
        $student = new Student();
        $data    = [
            'fname'         => $_POST['fname'],
            'mname'         => $_POST['mname']         ?? '',
            'lname'         => $_POST['lname'],
            'nameExt'       => $_POST['nameExt']       ?? '',
            'studentNumber' => $_POST['studentNumber'],
            'course'        => $_POST['course'],
            'email'         => $_POST['email'],
        ];

        // Override the auto-generated username with the one the student chose
        $result = $student->createWithUsername($data, $_POST['username'], $_POST['password']);

        if ($result === true) {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=login&error=" .
                urlencode("Account created successfully! You can now sign in."));
        } else {
            $this->redirect("/librotrack/public/index.php?controller=Auth&action=register&error=" .
                urlencode($result));
        }
    }

    // ── HANDLE: Logout ────────────────────────────────────────────────────
    public function logout(): void
    {
        session_start();
        session_destroy();
        $this->redirect("/librotrack/public/index.php?controller=Auth&action=login");
    }

    // ── Helper: redirect ──────────────────────────────────────────────────
    private function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}