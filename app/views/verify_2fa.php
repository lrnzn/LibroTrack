<?php if (!defined("LIBROTRACK")) { header("Location: /librotrack/public/index.php?controller=Auth&action=login"); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibroTrack — Verify 2FA</title>
    <link rel="stylesheet" href="/librotrack/public/assets/css/login.css">
    <link rel="stylesheet" href="/librotrack/public/assets/css/twofa.css">
</head>
<body>
<div class="page-wrapper">

    <div class="left-panel">
        <img src="/librotrack/public/assets/img/logo.gif" alt="LibroTrack" class="brand-icon">
        <h1>LibroTrack</h1>
        <p>Your campus library, organized and at your fingertips.</p>
    </div>

    <div class="right-panel">
        <div class="login-card twofa-card">

            <div class="twofa-icon">📱</div>
            <h2>Two-Factor Authentication</h2>
            <p class="subtitle">Open your authenticator app and enter the 6-digit code.</p>

            <?php if (!empty($error)): ?>
                <div class="login-error">
                    <span class="login-error-icon">⚠️</span>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form action="/librotrack/public/index.php?controller=Auth&action=processVerify" method="POST">
                <div class="form-group">
                    <label>6-Digit Code *</label>
                    <input type="text" name="otp_code" class="otp-input"
                           placeholder="000000" maxlength="6"
                           autocomplete="one-time-code" autofocus required>
                </div>
                <button type="submit" class="login-btn">🔓 Verify &amp; Sign In</button>
            </form>

            <div class="twofa-hint">
                <p>🔒 Code refreshes every 30 seconds.</p>
                <p>Having trouble? Contact your system administrator.</p>
            </div>

            <a href="/librotrack/public/index.php?controller=Auth&action=login"
               style="display:block;text-align:center;margin-top:1rem;font-size:0.85rem;color:var(--text-muted);">
               ← Back to Login
            </a>

        </div>
    </div>
</div>
</body>
</html>