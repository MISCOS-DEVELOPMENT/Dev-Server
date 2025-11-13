<?php
  $event_title = "अभ्युदय मध्यप्रदेश";
  $event_subtitle = "विरासत भी ! विकास भी !";
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
  <link rel="stylesheet" href="./assets/css/custom.css">
</head>
<body>
  <div class="launch-container">
    <div class="launch-header">
      <h1>गीता महोत्सव</h1>
      <p><?= $event_title ?> - <?= $event_subtitle ?></p>
    </div>
    
    <div class="launch-body">
      <div class="geeta-icon">
        <i class="fas fa-book-open"></i>
      </div>
      
      <div class="coming-soon">
        यह कार्यक्रम जल्द ही उपलब्ध होगा
      </div>
      
      <img src="./assets/images/geeta_mahotsav.jpeg" alt="गीता महोत्सव" class="event-image">
      
      <div class="event-details">
        <h3>गीता महोत्सव के बारे में</h3>
        <p>
          <span class="highlight"><?= $event_title ?>, <?= $event_subtitle ?></span> अंतर्गत मध्यप्रदेश के युवाओं की प्रतिभा, नेतृत्व तथा सांस्कृतिक चेतना को प्रोत्साहित करने के उद्देश्य से विभिन्न विषयों यथा संस्कृति, जनजातीय संस्कृति, ज्ञान-विज्ञान, कृषि सभ्यता, जल गंगा संवर्धन, स्वदेशी, वन, खेल आदि पर केंद्रित प्रतियोगिताओं का आयोजन किया जाना प्रस्तावित है।
        </p>
        
        <p>
          प्रथम चरण में <span class="highlight">गीता जयंती</span> के अवसर पर लाल परेड मैदान में <span class="highlight">1 दिसंबर 2025</span> को गीता जयंती महोत्सव का आयोजन किया जाएगा। इसमें लगभग <span class="highlight">11000 युवाओं/प्रतिभागियों</span> की उपस्थिति में गीता का अध्याय 5, श्लोक 20 का कंठस्थ पाठ किया जाएगा।
        </p>
        
        <p>
          इस अवसर पर <span class="highlight">भगवान श्री कृष्ण की सांगीतिक यात्राः विश्ववंद</span> की लगभग <span class="highlight">500 कलाकारों</span> के साथ सांगीतिक प्रस्तुति भी होगी।
        </p>
      </div>
      
      <div class="footer-note">
        <p>अधिक जानकारी के लिए बने रहें। जल्द ही पंजीकरण प्रक्रिया शुरू होगी।</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>

    document.querySelector('.coming-soon').addEventListener('click', function() {
      window.location.href = 'dashboard.php';
    });
  </script>
</body>
</html>