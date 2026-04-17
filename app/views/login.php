<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Login</title>
    <link rel="stylesheet" href="../../public/assets/css/login.css">
</head>
<body>
<div class="page-wrapper">

    <!-- Left Panel -->
    <div class="left-panel">
        <img src="../../public/assets/img/logo.gif" alt="LibroTrack Logo" class="brand-icon">
        <h1>LibroTrack</h1>
        <p>Your campus library,<br>organized and at your fingertips.</p>
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="login-card">

            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to continue to LibroTrack</p>

            <!-- Role Selector -->
            <div class="role-selector">
                <button class="role-btn active" id="btn-librarian" onclick="selectRole('librarian')">🏛️ Librarian</button>
                <button class="role-btn" id="btn-student" onclick="selectRole('student')">🎓 Student</button>
            </div>

            <!-- Login Form -->
            <form onsubmit="handleLogin(event)">
                <input type="hidden" id="role-input" value="librarian">
                <input type="hidden" name="role" id="role-input" value="librarian">

                <div id="librarian-fields" class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="off">
                </div>

                <div id="student-fields" class="form-group" style="display:none;">
                    <label for="student-id">Student ID</label>
                    <input type="text" id="student-id" name="student_id" placeholder="e.g. 2021-00123" autocomplete="off">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                        <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
                    </div>
                </div>

                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <p id="register-prompt" class="register-prompt" style="display:none;">
                Don't have an account? <a href="signup.php">Register here</a>
            </p>

        </div>
    </div>

</div>
<script>
    function selectRole(role) {
        const isLibrarian = role === 'librarian';
        document.getElementById('role-input').value = role;
        document.getElementById('btn-librarian').classList.toggle('active', isLibrarian);
        document.getElementById('btn-student').classList.toggle('active', !isLibrarian);
        document.getElementById('librarian-fields').style.display = isLibrarian ? 'block' : 'none';
        document.getElementById('student-fields').style.display = isLibrarian ? 'none' : 'block';
        document.getElementById('register-prompt').style.display = isLibrarian ? 'none' : 'block';
    }

    function togglePassword() {
        const input = document.getElementById('password');
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function handleLogin(e) {
        e.preventDefault();
        const role = document.getElementById('role-input').value;
        if (role === 'librarian') {
            window.location.href = 'admin/dashboard.php';
        } else {
            window.location.href = 'client/dashboard.php';
        }
    }
</script>
</body>
</html>