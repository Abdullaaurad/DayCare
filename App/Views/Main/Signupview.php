<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= CSS ?>/Main/Login.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/meeting.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body style="background-image: url('<?= IMAGE ?>/Login-bg.png');">
    <!-- redirection for login -->
    <div class="container" style="display: flex; justify-content: center; margin-top: 20px;">
        <div id="move" class="box" style="width: 400px; height: 500px;border-top-right-radius: 10px; border-bottom-right-radius: 10px;background: linear-gradient(135deg, #c0c0c0, #007bff, #a0a0a0); transition: transform 1s ease;">
            <div class="home-contain">
                <i onclick="window.location.href='<?= ROOT ?>/main/home'" class="fa fa-home"></i>
            </div>
            <div class="filter-box">
                <h2>Hello, user</h2>
                <p>Log In to Enhance Your Child's Care and Growth!</p>
                <button id="login" type="button" onclick="window.location.href='Login';" style="width:200px;margin-top: 20px;">Login</button>
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
                    <h1 style="margin-top: 20px; margin-bottom: 30px;">Welcome</h1>

                    <p class="error"> <?= isset($data['errors']['request']) ? $data['errors']['request'] : '' ?> </p>
                    <form id="signup-form" method="post">
                        <div class="input-box">
                            <label class="label" for="name">Name<span id="red-star1" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input
                                    type="text"
                                    name="Name"
                                    id="name"
                                    placeholder="Enter your Name"
                                    maxlength="40"
                                    required
                                    value="<?= isset($data['inputs']['Name']) ? htmlspecialchars($data['inputs']['Name']) : '' ?>">
                            </div>
                            <p class="error" id="error-Name"><?= isset($data['errors']['Name']) ? $data['errors']['Name'] : '' ?></p>
                        </div>

                        <div class="input-box">
                            <label class="label" for="NIC">NIC<span id="red-star2" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input
                                    type="text"
                                    name="NIC"
                                    id="NIC"
                                    placeholder="Enter your NIC"
                                    maxlength="12"
                                    required
                                    value="<?= isset($data['inputs']['NIC']) ? htmlspecialchars($data['inputs']['NIC']) : '' ?>">
                            </div>
                            <p class="error" id="error-NIC"><?= isset($data['errors']['NIC']) ? $data['errors']['NIC'] : '' ?></p>
                        </div>

                        <div class="input-box">
                            <label class="label" for="Email">Email<span id="red-star3" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input
                                    type="email"
                                    name="Email"
                                    id="Email"
                                    placeholder="Enter your Email"
                                    maxlength="40"
                                    required
                                    value="<?= isset($data['inputs']['Email']) ? htmlspecialchars($data['inputs']['Email']) : '' ?>">
                            </div>
                            <p class="error" id="error-Email"><?= isset($data['errors']['Email']) ? $data['errors']['Email'] : '' ?></p>
                        </div>

                        <div class="input-box">
                            <label class="label" for="Contact">Contact<span id="red-star4" class="red-star"> *</span></label>
                            <div class="password-group">
                                <input
                                    type="text"
                                    name="Contact"
                                    id="Contact"
                                    placeholder="Enter your Contact"
                                    maxlength="10"
                                    required
                                    value="<?= isset($data['inputs']['Contact']) ? htmlspecialchars($data['inputs']['Contact']) : '' ?>">
                            </div>
                            <p class="error" id="error-Contact"><?= isset($data['errors']['Contact']) ? $data['errors']['Contact'] : '' ?></p>
                        </div>

                        <button type="submit">Request Meeting</button>
                    </form>

                </div>
            </div>
        </div>
        
    <div class="verification-alert" id="alert" style="top: 10%; display:none;">
        <div class="alert-icon">
            <img src="<?= IMAGE ?>/success.svg" id="alert-img" alt="success icon">
        </div>
        <div class="alert-message">
            <h1 id="alert-message">Request Sent</h1>
        </div>
    </div>
    </div>
    
    <script>
        function tologin() {
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

            var successMessage = '<?php echo $data['success']; ?>';
        
            // Check if success message is set
            if (successMessage === 'Request submitted successfully.') {
                // Show the success alert
                var alertElement = document.getElementById('alert');
                alertElement.style.display = 'block'; // Show the alert
                
                // Optionally, change the message text if you want
                document.getElementById('alert-message').textContent = 'Success!';

                // Hide the alert after 2 seconds (2000ms)
                setTimeout(function () {
                    alertElement.style.display = 'none'; // Hide the alert after 2 seconds
                }, 2000);
            }

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
                setTimeout(() => {
                    window.location.href = '<?= ROOT ?>/Main/Login'
                }, 1000);
            });

            const nameInput = document.getElementById('name');
            const NICInput = document.getElementById('NIC');
            const emailInput = document.getElementById('Email');
            const contactInput = document.getElementById('Contact');

            const redStar1 = document.getElementById('red-star1');
            const redStar2 = document.getElementById('red-star2');
            const redStar3 = document.getElementById('red-star3');
            const redStar4 = document.getElementById('red-star4');

            const errorNIC = document.getElementById('error-NIC');
            const errorEmail = document.getElementById('error-Email');
            const errorContact = document.getElementById('error-Contact');

            // Function to toggle red stars based on input value
            function toggleRedStar(input, starElement) {
                if (input.value.trim() === '') {
                    starElement.classList.remove('hidden');
                } else {
                    starElement.classList.add('hidden');
                }
            }

            // Function to clear error messages dynamically
            function clearErrorOnInput(input, errorElement) {
                input.addEventListener('input', function() {
                    if (input.value.trim() !== '') {
                        errorElement.textContent = ''; // Clear the error message
                    }
                });
            }

            // Initially check for empty inputs to show the red stars
            toggleRedStar(nameInput, redStar1);
            toggleRedStar(NICInput, redStar2);
            toggleRedStar(emailInput, redStar3);
            toggleRedStar(contactInput, redStar4);

            // Add input event listeners to toggle red stars
            nameInput.addEventListener('input', () => toggleRedStar(nameInput, redStar1));
            NICInput.addEventListener('input', () => toggleRedStar(NICInput, redStar2));
            emailInput.addEventListener('input', () => toggleRedStar(emailInput, redStar3));
            contactInput.addEventListener('input', () => toggleRedStar(contactInput, redStar4));

            // Clear error messages as the user types
            clearErrorOnInput(NICInput, errorNIC);
            clearErrorOnInput(emailInput, errorEmail);
            clearErrorOnInput(contactInput, errorContact);

            // Validate contact number (only numbers allowed)
            contactInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            });

            // Validate NIC (exactly 12 numbers)
            NICInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
                if (this.value.length > 12) {
                    this.value = this.value.slice(0, 12); // Ensure NIC is exactly 12 digits
                }
            });

            // Handle form submission
            const form = document.getElementById('signup-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent default form submission

                // Check if the fields are empty before submitting
                toggleRedStar(nameInput, redStar1);
                toggleRedStar(NICInput, redStar2);
                toggleRedStar(emailInput, redStar3);
                toggleRedStar(contactInput, redStar4);

                // Proceed with form submission if all fields are filled
                if (nameInput.value.trim() && NICInput.value.trim() && emailInput.value.trim() && contactInput.value.trim()) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>