<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - App Permissions Center</title>
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

        /* Filters */
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
        }

        .filter-btn {
            padding: 8px 16px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .filter-btn:hover {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--text);
        }

        .search-box {
            flex: 1;
            max-width: 300px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-size: 0.9rem;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        /* App Permissions Table */
        .apps-table {
            background-color: var(--dark-card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            margin-bottom: 30px;
        }

        .table-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
            padding: 15px 20px;
            background-color: rgba(30, 30, 30, 0.8);
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            align-items: center;
            transition: background-color 0.3s;
        }

        .table-row:last-child {
            border-bottom: none;
        }

        .table-row:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .app-info {
            display: flex;
            align-items: center;
            gap: 12px;
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
        .app-icon.photo { background: linear-gradient(135deg, #6c5ce7, #a29bfe); }
        .app-icon.music { background: linear-gradient(135deg, #fd79a8, #fdcb6e); }
        .app-icon.browser { background: linear-gradient(135deg, #00b894, #0984e3); }

        .app-details {
            display: flex;
            flex-direction: column;
        }

        .app-name {
            font-weight: 600;
            margin-bottom: 2px;
        }

        .app-category {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .risk-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
        }

        .risk-high {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .risk-medium {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        .risk-low {
            background-color: rgba(48, 209, 88, 0.2);
            color: var(--success);
        }

        .permission-status {
            display: flex;
            justify-content: center;
        }

        .permission-toggle {
            width: 44px;
            height: 24px;
            background-color: var(--border);
            border-radius: 12px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .permission-toggle.active {
            background-color: var(--success);
        }

        .permission-toggle::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            background-color: white;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: transform 0.3s;
        }

        .permission-toggle.active::after {
            transform: translateX(20px);
        }

        .permission-toggle.denied {
            background-color: var(--danger);
        }

        .permission-toggle.denied::after {
            transform: translateX(20px);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.1);
            cursor: pointer;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background-color: var(--primary);
            transform: translateY(-2px);
        }

        /* App Detail Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            background-color: var(--dark-card);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            transform: translateY(20px);
            transition: transform 0.3s;
        }

        .modal-overlay.active .modal {
            transform: translateY(0);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
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

        .modal-body {
            padding: 20px;
            overflow-y: auto;
            max-height: calc(90vh - 140px);
        }

        .modal-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .permission-timeline {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .timeline-item {
            display: flex;
            gap: 15px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .timeline-time {
            width: 80px;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-event {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .timeline-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .tracker-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tracker-badge {
            padding: 6px 12px;
            background-color: rgba(255, 55, 95, 0.2);
            border-radius: 20px;
            font-size: 0.8rem;
            color: var(--danger);
        }

        .data-sharing {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sharing-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .sharing-details {
            display: flex;
            flex-direction: column;
        }

        .sharing-company {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .sharing-purpose {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }

        /* Auto Restrict Overlay */
        .auto-restrict-overlay {
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

        .auto-restrict-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .auto-restrict-animation {
            text-align: center;
            margin-bottom: 30px;
        }

        .auto-restrict-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            position: relative;
            background: rgba(10, 132, 255, 0.2);
            border: 3px solid var(--primary);
            color: var(--primary);
        }

        .auto-restrict-circle::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            animation: ripple 1.5s infinite;
        }

        .auto-restrict-progress {
            width: 300px;
            height: 6px;
            background-color: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin: 20px 0;
        }

        .auto-restrict-progress-bar {
            height: 100%;
            background-color: var(--primary);
            width: 0%;
            transition: width 0.3s;
        }

        .auto-restrict-stats {
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

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.3); opacity: 0; }
        }

        .table-row {
            animation: slideIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .table-header, .table-row {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
            }
            
            .risk-column {
                display: none;
            }
        }

        @media (max-width: 992px) {
            .table-header, .table-row {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr 1fr;
            }
            
            .bluetooth-column {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .table-header, .table-row {
                grid-template-columns: 2fr 1fr 1fr 1fr 1fr 1fr;
            }
            
            .sensors-column {
                display: none;
            }
            
            nav ul {
                display: none;
            }
            
            .filters {
                flex-direction: column;
            }
            
            .search-box {
                max-width: 100%;
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
                <h1 class="page-title">App Permissions Center</h1>
                <p class="page-subtitle">Monitor and control app permissions with detailed risk analysis</p>
            </div>
            <div>
                <button class="btn btn-primary" id="autoRestrictBtn">
                    <i class="fas fa-robot"></i>
                    Auto-Restrict High Risk
                </button>
            </div>
        </div>
        
        <div class="filters">
            <div class="filter-group">
                <button class="filter-btn active" data-filter="all">All Apps</button>
                <button class="filter-btn" data-filter="high">High Risk</button>
                <button class="filter-btn" data-filter="medium">Medium Risk</button>
                <button class="filter-btn" data-filter="low">Low Risk</button>
            </div>
            
            <div class="filter-group">
                <button class="filter-btn" data-filter="recent">Recently Updated</button>
                <button class="filter-btn" data-filter="new">New Permissions</button>
            </div>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search apps..." id="searchInput">
            </div>
        </div>
        
        <div class="apps-table">
            <div class="table-header">
                <div>Application</div>
                <div class="risk-column">Risk</div>
                <div>Camera</div>
                <div>Microphone</div>
                <div>Location</div>
                <div>Files</div>
                <div>Background</div>
                <div class="sensors-column">Sensors</div>
                <div>Clipboard</div>
                <div class="bluetooth-column">Bluetooth</div>
                <div>Actions</div>
            </div>
            
            <!-- App Rows -->
            <div class="table-row" data-risk="high" data-updated="2024-01-10" data-permissions="new">
                <div class="app-info">
                    <div class="app-icon social">SC</div>
                    <div class="app-details">
                        <div class="app-name">SocialConnect</div>
                        <div class="app-category">Social Media</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-high">High</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="socialconnect">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
            
            <div class="table-row" data-risk="high" data-updated="2024-01-08" data-permissions="stable">
                <div class="app-info">
                    <div class="app-icon shopping">SN</div>
                    <div class="app-details">
                        <div class="app-name">ShopNow</div>
                        <div class="app-category">Shopping</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-high">High</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="shopnow">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
            
            <div class="table-row" data-risk="medium" data-updated="2024-01-05" data-permissions="stable">
                <div class="app-info">
                    <div class="app-icon game">GM</div>
                    <div class="app-details">
                        <div class="app-name">GameMaster Pro</div>
                        <div class="app-category">Games</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-medium">Medium</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle active" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="gamemaster">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
            
            <div class="table-row" data-risk="medium" data-updated="2024-01-12" data-permissions="new">
                <div class="app-info">
                    <div class="app-icon tool">WE</div>
                    <div class="app-details">
                        <div class="app-name">WeatherEye</div>
                        <div class="app-category">Weather</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-medium">Medium</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="weathereye">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
            
            <div class="table-row" data-risk="low" data-updated="2024-01-02" data-permissions="stable">
                <div class="app-info">
                    <div class="app-icon photo">PC</div>
                    <div class="app-details">
                        <div class="app-name">PhotoCraft</div>
                        <div class="app-category">Photo & Video</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-low">Low</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="photocraft">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
            
            <div class="table-row" data-risk="low" data-updated="2024-01-15" data-permissions="new">
                <div class="app-info">
                    <div class="app-icon music">SM</div>
                    <div class="app-details">
                        <div class="app-name">StreamMusic</div>
                        <div class="app-category">Music & Audio</div>
                    </div>
                </div>
                <div class="risk-column">
                    <div class="risk-badge risk-low">Low</div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="camera"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="microphone"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="location"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="files"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle active" data-permission="background"></div>
                </div>
                <div class="permission-status sensors-column">
                    <div class="permission-toggle" data-permission="sensors"></div>
                </div>
                <div class="permission-status">
                    <div class="permission-toggle" data-permission="clipboard"></div>
                </div>
                <div class="permission-status bluetooth-column">
                    <div class="permission-toggle active" data-permission="bluetooth"></div>
                </div>
                <div class="action-buttons">
                    <div class="action-btn detail-btn" data-app="streammusic">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="action-btn">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- App Detail Modal -->
    <div class="modal-overlay" id="appDetailModal">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">App Details</h2>
                <div class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h3 class="section-title">
                        <i class="fas fa-history"></i>
                        Permission Usage Timeline
                    </h3>
                    <div class="permission-timeline">
                        <div class="timeline-item">
                            <div class="timeline-time">10:42 AM</div>
                            <div class="timeline-content">
                                <div class="timeline-event">Camera accessed</div>
                                <div class="timeline-desc">Used for 2 minutes during video call</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">09:15 AM</div>
                            <div class="timeline-content">
                                <div class="timeline-event">Location accessed</div>
                                <div class="timeline-desc">Background location ping while screen was off</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">08:30 AM</div>
                            <div class="timeline-content">
                                <div class="timeline-event">Microphone accessed</div>
                                <div class="timeline-desc">3-minute voice message recording</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-time">07:55 AM</div>
                            <div class="timeline-content">
                                <div class="timeline-event">Clipboard read</div>
                                <div class="timeline-desc">Copied link detected and shared</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="section-title">
                        <i class="fas fa-bug"></i>
                        Hidden Trackers Detected
                    </h3>
                    <div class="tracker-list">
                        <div class="tracker-badge">Facebook Analytics</div>
                        <div class="tracker-badge">Google AdMob</div>
                        <div class="tracker-badge">Adjust</div>
                        <div class="tracker-badge">AppsFlyer</div>
                    </div>
                </div>
                
                <div class="modal-section">
                    <h3 class="section-title">
                        <i class="fas fa-share-alt"></i>
                        Data Shared with Third Parties
                    </h3>
                    <div class="data-sharing">
                        <div class="sharing-item">
                            <div class="sharing-details">
                                <div class="sharing-company">Facebook Inc.</div>
                                <div class="sharing-purpose">Advertising & Analytics</div>
                            </div>
                            <div class="sharing-status">
                                <div class="risk-badge risk-high">High Risk</div>
                            </div>
                        </div>
                        <div class="sharing-item">
                            <div class="sharing-details">
                                <div class="sharing-company">Google LLC</div>
                                <div class="sharing-purpose">Crash Reporting & Analytics</div>
                            </div>
                            <div class="sharing-status">
                                <div class="risk-badge risk-medium">Medium Risk</div>
                            </div>
                        </div>
                        <div class="sharing-item">
                            <div class="sharing-details">
                                <div class="sharing-company">Amazon AWS</div>
                                <div class="sharing-purpose">Cloud Storage & Processing</div>
                            </div>
                            <div class="sharing-status">
                                <div class="risk-badge risk-low">Low Risk</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn">
                    <i class="fas fa-robot"></i>
                    Auto Restrict
                </button>
                <button class="btn">
                    <i class="fas fa-cube"></i>
                    Sandbox
                </button>
                <button class="btn btn-primary">
                    <i class="fas fa-flag"></i>
                    Report
                </button>
            </div>
        </div>
    </div>

    <!-- Auto Restrict Overlay -->
    <div class="auto-restrict-overlay" id="autoRestrictOverlay">
        <div class="auto-restrict-animation">
            <div class="auto-restrict-circle">
                <i class="fas fa-robot"></i>
            </div>
            <h2>Auto-Restricting High Risk Apps</h2>
            <p>Revoking dangerous permissions from high-risk applications</p>
            
            <div class="auto-restrict-progress">
                <div class="auto-restrict-progress-bar" id="autoRestrictProgressBar"></div>
            </div>
            
            <div class="auto-restrict-stats" id="autoRestrictStats">
                <div class="stat-item">
                    <div class="stat-value" id="appsProcessed">0</div>
                    <div class="stat-label">Apps Processed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="permissionsRevoked">0</div>
                    <div class="stat-label">Permissions Revoked</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="riskReduced">0%</div>
                    <div class="stat-label">Risk Reduced</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle permission switches
        document.querySelectorAll('.permission-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                if (this.classList.contains('active')) {
                    this.classList.remove('active');
                    this.classList.add('denied');
                } else if (this.classList.contains('denied')) {
                    this.classList.remove('denied');
                } else {
                    this.classList.add('active');
                }
            });
        });

        // App detail modal
        const modal = document.getElementById('appDetailModal');
        const closeModal = document.getElementById('modalClose');
        
        document.querySelectorAll('.detail-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const appName = this.getAttribute('data-app');
                // In a real app, we would fetch app-specific data here
                modal.classList.add('active');
            });
        });
        
        closeModal.addEventListener('click', function() {
            modal.classList.remove('active');
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });

        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('active');
                });
                this.classList.add('active');
                
                const filter = this.getAttribute('data-filter');
                filterApps(filter);
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.table-row');
            
            rows.forEach(row => {
                const appName = row.querySelector('.app-name').textContent.toLowerCase();
                const appCategory = row.querySelector('.app-category').textContent.toLowerCase();
                
                if (appName.includes(searchTerm) || appCategory.includes(searchTerm)) {
                    row.style.display = 'grid';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Auto-Restrict High Risk functionality
        document.getElementById('autoRestrictBtn').addEventListener('click', function() {
            const overlay = document.getElementById('autoRestrictOverlay');
            const progressBar = document.getElementById('autoRestrictProgressBar');
            const appsProcessed = document.getElementById('appsProcessed');
            const permissionsRevoked = document.getElementById('permissionsRevoked');
            const riskReduced = document.getElementById('riskReduced');
            
            // Show overlay
            overlay.classList.add('active');
            
            // Reset values
            progressBar.style.width = '0%';
            appsProcessed.textContent = '0';
            permissionsRevoked.textContent = '0';
            riskReduced.textContent = '0%';
            
            // Simulate auto-restrict process
            let progress = 0;
            let processedApps = 0;
            let revokedPermissions = 0;
            
            const processInterval = setInterval(() => {
                progress += Math.random() * 8;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(processInterval);
                    
                    // Update final stats
                    setTimeout(() => {
                        appsProcessed.textContent = '2';
                        permissionsRevoked.textContent = '8';
                        riskReduced.textContent = '42%';
                        
                        // Apply actual restrictions
                        applyAutoRestrictions();
                        
                        // Hide overlay after completion
                        setTimeout(() => {
                            overlay.classList.remove('active');
                        }, 2000);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                
                // Update stats during process
                if (progress > 30) appsProcessed.textContent = '1';
                if (progress > 60) appsProcessed.textContent = '2';
                if (progress > 20) permissionsRevoked.textContent = Math.floor(progress / 12.5);
                if (progress > 40) riskReduced.textContent = `${Math.floor(progress / 2.5)}%`;
            }, 200);
        });

        function applyAutoRestrictions() {
            // Find all high-risk apps and revoke their permissions
            const highRiskRows = document.querySelectorAll('.table-row[data-risk="high"]');
            
            highRiskRows.forEach(row => {
                const toggles = row.querySelectorAll('.permission-toggle.active');
                toggles.forEach(toggle => {
                    toggle.classList.remove('active');
                    toggle.classList.add('denied');
                });
                
                // Update risk badge to medium after restrictions
                const riskBadge = row.querySelector('.risk-badge');
                if (riskBadge) {
                    riskBadge.textContent = 'Medium';
                    riskBadge.className = 'risk-badge risk-medium';
                    row.setAttribute('data-risk', 'medium');
                }
            });
            
            // Show notification
            showNotification('Auto-restriction completed! High-risk permissions have been revoked.');
        }

        function filterApps(filter) {
            const rows = document.querySelectorAll('.table-row');
            const now = new Date();
            const sevenDaysAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
            
            rows.forEach(row => {
                const risk = row.getAttribute('data-risk');
                const updated = new Date(row.getAttribute('data-updated'));
                const permissions = row.getAttribute('data-permissions');
                
                let showRow = false;
                
                switch(filter) {
                    case 'all':
                        showRow = true;
                        break;
                    case 'high':
                        showRow = risk === 'high';
                        break;
                    case 'medium':
                        showRow = risk === 'medium';
                        break;
                    case 'low':
                        showRow = risk === 'low';
                        break;
                    case 'recent':
                        showRow = updated >= sevenDaysAgo;
                        break;
                    case 'new':
                        showRow = permissions === 'new';
                        break;
                    default:
                        showRow = true;
                }
                
                row.style.display = showRow ? 'grid' : 'none';
            });
        }

        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--primary);
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                z-index: 1001;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                max-width: 300px;
            `;
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-check-circle"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Simulate real-time updates
        setInterval(() => {
            // Randomly toggle a permission to simulate changes
            const toggles = document.querySelectorAll('.permission-toggle');
            const randomToggle = toggles[Math.floor(Math.random() * toggles.length)];
            
            if (Math.random() > 0.7) {
                if (randomToggle.classList.contains('active')) {
                    randomToggle.classList.remove('active');
                    randomToggle.classList.add('denied');
                } else if (randomToggle.classList.contains('denied')) {
                    randomToggle.classList.remove('denied');
                } else {
                    randomToggle.classList.add('active');
                }
            }
        }, 10000);
    </script>
</body>
</html>