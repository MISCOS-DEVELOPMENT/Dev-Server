<?php
 $event_title = "अभ्युदय मध्यप्रदेश";
 $event_subtitle = "विरासत भी ! विकास भी !";
$base_url = "https://geetamahotsav.com";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($event_title) ?> - Organizer Login</title>
  <link rel="icon" type="image/png" href="./assets/images/mp_logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style_for_dashboard.css">
</head>

<style>
  body {
    background: linear-gradient(to bottom, #800080, #ffffff);
    font-family: 'Segoe UI', sans-serif;
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }
  .login-box {
    background: #101828;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    max-width: 400px;
    margin: auto;
  }
  .btn-orange {
    background-color: #ff6600;
    border: none;
    color: #fff;
  }
  .btn-orange:hover {
    background-color: #e65c00;
  }
</style>

<body>
<?php include './includes/navbar.php'; ?>

<div class="page-title">
  <span>• <?= htmlspecialchars($event_title) ?> Organizer Login</span>
</div>
<p class="page-subtext">Login to access your account</p>

<div class="container">
  <div class="login-box">
    <div class="profile-icon text-center mb-3">
      <i class="fa fa-user-tie fa-3x"></i>
    </div>

    <form id="loginForm" method="POST" onsubmit="return handleLogin(event)">
      <div class="mb-1 text-start" id="loginSection">
        <label for="loginMobile" class="form-label" style="color:white;">Mobile No. *</label>
        <input type="text" class="form-control" id="loginMobile" name="login_mobile"
               placeholder="Enter Mobile No." maxlength="10" oninput="onlyNumbers(this)" required>
      </div>

      <div class="mb-1 text-start" id="passwordSection">
        <label for="password" class="form-label" style="color:white;">Password *</label>
        <input type="password" class="form-control" id="password" name="login_password"
               placeholder="Enter Password" required>
      </div>

      <p class="text-end mb-2">
        <a href="#" onclick="showForgot(event)">Forgot Password?</a>
      </p>

      <div id="otpForgotSection" style="display:none;">
        <div class="mb-1 text-start">
          <label for="otpForgot" class="form-label" style="color:white;">Enter OTP sent to your mobile *</label>
          <input type="text" class="form-control" id="otpForgot" placeholder="Enter OTP"
                 maxlength="6" oninput="onlyNumbers(this)">
        </div>
        <p class="otp-timer">Resend OTP in <span id="timer">01:30</span></p>

        <div class="d-flex justify-content-center gap-2 mb-3">
          <button type="button" onclick="verifyOtp()" class="btn btn-orange btn-sm">Verify OTP</button>
        </div>
      </div>

      <button type="submit" id="loginBtn" class="btn btn-orange btn-sm w-100">Login</button>
    </form>
  </div>
</div>

<script>
const BASE_URL = "<?= $base_url ?>";

let countdown;

function onlyNumbers(el){
  el.value = el.value.replace(/\D/g,'');
}

function showForgot(e){
  e.preventDefault();
  document.getElementById("otpForgotSection").style.display = "block";
  document.getElementById("passwordSection").style.display = "none";
  document.getElementById("loginBtn").style.display = "none";

  let timeLeft = 90;
  countdown = setInterval(() => {
    let minutes = Math.floor(timeLeft / 60);
    let seconds = timeLeft % 60;
    document.getElementById("timer").textContent =
      (minutes<10?"0"+minutes:minutes) + ":" + (seconds<10?"0"+seconds:seconds);
    timeLeft--;
    if(timeLeft<0){ clearInterval(countdown); document.getElementById("timer").textContent="00:00"; }
  },1000);
}

function verifyOtp(){
  const otp = document.getElementById("otpForgot").value.trim();
  if(!/^\d{6}$/.test(otp)){
    alert("Enter valid 6-digit OTP");
    return;
  }
  alert("OTP Verified! You can now reset your password.");
}

function handleLogin(e) {
  e.preventDefault();
  const mobile = document.getElementById("loginMobile").value.trim();
  const password = document.getElementById("password").value.trim();
  const loginBtn = document.getElementById("loginBtn");

  if (!/^\d{10}$/.test(mobile)) {
    alert("Enter valid mobile number");
    return false;
  }
  if (password === "") {
    alert("Enter password");
    return false;
  }

  loginBtn.disabled = true;
  loginBtn.textContent = "Logging in...";

  const xhr = new XMLHttpRequest();
  xhr.open("POST", `${BASE_URL}/api/v1/organiser/org_login.php`, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      loginBtn.disabled = false;
      loginBtn.textContent = "Login";

      if (xhr.status === 200) {
        let data;
        try { data = JSON.parse(xhr.responseText); }
        catch (err) { alert("Invalid server response"); return; }

        console.log("API Response:", data);

        if (data.error_code === 200) {
          const userData = data.data;

          fetch("set_session.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
              u_id: userData.u_id,
              u_name: userData.u_name,
              u_dist: userData.u_dist,
              u_email: userData.u_email,
              u_mobile: userData.u_mobile
            })
          })
          .then(res => res.json())
          .then(() => {
            window.location.href = "admin_dashboard.php";
          });

        } else if (data.error_code === 403) {
          alert("Invalid credentials. Please try again.");
        } else if (data.error_code === 401) {
          alert("Session expired. Please login again.");
        } else {
          alert(data.message || "Login failed, please try again later.");
        }
      } else {
        alert("Server error, please try again later.");
      }
    }
  };
  xhr.send(`u_mobile=${encodeURIComponent(mobile)}&u_pin=${encodeURIComponent(password)}`);
  return false;
}
</script>
</body>
</html>
