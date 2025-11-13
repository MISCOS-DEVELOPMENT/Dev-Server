<?php
session_start();
if (!isset($_SESSION['u_id']) || !isset($_SESSION['u_name']) || !isset($_SESSION['u_dist'])) {
    header("Location: admin_login.php");
    exit();
}

$base_url = "https://geetamahotsav.com";

$u_name   = $_SESSION['u_name'] ?? 'Admin User';
$u_mobile = $_SESSION['u_mobile'] ?? '';
$u_email  = $_SESSION['u_email'] ?? '';
$u_dist   = $_SESSION['u_dist'] ?? '';
$u_id   = $_SESSION['u_id'] ?? '';

$categories = [];
$api_url = $base_url . "/api/v1/organiser/fetch_all_category.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $data = json_decode($response, true);
    if (isset($data['error_code']) && $data['error_code'] == 200 && isset($data['data'])) {
        $categories = $data['data'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>गीता महोत्सव - Event Management</title>
    <link rel="icon" type="image/png" href="./assets/images/mp_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style_for_admin_dashboard.css">
    <style>
      /* Custom styles for the card layout */
        .card-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .competition-card {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e9ecef;
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
            border-left: 4px solid #B8850B;
        }

        .competition-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .card-header-section {
            padding: 16px 20px 12px;
            border-bottom: 1px solid #f1f3f4;
            position: relative;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .card-subtitle {
            font-size: 13px;
            color: #5f6368;
            margin-bottom: 8px;
        }

        .card-description {
            font-size: 14px;
            color: #5f6368;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .card-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .winners-count {
            font-size: 14px;
            font-weight: 600;
            color: #6c757d;
        }

        .slots-count {
            font-size: 14px;
            font-weight: 500;
            color: #0d6efd;
            cursor: pointer;
        }

        .add-slots-btn {
            background-color: #B8850B;
            border: none;
            color: #212529;
            font-size: 13px;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .add-slots-btn:hover {
            background-color: #e0a800;
        }

        .progress-section {
            margin-bottom: 12px;
        }

        .progress-label {
            font-size: 13px;
            color: #5f6368;
            margin-bottom: 6px;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
        }

        .progress-bar {
            border-radius: 4px;
        }

        .enrollment-count {
            font-size: 13px;
            color: #5f6368;
            text-align: center;
        }

        .card-actions {
            position: absolute;
            top: 16px;
            right: 16px;
            display: flex;
            gap: 0;
        }

        .action-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            background-color: #f8f9fa;
            transition: background-color 0.2s;
            margin-right: 0;
        }

        .action-icon:last-child {
            margin-right = 0;
        }

        .action-icon:hover {
            background-color: #e9ecef;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-left: 8px;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-judgement {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-inactive {
            background-color: #f3f4f6;
            color: #6b7280;
        }

        /* Modal form styles */
        .dynamic-form-section {
            display: none;
        }

        .dynamic-form-section.active {
            display: block;
        }

        .form-section {
            border-bottom: 1px solid #e9ecef;
        }

        .form-section-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
            font-size: 16px;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            color: #495057;
        }

        .required-field::after {
            content: " *";
            color: red;
        }

        /* Additional styling for the instructions section */
        .instructions-container {
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 15px;
            background-color: #f8f9fa;
        }

        .instructions-column {
            padding: 10px;
        }

        .instructions-column label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        /* Rubric Criteria Styles */
        .rubric-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .rubric-header {
            margin-bottom: 20px;
        }

        .rubric-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            text-align: center;
        }

        .rubric-subtitle-container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }

        .rubric-left,
        .rubric-right {
            flex: 1;
            font-size: 14px;
            color: #6c757d;
            line-height: 1.4;
        }

        .rubric-left {
            text-align: left;
        }

        .rubric-right {
            text-align: right;
        }

        .criteria-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            align-items: flex-end;
        }

        .criteria-input {
            flex: 1;
        }

        .weight-input {
            width: 120px;
        }

        /* Time Slot Modal Styles */
        .time-slot-modal .modal-header {
            border-bottom: none;
            padding-bottom: 0;
        }

        .time-slot-modal .modal-body {
            padding-top: 0;
        }

        .slot-image-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .slot-image-container img {
            max-width: 40px;
            height: auto;
            margin-top: 10px;
        }

        .slot-modal-title {
            text-align: center;
            font-weight: 500;
            margin-bottom: 25px;
            color: #1a1a1a;
        }

        .time-inputs-row {
            display: flex;
            gap: 15px;
        }

        .time-input-group {
            flex: 1;
        }

        .create-slot-btn {
            background-color: #B8850B;
            border: none;
            color: #212529;
            font-weight: 500;
            padding: 5px 5px;
            border-radius: 6px;
            transition: background-color 0.2s;
            width: 35%;
        }

        .create-slot-btn:hover {
            background-color: #e0a800;
        }

        .create-slot-btn:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }

        /* Slot Information Modal Styles */
        .slot-info-modal .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 15px 20px;
        }

        .slot-info-modal .modal-body {
            padding: 10px;
        }

        .category-name-header {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .overview-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .overview-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: #495057;
            font-size: 16px;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .overview-item {
            text-align: center;
            padding: 10px;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .overview-label {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .overview-value {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .slot-date-section {
            margin-bottom: 20px;
        }

        .slot-date-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }

        .slot-date-title {
            font-size: 16px;
            font-weight: 600;
            color: #495057;
        }

        .slot-add-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .slot-add-btn:hover {
            background-color: #f8f9fa;
        }

        .slot-add-btn img {
            width: 16px;
            height: 16px;
        }

        .no-slots-message {
            text-align: center;
            padding: 30px;
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            border-radius: 8px;
        }

       /* Slot Cards Layout Styles */
        .slot-cards-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 12px;
        }

        .slot-card {
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 12px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .slot-card:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        }

        .slot-content {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .slot-labels-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr; 
            gap: 8px;
            font-size: 10px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            padding-bottom: 4px;
            border-bottom: 1px solid #f1f3f4;
        }

        .slot-details-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 0.5fr;
            gap: 8px;
            align-items: center;
            font-size: 12px;
        }

        .slot-time {
            font-weight: 600;
            color: #495057;
            font-size: 11px;
        }

        .slot-capacity {
            color: #6c757d;
            font-weight: 500;
            font-size: 11px;
        }

        .slot-enrolled {
            color: #0d6efd;
            font-weight: 500;
            font-size: 11px;
        }

        .slot-progress-container {
            display: flex;
            align-items: center;
            gap: 5px;
            justify-content: flex-end;
        }

        .slot-progress {
            height: 4px;
            flex: 1;
            border-radius: 2px;
            background-color: #e9ecef;
            overflow: hidden;
            min-width: 40px;
        }

        .slot-progress-bar {
            height: 100%;
            border-radius: 2px;
            background-color: #0d6efd;
        }

        .slot-progress-percentage {
            display: none;
        }

        /* Date Section Styling */
        .slot-date-section {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .slot-date-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .slot-date-header {
            display: flex;
            justify-content: center; 
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f3f4;
            position: relative;
        }

        .slot-date-title {
            font-size: 14px;
            font-weight: 600;
            color: #495057;
            text-align: center;
        }

        .slot-add-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background-color 0.2s;
            position: absolute;
            right: 0;
        }

        .slot-add-btn:hover {
            background-color: #f8f9fa;
        }

        .slot-add-btn img {
            width: 14px;
            height: 14px;
        }

        .no-slots-message {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            border-radius: 6px;
            font-size: 14px;
        }

        /* MCQ Upload Modal Styles */
        .mcq-header-section .search-box input {
            width: 200px;
            padding-right: 30px;
        }

        .question-item {
            background-color: #f8f9fa;
        }

        .option-label {
            font-weight: 600;
            color: #495057;
        }

        .upload-area {
            border-style: dashed !important;
            border-color: #6c757d !important;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .upload-area:hover {
            background-color: #f8f9fa;
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .question-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .question-item:hover {
            background-color: #e9ecef;
        }

        .option-label {
            font-weight: 600;
            color: #495057;
            min-width: 20px;
            display: inline-block;
        }

        .delete-question {
            border: none;
            background: transparent;
            color: #dc3545;
            font-size: 14px;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s;
        }

        .delete-question:hover {
            background-color: #dc3545;
            color: white;
        }

        .correct-answer {
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
            margin-top: 8px;
        }

        .question-text-hindi {
            font-family: 'Arial', 'Noto Sans Devanagari', sans-serif;
            font-size: 14px;
            line-height: 1.4;
        }

        .hindi-section {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 12px;
            margin-top: 10px;
        }

        .options-container .option-item {
            padding: 4px 8px;
            border-radius: 4px;
            background-color: white;
            margin-bottom: 4px;
        }
        .option-content .english-option {
            font-weight: 500;
            margin-bottom: 2px;
        }

        .option-content .hindi-option {
            font-family: 'Arial', 'Noto Sans Devanagari', sans-serif;
            line-height: 1.3;
        }

        .option-item {
            min-height: 60px;
            display: flex;
            align-items: flex-start;
        }

        .option-item .fw-bold {
            min-width: 20px;
            margin-right: 5px;
        }

        .option-content {
            flex: 1;
        }

        .question-item {
            transition: opacity 0.3s ease;
        }

        .delete-question:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* Auto-calculation fields styling */
        .auto-calculated {
            background-color: #f8f9fa !important;
        }
        
        .calculation-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php include './includes/admin_sidebar.php'; ?>
    <div class="main-content" id="mainContent">
        <?php include './includes/admin_navbar.php'; ?>

        <div class="welcome-card mb-3 p-3 rounded shadow-sm" 
            style="background: linear-gradient(90deg, #B8850B, #A03F05, #8B0100); color: white; display:flex; justify-content:space-between; align-items:center;">
            
            <div>
                <h6 class="mb-1"><strong><?php echo htmlspecialchars($u_name); ?></strong></h6>
                <p class="mb-0" style="font-size:14px;">
                <?php if($u_mobile) echo htmlspecialchars($u_mobile) . ' - '; ?>
                <?php if($u_email) echo htmlspecialchars($u_email) . ' - '; ?>
                <strong><?php echo htmlspecialchars($u_dist); ?></strong>
                </p>
            </div>
            <div>
                <button class="btn btn-light btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category</button>
            </div>
        </div>

        <div class="card-layout" id="categoriesContainer">
            <?php if (empty($categories)): ?>
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        No categories found. Please add a category to get started.
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($categories as $categoryData): 
                    $category = $categoryData['category'];
                    $slots = $categoryData['slots'];
                    $slot_count = $categoryData['slot_count'];
                    
                    $total_capacity = 0;
                    $total_enrolled = 0;
                    
                    foreach ($slots as $slot) {
                        $total_capacity += intval($slot['slot_permited_participents']);
                        $total_enrolled += intval($slot['slot_booked_particepents'] ?? 0);
                    }
                    
                    $cat_type = $category['cat_type'];
                    $cat_status = $category['cat_status'];
                    
                    $type_text = '';
                    $status_text = '';
                    $status_class = '';
                    
                    switch($cat_type) {
                        case '1':
                            $type_text = 'MCQ';
                            break;
                        case '2':
                            $type_text = 'Essay';
                            break;
                        case '3':
                            $type_text = 'Debate';
                            break;
                        default:
                            $type_text = 'Unknown';
                    }
                    
                    switch($cat_status) {
                        case '0':
                            $status_text = 'Active';
                            $status_class = 'status-active';
                            break;
                        case '1':
                            $status_text = 'Inactive';
                            $status_class = 'status-inactive';
                            break;
                        default:
                            $status_text = 'Unknown';
                            $status_class = 'status-inactive';
                    }
                    
                    $rubric_criteria = [];
                    for ($i = 1; $i <= 6; $i++) {
                        if (!empty($category["cat_qubs_$i"])) {
                            $rubric_criteria[] = $category["cat_qubs_$i"];
                        }
                    }
                    
                    $description = !empty($rubric_criteria) ? 
                        "Judged on rubric: " . implode(', ', $rubric_criteria) . "." : 
                        $category['cat_discription'];
                ?>
                <div class="competition-card">
                    <div class="card-header-section">
                        <div class="card-actions">
                            <?php if ($cat_type == '1'): ?>
                                <a href="#" class="action-icon" title="Upload MCQ">
                                    <img src="./assets/images/upload.png" alt="Upload MCQ" style="width:30px; height:30px;">
                                </a>
                            <?php endif; ?>
                            <a href="#" class="action-icon" title="Edit">
                                <img src="./assets/images/edit.png" alt="Edit" style="width:30px; height:30px;">
                            </a>
                        </div>
                        <h6 class="card-title"><?php echo htmlspecialchars($category['cat_name']); ?></h6>
                        <p class="card-subtitle">
                            <?php echo htmlspecialchars($type_text); ?> 
                            <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                        </p>
                        <p class="card-description"><?php echo htmlspecialchars($description); ?></p>
                        
                        <div class="card-stats">
                            <span class="winners-count">No Of Winners: <?php echo htmlspecialchars($category['cat_number_of_winners']); ?></span>
                            <a href="#" class="slots-count text-decoration-none" data-bs-toggle="modal" data-bs-target="#slotInfoModal" data-cat-id="<?php echo $category['cat_id']; ?>" data-cat-name="<?php echo htmlspecialchars($category['cat_name']); ?>">Total Slots: <?php echo htmlspecialchars($slot_count); ?></a>
                            <button class="add-slots-btn" data-bs-toggle="modal" data-bs-target="#addSlotModal" data-cat-id="<?php echo $category['cat_id']; ?>">Add Slots</button>
                        </div>
                        
                        <div class="progress-section">
                            <div class="progress-label">Enrollment Progress</div>
                            <div class="progress">
                                <?php 
                                $progress_percentage = $total_capacity > 0 ? ($total_enrolled / $total_capacity) * 100 : 0;
                                ?>
                                <div class="progress-bar bg-primary" style="width: <?php echo $progress_percentage; ?>%;"></div>
                            </div>
                        </div>
                        
                        <div class="enrollment-count">Enrolled: <?php echo number_format($total_enrolled); ?>/<?php echo number_format($total_capacity); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Slot Information Modal -->
    <div class="modal fade slot-info-modal" id="slotInfoModal" tabindex="-1" aria-labelledby="slotInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="slotInfoModalLabel">Slot Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="category-name-header" id="slotInfoCategoryName"></div>
                    <div class="text-muted small mb-3">
                        Overview of categories, slots and enrollment progress (read-only)
                    </div>
                    
                    <div class="overview-section">
                        <h6 class="overview-title">Overview</h6>
                        <div class="overview-grid">
                            <div class="overview-item">
                                <div class="overview-label">Total Slots</div>
                                <div class="overview-value" id="overviewTotalSlots">0</div>
                            </div>
                            <div class="overview-item">
                                <div class="overview-label">Total Capacity</div>
                                <div class="overview-value" id="overviewTotalCapacity">0</div>
                            </div>
                            <div class="overview-item">
                                <div class="overview-label">Total Enrolled</div>
                                <div class="overview-value" id="overviewTotalEnrolled">0</div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="slotDatesContainer">
                        <!-- Date-wise slots will be populated here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Time Slot Modal -->
    <div class="modal fade time-slot-modal" id="addSlotModal" tabindex="-1" aria-labelledby="addSlotModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="slot-image-container">
                        <img src="./assets/images/slot.png" alt="Slot">
                    </div>
                    <h4 class="slot-modal-title">Add New Time Slots</h4>
                    
                    <form id="addSlotForm">
                        <input type="hidden" id="selectedCatId" name="cat_id">
                        <div class="mb-3">
                            <label for="slotDate" class="form-label required-field">Select Date</label>
                            <input type="date" class="form-control" id="slotDate" name="slotDate" required>
                        </div>
                        
                        <div class="time-inputs-row">
                            <div class="time-input-group">
                                <label for="fromTime" class="form-label required-field">From Time</label>
                                <input type="time" class="form-control" id="fromTime" name="fromTime" required>
                            </div>
                            <div class="time-input-group">
                                <label for="toTime" class="form-label required-field">To Time</label>
                                <input type="time" class="form-control" id="toTime" name="toTime" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="candidatesCount" class="form-label required-field">No. of Candidates</label>
                            <input type="number" class="form-control" id="candidatesCount" name="candidatesCount" min="1" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="create-slot-btn">Create Slot</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" class="row g-3" novalidate>
                        <!-- Common Fields for All Category Types -->
                        <div class="form-section">
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <label for="cat_name" class="form-label required-field">Category Name</label>
                                    <input type="text" class="form-control" id="cat_name" name="cat_name" placeholder="Full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cat_type" class="form-label required-field">Category Type</label>
                                    <select class="form-select" id="cat_type" name="cat_type" required>
                                        <option value="" selected disabled>Select category type</option>
                                        <option value="1">Quiz</option>
                                        <option value="2">Essay</option>
                                        <option value="3">Debate</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <label for="cat_discription" class="form-label required-field">Category Description</label>
                                    <textarea class="form-control" id="cat_discription" name="cat_discription" rows="1" placeholder="Enter Description" required></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- MCQ Specific Fields -->
                        <div id="mcqForm" class="dynamic-form-section">
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="mcq_cat_for" class="form-label required-field">Select Class</label>
                                        <select class="form-select" id="mcq_cat_for" name="cat_for">
                                            <option value="" selected disabled>Select age group</option>
                                            <option value="1">6-8 Class</option>
                                            <option value="2">9-12 Class</option>
                                            <option value="3">All Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_gender_specific" class="form-label required-field">Select Gender</label>
                                        <select class="form-select" id="mcq_cat_gender_specific" name="cat_gender_specific">
                                            <option value="0" selected>All</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_stage" class="form-label required-field">Select Stage</label>
                                        <select class="form-select" id="mcq_cat_stage" name="cat_stage">
                                            <option value="" selected disabled>Select Stage</option>
                                            <option value="1">Phase 1</option>
                                            <option value="2">Phase 2</option>
                                            <option value="3">Phase 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="mcq_cat_start_dt" class="form-label required-field">Exam Start Date</label>
                                        <input type="date" class="form-control" id="mcq_cat_start_dt" name="cat_start_dt">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_end_dt" class="form-label required-field">Exam End Date</label>
                                        <input type="date" class="form-control" id="mcq_cat_end_dt" name="cat_end_dt">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_result_date" class="form-label required-field">Result Date</label>
                                        <input type="date" class="form-control" id="mcq_cat_result_date" name="cat_result_date">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <label for="mcq_cat_permitted_que" class="form-label required-field">Total Questions</label>
                                        <input type="number" class="form-control" id="mcq_cat_permitted_que" name="cat_permitted_que" placeholder="Example - 100" min="1">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mcq_cat_marks" class="form-label required-field">Total Marks</label>
                                        <input type="number" class="form-control" id="mcq_cat_marks" name="cat_marks" placeholder="Example - 100">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <label for="mcq_cat_total_duration" class="form-label required-field">Exam Duration (In Min)</label>
                                        <input type="number" class="form-control" id="mcq_cat_total_duration" name="cat_total_duration" placeholder="Example - 70">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mcq_cat_number_of_winners" class="form-label required-field">No. of Winners (Per District)</label>
                                        <input type="number" class="form-control" id="mcq_cat_number_of_winners" name="cat_number_of_winners" placeholder="Example - 1000" min="1">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="mcq_cat_school_winners" class="form-label">School Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_school_winners" name="cat_school_winners" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_college_winners" class="form-label">College Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_college_winners" name="cat_college_winners" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_disabled_winner" class="form-label">Physically Disabled Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_disabled_winner" name="cat_disabled_winner" placeholder="Example - 50" min="0">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="mcq_cat_male_winner" class="form-label">Male Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_male_winner" name="cat_male_winner" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_female_winner" class="form-label">Female Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_female_winner" name="cat_female_winner" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mcq_cat_other_winner" class="form-label">Other Winners</label>
                                        <input type="number" class="form-control" id="mcq_cat_other_winner" name="cat_other_winner" placeholder="Example - 100" min="0">
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                        
                        <!-- Essay/Debate Specific Fields -->
                        <div id="essayDebateForm" class="dynamic-form-section">
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="essay_cat_for" class="form-label required-field">Select Age Group</label>
                                        <select class="form-select" id="essay_cat_for" name="cat_for">
                                            <option value="" selected disabled>Select age group</option>
                                            <option value="1">6-8 years</option>
                                            <option value="2">9-12 years</option>
                                            <option value="3">All Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_gender_specific" class="form-label required-field">Select Gender</label>
                                        <select class="form-select" id="essay_cat_gender_specific" name="cat_gender_specific">
                                            <option value="0" selected>All</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_stage" class="form-label required-field">Select Stage</label>
                                        <select class="form-select" id="essay_cat_stage" name="cat_stage">
                                            <option value="" selected disabled>Select Stage</option>
                                            <option value="1">Phase 1</option>
                                            <option value="2">Phase 2</option>
                                            <option value="3">Phase 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="essay_cat_start_dt" class="form-label required-field">Start Date</label>
                                        <input type="date" class="form-control" id="essay_cat_start_dt" name="cat_start_dt">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_end_dt" class="form-label required-field">End Date</label>
                                        <input type="date" class="form-control" id="essay_cat_end_dt" name="cat_end_dt">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_result_date" class="form-label required-field">Result Date</label>
                                        <input type="date" class="form-control" id="essay_cat_result_date" name="cat_result_date">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <label for="file_type" class="form-label required-field">Allowed File Types</label>
                                        <select class="form-select" id="file_type" name="file_type">
                                            <option value="" selected disabled>Select file</option>
                                            <option value="pdf">PDF</option>
                                            <option value="doc">DOC/DOCX</option>
                                            <option value="image">Image (JPG, PNG)</option>
                                            <option value="all">All file types</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="file_max_size" class="form-label required-field">Max File Size (MB)</label>
                                        <input type="number" class="form-control" id="file_max_size" name="file_max_size" placeholder="Example -1000">
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-6">
                                        <label for="essay_cat_marks" class="form-label required-field">Total Marks</label>
                                        <input type="number" class="form-control" id="essay_cat_marks" name="cat_marks" placeholder="Example -100">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="essay_cat_number_of_winners" class="form-label required-field">No. of Winners (Per District)</label>
                                        <input type="number" class="form-control" id="essay_cat_number_of_winners" name="cat_number_of_winners" placeholder="Example -1000" min="1">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="essay_cat_school_winners" class="form-label">School Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_school_winners" name="cat_school_winners" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_college_winners" class="form-label">College Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_college_winners" name="cat_college_winners" placeholder="Example - 500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_disabled_winner" class="form-label">Physically Disabled Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_disabled_winner" name="cat_disabled_winner" placeholder="Example - 50" min="0">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <div class="row form-row">
                                    <div class="col-md-4">
                                        <label for="essay_cat_male_winner" class="form-label required-field">Male Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_male_winner" name="cat_male_winner" placeholder="Example -500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_female_winner" class="form-label required-field">Female Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_female_winner" name="cat_female_winner" placeholder="Example -500" min="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="essay_cat_other_winner" class="form-label">Other Winners</label>
                                        <input type="number" class="form-control" id="essay_cat_other_winner" name="cat_other_winner" placeholder="Example - 100" min="0">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="rubric-section">
                                <div class="rubric-header">
                                    <h6 class="rubric-title text-center">Add Rubric (QUBS) / Evaluation Criteria for '<span id="categoryNameDisplay">Farmer Essay</span>'</h6>
                                    <div class="rubric-subtitle-container">
                                        <div class="rubric-left">
                                            <strong>Judgement Rubric (criteria & weights)</strong><br>
                                            Define how judges should score uploaded files
                                        </div>
                                        <div class="rubric-right">
                                            Judges score 0-100 on this criterion;<br>
                                            final = weighted sum.
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="criteriaContainer">
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label required-field">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_1" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label required-field">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_1" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_2" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_2" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_3" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_3" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_4" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_4" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_5" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_5" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                    
                                    <div class="criteria-row">
                                        <div class="criteria-input">
                                            <label class="form-label">Criterion Title (e.g Topic Relevance)</label>
                                            <input type="text" class="form-control" name="cat_qubs_6" placeholder="Enter Criterion Title (e.g Topic Relevance)">
                                        </div>
                                        <div class="weight-input">
                                            <label class="form-label">Weight (int)</label>
                                            <input type="number" class="form-control" name="cat_qubs_weightages_6" min="1" max="100" placeholder="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <div class="row form-row">
                                <div class="col-12">
                                    <label for="cat_instruction" class="form-label required-field">Rules/Instruction (हिंदी निर्देश)</label>
                                    <textarea class="form-control" id="cat_instruction" name="cat_instruction" rows="3" placeholder="Enter rules and instructions in Hindi" required>- प्रत्येक प्रतिभागी को केवल एक ही प्रयास करने की अनुमति है।
- प्रत्येक क्विज़ में 20 बहुविकल्पीय प्रश्न होंगे।</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-submit btn-sm px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- MCQ Upload Modal -->
    <div class="modal fade" id="mcqUploadModal" tabindex="-1" aria-labelledby="mcqUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mcqUploadModalLabel">Upload Question for <span id="mcqCategoryName">Category</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Header Section -->
                    <div class="mcq-header-section mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 fw-bold">Question Bank</h6>
                            <div class="d-flex align-items-center">
                                <div class="search-box position-relative me-3">
                                    <input type="text" class="form-control form-control-sm" id="questionSearch" placeholder="Search Question">
                                    <i class="fas fa-search position-absolute" style="right: 10px; top: 7px; color: #6c757d;"></i>
                                </div>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#uploadQuestionsModal">
                                    <i class="fas fa-upload me-1"></i>Upload Questions
                                </button>
                            </div>
                        </div>
                        <div class="text-muted small">
                            English + Hindi questions. Edit or add new questions below
                        </div>
                    </div>
                    
                    <div class="questions-container mb-4" id="questionsList">
                        <div class="text-center py-5" id="noQuestionsMessage">
                            <i class="fas fa-file-excel fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No questions uploaded yet. Click "Upload Questions" to add questions from an Excel file.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Questions Modal -->
    <div class="modal fade" id="uploadQuestionsModal" tabindex="-1" aria-labelledby="uploadQuestionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadQuestionsModalLabel">Upload Question for <span id="uploadCategoryName">Category</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="upload-instructions mb-4">
                        <h6 class="mb-3">Upload Instructions</h6>
                        <ul class="list-unstyled small">
                            <li class="mb-1">• Upload Excel file with questions in the specified format</li>
                            <li class="mb-1">• Required columns: Question, Option A, Option B, Option C, Option D, Correct Answer</li>
                            <li class="mb-1">• Questions will be displayed in the question bank after upload</li>
                            <li class="mb-1">• You can delete individual questions after upload</li>
                        </ul>
                    </div>
                    
                    <div class="upload-area p-4 border border-dashed rounded text-center mb-3" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-3"></i>
                        <p class="mb-2">Drag & drop files here, or click to browse</p>
                        <p class="small text-muted mb-3">Allowed: xlsx, xls (Excel files only)</p>
                        <button type="button" class="btn btn-outline-primary btn-sm" id="browseFilesBtn">Browse Files</button>
                        <input type="file" id="fileInput" accept=".xlsx,.xls" style="display: none;">
                    </div>
                    
                    <div class="selected-file mb-3" id="selectedFileContainer" style="display: none;">
                        <div class="alert alert-info py-2">
                            <i class="fas fa-file-excel me-2"></i>
                            <span id="selectedFileName">No file selected</span>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="btn btn-warning" id="uploadSubmitBtn" disabled>Upload & Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Toast Notification -->
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <i class="fas fa-check-circle me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                File uploaded successfully!
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const BASE_URL = "<?= $base_url ?>";

        // function for auto calculations 
        function calculateMCQFields() {
            const totalQuestions = parseInt(document.getElementById('mcq_cat_permitted_que').value) || 0;
            
            const marksField = document.getElementById('mcq_cat_marks');
            const durationField = document.getElementById('mcq_cat_total_duration');
            
            if (totalQuestions > 0) {
                if (!marksField.hasAttribute('data-manual') || marksField.value === '') {
                    const totalMarks = totalQuestions;
                    marksField.value = totalMarks;
                }
                
                if (!durationField.hasAttribute('data-manual') || durationField.value === '') {
                    const duration = Math.ceil((totalQuestions * 70) / 100);
                    durationField.value = duration;
                }
            } else {
                if (!marksField.hasAttribute('data-manual')) {
                    marksField.value = '';
                }
                if (!durationField.hasAttribute('data-manual')) {
                    durationField.value = '';
                }
            }
            
            calculateWinnersDistribution('mcq');
        }


        document.getElementById('mcq_cat_marks').addEventListener('input', function() {
            this.setAttribute('data-manual', 'true');
        });

        document.getElementById('mcq_cat_total_duration').addEventListener('input', function() {
            this.setAttribute('data-manual', 'true');
        });

        function calculateEssayWinners() {
            calculateWinnersDistribution('essay');
        }

        function calculateWinnersDistribution(type) {
            const prefix = type === 'mcq' ? 'mcq_' : 'essay_';
            const totalWinnersInput = document.getElementById(prefix + 'cat_number_of_winners');
            const totalWinners = parseInt(totalWinnersInput.value) || 0;
            
            const school = parseInt(document.getElementById(prefix + 'cat_school_winners').value) || 0;
            const college = parseInt(document.getElementById(prefix + 'cat_college_winners').value) || 0;
            const disabled = parseInt(document.getElementById(prefix + 'cat_disabled_winner').value) || 0;
            const male = parseInt(document.getElementById(prefix + 'cat_male_winner').value) || 0;
            const female = parseInt(document.getElementById(prefix + 'cat_female_winner').value) || 0;
            const other = parseInt(document.getElementById(prefix + 'cat_other_winner').value) || 0;
            
            const educationTotal = school + college;
            
            const genderTotal = male + female + other;
            
            // Update summary
            const summaryElement = document.getElementById(prefix + 'WinnersSummary');
            const validationElement = document.getElementById(prefix + 'TotalValidation');
            
            summaryElement.textContent = `Total: ${totalWinners} | School: ${school} + College: ${college} | Gender: Male ${male} + Female ${female} + Other ${other} | Disabled: ${disabled}`;
            
            if (educationTotal === totalWinners && genderTotal === totalWinners) {
                validationElement.textContent = '✓ All totals match correctly';
                validationElement.className = 'total-validation total-valid';
            } else {
                validationElement.textContent = `✗ Totals don't match: Education (${educationTotal}) / Gender (${genderTotal}) / Total (${totalWinners})`;
                validationElement.className = 'total-validation total-invalid';
            }
        }

        // Smart distribution calculation
        function smartDistributeWinners(type) {
            const prefix = type === 'mcq' ? 'mcq_' : 'essay_';
            const totalWinners = parseInt(document.getElementById(prefix + 'cat_number_of_winners').value) || 0;
            
            if (totalWinners > 0) {
                const school = Math.round(totalWinners * 0.50);
                const college = Math.max(0, totalWinners - school);
                
                const male = Math.round(totalWinners * 0.45); 
                const female = Math.round(totalWinners * 0.45);
                const other = Math.max(0, totalWinners - male - female);
                
                // Disabled winners - approximately 5%
                const disabled = Math.max(0, Math.round(totalWinners * 0.05));
                
                if (!document.getElementById(prefix + 'cat_school_winners').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_school_winners').value = school;
                }
                if (!document.getElementById(prefix + 'cat_college_winners').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_college_winners').value = college;
                }
                if (!document.getElementById(prefix + 'cat_male_winner').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_male_winner').value = male;
                }
                if (!document.getElementById(prefix + 'cat_female_winner').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_female_winner').value = female;
                }
                if (!document.getElementById(prefix + 'cat_other_winner').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_other_winner').value = other;
                }
                if (!document.getElementById(prefix + 'cat_disabled_winner').hasAttribute('data-manual')) {
                    document.getElementById(prefix + 'cat_disabled_winner').value = disabled;
                }
            }
        }

        // Adjust other fields 
        function adjustWinnersDistribution(type, changedField) {
            const prefix = type === 'mcq' ? 'mcq_' : 'essay_';
            const totalWinners = parseInt(document.getElementById(prefix + 'cat_number_of_winners').value) || 0;
            
            if (totalWinners <= 0) return;
            
            const school = parseInt(document.getElementById(prefix + 'cat_school_winners').value) || 0;
            const college = parseInt(document.getElementById(prefix + 'cat_college_winners').value) || 0;
            const male = parseInt(document.getElementById(prefix + 'cat_male_winner').value) || 0;
            const female = parseInt(document.getElementById(prefix + 'cat_female_winner').value) || 0;
            const other = parseInt(document.getElementById(prefix + 'cat_other_winner').value) || 0;
            
            document.getElementById(prefix + changedField).setAttribute('data-manual', 'true');
            
            if (changedField === 'cat_school_winners' || changedField === 'cat_college_winners') {
                const educationTotal = school + college;
                const difference = totalWinners - educationTotal;
                
                if (difference !== 0) {
                    if (changedField === 'cat_school_winners') {
                        const newCollege = Math.max(0, college + difference);
                        document.getElementById(prefix + 'cat_college_winners').value = newCollege;
                    } else {
                        const newSchool = Math.max(0, school + difference);
                        document.getElementById(prefix + 'cat_school_winners').value = newSchool;
                    }
                }
            } else if (changedField.includes('male') || changedField.includes('female') || changedField.includes('other')) {
                const genderTotal = male + female + other;
                const difference = totalWinners - genderTotal;
                
                if (difference !== 0) {
                    const groups = [
                        { id: 'cat_male_winner', value: male },
                        { id: 'cat_female_winner', value: female },
                        { id: 'cat_other_winner', value: other }
                    ];
                    
                    const largestGroup = groups
                        .filter(group => prefix + group.id !== prefix + changedField)
                        .reduce((max, group) => group.value > max.value ? group : max, groups[0]);
                    
                    if (largestGroup) {
                        const newValue = Math.max(0, largestGroup.value + difference);
                        document.getElementById(prefix + largestGroup.id).value = newValue;
                    }
                }
            }
        }

        // Category type selection functionality
        document.getElementById('cat_type').addEventListener('change', function() {
            const categoryType = this.value;
            
            document.querySelectorAll('.dynamic-form-section').forEach(section => {
                section.classList.remove('active');
            });
            
            if (categoryType === '1') { 
                document.getElementById('mcqForm').classList.add('active');
                removeRequiredFromEssayFields();
                addRequiredToMCQFields();
            } else if (categoryType === '2' || categoryType === '3') { 
                document.getElementById('essayDebateForm').classList.add('active');
                removeRequiredFromMCQFields();
                addRequiredToEssayFields();
            } else {
                removeRequiredFromMCQFields();
                removeRequiredFromEssayFields();
            }
        });

        // Function to add required attributes to MCQ fields
        function addRequiredToMCQFields() {
            const fields = [
                'mcq_cat_for', 'mcq_cat_gender_specific', 'mcq_cat_start_dt', 
                'mcq_cat_end_dt', 'mcq_cat_total_duration', 'mcq_cat_permitted_que', 
                'mcq_cat_marks', 'mcq_cat_stage', 'mcq_cat_result_date', 'mcq_cat_number_of_winners'
            ];
            
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.setAttribute('required', 'required');
            });
        }

        // Function to remove required attributes from MCQ fields
        function removeRequiredFromMCQFields() {
            const fields = [
                'mcq_cat_for', 'mcq_cat_gender_specific', 'mcq_cat_start_dt', 
                'mcq_cat_end_dt', 'mcq_cat_total_duration', 'mcq_cat_permitted_que',
                'mcq_cat_marks', 'mcq_cat_number_of_winners', 'mcq_cat_school_winners', 
                'mcq_cat_college_winners', 'mcq_cat_disabled_winner', 'mcq_cat_stage',
                'mcq_cat_male_winner', 'mcq_cat_female_winner', 'mcq_cat_other_winner',
                'mcq_cat_result_date'
            ];
            
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.removeAttribute('required');
            });
        }

        // Function to add required attributes to Essay fields
        function addRequiredToEssayFields() {
            const fields = [
                'essay_cat_for', 'essay_cat_gender_specific', 'essay_cat_start_dt', 
                'essay_cat_end_dt', 'file_type', 'file_max_size', 'essay_cat_stage',
                'essay_cat_marks', 'essay_cat_result_date', 'essay_cat_number_of_winners'
            ];
            
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.setAttribute('required', 'required');
            });
            
            document.querySelector('input[name="cat_qubs_1"]').setAttribute('required', 'required');
            document.querySelector('input[name="cat_qubs_weightages_1"]').setAttribute('required', 'required');
        }

        // Function to remove required attributes from Essay fields
        function removeRequiredFromEssayFields() {
            const fields = [
                'essay_cat_for', 'essay_cat_gender_specific', 'essay_cat_start_dt', 
                'essay_cat_end_dt', 'file_type', 'file_max_size', 'essay_cat_number_of_winners',
                'essay_cat_school_winners', 'essay_cat_college_winners', 'essay_cat_disabled_winner',
                'essay_cat_male_winner', 'essay_cat_female_winner', 'essay_cat_other_winner',
                'essay_cat_marks', 'essay_cat_stage', 'essay_cat_result_date'
            ];
            
            fields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field) field.removeAttribute('required');
            });
            
            document.querySelectorAll('#criteriaContainer input').forEach(input => {
                input.removeAttribute('required');
            });
        }

        // Event listeners for auto-calculation
        document.getElementById('mcq_cat_permitted_que').addEventListener('input', calculateMCQFields);
        
        // MCQ winners distribution listeners
        document.getElementById('mcq_cat_number_of_winners').addEventListener('input', function() {
            smartDistributeWinners('mcq');
        });
        
        document.getElementById('mcq_cat_school_winners').addEventListener('input', function() {
            adjustWinnersDistribution('mcq', 'cat_school_winners');
        });
        
        document.getElementById('mcq_cat_college_winners').addEventListener('input', function() {
            adjustWinnersDistribution('mcq', 'cat_college_winners');
        });
        
        document.getElementById('mcq_cat_male_winner').addEventListener('input', function() {
            adjustWinnersDistribution('mcq', 'cat_male_winner');
        });
        
        document.getElementById('mcq_cat_female_winner').addEventListener('input', function() {
            adjustWinnersDistribution('mcq', 'cat_female_winner');
        });
        
        document.getElementById('mcq_cat_other_winner').addEventListener('input', function() {
            adjustWinnersDistribution('mcq', 'cat_other_winner');
        });
        
        // Essay winners distribution listeners
        document.getElementById('essay_cat_number_of_winners').addEventListener('input', function() {
            smartDistributeWinners('essay');
        });
        
        document.getElementById('essay_cat_school_winners').addEventListener('input', function() {
            adjustWinnersDistribution('essay', 'cat_school_winners');
        });
        
        document.getElementById('essay_cat_college_winners').addEventListener('input', function() {
            adjustWinnersDistribution('essay', 'cat_college_winners');
        });
        
        document.getElementById('essay_cat_male_winner').addEventListener('input', function() {
            adjustWinnersDistribution('essay', 'cat_male_winner');
        });
        
        document.getElementById('essay_cat_female_winner').addEventListener('input', function() {
            adjustWinnersDistribution('essay', 'cat_female_winner');
        });
        
        document.getElementById('essay_cat_other_winner').addEventListener('input', function() {
            adjustWinnersDistribution('essay', 'cat_other_winner');
        });

        document.getElementById('cat_name').addEventListener('input', function() {
            document.getElementById('categoryNameDisplay').textContent = this.value || 'Farmer Essay';
        });

        document.getElementById('addCategoryModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('addCategoryForm').reset();
            document.querySelectorAll('.dynamic-form-section').forEach(section => {
                section.classList.remove('active');
            });
            removeRequiredFromMCQFields();
            removeRequiredFromEssayFields();
            
            document.querySelectorAll('[data-manual]').forEach(el => {
                el.removeAttribute('data-manual');
            });
        });

        // Add category api integration
        document.getElementById('addCategoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const categoryType = document.getElementById('cat_type').value;
            let isValid = true;
            
            if (!document.getElementById('cat_name').value) {
                isValid = false;
                alert('Please enter Category Name');
                return;
            }
            
            if (!document.getElementById('cat_discription').value) {
                isValid = false;
                alert('Please enter Category Description');
                return;
            }
            
            if (!document.getElementById('cat_instruction').value) {
                isValid = false;
                alert('Please enter Rules/Instructions');
                return;
            }
            
            if (!categoryType) {
                isValid = false;
                alert('Please select Category Type');
                return;
            }
            
            // Validate winners distribution
            if (categoryType === '1') {
                const totalWinners = parseInt(document.getElementById('mcq_cat_number_of_winners').value) || 0;
                const school = parseInt(document.getElementById('mcq_cat_school_winners').value) || 0;
                const college = parseInt(document.getElementById('mcq_cat_college_winners').value) || 0;
                const male = parseInt(document.getElementById('mcq_cat_male_winner').value) || 0;
                const female = parseInt(document.getElementById('mcq_cat_female_winner').value) || 0;
                const other = parseInt(document.getElementById('mcq_cat_other_winner').value) || 0;
                
                if (school + college !== totalWinners) {
                    isValid = false;
                    alert(`School winners (${school}) + College winners (${college}) must equal Total winners (${totalWinners})`);
                    return;
                }
                
                if (male + female + other !== totalWinners) {
                    isValid = false;
                    alert(`Male winners (${male}) + Female winners (${female}) + Other winners (${other}) must equal Total winners (${totalWinners})`);
                    return;
                }
                
            } else if (categoryType === '2' || categoryType === '3') {
                const totalWinners = parseInt(document.getElementById('essay_cat_number_of_winners').value) || 0;
                const school = parseInt(document.getElementById('essay_cat_school_winners').value) || 0;
                const college = parseInt(document.getElementById('essay_cat_college_winners').value) || 0;
                const male = parseInt(document.getElementById('essay_cat_male_winner').value) || 0;
                const female = parseInt(document.getElementById('essay_cat_female_winner').value) || 0;
                const other = parseInt(document.getElementById('essay_cat_other_winner').value) || 0;
                
                if (school + college !== totalWinners) {
                    isValid = false;
                    alert(`School winners (${school}) + College winners (${college}) must equal Total winners (${totalWinners})`);
                    return;
                }
                
                if (male + female + other !== totalWinners) {
                    isValid = false;
                    alert(`Male winners (${male}) + Female winners (${female}) + Other winners (${other}) must equal Total winners (${totalWinners})`);
                    return;
                }
            }
            
            if (isValid) {
                const formData = collectFormData();
                submitCategoryForm(formData);
            }
        });

        // Function to collect all form data
        function collectFormData() {
            const formData = new FormData();
            
            formData.append('cat_name', document.getElementById('cat_name').value);
            formData.append('cat_type', document.getElementById('cat_type').value);
            formData.append('cat_discription', document.getElementById('cat_discription').value);
            formData.append('cat_instruction', document.getElementById('cat_instruction').value);
            
            const categoryType = document.getElementById('cat_type').value;
            
            if (categoryType === '1') { 
                formData.append('cat_for', document.getElementById('mcq_cat_for').value);
                formData.append('cat_gender_specific', document.getElementById('mcq_cat_gender_specific').value);
                formData.append('cat_start_dt', document.getElementById('mcq_cat_start_dt').value);
                formData.append('cat_end_dt', document.getElementById('mcq_cat_end_dt').value);
                formData.append('cat_result_date', document.getElementById('mcq_cat_result_date').value);
                formData.append('cat_stage', document.getElementById('mcq_cat_stage').value);
                formData.append('cat_total_duration', document.getElementById('mcq_cat_total_duration').value);
                formData.append('cat_permitted_que', document.getElementById('mcq_cat_permitted_que').value);
                formData.append('cat_marks', document.getElementById('mcq_cat_marks').value);
                formData.append('cat_number_of_winners', document.getElementById('mcq_cat_number_of_winners').value);
                
                formData.append('cat_school_winners', document.getElementById('mcq_cat_school_winners').value || '0');
                formData.append('cat_college_winners', document.getElementById('mcq_cat_college_winners').value || '0');
                formData.append('cat_male_winner', document.getElementById('mcq_cat_male_winner').value || '0');
                formData.append('cat_female_winner', document.getElementById('mcq_cat_female_winner').value || '0');
                formData.append('cat_other_winner', document.getElementById('mcq_cat_other_winner').value || '0');
                formData.append('cat_disabled_winner', document.getElementById('mcq_cat_disabled_winner').value || '0');
                
            } else if (categoryType === '2' || categoryType === '3') { 
                formData.append('cat_for', document.getElementById('essay_cat_for').value);
                formData.append('cat_gender_specific', document.getElementById('essay_cat_gender_specific').value);
                formData.append('cat_start_dt', document.getElementById('essay_cat_start_dt').value);
                formData.append('cat_end_dt', document.getElementById('essay_cat_end_dt').value);
                formData.append('cat_stage', document.getElementById('essay_cat_stage').value);
                formData.append('cat_result_date', document.getElementById('essay_cat_result_date').value);
                formData.append('file_type', document.getElementById('file_type').value);
                formData.append('file_max_size', document.getElementById('file_max_size').value);
                formData.append('cat_marks', document.getElementById('essay_cat_marks').value);
                formData.append('cat_number_of_winners', document.getElementById('essay_cat_number_of_winners').value);

                formData.append('cat_school_winners', document.getElementById('essay_cat_school_winners').value || '0');
                formData.append('cat_college_winners', document.getElementById('essay_cat_college_winners').value || '0');
                formData.append('cat_male_winner', document.getElementById('essay_cat_male_winner').value || '0');
                formData.append('cat_female_winner', document.getElementById('essay_cat_female_winner').value || '0');
                formData.append('cat_other_winner', document.getElementById('essay_cat_other_winner').value || '0');
                formData.append('cat_disabled_winner', document.getElementById('essay_cat_disabled_winner').value || '0');
                
                for (let i = 1; i <= 6; i++) {
                    const criterion = document.querySelector(`input[name="cat_qubs_${i}"]`).value;
                    const weight = document.querySelector(`input[name="cat_qubs_weightages_${i}"]`).value;
                    
                    if (criterion && weight) {
                        formData.append(`cat_qubs_${i}`, criterion);
                        formData.append(`cat_qubs_weightages_${i}`, weight);
                    }
                }
            }
            
            return formData;
        }

        // Function to submit form data via API
        function submitCategoryForm(formData) {
            const submitBtn = document.querySelector('#addCategoryForm button[type="submit"]');
            
            submitBtn.disabled = true;
            submitBtn.textContent = "Creating...";
            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", `${BASE_URL}/api/v1/organiser/create_category.php`, true);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = "Create";
                    
                    if (xhr.status === 200) {
                        let data;
                        try { 
                            data = JSON.parse(xhr.responseText); 
                        } catch(err) { 
                            console.error("Invalid server response:", err);
                            return; 
                        }
                        
                        console.log("API Response:", data);
                        
                        if (data.error_code === 200) {
                            const modalElement = document.getElementById('addCategoryModal');
                            const modal = bootstrap.Modal.getInstance(modalElement);
                            if (modal) {
                                modal.hide();
                            }
                            
                            setTimeout(() => {
                                window.location.reload();
                            }, 300);
                            
                        } else if (data.error_code === 403) {
                            alert("Access denied. Please check your permissions.");
                        } else if (data.error_code === 401) {
                            alert("Session expired. Please login again.");
                        } else {
                            if (data.message && !data.message.toLowerCase().includes('success')) {
                                alert(data.message || "Category creation failed, please try again later.");
                            } else {
                                const modalElement = document.getElementById('addCategoryModal');
                                const modal = bootstrap.Modal.getInstance(modalElement);
                                if (modal) {
                                    modal.hide();
                                }
                                setTimeout(() => {
                                    window.location.reload();
                                }, 300);
                            }
                        }
                    } else {
                        alert("Server error, please try again later.");
                    }
                }
            };
            
            xhr.onerror = function() {
                submitBtn.disabled = false;
                submitBtn.textContent = "Create";
                alert("Network error, please check your connection and try again.");
            };
            
            xhr.send(formData);
        }


        // Time Slot Form Submission
        document.getElementById('addSlotForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const slotDate = document.getElementById('slotDate').value;
            const fromTime = document.getElementById('fromTime').value;
            const toTime = document.getElementById('toTime').value;
            const candidatesCount = document.getElementById('candidatesCount').value;
            const catId = document.getElementById('selectedCatId').value;
            
            if (!slotDate || !fromTime || !toTime || !candidatesCount || !catId) {
                alert('Please fill all required fields');
                return;
            }
            
            if (fromTime >= toTime) {
                alert('From time must be before To time');
                return;
            }
            
            const formData = new FormData();
            formData.append('cat_id', catId);
            formData.append('slot_date', slotDate);
            formData.append('start_time', fromTime);
            formData.append('end_time', toTime);
            formData.append('permited_candidate', candidatesCount);
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.disabled = true;
            submitBtn.textContent = "Creating...";
            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", `${BASE_URL}/api/v1/organiser/create_slot.php`, true);
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                    
                    if (xhr.status === 200) {
                        let data;
                        try { 
                            data = JSON.parse(xhr.responseText); 
                        } catch(err) { 
                            alert("Invalid server response"); 
                            return; 
                        }
                        
                        console.log("Slot API Response:", data);
                        
                        if (data.error_code === 200) {
                            alert("Time slot created successfully!");
                            
                            const modal = bootstrap.Modal.getInstance(document.getElementById('addSlotModal'));
                            modal.hide();
                            
                            document.getElementById('addSlotForm').reset();
                            
                            window.location.reload();
                            
                        } else if (data.error_code === 403) {
                            alert("Access denied. Please check your permissions.");
                        } else if (data.error_code === 401) {
                            alert("Session expired. Please login again.");
                        } else {
                            alert(data.message || "Slot creation failed, please try again later.");
                        }
                    } else {
                        alert("Server error, please try again later.");
                    }
                }
            };            
            xhr.send(formData);
        });
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-slots-btn')) {
                const catId = e.target.getAttribute('data-cat-id');
                document.getElementById('selectedCatId').value = catId;
            }
        });

        // Slot Information Modal functionality
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('slots-count')) {
                const catId = e.target.getAttribute('data-cat-id');
                const catName = e.target.getAttribute('data-cat-name');
                
                document.getElementById('slotInfoCategoryName').textContent = catName;
                
                const categoryData = <?php echo json_encode($categories); ?>;
                const currentCategory = categoryData.find(cat => cat.category.cat_id === catId);
                
                if (currentCategory) {
                    const slots = currentCategory.slots;
                    const slotCount = slots.length;
                    
                    let totalCapacity = 0;
                    let totalEnrolled = 0;
                    
                    slots.forEach(slot => {
                        totalCapacity += parseInt(slot.slot_permited_participents);
                        totalEnrolled += parseInt(slot.slot_booked_particepents || 0);
                    });
                    
                    document.getElementById('overviewTotalSlots').textContent = slotCount;
                    document.getElementById('overviewTotalCapacity').textContent = totalCapacity.toLocaleString();
                    document.getElementById('overviewTotalEnrolled').textContent = totalEnrolled.toLocaleString();
                    
                    const slotsByDate = {};
                    slots.forEach(slot => {
                        const date = slot.slot_date;
                        if (!slotsByDate[date]) {
                            slotsByDate[date] = [];
                        }
                        slotsByDate[date].push(slot);
                    });
                    
                    const datesContainer = document.getElementById('slotDatesContainer');
                    datesContainer.innerHTML = '';

                    if (Object.keys(slotsByDate).length === 0) {
                        datesContainer.innerHTML = '<div class="no-slots-message">No slots available for this category</div>';
                    } else {
                        const sortedDates = Object.keys(slotsByDate).sort();
                        
                        sortedDates.forEach(date => {
                            const dateSlots = slotsByDate[date];
                            
                            const dateSection = document.createElement('div');
                            dateSection.className = 'slot-date-section';
                            
                            const dateHeader = document.createElement('div');
                            dateHeader.className = 'slot-date-header';
                            
                            const dateTitle = document.createElement('div');
                            dateTitle.className = 'slot-date-title';
                            dateTitle.textContent = `Date: ${formatDate(date)}`;
                            
                            const addButton = document.createElement('button');
                            addButton.className = 'slot-add-btn';
                            addButton.type = 'button';
                            addButton.setAttribute('data-cat-id', catId);
                            addButton.setAttribute('data-slot-date', date);
                            addButton.innerHTML = '<img src="./assets/images/slot.png" alt="Add Slot">';
                            
                            // Add click event to the add button
                            addButton.addEventListener('click', function() {
                                const slotDate = this.getAttribute('data-slot-date');
                                const catId = this.getAttribute('data-cat-id');
                                
                                document.getElementById('slotDate').value = slotDate;
                                document.getElementById('selectedCatId').value = catId;
                                
                                const slotInfoModal = bootstrap.Modal.getInstance(document.getElementById('slotInfoModal'));
                                slotInfoModal.hide();
                                
                                const addSlotModal = new bootstrap.Modal(document.getElementById('addSlotModal'));
                                addSlotModal.show();
                            });
                            
                            dateHeader.appendChild(dateTitle);
                            dateHeader.appendChild(addButton);
                            
                            const cardsContainer = document.createElement('div');
                            cardsContainer.className = 'slot-cards-layout';
                            
                            // Create slot cards
                            dateSlots.forEach(slot => {
                                const slotCard = document.createElement('div');
                                slotCard.className = 'slot-card';
                                
                                const startTime = slot.slot_start_time ? formatTime(slot.slot_start_time) : 'N/A';
                                const endTime = slot.slot_end_time ? formatTime(slot.slot_end_time) : 'N/A';
                                const capacity = parseInt(slot.slot_permited_participents);
                                const enrolled = parseInt(slot.slot_booked_particepents || 0);
                                const progressPercentage = capacity > 0 ? (enrolled / capacity) * 100 : 0;
                                
                                slotCard.innerHTML = `
                                    <div class="slot-content">
                                        <div class="slot-labels-row">
                                            <span>TIME</span>
                                            <span>CAPACITY</span>
                                            <span>ENROLLED</span>
                                            <span>PROGRESS</span>
                                        </div>
                                        <div class="slot-details-row">
                                            <span class="slot-time">${startTime} to ${endTime}</span>
                                            <span class="slot-capacity">${capacity.toLocaleString()}</span>
                                            <span class="slot-enrolled">${enrolled.toLocaleString()}</span>
                                            <div class="slot-progress-container">
                                                <div class="slot-progress">
                                                    <div class="slot-progress-bar" style="width: ${progressPercentage}%"></div>
                                                </div>
                                                <span class="slot-progress-percentage">${Math.round(progressPercentage)}%</span>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                cardsContainer.appendChild(slotCard);
                            });
                            
                            dateSection.appendChild(dateHeader);
                            dateSection.appendChild(cardsContainer);
                            datesContainer.appendChild(dateSection);
                        });
                    }
                }
            }
        });

        // Set category ID 
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-slots-btn')) {
                const catId = e.target.getAttribute('data-cat-id');
                document.getElementById('selectedCatId').value = catId;
                
                document.getElementById('slotDate').value = '';
            }
        });

        // Helper function to format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-GB', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        // Helper function to format time
        function formatTime(timeString) {
            if (!timeString) return 'N/A';
            
            const timeParts = timeString.split(':');
            if (timeParts.length < 2) return timeString;
            
            let hours = parseInt(timeParts[0]);
            const minutes = timeParts[1];
            const ampm = hours >= 12 ? 'PM' : 'AM';
            
            hours = hours % 12;
            hours = hours ? hours : 12; 
            
            return `${hours}:${minutes} ${ampm}`;
        }

         // Sidebar toggle functionality
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

        // script for upload qutions
        document.addEventListener('DOMContentLoaded', function() {
            let currentQuestions = [];
            let currentCategoryId = null;

            document.addEventListener('click', function(e) {
                if (e.target.closest('.action-icon') && e.target.closest('.action-icon').querySelector('img[alt="Upload MCQ"]')) {
                    const card = e.target.closest('.competition-card');
                    const categoryName = card.querySelector('.card-title').textContent;
                    const catId = card.querySelector('.add-slots-btn').getAttribute('data-cat-id');
                    
                    console.log('Upload MCQ clicked:', categoryName, catId);
                    
                    document.getElementById('mcqCategoryName').textContent = categoryName;
                    document.getElementById('uploadCategoryName').textContent = categoryName;
                    currentCategoryId = catId;
                    
                    loadQuestionsForCategory(catId);
                    
                    const mcqModal = new bootstrap.Modal(document.getElementById('mcqUploadModal'));
                    mcqModal.show();
                }
            });

            // Load questions function
            function loadQuestionsForCategory(catId) {
                const questionsList = document.getElementById('questionsList');
                
                console.log('Loading questions for category:', catId);
                
                questionsList.innerHTML = '<div class="text-center py-3"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Loading questions...</p></div>';
                
                setTimeout(() => {
                    fetch(`${BASE_URL}/api/v1/organiser/fetch_cat_questions.php?cat_id=${catId}`)
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('API Response:', data);
                            
                            if (data.error_code === 200 && data.data && data.data.length > 0) {
                                currentQuestions = data.data;
                                displayQuestions(currentQuestions);
                            } else {
                                showNoQuestions();
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching questions:', error);
                            showNoQuestions();
                        });
                }, 500);
            }

            function showNoQuestions() {
                const questionsList = document.getElementById('questionsList');
                questionsList.innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-file-excel fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No questions uploaded yet. Click "Upload Questions" to add questions from an Excel file.</p>
                    </div>
                `;
            }

            function displayQuestions(questions) {
                const questionsList = document.getElementById('questionsList');
                
                console.log('Displaying questions:', questions.length);
                
                if (!questions || questions.length === 0) {
                    showNoQuestions();
                    return;
                }
                
                questionsList.innerHTML = '';
                
                questions.forEach((question, index) => {
                    const questionElement = createQuestionElement(question, index + 1);
                    questionsList.appendChild(questionElement);
                });
            }

            function createQuestionElement(q, number) {
                const div = document.createElement('div');
                div.className = 'question-item p-3 border rounded mb-3 bg-light';
                
                const questionText = [];
                if (q.que_discreption_eng) questionText.push(q.que_discreption_eng);
                if (q.que_discreption_hindi) questionText.push(q.que_discreption_hindi);
                
                const options = [
                    { letter: 'A', eng: q.que_option_1_eng, hindi: q.que_option_1_hindi, isCorrect: q.que_correct_option === 'A' },
                    { letter: 'B', eng: q.que_option_2_eng, hindi: q.que_option_2_hindi, isCorrect: q.que_correct_option === 'B' },
                    { letter: 'C', eng: q.que_option_3_eng, hindi: q.que_option_3_hindi, isCorrect: q.que_correct_option === 'C' },
                    { letter: 'D', eng: q.que_option_4_eng, hindi: q.que_option_4_hindi, isCorrect: q.que_correct_option === 'D' }
                ];

                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="question-text flex-grow-1">
                            <strong>${number}. ${questionText.join(' / ')}</strong>
                        </div>
                        <button type="button" class="btn btn-outline-danger btn-sm delete-question ms-2" data-id="${q.que_id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="options-container mb-3">
                        <div class="row">
                            ${options.map(option => `
                                <div class="col-md-6 mb-2">
                                    <div class="option-item p-2 bg-white rounded ${option.isCorrect ? 'border border-success' : ''}">
                                        <span class="fw-bold ${option.isCorrect ? 'text-success' : ''}">${option.letter}.</span>
                                        <div class="option-content">
                                            ${option.eng ? `<div class="english-option">${option.eng}</div>` : ''}
                                            ${option.hindi ? `<div class="hindi-option text-muted small">${option.hindi}</div>` : ''}
                                        </div>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    
                    <div class="correct-answer mt-3 pt-2 border-top">
                        <span class="badge bg-success me-2">Correct Answer: ${q.que_correct_option}</span>
                        <span class="badge bg-info">Weightage: ${q.que_weightage || '0'} marks</span>
                    </div>
                `;
                
                return div;
            }

            // File upload functionality
            const uploadArea = document.getElementById('uploadArea');
            const fileInput = document.getElementById('fileInput');
            const browseFilesBtn = document.getElementById('browseFilesBtn');
            const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
            const selectedFileContainer = document.getElementById('selectedFileContainer');
            const selectedFileName = document.getElementById('selectedFileName');
            
            let selectedFile = null;

            browseFilesBtn.addEventListener('click', () => fileInput.click());
            
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    selectedFile = this.files[0];
                    selectedFileName.textContent = selectedFile.name;
                    selectedFileContainer.style.display = 'block';
                    uploadSubmitBtn.disabled = false;
                }
            });

            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('bg-light', 'border-primary');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('bg-light', 'border-primary');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('bg-light', 'border-primary');
                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            });

            uploadSubmitBtn.addEventListener('click', function() {
                if (!selectedFile) return;
                
                const formData = new FormData();
                formData.append('file', selectedFile);
                formData.append('cat_id', currentCategoryId);
                
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';
                
                fetch(`${BASE_URL}/api/v1/organiser/push_question.php`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    this.disabled = false;
                    this.innerHTML = 'Upload & Submit';
                    
                    if (data.error_code === 200) {
                        // Show success toast
                        const toast = new bootstrap.Toast(document.getElementById('successToast'));
                        document.querySelector('.toast-body').textContent = 'Questions uploaded successfully!';
                        toast.show();
                        
                        // Reset form
                        resetUploadForm();
                        
                        // Close modal and reload questions
                        const uploadModal = bootstrap.Modal.getInstance(document.getElementById('uploadQuestionsModal'));
                        uploadModal.hide();
                        
                        loadQuestionsForCategory(currentCategoryId);
                    } else {
                        alert('Upload failed: ' + (data.message || 'Unknown error'));
                    }
                })
                .catch(error => {
                    this.disabled = false;
                    this.innerHTML = 'Upload & Submit';
                    alert('Upload failed: ' + error.message);
                });
            });

            function resetUploadForm() {
                selectedFile = null;
                selectedFileContainer.style.display = 'none';
                uploadSubmitBtn.disabled = true;
                fileInput.value = '';
            }

            // Search functionality
            document.getElementById('questionSearch').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                if (!searchTerm) {
                    displayQuestions(currentQuestions);
                    return;
                }
                
                const filtered = currentQuestions.filter(q => 
                    (q.que_discreption_eng && q.que_discreption_eng.toLowerCase().includes(searchTerm)) ||
                    (q.que_discreption_hindi && q.que_discreption_hindi.toLowerCase().includes(searchTerm)) ||
                    (q.que_option_1_eng && q.que_option_1_eng.toLowerCase().includes(searchTerm)) ||
                    (q.que_option_2_eng && q.que_option_2_eng.toLowerCase().includes(searchTerm)) ||
                    (q.que_option_3_eng && q.que_option_3_eng.toLowerCase().includes(searchTerm)) ||
                    (q.que_option_4_eng && q.que_option_4_eng.toLowerCase().includes(searchTerm))
                );
                
                displayQuestions(filtered);
            });

            // Delete question function
            function deleteQuestion(questionId, categoryId) {
                if (!confirm('Are you sure you want to delete this question?')) {
                    return;
                }

                const deleteBtn = document.querySelector(`.delete-question[data-id="${questionId}"]`);
                const originalContent = deleteBtn.innerHTML;
                
                deleteBtn.disabled = true;
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                const formData = new FormData();
                formData.append('que_id', questionId);
                formData.append('cat_id', categoryId);

                fetch(`${BASE_URL}/api/v1/organiser/delete_question.php`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error_code === 200) {
                        currentQuestions = currentQuestions.filter(q => q.que_id != questionId);
                        
                        const questionElement = deleteBtn.closest('.question-item');
                        questionElement.style.opacity = '0';
                        questionElement.style.transition = 'opacity 0.3s ease';
                        
                        setTimeout(() => {
                            questionElement.remove();
                            
                            if (currentQuestions.length === 0) {
                                showNoQuestions();
                            }
                            
                            showToast('Question deleted successfully!', 'success');
                        }, 300);
                        
                    } else {
                        throw new Error(data.message || 'Failed to delete question');
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    deleteBtn.disabled = false;
                    deleteBtn.innerHTML = originalContent;
                    alert('Failed to delete question: ' + error.message);
                });
            }

            // Toast notification function
            function showToast(message, type = 'success') {
                let toastContainer = document.querySelector('.toast-container');
                if (!toastContainer) {
                    toastContainer = document.createElement('div');
                    toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
                    document.body.appendChild(toastContainer);
                }

                const toastId = 'toast-' + Date.now();
                const bgClass = type === 'success' ? 'bg-success' : 'bg-danger';
                
                const toastHtml = `
                    <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header ${bgClass} text-white">
                            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                            <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            ${message}
                        </div>
                    </div>
                `;
                
                toastContainer.insertAdjacentHTML('beforeend', toastHtml);
                
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement);
                toast.show();
                
                toastElement.addEventListener('hidden.bs.toast', () => {
                    toastElement.remove();
                });
            }

            // Update the delete button event listener
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-question')) {
                    const deleteBtn = e.target.closest('.delete-question');
                    const questionId = deleteBtn.getAttribute('data-id');
                    
                    if (currentCategoryId) {
                        deleteQuestion(questionId, currentCategoryId);
                    } else {
                        alert('Error: Category ID not found');
                    }
                }
            });

            document.getElementById('uploadQuestionsModal').addEventListener('hidden.bs.modal', resetUploadForm);
        });

        // Auto-open modals based on URL parameters
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const action = urlParams.get('action');
            
            if (action === 'create_category') {
                const addCategoryModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
                addCategoryModal.show();
                
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
            
            if (action === 'upload_questions') {
                const firstMCQCategory = document.querySelector('.competition-card .action-icon[title="Upload MCQ"]');
                if (firstMCQCategory) {
                    firstMCQCategory.click();
                } else {
                    alert('No MCQ categories found. Please create a category first.');
                }
                
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        });

        // Initialize calculations when modal opens
        document.getElementById('addCategoryModal').addEventListener('shown.bs.modal', function() {
            const categoryType = document.getElementById('cat_type').value;
            if (categoryType === '1') {
                calculateMCQFields();
            }
        });

    </script>
</body>
</html>