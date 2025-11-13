<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<button id="mobileMenuToggle">
    <i class="fas fa-bars"></i>
</button>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>YUVA Sanskaar</h3>
        <p>Admin Panel</p>
    </div>

    <div class="sidebar-menu" style="border-top: 1px solid #fff;">
        <ul>
            <li>
                <a href="admin_dashboard.php" class="<?php echo $current_page == 'admin_dashboard.php' ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i> 
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="event_management.php" class="<?php echo $current_page == 'event_management.php' ? 'active' : ''; ?>">
                    <i class="fas fa-calendar-alt"></i> 
                    <span class="menu-text">Event Management</span>
                </a>
            </li>

            <li>
                <a href="#" class="<?php echo $current_page == 'quiz_assessment.php' ? 'active' : ''; ?>">
                    <i class="fas fa-question-circle"></i> 
                    <span class="menu-text">Quiz & Assessment</span>
                </a>
            </li>

            <li>
                <a href="#" class="<?php echo $current_page == 'certificates.php' ? 'active' : ''; ?>">
                    <i class="fas fa-certificate"></i> 
                    <span class="menu-text">Certificates</span>
                </a>
            </li>

            <li>
                <a href="result_generation.php" class="<?php echo $current_page == 'result_generation.php' ? 'active' : ''; ?>">
                    <i class="fas fa-poll"></i>
                    <span class="menu-text">Result Generation</span>
                </a>
            </li>

            <li>
                <a href="generate_report.php" class="<?php echo $current_page == 'generate_report.php' ? 'active' : ''; ?>">
                    <i class="fas fa-chart-bar"></i> 
                    <span class="menu-text">Report & Analytics</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-menu">
        <div style="padding: 0 20px 10px; color: #a0aec0; font-size: 13px; font-weight: 600;">Quick Actions</div>
        <ul>
            <li>
                <a href="#">
                    <i class="fas fa-chart-pie"></i> 
                    <span class="menu-text">Generate Report</span>
                </a>
            </li>
        </ul>
    </div>
</div>
