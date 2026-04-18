<?php

class AuthController
{
    // SHOW LOGIN PAGE
    public function login()
    {
        require "../app/views/login.php";
    }

    // HANDLE LOGIN (TEMPORARY - NO DATABASE YET)
    public function authenticate()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // TEMPORARY LOGIN (for testing)
        if ($username === 'admin' && $password === 'admin123') {
            // redirect to book catalog
            header("Location: /LibroTrack/public/index.php?controller=Book&action=index");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    }

    // SHOW SIGNUP PAGE
    public function register()
    {
        require "../app/views/signup.php";
    }

    // HANDLE SIGNUP (TEMPORARY - NO DATABASE YET)
    public function store()
    {
        $fname = $_POST['fname'] ?? '';
        $lname = $_POST['lname'] ?? '';
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Simple validation
        if (empty($fname) || empty($lname) || empty($username) || empty($password)) {
            echo "Please fill in all required fields.";
            return;
        }

        // TEMP: just confirm success (no DB yet)
        echo "Account created successfully! (not yet saved to database)";

        // redirect to login after 2 seconds
        header("refresh:2; url=/LibroTrack/public/index.php?controller=Auth&action=login");
    }

    // LOGOUT
    public function logout()
    {
        // later you will destroy session
        header("Location: /LibroTrack/public/index.php?controller=Auth&action=login");
        exit;
    }
}