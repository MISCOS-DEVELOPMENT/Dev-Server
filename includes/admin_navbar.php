<?php
$full_name = isset($_SESSION['u_name']) ? $_SESSION['u_name'] : 'Admin User';
$location  = isset($_SESSION['u_dist']) ? $_SESSION['u_dist'] : 'Bhopal';

$name_parts = explode(' ', trim($full_name));
$first_letter = strtoupper(substr($name_parts[0] ?? '', 0, 1));
$last_letter  = strtoupper(substr(end($name_parts) ?? '', 0, 1));
$initials = $first_letter . $last_letter;
?>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center w-100">

      <div class="d-flex align-items-center">
        <button id="sidebarToggle" class="btn me-2">
          <i class="fas fa-bars"></i>
        </button>
        <h4 class="mb-0 d-flex align-items-center">
          <img src="./assets/images/mp_logo.png" alt="MP Logo" style="height:40px; margin-right:10px;">
          Dashboard Overview
        </h4>
      </div>

      <div class="dropdown">
        <div class="d-flex align-items-center dropdown-toggle" id="userDropdown"
             data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">

          <div class="text-end me-2">
            <strong><?= htmlspecialchars($full_name) ?></strong><br>
            <small class="text-muted"><?= htmlspecialchars($location) ?></small>
          </div>

          <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center"
               style="width:40px; height:40px;">
            <?= htmlspecialchars($initials) ?>
          </div>
        </div>

        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
          <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="admin_logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>
