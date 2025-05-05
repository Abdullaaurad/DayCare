<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?=CSS?>/Main/Change.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div class="box" id="move"
            style="width: 400px; height: 500px; border-top-left-radius: 10px; border-bottom-left-radius: 10px; background-image: url('<?=IMAGE?>/side2.png'); transition: transform 1s ease;">
            <div class="home-contain">
                <i onclick="window.location.href='<?=ROOT?>/Main/Landing'" class="fa fa-home"></i>
            </div>
            <div class="filter-box">
                <h2>Hello, User</h2>
                <p>Confirm your new email</p>
                <p style="margin-top: -10px;">Enter the code sent to your new email address</p>
            </div>
        </div>
        <div class="box fade-out" id="fade"style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;width: 400px;height: 500px; transition: opacity 1s ease,transform 1s ease;">
            <div class="logo">
                <img src="<?=IMAGE?>/logo_light.png" alt="Kiddo Ville Logo">
            </div>
            <div class="container-border">
                <div class="container-content">
                    <h1>Email Verification</h1>
                    <p style="text-align: center; padding: 0px 28px ">
                        Please enter the code <strong><?=$data['Email'] ?></strong>. to verify your email change.</p>
                    <form id="otp-form" style="margin-top: 40px; margin-bottom: 40px;">
                        <div class="code-inputs">
                            <input type="text" name="code1" id="code1" maxlength="2" placeholder="2" required>
                            <input type="text" id="code2" name="code2" maxlength="2" placeholder="5" required>
                            <input type="text" id="code3" name="code3" maxlength="2" placeholder="8" required>
                            <input type="text" id="code4" name="code4" maxlength="2" required>
                        </div>
                        <p class="error" id="otp-error" style="margin-bottom: -10px;"></p>
                        <button style="margin-top: 20px;" id="email" type="submit">Verify Email</button>
                        <p style="margin-top: -10px; font-size: 13px; padding: 0px 22px; text-align: center;">Didn't receive the code? <a class="forgot-password" style="margin: 0px 0px;" href="#" onclick="window.location.reload();"><strong>Click here</strong></a> to resend</p>
                        <a class="forgot-password" style="padding: 0px 0px;margin-left: 100px; color:#8136F3" href="<?=ROOT?>/Parent/ParentEditProfile"><strong>Use Different Email</strong></a>
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

            fade.classList.remove('fade-out');
            fade.classList.add('apear');

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

            document.getElementById('otp-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting the normal way

                // Get the OTP values from the input fields
                const code1 = document.getElementById('code1').value.trim();
                const code2 = document.getElementById('code2').value.trim();
                const code3 = document.getElementById('code3').value.trim();
                const code4 = document.getElementById('code4').value.trim();
                
                // Concatenate the OTP values
                const otpEntered = code1 + code2 + code3 + code4;
                console.log(otpEntered);

                // Check if all input fields are filled
                if (otpEntered.length === 4) {
                    // Send the OTP to the backend via AJAX using fetch
                    fetch('<?=ROOT?>/Onbording/VerifyEmail/verify', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            otp: otpEntered // Send the OTP entered by the user
                        })
                    })
                    .then(response => response.json()) // Parse the JSON response
                    .then(data => {
                        if (data.success) {
                            // OTP is correct, proceed further
                            window.location.href = '<?=ROOT?>/Onbording/ParentUser'; // Redirect to dashboard or next page
                        } else {
                            // OTP is incorrect, show error
                            document.getElementById('otp-error').innerText = data.message;
                            document.getElementById('otp-error').style.display = 'block';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('otp-error').innerText = 'An error occurred. Please try again later.';
                        document.getElementById('otp-error').style.display = 'block';
                    });
                } else {
                    // Show error if OTP is not complete
                    document.getElementById('otp-error').innerText = 'Please enter a valid 4-digit OTP.';
                    document.getElementById('otp-error').style.display = 'block';
                }
            });
        });
    </script>
</body>

</html>