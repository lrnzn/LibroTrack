<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Sign Up</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
</head>
<body>

<div class="page-wrapper">

    <div class="left-panel">
        <img src="../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <h1>LibroTrack</h1>
        <p>Manage your library with ease. Track books, borrowers, and transactions in one place.</p>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">

        <div class="login-card">
            <h2>Create Account</h2>
            <p class="subtitle">Sign up to access the library system</p>

            <form action="/LibroTrack/public/index.php?controller=Auth&action=register" method="POST">

                <!-- Student Info -->
                
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="Enter your first name" required>
                    </div>

                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" name="mname" placeholder="Enter your middle name">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Enter your last name" required>
                    </div>

                    <div class="form-group">
                        <label>Ext.</label>
                        <input type="text" name="nameExt" placeholder="Ex: Jr.">
                    </div>
                </div>

                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" placeholder="Enter your student ID" required>
                </div>

                <div class="form-group">
                    <label>Course / Year</label>
                    <input type="text" name="course_year" placeholder="e.g. BSIT - 2nd Year">
                </div>

                <!-- Account Info -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Choose a username" required>
                </div>

                <div class="form-group password-wrapper">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="form-group password-wrapper">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm password" required>
                </div>

                <button type="submit" class="login-btn">Sign Up</button>

                <div class="register-prompt">
                    Already have an account?
                    <a href="login.php">Login</a>
                </div>

            </form>
        </div>

    </div>

</div>

</body>
</html>