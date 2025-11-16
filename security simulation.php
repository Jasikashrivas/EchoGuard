<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - Security Simulation Center</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #0a84ff;
            --primary-dark: #0066cc;
            --secondary: #8e44ad;
            --danger: #ff375f;
            --warning: #ff9f0a;
            --success: #30d158;
            --dark: #121212;
            --darker: #0a0a0a;
            --dark-card: #1e1e1e;
            --text: #ffffff;
            --text-secondary: #a0a0a0;
            --border: #2c2c2e;
            --cyber-glow: 0 0 10px rgba(10, 132, 255, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--darker);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .cyber-grid {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(18, 18, 18, 0.9) 1px, transparent 1px),
                linear-gradient(90deg, rgba(18, 18, 18, 0.9) 1px, transparent 1px);
            background-size: 20px 20px;
            z-index: -1;
            opacity: 0.3;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: rgba(18, 18, 18, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text);
        }

        .logo-icon {
            color: var(--primary);
            animation: pulse 2s infinite;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 25px;
        }

        nav a {
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            position: relative;
        }

        nav a:hover, nav a.active {
            color: var(--text);
        }

        nav a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--primary);
            box-shadow: var(--cyber-glow);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: var(--cyber-glow);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #e00034;
            transform: translateY(-2px);
        }

        /* Page Header */
        .page-header {
            margin: 30px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
        }

        .page-subtitle {
            color: var(--text-secondary);
            margin-top: 5px;
        }

        /* Simulation Stats */
        .simulation-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .stat-icon.completed {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .stat-icon.score {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .stat-icon.accuracy {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .stat-icon.rank {
            background-color: rgba(142, 68, 173, 0.2);
            color: var(--secondary);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        /* Simulation Modules */
        .simulation-modules {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .module-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .module-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
        }

        .module-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .module-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .module-difficulty {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .difficulty-easy {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .difficulty-medium {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .difficulty-hard {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .module-desc {
            color: var(--text-secondary);
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .module-progress {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .progress-bar {
            flex: 1;
            height: 6px;
            background-color: var(--border);
            border-radius: 3px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 3px;
            background-color: var(--primary);
            width: 0%;
            transition: width 0.5s;
        }

        .progress-text {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .module-actions {
            display: flex;
            gap: 10px;
        }

        .module-btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-align: center;
            font-size: 0.9rem;
        }

        .module-btn.primary {
            background-color: var(--primary);
            color: white;
        }

        .module-btn.primary:hover {
            background-color: var(--primary-dark);
        }

        .module-btn.secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text);
        }

        .module-btn.secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Active Simulation */
        .active-simulation {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid var(--border);
            margin-bottom: 30px;
            display: none;
        }

        .active-simulation.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .simulation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .simulation-title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .simulation-close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: all 0.3s;
        }

        .simulation-close:hover {
            background-color: var(--danger);
        }

        .simulation-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .scenario-description {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            padding: 20px;
        }

        .scenario-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .scenario-text {
            color: var(--text-secondary);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .scenario-objectives {
            margin-top: 20px;
        }

        .objective-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .objective-check {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            font-size: 0.7rem;
        }

        .objective-check.completed {
            background-color: var(--success);
            color: white;
        }

        .interactive-area {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .simulation-prompt {
            background-color: rgba(18, 18, 18, 0.8);
            border-radius: 8px;
            padding: 20px;
            border: 1px solid var(--border);
        }

        .prompt-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .prompt-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .prompt-icon.system {
            background: linear-gradient(135deg, #0984e3, #74b9ff);
        }

        .prompt-icon.app {
            background: linear-gradient(135deg, #e17055, #fdcb6e);
        }

        .prompt-icon.malicious {
            background: linear-gradient(135deg, #ff375f, #e00034);
        }

        .prompt-title {
            font-weight: 600;
        }

        .prompt-text {
            color: var(--text-secondary);
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .action-btn.allow {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .action-btn.allow:hover {
            background-color: rgba(48, 209, 88, 0.3);
        }

        .action-btn.deny {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .action-btn.deny:hover {
            background-color: rgba(255, 55, 95, 0.3);
        }

        .action-btn.monitor {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .action-btn.monitor:hover {
            background-color: rgba(10, 132, 255, 0.3);
        }

        .action-btn.sandbox {
            background-color: rgba(142, 68, 173, 0.2);
            color: var(--secondary);
        }

        .action-btn.sandbox:hover {
            background-color: rgba(142, 68, 173, 0.3);
        }

        .simulation-feedback {
            background-color: rgba(18, 18, 18, 0.8);
            border-radius: 8px;
            padding: 20px;
            border: 1px solid var(--border);
            display: none;
        }

        .simulation-feedback.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .feedback-title {
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .feedback-title.correct {
            color: var(--success);
        }

        .feedback-title.incorrect {
            color: var(--danger);
        }

        .feedback-text {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .feedback-stats {
            display: flex;
            gap: 15px;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            flex: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .simulation-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Leaderboard */
        .leaderboard {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .leaderboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .leaderboard-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .leaderboard-tabs {
            display: flex;
            gap: 10px;
        }

        .tab-btn {
            padding: 8px 16px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .tab-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .tab-btn:hover {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--text);
        }

        .leaderboard-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
            transition: background-color 0.3s;
        }

        .leaderboard-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .leaderboard-rank {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .rank-1 {
            background-color: rgba(255, 215, 0, 0.2);
            color: gold;
        }

        .rank-2 {
            background-color: rgba(192, 192, 192, 0.2);
            color: silver;
        }

        .rank-3 {
            background-color: rgba(205, 127, 50, 0.2);
            color: #cd7f32;
        }

        .rank-other {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .user-stats {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .user-score {
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .module-card {
            animation: slideIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .simulation-content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 992px) {
            .simulation-modules {
                grid-template-columns: 1fr;
            }
            
            .simulation-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .simulation-stats {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .feedback-stats {
                flex-direction: column;
            }
            
            nav ul {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    
    <?php include('header.php'); ?>
    
    <main class="container">
        <div class="page-header">
            <div>
                <h1 class="page-title">Security Simulation Center</h1>
                <p class="page-subtitle">Test your security skills with interactive attack scenarios</p>
            </div>
            <div>
                <button class="btn btn-primary" id="resetProgressBtn">
                    <i class="fas fa-redo"></i>
                    Reset Progress
                </button>
            </div>
        </div>
        
        <div class="simulation-stats">
            <div class="stat-card">
                <div class="stat-icon completed">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-value">3/6</div>
                <div class="stat-label">Simulations Completed</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon score">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-value">82%</div>
                <div class="stat-label">Overall Score</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon accuracy">
                    <i class="fas fa-bullseye"></i>
                </div>
                <div class="stat-value">76%</div>
                <div class="stat-label">Threat Detection Accuracy</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon rank">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-value">#42</div>
                <div class="stat-label">Global Rank</div>
            </div>
        </div>
        
        <div class="simulation-modules">
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-fish"></i>
                        Phishing Permission Simulator
                    </h3>
                    <div class="module-difficulty difficulty-easy">Easy</div>
                </div>
                <p class="module-desc">
                    Identify fake permission prompts designed to trick users into granting unnecessary access.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 100%"></div>
                    </div>
                    <div class="progress-text">Completed</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="phishing">
                        <i class="fas fa-play"></i>
                        Start Simulation
                    </button>
                    <button class="module-btn secondary">
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
            
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-network-wired"></i>
                        Data Exfiltration Scenario
                    </h3>
                    <div class="module-difficulty difficulty-medium">Medium</div>
                </div>
                <p class="module-desc">
                    Detect and prevent unauthorized data transfers from your device to external servers.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 100%"></div>
                    </div>
                    <div class="progress-text">Completed</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="exfiltration">
                        <i class="fas fa-play"></i>
                        Start Simulation
                    </button>
                    <button class="module-btn secondary">
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
            
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-download"></i>
                        Malicious Update Scenario
                    </h3>
                    <div class="module-difficulty difficulty-medium">Medium</div>
                </div>
                <p class="module-desc">
                    Identify apps that request suspicious new permissions after an update.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 50%"></div>
                    </div>
                    <div class="progress-text">In Progress</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="malicious-update">
                        <i class="fas fa-play"></i>
                        Continue
                    </button>
                    <button class="module-btn secondary">
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
            
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-fingerprint"></i>
                        Sensor Fingerprinting Attack
                    </h3>
                    <div class="module-difficulty difficulty-hard">Hard</div>
                </div>
                <p class="module-desc">
                    Detect apps that use sensor data to create a unique device fingerprint.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>
                    <div class="progress-text">Not Started</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="fingerprinting">
                        <i class="fas fa-play"></i>
                        Start Simulation
                    </button>
                    <button class="module-btn secondary" disabled>
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
            
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-mobile-alt"></i>
                        Fake App vs Real App Test
                    </h3>
                    <div class="module-difficulty difficulty-medium">Medium</div>
                </div>
                <p class="module-desc">
                    Distinguish between legitimate apps and malicious clones with similar appearances.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 100%"></div>
                    </div>
                    <div class="progress-text">Completed</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="fake-app">
                        <i class="fas fa-play"></i>
                        Start Simulation
                    </button>
                    <button class="module-btn secondary">
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
            
            <div class="module-card">
                <div class="module-header">
                    <h3 class="module-title">
                        <i class="fas fa-broadcast-tower"></i>
                        Live Breach Simulation
                    </h3>
                    <div class="module-difficulty difficulty-hard">Hard</div>
                </div>
                <p class="module-desc">
                    Experience a simulated real-time security breach and practice containment.
                </p>
                <div class="module-progress">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>
                    <div class="progress-text">Not Started</div>
                </div>
                <div class="module-actions">
                    <button class="module-btn primary" data-module="breach">
                        <i class="fas fa-play"></i>
                        Start Simulation
                    </button>
                    <button class="module-btn secondary" disabled>
                        <i class="fas fa-chart-bar"></i>
                        View Results
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Active Simulation Area -->
        <div class="active-simulation" id="activeSimulation">
            <div class="simulation-header">
                <h2 class="simulation-title" id="simulationTitle">
                    <i class="fas fa-fish"></i>
                    Phishing Permission Simulator
                </h2>
                <div class="simulation-close" id="closeSimulation">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            
            <div class="simulation-content">
                <div class="scenario-description">
                    <h3 class="scenario-title">
                        <i class="fas fa-info-circle"></i>
                        Scenario Description
                    </h3>
                    <p class="scenario-text" id="scenarioText">
                        You're using a flashlight app when suddenly it requests access to your contacts. 
                        The prompt looks legitimate but seems unnecessary for the app's functionality.
                    </p>
                    
                    <div class="scenario-objectives">
                        <h4 class="scenario-title">
                            <i class="fas fa-bullseye"></i>
                            Learning Objectives
                        </h4>
                        <div class="objective-item">
                            <div class="objective-check" id="obj1">1</div>
                            <div>Identify unnecessary permission requests</div>
                        </div>
                        <div class="objective-item">
                            <div class="objective-check" id="obj2">2</div>
                            <div>Understand app functionality vs permission requirements</div>
                        </div>
                        <div class="objective-item">
                            <div class="objective-check" id="obj3">3</div>
                            <div>Practice safe permission granting habits</div>
                        </div>
                    </div>
                </div>
                
                <div class="interactive-area">
                    <div class="simulation-prompt">
                        <div class="prompt-header">
                            <div class="prompt-icon app" id="promptIcon">FL</div>
                            <div>
                                <div class="prompt-title" id="promptApp">FlashLight+</div>
                                <div class="prompt-text" id="promptText">
                                    FlashLight+ would like to access your contacts
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button class="action-btn allow" data-action="allow">Allow</button>
                            <button class="action-btn deny" data-action="deny">Deny</button>
                            <button class="action-btn monitor" data-action="monitor">Monitor</button>
                            <button class="action-btn sandbox" data-action="sandbox">Sandbox</button>
                        </div>
                    </div>
                    
                    <div class="simulation-feedback" id="simulationFeedback">
                        <h3 class="feedback-title correct" id="feedbackTitle">
                            <i class="fas fa-check-circle"></i>
                            Correct Decision!
                        </h3>
                        <p class="feedback-text" id="feedbackText">
                            You correctly identified that a flashlight app doesn't need access to your contacts. 
                            Granting this permission could allow the app to harvest your contact list for spam or phishing attacks.
                        </p>
                        
                        <div class="feedback-stats">
                            <div class="stat-item">
                                <div class="stat-value">+25</div>
                                <div class="stat-label">Points</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">1/3</div>
                                <div class="stat-label">Objectives</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">82%</div>
                                <div class="stat-label">Accuracy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="simulation-controls">
                <button class="btn" id="prevScenario">
                    <i class="fas fa-arrow-left"></i>
                    Previous
                </button>
                <div class="simulation-progress">
                    Scenario <span id="currentScenario">1</span> of <span id="totalScenarios">5</span>
                </div>
                <button class="btn btn-primary" id="nextScenario">
                    Next Scenario
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        
        <div class="leaderboard">
            <div class="leaderboard-header">
                <h3 class="leaderboard-title">
                    <i class="fas fa-trophy"></i>
                    Simulation Leaderboard
                </h3>
                <div class="leaderboard-tabs">
                    <button class="tab-btn active">Global</button>
                    <button class="tab-btn">Friends</button>
                    <button class="tab-btn">This Week</button>
                </div>
            </div>
            
            <div class="leaderboard-list">
                <div class="leaderboard-item">
                    <div class="leaderboard-rank rank-1">1</div>
                    <div class="user-avatar">SK</div>
                    <div class="user-info">
                        <div class="user-name">SecurityKing</div>
                        <div class="user-stats">98% Accuracy • 6 Simulations</div>
                    </div>
                    <div class="user-score">950</div>
                </div>
                
                <div class="leaderboard-item">
                    <div class="leaderboard-rank rank-2">2</div>
                    <div class="user-avatar">PD</div>
                    <div class="user-info">
                        <div class="user-name">PrivacyDefender</div>
                        <div class="user-stats">95% Accuracy • 6 Simulations</div>
                    </div>
                    <div class="user-score">920</div>
                </div>
                
                <div class="leaderboard-item">
                    <div class="leaderboard-rank rank-3">3</div>
                    <div class="user-avatar">GS</div>
                    <div class="user-info">
                        <div class="user-name">GuardianShield</div>
                        <div class="user-stats">93% Accuracy • 5 Simulations</div>
                    </div>
                    <div class="user-score">890</div>
                </div>
                
                <div class="leaderboard-item">
                    <div class="leaderboard-rank rank-other">42</div>
                    <div class="user-avatar">YC</div>
                    <div class="user-info">
                        <div class="user-name">You</div>
                        <div class="user-stats">82% Accuracy • 3 Simulations</div>
                    </div>
                    <div class="user-score">720</div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Simulation data
        const simulationData = {
            phishing: {
                title: "Phishing Permission Simulator",
                scenarios: [
                    {
                        appName: "FlashLight+",
                        appIcon: "FL",
                        iconType: "app",
                        prompt: "FlashLight+ would like to access your contacts",
                        correctAction: "deny",
                        feedback: {
                            correct: "You correctly identified that a flashlight app doesn't need access to your contacts. Granting this permission could allow the app to harvest your contact list for spam or phishing attacks.",
                            incorrect: "A flashlight app requesting contacts access is highly suspicious. This is a common tactic used by malicious apps to harvest personal information."
                        }
                    },
                    {
                        appName: "System Update",
                        appIcon: "SU",
                        iconType: "system",
                        prompt: "System update requires access to your SMS messages to verify your identity",
                        correctAction: "deny",
                        feedback: {
                            correct: "Correct! Legitimate system updates never request SMS access for identity verification. This is a phishing attempt to read your private messages.",
                            incorrect: "This is a phishing attempt. System updates don't require SMS access. The attacker is trying to read your private messages."
                        }
                    },
                    {
                        appName: "PhotoEditor Pro",
                        appIcon: "PE",
                        iconType: "app",
                        prompt: "PhotoEditor Pro needs microphone access for voice commands",
                        correctAction: "monitor",
                        feedback: {
                            correct: "Good choice! While some photo editors might legitimately use voice commands, it's best to monitor this permission first to ensure it's only used when needed.",
                            incorrect: "While voice commands could be legitimate, photo editors typically don't need microphone access. It's safer to monitor or deny this permission."
                        }
                    }
                ]
            },
            exfiltration: {
                title: "Data Exfiltration Scenario",
                scenarios: [
                    {
                        appName: "GameMaster Pro",
                        appIcon: "GM",
                        iconType: "app",
                        prompt: "GameMaster Pro is transmitting 45MB of data to an unknown server in the background",
                        correctAction: "sandbox",
                        feedback: {
                            correct: "Excellent! Sandboxing the app prevents data exfiltration while allowing you to investigate further. Games shouldn't transmit large amounts of data to unknown servers.",
                            incorrect: "This app is likely exfiltrating your data. Games typically don't need to send large amounts of data to unknown servers, especially in the background."
                        }
                    }
                ]
            },
            "malicious-update": {
                title: "Malicious Update Scenario",
                scenarios: [
                    {
                        appName: "WeatherEye",
                        appIcon: "WE",
                        iconType: "app",
                        prompt: "After update, WeatherEye now requests access to your camera and microphone",
                        correctAction: "deny",
                        feedback: {
                            correct: "Correct! A weather app suddenly requesting camera and microphone access after an update is highly suspicious. This could indicate malicious code was added.",
                            incorrect: "Weather apps don't need camera or microphone access. This update likely added surveillance capabilities to the app."
                        }
                    }
                ]
            }
        };

        // Current simulation state
        let currentModule = null;
        let currentScenarioIndex = 0;
        let score = 720;
        let completedObjectives = 0;

        // DOM Elements
        const activeSimulation = document.getElementById('activeSimulation');
        const simulationTitle = document.getElementById('simulationTitle');
        const scenarioText = document.getElementById('scenarioText');
        const promptApp = document.getElementById('promptApp');
        const promptText = document.getElementById('promptText');
        const promptIcon = document.getElementById('promptIcon');
        const simulationFeedback = document.getElementById('simulationFeedback');
        const feedbackTitle = document.getElementById('feedbackTitle');
        const feedbackText = document.getElementById('feedbackText');
        const currentScenarioEl = document.getElementById('currentScenario');
        const totalScenariosEl = document.getElementById('totalScenarios');
        const closeSimulationBtn = document.getElementById('closeSimulation');
        const nextScenarioBtn = document.getElementById('nextScenario');
        const prevScenarioBtn = document.getElementById('prevScenario');
        const resetProgressBtn = document.getElementById('resetProgressBtn');

        // Initialize the simulation center
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to module buttons
            document.querySelectorAll('.module-btn.primary').forEach(button => {
                button.addEventListener('click', function() {
                    const module = this.getAttribute('data-module');
                    startSimulation(module);
                });
            });

            // Add event listeners to action buttons
            document.querySelectorAll('.action-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.getAttribute('data-action');
                    handleUserAction(action);
                });
            });

            // Close simulation
            closeSimulationBtn.addEventListener('click', closeSimulation);

            // Navigation buttons
            nextScenarioBtn.addEventListener('click', nextScenario);
            prevScenarioBtn.addEventListener('click', prevScenario);

            // Reset progress
            resetProgressBtn.addEventListener('click', resetProgress);

            // Initialize objectives
            updateObjectives();
        });

        // Start a simulation
        function startSimulation(module) {
            currentModule = module;
            currentScenarioIndex = 0;
            completedObjectives = 0;
            
            // Update UI
            simulationTitle.innerHTML = `<i class="fas fa-${getModuleIcon(module)}"></i> ${simulationData[module].title}`;
            activeSimulation.classList.add('active');
            
            // Load first scenario
            loadScenario();
        }

        // Close the active simulation
        function closeSimulation() {
            activeSimulation.classList.remove('active');
            simulationFeedback.classList.remove('active');
            currentModule = null;
        }

        // Load the current scenario
        function loadScenario() {
            if (!currentModule) return;
            
            const scenarios = simulationData[currentModule].scenarios;
            const scenario = scenarios[currentScenarioIndex];
            
            // Update UI with scenario data
            promptApp.textContent = scenario.appName;
            promptText.textContent = scenario.prompt;
            promptIcon.textContent = scenario.appIcon;
            promptIcon.className = `prompt-icon ${scenario.iconType}`;
            
            // Update scenario text based on module
            updateScenarioText();
            
            // Update progress
            currentScenarioEl.textContent = currentScenarioIndex + 1;
            totalScenariosEl.textContent = scenarios.length;
            
            // Hide feedback
            simulationFeedback.classList.remove('active');
            
            // Update navigation buttons
            prevScenarioBtn.disabled = currentScenarioIndex === 0;
            nextScenarioBtn.disabled = currentScenarioIndex === scenarios.length - 1;
            
            // Reset objectives for new scenario
            completedObjectives = 0;
            updateObjectives();
        }

        // Update scenario description text
        function updateScenarioText() {
            if (!currentModule) return;
            
            const scenarios = simulationData[currentModule].scenarios;
            const scenario = scenarios[currentScenarioIndex];
            
            switch(currentModule) {
                case 'phishing':
                    scenarioText.textContent = `You're using ${scenario.appName} when suddenly it requests access to sensitive data. The prompt looks legitimate but seems unnecessary for the app's functionality.`;
                    break;
                case 'exfiltration':
                    scenarioText.textContent = `Our monitoring system has detected unusual data transfer activity from ${scenario.appName}. The app is sending a large amount of data to an unknown server.`;
                    break;
                case 'malicious-update':
                    scenarioText.textContent = `${scenario.appName} was recently updated and is now requesting new permissions that seem unrelated to its core functionality.`;
                    break;
                default:
                    scenarioText.textContent = "Security scenario in progress. Make your decision based on the information provided.";
            }
        }

        // Handle user action in simulation
        function handleUserAction(action) {
            if (!currentModule) return;
            
            const scenarios = simulationData[currentModule].scenarios;
            const scenario = scenarios[currentScenarioIndex];
            const isCorrect = action === scenario.correctAction;
            
            // Update feedback
            if (isCorrect) {
                feedbackTitle.innerHTML = `<i class="fas fa-check-circle"></i> Correct Decision!`;
                feedbackTitle.className = 'feedback-title correct';
                feedbackText.textContent = scenario.feedback.correct;
                score += 25;
                completedObjectives++;
            } else {
                feedbackTitle.innerHTML = `<i class="fas fa-times-circle"></i> Incorrect Decision`;
                feedbackTitle.className = 'feedback-title incorrect';
                feedbackText.textContent = scenario.feedback.incorrect;
            }
            
            // Show feedback
            simulationFeedback.classList.add('active');
            
            // Update objectives
            updateObjectives();
            
            // Update score in stats
            updateStats();
        }

        // Move to next scenario
        function nextScenario() {
            if (!currentModule) return;
            
            const scenarios = simulationData[currentModule].scenarios;
            
            if (currentScenarioIndex < scenarios.length - 1) {
                currentScenarioIndex++;
                loadScenario();
            } else {
                // Simulation completed
                alert('Simulation completed! Well done.');
                closeSimulation();
            }
        }

        // Move to previous scenario
        function prevScenario() {
            if (!currentModule || currentScenarioIndex === 0) return;
            
            currentScenarioIndex--;
            loadScenario();
        }

        // Update objectives display
        function updateObjectives() {
            for (let i = 1; i <= 3; i++) {
                const obj = document.getElementById(`obj${i}`);
                if (i <= completedObjectives) {
                    obj.innerHTML = '<i class="fas fa-check"></i>';
                    obj.classList.add('completed');
                } else {
                    obj.textContent = i;
                    obj.classList.remove('completed');
                }
            }
        }

        // Update stats display
        function updateStats() {
            document.querySelector('.stat-card:nth-child(2) .stat-value').textContent = `${Math.min(100, Math.floor(score / 9.5))}%`;
            document.querySelector('.stat-card:nth-child(4) .stat-value').textContent = `#${Math.max(1, 50 - Math.floor(score / 20))}`;
        }

        // Reset progress
        function resetProgress() {
            if (confirm('Are you sure you want to reset all simulation progress? This cannot be undone.')) {
                score = 0;
                updateStats();
                
                // Reset progress bars
                document.querySelectorAll('.progress-fill').forEach(bar => {
                    bar.style.width = '0%';
                });
                
                // Reset progress text
                document.querySelectorAll('.progress-text').forEach(text => {
                    text.textContent = 'Not Started';
                });
                
                // Enable view results buttons
                document.querySelectorAll('.module-btn.secondary').forEach(btn => {
                    btn.disabled = false;
                });
                
                alert('Progress reset successfully!');
            }
        }

        // Get icon for module
        function getModuleIcon(module) {
            switch(module) {
                case 'phishing': return 'fish';
                case 'exfiltration': return 'network-wired';
                case 'malicious-update': return 'download';
                case 'fingerprinting': return 'fingerprint';
                case 'fake-app': return 'mobile-alt';
                case 'breach': return 'broadcast-tower';
                default: return 'shield-alt';
            }
        }

        // Simulate leaderboard updates
        setInterval(() => {
            // Randomly update leaderboard scores to simulate live competition
            const scores = [950, 920, 890, 720];
            const randomUser = Math.floor(Math.random() * 3); // Don't update our score
            const change = Math.floor(Math.random() * 10) - 3; // -3 to +6
            
            if (scores[randomUser] + change > 700 && scores[randomUser] + change < 1000) {
                scores[randomUser] += change;
                
                // Update leaderboard display
                document.querySelectorAll('.user-score').forEach((el, index) => {
                    if (index !== 3) { // Don't update our score
                        el.textContent = scores[index];
                    }
                });
            }
        }, 10000);
    </script>
</body>
</html>