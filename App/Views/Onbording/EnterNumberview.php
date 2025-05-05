<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Parent</title>
  <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= CSS ?>/Main/Change.css?v=<?= time() ?>" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
</head>
<body>
  <!-- Container -->
  <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
    <!-- Left Box -->
    <div class="box" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px; width: 400px; height: 500px;">
      <div class="logo">
        <img alt="Kiddoville Logo" height="40" src="<?= IMAGE ?>/logo_light.png" width="40" />
      </div>
      <div class="container-border">
        <div class="container-content">
          <h1>Phone Verification</h1>
          <form style="margin-top: 50px;" id="phone-form">
            <div class="input-box">
              <label class="label" for="phone">Phone Number<span id="red-star" class="red-star">*</span></label>
              <input id="phone" placeholder="Enter Your Phone Number" required type="tel" maxlength="10" />
              <p class="error" id="phone-error"></p>
            </div>
            <p style="color:grey; text-align: center; margin-bottom: 0px; margin-top: 30px; font-size: 14px;">
              Please enter the 10-digit phone number linked with your account.
            </p>
            <button style="margin-top: 20px;" type="submit">Verify Number</button>
          </form>
          <a class="forgot-password" href="<?=ROOT?>/Main/Login" style="padding: 0px 0px;margin-left: 120px;">
            <i class="fas fa-arrow-left"></i><strong>Back to Profile</strong>
          </a>
        </div>
      </div>
    </div>

    <!-- Right Box -->
    <div class="box"
      style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('<?= IMAGE ?>/side2.png');">
      <div class="home-contain">
        <i onclick="window.location.href='<?= ROOT ?>/Main/Home'" class="fa fa-home"></i>
      </div>
      <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Don't have your mobile with you</p>
                <p style="margin-top: -10px;">click to login using email</p>
                <button  onclick="window.location.href='<?=ROOT?>/Main/EnterEmail'" type="button" style="width:200px;margin-top: 20px;">Direct</button>
            </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const phoneInput = document.getElementById('phone');
      const form = document.getElementById('phone-form');
      const phoneError = document.getElementById('phone-error');
      const redstar = document.getElementById('red-star');

      phoneInput.addEventListener("input", function () {
        if (phoneInput.value.length === 0) {
          redstar.classList.remove('hidden');
        } else {
          redstar.classList.add('hidden');
        }
      });

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        let valid = true;

        const phone = phoneInput.value.trim();
        const phoneRegex = /^0\d{9}$/; // allows 10 digits starting with 0

        if (!phoneRegex.test(phone)) {
          phoneError.textContent = 'Please enter a valid 10-digit phone number starting with 0.';
          valid = false;
        }

        if (!valid) return;

        fetch('<?= ROOT ?>/Onbording/EnterNumber/StorePhone', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            phoneNumber: phone
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            console.log(data);
            window.location.href = '<?= ROOT ?>/Onbording/VerifyNumber'
          } else {
            console.log(data);
            if (data.errors && data.errors.length > 0) {
              phoneError.textContent = data.errors[0];
            } else {
              phoneError.textContent = 'An unknown error occurred.';
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          phoneError.textContent = 'Network or server error occurred.';
        });
      });
    });
  </script>
</body>
</html>
