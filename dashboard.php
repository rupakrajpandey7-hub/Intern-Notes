<?php
// Start session to check if the user is logged in
session_start();

// Simple check if user is authenticated
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: staff-login.php");
    exit;
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netanix CTF - Dashboard | Intern Notes Challenge</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .dashboard-container { max-width: 1000px; margin: 50px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .header { border-bottom: 2px solid #2c3e50; padding-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .header h1 { margin: 0; color: #2c3e50; }
        .logout-btn { background-color: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .logout-btn:hover { background-color: #c0392b; }
        .flag-box { margin-top: 40px; padding: 30px; background-color: #d4edda; border: 2px dashed #28a745; border-radius: 8px; text-align: center; }
        .flag-box h3 { margin: 0 0 15px 0; color: #155724; }
        .flag-text { font-family: 'Courier New', Courier, monospace; font-size: 1.5rem; color: #155724; font-weight: bold; background: white; padding: 10px 20px; border-radius: 5px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.1); }
        .welcome-msg { margin-top: 30px; font-size: 1.1rem; color: #34495e; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div style="text-align: center; margin-bottom: 20px; color: #7f8c8d; font-size: 0.9rem;">
            <strong>Netanix CTF Platform</strong> | Intern Notes Challenge
        </div>
        <div class="header">
            <h1>Netanix CTF - Staff Dashboard</h1>
            <a href="?logout=1" class="logout-btn">Logout</a>
        </div>

        <div class="welcome-msg">
            <p>Welcome, <strong>tester</strong>. You have successfully logged into the Netanix CTF internal management portal.</p>
            <p>You have completed the reconnaissance phase of the "Intern Notes" challenge. By discovering the hidden development notes and using the exposed credentials, you have successfully exploited a common security misconfiguration.</p>
        </div>

        <div class="flag-box">
            <h3>Congratulations! Netanix CTF Challenge Solved.</h3>
            <p style="color: #155724; margin: 15px 0;">You have successfully completed the "Intern Notes" challenge on the Netanix CTF platform.</p>
            <div class="flag-text">softwarica{dont_leave_dev_notes_public}</div>
            <p style="color: #155724; margin-top: 15px; font-size: 0.9rem;"><strong>Hosted on Netanix Servers</strong></p>
        </div>
    </div>
</body>
</html>
