<?php
// Start a simple session for the challenge
session_start();

// Hardcoded credentials as per the challenge logic
$valid_username = "tester";
$valid_password = "Test@123";

$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simple credential check
    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netanix CTF - Staff Portal Login</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #ecf0f1; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-card h2 { text-align: center; color: #2c3e50; margin-bottom: 30px; }
        .login-card input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .login-card button { width: 100%; padding: 12px; background-color: #2c3e50; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; }
        .login-card button:hover { background-color: #34495e; }
        .error { color: #e74c3c; text-align: center; margin-bottom: 15px; font-size: 0.9rem; }
        .back-home { display: block; text-align: center; margin-top: 20px; color: #7f8c8d; text-decoration: none; font-size: 0.8rem; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Netanix CTF - Staff Portal</h2>
        <p style="text-align: center; color: #7f8c8d; font-size: 0.9rem; margin-bottom: 20px;">Intern Notes Challenge | Powered by Netanix Servers</p>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <a href="index.php" class="back-home">Return to Homepage</a>
    </div>
</body>
</html>
