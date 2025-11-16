<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - App Permissions Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Same CSS as above */
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-shield-alt logo-icon"></i>
                    <span>EchoGuard</span>
                </div>
                
                <nav>
                    <ul>
                        <li><a href="index.php" <?php echo ($currentPage == 'index.php') ? 'class="active"' : ''; ?>>Dashboard</a></li>
                        <li><a href="app.php" <?php echo ($currentPage == 'app.php') ? 'class="active"' : ''; ?>>App Permissions</a></li>
                        <li><a href="timeline.php" <?php echo ($currentPage == 'timeline.php') ? 'class="active"' : ''; ?>>Data Timeline</a></li>
                        <li><a href="threatanalysis.php" <?php echo ($currentPage == 'threatanalysis.php') ? 'class="active"' : ''; ?>>Threat Alerts</a></li>
                        <li><a href="security simulation.php" <?php echo ($currentPage == 'security simulation.php') ? 'class="active"' : ''; ?>>Security Simulation</a></li>
                        <li><a href="settings.php" <?php echo ($currentPage == 'settings.php') ? 'class="active"' : ''; ?>>Settings</a></li>
                    </ul>
                </nav>
                
                <div class="header-actions">
                    <button class="btn btn-primary">
                        <i class="fas fa-bolt"></i>
                        Run Scan
                    </button>
                    <button class="btn btn-danger">
                        <i class="fas fa-lock"></i>
                        Lockdown
                    </button>
                </div>
            </div>
        </div>
    </header>