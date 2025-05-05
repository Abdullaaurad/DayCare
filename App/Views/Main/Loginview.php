<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=CSS?>/Main/Login.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body  style="background-image: url('<?= IMAGE ?>/Login-bg.png');">
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div id="fade" class="box fade-out" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; transition: opacity 1s ease,transform 1s ease;">
            <div class="logo">
                <img src="<?=IMAGE?>/logo_light.png" alt="Logo">
            </div>
            <div class="container-border">
                <div class="container-cotent">
                    <h1>Welcome Back!</h1>
                    <form style="margin-top: 30px !important;" id="login-form" method="post">
                        <div class="input-box">
                            <label class="label" for="username">Username<span id="red-star" class="red-star <?php if (!empty($data['value']['uservalue'])) { echo 'hidden'; } ?>"> *</span></label>
                            <input type="text" name="Username" id="username" placeholder="Enter your Username" maxlength="20" value="<?php if (!empty($data['value']['uservalue'])) { echo $data['value']['uservalue']; } ?>" required>
                            <p class="error" id="username-error"><?php if (!empty($data['errors']['username'])) { echo $data['errors']['username']; } ?></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="password">Password<span id="red-star2" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input type="password" name="Password" id="password" placeholder="Enter your Password" maxlength="8" required>
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <p class="error" id="password-error"> <?php  if (!empty($data['errors']['password'])) { echo $data['errors']['password']; } ?> </p>
                        </div>
                        <div class="checkbox-remember-me">
                            <input type="checkbox" id="remember-me" style="margin-bottom: 7px;">
                            <label class="label" for="remember-me">Remember me</label>
                            <a class="forgot-password" href="<?=ROOT?>/Main/EnterEmail" style="margin-bottom: 5px;">Forgot your Password?</a>
                        </div>
                        <button type="submit">Login</button>
                        <div style="display: flex;align-items: center; margin-bottom: 0px; margin-top: -20px">
                            <hr>
                            <p>or, Login with Google</p>
                            <hr>
                        </div>
                        <button type="button" class="google-button" style="background-color: #fff;color: #333;border: 1px solid #ddd; justify-content: center; display: flex; flex-direction: row;">
                            <img src="<?=IMAGE?>/google.png" alt="Google Logo" style="margin-top: 2px;">
                            <p style="margin-top: 5px; margin-bottom: 2px;">Sign Up with Google</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- righ side design and signup -->
        <div id="move" class="box image" style="width: 400px; height: 500px;border-top-right-radius: 10px; border-bottom-right-radius: 10px;background: linear-gradient(135deg, #c0c0c0, #007bff, #a0a0a0); transition: transform 1s ease;">
            <div class="home-contain" style="background-color: white !important;">
                <i onclick="window.location.href='<?=ROOT?>/Main/Home'" class="fa fa-home"></i>
            </div>
            <div class="filter-box">
                <h2 style="color: white;">Hello, User</h2>
                <p style="color: white;">Enter your personal details and start journey with us</p>
                <button id="signup" type="button" style="width:200px;margin-top: 20px;">Request Meeting</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //signup animation
            const signup = document.getElementById('signup');
            const fade = document.getElementById('fade');
            const move = document.getElementById('move');

            setTimeout(() => {
                fade.classList.remove('fade-out');
                fade.classList.add('apear');
            }, 50);

            signup.addEventListener("click", function() {
                fade.classList.add("fade-out");
                setTimeout(()=> {
                    move.classList.add("shift-left");
                },100);
                fade.classList.add("fade-out");
                setTimeout(()=> {
                    window.location.href = '<?=ROOT?>/Main/Signup'
                },1000);
            });

            // required input
            const password = document.getElementById('password')
            const toggle = document.getElementById('togglePassword');
            const form = document.getElementById('login-form');
            const Username = document.getElementById('username');
            const Password = document.getElementById('password');
            const redstar = document.getElementById('red-star');
            const redstar2 = document.getElementById('red-star2');
            const UsernameError = document.getElementById('username-error');
            const PasswordError = document.getElementById('password-error');

            const updown = [Username, Password];

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

            Username.addEventListener("input",function(){
                if(Username.value.length === 0){
                    redstar.classList.remove('hidden');
                }else{
                    redstar.classList.add('hidden');
                }
                UsernameError.textContent = '';
            });

            Password.addEventListener("input",function(){
                PasswordError.textContent = '';
                if(Password.value.length === 0){
                    redstar2.classList.remove('hidden');
                }else{
                    redstar2.classList.add('hidden');
                }
            });

            toggle.addEventListener('click', function () {
                const isPasswordVisible = password.getAttribute('type') === 'text';
                password.setAttribute('type', isPasswordVisible ? 'password' : 'text');
                toggle.classList.toggle('fa-eye', isPasswordVisible);
                toggle.classList.toggle('fa-eye-slash', !isPasswordVisible);
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const Username = document.getElementById('username');
                const Password = document.getElementById('password');
                const UsernameError = document.getElementById('username-error');
                const PasswordError = document.getElementById('password-error');
                const invalidCharsRegex = /[^a-zA-Z0-9_-]/;
                const validPasswordRegex = /^[a-zA-Z0-9]+$/;

                UsernameError.textContent = '';
                PasswordError.textContent = '';

                let valid = true;
                if (Username.value.length < 3) {
                    UsernameError.textContent = 'Username must be at least 3 characters long';
                    valid = false;
                }
                if (invalidCharsRegex.test(Username.value)) {
                    UsernameError.textContent = 'Can\'t use special characters other than \'-\' or \'_\'';
                    valid = false;
                }
                if (Password.value.length > 12) {
                    PasswordError.textContent = 'Password must be less than equal to 12 characters long';
                    valid = false;
                }
                if (!validPasswordRegex.test(Password.value)) {
                    PasswordError.textContent = 'Only numbers and alphabets allowed';
                    valid = false;
                }
                if (valid) {
                    console.log('Form is valid. You can proceed with the login.');
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>