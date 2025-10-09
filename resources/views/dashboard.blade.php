<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Posyandu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #3498db;
            --secondary: #7bcaf8;
            --accent: #5dade2;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --sidebar-width: 280px;
            --sidebar-collapsed: 80px;
            --header-height: 75px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #333;
            overflow-x: hidden;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: fixed;
            height: 100vh;
            overflow: hidden;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        .sidebar.collapsed .sidebar-header span,
        .sidebar.collapsed .sidebar-menu a span,
        .sidebar.collapsed .user-info {
            opacity: 0;
            visibility: hidden;
        }

        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header i {
            font-size: 2rem;
            color: var(--primary);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .sidebar-header span {
            font-size: 1.3rem;
            font-weight: bold;
            transition: all 0.3s;
        }

        .toggle-btn {
            position: absolute;
            right: -15px;
            top: 30px;
            background: var(--primary);
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
            transition: all 0.3s;
            z-index: 1001;
        }

        .toggle-btn:hover {
            transform: scale(1.1);
            background: var(--accent);
        }
        
        .sidebar-menu {
            padding: 20px 0;
            overflow-y: auto;
            height: calc(100vh - 200px);
        }

        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        .sidebar-menu ul {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin: 5px 15px;
            border-radius: 12px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s;
        }

        .sidebar-menu li:hover::before,
        .sidebar-menu li.active::before {
            transform: scaleY(1);
        }
        
        .sidebar-menu li:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        .sidebar-menu li.active {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }
        
        .sidebar-menu a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 18px;
            transition: all 0.3s;
        }

        .sidebar-menu a i {
            font-size: 1.2rem;
            min-width: 24px;
            transition: all 0.3s;
        }

        .sidebar-menu li:hover a i {
            transform: scale(1.2) rotate(5deg);
        }

        .sidebar-menu a span {
            font-size: 0.95rem;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .user-section {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s;
        }

        .user-info img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .user-details {
            flex: 1;
        }

        .user-details .name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-details .role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed);
        }
        
        /* Header Styles */
        .header {
            height: var(--header-height);
            background: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }
        
        .header-left h1 {
            font-size: 1.6rem;
            color: var(--dark);
            font-weight: 700;
        }

        .breadcrumb {
            font-size: 0.85rem;
            color: #777;
            margin-top: 5px;
        }

        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            width: 250px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            width: 300px;
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
            font-size: 1.3rem;
            color: #555;
            transition: all 0.3s;
        }

        .notification-icon:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .user-profile:hover {
            background: #f8f9fa;
        }
        
        .user-profile img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 2px solid var(--primary);
        }

        .user-profile .info {
            display: flex;
            flex-direction: column;
        }

        .user-profile .name {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-profile .role {
            font-size: 0.75rem;
            color: #777;
        }
        
        /* Content Styles */
        .content {
            padding: 35px;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .page-title {
            margin-bottom: 30px;
            color: var(--dark);
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        /* Cards Styles */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }
        
        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .card:hover::before {
            transform: scaleX(1);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }
        
        .card-title {
            font-size: 0.95rem;
            color: #777;
            font-weight: 500;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .card:hover .card-icon {
            transform: rotate(360deg) scale(1.1);
        }
        
        .card-icon.primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
        }
        
        .card-icon.secondary {
            background: linear-gradient(135deg, var(--success), #27ae60);
        }
        
        .card-icon.danger {
            background: linear-gradient(135deg, var(--danger), #c0392b);
        }
        
        .card-icon.warning {
            background: linear-gradient(135deg, var(--warning), #e67e22);
        }
        
        .card-value {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 8px;
            color: var(--dark);
        }
        
        .card-footer {
            font-size: 0.85rem;
            color: #777;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .card-footer i {
            color: var(--success);
        }
        
        /* Charts Styles */
        .charts {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 35px;
        }
        
        .chart-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .chart-container:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .chart-title {
            margin-bottom: 20px;
            color: var(--dark);
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        
        th {
            background: #f8f9fa;
            color: var(--dark);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        tr {
            transition: all 0.3s;
        }

        tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        
        .status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status.active {
            background: #e8f5e9;
            color: var(--success);
        }
        
        .status.inactive {
            background: #ffebee;
            color: var(--danger);
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 0.85rem;
        }

        .action-btn.edit {
            background: #e3f2fd;
            color: var(--info);
        }

        .action-btn.delete {
            background: #ffebee;
            color: var(--danger);
        }

        .action-btn:hover {
            transform: scale(1.1);
        }
        
        /* Footer Styles */
        .footer {
            text-align: center;
            padding: 25px;
            color: #777;
            border-top: 1px solid #eee;
            margin-top: 35px;
            background: white;
            border-radius: 16px;
        }

        /* Page Transition */
        .page-content {
            display: none;
            animation: fadeIn 0.5s;
        }

        .page-content.active {
            display: block;
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .charts {
                grid-template-columns: 1fr;
            }

            .search-box input {
                width: 180px;
            }

            .search-box input:focus {
                width: 200px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: var(--primary);
                color: white;
                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: none;
                font-size: 1.5rem;
                box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
                z-index: 999;
                cursor: pointer;
                transition: all 0.3s;
            }

            .mobile-toggle:hover {
                transform: scale(1.1);
            }
            
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .header {
                padding: 0 20px;
            }

            .user-profile .info {
                display: none;
            }

            .search-box {
                display: none;
            }
        }
        
        @media (max-width: 576px) {
            .cards {
                grid-template-columns: 1fr;
            }
            
            .content {
                padding: 20px;
            }

            .header-left h1 {
                font-size: 1.3rem;
            }

            .card-value {
                font-size: 1.8rem;
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Additional Modern Touches */
        .card-graph {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 60px;
            opacity: 0.1;
            pointer-events: none;
        }
        
        .progress-ring {
            position: relative;
            width: 80px;
            height: 80px;
        }
        
        .progress-ring-circle {
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
        
        .progress-ring-bg {
            fill: none;
            stroke: #f0f0f0;
            stroke-width: 6;
        }
        
        .progress-ring-fill {
            fill: none;
            stroke: var(--primary);
            stroke-width: 6;
            stroke-linecap: round;
            transition: stroke-dashoffset 0.5s ease;
        }
        
        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.9rem;
            font-weight: bold;
            color: var(--dark);
        }
        
        .mini-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .mini-stat {
            text-align: center;
            flex: 1;
        }
        
        .mini-stat-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--primary);
        }
        
        .mini-stat-label {
            font-size: 0.75rem;
            color: #777;
        }
        
        .featured-card {
            grid-column: span 2;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
        }
        
        .featured-card .card-title,
        .featured-card .card-value,
        .featured-card .card-footer {
            color: white;
        }
        
        .featured-card .card-icon {
            background: rgba(255, 255, 255, 0.2);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .stat-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }
        
        .stat-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            background: rgba(52, 152, 219, 0.1);
            color: var(--primary);
            font-size: 1.3rem;
        }
        
        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="sidebar-header">
                <i class="fas fa-baby"></i>
                <span>Posyandu Sehat</span>
            </div>

            <div class="sidebar-menu">
                <ul>
                    <li class="active" data-page="dashboard">
                        <a href="#dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li data-page="balita">
                        <a href="#balita">
                            <i class="fas fa-baby"></i>
                            <span>Data Balita</span>
                        </a>
                    </li>
                    <li data-page="ibu-hamil">
                        <a href="#ibu-hamil">
                            <i class="fas fa-female"></i>
                            <span>Data Ibu Hamil</span>
                        </a>
                    </li>
                    <li data-page="penimbangan">
                        <a href="#penimbangan">
                            <i class="fas fa-weight"></i>
                            <span>Penimbangan</span>
                        </a>
                    </li>
                    <li data-page="imunisasi">
                        <a href="#imunisasi">
                            <i class="fas fa-syringe"></i>
                            <span>Imunisasi</span>
                        </a>
                    </li>
                    <li data-page="laporan">
                        <a href="#laporan">
                            <i class="fas fa-chart-bar"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li data-page="pengaturan">
                        <a href="#pengaturan">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="user-section">
                <div class="user-info">
                    <img src="https://ui-avatars.com/api/?name=Admin+Posyandu&background=3498db&color=fff" alt="Admin">
                    <div class="user-details">
                        <div class="name">Admin Posyandu</div>
                        <div class="role">Administrator</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header -->
            <div class="header">
                <div class="header-left">
                    <h1 id="pageTitle">Dashboard Posyandu</h1>
                    <div class="breadcrumb">
                        <a href="#dashboard">Home</a> / <span id="breadcrumbCurrent">Dashboard</span>
                    </div>
                </div>
                <div class="header-right">
                    <div class="search-box">
                        <input type="text" placeholder="Cari data...">
                        <i class="fas fa-search"></i>
                    </div>

                    <div class="notification-icon">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </div>

                    <div class="user-profile">
                        <img src="https://ui-avatars.com/api/?name=Admin+Posyandu&background=3498db&color=fff" alt="Admin">
                        <div class="info">
                            <div class="name">Admin Posyandu</div>
                            <div class="role">Administrator</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="content" id="contentArea">
                <!-- Dashboard Page -->
                <div class="page-content active" id="dashboard-page">
                    <h2 class="page-title">Selamat Datang di Dashboard Posyandu</h2>
                    
                    <!-- Stats Grid -->
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-baby"></i>
                            </div>
                            <div class="stat-value">245</div>
                            <div class="stat-label">Total Balita</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-female"></i>
                            </div>
                            <div class="stat-value">42</div>
                            <div class="stat-label">Ibu Hamil</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-value">187</div>
                            <div class="stat-label">Kunjungan</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon">
                                <i class="fas fa-syringe"></i>
                            </div>
                            <div class="stat-value">15</div>
                            <div class="stat-label">Imunisasi Tertunda</div>
                        </div>
                    </div>
                    
                    <!-- Cards -->
                    <div class="cards">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Total Balita</div>
                                <div class="card-icon primary">
                                    <i class="fas fa-baby"></i>
                                </div>
                            </div>
                            <div class="card-value">245</div>
                            <div class="card-footer">
                                <i class="fas fa-arrow-up"></i> +12 dari bulan lalu
                            </div>
                            <svg class="card-graph" viewBox="0 0 100 40" preserveAspectRatio="none">
                                <path d="M0,40 L20,25 L40,30 L60,15 L80,20 L100,10 L100,40 Z" fill="url(#gradient)"></path>
                                <defs>
                                    <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" stop-color="var(--primary)" stop-opacity="0.3" />
                                        <stop offset="100%" stop-color="var(--primary)" stop-opacity="0" />
                                    </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Ibu Hamil</div>
                                <div class="card-icon secondary">
                                    <i class="fas fa-female"></i>
                                </div>
                            </div>
                            <div class="card-value">42</div>
                            <div class="card-footer">
                                <i class="fas fa-arrow-up"></i> +3 dari bulan lalu
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Kunjungan Bulan Ini</div>
                                <div class="card-icon danger">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="card-value">187</div>
                            <div class="card-footer">
                                <i class="fas fa-arrow-up"></i> +24 dari bulan lalu
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Imunisasi Tertunda</div>
                                <div class="card-icon warning">
                                    <i class="fas fa-syringe"></i>
                                </div>
                            </div>
                            <div class="card-value">15</div>
                            <div class="card-footer">
                                Perlu tindak lanjut
                            </div>
                        </div>
                    </div>
                    
                    <!-- Charts -->
                    <div class="charts">
                        <div class="chart-container">
                            <h3 class="chart-title">Perkembangan Berat Badan Balita</h3>
                            <canvas id="weightChart"></canvas>
                        </div>
                        
                        <div class="chart-container">
                            <h3 class="chart-title">Distribusi Status Gizi</h3>
                            <canvas id="nutritionChart"></canvas>
                        </div>
                    </div>
                    
                    <!-- Table -->
                    <div class="table-container">
                        <div class="table-header">
                            <h3 class="chart-title">Data Balita Terbaru</h3>
                            <div class="table-actions">
                                <button class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data
                                </button>
                                <button class="btn" style="background: #f8f9fa; color: #555;">
                                    <i class="fas fa-download"></i> Export
                                </button>
                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Balita</th>
                                    <th>Usia</th>
                                    <th>Berat Badan</th>
                                    <th>Tinggi Badan</th>
                                    <th>Status Gizi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ahmad Fauzi</td>
                                    <td>2 Tahun</td>
                                    <td>12.5 kg</td>
                                    <td>88 cm</td>
                                    <td>Normal</td>
                                    <td><span class="status active">Aktif</span></td>
                                    <td class="action-btns">
                                        <button class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Siti Rahma</td>
                                    <td>18 Bulan</td>
                                    <td>10.2 kg</td>
                                    <td>78 cm</td>
                                    <td>Normal</td>
                                    <td><span class="status active">Aktif</span></td>
                                    <td class="action-btns">
                                        <button class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Budi Santoso</td>
                                    <td>3 Tahun</td>
                                    <td>14.1 kg</td>
                                    <td>95 cm</td>
                                    <td>Gizi Lebih</td>
                                    <td><span class="status active">Aktif</span></td>
                                    <td class="action-btns">
                                        <button class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rina Wati</td>
                                    <td>2.5 Tahun</td>
                                    <td>11.8 kg</td>
                                    <td>85 cm</td>
                                    <td>Normal</td>
                                    <td><span class="status inactive">Tidak Aktif</span></td>
                                    <td class="action-btns">
                                        <button class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dewi Anggraini</td>
                                    <td>4 Tahun</td>
                                    <td>16.3 kg</td>
                                    <td>102 cm</td>
                                    <td>Normal</td>
                                    <td><span class="status active">Aktif</span></td>
                                    <td class="action-btns">
                                        <button class="action-btn edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="footer">
                    <p>&copy; 2023 Posyandu Sehat. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle Sidebar
        document.getElementById('toggleBtn').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleIcon = this.querySelector('i');
            
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            
            if (sidebar.classList.contains('collapsed')) {
                toggleIcon.className = 'fas fa-chevron-right';
            } else {
                toggleIcon.className = 'fas fa-chevron-left';
            }
        });

        // Initialize Charts
        window.onload = function() {
            // Weight Chart
            const weightCtx = document.getElementById('weightChart').getContext('2d');
            const weightChart = new Chart(weightCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Berat Badan (kg)',
                        data: [10.2, 10.5, 11.0, 11.3, 11.8, 12.1, 12.5, 12.8, 13.2, 13.5, 13.9, 14.2],
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52, 152, 219, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            min: 9
                        }
                    }
                }
            });

            // Nutrition Chart
            const nutritionCtx = document.getElementById('nutritionChart').getContext('2d');
            const nutritionChart = new Chart(nutritionCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Gizi Baik', 'Gizi Kurang', 'Gizi Lebih', 'Gizi Buruk'],
                    datasets: [{
                        data: [65, 15, 12, 8],
                        backgroundColor: [
                            '#2ecc71',
                            '#f39c12',
                            '#3498db',
                            '#e74c3c'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });
        };

        // Page Navigation
        document.querySelectorAll('.sidebar-menu li').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                document.querySelectorAll('.sidebar-menu li').forEach(li => {
                    li.classList.remove('active');
                });
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Update page title and breadcrumb
                const pageName = this.getAttribute('data-page');
                const pageTitle = document.getElementById('pageTitle');
                const breadcrumbCurrent = document.getElementById('breadcrumbCurrent');
                
                if (pageName === 'dashboard') {
                    pageTitle.textContent = 'Dashboard Posyandu';
                    breadcrumbCurrent.textContent = 'Dashboard';
                } else if (pageName === 'balita') {
                    pageTitle.textContent = 'Data Balita';
                    breadcrumbCurrent.textContent = 'Data Balita';
                } else if (pageName === 'ibu-hamil') {
                    pageTitle.textContent = 'Data Ibu Hamil';
                    breadcrumbCurrent.textContent = 'Data Ibu Hamil';
                } else if (pageName === 'penimbangan') {
                    pageTitle.textContent = 'Penimbangan';
                    breadcrumbCurrent.textContent = 'Penimbangan';
                } else if (pageName === 'imunisasi') {
                    pageTitle.textContent = 'Imunisasi';
                    breadcrumbCurrent.textContent = 'Imunisasi';
                } else if (pageName === 'laporan') {
                    pageTitle.textContent = 'Laporan';
                    breadcrumbCurrent.textContent = 'Laporan';
                } else if (pageName === 'pengaturan') {
                    pageTitle.textContent = 'Pengaturan';
                    breadcrumbCurrent.textContent = 'Pengaturan';
                }
            });
        });
    </script>
</body>
</html>