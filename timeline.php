<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - Data Access Timeline</title>
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

        /* Timeline Controls */
        .timeline-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .date-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-btn {
            padding: 8px 12px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s;
        }

        .date-btn.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .date-btn:hover {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--text);
        }

        .playback-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .playback-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            color: var(--text);
            cursor: pointer;
            transition: all 0.3s;
        }

        .playback-btn:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .playback-btn.primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .playback-speed {
            padding: 8px 12px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-size: 0.9rem;
        }

        /* Category Filters */
        .category-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .category-filter {
            padding: 8px 16px;
            background-color: var(--dark-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .category-filter.active {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .category-filter:hover {
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--text);
        }

        /* Timeline Visualization */
        .timeline-viz {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .timeline-canvas-container {
            height: 300px;
            position: relative;
        }

        .timeline-hours {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding: 0 10px;
        }

        .timeline-hour {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .playback-indicator {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: var(--primary);
            box-shadow: var(--cyber-glow);
            z-index: 10;
            transition: left 0.5s linear;
        }

        .playback-time {
            position: absolute;
            top: -25px;
            left: 0;
            transform: translateX(-50%);
            background-color: var(--primary);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Events List */
        .events-container {
            background-color: var(--dark-card);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .events-header {
            display: grid;
            grid-template-columns: 100px 1fr 120px 150px;
            padding: 15px 20px;
            background-color: rgba(30, 30, 30, 0.8);
            border-bottom: 1px solid var(--border);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .event-row {
            display: grid;
            grid-template-columns: 100px 1fr 120px 150px;
            padding: 15px 20px;
            border-bottom: 1px solid var(--border);
            align-items: center;
            transition: background-color 0.3s;
        }

        .event-row:last-child {
            border-bottom: none;
        }

        .event-row:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .event-row.suspicious {
            border-left: 3px solid var(--danger);
        }

        .event-time {
            font-weight: 600;
        }

        .event-app {
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
        .app-icon.music { background: linear-gradient(135deg, #fd79a8, #fdcb6e); }

        .app-name {
            font-weight: 600;
        }

        .event-type {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .type-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .type-icon.mic { background-color: rgba(10, 132, 255, 0.2); color: var(--primary); }
        .type-icon.camera { background-color: rgba(255, 159, 10, 0.2); color: var(--warning); }
        .type-icon.location { background-color: rgba(48, 209, 88, 0.2); color: var(--success); }
        .type-icon.clipboard { background-color: rgba(142, 68, 173, 0.2); color: var(--secondary); }
        .type-icon.network { background-color: rgba(255, 55, 95, 0.2); color: var(--danger); }

        .event-context {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .context-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .context-screen-off {
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .context-sleep {
            background-color: rgba(142, 68, 173, 0.2);
            color: var(--secondary);
        }

        .context-background {
            background-color: rgba(255, 159, 10, 0.2);
            color: var(--warning);
        }

        /* Advanced Features */
        .advanced-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .advanced-card {
            background-color: var(--dark-card);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .correlation-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .correlation-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .correlation-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 55, 95, 0.2);
            color: var(--danger);
        }

        .correlation-content {
            flex: 1;
        }

        .correlation-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .correlation-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .context-timeline {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .context-period {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px;
            border-radius: 8px;
            background-color: rgba(30, 30, 30, 0.7);
        }

        .period-time {
            width: 80px;
            font-weight: 600;
        }

        .period-bar {
            flex: 1;
            height: 20px;
            background-color: var(--border);
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .period-fill {
            height: 100%;
            border-radius: 10px;
        }

        .period-fill.sleep {
            background: linear-gradient(90deg, #6c5ce7, #a29bfe);
            width: 35%;
        }

        .period-fill.screen-off {
            background: linear-gradient(90deg, #e17055, #fdcb6e);
            width: 25%;
        }

        .period-fill.idle {
            background: linear-gradient(90deg, #00b894, #00cec9);
            width: 40%;
        }

        .period-label {
            width: 80px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            text-align: right;
        }

        /* Simulation Overlays */
        .simulation-overlay {
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

        .simulation-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .simulation-animation {
            text-align: center;
            margin-bottom: 30px;
        }

        .simulation-circle {
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

        .simulation-circle::after {
            content: '';
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 3px solid var(--primary);
            animation: ripple 1.5s infinite;
        }

        .simulation-progress {
            width: 300px;
            height: 6px;
            background-color: var(--border);
            border-radius: 3px;
            overflow: hidden;
            margin: 20px 0;
        }

        .simulation-progress-bar {
            height: 100%;
            background-color: var(--primary);
            width: 0%;
            transition: width 0.3s;
        }

        .simulation-stats {
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

        @keyframes highlight {
            0% { background-color: rgba(10, 132, 255, 0.3); }
            50% { background-color: rgba(10, 132, 255, 0.6); }
            100% { background-color: rgba(10, 132, 255, 0.3); }
        }

        .event-row {
            animation: slideIn 0.5s ease-out;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .advanced-features {
                grid-template-columns: 1fr;
            }
            
            .events-header, .event-row {
                grid-template-columns: 80px 1fr 100px;
            }
            
            .event-context {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .timeline-controls {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .playback-controls {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
            }
            
            .events-header, .event-row {
                grid-template-columns: 70px 1fr;
            }
            
            .event-type {
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
                <h1 class="page-title">Data Access Timeline</h1>
                <p class="page-subtitle">Advanced forensics and visualization of app data access patterns</p>
            </div>
            <div>
                <button class="btn btn-primary" id="playbackBtn">
                    <i class="fas fa-play"></i>
                    Playback Today
                </button>
            </div>
        </div>
        
        <div class="timeline-controls">
            <div class="date-selector">
                <button class="date-btn active" data-date="today">Today</button>
                <button class="date-btn" data-date="yesterday">Yesterday</button>
                <button class="date-btn" data-date="week">This Week</button>
                <button class="date-btn" data-date="custom">Custom Range</button>
            </div>
            
            <div class="playback-controls">
                <button class="playback-btn" id="rewindBtn">
                    <i class="fas fa-backward"></i>
                </button>
                <button class="playback-btn primary" id="playPauseBtn">
                    <i class="fas fa-play" id="playIcon"></i>
                </button>
                <button class="playback-btn" id="forwardBtn">
                    <i class="fas fa-forward"></i>
                </button>
                <select class="playback-speed" id="speedSelect">
                    <option value="1">1x Speed</option>
                    <option value="2">2x Speed</option>
                    <option value="5">5x Speed</option>
                    <option value="10">10x Speed</option>
                </select>
            </div>
        </div>
        
        <div class="category-filters">
            <div class="category-filter active" data-category="all">
                <i class="fas fa-layer-group"></i>
                All Events
            </div>
            <div class="category-filter" data-category="mic">
                <i class="fas fa-microphone"></i>
                Microphone
            </div>
            <div class="category-filter" data-category="camera">
                <i class="fas fa-camera"></i>
                Camera
            </div>
            <div class="category-filter" data-category="location">
                <i class="fas fa-map-marker-alt"></i>
                Location
            </div>
            <div class="category-filter" data-category="clipboard">
                <i class="fas fa-clipboard"></i>
                Clipboard
            </div>
            <div class="category-filter" data-category="network">
                <i class="fas fa-network-wired"></i>
                Network
            </div>
            <div class="category-filter" data-category="suspicious">
                <i class="fas fa-exclamation-triangle"></i>
                Suspicious
            </div>
        </div>
        
        <div class="timeline-viz">
            <div class="timeline-canvas-container">
                <canvas id="timelineChart"></canvas>
                <div class="playback-indicator" id="playbackIndicator">
                    <div class="playback-time" id="playbackTime">12:00 AM</div>
                </div>
            </div>
            <div class="timeline-hours">
                <div class="timeline-hour">12AM</div>
                <div class="timeline-hour">3AM</div>
                <div class="timeline-hour">6AM</div>
                <div class="timeline-hour">9AM</div>
                <div class="timeline-hour">12PM</div>
                <div class="timeline-hour">3PM</div>
                <div class="timeline-hour">6PM</div>
                <div class="timeline-hour">9PM</div>
                <div class="timeline-hour">12AM</div>
            </div>
        </div>
        
        <div class="events-container" id="eventsContainer">
            <div class="events-header">
                <div>Time</div>
                <div>Application & Event</div>
                <div>Type</div>
                <div>Context</div>
            </div>
            
            <!-- Events will be populated by JavaScript -->
        </div>
        
        <div class="advanced-features">
            <div class="advanced-card">
                <h3 class="card-title">
                    <i class="fas fa-link"></i>
                    Data Correlation
                </h3>
                <div class="correlation-list" id="correlationList">
                    <!-- Correlation items will be populated by JavaScript -->
                </div>
            </div>
            
            <div class="advanced-card">
                <h3 class="card-title">
                    <i class="fas fa-user-clock"></i>
                    Context Timeline
                </h3>
                <div class="context-timeline">
                    <div class="context-period">
                        <div class="period-time">12AM - 7AM</div>
                        <div class="period-bar">
                            <div class="period-fill sleep"></div>
                        </div>
                        <div class="period-label">Sleep Hours</div>
                    </div>
                    
                    <div class="context-period">
                        <div class="period-time">7AM - 9AM</div>
                        <div class="period-bar">
                            <div class="period-fill idle"></div>
                        </div>
                        <div class="period-label">Morning Routine</div>
                    </div>
                    
                    <div class="context-period">
                        <div class="period-time">9AM - 5PM</div>
                        <div class="period-bar">
                            <div class="period-fill screen-off"></div>
                        </div>
                        <div class="period-label">Work Hours</div>
                    </div>
                    
                    <div class="context-period">
                        <div class="period-time">5PM - 10PM</div>
                        <div class="period-bar">
                            <div class="period-fill idle"></div>
                        </div>
                        <div class="period-label">Evening Activity</div>
                    </div>
                    
                    <div class="context-period">
                        <div class="period-time">10PM - 12AM</div>
                        <div class="period-bar">
                            <div class="period-fill sleep"></div>
                        </div>
                        <div class="period-label">Wind Down</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Simulation Overlays -->
    <div class="simulation-overlay" id="dataSimulationOverlay">
        <div class="simulation-animation">
            <div class="simulation-circle">
                <i class="fas fa-database"></i>
            </div>
            <h2>Generating Timeline Data</h2>
            <p>Analyzing app activities and data access patterns</p>
            
            <div class="simulation-progress">
                <div class="simulation-progress-bar" id="dataSimulationProgressBar"></div>
            </div>
            
            <div class="simulation-stats" id="dataSimulationStats">
                <div class="stat-item">
                    <div class="stat-value" id="eventsGenerated">0</div>
                    <div class="stat-label">Events Generated</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="appsAnalyzed">0</div>
                    <div class="stat-label">Apps Analyzed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="patternsFound">0</div>
                    <div class="stat-label">Patterns Found</div>
                </div>
            </div>
        </div>
    </div>

    <div class="simulation-overlay" id="dateSimulationOverlay">
        <div class="simulation-animation">
            <div class="simulation-circle">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <h2 id="dateSimulationTitle">Loading Timeline Data</h2>
            <p id="dateSimulationDesc">Fetching data for the selected time period</p>
            
            <div class="simulation-progress">
                <div class="simulation-progress-bar" id="dateSimulationProgressBar"></div>
            </div>
            
            <div class="simulation-stats" id="dateSimulationStats">
                <div class="stat-item">
                    <div class="stat-value" id="dateEventsLoaded">0</div>
                    <div class="stat-label">Events Loaded</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="dateSuspiciousFound">0</div>
                    <div class="stat-label">Suspicious Found</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="dateCorrelations">0</div>
                    <div class="stat-label">Correlations</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data for events
        const sampleEvents = [
            {
                time: "02:15 AM",
                app: "SocialConnect",
                appIcon: "social",
                appCode: "SC",
                event: "Accessed microphone for 3 minutes",
                type: "mic",
                typeIcon: "fas fa-microphone",
                context: ["screen-off", "sleep"],
                suspicious: true
            },
            {
                time: "07:30 AM",
                app: "WeatherEye",
                appIcon: "tool",
                appCode: "WE",
                event: "Requested precise location",
                type: "location",
                typeIcon: "fas fa-map-marker-alt",
                context: ["background"],
                suspicious: false
            },
            {
                time: "08:45 AM",
                app: "ShopNow",
                appIcon: "shopping",
                appCode: "SN",
                event: "Read clipboard contents",
                type: "clipboard",
                typeIcon: "fas fa-clipboard",
                context: ["background"],
                suspicious: false
            },
            {
                time: "10:20 AM",
                app: "GameMaster Pro",
                appIcon: "game",
                appCode: "GM",
                event: "Transmitted 15MB data to external server",
                type: "network",
                typeIcon: "fas fa-network-wired",
                context: ["background"],
                suspicious: true
            },
            {
                time: "12:15 PM",
                app: "SocialConnect",
                appIcon: "social",
                appCode: "SC",
                event: "Accessed front camera for 45 seconds",
                type: "camera",
                typeIcon: "fas fa-camera",
                context: [],
                suspicious: false
            },
            {
                time: "03:45 PM",
                app: "FlashLight+",
                appIcon: "tool",
                appCode: "FL",
                event: "Accessed contacts list",
                type: "network",
                typeIcon: "fas fa-network-wired",
                context: ["background"],
                suspicious: true
            },
            {
                time: "07:30 PM",
                app: "StreamMusic",
                appIcon: "music",
                appCode: "SM",
                event: "Accessed device storage",
                type: "network",
                typeIcon: "fas fa-network-wired",
                context: [],
                suspicious: false
            },
            {
                time: "11:20 PM",
                app: "ShopNow",
                appIcon: "shopping",
                appCode: "SN",
                event: "Accessed gyroscope sensor",
                type: "network",
                typeIcon: "fas fa-network-wired",
                context: ["screen-off"],
                suspicious: true
            }
        ];

        const correlationData = [
            {
                icon: "fas fa-microphone",
                title: "Mic + Network Activity",
                desc: "SocialConnect accessed microphone then immediately sent data to external server"
            },
            {
                icon: "fas fa-camera",
                title: "Camera + Location",
                desc: "PhotoCraft accessed camera and location simultaneously, unusual for photo editing"
            },
            {
                icon: "fas fa-clipboard",
                title: "Clipboard + Network",
                desc: "ShopNow read clipboard then sent encrypted data to analytics server"
            }
        ];

        // Initialize the application
        document.addEventListener('DOMContentLoaded', function() {
            initializeTimeline();
            setupEventListeners();
            simulateDataGeneration();
        });

        function initializeTimeline() {
            renderEvents();
            renderCorrelations();
            initializeChart();
        }

        function renderEvents() {
            const eventsContainer = document.getElementById('eventsContainer');
            // Clear existing events except header
            const header = eventsContainer.querySelector('.events-header');
            eventsContainer.innerHTML = '';
            eventsContainer.appendChild(header);
            
            sampleEvents.forEach(event => {
                const eventRow = document.createElement('div');
                eventRow.className = `event-row ${event.suspicious ? 'suspicious' : ''}`;
                eventRow.setAttribute('data-type', event.type);
                eventRow.setAttribute('data-time', event.time);
                
                // Create context badges
                const contextBadges = event.context.map(ctx => {
                    let badgeClass = 'context-badge ';
                    let badgeText = '';
                    
                    switch(ctx) {
                        case 'screen-off':
                            badgeClass += 'context-screen-off';
                            badgeText = 'Screen Off';
                            break;
                        case 'sleep':
                            badgeClass += 'context-sleep';
                            badgeText = 'Sleep Hours';
                            break;
                        case 'background':
                            badgeClass += 'context-background';
                            badgeText = 'Background';
                            break;
                    }
                    
                    return `<div class="${badgeClass}">${badgeText}</div>`;
                }).join('');
                
                eventRow.innerHTML = `
                    <div class="event-time">${event.time}</div>
                    <div class="event-app">
                        <div class="app-icon ${event.appIcon}">${event.appCode}</div>
                        <div>
                            <div class="app-name">${event.app}</div>
                            <div class="event-desc">${event.event}</div>
                        </div>
                    </div>
                    <div class="event-type">
                        <div class="type-icon ${event.type}">
                            <i class="${event.typeIcon}"></i>
                        </div>
                        <div>${event.type.charAt(0).toUpperCase() + event.type.slice(1)}</div>
                    </div>
                    <div class="event-context">
                        ${contextBadges}
                    </div>
                `;
                
                eventsContainer.appendChild(eventRow);
            });
        }

        function renderCorrelations() {
            const correlationList = document.getElementById('correlationList');
            correlationList.innerHTML = '';
            
            correlationData.forEach(corr => {
                const item = document.createElement('div');
                item.className = 'correlation-item';
                item.innerHTML = `
                    <div class="correlation-icon">
                        <i class="${corr.icon}"></i>
                    </div>
                    <div class="correlation-content">
                        <div class="correlation-title">${corr.title}</div>
                        <div class="correlation-desc">${corr.desc}</div>
                    </div>
                `;
                correlationList.appendChild(item);
            });
        }

        function initializeChart() {
            const ctx = document.getElementById('timelineChart').getContext('2d');
            
            // Generate sample data for the timeline
            const hours = Array.from({length: 24}, (_, i) => i);
            const events = hours.map(hour => {
                // Generate random events for each hour
                const count = Math.floor(Math.random() * 5);
                return {
                    hour: hour,
                    count: count,
                    types: ['mic', 'camera', 'location', 'clipboard', 'network'].filter(() => Math.random() > 0.7)
                };
            });
            
            window.timelineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: hours.map(h => h === 0 ? '12AM' : h < 12 ? `${h}AM` : h === 12 ? '12PM' : `${h-12}PM`),
                    datasets: [
                        {
                            label: 'Microphone',
                            data: hours.map(h => events[h].types.includes('mic') ? events[h].count : 0),
                            backgroundColor: 'rgba(10, 132, 255, 0.7)',
                            borderColor: 'rgba(10, 132, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Camera',
                            data: hours.map(h => events[h].types.includes('camera') ? events[h].count : 0),
                            backgroundColor: 'rgba(255, 159, 10, 0.7)',
                            borderColor: 'rgba(255, 159, 10, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Location',
                            data: hours.map(h => events[h].types.includes('location') ? events[h].count : 0),
                            backgroundColor: 'rgba(48, 209, 88, 0.7)',
                            borderColor: 'rgba(48, 209, 88, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Clipboard',
                            data: hours.map(h => events[h].types.includes('clipboard') ? events[h].count : 0),
                            backgroundColor: 'rgba(142, 68, 173, 0.7)',
                            borderColor: 'rgba(142, 68, 173, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Network',
                            data: hours.map(h => events[h].types.includes('network') ? events[h].count : 0),
                            backgroundColor: 'rgba(255, 55, 95, 0.7)',
                            borderColor: 'rgba(255, 55, 95, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                color: 'rgba(44, 44, 46, 0.5)'
                            },
                            ticks: {
                                color: 'rgba(160, 160, 160, 0.7)'
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            max: 10,
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
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    }
                }
            });
        }

        function setupEventListeners() {
            // Playback functionality
            const playbackIndicator = document.getElementById('playbackIndicator');
            const playbackTime = document.getElementById('playbackTime');
            const playPauseBtn = document.getElementById('playPauseBtn');
            const playIcon = document.getElementById('playIcon');
            const rewindBtn = document.getElementById('rewindBtn');
            const forwardBtn = document.getElementById('forwardBtn');
            const speedSelect = document.getElementById('speedSelect');
            const playbackBtn = document.getElementById('playbackBtn');
            
            let isPlaying = false;
            let currentTime = 0; // 0 to 24 hours
            let playbackInterval;
            
            function updatePlaybackIndicator() {
                const percentage = (currentTime / 24) * 100;
                playbackIndicator.style.left = `${percentage}%`;
                
                // Format time for display
                const hours = Math.floor(currentTime);
                const minutes = Math.floor((currentTime - hours) * 60);
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const displayHours = hours % 12 || 12;
                const displayMinutes = minutes.toString().padStart(2, '0');
                playbackTime.textContent = `${displayHours}:${displayMinutes} ${ampm}`;
            }
            
            function startPlayback() {
                if (isPlaying) return;
                
                isPlaying = true;
                playIcon.classList.remove('fa-play');
                playIcon.classList.add('fa-pause');
                
                const speed = parseInt(speedSelect.value);
                const step = 0.1 * speed; // Move 6 minutes per interval at 1x
                
                playbackInterval = setInterval(() => {
                    currentTime += step;
                    if (currentTime >= 24) {
                        currentTime = 0;
                        stopPlayback();
                    }
                    updatePlaybackIndicator();
                    
                    // Highlight events that happened at this time
                    highlightEventsAtTime(currentTime);
                }, 200);
            }
            
            function stopPlayback() {
                isPlaying = false;
                playIcon.classList.remove('fa-pause');
                playIcon.classList.add('fa-play');
                clearInterval(playbackInterval);
            }
            
            function highlightEventsAtTime(time) {
                const eventRows = document.querySelectorAll('.event-row');
                eventRows.forEach(row => {
                    const timeText = row.querySelector('.event-time').textContent;
                    const eventTime = parseTime(timeText);
                    
                    // If event time is within 15 minutes of current playback time
                    if (Math.abs(eventTime - time) < 0.25) {
                        row.style.animation = 'highlight 2s infinite';
                        row.style.borderLeft = '3px solid var(--primary)';
                    } else {
                        row.style.animation = '';
                        if (row.classList.contains('suspicious')) {
                            row.style.borderLeft = '3px solid var(--danger)';
                        } else {
                            row.style.borderLeft = 'none';
                        }
                    }
                });
            }
            
            function parseTime(timeStr) {
                const [time, modifier] = timeStr.split(' ');
                let [hours, minutes] = time.split(':').map(Number);
                
                if (modifier === 'PM' && hours !== 12) hours += 12;
                if (modifier === 'AM' && hours === 12) hours = 0;
                
                return hours + (minutes / 60);
            }
            
            playPauseBtn.addEventListener('click', function() {
                if (isPlaying) {
                    stopPlayback();
                } else {
                    startPlayback();
                }
            });
            
            rewindBtn.addEventListener('click', function() {
                currentTime = Math.max(0, currentTime - 1);
                updatePlaybackIndicator();
                highlightEventsAtTime(currentTime);
            });
            
            forwardBtn.addEventListener('click', function() {
                currentTime = Math.min(24, currentTime + 1);
                updatePlaybackIndicator();
                highlightEventsAtTime(currentTime);
            });
            
            playbackBtn.addEventListener('click', function() {
                currentTime = 0;
                updatePlaybackIndicator();
                startPlayback();
            });

            // Category filters
            const categoryFilters = document.querySelectorAll('.category-filter');
            categoryFilters.forEach(filter => {
                filter.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    categoryFilters.forEach(f => f.classList.remove('active'));
                    this.classList.add('active');
                    
                    filterEventsByCategory(category);
                });
            });

            // Date selector
            const dateButtons = document.querySelectorAll('.date-btn');
            dateButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const date = this.getAttribute('data-date');
                    
                    dateButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    simulateDateChange(date);
                });
            });

            // Initialize playback indicator
            updatePlaybackIndicator();
        }

        function filterEventsByCategory(category) {
            const eventRows = document.querySelectorAll('.event-row');
            
            if (category === 'all') {
                eventRows.forEach(row => row.style.display = 'grid');
            } else if (category === 'suspicious') {
                eventRows.forEach(row => {
                    if (row.classList.contains('suspicious')) {
                        row.style.display = 'grid';
                    } else {
                        row.style.display = 'none';
                    }
                });
            } else {
                eventRows.forEach(row => {
                    const type = row.getAttribute('data-type');
                    if (type === category) {
                        row.style.display = 'grid';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        }

        function simulateDataGeneration() {
            const overlay = document.getElementById('dataSimulationOverlay');
            const progressBar = document.getElementById('dataSimulationProgressBar');
            const eventsGenerated = document.getElementById('eventsGenerated');
            const appsAnalyzed = document.getElementById('appsAnalyzed');
            const patternsFound = document.getElementById('patternsFound');
            
            // Show overlay
            overlay.classList.add('active');
            
            // Reset values
            progressBar.style.width = '0%';
            eventsGenerated.textContent = '0';
            appsAnalyzed.textContent = '0';
            patternsFound.textContent = '0';
            
            // Simulate data generation
            let progress = 0;
            const simulationInterval = setInterval(() => {
                progress += Math.random() * 8;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(simulationInterval);
                    
                    // Update final stats
                    setTimeout(() => {
                        eventsGenerated.textContent = '142';
                        appsAnalyzed.textContent = '23';
                        patternsFound.textContent = '8';
                        
                        // Hide overlay after completion
                        setTimeout(() => {
                            overlay.classList.remove('active');
                        }, 1500);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                
                // Update stats during simulation
                if (progress > 20) eventsGenerated.textContent = Math.floor(progress * 1.4);
                if (progress > 40) appsAnalyzed.textContent = Math.floor(progress / 4.3);
                if (progress > 60) patternsFound.textContent = Math.floor(progress / 12.5);
            }, 100);
        }

        function simulateDateChange(date) {
            const overlay = document.getElementById('dateSimulationOverlay');
            const progressBar = document.getElementById('dateSimulationProgressBar');
            const title = document.getElementById('dateSimulationTitle');
            const desc = document.getElementById('dateSimulationDesc');
            const eventsLoaded = document.getElementById('dateEventsLoaded');
            const suspiciousFound = document.getElementById('dateSuspiciousFound');
            const correlations = document.getElementById('dateCorrelations');
            
            // Set title and description based on date
            let dateText = '';
            switch(date) {
                case 'today':
                    dateText = 'Today';
                    break;
                case 'yesterday':
                    dateText = 'Yesterday';
                    break;
                case 'week':
                    dateText = 'This Week';
                    break;
                case 'custom':
                    dateText = 'Custom Range';
                    break;
            }
            
            title.textContent = `Loading ${dateText} Data`;
            desc.textContent = `Analyzing data access patterns for ${dateText.toLowerCase()}`;
            
            // Show overlay
            overlay.classList.add('active');
            
            // Reset values
            progressBar.style.width = '0%';
            eventsLoaded.textContent = '0';
            suspiciousFound.textContent = '0';
            correlations.textContent = '0';
            
            // Simulate date change
            let progress = 0;
            const simulationInterval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(simulationInterval);
                    
                    // Update final stats (randomized based on date)
                    setTimeout(() => {
                        let eventCount, suspiciousCount, correlationCount;
                        
                        switch(date) {
                            case 'today':
                                eventCount = 142;
                                suspiciousCount = 8;
                                correlationCount = 3;
                                break;
                            case 'yesterday':
                                eventCount = 156;
                                suspiciousCount = 12;
                                correlationCount = 5;
                                break;
                            case 'week':
                                eventCount = 987;
                                suspiciousCount = 47;
                                correlationCount = 18;
                                break;
                            case 'custom':
                                eventCount = 234;
                                suspiciousCount = 15;
                                correlationCount = 7;
                                break;
                        }
                        
                        eventsLoaded.textContent = eventCount;
                        suspiciousFound.textContent = suspiciousCount;
                        correlations.textContent = correlationCount;
                        
                        // Hide overlay after completion
                        setTimeout(() => {
                            overlay.classList.remove('active');
                            showNotification(`${dateText} data loaded successfully!`);
                        }, 1500);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                
                // Update stats during simulation
                if (progress > 25) eventsLoaded.textContent = Math.floor(progress * 1.5);
                if (progress > 50) suspiciousFound.textContent = Math.floor(progress / 8);
                if (progress > 75) correlations.textContent = Math.floor(progress / 14);
            }, 120);
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
    </script>
</body>
</html>