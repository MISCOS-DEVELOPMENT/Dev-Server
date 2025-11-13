<?php
  $event_title = "अभ्युदय मध्यप्रदेश";
  $event_subtitle = "विरासत भी ! विकास भी !";
  $event_date = "17 अक्टूबर - 1 नवंबर";
  $event_location = "भोपाल, मध्य प्रदेश";
  $chief_minister = "श्री मोहन यादव";
  $base_url = "https://dev-geeta-landing-page-bxgratg2esh0bjef.canadacentral-01.azurewebsites.net";
?>

<!DOCTYPE html>
<html lang="hi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $event_title ?> - गीता महोत्सव</title>
  <link rel="icon" type="image/png" href="./assets/images/mp_logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="./assets/css/style_for_dashboard.css">
<!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-W5QMDZJ9');</script>
  <!-- End Google Tag Manager -->
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W5QMDZJ9"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <?php include './includes/navbar.php'; ?>
  <div class="registration-notice">
      <div class="decoration decoration-1"></div>
      <div class="decoration decoration-2"></div>

      <div class="floating-icons">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
      </div>

      <span class="notice-header">📢 सूचना:</span>
      <span class="notice-text">पंजीकरण प्रक्रिया शुरु हो चुकी है!</span>

      <div style="font-size:12px; color:#444; text-align:center; margin-top:2px; line-height:1.4;">
          <p style="margin:1px 0;">
              🗓️ <strong>पंजीकरण की अंतिम तारीख:</strong> <span style="color:#b71c1c;">15 नवम्बर 2025</span>
          </p>
          <p style="margin:1px 0;">
              🎯 <strong>मॉक टेस्ट:</strong> आप 13 नवम्बर 2025 को अपने लॉगिन से अभ्यास परीक्षण में शामिल हो सकते हैं।
          </p>
      </div>

      <div class="progress-bar">
          <div class="progress"></div>
      </div>
  </div>

  <div class="container-fluid mt-4">
    <div class="row align-items-center g-0">

      <!-- Left Section -->
      <div class="col-md-6 mb-4">
        <div class="event-info">
          <div style="flex: 0 0 auto;">
            <img src="./assets/images/veer_bharat.png" alt="Veer Bharat">
          </div>

          <div style="flex: 1; text-align: center; padding: 0 10px;">
            <h2 style="color:#8B0100; font-weight:bold;"><?= $event_title ?></h2>
            <p style="color:#333;"><?= $event_subtitle ?></p>
          </div>

          <div style="flex: 0 0 auto;">
            <img src="./assets/images/yuva.png" alt="Yuva Icon">
          </div>
        </div>

        <p style="color:#333; font-size:15px; line-height:1.6;">
          अभ्युदय मध्यप्रदेश, विरासत भी विकास भी..... अंतर्गत मध्यप्रदेश के नागरिकों की प्रतिभा, नेतृत्व तथा सांस्कृतिक चेतना को प्रोत्साहित करने के उद्देश्य से विभिन्न विषयों यथा संस्कृति, जनजातीय संस्कृति, ज्ञान-विज्ञान, कृषि सभ्यता, जल गंगा संवर्धन, स्वदेशी, वन, खेल आदि पर केंद्रित प्रतियोगिताओं का आयोजन किया जाना प्रस्तावित है।
        </p>

        <div class="gita-banner mt-3 mb-3 p-3" 
            style="background:linear-gradient(90deg, #fffaf2, #ffe8cc);
                    border-radius:12px; 
                    display:flex; 
                    align-items:center; 
                    box-shadow:0 4px 12px rgba(0,0,0,0.1);
                    border-left:6px solid #8B0100;">
          <div class="gita-icon" style="font-size:40px; margin-right:15px;">📜</div>
          <div class="gita-text">
            <h5 style="color:#8B0100; font-weight:bold; margin-bottom:5px;">"श्रीमद्भगवद्गीता  — जीवन का सार"</h5>
            <p style="margin:0; color:#333;">गीता का प्रत्येक श्लोक मानव जीवन के हर पक्ष में ज्ञान, कर्तव्य और आत्मबल का मार्ग दिखाता है।</p>
          </div>
        </div>
        <p style="background:linear-gradient(90deg, #fff0d9, #fffaf2);
                  border-left:4px solid #8B0100;
                  border-radius:8px;
                  box-shadow:0 2px 5px rgba(0,0,0,0.08);
                  padding:6px 12px;
                  text-align:center;
                  font-size:14px;
                  color:#333;
                  margin-bottom:10px;">
          <span style="color:#8B0100; font-weight:bold; margin-right:10px;">📅 महत्वपूर्ण तिथियाँ:</span>
          📝 <b>पंजीकरण:</b> 7–15 नवम्बर |
          🧭 <b>परीक्षा:</b> 16–25 नवम्बर
        </p>


        <div class="text-center mb-3">
          <button class="btn btn-orange-outline btn-sm m-1" 
                  onclick="window.location.href='https://web.geetamahotsav.com/register'">
            🪶 पंजीकरण करें
          </button>
          <!-- <button class="btn btn-orange-outline btn-sm m-1" 
                  data-bs-toggle="modal" data-bs-target="#pdfModal">
            📖 गीता महोत्सव के बारे में
          </button> -->
          <button class="btn btn-orange-outline btn-sm m-1" 
                  data-bs-toggle="modal" data-bs-target="#awardsModal">
            🏆 गीता महोत्सव के पुरस्कार
          </button>
        </div>

        <div class="row text-center">
          <div class="col-12 col-sm-4 mb-2">
            <div class="stats-box">
              <span style="color:#8B0100; font-weight:bold;">10,00,000+</span><br>अपेक्षित प्रतिभागी
            </div>
          </div>
          <div class="col-12 col-sm-4 mb-2">
            <div class="stats-box">
              <span style="color:#8B0100; font-weight:bold;">8</span><br>विषय श्रेणियाँ
            </div>
          </div>
          <div class="col-12 col-sm-4 mb-2">
            <div class="stats-box">
              <span style="color:#8B0100; font-weight:bold;">70</span><br>पुरस्कार
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-6 mb-4 d-flex justify-content-end pe-0">
        <div style="border-radius:12px; padding:5px; max-width:500px; text-align:center; box-shadow:0 4px 10px rgba(0,0,0,0.2); background-color:#fff;">
          <img src="./assets/images/geeta_shlok.jpg" alt="गीता जयंती महोत्सव" class="img-fluid rounded shadow">
          <h4 style="margin-top:15px; color:#8B0100;">गीता जयंती महोत्सव</h4>
          <p style="margin-bottom: 10px; color:#333;">
            प्रथम चरण में गीता जयंती के अवसर पर लाल परेड मैदान में 1 दिसंबर 2025 को 11000 नागरिकों की उपस्थिति में श्रीमद्भगवद्गीता के अध्याय 15 के 20 श्लोकों का कण्ठस्थ पाठ किया जाएगा।
          </p>
        </div>
      </div>

    </div>
  </div>


<!-- PDF Modal -->
<div class="modal fade pdf-modal" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header" style="background:#8B0100; color:#fff; display:flex; justify-content:space-between; align-items:center;">
        <h5 class="modal-title" id="pdfModalLabel">अध्ययन सामग्री</h5>
        <div class="d-flex align-items-center">
          <button id="downloadPdfBtn" class="btn btn-light btn-sm me-2" style="font-weight:600; border-radius:20px; display:flex; align-items:center; gap:6px;">
            <i class="fas fa-download"></i> डाउनलोड
          </button>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <div class="modal-body" style="height:85vh; overflow-y:auto; background:#f8f9fa;">
        <div id="pdfContainer" style="display:flex; flex-direction:column; align-items:center; gap:20px;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Awards Modal -->
<div class="modal fade awards-modal" id="awardsModal" tabindex="-1" aria-labelledby="awardsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="awardsModalLabel">गीता जयंती महोत्सव के पुरस्कार</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center" 
           style="background: url('./assets/images/award_bg.png') no-repeat center center;
                  background-size: cover;
                  background-attachment: fixed;">

        <h5 style="color:#8B0100; font-weight:bold; margin-bottom:15px;">
          मध्यप्रदेश की स्थापना के 70 वें वर्ष में 70 पुरस्कार
        </h5>

        <div class="row justify-content-center">
          <div class="col-md-4 col-sm-6 mb-2">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #33cc33, #66ff66);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-title">
                <span style="color:#8B0100; font-weight:bold;">₹ 1.00 लाख</span><br>
                <small>प्रथम पुरस्कार</small>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 mb-2">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #3366cc, #6699ff);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-content">
                <div class="award-title">
                  <span style="color:#8B0100; font-weight:bold;">₹ 51 हजार</span><br>
                  <small> द्वितीय पुरस्कार</small>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 mb-2">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #cc3366, #ff6699);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-content">
                <div class="award-title">
                  <span style="color:#8B0100; font-weight:bold;">₹ 31 हजार</span><br>
                  <small>तृतीय पुरस्कार (तीन)</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-md-4 col-sm-6 mb-2">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #cc9933, #ffcc66);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-content">
                <div class="award-title"><span style="color:#8B0100; font-weight:bold;">15 लैपटॉप</span></div>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6 mb-2">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #9933cc, #cc66ff);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-content">
                <div class="award-title"><span style="color:#8B0100; font-weight:bold;">30 ई-बाइक</span></div>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-sm-6">
            <div class="award-item">
              <div class="award-icon" style="background: linear-gradient(135deg, #9933cc, #cc66ff);">
                <img src="./assets/images/peacock.webp" width="30" class="me-1" alt="">
              </div>
              <div class="award-content">
                <div class="award-title"><span style="color:#8B0100; font-weight:bold;">20 ई-रिक्शा</span></div>
              </div>
            </div>
          </div>
        </div>

        <div style="font-size:18px; color:#8B0100; font-weight:bold;">अथवा</div>

        <div class="p-2 mt-2 mx-auto text-center" 
             style="font-size:16px; max-width:500px; background:linear-gradient(90deg, #fffaf2, #fff0d9);
                    border-left:4px solid #8B0100; border-radius:8px;">
          <strong>11–25 वर्ष</strong> तक के विद्यार्थियों को <strong>2 वर्ष तक शिक्षावृत्ती</strong>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Geeta Video + Shlok Section -->
<div class="container-fluid py-5">
  <div class="container">

    <div class="text-center mb-4">
      <h3 class="section-title" style="color:#8B0100; font-weight:bold; margin-bottom:8px;">
        श्रीमद्भगवद्गीता के श्लोक
      </h3>
      <p class="shloks-subtitle" style="color:#555; font-size:14px;">
        जीवन में मार्गदर्शन प्रदान करने वाले श्लोक
      </p>
    </div>

    <div class="row align-items-stretch">
      
      <div class="col-md-6 mb-4 mb-md-0 d-flex">
        <div class="video-container w-100 d-flex align-items-center">
          <div class="video-wrapper w-100" style="height:100%;">
            <video id="geetaVideo" autoplay muted loop playsinline class="w-100 h-100" style="border-radius:10px; object-fit:cover;">
              <source src="./assets/videos/geeta_video.mp4" type="video/mp4">
              आपका ब्राउज़र वीडियो तत्व का समर्थन नहीं करता है।
            </video>
          </div>
        </div>
      </div>

      <div class="col-md-6 d-flex">
        <div class="shloks-slider-container w-100 d-flex flex-column justify-content-center" style="height:100%;">
          <div class="background-image"></div>
          <div class="shloks-content">
            <div class="shloks-slider" id="shloksSlider">
            </div>
            <div class="shloks-indicators">
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Sponsors Section -->
<div class="container-fluid sponsors-section py-5">
    <div class="sponsors-slider-container">
        <div class="sponsors-slider" id="sponsorsSlider">
            <!-- Sponsors will be dynamically inserted here -->
        </div>
    </div>
</div>


<!-- Minister Sections -->
<div class="container-fluid my-5" id="minister-message">
  <!-- Chief Minister Section -->
  <div class="container-fluid">
    <h4 class="section-title text-center mt-2 mb-2">
      माननीय मुख्यमंत्रीजी का संदेश
    </h4>
    <h5 class="text-center text-warning fw-bold mb-4">
      <?= $chief_minister ?>
    </h5>

    <div class="minister-card">
      <div class="row align-items-center">
        <div class="col-md-4 text-center mb-1 mb-md-0">
          <div class="minister-img-container">
            <img src="./assets/images/cm_mp.png" alt="मुख्यमंत्री फोटो" class="minister-img">
            <div class="minister-title">मुख्यमंत्री</div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="minister-content">
            <p class="text-center mb-0" style="color:#333; line-height:1.5;">
              मध्य प्रदेश स्थापना दिवस के अवसर पर, मैं अपने राज्य के सभी नागरिकों को हार्दिक बधाई देता हूँ। आप मध्य प्रदेश की शक्ति और भविष्य हैं - आपकी ऊर्जा, नवाचार और समर्पण प्रगति और गौरव के एक नए युग का निर्माण करेंगे। आइए, हम सब मिलकर एक समृद्ध, आत्मनिर्भर और जीवंत मध्य प्रदेश का निर्माण करें।
            </p>
            <p class="text-center mt-3 mb-0 fw-bold" style="color:#333; line-height:1.5;">
              जय हिंद! जय मध्य प्रदेश!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- State Minister Section -->
  <div class="container-fluid">
    <h4 class="section-title text-center mt-2 mb-2">
      माननीय राज्य मंत्री (स्वतंत्र प्रभार) का संदेश
    </h4>
    <h5 class="text-center text-warning fw-bold mb-4">
      श्री धर्मेंन्द्र सिंह लोधी
    </h5>

    <div class="minister-card">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="minister-content">
            <p class="text-center mb-0" style="color:#333; line-height:1.5;">
              संस्कृति | पर्यटन | धार्मिक न्यास एवं धर्मस्व<br>
              मध्य प्रदेश सरकार<br><br>
              
              मध्य प्रदेश स्थापना दिवस के गौरवशाली अवसर पर, मैं अपने राज्य के जीवंत नागरिकों को हार्दिक बधाई देता हूँ। आप हमारी समृद्ध सांस्कृतिक विरासत के पथप्रदर्शक और एक नए, आत्मविश्वासी और प्रगतिशील मध्य प्रदेश की प्रेरक शक्ति हैं। आइए, हम अपनी पहचान का गौरवपूर्वक जश्न मनाएँ और अपने राज्य को पूरे देश के लिए संस्कृति, पर्यटन और विकास का प्रतीक बनाने के लिए मिलकर काम करें।
            </p>
            <p class="text-center mt-3 mb-0 fw-bold" style="color:#333; line-height:1.5;">
              जय हिंद! जय मध्य प्रदेश!
            </p>
          </div>
        </div>
        
        <div class="col-md-4 text-center mb-1 mb-md-0">
          <div class="minister-img-container">
            <img src="./assets/images/sanskruti_cm_mp.jpg" alt="माननीय राज्य मंत्री फोटो" class="minister-img">
            <div class="minister-title">राज्य मंत्री</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Secretary Section -->
  <div class="container-fluid">
    <h4 class="section-title text-center mt-2 mb-2">
      सांस्कृतिक विभाग के सचिव प्रमुख का संदेश
    </h4>
    <h5 class="text-center text-warning fw-bold mb-4">
      श्री शिव शेखर शुक्ला
    </h5>

    <div class="minister-card">
      <div class="row align-items-center">
        <div class="col-md-4 text-center mb-1 mb-md-0">
          <div class="minister-img-container">
            <img src="./assets/images/sachiv.jpg" alt="सचिव फोटो" class="minister-img">
            <div class="minister-title">सचिव प्रमुख</div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="minister-content">
            <p class="text-center mb-0" style="color:#333; line-height:1.5;">
              सचिव प्रमुख, संस्कृति विभाग<br>
              ट्रस्टी सचिव, भारत भवन एवं सचिव, म.प्र. संस्कृति परिषद<br><br>
              
              मध्य प्रदेश स्थापना दिवस के शुभ अवसर पर, मैं हमारे राज्य के सभी नागरिकों को हार्दिक शुभकामनाएं देता हूं। मध्य प्रदेश की सांस्कृतिक और रचनात्मक भावना आपकी ऊर्जा, विचारों और उत्साह से पनपती है। मैं प्रत्येक नागरिक नागरिक से आग्रह करता हूं कि वे हमारी गौरवशाली विरासत से प्रेरणा लें और सांस्कृतिक रूप से जीवंत और प्रगतिशील मध्य प्रदेश के निर्माण में योगदान दें।
            </p>
            <p class="text-center mt-3 mb-0 fw-bold" style="color:#333; line-height:1.5;">
              जय हिंद! जय मध्य प्रदेश!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Director Section -->
  <div class="container-fluid">
    <h4 class="section-title text-center mt-2 mb-2">
      सांस्कृतिक विभाग के निदेशक का संदेश
    </h4>
    <h5 class="text-center text-warning fw-bold mb-4">
      श्री एन.पी. नामदेव
    </h5>

    <div class="minister-card">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="minister-content">
            <p class="text-center mb-0" style="color:#333; line-height:1.5;">
              संचालक, संस्कृति संचालनालय<br>
              संयुक्त सचिव, म.प्र. संस्कृति परिषद<br><br>
              
              मध्य प्रदेश स्थापना दिवस के अवसर पर, मैं अपने राज्य के सभी नागरिकों को हार्दिक बधाई देता हूँ। नागरिक एक प्रगतिशील समाज की नींव और हमारी समृद्ध सांस्कृतिक विरासत के सच्चे वाहक हैं। आइए, इस दिन को गर्व के साथ मनाएँ और एक सांस्कृतिक रूप से समृद्ध और समृद्ध मध्य प्रदेश के निर्माण में अपनी रचनात्मकता, प्रतिबद्धता और ऊर्जा का योगदान देने का संकल्प लें।
            </p>
            <p class="text-center mt-3 mb-0 fw-bold" style="color:#333; line-height:1.5;">
              जय हिंद! जय मध्य प्रदेश!
            </p>
          </div>
        </div>
        
        <div class="col-md-4 text-center mb-1 mb-md-0">
          <div class="minister-img-container">
            <img src="./assets/images/sanchalak.jpg" alt="संचालक फोटो" class="minister-img">
            <div class="minister-title">संचालक</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Culture Advisor Section -->
  <div class="container-fluid">
    <h4 class="section-title text-center mt-2 mb-2">
      संस्कृति सलाहकार का संदेश
    </h4>
    <h5 class="text-center text-warning fw-bold mb-4">
      श्रीराम तिवारी
    </h5>

    <div class="minister-card">
      <div class="row align-items-center">
        <div class="col-md-4 text-center mb-1 mb-md-0">
          <div class="minister-img-container">
            <img src="./assets/images/veer_bharat_vyas.png" alt="संस्कृति सलाहकार फोटो" class="minister-img">
            <div class="minister-title">संस्कृति सलाहकार</div>
          </div>
        </div>

        <div class="col-md-8">
          <div class="minister-content">
            <p class="text-center mb-0" style="color:#333; line-height:1.5;">
              मध्य प्रदेश स्थापना दिवस के 70वें अवसर पर मैं प्रदेश के सभी नागरिकों को हार्दिक बधाई एवं शुभकामनाएँ प्रेषित करता हूँ। माननीय मुख्यमंत्री जी के नेतृत्व में मध्य प्रदेश विरासत से विकास की ओर अग्रसर है। प्रदेश का प्रत्येक नागरिक राज्य को समृद्ध और विकसित बनाने के उद्देश्य से अपना महत्वपूर्ण योगदान देने का संकल्प ले।
            </p>
            <p class="text-center mt-3 mb-0 fw-bold" style="color:#333; line-height:1.5;">
              संस्कृति सलाहकार, मुख्यमंत्री मध्य प्रदेश एवं न्यासी सचिव, वीर भारत व्यास<br>
              जय हिंद! जय मध्य प्रदेश!
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>


<!-- Organization Partners Section -->
<div class="container-fluid my-5" id="organization-partners">
  <div class="container">
    <h4 class="section-title text-center mb-4" style="color:#8B0100;font-weight:bold;">
      हमारे सहयोगी संगठन
    </h4>
    <p class="text-center mb-5">
      गीता महोत्सव को सफल बनाने में इन संगठनों का महत्वपूर्ण योगदान है
    </p>

    <!-- गीता परिवार -->
    <div class="container-fluid">
      <div class="minister-card">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-1 mb-md-0">
            <div class="minister-img-container" style="display:inline-block; position:relative;">
              <img src="./assets/images/geeta_parivar_logo.png" alt="गीता परिवार"
                   style="width:160px; height:160px; object-fit:cover; border-radius:50%; border:4px solid #fff5a9; box-shadow:0 2px 8px rgba(0,0,0,0.15);">
              <div style="text-align:center; font-weight:bold; color:#000; margin-top:8px; font-size:14px;">
                गीता परिवार
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="minister-content">
              <p class="text-center mb-0" style="color:#333; line-height:1.5;">
                गीता परिवार एक आध्यात्मिक संगठन है जो श्रीमद्भगवद्गीता के ज्ञान को जन-जन तक पहुँचाने के लिए समर्पित है। 
                संस्था गीता के शाश्वत संदेशों को आधुनिक संदर्भ में प्रस्तुत करके लोगों के जीवन में सकारात्मक परिवर्तन लाने का कार्य करती है।
                गीता परिवार नियमित सत्संग, गीता ज्ञान यज्ञ, युवा संवाद और आध्यात्मिक शिविरों के माध्यम से समाज के विभिन्न वर्गों तक गीता का संदेश पहुँचाता है।
              </p>
              <p class="text-center mt-1 mb-0 fw-bold" style="color:#333;">
                "गीता ज्ञान - जीवन का आधार"
              </p>
              <div class="text-center mt-1">
                <button class="btn btn-sm" 
                        style="background-color:transparent;color:#000;border:2px solid #fff5a9;border-radius:5px;font-weight:500;"
                        onmouseover="this.style.backgroundColor='#fff5a9'; this.style.color='#000';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#000';"
                        onclick="window.open('https://www.learngeeta.com/', '_blank')">
                  और जानें
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- इस्कॉन -->
    <div class="container-fluid mt-4">
      <div class="minister-card">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-1 mb-md-0">
            <div class="minister-img-container" style="display:inline-block; position:relative;">
              <img src="./assets/images/iskcon_logo.png" alt="इस्कॉन"
                   style="width:160px; height:160px; object-fit:cover; border-radius:50%; border:4px solid #617ea4; box-shadow:0 2px 8px rgba(0,0,0,0.15);">
              <div style="text-align:center; font-weight:bold; color:#617ea4; margin-top:8px; font-size:14px;">
                इस्कॉन
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="minister-content">
              <p class="text-center mb-0" style="color:#333; line-height:1.5;">
                इस्कॉन (अंतर्राष्ट्रीय कृष्ण भावनामृत संघ) की स्थापना 1966 में ए.सी. भक्तिवेदांत स्वामी प्रभुपाद जी ने की थी।
                यह संगठन भगवान कृष्ण की भक्ति के प्रसार के लिए समर्पित है और विश्वभर में 600 से अधिक केंद्रों के माध्यम से कार्यरत है।
                इस्कॉन ने श्रीमद्भगवद्गीता जैसे प्राचीन ग्रंथों का 80 से अधिक भाषाओं में अनुवाद किया है और हरे कृष्ण महामंत्र के माध्यम से लाखों लोगों को आध्यात्मिक शांति प्रदान की है।
              </p>
              <p class="text-center mt-1 mb-0 fw-bold" style="color:#333;">
                "सरल जीवन, उच्च विचार"
              </p>
              <div class="text-center mt-1">
                <button class="btn btn-sm"
                        style="background-color:transparent;color:#617ea4;border:2px solid #617ea4;border-radius:5px;font-weight:500;"
                        onmouseover="this.style.backgroundColor='#617ea4'; this.style.color='#fff';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#617ea4';"
                        onclick="window.open('https://iskcon.org', '_blank')">
                  और जानें
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- विश्वगीताप्रतिष्ठानम् -->
    <div class="container-fluid mt-4">
      <div class="minister-card">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-1 mb-md-0">
            <div class="minister-img-container" style="display:inline-block; position:relative;">
              <img src="./assets/images/vishva_geeta_paristhanam_logo.jpeg" alt="विश्वगीताप्रतिष्ठानम्"
                   style="width:160px; height:160px; object-fit:cover; border-radius:50%; border:4px solid #fb3c1f; box-shadow:0 2px 8px rgba(0,0,0,0.15);">
              <div style="text-align:center; font-weight:bold; color:#fb3c1f; margin-top:8px; font-size:14px;">
                विश्वगीताप्रतिष्ठानम्
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="minister-content">
              <p class="text-center mb-0" style="color:#333; line-height:1.5;">
                विश्वगीताप्रतिष्ठानम् एक गैर-लाभकारी संगठन है जो श्रीमद्भगवद्गीता के संदेश को वैश्विक स्तर पर प्रसारित करने के लिए समर्पित है।
                संस्था गीता के मूल्यों, नैतिक शिक्षाओं और आध्यात्मिक सिद्धांतों को शैक्षणिक संस्थानों, युवा मंचों और सामाजिक कार्यक्रमों के माध्यम से फैलाने का कार्य करती है।
                विश्वगीताप्रतिष्ठानम् शोध कार्य, सेमिनार, वर्कशॉप और अंतर्राष्ट्रीय सम्मेलनों का आयोजन करके गीता के ज्ञान को समकालीन संदर्भ में प्रस्तुत करता है।
              </p>
              <p class="text-center mt-1 mb-0 fw-bold" style="color:#333;">
                "गीता ज्ञान - विश्व कल्याण का मार्ग"
              </p>
              <div class="text-center mt-1">
                <button class="btn btn-sm" 
                        style="background-color:transparent;color:#fb3c1f;border:2px solid #fb3c1f;border-radius:5px;font-weight:500;"
                        onmouseover="this.style.backgroundColor='#fb3c1f'; this.style.color='#fff';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#fb3c1f';"
                        onclick="window.open('https://www.vishwageeta.org/vishwageeta-pratisthanam/', '_blank')">
                  और जानें
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<div class="container-fluid my-5" id="programs-categories">
    <div class="card shadow-lg border-0 rounded-3 p-4" style="background:linear-gradient(to bottom, #fde5c0ff, #fff7f0);">
        
        <h4 class="section-title text-center" style="color:#8B0100;">
            कार्यक्रम और श्रेणियाँ
        </h4>
        <p class="text-center mb-4">
            गीता जयंती महोत्सव - विभिन्न आयु समूहों के लिए प्रतियोगिताएँ
        </p>

        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-4 mb-4">
                <div class="about-card p-3 h-100 d-flex flex-column align-items-center text-center" style="border-radius: 12px;">
                    <div class="icon-square mb-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #8B0100, #ff9933); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-child" style="color: white; font-size: 20px;"></i>
                    </div>
                    <h5 style="color:#000; font-weight:bold; font-size: 16px;">6-8 वर्ग</h5>
                    <p class="mb-3 flex-grow-1" style="font-size: 14px;">छोटे बच्चों के लिए गीता ज्ञान प्रतियोगिता</p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-orange-outline btn-sm" style="padding: 4px 12px; font-size: 12px;" onclick="window.location.href='https://web.geetamahotsav.com/login';">
                          भाग लें
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 mb-4">
                <div class="about-card p-3 h-100 d-flex flex-column align-items-center text-center" style="border-radius: 12px;">
                    <div class="icon-square mb-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #3366cc, #6699ff); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-graduate" style="color: white; font-size: 20px;"></i>
                    </div>
                    <h5 style="color:#000; font-weight:bold; font-size: 16px;">9-12 वर्ग </h5>
                    <p class="mb-3 flex-grow-1" style="font-size: 14px;">बड़े बच्चों के लिए गीता ज्ञान प्रतियोगिता</p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-orange-outline btn-sm" style="padding: 4px 12px; font-size: 12px;" onclick="window.location.href='https://web.geetamahotsav.com/login';">भाग लें</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 mb-4">
                <div class="about-card p-3 h-100 d-flex flex-column align-items-center text-center" style="border-radius: 12px;">
                    <div class="icon-square mb-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #33cc99, #66ffcc); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users" style="color: white; font-size: 20px;"></i>
                    </div>
                    <h5 style="color:#000; font-weight:bold; font-size: 16px;">सामान्य श्रेणी</h5>
                    <p class="mb-3 flex-grow-1" style="font-size: 14px;">सभी आयु वर्ग के लिए गीता ज्ञान प्रतियोगिता</p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-orange-outline btn-sm" style="padding: 4px 12px; font-size: 12px;" onclick="window.location.href='https://web.geetamahotsav.com/login';">भाग लें</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sandipani ashram Section -->
<div class="container-fluid my-5" id="sandipani-ashram">
  <div class="card shadow-lg border-0 rounded-3 p-4" style="background:linear-gradient(to bottom, #fde5c0ff, #fff7f0);">
    
    <h4 class="section-title text-center mb-4" style="color:#8B0100;">
      महर्षि सांदीपनि आश्रम
    </h4>
    <p class="text-center mb-4 px-2">
      उज्जैन स्थित वह पावन स्थल जहाँ भगवान श्रीकृष्ण, बलराम और सुदामा ने शिक्षा प्राप्त की
    </p>

    <div class="row align-items-center">
      <!-- Image Slider -->
      <div class="col-md-6 mb-4">
        <div class="ashram-slider-container">
          <div class="ashram-slider" id="ashramSlider"></div>
          <div class="ashram-slider-indicators text-center mt-3"></div>
        </div>
      </div>

      <!-- Content -->
      <div class="col-md-6 mb-4">
        <div class="ashram-content">
          <h5 class="fw-bold mb-3" style="color:#8B0100;">ऐतिहासिक और आध्यात्मिक महत्व</h5>
          <p style="color:#333; line-height: 1.6; text-align: justify;">
            महर्षि सांदीपनि आश्रम उज्जैन में स्थित एक प्राचीन गुरुकुल है जहाँ भगवान श्रीकृष्ण, उनके बड़े भाई बलराम और मित्र सुदामा ने शिक्षा प्राप्त की। 
            इस आश्रम का वर्णन विभिन्न पुराणों और ऐतिहासिक ग्रंथों में मिलता है। महर्षि सांदीपनि ने यहाँ अपने शिष्यों को न केवल शास्त्रों का ज्ञान दिया, 
            बल्कि धनुर्विद्या, राजनीति और नीतिशास्त्र की भी शिक्षा दी।
          </p>

          <div class="ashram-highlights mt-4">
            <div class="row text-center">
              <div class="col-4 mb-3">
                <div class="highlight-item">
                  <div class="highlight-icon gradient-red">
                    <i class="fas fa-book"></i>
                  </div>
                  <small class="fw-bold d-block">वैदिक शिक्षा</small>
                </div>
              </div>
              <div class="col-4 mb-3">
                <div class="highlight-item">
                  <div class="highlight-icon gradient-blue">
                    <i class="fas fa-crosshairs"></i>
                  </div>
                  <small class="fw-bold d-block">धनुर्विद्या</small>
                </div>
              </div>
              <div class="col-4 mb-3">
                <div class="highlight-item">
                  <div class="highlight-icon gradient-green">
                    <i class="fas fa-landmark"></i>
                  </div>
                  <small class="fw-bold d-block">राजनीति शास्त्र</small>
                </div>
              </div>
            </div>
          </div>

          <div class="text-center">
            <button class="btn btn-orange-outline me-2"
                    onclick="window.open('https://ujjain.nic.in/en/tourist-place/sandipani/', '_blank')">
              आश्रम के बारे में और जानें
            </button>
          </div>

        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-4 mb-3">
        <div class="info-card p-3 h-100 text-center">
          <div class="info-icon mb-2">🕉️</div>
          <h6>आध्यात्मिक महत्व</h6>
          <p class="small mb-0">यह स्थान भगवान कृष्ण की शिक्षा स्थली होने के कारण हिंदू धर्म में अत्यंत पवित्र माना जाता है।</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="info-card p-3 h-100 text-center">
          <div class="info-icon mb-2">📚</div>
          <h6>शिक्षा का केंद्र</h6>
          <p class="small mb-0">प्राचीन काल में यह आश्रम विद्या का प्रमुख केंद्र था जहाँ विभिन्न विषयों की शिक्षा दी जाती थी।</p>
        </div>
      </div>
      <div class="col-md-4 mb-3">
        <div class="info-card p-3 h-100 text-center">
          <div class="info-icon mb-2">🏆</div>
          <h6>पुरस्कार वितरण स्थल</h6>
          <p class="small mb-0">गीता जयंती महोत्सव के अंतर्गत 1 दिसंबर 2025 को यहाँ पुरस्कार वितरण समारोह आयोजित किया जाएगा।</p>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Image Gallery Section -->
<div class="container-fluid my-5" id="timeline">
  <div class="card shadow-lg border-0 rounded-3 p-4" style="background:linear-gradient(to bottom, #fde5c0ff, #fff7f0);">
    
    <div class="row align-items-center mb-4">
      <div class="col-md-4 mb-3">
        <div class="d-flex align-items-center justify-content-start">
          <div class="flex-shrink-0">
            <img src="./assets/images/cm_mp_1.jpg" alt="डॉ. मोहन यादव" 
                 class="rounded-circle shadow" 
                 style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #8B0100;">
          </div>
          <div class="flex-grow-1 ms-3">
            <h6 class="fw-bold mb-1" style="color: #8B0100; font-size: 14px;">डॉ. मोहन यादव</h6>
            <p class="mb-0 small" style="color: #333; line-height: 1.3; font-size: 12px;">
              माननीय मुख्यमंत्री<br>
              मध्यप्रदेश शासन
            </p>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 mb-3 text-center">
        <h4 class="section-title mb-0" style="color:#8B0100;">
          संस्कृति संचालनालय 
        </h4>
        <p class="mb-0 mt-1" style="color: #666; font-size: 14px;">
          अभ्युदय मध्यप्रदेश के अनमोल पल
        </p>
      </div>
      
      <div class="col-md-4 mb-3">
        <div class="d-flex align-items-center justify-content-end">
          <div class="flex-grow-1 me-3 text-end">
            <h6 class="fw-bold mb-1" style="color: #8B0100; font-size: 14px;">श्री धर्मेंन्द्र सिंह लोधी</h6>
            <p class="mb-0 small" style="color: #333; line-height: 1.3; font-size: 12px;">
              माननीय राज्य मंत्री (स्वतंत्र प्रभार)<br>
              संस्कृति | पर्यटन | धार्मिक न्यास और धर्मस्व |<br>
              मध्यप्रदेश शासन
            </p>
          </div>
          <div class="flex-shrink-0">
            <img src="./assets/images/sanskruti_cm_mp.jpg" alt="श्री धर्मेंन्द्र सिंह लोधी" 
                 class="rounded-circle shadow" 
                 style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #8B0100;">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 mb-4">
        <div class="card shadow border-0 rounded-3 h-100">
          <div class="card-body p-0">
            <div class="gallery-slider-container" style="position: relative; overflow: hidden; border-radius: 12px;">
              <div class="gallery-slider" id="gallerySlider" style="display: flex; transition: transform 0.5s ease-in-out; width: 100%;">
                <!-- Images will be populated by JavaScript -->
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 mb-4">
        <div class="card shadow border-0 rounded-3 h-100" style="background: #fff;">
          <div class="card-body p-4 d-flex flex-column">
            <h5 class="fw-bold mb-1" style="color:#8B0100;"><?= $event_title ?></h5>
            <h9 class="fw-bold mb-1"><?= $event_subtitle ?></h9>
            <p class="mb-3 flex-grow-1">
              यह गैलरी <?= $event_title ?> के विभिन्न कार्यक्रमों, सांस्कृतिक प्रस्तुतियों और प्रतिभागियों के उत्साह को दर्शाती है। 
              यहां आप महोत्सव के विभिन्न पहलुओं को देख सकते हैं।
            </p>
            
            <div class="row g-2 mb-3">
              <div class="col-6">
                <div class="card small-card text-center p-2">
                  <div class="icon-square mb-1 mx-auto" style="width: 30px; height: 30px; background: linear-gradient(135deg, #8B0100, #ff9933); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-users" style="color: white; font-size: 14px;"></i>
                  </div>
                  <small class="fw-bold">प्रतिभागी</small>
                </div>
              </div>
              <div class="col-6">
                <div class="card small-card text-center p-2">
                  <div class="icon-square mb-1 mx-auto" style="width: 30px; height: 30px; background: linear-gradient(135deg, #3366cc, #6699ff); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-trophy" style="color: white; font-size: 14px;"></i>
                  </div>
                  <small class="fw-bold">पुरस्कार</small>
                </div>
              </div>
              <div class="col-6">
                <div class="card small-card text-center p-2">
                  <div class="icon-square mb-1 mx-auto" style="width: 30px; height: 30px; background: linear-gradient(135deg, #cc3366, #ff6699); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-calendar" style="color: white; font-size: 14px;"></i>
                  </div>
                  <small class="fw-bold">कार्यक्रम</small>
                </div>
              </div>
              <div class="col-6">
                <div class="card small-card text-center p-2">
                  <div class="icon-square mb-1 mx-auto" style="width: 30px; height: 30px; background: linear-gradient(135deg, #33cc99, #66ffcc); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-image" style="color: white; font-size: 14px;"></i>
                  </div>
                  <small class="fw-bold">गैलरी</small>
                </div>
              </div>
            </div>
            
            <div class="mt-auto">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold" id="totalImages" style="display:none;"></span>
              </div>
              <div class="progress mb-3" style="height: 6px; display:none;">
                <div class="progress-bar" id="galleryProgress" style="background-color: #8B0100; width: 20%;"></div>
              </div>
              <div class="text-center">
                <button class="btn btn-orange-outline btn-sm" onclick="window.open('https://www.culturemp.in', '_blank')">संस्कृति संचालनालय</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid" id="help-support" style="background: linear-gradient(to bottom,  #000000, #001f3f); padding: 40px 0;">
  <div class="container">
    <div class="row align-items-start">

      <div class="col-md-3 mb-4">
        <h4 class="fw-bold" style="color:#fff;"><?= $event_title ?></h4>
        <h8 class="fw-bold mb-3" style="color:#fff; font-size: 14px;"><?= $event_subtitle ?></h8>
        <p style="color:#ccc; font-size: 14px; line-height: 1.5; margin: 0;">
          मध्यप्रदेश के नागरिकों की प्रतिभा, नेतृत्व तथा सांस्कृतिक चेतना को प्रोत्साहित करना
        </p>

        <div class="mt-4">
          <div class="mb-3">
            <h6 style="color:#fff; font-size: 14px;"><strong>गीता जयंती महोत्सव</strong></h6>
            <p style="color:#ccc; font-size: 13px; line-height: 1.4; margin: 0;">
              1 दिसंबर 2025 को लाल परेड मैदान में 11,000 युवाओं के साथ श्रीमद्भगवद्गीता का कंठस्थ पाठ।
            </p>
          </div>

          <div class="mb-3">
            <h6 style="color:#fff; font-size: 14px;"><strong>पुरस्कार वितरण</strong></h6>
            <p style="color:#ccc; font-size: 13px; line-height: 1.4; margin: 0;">
              1 दिसंबर 2025,
              <a href="https://ujjain.nic.in/en/tourist-place/sandipani/" 
                target="_blank" 
                style="color:#66ccff; text-decoration: underline;">
                महर्षि सांदीपनि आश्रम
              </a>, उज्जैन में गीता जयंती महोत्सव के अंतर्गत पुरस्कार वितरण समारोह।
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold mb-3" style="color:#fff; font-size: 16px;">त्वरित लिंक</h6>
        <div style="font-size: 14px; color:#ccc;">
          <p class="mb-2"><a href="#" class="text-decoration-none" style="color:#ccc;">हमारे बारे में</a></p>
          <p class="mb-2"><a href="#" class="text-decoration-none" style="color:#ccc;">कार्यक्रम</a></p>
          <p class="mb-2"><a href="#" class="text-decoration-none" style="color:#ccc;">समयरेखा</a></p>
          <p class="mb-2"><a href="#" class="text-decoration-none" style="color:#ccc;">पंजीकरण</a></p>
          <p class="mb-0"><a href="https://www.mp.gov.in/" class="text-decoration-none" style="color:#ccc;" target="_blank" rel="noopener noreferrer">एमपी के बारे में</a></p>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold mb-3" style="color:#fff; font-size: 16px;">संपर्क जानकारी</h6>
        <div style="font-size: 14px; color:#ccc;">
          <p class="mb-2">help.mpsthapanautsav@gmail.com</p>
          <p class="mb-2">+91 9599332084<br>
            +91 9599332093<br>
            <span style="font-size:13px; color:#aaa;">(सुबह 9 से शाम 6)</span>
          </p>
          <p class="mb-0">संस्कृति विभाग, भोपाल</p>
        </div>
      </div>

      <div class="col-md-3 mb-4">
        <h6 class="fw-bold mb-3" style="color:#fff; font-size: 16px;">हमें फॉलो करें</h6>
        <div class="d-flex gap-3 mb-3">
          <a href="https://www.facebook.com/61556988375837/posts/pfbid0fsyja4SdJwuTxJuKZEXcujbMU1BW6HuxsH61SjybE3BD2CMoL2BYv7KN6QVjHPxal" target="_blank" rel="noopener noreferrer" style="color:#fff; font-size: 16px; text-decoration: none; background: #001f3f; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://twitter.com/culturempbpl" target="_blank" rel="noopener noreferrer" style="color:#fff; font-size: 16px; text-decoration: none; background: #001f3f; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="https://www.instagram.com/culturedepartmentmadhyapradesh" target="_blank" rel="noopener noreferrer" style="color:#fff; font-size: 16px; text-decoration: none; background: #001f3f; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.youtube.com/channel/UCkWzijGF7QUT1EwfmkEW-iw/" target="_blank" rel="noopener noreferrer" style="color:#fff; font-size: 16px; text-decoration: none; background: #001f3f; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fab fa-youtube"></i>
          </a>
        </div>

        <div class="row g-3">

          <!-- Floating WhatsApp Channel Button -->
          <div class="wa-float" aria-hidden="false">
            <a class="wa-btn" id="waButton" href="https://whatsapp.com/channel/0029VbCCdiE0G0Xj9fAVrn0W" target="_blank" rel="noopener noreferrer" role="button" aria-label="Open WhatsApp channel (opens in new tab)">
                  <svg class="wa-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" focusable="false" aria-hidden="true">
                      <path d="M20.52 3.48C18.13 1.09 15.02 0 11.75 0 5.28 0 .12 5.16.12 11.63c0 2.05.54 4.04 1.57 5.8L0 24l6.77-1.69C9.37 23.7 10.55 24 11.75 24c6.47 0 11.63-5.16 11.63-11.63 0-3.27-1.09-6.38-3.23-8.89z" fill="#25D366"/>
                      <path d="M17.1 14.07c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15s-.78.98-.96 1.18c-.18.2-.36.22-.66.07-.3-.15-1.27-.47-2.41-1.48-.89-.79-1.49-1.76-1.66-2.06-.17-.3-.02-.46.13-.61.14-.14.3-.36.45-.54.15-.18.2-.3.3-.5.1-.2 0-.37-.04-.52-.04-.15-.68-1.62-.94-2.22-.25-.58-.5-.5-.68-.51-.18-.01-.39-.01-.59-.01-.2 0-.52.07-.79.37s-1.03 1.01-1.03 2.46c0 1.45 1.06 2.85 1.21 3.05.15.2 2.09 3.2 5.07 4.49 2.99 1.29 2.99.86 3.54.81.55-.05 1.78-.73 2.03-1.44.25-.71.25-1.32.18-1.44-.07-.12-.28-.2-.58-.35z" fill="#ffffff"/>
                  </svg>
              </a>
              <a class="wa-label" href="https://whatsapp.com/channel/0029VbCCdiE0G0Xj9fAVrn0W" target="_blank" rel="noopener noreferrer" aria-label="Join our WhatsApp channel (opens in a new tab)">
                  <svg width="16" height="16" viewBox="0 0 24 24" class="wa-icon-small" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path fill="#25D366" d="M20.52 3.48C18.13 1.09 15.02 0 11.75 0 5.28 0 .12 5.16.12 11.63c0 2.05.54 4.04 1.57 5.8L0 24l6.77-1.69C9.37 23.7 10.55 24 11.75 24c6.47 0 11.63-5.16 11.63-11.63 0-3.27-1.09-6.38-3.23-8.89z"/>
                      <path fill="#fff" d="M17.1 14.07c-.3-.15-1.78-.88-2.06-.98-.28-.1-.48-.15-.68.15s-.78.98-.96 1.18c-.18.2-.36.22-.66.07-.3-.15-1.27-.47-2.41-1.48-.89-.79-1.49-1.76-1.66-2.06-.17-.3-.02-.46.13-.61.14-.14.3-.36.45-.54.15-.18.2-.3.3-.5.1-.2 0-.37-.04-.52-.04-.15-.68-1.62-.94-2.22-.25-.58-.5-.5-.68-.51-.18-.01-.39-.01-.59-.01-.2 0-.52.07-.79.37s-1.03 1.01-1.03 2.46c0 1.45 1.06 2.85 1.21 3.05.15.2 2.09 3.2 5.07 4.49 2.99 1.29 2.99.86 3.54.81.55-.05 1.78-.73 2.03-1.44.25-.71.25-1.32.18-1.44-.07-.12-.28-.2-.58-.35z"/>
                  </svg>
                  <div class="wa-label-text">
                      <div>Join WhatsApp Channel</div>
                      <small>Get important updates</small>
                  </div>
                  
              </a>              
          </div>

          <div class="col-6 col-md-12">
            <div style="background-color: #fff; border-radius: 10px; padding: 10px 5px; text-align: center; max-width: 190px; box-shadow: 0 2px 6px rgba(0,0,0,0.25);">
              <span style="color:#8B0100; font-weight:700; font-size: 15px; display:block; line-height:1.4;">कुल साइट विज़िट्स</span>
              <span id="siteVisitCount" style="color:#8B0100; font-size: 18px; font-weight:700;">लोड हो रहा है...</span>
            </div>
          </div>

          <div class="col-6 col-md-12">
            <div id="totalRegistrations" style="background-color: #fff; border-radius: 10px; padding: 10px 5px; text-align: center; max-width: 190px; box-shadow: 0 2px 6px rgba(0,0,0,0.25);">
              <span style="color:#8B0100; font-weight:700; font-size: 15px; display:block; line-height:1.4;">कुल पंजीकरण</span>
              <span id="registrationCount" style="color:#8B0100; font-size: 18px; font-weight:700;">लोड हो रहा है...</span>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Footer Bottom -->
    <div class="row">
      <div class="col-12 text-center">
        <div class="border-top pt-3" style="border-color: #8B0100 !important;">
          <small style="color:#aaa; font-size: 13px;">
            © 2025 नागरिक संस्कार • मध्य प्रदेश सांस्कृतिक पहल
          </small>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- How to Participate Modal -->
<div class="modal fade" id="howToParticipateModal" tabindex="-1" aria-labelledby="howToParticipateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header" style="background:#8B0100; color:#fff; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
        <h5 class="modal-title fw-bold" id="howToParticipateModalLabel">कैसे भाग लें</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <div id="stepSelectionSection">

          <div class="step-item">
            <div class="step-left">
              <div class="step-icon" style="background: linear-gradient(135deg, #33cc33, #66ff66);">
                <i class="fas fa-user-plus"></i>
              </div>
              <div class="step-text">
                <h6 class="step-title">पंजीकरण कैसे करें ?</h6>
                <p class="step-description">अभ्युदय मध्यप्रदेश में भाग लेने के लिए पंजीकरण प्रक्रिया</p>
              </div>
            </div>
            <div class="step-right">
              <i class="fas fa-play-circle"></i>
              <div>अभी देखें</div>
            </div>
          </div>

          <div class="step-item">
            <div class="step-left">
              <div class="step-icon" style="background: linear-gradient(135deg, #3366cc, #6699ff);">
                <i class="fas fa-sign-in-alt"></i>
              </div>
              <div class="step-text">
                <h6 class="step-title">लॉगिन और नामांकन कैसे करें ?</h6>
                <p class="step-description">पंजीकरण के बाद अपने खाते में लॉगिन करें और प्रतियोगिता में नामांकन करें</p>
              </div>
            </div>
            <div class="step-right">
              <i class="fas fa-play-circle"></i>
              <div>अभी देखें</div>
            </div>
          </div>

          <div class="step-item">
            <div class="step-left">
              <div class="step-icon" style="background: linear-gradient(135deg, #cc3366, #ff6699);">
                <i class="fas fa-question-circle"></i>
              </div>
              <div class="step-text">
                <h6 class="step-title">क्विज (प्रश्नोत्तरी) परीक्षा में कैसे भाग लें ?</h6>
                <p class="step-description">क्विज परीक्षा में कैसे शामिल हों और AI-संचालित मूल्यांकन प्रक्रिया</p>
              </div>
            </div>
            <div class="step-right">
              <i class="fas fa-play-circle"></i>
              <div>अभी देखें</div>
            </div>
          </div>
        </div>

        <div id="videoSection" class="d-none">
          <div class="video-header d-flex justify-content-between align-items-center mb-3 flex-wrap">
            <h5 id="videoTitle" class="mb-2 mb-md-0 text-orange"></h5>
            <button id="backToSteps" class="btn btn-outline-warning btn-sm fw-bold">
              <i class="fas fa-arrow-left me-1"></i> वापस
            </button>
          </div>
          <div class="video-container">
            <video id="participateVideo" class="w-100 rounded shadow" controls playsinline></video>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<!-- FAQ Modal -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content border-0 rounded-4 shadow-lg">
      <div class="modal-header" style="background:#8B0100; color:#fff; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
        <h5 class="modal-title fw-bold" id="faqModalLabel">
          <i class="fas fa-question-circle me-2"></i>सामान्य प्रश्न (FAQ)
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body p-4">
        <div class="search-box mb-4">
          <div class="input-group">
            <span class="input-group-text bg-light border-end-0">
              <i class="fas fa-search text-muted"></i>
            </span>
            <input type="text" id="faqSearch" class="form-control border-start-0" placeholder="प्रश्न खोजें...">
          </div>
        </div>

        <div class="faq-categories mb-4">
          <div class="d-flex flex-wrap gap-1">
            <button class="btn btn-sm btn-outline-primary active" data-category="all">सभी</button>
            <button class="btn btn-sm btn-outline-primary" data-category="general-info">सामान्य जानकारी</button>
            <button class="btn btn-sm btn-outline-primary" data-category="registration">पंजीकरण</button>
            <button class="btn btn-sm btn-outline-primary" data-category="exam">परीक्षा</button>
            <button class="btn btn-sm btn-outline-primary" data-category="program">कार्यक्रम</button>
            <button class="btn btn-sm btn-outline-primary" data-category="support">संपर्क</button>
          </div>
        </div>

        <div class="accordion" id="faqAccordion">

          <div class="faq-category-title mb-3">
            <h6 class="fw-bold text-primary mb-2"></i>🕉️ सामान्य जानकारी</h6>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="general-info">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q1">
                गीता महोत्सव क्या है?
              </button>
            </h2>
            <div id="q1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                गीता महोत्सव एक सांस्कृतिक और आध्यात्मिक उत्सव है जो अभ्युदय मध्यप्रदेश के अंतर्गत आयोजित किया जा रहा है। इसका उद्देश्य युवाओं और नागरिकों में श्रीमद्भगवद्गीता के आदर्शों और शिक्षाओं का प्रचार-प्रसार करना है।
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="general-info">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q2">
                इस कार्यक्रम का आयोजन कौन कर रहा है?
              </button>
            </h2>
            <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                यह आयोजन मध्यप्रदेश शासन द्वारा अभ्युदय मध्यप्रदेश पहल के अंतर्गत, स्कूल शिक्षा विभाग एवं उच्च शिक्षा विभाग के सहयोग से किया जा रहा है।
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="general-info">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q3">
                गीता महोत्सव कब और कहाँ होगा?
              </button>
            </h2>
            <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                मुख्य आयोजन <strong>1 दिसम्बर 2025</strong> को <strong>लाल परेड ग्राउंड, भोपाल</strong> में होगा। पुरस्कार वितरण <strong>महर्षि सान्दीपनि आश्रम, उज्जैन</strong> में संपन्न होगा।
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="general-info">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q4">
                इस कार्यक्रम का उद्देश्य क्या है?
              </button>
            </h2>
            <div id="q4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                युवाओं में श्रीमद्भगवद्गीता की नैतिक, दार्शनिक और जीवनमूल्य शिक्षाओं को प्रोत्साहित करना और भारतीय संस्कृति एवं अध्यात्म का प्रसार करना इस कार्यक्रम का उद्देश्य है।
              </div>
            </div>
          </div>

          <div class="faq-category-title mb-3 mt-4">
            <h6 class="fw-bold text-primary mb-2"></i>🎓 पंजीकरण एवं भागीदारी</h6>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q5">
                गीता महोत्सव में कौन भाग ले सकता है?
              </button>
            </h2>
            <div id="q5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                मध्यप्रदेश के विद्यालयों, महाविद्यालयों, विश्वविद्यालयों के विद्यार्थी एवं सामान्य नागरिक सभी प्रतियोगिताओं में भाग ले सकते हैं।
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q6">
                प्रतियोगिता के लिए पंजीकरण कैसे करें?
              </button>
            </h2>
            <div id="q6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <p><a href="https://geetamahotsav.com" target="_blank">https://geetamahotsav.com</a> पर जाकर “Register” या “Participate Now” बटन पर क्लिक करें। अपनी जानकारी भरें, प्रतियोगिता का चयन करें और फॉर्म सबमिट करें।</p>
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q7">
                क्या पंजीकरण के लिए कोई शुल्क है?
              </button>
            </h2>
            <div id="q7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">नहीं, पंजीकरण और भागीदारी पूर्णतः निःशुल्क है।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q8">
                पंजीकरण की तिथि क्या है?
              </button>
            </h2>
            <div id="q8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">पंजीकरण <strong>07 नवम्बर 2025</strong> से <strong>15 नवम्बर 2025</strong> तक खुले रहेंगे। कृपया समय सीमा के भीतर पंजीकरण करें।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q9">
                पंजीकरण के बाद OTP या PIN कैसे मिलेगा?
              </button>
            </h2>
            <div id="q9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <ul>
                  <li>फॉर्म सबमिट करने के बाद मोबाइल नंबर पर OTP भेजा जाएगा।</li>
                  <li>सत्यापन के बाद मोबाइल और ईमेल दोनों पर PIN भेजा जाएगा।</li>
                  <li>यह PIN भविष्य में लॉगिन और स्लॉट बुकिंग के लिए आवश्यक है।</li>
                </ul>
                <p class="text-warning">👉 यदि OTP प्राप्त नहीं होता है, तो कृपया ईमेल (Inbox/Spam) अवश्य जाँचें।</p>
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q10">
                अगली बार लॉगिन कैसे करें?
              </button>
            </h2>
            <div id="q10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">अपने पंजीकृत मोबाइल नंबर और प्राप्त PIN का उपयोग करें। PIN आपको SMS या ईमेल से मिला होगा। इसे सुरक्षित रखें।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="registration">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q11">
                परीक्षा स्लॉट कैसे बुक करें?
              </button>
            </h2>
            <div id="q11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <ul>
                  <li>स्लॉट बुकिंग <strong>16 नवम्बर 2025</strong> को सुबह 10:00 बजे से प्रारंभ होगी।</li>
                  <li>लॉगिन करें और “Book Slot” सेक्शन से समय चुनें।</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="faq-category-title mb-3 mt-4">
            <h6 class="fw-bold text-primary mb-2">📝 परीक्षा से संबंधित जानकारी</h6>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="exam">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q14">
                परीक्षा पैटर्न क्या रहेगा?
              </button>
            </h2>
            <div id="q14" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <ul>
                  <li>कुल समय: 70 मिनट</li>
                  <li>कुल प्रश्न: 100 वस्तुनिष्ठ प्रश्न (MCQs)</li>
                  <li>तीन श्रेणियाँ: 33 + 33 + 34 प्रश्न</li>
                  <li>समय सीमा: पूरी परीक्षा के लिए 70 मिनट</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="exam">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q15">
                क्या नकारात्मक अंकन होगा?
              </button>
            </h2>
            <div id="q15" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">नहीं, कोई नकारात्मक अंकन नहीं होगा। केवल सही उत्तरों के अंक जोड़े जाएँगे।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="exam">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q16">
                क्या अतिरिक्त समय मिलेगा?
              </button>
            </h2>
            <div id="q16" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                नहीं, अतिरिक्त समय नहीं मिलेगा। समय समाप्त होने पर परीक्षा स्वतः सबमिट हो जाएगी। कृपया समय का ध्यान रखें।
              </div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="exam">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q17">
                परिणाम और प्रमाणपत्र कैसे मिलेंगे?
              </button>
            </h2>
            <div id="q17" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                परिणाम वेबसाइट और व्हाट्सएप चैनल पर प्रकाशित किए जाएँगे। प्रतिभागी “My Certificates” सेक्शन से प्रमाणपत्र डाउनलोड कर सकेंगे।
              </div>
            </div>
          </div>

          <div class="faq-category-title mb-3 mt-4">
            <h6 class="fw-bold text-primary mb-2">📅 कार्यक्रम एवं सहायता</h6>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="program">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q18">
                कार्यक्रम स्थल पर क्या लाना आवश्यक है?
              </button>
            </h2>
            <div id="q18" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">आईडी कार्ड, एंट्री पास और पंजीकरण पुष्टि (प्रिंट या QR कोड) साथ लाएँ।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="program">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q19">
                क्या यात्रा या आवास की व्यवस्था होगी?
              </button>
            </h2>
            <div id="q19" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">जिला स्तर से राज्य स्तर पर आने वाले प्रतिभागियों के लिए यात्रा भत्ता या व्यवस्था संस्थान के माध्यम से उपलब्ध हो सकती है।</div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="program">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q20">
                अपडेट्स और सूचनाएँ कहाँ से मिलेंगी?
              </button>
            </h2>
            <div id="q20" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">सभी अपडेट्स आधिकारिक वेबसाइट और व्हाट्सएप चैनल पर जारी किए जाएँगे। कृपया सोशल मीडिया लिंक भी फॉलो करें।</div>
            </div>
          </div>

          <div class="faq-category-title mb-3 mt-4">
            <h6 class="fw-bold text-primary mb-2">📞 संपर्क एवं सहायता</h6>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="support">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q21">
                तकनीकी या पंजीकरण संबंधी सहायता के लिए किससे संपर्क करें?
              </button>
            </h2>
            <div id="q21" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">वेबसाइट पर दिए गए हेल्पलाइन नंबरों पर संपर्क करें: <strong>+91 9599332084, +91 9599332093</strong></div>
            </div>
          </div>

          <div class="accordion-item mb-3 border-0 shadow-sm" data-category="support">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#q22">
                आधिकारिक व्हाट्सएप चैनल से कैसे जुड़ें?
              </button>
            </h2>
            <div id="q22" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                वेबसाइट के नीचे दिए गए “Join WhatsApp Channel” बटन पर क्लिक करें या <a href="https://whatsapp.com/channel/0029VbCCdiE0G0Xj9fAVrn0W" target="_blank">यहाँ क्लिक करें</a>।
              </div>
            </div>
          </div>
            <p class="text-center">सहायता केंद्र सुबह 9 बजे से शाम 6 बजे तक उपलब्ध है।</p>
        </div>

        <div id="noResults" class="text-center py-4 d-none">
          <i class="fas fa-search fa-3x text-muted mb-3"></i>
          <h6 class="text-muted">कोई प्रश्न नहीं मिला</h6>
          <p class="text-muted small">कृपया अपने खोज शब्द बदलकर पुनः प्रयास करें</p>
        </div>
      </div>

      <div class="modal-footer bg-light border-top">
        <div class="w-100 text-center">
          <p class="mb-2 small text-muted">अधिक जानकारी के लिए संपर्क करें</p>
          <div class="d-flex justify-content-center gap-3">
            <a href="tel:+919599332084" class="btn btn-outline-primary btn-sm">
              <i class="fas fa-phone me-1"></i> कॉल करें
            </a>
            <a href="mailto:help.mpsthapanautsav@gmail.com" class="btn btn-outline-primary btn-sm">
              <i class="fas fa-envelope me-1"></i> ईमेल
            </a>
            <a href="https://whatsapp.com/channel/0029VbCCdiE0G0Xj9fAVrn0W" target="_blank" class="btn btn-outline-success btn-sm">
              <i class="fab fa-whatsapp me-1"></i> व्हाट्सएप
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Footer -->
<a href="https://microintegrated.in/web/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; color: inherit;">
  <div class="container-fluid" style="padding: 20px 0; border-top: 1px solid #ddd; cursor: pointer;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 text-center">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <div class="flex-shrink-0">
              <img src="./assets/images/mtss_logo.png" alt="MICRO INTEGRATED" 
                   style="height: 40px; width: auto;">
            </div>
            <div>
              <p class="mb-0" style="color: #333; font-size: 12px; font-family: Arial, sans-serif;">
                Design and Developed by <strong>MICRO INTEGRATED</strong>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</a>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>


// script for countdown 


function updateCountdown() {
  const now = new Date();
  const target = new Date();
  target.setHours(17, 0, 0, 0);

  if (now > target) target.setDate(target.getDate() + 1);

  const diff = target - now;
  const hours = Math.floor(diff / (1000 * 60 * 60));
  const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((diff % (1000 * 60)) / 1000);

  const formattedHours = hours.toString().padStart(2, '0');
  const formattedMinutes = minutes.toString().padStart(2, '0');
  const formattedSeconds = seconds.toString().padStart(2, '0');

  document.getElementById('hours').textContent = formattedHours;
  document.getElementById('minutes').textContent = formattedMinutes;
  document.getElementById('seconds').textContent = formattedSeconds;

  const values = document.querySelectorAll('.time-value');
  if (hours === 0 && minutes < 60) {
    values.forEach(v => v.classList.add('pulse'));
  } else {
    values.forEach(v => v.classList.remove('pulse'));
  }

  if (diff <= 0) {
    document.getElementById('countdown-timer').innerHTML =
      '<span class="registration-open">✅ पंजीकरण शुरू!</span>';
  }
}

document.addEventListener('DOMContentLoaded', () => {
  updateCountdown();
  setInterval(updateCountdown, 1000);
});


// ******* script coundown end ********


const BASE_URL = "<?= $base_url ?>";



  // Smooth scrolling functionality
  document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.navbar-nav .nav-link[href^="#"]').forEach(link => {
          link.addEventListener('click', function(e) {
              e.preventDefault();
              
              const targetId = this.getAttribute('href');
              const targetElement = document.querySelector(targetId);
              
              if (targetElement) {
                  const navbarCollapse = document.getElementById('navbarNav');
                  if (navbarCollapse.classList.contains('show')) {
                      const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                      bsCollapse.hide();
                  }
                  
                  const navbarHeight = document.querySelector('.navbar').offsetHeight;
                  const targetPosition = targetElement.offsetTop - navbarHeight - 20;
                  
                  window.scrollTo({
                      top: targetPosition,
                      behavior: 'smooth'
                  });
              }
          });
      });
      
      function updateActiveNavLink() {
          const sections = document.querySelectorAll('section[id], div[id]');
          const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
          const scrollPosition = window.scrollY + 100;
          
          sections.forEach(section => {
              const sectionTop = section.offsetTop;
              const sectionHeight = section.offsetHeight;
              const sectionId = section.getAttribute('id');
              
              if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                  navLinks.forEach(link => {
                      link.classList.remove('active');
                      if (link.getAttribute('href') === `#${sectionId}`) {
                          link.classList.add('active');
                      }
                  });
              }
          });
      }
      
      window.addEventListener('scroll', updateActiveNavLink);
  });
  

  // Sponsors data
  const sponsors = [
    {
      logo: "./assets/images/banner_1.jpeg"
    },
    {
      logo: "./assets/images/baneer_2.jpeg"
    },
    {
      logo: "./assets/images/banner_3.jpeg"
    },
    {
      logo: "./assets/images/banner_4.jpeg"
    }
];

  // Gallery images data
  const galleryImages = [
    {
      src: "./assets/images/slide1.jpg",
      alt: "अभ्युदय मध्यप्रदेश - सांस्कृतिक प्रस्तुति"
    },
    {
      src: "./assets/images/slide2.jpg",
      alt: "अभ्युदय मध्यप्रदेश - कार्यशाला सत्र"
    },
    {
      src: "./assets/images/slide3.jpg",
      alt: "अभ्युदय मध्यप्रदेश - प्रतिभागी समूह"
    },
    {
      src: "./assets/images/slide4.jpg",
      alt: "अभ्युदय मध्यप्रदेश - पुरस्कार वितरण"
    },
    {
      src: "./assets/images/slide5.jpg",
      alt: "अभ्युदय मध्यप्रदेश - सांस्कृतिक नृत्य"
    }
  ];

  // script for ashram section
  const ashramImages = [
    { src: "./assets/images/sandipani_1.webp", alt: "महर्षि सांदीपनि आश्रम का मुख्य द्वार" },
    { src: "./assets/images/sandipani_2.jpg", alt: "आश्रम का आंतरिक परिसर" },
    { src: "./assets/images/sandipani_3.webp", alt: "आश्रम में पूजा स्थल" },
    { src: "./assets/images/sandipani_4.jpg", alt: "आश्रम का बगीचा और प्राकृतिक वातावरण" },
    { src: "./assets/images/sandipani_5.avif", alt: "आश्रम में सांस्कृतिक कार्यक्रम" }
  ];

  function initAshramSlider() {
    const slider = document.getElementById('ashramSlider');
    const indicatorsContainer = document.querySelector('.ashram-slider-indicators');
    
    slider.innerHTML = '';
    indicatorsContainer.innerHTML = '';
    
    ashramImages.forEach((image, index) => {
      const slide = document.createElement('div');
      slide.className = 'ashram-slide';
      slide.style.position = 'absolute';
      slide.style.top = '0';
      slide.style.left = '0';
      slide.style.width = '100%';
      slide.style.height = '100%';
      slide.style.opacity = '0';
      slide.style.transition = 'opacity 0.6s ease-in-out';
      slide.innerHTML = `<img src="${image.src}" alt="${image.alt}">`;
      slider.appendChild(slide);
      
      const indicator = document.createElement('div');
      indicator.className = 'ashram-indicator';
      indicator.dataset.index = index;
      indicator.addEventListener('click', () => goToAshramSlide(index));
      indicatorsContainer.appendChild(indicator);
    });

    let current = 0;
    const slides = document.querySelectorAll('.ashram-slide');
    const indicators = document.querySelectorAll('.ashram-indicator');
    slides[0].style.opacity = '1';
    indicators[0].style.backgroundColor = '#8B0100';

    function goToAshramSlide(index) {
      slides[current].style.opacity = '0';
      indicators[current].style.backgroundColor = '#ccc';
      current = index;
      slides[current].style.opacity = '1';
      indicators[current].style.backgroundColor = '#8B0100';
    }

    setInterval(() => {
      goToAshramSlide((current + 1) % slides.length);
    }, 4000);
  }


// Initialize sponsors slider with smooth sliding
function initSponsorsSlider() {
    const slider = document.getElementById('sponsorsSlider');
    const container = document.querySelector('.sponsors-slider-container');
    
    // Clear existing content
    slider.innerHTML = '';
    
    // Create duplicated set for seamless looping (original + duplicate)
    const allSponsors = [...sponsors, ...sponsors, ...sponsors];
    
    allSponsors.forEach((sponsor, index) => {
        const slide = document.createElement('div');
        slide.className = 'sponsor-slide';
        slide.innerHTML = `
            <div class="sponsor-card">
                <div class="sponsor-logo">
                    <img src="${sponsor.logo}" 
                         alt="Sponsor Banner ${(index % sponsors.length) + 1}" 
                         loading="lazy"
                         onerror="this.style.display='none'">
                </div>
            </div>
        `;
        slider.appendChild(slide);
    });
    
    startSmoothAutoSlide();
}

// Start smooth auto sliding
function startSmoothAutoSlide() {
    const slider = document.getElementById('sponsorsSlider');
    const slides = slider.children;
    const slideWidth = 250 + 30;
    const totalWidth = slideWidth * sponsors.length;
    
    slider.classList.remove('auto-slide');
    
    const animationDuration = sponsors.length * 10;
    
    const style = document.createElement('style');
    style.textContent = `
        @keyframes smoothSlide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-${slideWidth}px * ${sponsors.length}));
            }
        }
        
        .sponsors-slider.auto-slide {
            animation: smoothSlide ${animationDuration}s linear infinite;
        }
        
        @media (max-width: 1200px) {
            @keyframes smoothSlide {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-${220 + 24}px * ${sponsors.length})); }
            }
        }
        
        @media (max-width: 992px) {
            @keyframes smoothSlide {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-${200 + 24}px * ${sponsors.length})); }
            }
        }
        
        @media (max-width: 768px) {
            @keyframes smoothSlide {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-${280 + 20}px * ${sponsors.length})); }
            }
        }
        
        @media (max-width: 576px) {
            @keyframes smoothSlide {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-${260 + 16}px * ${sponsors.length})); }
            }
        }
        
        @media (max-width: 400px) {
            @keyframes smoothSlide {
                0% { transform: translateX(0); }
                100% { transform: translateX(calc(-${240 + 16}px * ${sponsors.length})); }
            }
        }
    `;
    document.head.appendChild(style);
    
    void slider.offsetWidth;
    
    slider.classList.add('auto-slide');
    
    slider.addEventListener('animationiteration', () => {
    });
}

let resizeTimeout;
function handleResize() {
    const slider = document.getElementById('sponsorsSlider');
    if (slider) {
        slider.classList.remove('auto-slide');
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            initSponsorsSlider();
        }, 100);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initSponsorsSlider();
    
    window.addEventListener('resize', handleResize);
});

// Image error handling
function handleImageError(img) {
    console.warn('Failed to load sponsor image:', img.src);
    img.style.display = 'none';
    
    const placeholder = document.createElement('div');
    placeholder.style.width = '250px';
    placeholder.style.height = '312px';
    placeholder.style.background = 'linear-gradient(45deg, #f0f0f0, #e0e0e0)';
    placeholder.style.borderRadius = '12px';
    placeholder.style.display = 'flex';
    placeholder.style.alignItems = 'center';
    placeholder.style.justifyContent = 'center';
    placeholder.style.color = '#999';
    placeholder.style.fontWeight = 'bold';
    placeholder.innerHTML = 'Banner Image';
    
    img.parentNode.appendChild(placeholder);
}

  // Initialize gallery slider
  function initGallerySlider() {
    const slider = document.getElementById('gallerySlider');
    const progressBar = document.getElementById('galleryProgress');
    const totalImages = document.getElementById('totalImages');
    
    totalImages.textContent = galleryImages.length;
    
    slider.innerHTML = '';
    
    galleryImages.forEach((image, index) => {
      const slide = document.createElement('div');
      slide.className = 'gallery-slide';
      slide.style.flex = '0 0 100%';
      slide.innerHTML = `
        <img src="${image.src}" alt="${image.alt}" class="img-fluid w-100" style="height: 400px; object-fit: cover;">
      `;
      slider.appendChild(slide);
    });
    
    startGalleryAutoSlide(progressBar);
  }


  // Auto-slide functionality for gallery
  function startGalleryAutoSlide(progressBar) {
    const slider = document.getElementById('gallerySlider');
    const slides = document.querySelectorAll('.gallery-slide');
    const totalSlides = slides.length;
    let currentIndex = 0;
    
    function slideNext() {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateSliderPosition();
      updateProgressBar();
    }
    
    function updateSliderPosition() {
      slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    }
    
    function updateProgressBar() {
      const progress = ((currentIndex + 1) / totalSlides) * 100;
      progressBar.style.width = `${progress}%`;
    }
    
    setInterval(slideNext, 4000); 
  }


  // Function to fetch total registrations from API
  async function fetchTotalRegistrations() {
    try {
      const response = await fetch(`${BASE_URL}/api/v1/organiser/total_registration.php`);
      const data = await response.json();

      const registrationCountElement = document.getElementById('registrationCount');
      const siteVisitCountElement = document.getElementById('siteVisitCount');

      if (data.error_code === 200 && data.status === 'success') {
        const totalRegistrations = parseInt(data.total_registrations, 10);
        // const displayRegistrations = totalRegistrations < 2000000 ? 2000000 : totalRegistrations;
        const displayRegistrations = totalRegistrations;
        registrationCountElement.textContent = displayRegistrations.toLocaleString('en-IN')+ '+';

        const currentVisitors = parseInt(data.current_visitor, 10);
        // const displayVisitors = currentVisitors < 2000000 ? 2000000 : currentVisitors;
        const displayVisitors = currentVisitors;
        siteVisitCountElement.textContent = displayVisitors.toLocaleString('en-IN') + '+';
      } else {
        registrationCountElement.textContent = '20,00,000';
        siteVisitCountElement.textContent = '20,00,000+';
      }
    } catch (error) {
      console.error('Error fetching registration data:', error);
      document.getElementById('registrationCount').textContent = '20,00,000';
      document.getElementById('siteVisitCount').textContent = '20,00,000+';
    }
  }


  document.addEventListener('DOMContentLoaded', function() {
    fetchTotalRegistrations();
    initSponsorsSlider();
    initGallerySlider();
    

    const pdfModal = document.getElementById('pdfModal');
    if (pdfModal) {
      pdfModal.addEventListener('shown.bs.modal', function() {
        const iframe = this.querySelector('iframe');
        if (iframe) {
          iframe.src = iframe.src;
        }
      });
    }
    const sections = document.querySelectorAll('.section-animate');
    sections.forEach((el, index) => {
      setTimeout(() => {
        el.classList.add('active');
      }, index * 200);
    });
    
  });



  // script for video section
  document.addEventListener('DOMContentLoaded', function() {
    const stepVideos = {
      1: {
        title: "पंजीकरण कैसे करें",
        src: "./assets/videos/registration.mp4"
      },
      2: {
        title: "लॉगिन और नामांकन कैसे करें",
        src: "./assets/videos/login-enrollment.mp4"
      },
      3: {
        title: "क्विज (प्रश्नोत्तरी) परीक्षा में कैसे शामिल हों",
        src: "./assets/videos/quiz-participation.mp4"
      }
    };
    
    const stepSelectionSection = document.getElementById('stepSelectionSection');
    const videoSection = document.getElementById('videoSection');
    const videoTitle = document.getElementById('videoTitle');
    const participateVideo = document.getElementById('participateVideo');
    const backToSteps = document.getElementById('backToSteps');
    
    document.querySelectorAll('.step-item').forEach((item, index) => {
      item.addEventListener('click', function() {
        const step = index + 1;
        showVideoForStep(step);
      });
    });
    
    backToSteps.addEventListener('click', function() {
      showStepSelection();
    });
    
    function showVideoForStep(step) {
      const videoData = stepVideos[step];
      
      if (!videoData) return;
      
      videoTitle.textContent = videoData.title;
      participateVideo.src = videoData.src;
      
      stepSelectionSection.classList.add('d-none');
      videoSection.classList.remove('d-none');
      
      participateVideo.currentTime = 0;
    }
    
    function showStepSelection() {
      participateVideo.pause();
      
      videoSection.classList.add('d-none');
      stepSelectionSection.classList.remove('d-none');
    }
    
    const modal = document.getElementById('howToParticipateModal');
    modal.addEventListener('hidden.bs.modal', function() {
      showStepSelection();
    });
  });


// Geeta Shloks data
const geetaShloks = [
  {
    shlok: "कर्मण्येवाधिकारस्ते मा फलेषु कदाचन। मा कर्मफलहेतुर्भूर्मा ते सङ्गोऽस्त्वकर्मणि॥",
    translation: "तुम्हारा कर्म करने में ही अधिकार है, फलों में कभी नहीं। कर्म के फल का हेतु मत बनो और कर्म न करने में भी तुम्हारी आसक्ति न हो।",
    meaning: "इस श्लोक में भगवान कृष्ण अर्जुन को समझाते हैं कि हमें केवल अपने कर्तव्य का पालन करना चाहिए, फल की इच्छा नहीं रखनी चाहिए।",
    reference: "श्रीमद्भगवद्गीता  - अध्याय 2, श्लोक 47"
  },
  {
    shlok: "यदा यदा हि धर्मस्य ग्लानिर्भवति भारत। अभ्युत्थानमधर्मस्य तदात्मानं सृजाम्यहम्॥",
    translation: "हे भारत! जब-जब धर्म की हानि और अधर्म की वृद्धि होती है, तब-तब मैं अपनी रचना करता हूँ।",
    meaning: "भगवान कहते हैं कि जब-जब धर्म का पतन होता है और अधर्म बढ़ता है, तब-तब वे स्वयं अवतार लेते हैं।",
    reference: "श्रीमद्भगवद्गीता  - अध्याय 4, श्लोक 7"
  },
  {
    shlok: "परित्राणाय साधूनां विनाशाय च दुष्कृताम्। धर्मसंस्थापनार्थाय सम्भवामि युगे युगे॥",
    translation: "सज्जनों के उद्धार के लिए, दुष्टों के विनाश के लिए और धर्म की स्थापना के लिए मैं युग-युग में प्रकट होता हूँ।",
    meaning: "भगवान हर युग में सज्जनों की रक्षा, दुष्टों के विनाश और धर्म की पुनर्स्थापना के लिए अवतार लेते हैं।",
    reference: "श्रीमद्भगवद्गीता  - अध्याय 4, श्लोक 8"
  },
  {
    shlok: "योगस्थः कुरु कर्माणि सङ्गं त्यक्त्वा धनञ्जय। सिद्ध्यसिद्ध्योः समो भूत्वा समत्वं योग उच्यते॥",
    translation: "हे धनंजय! आसक्ति को त्यागकर, सफलता और असफलता में समभाव रखते हुए योग में स्थित होकर कर्म करो। समत्व को ही योग कहते हैं।",
    meaning: "भगवान कृष्ण अर्जुन को सिखाते हैं कि सफलता और असफलता में समान भाव रखकर, बिना आसक्ति के कर्म करना ही योग है।",
    reference: "श्रीमद्भगवद्गीता  - अध्याय 2, श्लोक 48"
  },
  {
    shlok: "विहाय कामान्यः सर्वान्पुमांश्चरति निःस्पृहः। निर्ममो निरहंकारः स शान्तिमधिगच्छति॥",
    translation: "जो मनुष्य सभी कामनाओं का त्याग कर, निःस्पृह होकर, ममता और अहंकार से रहित होकर चलता है, वह शांति को प्राप्त होता है।",
    meaning: "कामनाओं, ममता और अहंकार का त्याग करने वाला व्यक्ति ही वास्तविक शांति प्राप्त कर सकता है।",
    reference: "श्रीमद्भगवद्गीता  - अध्याय 2, श्लोक 71"
  }
];

// Initialize Geeta Shloks slider
function initGeetaShloksSlider() {
  const slider = document.getElementById('shloksSlider');
  const indicatorsContainer = document.querySelector('.shloks-indicators');
  
  slider.innerHTML = '';
  indicatorsContainer.innerHTML = '';
  
  geetaShloks.forEach((shlok, index) => {
    const slide = document.createElement('div');
    slide.className = 'shlok-slide';
    slide.innerHTML = `
      <div class="shlok-text">${shlok.shlok}</div>
      <div class="shlok-translation">${shlok.translation}</div>
      <div class="shlok-meaning">${shlok.meaning}</div>
      <div class="shlok-reference">${shlok.reference}</div>
    `;
    slider.appendChild(slide);
    
    const indicator = document.createElement('div');
    indicator.className = 'shlok-indicator';
    indicator.dataset.index = index;
    indicator.addEventListener('click', () => goToSlide(index));
    indicatorsContainer.appendChild(indicator);
  });
  
  document.querySelectorAll('.shlok-slide')[0].classList.add('active');
  document.querySelectorAll('.shlok-indicator')[0].classList.add('active');
  
  setInterval(slideNext, 10000);
}

let currentShlokIndex = 0;

function slideNext() {
  const slides = document.querySelectorAll('.shlok-slide');
  const indicators = document.querySelectorAll('.shlok-indicator');
  const totalSlides = slides.length;
  
  slides[currentShlokIndex].classList.remove('active');
  indicators[currentShlokIndex].classList.remove('active');
  
  currentShlokIndex = (currentShlokIndex + 1) % totalSlides;
  
  const slider = document.getElementById('shloksSlider');
  slider.style.transform = `translateX(-${currentShlokIndex * 100}%)`;
  
  slides[currentShlokIndex].classList.add('active');
  indicators[currentShlokIndex].classList.add('active');
}

function goToSlide(index) {
  const slides = document.querySelectorAll('.shlok-slide');
  const indicators = document.querySelectorAll('.shlok-indicator');
  
  slides[currentShlokIndex].classList.remove('active');
  indicators[currentShlokIndex].classList.remove('active');
  
  currentShlokIndex = index;
  
  const slider = document.getElementById('shloksSlider');
  slider.style.transform = `translateX(-${currentShlokIndex * 100}%)`;
  
  slides[currentShlokIndex].classList.add('active');
  indicators[currentShlokIndex].classList.add('active');
}

document.addEventListener('DOMContentLoaded', function() {
  initGeetaShloksSlider();
  initAshramSlider();
});


// Video autoplay functionality
document.addEventListener('DOMContentLoaded', function() {
  const video = document.getElementById('geetaVideo');
  
  video.muted = true;
  
  const playVideo = () => {
    video.play().catch(error => {
      console.log('Video autoplay failed:', error);
      document.querySelector('.video-overlay').style.display = 'flex';
    });
  };
  
  playVideo();
  
  document.querySelector('.video-overlay').addEventListener('click', function() {
    this.style.display = 'none';
    playVideo();
  });
  
  document.addEventListener('visibilitychange', function() {
    if (!document.hidden && video.paused) {
      playVideo();
    }
  });
});

// Script for study material pdf
  let currentPdfUrl = '';
  let currentPdfLoadingTask = null;

  function openPdfModal(pdfUrl, title) {
    currentPdfUrl = pdfUrl;
    document.getElementById('pdfModalLabel').textContent = title;

    const pdfContainer = document.getElementById('pdfContainer');
    pdfContainer.innerHTML = '';

    if (currentPdfLoadingTask) {
      currentPdfLoadingTask.destroy();
      currentPdfLoadingTask = null;
    }

    const pdfModal = new bootstrap.Modal(document.getElementById('pdfModal'));
    pdfModal.show();

    setTimeout(() => {
      loadPdf(pdfUrl);
    }, 300);
  }

  document.getElementById('downloadPdfBtn').addEventListener('click', function() {
    if (currentPdfUrl) {
      const link = document.createElement('a');
      link.href = currentPdfUrl;
      link.download = currentPdfUrl.split('/').pop();
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  });

  async function loadPdf(pdfUrl) {
    const pdfContainer = document.getElementById('pdfContainer');
    pdfContainer.innerHTML = `
      <div class="text-center py-5">
        <div class="spinner-border text-primary" role="status"></div>
        <p class="mt-2">PDF लोड हो रहा है...</p>
      </div>`;

    try {
      pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
      
      currentPdfLoadingTask = pdfjsLib.getDocument({
        url: pdfUrl,
        cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/cmaps/',
        cMapPacked: true,
      });

      const pdf = await currentPdfLoadingTask.promise;
      await renderPDF(pdf);
    } catch (error) {
      console.error('Error loading PDF:', error);
      pdfContainer.innerHTML = '<div class="alert alert-danger text-center mt-3">PDF लोड करने में समस्या आई। कृपया बाद में पुनः प्रयास करें।</div>';
    }
  }

  async function renderPDF(pdf) {
    const pdfContainer = document.getElementById('pdfContainer');
    pdfContainer.innerHTML = '';

    const totalPages = pdf.numPages;

    for (let pageNum = 1; pageNum <= totalPages; pageNum++) {
      const page = await pdf.getPage(pageNum);

      const viewport = page.getViewport({ scale: 1 });
      const isMobile = window.innerWidth < 768;
      const containerWidth = pdfContainer.clientWidth || window.innerWidth * 0.9;

      const scale = isMobile
        ? Math.min(containerWidth / viewport.width, 1.2)
        : Math.min(containerWidth / viewport.width, 1.5);

      const scaledViewport = page.getViewport({ scale });
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');

      const pixelRatio = window.devicePixelRatio || 1;
      canvas.width = scaledViewport.width * pixelRatio;
      canvas.height = scaledViewport.height * pixelRatio;
      canvas.style.width = '100%';
      canvas.style.height = 'auto';
      canvas.style.boxShadow = '0 2px 5px rgba(0,0,0,0.1)';
      canvas.style.borderRadius = '8px';
      canvas.style.marginBottom = '20px';

      context.scale(pixelRatio, pixelRatio);

      pdfContainer.appendChild(canvas);

      const renderContext = {
        canvasContext: context,
        viewport: scaledViewport
      };

      await page.render(renderContext).promise;
    }
  }

  document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function() {
    const pdfContainer = document.getElementById('pdfContainer');
    pdfContainer.innerHTML = '';
    currentPdfUrl = '';
    if (currentPdfLoadingTask) {
      currentPdfLoadingTask.destroy();
      currentPdfLoadingTask = null;
    }
  });

  // Script for FAQ Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
  const faqSearch = document.getElementById('faqSearch');
  const categoryButtons = document.querySelectorAll('.faq-categories .btn');
  const accordionItems = document.querySelectorAll('.accordion-item');
  const categoryTitles = document.querySelectorAll('.faq-category-title');
  const noResults = document.getElementById('noResults');

  categoryButtons.forEach(button => {
    button.addEventListener('click', function() {
      categoryButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      
      const category = this.dataset.category;
      filterFAQs(category, faqSearch.value);
    });
  });

  faqSearch.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const activeCategory = document.querySelector('.faq-categories .btn.active').dataset.category;
    filterFAQs(activeCategory, searchTerm);
  });

  function filterFAQs(category, searchTerm) {
    let visibleCount = 0;
    
    accordionItems.forEach(item => {
      const itemCategory = item.dataset.category;
      const question = item.querySelector('.accordion-button').textContent.toLowerCase();
      const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
      
      const matchesCategory = category === 'all' || itemCategory === category;
      const matchesSearch = searchTerm === '' || 
                           question.includes(searchTerm) || 
                           answer.includes(searchTerm);
      
      if (matchesCategory && matchesSearch) {
        item.style.display = 'block';
        visibleCount++;
      } else {
        item.style.display = 'none';
      }
    });
    
    categoryTitles.forEach(title => {
      const titleCategory = title.dataset.category;
      const hasVisibleItems = Array.from(accordionItems).some(item => 
        item.dataset.category === titleCategory && 
        item.style.display !== 'none'
      );
      
      title.style.display = hasVisibleItems ? 'block' : 'none';
    });
    
    noResults.style.display = visibleCount === 0 ? 'block' : 'none';
  }

  const faqModal = document.getElementById('faqModal');
  faqModal.addEventListener('shown.bs.modal', function() {
    const firstVisibleItem = document.querySelector('.accordion-item[style="display: block"]');
    if (firstVisibleItem) {
      const collapseElement = firstVisibleItem.querySelector('.accordion-collapse');
      if (collapseElement) {
        new bootstrap.Collapse(collapseElement, { toggle: true });
      }
    }
  });

  faqModal.addEventListener('hidden.bs.modal', function() {
    faqSearch.value = '';
    const allButton = document.querySelector('.faq-categories .btn[data-category="all"]');
    if (allButton) {
      categoryButtons.forEach(btn => btn.classList.remove('active'));
      allButton.classList.add('active');
    }
    filterFAQs('all', '');
    
    const openItems = document.querySelectorAll('.accordion-collapse.show');
    openItems.forEach(item => {
      new bootstrap.Collapse(item, { hide: true });
    });
  });
});

// script for page restrictions 

document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
    showRestrictionMessage();
});

function showRestrictionMessage() {
    const message = document.getElementById('restrictionMessage');
    message.style.display = 'block';
    setTimeout(() => {
        message.style.display = 'none';
    }, 2000);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'F12') {
        e.preventDefault();
        showRestrictionMessage();
    }
    
    if (e.ctrlKey && e.shiftKey && e.key === 'I') {
        e.preventDefault();
        showRestrictionMessage();
    }
    
    if (e.ctrlKey && e.shiftKey && e.key === 'J') {
        e.preventDefault();
        showRestrictionMessage();
    }
    
    if (e.ctrlKey && e.key === 'u') {
        e.preventDefault();
        showRestrictionMessage();
    }
});
</script>

</body>
</html>
