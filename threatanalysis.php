<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - Threat Analysis Hub</title>
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

        /* Alert Stats */
        .alert-stats {
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

        .stat-icon.critical {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .stat-icon.high {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .stat-icon.medium {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .stat-icon.low {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
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

        /* Threat Categories */
        .threat-categories {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .category-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .threat-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .threat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
            transition: background-color 0.3s;
        }

        .threat-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .threat-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .threat-icon.critical {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .threat-icon.high {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .threat-icon.medium {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .threat-content {
            flex: 1;
        }

        .threat-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .threat-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .threat-count {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .threat-count.critical {
            color: var(--danger);
        }

        .threat-count.high {
            color: var(--warning);
        }

        .threat-count.medium {
            color: var(--primary);
        }

        /* Alerts Container */
        .alerts-container {
            background-color: var(--dark-card);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .alerts-header {
            display: grid;
            grid-template-columns: 60px 1fr 100px 120px 150px;
            padding: 15px 20px;
            background-color: rgba(30, 30, 30, 0.8);
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .alert-row {
            display: grid;
            grid-template-columns: 60px 1fr 100px 120px 150px;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            align-items: center;
            transition: background-color 0.3s;
        }

        .alert-row:last-child {
            border-bottom: none;
        }

        .alert-row:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .alert-severity {
            display: flex;
            justify-content: center;
        }

        .severity-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .severity-dot.critical {
            background-color: var(--danger);
            box-shadow: 0 0 8px var(--danger);
        }

        .severity-dot.high {
            background-color: var(--warning);
            box-shadow: 0 0 8px var(--warning);
        }

        .severity-dot.medium {
            background-color: var(--primary);
            box-shadow: 0 0 8px var(--primary);
        }

        .alert-app {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .app-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 0.8rem;
        }

        .app-icon.social { background: linear-gradient(135deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D); }
        .app-icon.game { background: linear-gradient(135deg, #00b894, #00cec9); }
        .app-icon.tool { background: linear-gradient(135deg, #0984e3, #74b9ff); }
        .app-icon.shopping { background: linear-gradient(135deg, #e17055, #fdcb6e); }
        .app-icon.photo { background: linear-gradient(135deg, #6c5ce7, #a29bfe); }

        .app-name {
            font-weight: 600;
        }

        .alert-time {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .alert-type {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
        }

        .alert-type.permission {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .alert-type.night {
            background-color: rgba(142, 68, 173, 0.2);
            color: var(--secondary);
        }

        .alert-type.background {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .alert-type.location {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .alert-type.clipboard {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .alert-actions {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .action-btn.resolve {
            background-color: var(--primary);
            color: white;
        }

        .action-btn.resolve:hover {
            background-color: var(--primary-dark);
        }

        .action-btn.ignore {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text);
        }

        .action-btn.ignore:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Threat Analysis */
        .threat-analysis {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .analysis-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
        }

        .analysis-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .analysis-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .trend-indicator {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .trend-up {
            color: var(--danger);
        }

        .trend-down {
            color: var(--success);
        }

        .threat-chart-container {
            height: 250px;
            position: relative;
        }

        .threat-patterns {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .pattern-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .pattern-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .pattern-content {
            flex: 1;
        }

        .pattern-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .pattern-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .pattern-risk {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--danger);
        }

        /* Resolve All Section */
        .resolve-section {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 30px;
        }

        /* Simulation Modal */
        .simulation-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .simulation-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 30px;
            border: 1px solid var(--border);
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            animation: slideIn 0.5s ease-out;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-close {
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

        .modal-close:hover {
            background-color: var(--danger);
        }

        .simulation-content {
            margin-bottom: 25px;
        }

        .simulation-scenario {
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .scenario-title {
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .scenario-text {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .simulation-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .simulation-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .simulation-btn.primary {
            background-color: var(--primary);
            color: white;
        }

        .simulation-btn.primary:hover {
            background-color: var(--primary-dark);
        }

        .simulation-btn.secondary {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text);
        }

        .simulation-btn.secondary:hover {
            background-color: rgba(255, 255, 255, 0.2);
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

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .alert-row {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes alertPulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 55, 95, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(255, 55, 95, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 55, 95, 0); }
        }

        .alert-row.critical {
            animation: alertPulse 2s infinite, slideIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .threat-analysis {
                grid-template-columns: 1fr;
            }
            
            .threat-categories {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 992px) {
            .alert-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .alerts-header, .alert-row {
                grid-template-columns: 60px 1fr 100px 120px;
            }
            
            .alert-actions {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .alert-stats {
                grid-template-columns: 1fr;
            }
            
            .alerts-header, .alert-row {
                grid-template-columns: 60px 1fr 100px;
            }
            
            .alert-type {
                display: none;
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
                <h1 class="page-title">Threat Analysis Hub</h1>
                <p class="page-subtitle">Real-time security alerts and threat intelligence</p>
            </div>
            <div>
                <button class="btn btn-primary" id="resolveAllBtn">
                    <i class="fas fa-check-double"></i>
                    Resolve All
                </button>
            </div>
        </div>
        
        <div class="alert-stats">
            <div class="stat-card" id="criticalStat">
                <div class="stat-icon critical">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-value">8</div>
                <div class="stat-label">Critical Alerts</div>
            </div>
            
            <div class="stat-card" id="highStat">
                <div class="stat-icon high">
                    <i class="fas fa-radiation"></i>
                </div>
                <div class="stat-value">14</div>
                <div class="stat-label">High Severity</div>
            </div>
            
            <div class="stat-card" id="mediumStat">
                <div class="stat-icon medium">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="stat-value">23</div>
                <div class="stat-label">Medium Risk</div>
            </div>
            
            <div class="stat-card" id="lowStat">
                <div class="stat-icon low">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="stat-value">37</div>
                <div class="stat-label">Low Priority</div>
            </div>
        </div>
        
        <div class="threat-categories">
            <div class="category-card">
                <h3 class="card-title">
                    <i class="fas fa-microphone"></i>
                    Permission Spikes
                </h3>
                <div class="threat-list">
                    <div class="threat-item" data-simulation="microphone">
                        <div class="threat-icon critical">
                            <i class="fas fa-exclamation"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Background Microphone Access</div>
                            <div class="threat-desc">Apps accessing mic when not in use</div>
                        </div>
                        <div class="threat-count critical">12 alerts</div>
                    </div>
                    
                    <div class="threat-item" data-simulation="camera">
                        <div class="threat-icon high">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Camera Permission Abuse</div>
                            <div class="threat-desc">Unauthorized camera activation</div>
                        </div>
                        <div class="threat-count high">8 alerts</div>
                    </div>
                    
                    <div class="threat-item" data-simulation="location">
                        <div class="threat-icon medium">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Location Tracking Spikes</div>
                            <div class="threat-desc">Excessive location requests</div>
                        </div>
                        <div class="threat-count medium">15 alerts</div>
                    </div>
                </div>
            </div>
            
            <div class="category-card">
                <h3 class="card-title">
                    <i class="fas fa-moon"></i>
                    Suspicious Activity
                </h3>
                <div class="threat-list">
                    <div class="threat-item" data-simulation="nighttime">
                        <div class="threat-icon critical">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Night-time Data Access</div>
                            <div class="threat-desc">Activity during sleep hours</div>
                        </div>
                        <div class="threat-count critical">9 alerts</div>
                    </div>
                    
                    <div class="threat-item" data-simulation="clipboard">
                        <div class="threat-icon high">
                            <i class="fas fa-clipboard"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Clipboard Monitoring</div>
                            <div class="threat-desc">Apps reading clipboard frequently</div>
                        </div>
                        <div class="threat-count high">11 alerts</div>
                    </div>
                    
                    <div class="threat-item" data-simulation="cross-app">
                        <div class="threat-icon medium">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Cross-App Communication</div>
                            <div class="threat-desc">Unusual app-to-app data sharing</div>
                        </div>
                        <div class="threat-count medium">7 alerts</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="alerts-container">
            <div class="alerts-header">
                <div>Severity</div>
                <div>Alert Details</div>
                <div>Time</div>
                <div>Type</div>
                <div>Actions</div>
            </div>
            
            <div class="alert-row critical">
                <div class="alert-severity">
                    <div class="severity-dot critical"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon social">SC</div>
                    <div>
                        <div class="app-name">SocialConnect</div>
                        <div class="alert-desc">Accessed microphone for 3 minutes while screen was off</div>
                    </div>
                </div>
                <div class="alert-time">02:15 AM</div>
                <div class="alert-type permission">Permission Spike</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row critical">
                <div class="alert-severity">
                    <div class="severity-dot critical"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon shopping">SN</div>
                    <div>
                        <div class="app-name">ShopNow</div>
                        <div class="alert-desc">Sent 142 location requests in last 2 hours</div>
                    </div>
                </div>
                <div class="alert-time">10:30 AM</div>
                <div class="alert-type location">Location Ping</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row">
                <div class="alert-severity">
                    <div class="severity-dot high"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon game">GM</div>
                    <div>
                        <div class="app-name">GameMaster Pro</div>
                        <div class="alert-desc">Transmitted 45MB to unknown server in background</div>
                    </div>
                </div>
                <div class="alert-time">11:45 AM</div>
                <div class="alert-type background">Background Data</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row">
                <div class="alert-severity">
                    <div class="severity-dot high"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon tool">FL</div>
                    <div>
                        <div class="app-name">FlashLight+</div>
                        <div class="alert-desc">Accessed contact list without user interaction</div>
                    </div>
                </div>
                <div class="alert-time">01:20 PM</div>
                <div class="alert-type permission">Permission Spike</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row">
                <div class="alert-severity">
                    <div class="severity-dot medium"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon shopping">SN</div>
                    <div>
                        <div class="app-name">ShopNow</div>
                        <div class="alert-desc">Reading clipboard every 30 seconds</div>
                    </div>
                </div>
                <div class="alert-time">03:15 PM</div>
                <div class="alert-type clipboard">Clipboard Access</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row">
                <div class="alert-severity">
                    <div class="severity-dot medium"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon social">SC</div>
                    <div>
                        <div class="app-name">SocialConnect</div>
                        <div class="alert-desc">Accessing gyroscope sensor in background</div>
                    </div>
                </div>
                <div class="alert-time">06:40 PM</div>
                <div class="alert-type background">Background Sensor</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
            
            <div class="alert-row">
                <div class="alert-severity">
                    <div class="severity-dot medium"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon photo">PC</div>
                    <div>
                        <div class="app-name">PhotoCraft</div>
                        <div class="alert-desc">Accessed camera and location simultaneously</div>
                    </div>
                </div>
                <div class="alert-time">08:25 PM</div>
                <div class="alert-type permission">Permission Correlation</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            </div>
        </div>
        
        <div class="threat-analysis">
            <div class="analysis-card">
                <div class="analysis-header">
                    <h3 class="analysis-title">
                        <i class="fas fa-chart-line"></i>
                        Threat Trends
                    </h3>
                    <div class="trend-indicator trend-up">
                        <i class="fas fa-arrow-up"></i>
                        24% increase this week
                    </div>
                </div>
                <div class="threat-chart-container">
                    <canvas id="threatChart"></canvas>
                </div>
            </div>
            
            <div class="analysis-card">
                <div class="analysis-header">
                    <h3 class="analysis-title">
                        <i class="fas fa-bug"></i>
                        Threat Patterns
                    </h3>
                </div>
                <div class="threat-patterns">
                    <div class="pattern-item" data-simulation="audio-surveillance">
                        <div class="pattern-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="pattern-content">
                            <div class="pattern-title">Audio Surveillance</div>
                            <div class="pattern-desc">Background mic access increasing</div>
                        </div>
                        <div class="pattern-risk">High</div>
                    </div>
                    
                    <div class="pattern-item" data-simulation="location-tracking">
                        <div class="pattern-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="pattern-content">
                            <div class="pattern-title">Location Tracking</div>
                            <div class="pattern-desc">Shopping apps most aggressive</div>
                        </div>
                        <div class="pattern-risk">Medium</div>
                    </div>
                    
                    <div class="pattern-item" data-simulation="clipboard-theft">
                        <div class="pattern-icon">
                            <i class="fas fa-clipboard"></i>
                        </div>
                        <div class="pattern-content">
                            <div class="pattern-title">Clipboard Theft</div>
                            <div class="pattern-desc">New pattern detected in 3 apps</div>
                        </div>
                        <div class="pattern-risk">Critical</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="resolve-section">
            <button class="btn btn-primary" id="resolveAllBottomBtn" data-simulation="resolve-all">
                <i class="fas fa-check-double"></i>
                Resolve All Threats
            </button>
        </div>
    </main>

    <!-- Simulation Modal -->
    <div class="simulation-modal" id="simulationModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">
                    <i class="fas fa-shield-alt"></i>
                    Threat Analysis Simulation
                </h2>
                <div class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            
            <div class="simulation-content">
                <div class="simulation-scenario">
                    <h3 class="scenario-title" id="scenarioTitle">
                        <i class="fas fa-info-circle"></i>
                        Scenario
                    </h3>
                    <p class="scenario-text" id="scenarioText">
                        Loading simulation scenario...
                    </p>
                </div>
                
                <div class="simulation-actions" id="simulationActions">
                    <!-- Action buttons will be populated dynamically -->
                </div>
                
                <div class="simulation-feedback" id="simulationFeedback">
                    <h3 class="feedback-title" id="feedbackTitle">
                        <i class="fas fa-check-circle"></i>
                        Feedback
                    </h3>
                    <p class="feedback-text" id="feedbackText">
                        Your response will be evaluated here.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simulation data for different threat scenarios
        const simulationData = {
            // Threat category simulations
            microphone: {
                title: "Background Microphone Access Simulation",
                scenario: "You've noticed SocialConnect has been accessing your microphone for extended periods while the app is in the background. The app claims this is for 'voice message detection' but you're suspicious.",
                actions: [
                    { text: "Block Microphone Access", type: "primary", correct: true },
                    { text: "Allow Access Temporarily", type: "secondary", correct: false },
                    { text: "Investigate Further", type: "secondary", correct: true }
                ],
                feedback: {
                    correct: "Correct! Background microphone access is a serious privacy concern. Legitimate apps only need microphone access when actively recording audio.",
                    incorrect: "Background microphone access should always be blocked unless there's a clear, user-initiated reason for it. This could be audio surveillance."
                }
            },
            camera: {
                title: "Camera Permission Abuse Simulation",
                scenario: "PhotoCraft has been activating your camera multiple times per day, even when you're not using the app. The privacy dashboard shows camera access at unusual times.",
                actions: [
                    { text: "Revoke Camera Permission", type: "primary", correct: true },
                    { text: "Allow Only When Using App", type: "secondary", correct: true },
                    { text: "Ignore - It's a Photo App", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Good decision! Camera access should be strictly controlled. Photo apps only need camera access when you're actively taking photos.",
                    incorrect: "Camera access is highly sensitive. Unauthorized camera activation could lead to visual surveillance and privacy violations."
                }
            },
            location: {
                title: "Location Tracking Simulation",
                scenario: "ShopNow has sent 142 location requests in the last 2 hours. The app claims this is for 'personalized deals' but you're only browsing products, not shopping locally.",
                actions: [
                    { text: "Set Location to 'While Using' Only", type: "primary", correct: true },
                    { text: "Block Location Access Completely", type: "secondary", correct: true },
                    { text: "Allow - Better Deals", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Correct! Excessive location tracking is a privacy risk. Shopping apps don't need constant location access for basic functionality.",
                    incorrect: "Constant location tracking creates a detailed profile of your movements and habits. This data is often sold to advertisers and data brokers."
                }
            },
            nighttime: {
                title: "Night-time Data Access Simulation",
                scenario: "System logs show GameMaster Pro transferring large amounts of data between 2-4 AM while your device should be idle. The transfers happen even when the game isn't running.",
                actions: [
                    { text: "Block Background Data", type: "primary", correct: true },
                    { text: "Investigate Data Destination", type: "secondary", correct: true },
                    { text: "Allow - Maybe Updates", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Good choice! Night-time data transfers are highly suspicious. Legitimate updates happen during normal hours and with user awareness.",
                    incorrect: "Night-time data transfers are a red flag for data exfiltration. This could be stealing your personal information or using your device for cryptomining."
                }
            },
            clipboard: {
                title: "Clipboard Monitoring Simulation",
                scenario: "ShopNow is reading your clipboard every 30 seconds. You recently copied a password to a financial website and are concerned about potential theft.",
                actions: [
                    { text: "Block Clipboard Access", type: "primary", correct: true },
                    { text: "Clear Clipboard History", type: "secondary", correct: true },
                    { text: "Allow - Convenience Feature", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Excellent! Clipboard monitoring is a serious security risk. No shopping app needs to read your clipboard, especially not every 30 seconds.",
                    incorrect: "Clipboard access can expose passwords, credit card numbers, and other sensitive data. This is a common technique used by malware."
                }
            },
            'cross-app': {
                title: "Cross-App Communication Simulation",
                scenario: "You've detected unusual communication between SocialConnect and FlashLight+. They're sharing device identifiers and usage patterns without clear user benefit.",
                actions: [
                    { text: "Block Cross-App Communication", type: "primary", correct: true },
                    { text: "Investigate Data Shared", type: "secondary", correct: true },
                    { text: "Allow - Maybe Integration", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Correct decision! Unexplained cross-app communication is a privacy risk. Apps shouldn't share data without explicit user consent and clear purpose.",
                    incorrect: "Cross-app data sharing can create detailed profiles of your behavior across different services. This is often used for targeted advertising without your knowledge."
                }
            },
            
            // Threat pattern simulations
            'audio-surveillance': {
                title: "Audio Surveillance Pattern Analysis",
                scenario: "You're analyzing a pattern where 5 different apps have started accessing microphones in background simultaneously. This coordinated behavior suggests a possible surveillance campaign.",
                actions: [
                    { text: "Block All Background Audio", type: "primary", correct: true },
                    { text: "Investigate App Connections", type: "secondary", correct: true },
                    { text: "Monitor for Now", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Good analysis! Coordinated background audio access across multiple apps is a strong indicator of surveillance activity. Immediate action is warranted.",
                    incorrect: "When multiple apps show the same suspicious pattern simultaneously, it often indicates coordinated malicious activity rather than coincidence."
                }
            },
            'location-tracking': {
                title: "Location Tracking Pattern Analysis",
                scenario: "Analysis shows shopping apps are the most aggressive location trackers, with some requesting location every 2 minutes. This creates precise movement patterns of users.",
                actions: [
                    { text: "Implement Location Privacy Rules", type: "primary", correct: true },
                    { text: "Educate Users About Risks", type: "secondary", correct: true },
                    { text: "Allow - Business Model", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Correct! Frequent location tracking by shopping apps is primarily for advertising and data brokerage, not user benefit. Privacy protections are essential.",
                    incorrect: "Even if location tracking is part of a business model, users should have clear controls and understanding of how their location data is used and shared."
                }
            },
            'clipboard-theft': {
                title: "Clipboard Theft Pattern Analysis",
                scenario: "A new pattern shows 3 recently updated apps now reading clipboard contents. This coincides with reports of credential theft from these apps' user bases.",
                actions: [
                    { text: "Block Clipboard Access System-wide", type: "primary", correct: true },
                    { text: "Alert Affected Users", type: "secondary", correct: true },
                    { text: "Wait for More Evidence", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Urgent action is correct! When multiple apps suddenly gain clipboard access after updates and credential theft is reported, this indicates a coordinated attack.",
                    incorrect: "In security incidents, early intervention prevents widespread damage. Waiting for 'more evidence' can allow the attack to affect more users."
                }
            },
            
            // Alert action simulations
            resolve: {
                title: "Alert Resolution Simulation",
                scenario: "You're resolving a critical alert about SocialConnect accessing your microphone in background. What steps should you take to properly resolve this threat?",
                actions: [
                    { text: "Revoke Permission + Investigate", type: "primary", correct: true },
                    { text: "Just Revoke Permission", type: "secondary", correct: true },
                    { text: "Temporarily Disable App", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Proper resolution involves both stopping the immediate threat and understanding how it happened to prevent recurrence. Good security practice!",
                    incorrect: "Simply disabling an app doesn't address the root cause. Understanding why the app behaved this way helps prevent similar issues in the future."
                }
            },
            ignore: {
                title: "Alert Ignorance Simulation",
                scenario: "You're considering ignoring a high-severity alert about location tracking. What are the potential consequences of ignoring this type of alert?",
                actions: [
                    { text: "Privacy Erosion", type: "primary", correct: true },
                    { text: "Data Broker Profiling", type: "secondary", correct: true },
                    { text: "Probably Nothing Serious", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Correct! Ignoring location tracking alerts leads to gradual privacy erosion and enables detailed profiling of your movements and habits.",
                    incorrect: "Location data is extremely valuable and sensitive. Even if no immediate harm is visible, the long-term privacy implications are significant."
                }
            },
            'resolve-all': {
                title: "Bulk Resolution Simulation",
                scenario: "You're about to resolve all 82 active security alerts simultaneously. What should you consider before taking this bulk action?",
                actions: [
                    { text: "Review Critical Alerts First", type: "primary", correct: true },
                    { text: "Check for Patterns", type: "secondary", correct: true },
                    { text: "Just Resolve All", type: "secondary", correct: false }
                ],
                feedback: {
                    correct: "Good approach! Bulk resolution can be efficient, but critical alerts should be reviewed individually to ensure proper handling of serious threats.",
                    incorrect: "Bulk resolution without review can cause you to miss important patterns or critical threats that need special attention."
                }
            }
        };

        // DOM Elements
        const simulationModal = document.getElementById('simulationModal');
        const modalTitle = document.getElementById('modalTitle');
        const scenarioTitle = document.getElementById('scenarioTitle');
        const scenarioText = document.getElementById('scenarioText');
        const simulationActions = document.getElementById('simulationActions');
        const simulationFeedback = document.getElementById('simulationFeedback');
        const feedbackTitle = document.getElementById('feedbackTitle');
        const feedbackText = document.getElementById('feedbackText');
        const closeModal = document.getElementById('closeModal');

        // Initialize the threat analysis hub
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize threat chart
            initThreatChart();
            
            // Add event listeners to all simulation triggers
            document.querySelectorAll('[data-simulation]').forEach(element => {
                element.addEventListener('click', function() {
                    const simulation = this.getAttribute('data-simulation');
                    startSimulation(simulation);
                });
            });

            // Close modal
            closeModal.addEventListener('click', closeSimulation);

            // Alert resolution functionality
            initAlertResolution();

            // Simulate new alerts
            setInterval(() => {
                if (Math.random() > 0.7) {
                    addNewAlert();
                }
            }, 15000);
        });

        // Start a simulation
        function startSimulation(simulation) {
            if (!simulationData[simulation]) return;
            
            const data = simulationData[simulation];
            
            // Update modal content
            modalTitle.innerHTML = `<i class="fas fa-shield-alt"></i> ${data.title}`;
            scenarioTitle.textContent = "Scenario";
            scenarioText.textContent = data.scenario;
            
            // Clear previous actions
            simulationActions.innerHTML = '';
            
            // Add action buttons
            data.actions.forEach((action, index) => {
                const button = document.createElement('button');
                button.className = `simulation-btn ${action.type}`;
                button.textContent = action.text;
                button.dataset.correct = action.correct;
                button.addEventListener('click', function() {
                    handleSimulationAction(action.correct, data.feedback);
                });
                simulationActions.appendChild(button);
            });
            
            // Hide feedback
            simulationFeedback.classList.remove('active');
            
            // Show modal
            simulationModal.classList.add('active');
        }

        // Handle user action in simulation
        function handleSimulationAction(isCorrect, feedback) {
            if (isCorrect) {
                feedbackTitle.innerHTML = `<i class="fas fa-check-circle"></i> Correct Decision!`;
                feedbackTitle.className = 'feedback-title correct';
                feedbackText.textContent = feedback.correct;
            } else {
                feedbackTitle.innerHTML = `<i class="fas fa-times-circle"></i> Incorrect Decision`;
                feedbackTitle.className = 'feedback-title incorrect';
                feedbackText.textContent = feedback.incorrect;
            }
            
            // Show feedback
            simulationFeedback.classList.add('active');
        }

        // Close simulation modal
        function closeSimulation() {
            simulationModal.classList.remove('active');
        }

        // Initialize threat chart
        function initThreatChart() {
            const ctx = document.getElementById('threatChart').getContext('2d');
            
            // Generate sample data for the threat chart
            const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            const threatData = {
                critical: [3, 5, 7, 8, 6, 4, 5],
                high: [8, 10, 12, 14, 11, 9, 10],
                medium: [15, 18, 20, 23, 19, 16, 17],
                low: [25, 28, 32, 37, 30, 26, 29]
            };
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: days,
                    datasets: [
                        {
                            label: 'Critical',
                            data: threatData.critical,
                            borderColor: '#ff375f',
                            backgroundColor: 'rgba(255, 55, 95, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'High',
                            data: threatData.high,
                            borderColor: '#ff9f0a',
                            backgroundColor: 'rgba(255, 159, 10, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Medium',
                            data: threatData.medium,
                            borderColor: '#0a84ff',
                            backgroundColor: 'rgba(10, 132, 255, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Low',
                            data: threatData.low,
                            borderColor: '#30d158',
                            backgroundColor: 'rgba(48, 209, 88, 0.1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(44, 44, 46, 0.5)'
                            },
                            ticks: {
                                color: 'rgba(160, 160, 160, 0.7)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(44, 44, 46, 0.5)'
                            },
                            ticks: {
                                color: 'rgba(160, 160, 160, 0.7)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)',
                                usePointStyle: true,
                                boxWidth: 6
                            }
                        }
                    }
                }
            });
        }

        // Initialize alert resolution functionality
        function initAlertResolution() {
            const resolveButtons = document.querySelectorAll('.action-btn.resolve');
            const ignoreButtons = document.querySelectorAll('.action-btn.ignore');
            const resolveAllBtn = document.getElementById('resolveAllBtn');
            const resolveAllBottomBtn = document.getElementById('resolveAllBottomBtn');
            
            resolveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const alertRow = this.closest('.alert-row');
                    resolveAlert(alertRow);
                });
            });
            
            ignoreButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const alertRow = this.closest('.alert-row');
                    ignoreAlert(alertRow);
                });
            });
            
            resolveAllBtn.addEventListener('click', resolveAllAlerts);
            resolveAllBottomBtn.addEventListener('click', resolveAllAlerts);
        }

        // Resolve a single alert
        function resolveAlert(alertRow) {
            alertRow.style.opacity = '0.5';
            alertRow.style.textDecoration = 'line-through';
            
            // Update stats
            updateStatsAfterResolve(alertRow);
            
            setTimeout(() => {
                alertRow.remove();
            }, 1000);
        }

        // Ignore a single alert
        function ignoreAlert(alertRow) {
            alertRow.style.opacity = '0.3';
            
            setTimeout(() => {
                alertRow.remove();
            }, 1000);
        }

        // Resolve all alerts
        function resolveAllAlerts() {
            const alertRows = document.querySelectorAll('.alert-row');
            
            alertRows.forEach(row => {
                row.style.opacity = '0.5';
                row.style.textDecoration = 'line-through';
                
                setTimeout(() => {
                    row.remove();
                }, Math.random() * 1000 + 500);
            });
            
            // Reset all stats
            document.getElementById('criticalStat').querySelector('.stat-value').textContent = '0';
            document.getElementById('highStat').querySelector('.stat-value').textContent = '0';
            document.getElementById('mediumStat').querySelector('.stat-value').textContent = '0';
            document.getElementById('lowStat').querySelector('.stat-value').textContent = '0';
        }

        // Update stats after resolving an alert
        function updateStatsAfterResolve(alertRow) {
            let statElement;
            
            if (alertRow.classList.contains('critical')) {
                statElement = document.getElementById('criticalStat').querySelector('.stat-value');
            } else if (alertRow.classList.contains('high')) {
                statElement = document.getElementById('highStat').querySelector('.stat-value');
            } else {
                statElement = document.getElementById('mediumStat').querySelector('.stat-value');
            }
            
            const currentValue = parseInt(statElement.textContent);
            if (currentValue > 0) {
                statElement.textContent = currentValue - 1;
            }
        }

        // Add new alert (simulation)
        function addNewAlert() {
            const alertsContainer = document.querySelector('.alerts-container');
            const alertTypes = ['permission', 'night', 'background', 'location', 'clipboard'];
            const apps = [
                { name: 'SocialConnect', icon: 'social', code: 'SC' },
                { name: 'ShopNow', icon: 'shopping', code: 'SN' },
                { name: 'GameMaster Pro', icon: 'game', code: 'GM' },
                { name: 'FlashLight+', icon: 'tool', code: 'FL' },
                { name: 'PhotoCraft', icon: 'photo', code: 'PC' }
            ];
            
            const randomApp = apps[Math.floor(Math.random() * apps.length)];
            const randomType = alertTypes[Math.floor(Math.random() * alertTypes.length)];
            const severities = ['critical', 'high', 'medium'];
            const randomSeverity = severities[Math.floor(Math.random() * severities.length)];
            
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            const alertDescriptions = {
                permission: `Accessed ${randomSeverity === 'critical' ? 'microphone' : 'camera'} without user interaction`,
                night: `Data access during sleep hours`,
                background: `Transmitted ${Math.floor(Math.random() * 50) + 10}MB in background`,
                location: `Sent ${Math.floor(Math.random() * 100) + 50} location requests`,
                clipboard: `Reading clipboard every ${Math.floor(Math.random() * 60) + 10} seconds`
            };
            
            const typeLabels = {
                permission: 'Permission Spike',
                night: 'Night Activity',
                background: 'Background Data',
                location: 'Location Ping',
                clipboard: 'Clipboard Access'
            };
            
            const newAlert = document.createElement('div');
            newAlert.className = `alert-row ${randomSeverity}`;
            newAlert.innerHTML = `
                <div class="alert-severity">
                    <div class="severity-dot ${randomSeverity}"></div>
                </div>
                <div class="alert-app">
                    <div class="app-icon ${randomApp.icon}">${randomApp.code}</div>
                    <div>
                        <div class="app-name">${randomApp.name}</div>
                        <div class="alert-desc">${alertDescriptions[randomType]}</div>
                    </div>
                </div>
                <div class="alert-time">${timeString}</div>
                <div class="alert-type ${randomType}">${typeLabels[randomType]}</div>
                <div class="alert-actions">
                    <button class="action-btn resolve" data-simulation="resolve">Resolve</button>
                    <button class="action-btn ignore" data-simulation="ignore">Ignore</button>
                </div>
            `;
            
            alertsContainer.appendChild(newAlert);
            
            // Add click events to the new buttons
            newAlert.querySelector('.action-btn.resolve').addEventListener('click', function() {
                const alertRow = this.closest('.alert-row');
                resolveAlert(alertRow);
            });
            
            newAlert.querySelector('.action-btn.ignore').addEventListener('click', function() {
                const alertRow = this.closest('.alert-row');
                ignoreAlert(alertRow);
            });
            
            // Update stats
            let statElement;
            if (randomSeverity === 'critical') {
                statElement = document.getElementById('criticalStat').querySelector('.stat-value');
            } else if (randomSeverity === 'high') {
                statElement = document.getElementById('highStat').querySelector('.stat-value');
            } else {
                statElement = document.getElementById('mediumStat').querySelector('.stat-value');
            }
            
            const currentValue = parseInt(statElement.textContent);
            statElement.textContent = currentValue + 1;
            
            // Add animation for new critical alerts
            if (randomSeverity === 'critical') {
                newAlert.style.animation = 'alertPulse 2s infinite, slideIn 0.5s ease-out';
            }
        }
    </script>
</body>
</html>