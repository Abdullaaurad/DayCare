<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= CSS ?>/Main/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body style="background-image: url('<?= IMAGE ?>/login-back.avif');">
    <!-- redirection for login -->
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div id="move" class="box" style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('<?= IMAGE ?>/side2.png'); transition: transform 1s ease;">
            <div class="home-contain">
                <i onclick="window.location.href='<?= ROOT ?>/main/home'" class="fa fa-home"></i>
            </div>
            <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Log In to Enhance Your Child's Care and Growth!</p>
                <button id="login" type="button" style="width:200px;margin-top: 20px;">Login</button>
            </div>
        </div>
        <!-- signup form -->
        <div id="fade" class="box apear"
            style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px;  transition: opacity 1s ease,transform 1s ease;">
            <div class="logo">
                <img src="<?= IMAGE ?>/logo_light.png" alt="Kiddoville Logo">
            </div>
            <div class="container-border">
                <div class="container-content">
                    <h1>Welcome</h1>
                    <form id="login-form" method="post">
                        <div class="input-box">
                            <label class="label" for="username">Username<span id="red-star" class="red-star <?php if (!empty($data['value']['uservalue'])) { echo 'hidden'; } ?>"> *</span></label>
                            <input type="text" name='Username' id="username" placeholder="Enter your username" maxlength="20" value ="<?php if (!empty($data['value']['uservalue'])) { echo $data['value']['uservalue']; } ?>" required>
                            <p class="error" id="username-error"><?php if(!empty($data['errors']['username'])) { echo $data['errors']['username']; }?></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="Password">Password<span id="red-star2" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input type="password" name='Password' id="password" placeholder="Enter your Password" maxlength="12" required>
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <p class="error" id="password-error"></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="confirm-password">Confirm Password<span id="red-star3" class="red-star">*</span></label>
                            <div class="password-group">
                                <input name="confirm-password" type="password" id="confirm-password" placeholder="Enter your Confirm password" maxlength="12" required>
                                <i class="fas fa-eye" id="toggle-confirm-Password"></i>
                            </div>
                            <p class="error" id="password-error2"></p>
                        </div>
                        <button id="enter" type="submit" style="margin-top: 20px;">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function tologin(){
            setTimeout(() => {
                form.style.display = 'none';
            }, 50);

            fade.classList.add("fade-out");
            setTimeout(() => {
                move.classList.add("shift-right");
            }, 100);
            setTimeout(() => {
                window.location.href = '<?= ROOT ?>/Main/Login'
            }, 1000);
        }

        // validation and animation
        document.addEventListener('DOMContentLoaded', function() {

            const login = document.getElementById('login');
            const fade = document.getElementById('fade');
            const move = document.getElementById('move');

            setTimeout(() => {
                fade.classList.remove('fade-out');
                fade.classList.add('apear');
            }, 50);

            login.addEventListener("click", function() {
                fade.classList.add("fade-out");
                setTimeout(() => {
                    move.classList.add("shift-right");
                }, 100);
                fade.classList.add("fade-out");
                setTimeout(() => {
                    window.location.href = '<?= ROOT ?>/Main/Login'
                }, 1000);
                fade.classList.add('apear');
            });

            const Password = document.getElementById('password')
            const confirmPassword = document.getElementById('confirm-password')
            const toggle = document.getElementById('togglePassword');
            const toggle2 = document.getElementById('toggle-confirm-Password');
            const form = document.getElementById('login-form');
            const Username = document.getElementById('username');
            const UsernameError = document.getElementById('username-error');
            const redstar = document.getElementById('red-star');
            const redstar2 = document.getElementById('red-star2');
            const redstar3 = document.getElementById('red-star3');
            const PasswordError = document.getElementById('password-error');
            const PasswordError2 = document.getElementById('password-error2');

            const updown = [Username, Password, confirmPassword];

            updown.forEach((input) => {
                input.addEventListener('keydown', function(event) {
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

            Username.addEventListener("input", function() {
                UsernameError.textContent = '';
                if (Username.value.length === 0) {
                    redstar.classList.remove('hidden');
                } else {
                    redstar.classList.add('hidden');
                }
            });

            Password.addEventListener("input", function() {
                PasswordError.textContent = '';
                if (Password.value.length === 0) {
                    redstar2.classList.remove('hidden');
                } else {
                    redstar2.classList.add('hidden');
                }
            });

            confirmPassword.addEventListener("input", function() {
                PasswordError2.textContent = '';
                if (confirmPassword.value.length === 0) {
                    redstar3.classList.remove('hidden');
                } else {
                    redstar3.classList.add('hidden');
                }
            });

            toggle.addEventListener('click', function() {
                // Toggle the password visibility
                const isPasswordVisible = Password.getAttribute('type') === 'text';
                Password.setAttribute('type', isPasswordVisible ? 'password' : 'text');
                toggle.classList.toggle('fa-eye', isPasswordVisible);
                toggle.classList.toggle('fa-eye-slash', !isPasswordVisible);
            });

            toggle2.addEventListener('click', function() {
                // Toggle the password visibility
                const isPasswordVisible2 = confirmPassword.getAttribute('type') === 'text';
                confirmPassword.setAttribute('type', isPasswordVisible2 ? 'password' : 'text');
                toggle2.classList.toggle('fa-eye', isPasswordVisible2);
                toggle2.classList.toggle('fa-eye-slash', !isPasswordVisible2);
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Re-fetch inputs and error elements to prevent variable duplication
                const UsernameError = document.getElementById('username-error');
                const PasswordError = document.getElementById('password-error');
                const PasswordError2 = document.getElementById('password-error2');

                UsernameError.textContent = '';
                PasswordError.textContent = '';
                PasswordError2.textContent = '';

                const invalidCharsRegex = /[^a-zA-Z0-9_-]/;

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
                    PasswordError.textContent = 'Password must be less than or equal to 12 characters';
                    valid = false;
                }
                if (confirmPassword.value.length > 12) {
                    PasswordError2.textContent = 'Password must be less than or equal to 12 characters';
                    valid = false;
                }
                if (Password.value !== confirmPassword.value) {
                    PasswordError2.textContent = 'The two passwords do not match';
                    valid = false;
                }

                if (valid) {
                    form.submit();
                    tologin();
                }
            });
        });
    </script>
</body>

</html>