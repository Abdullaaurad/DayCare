<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2-Step Verification</title>
    <link rel="icon" href="../../Assets/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=CSS?>/Main/Change.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- verfication for contact -->
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div class="box" id="move"
            style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('../Assets/side2.png'); transition: transform 1s ease;">
            <div class="home-contain">
                <i onclick="window.location.href='../../Home/Landing/Landing.html'" class="fa fa-home" style=""></i>
            </div>
            <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Can't access your email</p>
                <p style="margin-top: -10px;">click to login using mobile</p>
                <button onclick="window.location.href='./Reset-password-number.html'" type="button" style="width:200px;margin-top: 20px;">Direct</button>
            </div>
        </div>
        <!-- email verfication -->
        <div class="box fade-out" id="fade"
            style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px; transition: opacity 1s ease,transform 1s ease;">
            <div class="logo">
                <img src="../Assets/logo_light.png" alt="Kiddo Ville Logo">
            </div>
            <div class="container-border">
                <div class="container-content">
                    <h1>2-Step Verification</h1>
                    <p style="text-align: center; padding: 0px 28px ">We sent a code to
                        <strong>abdullaaurad@gmail.com</strong> Enter code to authorize login</p>
                    <form id="otp-form" style="margin-top: 40px; margin-bottom: 40px;">
                        <div class="code-inputs">
                            <input type="text" id="code1" maxlength="1" value="2">
                            <input type="text" id="code2" maxlength="1" value="5">
                            <input type="text" id="code3" maxlength="1" value="8">
                            <input type="text" id="code4" maxlength="1">
                        </div>
                        <p class="error" id="otp-error"></p>
                        <button style="margin-top: 20px;" type="submit">Continue</button>
                        <p style="margin-top: -10px; font-size: 13px; padding: 0px 22px; text-align: center;">didn't
                            receive the code <a class="forgot-password" style="margin: 0px 0px;" href="#"><strong>click
                                    here</strong></a> to resend code</p>
                        <a class="forgot-password" style="padding: 0px 0px;margin-left: 120px; color:#8136F3" id="email"><strong>Change Email</strong></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // animation
        document.addEventListener('DOMContentLoaded', function () {
            const email = document.getElementById('email');
            const fade = document.getElementById('fade');
            const move = document.getElementById('move');

            setTimeout(() => {
                fade.classList.remove('fade-out');
                fade.classList.add('apear');
            }, 50);

            email.addEventListener("click", function (event) {
                event.preventDefault();
                fade.classList.add("fade-out");
                setTimeout(() => {
                    move.classList.add("shift-right");
                }, 100);
                fade.classList.add("fade-out");
                setTimeout(() => {
                    window.location.href = './Reset-password-email.html'
                }, 1000);
            });

            // required details for form
            const code1 = document.getElementById('code1');
            const code2 = document.getElementById('code2');
            const code3 = document.getElementById('code3');
            const code4 = document.getElementById('code4');
            const otp = document.getElementById('otp-error');
            const form = document.getElementById('otp-form');

            const otpInputs = [code1, code2, code3, code4];

            otpInputs.forEach((input) => {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '').slice(-1);
                });

                input.addEventListener('keydown', function (event) {
                    if (event.key === 'ArrowRight') {
                        const nextInput = otpInputs[otpInputs.indexOf(this) + 1];
                        if (nextInput) {
                            nextInput.focus();
                        }
                    } else if (event.key === 'ArrowLeft') {
                        const prevInput = otpInputs[otpInputs.indexOf(this) - 1];
                        if (prevInput) {
                            prevInput.focus();
                        }
                    }
                });
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                if (code1.value !== '1' || code2.value !== '2' || code3.value !== '3' || code4.value !== '4') {
                    otp.textContent = 'OTP doesn\'t match';
                }
            });
        });
    </script>
</body>

</html>