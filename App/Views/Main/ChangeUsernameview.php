<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title> Change Username </title>
  <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= CSS ?>/Main/Change.css?v=<?= time() ?>" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&amp;display=swap" rel="stylesheet" />
</head>

<body>
  <!-- left side of continer -->
  <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
    <div class="box"
      style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('<?= IMAGE ?>/side2.png');">
      <div class="home-contain">
        <i onclick="window.location.href='<?= ROOT ?>/Main/Home'" class="fa fa-home" style=""></i>
      </div>
      <div class="filter-box">
        <h2>Hello, user</h2>
        <p>Update Your Profile and Unlock a World of Learning for Your Child!</p>
      </div>
    </div>
    <div class="box"
      style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px;">
      <div class="logo">
        <img alt="Kiddoville Logo" height="40" src="<?= IMAGE ?>/logo_light.png" width="40" />
      </div>
      <!-- form to change username -->
      <div class="container-border">
        <div class="container-content">
          <h1>
            Change Username
          </h1>
          <form style="margin-top: 50px;" id="login-form">
            <div class="input-box">
              <label class="label" for="username">User Name<span id="red-star" class="red-star">*</span></label>
              <input id="username" placeholder="Enter New User Name" required="" type="text" />
              <p class="error" id="username-error"></p>
            </div>
            <p style="color:grey; text-align: center; margin-bottom: 0px; margin-top: 30px; font-size: 14px;">
              Please choose a unique username that has not been previously used</p>
            <button style="margin-top: 20px;" type="submit">Change User Name</button>
          </form>
          <a class="forgot-password" href="#" style="padding: 0px 0px;margin-left: 120px;"><i
              class="fas fa-arrow-left"></i><strong>Back to Profile</strong></a>
        </div>
      </div>
    </div>
  </div>
  <script>
    // check username
    document.addEventListener('DOMContentLoaded', function() {
      const Username = document.getElementById('username');
      const form = document.getElementById('login-form');
      const UsernameError = document.getElementById('username-error');
      const redstar = document.getElementById('red-star');

      Username.addEventListener("input", function() {
        if (Username.value.length === 0) {
          redstar.classList.remove('hidden');
        } else {
          redstar.classList.add('hidden');
        }
      });

      // username validation
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        valid = true;

        const invalidCharsRegex = /[^a-zA-Z0-9_-]/;

        if (Username.value.length < 3) {
          UsernameError.textContent = 'Username must be at least 3 characters long';
          valid = false;
        }
        if (invalidCharsRegex.test(Username.value)) {
          UsernameError.textContent = 'Can\'t use special characters other than \'-\' or \'_\'';
          valid = false;
        }
        if (!valid) return;

        // Send data to PHP controller
        fetch('<?= ROOT ?>/Main/changeUsername/changename', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              name: Username.value
            })
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert(data.message);
              setTimeout(() => {
                window.location.href = '<?=ROOT?>/Main/Login';
              }, 2000);
            } else {
              if (data.errors && data.errors.length > 0) {
                UsernameError.textContent = data.errors[0];
              } else {
                UsernameError.textContent = 'An unknown error occurred.';
              }
            }
          })
          .catch(error => {
            console.error('Error:', error);
            UsernameError.textContent = 'Network or server error occurred.';
          });
      });

    });
  </script>
</body>

</html>