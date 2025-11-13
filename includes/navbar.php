<!-- navbar.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid px-1">
    <a class="navbar-brand fw-bold d-flex align-items-start" href="./">
      <img src="./assets/images/mp_logo.png" alt="MP Logo">
      <div class="ms-2" style="line-height: 1;">
        <div style="color:#fff; font-weight:bold; font-size:18px; line-height:1; margin-bottom: 0;">
          <?= $event_title ?> 
        </div>
        <span style="color: #fffdd0; font-size:12px; font-weight:bold; line-height:1;">
          <?= $event_subtitle ?>
        </span>
        <div class="navbar-subtitle" style="line-height: 1.1; margin-top: 2px; color:rgb(255, 253, 208)">
          नागरिक सांस्कृतिक महोत्सव • संस्कृति संचालनालय • <br class="d-lg-none"> मध्यप्रदेश शासन 
        </div>
      </div>
    </a>

    <div class="d-flex align-items-center ms-auto">
      <div class="d-lg-none me-2">
        <img src="./assets/images/aivc_logo.png" alt="अतिरिक्त लोगो" style="height:40px; width:auto;filter: brightness(0) invert(1);">
      </div>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="टॉगल नेविगेशन">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <div class="navbar-nav mx-auto">
        <div class="nav-item">
          <span class="nav-link fw-bold text-center" style="color: #fffdd0; font-size: 1.5rem; white-space: nowrap;">
            ॐ गीता जयंती महोत्सव
          </span>
        </div>
      </div>

      <div class="d-flex align-items-center">

        <div class="dropdown d-none d-lg-inline ms-3">
          <button class="btn btn-success btn-sm dropdown-toggle fw-bold text-white study-material-dropdown" 
                  type="button" id="studyMaterialDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-book me-2"></i> अध्ययन सामग्री
          </button>
          <ul class="dropdown-menu" aria-labelledby="studyMaterialDropdown">
            <li>
              <a class="dropdown-item" href="#" 
                onclick="openPdfModal('./assets/pdf/hindi_bhagvatgeeta.pdf', 'श्रीमद्भगवद्गीता - हिंदी')">
                <i class="fas fa-file-pdf text-danger"></i> हिंदी अध्ययन सामग्री
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#" 
                onclick="openPdfModal('./assets/pdf/english_bhagvatgeeta.pdf', 'Shrimad Bhagavad Gita - English')">
                <i class="fas fa-file-pdf text-danger"></i> अंग्रेज़ी अध्ययन सामग्री
              </a>
            </li>
          </ul>
        </div>

        <a href="#" class="btn btn-info btn-sm fw-bold text-white ms-2 d-none d-lg-inline" data-bs-toggle="modal" data-bs-target="#faqModal">
          <i class="fas fa-question-circle me-2"></i> सामान्य प्रश्न (FAQ)
        </a>

        <div class="dropdown d-none d-lg-inline ms-3">
          <button class="btn btn-warning btn-sm dropdown-toggle fw-bold text-white" type="button" id="loginDropdownDesktop" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-id-badge me-2"></i> लॉगिन
          </button>
          <ul class="dropdown-menu" aria-labelledby="loginDropdownDesktop">
            <!-- <li><a class="dropdown-item gradient-organizer" href="admin_login.php"><i class="fas fa-user-tie me-2"></i> आयोजक</a></li> -->
            <li><a class="dropdown-item gradient-participant" href="https://web.geetamahotsav.com/login"><i class="fas fa-user me-2"></i> प्रतिभागी</a></li>
          </ul>
        </div>

        <div class="ms-3 d-none d-lg-inline">
          <img src="./assets/images/aivc_logo.png" alt="अतिरिक्त लोगो"
              style="height:65px; width:auto; filter: brightness(0) invert(1);">
        </div>
      </div>

      <div class="d-lg-none mt-3 text-center">
        <div class="d-flex justify-content-center gap-2 flex-wrap">

          <div class="dropdown d-lg-none">
            <button class="btn btn-success btn-sm dropdown-toggle fw-bold text-white px-3 py-1 study-material-dropdown" 
                    type="button" id="studyMaterialDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false" 
                    style="font-size: 13px; border-radius: 6px;">
              <i class="fas fa-book me-2"></i> अध्ययन सामग्री
            </button>
            <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="studyMaterialDropdownMobile">
              <li>
                <a class="dropdown-item" href="#" 
                  onclick="openPdfModal('./assets/pdf/hindi_bhagvatgeeta.pdf', 'श्रीमद्भगवद्गीता - हिंदी')">
                  <i class="fas fa-file-pdf text-danger"></i> हिंदी अध्ययन सामग्री
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" 
                  onclick="openPdfModal('./assets/pdf/english_bhagvatgeeta.pdf', 'Shrimad Bhagavad Gita - English')">
                  <i class="fas fa-file-pdf text-danger"></i> अंग्रेज़ी अध्ययन सामग्री
                </a>
              </li>
            </ul>
          </div>

          <a href="#" class="btn btn-info btn-sm fw-bold text-white px-3 py-1" 
            style="font-size: 13px; border-radius: 6px;" data-bs-toggle="modal" data-bs-target="#faqModal">
            <i class="fas fa-question-circle me-2"></i> सामान्य प्रश्न FAQ
          </a>

        </div>
      </div>

      <div class="dropdown d-lg-none mt-3 text-center">
        <button class="btn btn-warning btn-sm dropdown-toggle fw-bold text-white px-3 py-1" 
                type="button" id="loginDropdownMobile" data-bs-toggle="dropdown" aria-expanded="false" 
                style="font-size: 13px; border-radius: 6px;">
          <i class="fas fa-id-badge me-2"></i> लॉगिन
        </button>
        <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="loginDropdownMobile">
          <!-- <li><a class="dropdown-item gradient-organizer" href="admin_login.php"><i class="fas fa-user-tie me-2"></i> आयोजक</a></li> -->
          <li><a class="dropdown-item gradient-participant" href="https://yellow-island-04d8bb200.3.azurestaticapps.net/login"><i class="fas fa-user me-2"></i> प्रतिभागी</a></li>
        </ul>
      </div>

    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
