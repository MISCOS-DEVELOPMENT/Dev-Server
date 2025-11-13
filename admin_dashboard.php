<?php
session_start();
$u_name   = $_SESSION['u_name'] ?? 'Admin User';
$stats = [
    ["label" => "Total Registrations", "value" => "10,23,456", "icon" => "fa-user-plus", "bg" => "linear-gradient(135deg,#6a11cb,#2575fc)"],
    ["label" => "Pending Registration", "value" => "10,23,456", "icon" => "fa-hourglass-half", "bg" => "linear-gradient(135deg,#f7971e,#ffd200)"],
    ["label" => "Live Events", "value" => "10,23,456", "icon" => "fa-broadcast-tower", "bg" => "linear-gradient(135deg,#00b09b,#96c93d)"],
    ["label" => "Total Events", "value" => "10,23,456", "icon" => "fa-calendar-check", "bg" => "linear-gradient(135deg,#8e2de2,#4a00e0)"],
    ["label" => "Today's Registrations", "value" => "10,23,456", "icon" => "fa-user-clock", "bg" => "linear-gradient(135deg,#ff8008,#ffc837)"],
    ["label" => "Active Users", "value" => "10,23,456", "icon" => "fa-fire", "bg" => "linear-gradient(135deg,#ff416c,#ff4b2b)"],
];

$activities = [
    [
        "title" => "Sanskaar प्रश्नोत्तरी (Quiz)", 
        "status" => "Live", 
        "participants" => "10,234", 
        "total" => "12,349",
        "description" => "20 MCQs, 30 minutes, single attempt. Auto-graded.",
        "type" => "District Level"
    ],
    [
        "title" => "Sanskaar Essay Competition", 
        "status" => "Upcoming", 
        "participants" => "Waiting", 
        "total" => "8,500",
        "description" => "Essay writing competition on moral values. 500-800 words.",
        "type" => "State Level"
    ],
    [
        "title" => "Sanskaar Debate Championship", 
        "status" => "Completed", 
        "participants" => "7,890", 
        "total" => "9,200",
        "description" => "Online debate competition with preliminary and final rounds.",
        "type" => "District Level"
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>गीता महोत्सव - Admin Panel</title>
    <link rel="icon" type="image/png" href="./assets/images/mp_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style_for_admin_dashboard.css">
</head>
<body>
    <?php include './includes/admin_sidebar.php'; ?>
    <div class="main-content" id="mainContent">
        <?php include './includes/admin_navbar.php'; ?>

        <div class="welcome-card mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h6>Welcome back, <?php echo htmlspecialchars($u_name); ?>! 👋</h6>
                <p class="mb-0">Here's what's happening with Geeta Mahotsav today</p>
            </div>
            <div class="text-end">
                <small>Last login</small><br>
                <strong>Today, 09:42 AM</strong>
            </div>
        </div>

        <div class="row">
            <?php foreach ($stats as $stat): ?>
                <div class="col-xl-4 col-md-6 mb-3">
                    <div class="stats-card d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stats-label"><?= $stat['label'] ?></div>
                            <div class="stats-number"><?= $stat['value'] ?></div>
                            <div class="stats-change"><i class="fas fa-arrow-up me-1"></i> +12% from last week</div>
                        </div>
                        <div class="stats-icon" style="background: <?= $stat['bg'] ?>;">
                            <i class="fas <?= $stat['icon'] ?>"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3">
                <h5 class="section-title">Recent Activities</h5>
                
                <?php foreach ($activities as $activity): ?>
                    <?php 
                    $badgeClass = "";
                    $statusClass = "";
                    if ($activity['status'] == 'Live') {
                        $badgeClass = "bg-success";
                        $statusClass = "status-live";
                    } elseif ($activity['status'] == 'Upcoming') {
                        $badgeClass = "bg-warning";
                        $statusClass = "status-upcoming";
                    } else {
                        $badgeClass = "bg-secondary";
                        $statusClass = "status-completed";
                    }
                    ?>
                    
                    <div class="quiz-card <?php echo $statusClass; ?>">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="fw-bold"><?= $activity['type'] ?></span>
                                <p class="quiz-details mb-0 mt-1">
                                    <strong><?= $activity['title'] ?></strong><br>
                                    <?= $activity['description'] ?>
                                </p>
                            </div>
                            <div class="text-end">
                                <span class="badge <?= $badgeClass ?> ms-2"><?= $activity['status'] ?></span>
                                <p class="quiz-details mb-0 mt-1">
                                    <?php if ($activity['status'] == 'Live'): ?>
                                        <span class="badge bg-light text-dark border">Live Users: <?= $activity['participants'] ?></span>
                                    <?php elseif ($activity['status'] == 'Upcoming'): ?>
                                        <span class="badge bg-light text-dark border">Waiting</span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-dark border">Attended: <?= $activity['participants'] ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div>
                                <button class="btn btn-admin-outline btn-sm me-2">
                                    <i class="fas fa-clock me-1"></i> Schedule Time
                                </button>
                                <button class="btn btn-admin-outline btn-sm">
                                    <i class="fas fa-plus me-1"></i> Add Questions
                                </button>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-primary">Total Participants: <?= $activity['total'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="col-lg-6 mb-3">
                <h5 class="section-title">Quick Actions</h5>
                
                <div class="quick-actions-card">
    <div class="row g-2">
        <div class="col-6">
            <a href="event_management.php?action=create_category" class="action-card action-card-link text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-text">
                    <h6>Create Category</h6>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a href="event_management.php?action=upload_questions" class="action-card action-card-link text-decoration-none">
                <div class="action-icon">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="action-text">
                    <h6>Upload Questions</h6>
                </div>
            </a>
        </div>
        <div class="col-6">
            <div class="action-card action-card-static">
                <div class="action-icon">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <div class="action-text">
                    <h6>Generate Report</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="action-card action-card-static">
                <div class="action-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="action-text">
                    <h6>Batch Certificates</h6>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (window.innerWidth > 992) {
                if (sidebar.style.width === '70px') {
                    sidebar.style.width = '240px';
                    mainContent.style.marginLeft = '240px';
                    document.querySelectorAll('.menu-text').forEach(el => el.style.display = 'inline');
                } else {
                    sidebar.style.width = '70px';
                    mainContent.style.marginLeft = '70px';
                    document.querySelectorAll('.menu-text').forEach(el => el.style.display = 'none');
                }
            }
        });
        
        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('active');
        });
        
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
        
        document.querySelectorAll('.sidebar-menu a').forEach(item => {
            item.addEventListener('click', function(e) {
                // Only prevent default for links that don't have actual href destinations
                if (this.getAttribute('href') === '#' || !this.getAttribute('href').includes('.php')) {
                    e.preventDefault();
                }
                
                document.querySelectorAll('.sidebar-menu a').forEach(link => {
                    link.classList.remove('active');
                });
                this.classList.add('active');
                
                if (window.innerWidth <= 992) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebarOverlay');
                    
                    sidebar.classList.remove('mobile-open');
                    overlay.classList.remove('active');
                }
            });
        });
        
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth > 992) {
                sidebar.style.transform = 'translateX(0)';
                sidebar.style.width = '240px';
                mainContent.style.marginLeft = '240px';
                overlay.classList.remove('active');
                document.querySelectorAll('.menu-text').forEach(el => el.style.display = 'inline');
            } else {
                sidebar.style.transform = 'translateX(-100%)';
                sidebar.style.width = '240px';
                mainContent.style.marginLeft = '0';
                sidebar.classList.remove('mobile-open');
                document.querySelectorAll('.menu-text').forEach(el => el.style.display = 'inline');
            }
        });
        
        window.dispatchEvent(new Event('resize'));
    </script>
</body>
</html>