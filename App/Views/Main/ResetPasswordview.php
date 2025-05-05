<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=CSS?>/Main/Change.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- just for design -->
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div class="box"
            style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('<?=IMAGE?>/side2.png');">
            <div class="home-contain">
                <i onclick="window.location.href='<?=ROOT?>/Main/Home'" class="fa fa-home"></i>
            </div>
            <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Reset Your Password and Get Back to Supporting Your Child's Development</p>
            </div>
        </div>
        <!-- set new password when loged in -->
        <div class="box"
            style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px;">
            <div class="logo">
                <img src="<?=IMAGE?>/logo_light.png" alt="Kiddoville Logo">
            </div>
            <div class="container-border">
                <div class="container-content">
                    <h1>Set new password</h1>
                    <form style="margin-top: 50px;" id="login-form">
                        <div class="input-box">
                            <label class="label" for="password">Password<span id="red-star" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input type="password" id="password" placeholder="Enter your Password" maxlength="6" required>
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <p class="error" id="password-error"></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="confirm-password">Confirm Password<span id="red-star2" class="red-star">
                                    *</span></label>
                            <div class="password-group">
                                <input type="password" id="confirm-password" placeholder="Enter your Confirm password" maxlength="6" required>
                                <i class="fas fa-eye" id="toggle-confirm-Password"></i>
                            </div>
                            <p class="error" id="password-error2"></p>
                        </div>
                        <p
                            style="color:grey; text-align: center; margin-bottom: 0px; margin-top: -10px; font-size: 14px;">
                            Must be least 6 characters long</p>
                        <button type="submit" style="margin-top: 20px;">Reset Password</button>
                    </form>
                    <a class="forgot-password" style="padding: 0px 0px;margin-left: 120px;" href="<?=ROOT?>/Main/Login"><i
                            class="fas fa-arrow-left"></i><strong>Back to Login</strong></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Password = document.getElementById('password')
            const confirmPassword = document.getElementById('confirm-password')
            const toggle = document.getElementById('togglePassword');
            const toggle2 = document.getElementById('toggle-confirm-Password');
            const form = document.getElementById('login-form');
            const redstar = document.getElementById('red-star');
            const redstar2 = document.getElementById('red-star2');

            const updown = [Password, confirmPassword];

            updown.forEach((input) => {
                input.addEventListener('keydown', function (event) {
                    if (event.key === 'ArrowUp') {
                        const prevInput = updown[updown.indexOf(this) - 1];
                        if (prevInput) {
                            prevInput.focus();
                        }
                    } else if (event.key === 'ArrowDown') {
                        const nextInput = updown[updown.indexOf(this) + 1];
                        if (nextInput) {
                            nextInput.focus();
                        }
                    }
                });
            });

            Password.addEventListener("input",function(){
                if(Password.value.length === 0){
                    redstar.classList.remove('hidden');
                }else{
                    redstar.classList.add('hidden');
                }
            });

            confirmPassword.addEventListener("input",function(){
                if(confirmPassword.value.length === 0){
                    redstar2.classList.remove('hidden');
                }else{
                    redstar2.classList.add('hidden');
                }
            });

            toggle.addEventListener('click', function () {
                // Toggle the password visibility
                const isPasswordVisible = Password.getAttribute('type') === 'text';
                Password.setAttribute('type', isPasswordVisible ? 'password' : 'text');
                toggle.classList.toggle('fa-eye', isPasswordVisible);
                toggle.classList.toggle('fa-eye-slash', !isPasswordVisible);
            });

            toggle2.addEventListener('click', function () {
                // Toggle the password visibility
                const isPasswordVisible2 = confirmPassword.getAttribute('type') === 'text';
                confirmPassword.setAttribute('type', isPasswordVisible2 ? 'password' : 'text');
                toggle2.classList.toggle('fa-eye', isPasswordVisible2);
                toggle2.classList.toggle('fa-eye-slash', !isPasswordVisible2);
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const Password = document.getElementById('password');
                const confirmPassword = document.getElementById('confirm-password')
                const PasswordError = document.getElementById('password-error');
                const PasswordError2 = document.getElementById('password-error2');
                const validPasswordRegex = /^[a-zA-Z0-9]+$/;

                PasswordError.textContent = '';

                let valid = true;
                if(Password.value !== confirmPassword.value){
                    PasswordError2.textContent = 'The two passwords are not matching';
                    valid = false;
                }
                if (Password.value.length !== 6) {
                    PasswordError.textContent = 'Password must be exactly 6 characters long';
                    valid = false;
                }
                if (!validPasswordRegex.test(Password.value)) {
                    PasswordError.textContent = 'Only numbers and alphabets allowed';
                    valid = false;
                }
                if (confirmPassword.value.length !== 6) {
                    PasswordError2.textContent = 'Password must be exactly 6 characters long';
                    valid = false;
                }
                if (!validPasswordRegex.test(confirmPassword.value)) {
                    PasswordError2.textContent = 'Only numbers and alphabets allowed';
                    valid = false;
                }
                if (valid) {
                    // console.log('Form is valid. You can proceed with the login.');
                    fetch('<?=ROOT?>/Main/ResetPassword/ChangePassword', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            password: Password.value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            window.location.href = '<?=ROOT?>/Main/Login';
                        } else {
                            PasswordError2.textContent = data.errors;
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
</body>

</html>