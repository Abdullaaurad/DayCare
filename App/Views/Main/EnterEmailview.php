<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Email Verification</title>
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
          <h1>Email Verification</h1>
          <form style="margin-top: 50px;" id="email-form">
            <div class="input-box">
              <label class="label" for="email">Email Address<span id="red-star" class="red-star">*</span></label>
              <input id="email" placeholder="Enter Your Email"  required type="email" />
              <p class="error" id="email-error"></p>
            </div>
            <p style="color:grey; text-align: center; margin-bottom: 0px; margin-top: 30px; font-size: 14px;">
              Please enter the email associated with your account to verify your identity.
            </p>
            <button style="margin-top: 20px;" type="submit">Verify Email</button>
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
        <p>Can't access your email</p>
        <p style="margin-top: -10px;">click to login using mobile</p>
        <button onclick="window.location.href='<?=ROOT?>/Main/EnterNumber'" type="button" style="width:200px;margin-top: 20px;">Direct</button>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const Email = document.getElementById('email');
      const form = document.getElementById('email-form');
      const EmailError = document.getElementById('email-error');
      const redstar = document.getElementById('red-star');

      Email.addEventListener("input", function () {
        if (Email.value.length === 0) {
          redstar.classList.remove('hidden');
        } else {
          redstar.classList.add('hidden');
        }
      });

      form.addEventListener('submit', function (event) {
        event.preventDefault();
        let valid = true;

        // Simple email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(Email.value)) {
          EmailError.textContent = 'Please enter a valid email address';
          valid = false;
        }

        if (!valid) return;

        fetch('<?= ROOT ?>/Main/EnterEmail/StoreEmail', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            email: Email.value
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
              window.location.href = '<?= ROOT ?>/Main/EmailLogin';
          } else {
            if (data.errors && data.errors.length > 0) {
              EmailError.textContent = data.errors[0];
            } else {
              console.error('Unknown error:', data);
              EmailError.textContent = 'An unknown error occurred.';
            }
          }
        })
        .catch(error => {
          console.error('Error:', error);
          EmailError.textContent = 'Network or server error occurred.';
        });
      });
    });
  </script>
</body>
</html>
