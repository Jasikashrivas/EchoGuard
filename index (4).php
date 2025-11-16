<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - Privacy Dashboard</title>
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

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary);
        }

        /* Privacy Score */
        .privacy-score {
            grid-column: span 4;
            position: relative;
            overflow: hidden;
        }

        .score-circle {
            width: 180px;
            height: 180px;
            margin: 0 auto;
            position: relative;
        }

        .score-value {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.5rem;
            font-weight: 700;
        }

        .score-label {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .score-trend {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin-top: 5px;
            font-size: 0.8rem;
        }

        .trend-up {
            color: var(--danger);
        }

        .trend-down {
            color: var(--success);
        }

        /* Live Threat Monitor */
        .threat-monitor {
            grid-column: span 8;
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
            background-color: rgba(255, 55, 95, 0.1);
            border-left: 3px solid var(--danger);
            animation: pulse-alert 2s infinite;
        }

        .threat-item.warning {
            background-color: rgba(255, 159, 10, 0.1);
            border-left-color: var(--warning);
        }

        .threat-item.info {
            background-color: rgba(10, 132, 255, 0.1);
            border-left-color: var(--primary);
        }

        .threat-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--danger);
        }

        .threat-item.warning .threat-icon {
            background-color: var(--warning);
        }

        .threat-item.info .threat-icon {
            background-color: var(--primary);
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

        .threat-time {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Data Access Heatmap */
        .data-heatmap {
            grid-column: span 6;
        }

        .heatmap-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .heatmap-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sensor-label {
            width: 120px;
            font-size: 0.9rem;
        }

        .heatmap-bars {
            flex: 1;
            display: flex;
            gap: 4px;
        }

        .heatmap-bar {
            height: 24px;
            flex: 1;
            border-radius: 4px;
            background-color: var(--border);
            position: relative;
            overflow: hidden;
        }

        .heatmap-bar.active {
            background-color: var(--primary);
        }

        .heatmap-bar.high {
            background-color: var(--danger);
        }

        .heatmap-bar.medium {
            background-color: var(--warning);
        }

        .heatmap-time {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 0.7rem;
            color: var(--text-secondary);
        }

        /* Zero-Day Watchlist */
        .zero-day {
            grid-column: span 6;
        }

        .watchlist {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .watchlist-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
            border: 1px solid var(--border);
        }

        .app-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
        }

        .app-icon.social { background: linear-gradient(135deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D); }
        .app-icon.game { background: linear-gradient(135deg, #00b894, #00cec9); }
        .app-icon.tool { background: linear-gradient(135deg, #0984e3, #74b9ff); }
        .app-icon.shopping { background: linear-gradient(135deg, #e17055, #fdcb6e); }

        .app-info {
            flex: 1;
        }

        .app-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .app-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .risk-badge {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .risk-high {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .risk-medium {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        /* Quick Actions */
        .quick-actions {
            grid-column: span 12;
            display: flex;
            gap: 15px;
        }

        .action-btn {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            padding: 20px 10px;
            border-radius: 12px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background-color: rgba(10, 132, 255, 0.1);
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .action-label {
            font-weight: 600;
            text-align: center;
        }

        /* Score Explainer */
        .score-explainer {
            grid-column: span 6;
        }

        .explainer-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .explainer-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .explainer-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .explainer-icon.negative {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .explainer-icon.positive {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .explainer-text {
            flex: 1;
            font-size: 0.9rem;
        }

        /* Risky Apps */
        .risky-apps {
            grid-column: span 6;
        }

        .risky-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .risky-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .risky-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            background-color: var(--danger);
        }

        .risky-rank-2 {
            background-color: var(--warning);
        }

        .risky-rank-3 {
            background-color: var(--primary);
        }

        .risky-info {
            flex: 1;
        }

        .risky-name {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .risky-reason {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .risky-permissions {
            display: flex;
            gap: 5px;
        }

        .permission-badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        /* Scan and Lockdown Simulation Styles */
        .scan-overlay, .lockdown-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .scan-overlay.active, .lockdown-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .scan-animation, .lockdown-animation {
            text-align: center;
            margin-bottom: 30px;
        }

        .scan-circle, .lockdown-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
        }

        .scan-circle {
            background: rgba(10, 132, 255, 0.2);
            border: 3px solid var(--primary);
            color: var(--primary);
        }

        .lockdown-circle {
            background: rgba(255, 55, 95, 0.2);
            border: 3px solid var(--danger);
            color: var(--danger);
        }

        .scan-circle::after, .lockdown-circle::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 3px solid;
            animation: ripple 1.5s infinite;
        }

        .scan-circle::after {
            border-color: var(--primary);
        }

        .lockdown-circle::after {
            border-color: var(--danger);
        }

        .scan-progress, .lockdown-progress {
            width: 300px;
            height: 6px;
            background-color: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin: 20px 0;
        }

        .scan-progress-bar, .lockdown-progress-bar {
            height: 100%;
            background-color: var(--primary);
            width: 0%;
            transition: width 0.3s;
        }

        .lockdown-progress-bar {
            background-color: var(--danger);
        }

        .scan-stats, .lockdown-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
            background: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
        }

        .stat-value {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes pulse-alert {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        .card {
            animation: slideIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .dashboard-grid {
                grid-template-columns: repeat(6, 1fr);
            }
            
            .privacy-score, .threat-monitor, .data-heatmap, .zero-day, .score-explainer, .risky-apps {
                grid-column: span 6;
            }
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(1, 1fr);
            }
            
            .privacy-score, .threat-monitor, .data-heatmap, .zero-day, .score-explainer, .risky-apps {
                grid-column: span 1;
            }
            
            .quick-actions {
                flex-direction: column;
            }
            
            nav ul {
                display: none;
            }
            
            .mobile-menu {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="cyber-grid"></div>
    
   <?php include('header.php'); ?>
    
    <main class="container">
        <div class="dashboard-grid">
            <!-- Privacy Score Card -->
            <div class="card privacy-score">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-chart-line"></i>
                        Privacy Score
                    </h2>
                    <div class="score-trend trend-down">
                        <i class="fas fa-arrow-down"></i>
                        12 pts
                    </div>
                </div>
                <div class="score-circle">
                    <canvas id="scoreChart"></canvas>
                    <div class="score-value">76</div>
                </div>
                <div class="score-label">Your digital privacy health</div>
            </div>
            
            <!-- Live Threat Monitor -->
            <div class="card threat-monitor">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-broadcast-tower"></i>
                        Live Threat Monitor
                    </h2>
                    <div class="live-indicator">
                        <i class="fas fa-circle" style="color: var(--success);"></i>
                        Active
                    </div>
                </div>
                <div class="threat-list">
                    <div class="threat-item">
                        <div class="threat-icon">
                            <i class="fas fa-microphone"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Background Mic Access</div>
                            <div class="threat-desc">SocialApp accessed microphone while screen was off</div>
                        </div>
                        <div class="threat-time">2 min ago</div>
                    </div>
                    
                    <div class="threat-item warning">
                        <div class="threat-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Location Ping Spike</div>
                            <div class="threat-desc">ShopNow sent 47 location requests in last hour</div>
                        </div>
                        <div class="threat-time">12 min ago</div>
                    </div>
                    
                    <div class="threat-item info">
                        <div class="threat-icon">
                            <i class="fas fa-clipboard"></i>
                        </div>
                        <div class="threat-content">
                            <div class="threat-title">Clipboard Monitoring</div>
                            <div class="threat-desc">BrowserApp reading clipboard every 30 seconds</div>
                        </div>
                        <div class="threat-time">25 min ago</div>
                    </div>
                </div>
            </div>
            
            <!-- Data Access Heatmap -->
            <div class="card data-heatmap">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-fire"></i>
                        Data Access Heatmap
                    </h2>
                    <div class="time-filter">
                        <select>
                            <option>Today</option>
                            <option>This Week</option>
                            <option>This Month</option>
                        </select>
                    </div>
                </div>
                <div class="heatmap-container">
                    <div class="heatmap-row">
                        <div class="sensor-label">Microphone</div>
                        <div class="heatmap-bars">
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar active"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                        </div>
                    </div>
                    
                    <div class="heatmap-row">
                        <div class="sensor-label">Camera</div>
                        <div class="heatmap-bars">
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                        </div>
                    </div>
                    
                    <div class="heatmap-row">
                        <div class="sensor-label">Location</div>
                        <div class="heatmap-bars">
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar high"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                        </div>
                    </div>
                    
                    <div class="heatmap-row">
                        <div class="sensor-label">Contacts</div>
                        <div class="heatmap-bars">
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar medium"></div>
                            <div class="heatmap-bar"></div>
                            <div class="heatmap-bar"></div>
                        </div>
                    </div>
                    
                    <div class="heatmap-time">
                        <span>12AM</span>
                        <span>6AM</span>
                        <span>12PM</span>
                        <span>6PM</span>
                        <span>12AM</span>
                    </div>
                </div>
            </div>
            
            <!-- Zero-Day Watchlist -->
            <div class="card zero-day">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-bug"></i>
                        Zero-Day Watchlist
                    </h2>
                    <div class="watchlist-count">3 apps</div>
                </div>
                <div class="watchlist">
                    <div class="watchlist-item">
                        <div class="app-icon social">SC</div>
                        <div class="app-info">
                            <div class="app-name">SocialConnect</div>
                            <div class="app-desc">Updated 2 days ago - Now accessing gyroscope</div>
                        </div>
                        <div class="risk-badge risk-high">High Risk</div>
                    </div>
                    
                    <div class="watchlist-item">
                        <div class="app-icon game">GM</div>
                        <div class="app-info">
                            <div class="app-name">GameMaster Pro</div>
                            <div class="app-desc">Updated yesterday - Background data transfer increased 300%</div>
                        </div>
                        <div class="risk-badge risk-medium">Medium Risk</div>
                    </div>
                    
                    <div class="watchlist-item">
                        <div class="app-icon tool">FL</div>
                        <div class="app-info">
                            <div class="app-name">FlashLight+</div>
                            <div class="app-desc">Updated 5 hours ago - Now requesting contacts permission</div>
                        </div>
                        <div class="risk-badge risk-high">High Risk</div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="quick-actions">
                <div class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-microphone-slash"></i>
                    </div>
                    <div class="action-label">Revoke All Mics</div>
                </div>
                
                <div class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="action-label">Pause Location</div>
                </div>
                
                <div class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <div class="action-label">Enable Stealth Mode</div>
                </div>
                
                <div class="action-btn">
                    <div class="action-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="action-label">Run Deep Scan</div>
                </div>
            </div>
            
            <!-- Score Explainer -->
            <div class="card score-explainer">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-question-circle"></i>
                        Why Your Score Dropped
                    </h2>
                </div>
                <div class="explainer-list">
                    <div class="explainer-item">
                        <div class="explainer-icon negative">
                            <i class="fas fa-minus"></i>
                        </div>
                        <div class="explainer-text">3 apps accessed microphone in background</div>
                    </div>
                    
                    <div class="explainer-item">
                        <div class="explainer-icon negative">
                            <i class="fas fa-minus"></i>
                        </div>
                        <div class="explainer-text">ShopNow sent 142 location requests yesterday</div>
                    </div>
                    
                    <div class="explainer-item">
                        <div class="explainer-icon negative">
                            <i class="fas fa-minus"></i>
                        </div>
                        <div class="explainer-text">2 apps added new permissions after update</div>
                    </div>
                    
                    <div class="explainer-item">
                        <div class="explainer-icon positive">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="explainer-text">Blocked 17 tracking attempts this week</div>
                    </div>
                </div>
            </div>
            
            <!-- Risky Apps -->
            <div class="card risky-apps">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Top 3 Risky Apps Today
                    </h2>
                </div>
                <div class="risky-list">
                    <div class="risky-item">
                        <div class="risky-rank">1</div>
                        <div class="app-icon shopping">SN</div>
                        <div class="risky-info">
                            <div class="risky-name">ShopNow</div>
                            <div class="risky-reason">Excessive location tracking & clipboard monitoring</div>
                        </div>
                        <div class="risky-permissions">
                            <span class="permission-badge">Location</span>
                            <span class="permission-badge">Clipboard</span>
                            <span class="permission-badge">Camera</span>
                        </div>
                    </div>
                    
                    <div class="risky-item">
                        <div class="risky-rank risky-rank-2">2</div>
                        <div class="app-icon social">SC</div>
                        <div class="risky-info">
                            <div class="risky-name">SocialConnect</div>
                            <div class="risky-reason">Background mic access & contact scraping</div>
                        </div>
                        <div class="risky-permissions">
                            <span class="permission-badge">Mic</span>
                            <span class="permission-badge">Contacts</span>
                            <span class="permission-badge">Files</span>
                        </div>
                    </div>
                    
                    <div class="risky-item">
                        <div class="risky-rank risky-rank-3">3</div>
                        <div class="app-icon game">GM</div>
                        <div class="risky-info">
                            <div class="risky-name">GameMaster Pro</div>
                            <div class="risky-reason">Excessive data transfer & gyroscope tracking</div>
                        </div>
                        <div class="risky-permissions">
                            <span class="permission-badge">Gyro</span>
                            <span class="permission-badge">Network</span>
                            <span class="permission-badge">Storage</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Scan Overlay -->
    <div class="scan-overlay" id="scanOverlay">
        <div class="scan-animation">
            <div class="scan-circle">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h2>System Security Scan</h2>
            <p>Analyzing apps, permissions, and data access patterns</p>
            
            <div class="scan-progress">
                <div class="scan-progress-bar" id="scanProgressBar"></div>
            </div>
            
            <div class="scan-stats" id="scanStats">
                <div class="stat-item">
                    <div class="stat-value" id="appsScanned">0</div>
                    <div class="stat-label">Apps Scanned</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="threatsFound">0</div>
                    <div class="stat-label">Threats Found</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="permissionsFixed">0</div>
                    <div class="stat-label">Permissions Fixed</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lockdown Overlay -->
    <div class="lockdown-overlay" id="lockdownOverlay">
        <div class="lockdown-animation">
            <div class="lockdown-circle">
                <i class="fas fa-lock"></i>
            </div>
            <h2>Emergency Lockdown</h2>
            <p>Securing all system permissions and data access</p>
            
            <div class="lockdown-progress">
                <div class="lockdown-progress-bar" id="lockdownProgressBar"></div>
            </div>
            
            <div class="lockdown-stats" id="lockdownStats">
                <div class="stat-item">
                    <div class="stat-value" id="appsSecured">0</div>
                    <div class="stat-label">Apps Secured</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="permissionsRevoked">0</div>
                    <div class="stat-label">Permissions Revoked</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="trackersBlocked">0</div>
                    <div class="stat-label">Trackers Blocked</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize the privacy score chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('scoreChart').getContext('2d');
            const scoreChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [76, 24],
                        backgroundColor: [
                            '#0a84ff',
                            '#2c2c2e'
                        ],
                        borderWidth: 0,
                        borderRadius: 10
                    }]
                },
                options: {
                    cutout: '70%',
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: false
                        }
                    }
                }
            });
            
            // Simulate live threat updates
            setInterval(() => {
                updateThreatMonitor();
            }, 15000);
            
            function updateThreatMonitor() {
                const threats = [
                    {
                        type: 'warning',
                        icon: 'fas fa-network-wired',
                        title: 'Suspicious Network Activity',
                        desc: 'Unusual data transfer detected from WeatherApp',
                        time: 'Just now'
                    },
                    {
                        type: 'danger',
                        icon: 'fas fa-camera',
                        title: 'Camera Access Attempt',
                        desc: 'BrowserApp tried to access camera without user interaction',
                        time: '5 min ago'
                    },
                    {
                        type: 'info',
                        icon: 'fas fa-database',
                        title: 'Background Data Sync',
                        desc: 'SocialApp syncing data every 10 minutes in background',
                        time: '15 min ago'
                    }
                ];
                
                const randomThreat = threats[Math.floor(Math.random() * threats.length)];
                const threatList = document.querySelector('.threat-list');
                
                // Remove oldest threat
                if (threatList.children.length >= 3) {
                    threatList.removeChild(threatList.lastChild);
                }
                
                // Add new threat at the top
                const threatItem = document.createElement('div');
                threatItem.className = `threat-item ${randomThreat.type === 'danger' ? '' : randomThreat.type}`;
                
                threatItem.innerHTML = `
                    <div class="threat-icon">
                        <i class="${randomThreat.icon}"></i>
                    </div>
                    <div class="threat-content">
                        <div class="threat-title">${randomThreat.title}</div>
                        <div class="threat-desc">${randomThreat.desc}</div>
                    </div>
                    <div class="threat-time">${randomThreat.time}</div>
                `;
                
                threatList.insertBefore(threatItem, threatList.firstChild);
            }
            
            // Add animation to action buttons
            const actionButtons = document.querySelectorAll('.action-btn');
            actionButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('.action-icon');
                    icon.style.transform = 'scale(1.2)';
                    setTimeout(() => {
                        icon.style.transform = 'scale(1)';
                    }, 300);
                });
            });
            
            // Simulate heatmap activity
            setInterval(() => {
                const heatmapBars = document.querySelectorAll('.heatmap-bar');
                const randomBar = heatmapBars[Math.floor(Math.random() * heatmapBars.length)];
                
                // Reset all bars to default state
                heatmapBars.forEach(bar => {
                    bar.classList.remove('active', 'medium', 'high');
                });
                
                // Set random activity level
                const activityLevel = Math.random();
                if (activityLevel > 0.7) {
                    randomBar.classList.add('high');
                } else if (activityLevel > 0.4) {
                    randomBar.classList.add('medium');
                } else {
                    randomBar.classList.add('active');
                }
            }, 5000);
            
            // Run Scan Simulation
            document.querySelector('.btn-primary').addEventListener('click', function() {
                const scanOverlay = document.getElementById('scanOverlay');
                const scanProgressBar = document.getElementById('scanProgressBar');
                const appsScanned = document.getElementById('appsScanned');
                const threatsFound = document.getElementById('threatsFound');
                const permissionsFixed = document.getElementById('permissionsFixed');
                
                // Show scan overlay
                scanOverlay.classList.add('active');
                
                // Reset values
                scanProgressBar.style.width = '0%';
                appsScanned.textContent = '0';
                threatsFound.textContent = '0';
                permissionsFixed.textContent = '0';
                
                // Simulate scan progress
                let progress = 0;
                const scanInterval = setInterval(() => {
                    progress += Math.random() * 5;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(scanInterval);
                        
                        // Update final stats
                        setTimeout(() => {
                            appsScanned.textContent = '42';
                            threatsFound.textContent = '8';
                            permissionsFixed.textContent = '17';
                            
                            // Hide overlay after completion
                            setTimeout(() => {
                                scanOverlay.classList.remove('active');
                                
                                // Update dashboard with scan results
                                updateAfterScan();
                            }, 2000);
                        }, 500);
                    }
                    
                    scanProgressBar.style.width = `${progress}%`;
                    
                    // Update stats during scan
                    if (progress > 25) appsScanned.textContent = Math.floor(progress / 2.5);
                    if (progress > 50) threatsFound.textContent = Math.floor(progress / 12.5);
                    if (progress > 75) permissionsFixed.textContent = Math.floor(progress / 5);
                }, 200);
            });
            
            // Lockdown Simulation
            document.querySelector('.btn-danger').addEventListener('click', function() {
                const lockdownOverlay = document.getElementById('lockdownOverlay');
                const lockdownProgressBar = document.getElementById('lockdownProgressBar');
                const appsSecured = document.getElementById('appsSecured');
                const permissionsRevoked = document.getElementById('permissionsRevoked');
                const trackersBlocked = document.getElementById('trackersBlocked');
                
                // Show lockdown overlay
                lockdownOverlay.classList.add('active');
                
                // Reset values
                lockdownProgressBar.style.width = '0%';
                appsSecured.textContent = '0';
                permissionsRevoked.textContent = '0';
                trackersBlocked.textContent = '0';
                
                // Simulate lockdown progress
                let progress = 0;
                const lockdownInterval = setInterval(() => {
                    progress += Math.random() * 8;
                    if (progress >= 100) {
                        progress = 100;
                        clearInterval(lockdownInterval);
                        
                        // Update final stats
                        setTimeout(() => {
                            appsSecured.textContent = '36';
                            permissionsRevoked.textContent = '142';
                            trackersBlocked.textContent = '23';
                            
                            // Hide overlay after completion
                            setTimeout(() => {
                                lockdownOverlay.classList.remove('active');
                                
                                // Update dashboard with lockdown results
                                updateAfterLockdown();
                            }, 2000);
                        }, 500);
                    }
                    
                    lockdownProgressBar.style.width = `${progress}%`;
                    
                    // Update stats during lockdown
                    if (progress > 20) appsSecured.textContent = Math.floor(progress / 2.8);
                    if (progress > 40) permissionsRevoked.textContent = Math.floor(progress / 0.7);
                    if (progress > 60) trackersBlocked.textContent = Math.floor(progress / 4.3);
                }, 150);
            });
            
            function updateAfterScan() {
                // Update privacy score
                const scoreValue = document.querySelector('.score-value');
                scoreValue.textContent = '84';
                
                // Update trend indicator
                const trend = document.querySelector('.score-trend');
                trend.innerHTML = '<i class="fas fa-arrow-up"></i> 8 pts';
                trend.className = 'score-trend trend-up';
                
                // Clear some threats
                const threatList = document.querySelector('.threat-list');
                if (threatList.children.length > 1) {
                    threatList.removeChild(threatList.lastChild);
                }
                
                // Add scan completion message
                const scanComplete = document.createElement('div');
                scanComplete.className = 'threat-item info';
                scanComplete.innerHTML = `
                    <div class="threat-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="threat-content">
                        <div class="threat-title">Security Scan Complete</div>
                        <div class="threat-desc">8 threats neutralized, 17 permissions restricted</div>
                    </div>
                    <div class="threat-time">Just now</div>
                `;
                threatList.insertBefore(scanComplete, threatList.firstChild);
                
                // Update chart data
                scoreChart.data.datasets[0].data = [84, 16];
                scoreChart.update();
            }
            
            function updateAfterLockdown() {
                // Update privacy score
                const scoreValue = document.querySelector('.score-value');
                scoreValue.textContent = '95';
                
                // Update trend indicator
                const trend = document.querySelector('.score-trend');
                trend.innerHTML = '<i class="fas fa-arrow-up"></i> 19 pts';
                trend.className = 'score-trend trend-up';
                
                // Clear all threats
                const threatList = document.querySelector('.threat-list');
                threatList.innerHTML = '';
                
                // Add lockdown completion message
                const lockdownComplete = document.createElement('div');
                lockdownComplete.className = 'threat-item';
                lockdownComplete.innerHTML = `
                    <div class="threat-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="threat-content">
                        <div class="threat-title">Emergency Lockdown Active</div>
                        <div class="threat-desc">All high-risk permissions revoked, trackers blocked</div>
                    </div>
                    <div class="threat-time">Just now</div>
                `;
                threatList.appendChild(lockdownComplete);
                
                // Update chart data
                scoreChart.data.datasets[0].data = [95, 5];
                scoreChart.update();
                
                // Update heatmap to show reduced activity
                const heatmapBars = document.querySelectorAll('.heatmap-bar');
                heatmapBars.forEach(bar => {
                    bar.classList.remove('active', 'medium', 'high');
                });
            }
        });
    </script>
</body>
</html>