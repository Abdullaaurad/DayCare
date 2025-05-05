<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=CSS?>/Main/Change.css?v=<?= time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- change password when nown -->
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div class="box"
            style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px;background-image: url('<?=IMAGE?>/side2.png');">
            <div class="home-contain">
                <i onclick="window.location.href='<?=ROOT?>/Child/Home'" class="fa fa-home" style=""></i>
            </div>
            <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Enhance Your Account Security with a New Password</p>
            </div>
        </div>
        <!-- enter old and new password -->
        <div class="box"
            style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px;">
            <div class="logo">
                <img src="<?=IMAGE?>/logo_light.png" alt="Kiddoville Logo">
            </div>
            <div class="container-border">
                <div class="container-content">
                    <h1>Set new password</h1>
                    <form style="margin-top: 30px;" id="resert-form">
                        <div class="input-box">
                            <label class="label" for="old-password">Old Password<span  id="red-star" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input type="password" id="old-password" placeholder="Enter your Old Password" required>
                                <i class="fas fa-eye" id="toggle-old-Password"></i>
                            </div>
                            <p class="error" id="old-password-error"></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="password">Password<span  id="red-star2" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input type="password" id="password" placeholder="Enter your Password" required>
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                            <p class="error" id="password-error"></p>
                        </div>
                        <div class="input-box">
                            <label class="label" for="confirm-password">Confirm Password<span  id="red-star3" class="red-star">
                                    *</span></label>
                            <div class="password-group">
                                <input type="password" id="confirm-password" placeholder="Enter your Confirm password"
                                    required>
                                <i class="fas fa-eye" id="toggle-confirm-Password"></i>
                            </div>
                            <p class="error" id="password-error2"></p>
                        </div>
                        <button type="submit" style="margin-top: 20px;">Change Password</button>
                    </form>
                    <a class="forgot-password" style="margin-left: 120px;" href="#"><i
                            class="fas fa-arrow-left"></i><strong>Back to Profile</strong></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        // validation and input required
        document.addEventListener('DOMContentLoaded', function() {
            const old = document.getElementById('old-password');
            const Password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            const oldPassword = document.getElementById('old-password');
            const toggle = document.getElementById('togglePassword');
            const toggle2 = document.getElementById('toggle-confirm-Password');
            const toggle3 = document.getElementById('toggle-old-Password');
            const form = document.getElementById('resert-form');
            const redstar = document.getElementById('red-star');
            const redstar2 = document.getElementById('red-star2');
            const redstar3 = document.getElementById('red-star3');

            const updown = [old, Password, confirmPassword];

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

            old.addEventListener("input",function(){
                if(old.value.length === 0){
                    redstar.classList.remove('hidden');
                }else{
                    redstar.classList.add('hidden');
                }
            });

            Password.addEventListener("input",function(){
                if(Password.value.length === 0){
                    redstar2.classList.remove('hidden');
                }else{
                    redstar2.classList.add('hidden');
                }
            });

            confirmPassword.addEventListener("input",function(){
                if(confirmPassword.value.length === 0){
                    redstar3.classList.remove('hidden');
                }else{
                    redstar3.classList.add('hidden');
                }
            });

            toggle.addEventListener('click', function () {
                const isPasswordVisible = Password.getAttribute('type') === 'text';
                Password.setAttribute('type', isPasswordVisible ? 'password' : 'text');
                toggle.classList.toggle('fa-eye', isPasswordVisible);
                toggle.classList.toggle('fa-eye-slash', !isPasswordVisible);
            });

            toggle2.addEventListener('click', function () {
                const isPasswordVisible2 = confirmPassword.getAttribute('type') === 'text';
                confirmPassword.setAttribute('type', isPasswordVisible2 ? 'password' : 'text');
                toggle2.classList.toggle('fa-eye', isPasswordVisible2);
                toggle2.classList.toggle('fa-eye-slash', !isPasswordVisible2);
            });

            toggle3.addEventListener('click', function () {
                const isPasswordVisible3 = oldPassword.getAttribute('type') === 'text';
                oldPassword.setAttribute('type', isPasswordVisible3 ? 'password' : 'text');
                toggle3.classList.toggle('fa-eye', isPasswordVisible3);
                toggle3.classList.toggle('fa-eye-slash', !isPasswordVisible3);
            });


            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const Password = document.getElementById('password');
                const confirmPassword = document.getElementById('confirm-password')
                const oldPassword = document.getElementById('old-password')
                const OldPasswordError = document.getElementById('old-password-error');
                const PasswordError = document.getElementById('password-error');
                const PasswordError2 = document.getElementById('password-error2');
                const validPasswordRegex = /^[a-zA-Z0-9]+$/;

                OldPasswordError.textContent = '';
                PasswordError.textContent = '';
                PasswordError2.textContent = '';

                let valid = true;
                if (oldPassword.value.length !== 6) {
                    OldPasswordError.textContent = 'Password must be exactly 6 characters long';
                    valid = false;
                }
                if (!validPasswordRegex.test(oldPassword.value)) {
                    OldPasswordError.textContent = 'Only numbers and alphabets allowed';
                    valid = false;
                }
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
                    const requestbody = JSON.stringify({ old: oldPassword.value, new: Password.value })
                    fetch('<?=ROOT?>/Main/ResetPasswordNown/changepassword', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: requestbody
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.errors && data.errors.length > 0) {
                            // Iterate over the errors array and display them

                            data.errors.forEach(error => {
                                if (error.includes('old')) {
                                    OldPasswordError.textContent = error;
                                } else if (error.includes('new')) {
                                    oldPassword = oldPassword.value;
                                    PasswordError.textContent = error;
                                }
                            });
                        }
                        else{
                            console.log('Redirecting to login page');
                            window.location.replace('<?=ROOT?>/Main/Login'); // Use replace instead of href
                        }
                    })
                    .catch(error => console.error("Error:", error));
                }
            });
        });
    </script>
</body>

</html>