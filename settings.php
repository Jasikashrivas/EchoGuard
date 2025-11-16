<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoGuard - Settings & Configuration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* Settings Layout */
        .settings-container {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 30px;
            margin-bottom: 50px;
        }

        /* Settings Sidebar */
        .settings-sidebar {
            background-color: var(--dark-card);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
            position: sticky;
            top: 100px;
            height: fit-content;
        }

        .sidebar-item {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border);
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-item:last-child {
            border-bottom: none;
        }

        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .sidebar-item.active {
            background-color: rgba(10, 132, 255, 0.2);
            border-left: 3px solid var(--primary);
        }

        .sidebar-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
        }

        .sidebar-text {
            font-weight: 500;
        }

        /* Settings Content */
        .settings-content {
            background-color: var(--dark-card);
            border-radius: 12px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .content-section {
            padding: 30px;
            border-bottom: 1px solid var(--border);
            display: none;
        }

        .content-section.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        .content-section:last-child {
            border-bottom: none;
        }

        .section-header {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .section-desc {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        /* Settings Groups */
        .settings-group {
            margin-bottom: 30px;
        }

        .group-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .setting-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .setting-info {
            flex: 1;
        }

        .setting-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .setting-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .setting-control {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--border);
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: var(--primary);
        }

        input:checked + .toggle-slider:before {
            transform: translateX(24px);
        }

        /* Select Dropdown */
        .select-wrapper {
            position: relative;
            min-width: 150px;
        }

        .select-wrapper select {
            width: 100%;
            padding: 8px 12px;
            background-color: var(--darker);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text);
            font-size: 0.9rem;
            appearance: none;
            cursor: pointer;
        }

        .select-wrapper::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
        }

        /* Radio Buttons */
        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .radio-input {
            display: none;
        }

        .radio-custom {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .radio-custom::after {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--primary);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .radio-input:checked + .radio-custom {
            border-color: var(--primary);
        }

        .radio-input:checked + .radio-custom::after {
            opacity: 1;
        }

        .radio-label {
            font-size: 0.9rem;
        }

        /* Theme Options */
        .theme-options {
            display: flex;
            gap: 20px;
        }

        .theme-option {
            flex: 1;
            border: 2px solid var(--border);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .theme-option:hover {
            border-color: var(--primary);
        }

        .theme-option.active {
            border-color: var(--primary);
            background-color: rgba(10, 132, 255, 0.1);
        }

        .theme-preview {
            width: 100%;
            height: 80px;
            border-radius: 6px;
            margin-bottom: 10px;
            display: flex;
            overflow: hidden;
        }

        .theme-dark .theme-preview {
            background: linear-gradient(135deg, #121212 70%, #1e1e1e 30%);
        }

        .theme-glow .theme-preview {
            background: linear-gradient(135deg, #0a0a0a 70%, #1e1e1e 30%);
            box-shadow: inset 0 0 10px rgba(10, 132, 255, 0.3);
        }

        .theme-auto .theme-preview {
            background: linear-gradient(135deg, #f5f5f7 50%, #121212 50%);
        }

        .theme-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .theme-desc {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        /* Security Options */
        .security-options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .security-option {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        .security-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .security-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(10, 132, 255, 0.2);
            color: var(--primary);
        }

        .security-details {
            flex: 1;
        }

        .security-title {
            font-weight: 500;
            margin-bottom: 4px;
        }

        .security-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .security-status {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--success);
        }

        .security-status.disabled {
            color: var(--text-secondary);
        }

        .security-action {
            margin-left: 15px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        /* Danger Zone */
        .danger-zone {
            background-color: rgba(255, 55, 95, 0.1);
            border: 1px solid rgba(255, 55, 95, 0.3);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }

        .danger-title {
            color: var(--danger);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .danger-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 15px;
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

        /* Responsive */
        @media (max-width: 992px) {
            .settings-container {
                grid-template-columns: 1fr;
            }
            
            .settings-sidebar {
                position: static;
                margin-bottom: 20px;
            }
            
            .sidebar-items {
                display: flex;
                overflow-x: auto;
            }
            
            .sidebar-item {
                flex-shrink: 0;
                border-bottom: none;
                border-right: 1px solid var(--border);
            }
            
            .sidebar-item.active {
                border-left: none;
                border-bottom: 3px solid var(--primary);
            }
        }

        @media (max-width: 768px) {
            .theme-options {
                flex-direction: column;
            }
            
            .radio-group {
                flex-direction: column;
                gap: 10px;
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
                <h1 class="page-title">Settings & Configuration</h1>
                <p class="page-subtitle">Customize your EchoGuard experience and security preferences</p>
            </div>
            <div>
                <button class="btn btn-primary" id="exportSettings">
                    <i class="fas fa-download"></i>
                    Export Settings
                </button>
            </div>
        </div>
        
        <div class="settings-container">
            <div class="settings-sidebar">
                <div class="sidebar-item active" data-section="notifications">
                    <div class="sidebar-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="sidebar-text">Notifications</div>
                </div>
                
                <div class="sidebar-item" data-section="simulation">
                    <div class="sidebar-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="sidebar-text">Simulation</div>
                </div>
                
                <div class="sidebar-item" data-section="updates">
                    <div class="sidebar-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="sidebar-text">Auto Updates</div>
                </div>
                
                <div class="sidebar-item" data-section="theme">
                    <div class="sidebar-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="sidebar-text">Theme</div>
                </div>
                
                <div class="sidebar-item" data-section="security">
                    <div class="sidebar-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="sidebar-text">PIN & Biometric</div>
                </div>
                
                <div class="sidebar-item" data-section="privacy">
                    <div class="sidebar-icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <div class="sidebar-text">Privacy Sandbox</div>
                </div>
                
                <div class="sidebar-item" data-section="advanced">
                    <div class="sidebar-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="sidebar-text">Advanced</div>
                </div>
            </div>
            
            <div class="settings-content">
                <!-- Notifications Section -->
                <div class="content-section active" id="notifications">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-bell"></i>
                            Notification Settings
                        </h2>
                        <p class="section-desc">
                            Configure how and when you receive security alerts and updates
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-shield-alt"></i>
                            Security Alerts
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Threat Level Notifications</div>
                                <div class="setting-desc">Receive alerts for high and critical threat levels</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Background Activity Alerts</div>
                                <div class="setting-desc">Notify when apps access sensors in background</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Night-time Activity</div>
                                <div class="setting-desc">Alert on suspicious activity during sleep hours</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-volume-up"></i>
                            Alert Intensity
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Notification Level</div>
                                <div class="setting-desc">Set the intensity of security notifications</div>
                            </div>
                            <div class="setting-control">
                                <div class="select-wrapper">
                                    <select>
                                        <option>Aggressive</option>
                                        <option selected>Balanced</option>
                                        <option>Minimal</option>
                                        <option>Silent</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Vibration Alerts</div>
                                <div class="setting-desc">Enable vibration for critical alerts</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">LED Notifications</div>
                                <div class="setting-desc">Use device LED for security alerts</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Simulation Section -->
                <div class="content-section" id="simulation">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-gamepad"></i>
                            Simulation Settings
                        </h2>
                        <p class="section-desc">
                            Configure the security simulation center and training modules
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-sliders-h"></i>
                            Difficulty & Experience
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Simulation Difficulty</div>
                                <div class="setting-desc">Adjust the challenge level of security simulations</div>
                            </div>
                            <div class="setting-control">
                                <div class="select-wrapper">
                                    <select>
                                        <option>Beginner</option>
                                        <option selected>Intermediate</option>
                                        <option>Advanced</option>
                                        <option>Expert</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Hints & Guidance</div>
                                <div class="setting-desc">Show helpful hints during simulations</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Real-time Feedback</div>
                                <div class="setting-desc">Provide immediate feedback during training</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-chart-line"></i>
                            Progress Tracking
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Leaderboard Participation</div>
                                <div class="setting-desc">Include your scores in global rankings</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Progress Analytics</div>
                                <div class="setting-desc">Track and analyze your learning progress</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Auto Updates Section -->
                <div class="content-section" id="updates">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-sync-alt"></i>
                            Auto Updates
                        </h2>
                        <p class="section-desc">
                            Manage how EchoGuard stays updated with the latest security features
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-cloud-download-alt"></i>
                            Update Preferences
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Automatic Updates</div>
                                <div class="setting-desc">Download and install updates automatically</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Update Channel</div>
                                <div class="setting-desc">Choose which version stream to follow</div>
                            </div>
                            <div class="setting-control">
                                <div class="radio-group">
                                    <label class="radio-option">
                                        <input type="radio" name="update-channel" class="radio-input" checked>
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Stable</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="update-channel" class="radio-input">
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Beta</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="update-channel" class="radio-input">
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Nightly</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Threat Database Updates</div>
                                <div class="setting-desc">Automatically update malware and threat signatures</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-wifi"></i>
                            Network Usage
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Wi-Fi Only Updates</div>
                                <div class="setting-desc">Only download updates when connected to Wi-Fi</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Background Data</div>
                                <div class="setting-desc">Allow updates using mobile data in background</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Theme Section -->
                <div class="content-section" id="theme">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-palette"></i>
                            Theme & Appearance
                        </h2>
                        <p class="section-desc">
                            Customize the look and feel of EchoGuard to match your preferences
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-fill-drip"></i>
                            Color Theme
                        </h3>
                        
                        <div class="theme-options">
                            <div class="theme-option theme-dark active">
                                <div class="theme-preview"></div>
                                <div class="theme-name">Dark</div>
                                <div class="theme-desc">Default dark theme</div>
                            </div>
                            
                            <div class="theme-option theme-glow">
                                <div class="theme-preview"></div>
                                <div class="theme-name">Glow</div>
                                <div class="theme-desc">Cyber security aesthetic</div>
                            </div>
                            
                            <div class="theme-option theme-auto">
                                <div class="theme-preview"></div>
                                <div class="theme-name">Auto</div>
                                <div class="theme-desc">Follow system theme</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-text-height"></i>
                            Display Options
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Font Size</div>
                                <div class="setting-desc">Adjust the text size throughout the app</div>
                            </div>
                            <div class="setting-control">
                                <div class="select-wrapper">
                                    <select>
                                        <option>Small</option>
                                        <option selected>Medium</option>
                                        <option>Large</option>
                                        <option>Extra Large</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Animation Effects</div>
                                <div class="setting-desc">Enable smooth transitions and animations</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Reduced Motion</div>
                                <div class="setting-desc">Minimize animations for accessibility</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Security Section -->
                <div class="content-section" id="security">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-lock"></i>
                            PIN & Biometric Lock
                        </h2>
                        <p class="section-desc">
                            Add an extra layer of security to protect your EchoGuard settings
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-mobile-alt"></i>
                            App Protection
                        </h3>
                        
                        <div class="security-options">
                            <div class="security-option">
                                <div class="security-info">
                                    <div class="security-icon">
                                        <i class="fas fa-fingerprint"></i>
                                    </div>
                                    <div class="security-details">
                                        <div class="security-title">Biometric Lock</div>
                                        <div class="security-desc">Use fingerprint or face recognition to unlock EchoGuard</div>
                                    </div>
                                </div>
                                <div class="security-status">Enabled</div>
                                <div class="security-action">
                                    <button class="btn">
                                        <i class="fas fa-cog"></i>
                                        Configure
                                    </button>
                                </div>
                            </div>
                            
                            <div class="security-option">
                                <div class="security-info">
                                    <div class="security-icon">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <div class="security-details">
                                        <div class="security-title">PIN Protection</div>
                                        <div class="security-desc">Set a PIN code to access sensitive settings</div>
                                    </div>
                                </div>
                                <div class="security-status disabled">Disabled</div>
                                <div class="security-action">
                                    <button class="btn">
                                        <i class="fas fa-plus"></i>
                                        Enable
                                    </button>
                                </div>
                            </div>
                            
                            <div class="security-option">
                                <div class="security-info">
                                    <div class="security-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="security-details">
                                        <div class="security-title">Auto Lock</div>
                                        <div class="security-desc">Automatically lock after 5 minutes of inactivity</div>
                                    </div>
                                </div>
                                <div class="security-status">Enabled</div>
                                <div class="security-action">
                                    <button class="btn">
                                        <i class="fas fa-cog"></i>
                                        Configure
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-shield-alt"></i>
                            Emergency Features
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Panic Button</div>
                                <div class="setting-desc">Quickly lock EchoGuard with a triple-tap gesture</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Stealth Mode Trigger</div>
                                <div class="setting-desc">Activate stealth mode when device is locked</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Privacy Sandbox Section -->
                <div class="content-section" id="privacy">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-user-secret"></i>
                            Privacy Sandbox Settings
                        </h2>
                        <p class="section-desc">
                            Advanced privacy controls and automation for maximum protection
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-robot"></i>
                            Automation Rules
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Auto Revoke at 12AM</div>
                                <div class="setting-desc">Automatically revoke all permissions at midnight</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Foreground Location Only</div>
                                <div class="setting-desc">Allow location access only when app is in use</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Mic Whitelist Only</div>
                                <div class="setting-desc">Microphone accessible only to whitelisted apps</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-shield-virus"></i>
                            Protection Modes
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Protection Mode</div>
                                <div class="setting-desc">Choose your preferred security level</div>
                            </div>
                            <div class="setting-control">
                                <div class="radio-group">
                                    <label class="radio-option">
                                        <input type="radio" name="protection-mode" class="radio-input">
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Strict</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="protection-mode" class="radio-input" checked>
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Smart</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="protection-mode" class="radio-input">
                                        <span class="radio-custom"></span>
                                        <span class="radio-label">Balanced</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Auto Block Unknown Transfers</div>
                                <div class="setting-desc">Block data transfers to unknown servers</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="danger-zone">
                        <h3 class="danger-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Danger Zone
                        </h3>
                        <p class="danger-desc">
                            These actions are irreversible. Please proceed with caution.
                        </p>
                        <div class="action-buttons">
                            <button class="btn btn-danger">
                                <i class="fas fa-eraser"></i>
                                Reset All Settings
                            </button>
                            <button class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                Clear All Data
                            </button>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
                
                <!-- Advanced Section -->
                <div class="content-section" id="advanced">
                    <div class="section-header">
                        <h2 class="section-title">
                            <i class="fas fa-cogs"></i>
                            Advanced Settings
                        </h2>
                        <p class="section-desc">
                            Expert-level configurations for power users
                        </p>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-microchip"></i>
                            Performance
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Background Monitoring</div>
                                <div class="setting-desc">Continuous monitoring in background (increases battery usage)</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Deep Scan Intensity</div>
                                <div class="setting-desc">How thoroughly EchoGuard scans for threats</div>
                            </div>
                            <div class="setting-control">
                                <div class="select-wrapper">
                                    <select>
                                        <option>Light</option>
                                        <option selected>Standard</option>
                                        <option>Thorough</option>
                                        <option>Maximum</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-group">
                        <h3 class="group-title">
                            <i class="fas fa-code-branch"></i>
                            Developer Options
                        </h3>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Debug Mode</div>
                                <div class="setting-desc">Enable detailed logging for troubleshooting</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Export Logs</div>
                                <div class="setting-desc">Create a file with all system logs</div>
                            </div>
                            <div class="setting-control">
                                <button class="btn">
                                    <i class="fas fa-download"></i>
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="danger-zone">
                        <h3 class="danger-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Experimental Features
                        </h3>
                        <p class="danger-desc">
                            These features are in development and may be unstable.
                        </p>
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">AI Threat Prediction</div>
                                <div class="setting-desc">Use machine learning to predict emerging threats</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="setting-item">
                            <div class="setting-info">
                                <div class="setting-title">Behavioral Analysis</div>
                                <div class="setting-desc">Monitor app behavior patterns for anomalies</div>
                            </div>
                            <div class="setting-control">
                                <label class="toggle-switch">
                                    <input type="checkbox">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-times"></i>
                            Cancel
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Initialize settings page
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar navigation
            const sidebarItems = document.querySelectorAll('.sidebar-item');
            const contentSections = document.querySelectorAll('.content-section');
            
            sidebarItems.forEach(item => {
                item.addEventListener('click', function() {
                    const targetSection = this.getAttribute('data-section');
                    
                    // Update active states
                    sidebarItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    contentSections.forEach(section => {
                        section.classList.remove('active');
                        if (section.id === targetSection) {
                            section.classList.add('active');
                        }
                    });
                });
            });
            
            // Theme selection
            const themeOptions = document.querySelectorAll('.theme-option');
            themeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    themeOptions.forEach(o => o.classList.remove('active'));
                    this.classList.add('active');
                    
                    // In a real app, we would change the theme here
                    const themeName = this.classList[1].split('-')[1];
                    console.log(`Theme changed to: ${themeName}`);
                });
            });
            
            // Toggle switch functionality
            const toggleSwitches = document.querySelectorAll('.toggle-switch input');
            toggleSwitches.forEach(toggle => {
                toggle.addEventListener('change', function() {
                    const setting = this.closest('.setting-item');
                    const settingTitle = setting.querySelector('.setting-title').textContent;
                    const status = this.checked ? 'enabled' : 'disabled';
                    console.log(`${settingTitle} ${status}`);
                    
                    // Show confirmation for important toggles
                    if (settingTitle.includes('Background Monitoring') && !this.checked) {
                        if (!confirm('Disabling background monitoring may reduce your security. Are you sure?')) {
                            this.checked = true;
                        }
                    }
                });
            });
            
            // Export settings button
            const exportBtn = document.getElementById('exportSettings');
            exportBtn.addEventListener('click', function() {
                // Simulate export process
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-download"></i> Export Settings';
                    this.disabled = false;
                    alert('Settings exported successfully!');
                }, 1500);
            });
            
            // Save buttons
            const saveButtons = document.querySelectorAll('.btn-primary');
            saveButtons.forEach(button => {
                if (button.textContent.includes('Save Changes')) {
                    button.addEventListener('click', function() {
                        const section = this.closest('.content-section');
                        const sectionName = section.querySelector('.section-title').textContent;
                        
                        // Show saving indicator
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                        
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            alert(`${sectionName} saved successfully!`);
                        }, 1000);
                    });
                }
            });
            
            // Danger zone buttons
            const dangerButtons = document.querySelectorAll('.btn-danger');
            dangerButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.textContent.trim();
                    
                    if (confirm(`Are you sure you want to ${action}? This action cannot be undone.`)) {
                        // Simulate action
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                        this.disabled = true;
                        
                        setTimeout(() => {
                            alert(`${action} completed successfully.`);
                            this.innerHTML = action;
                            this.disabled = false;
                        }, 2000);
                    }
                });
            });
            
            // Security option buttons
            const securityButtons = document.querySelectorAll('.security-action .btn');
            securityButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const securityOption = this.closest('.security-option');
                    const optionName = securityOption.querySelector('.security-title').textContent;
                    
                    if (this.textContent.includes('Enable')) {
                        // Simulate enabling security feature
                        securityOption.querySelector('.security-status').textContent = 'Enabled';
                        securityOption.querySelector('.security-status').classList.remove('disabled');
                        this.innerHTML = '<i class="fas fa-cog"></i> Configure';
                        alert(`${optionName} has been enabled.`);
                    } else if (this.textContent.includes('Configure')) {
                        alert(`Opening configuration for ${optionName}...`);
                    }
                });
            });
            
            // Initialize with first section active
            if (sidebarItems.length > 0) {
                sidebarItems[0].click();
            }
        });
    </script>
</body>
</html>