<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Onbording.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Onbording/Number.js"></script>
    <!-- <script src="<?= JS ?>/Onbording/parent.js"></script> -->

    <style>
        .errorl {
            color: red !important;
            margin-left: 0px !important;
            font-size: 15px;
            margin-top: 0px;
            margin-bottom: -10px;
        }
    </style>
</head>

<body>
    <div class="Profilecard">
        <div
            style="background-color: #60a6ec; width: 350px; height: 600px; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
            <img src="<?= IMAGE ?>/logo_light-remove.png" style="width:70px">
            <div class="heading">
                <h1>Let's Create Your</h1>
                <h1>Personalized</h1>
                <h1>Profile for a</h1>
                <h1>Tailored</h1>
                <h1>Experience!</h1>
            </div>
            <div class="text">
                <p> Share your details for a smooth</p>
                <p>and safe Daycare Experience</p>
            </div>
            <div class="circles">
                <div class="circle select"></div>
                <div class="circle"></div>
                <div class="circle"></div>
            </div>
        </div>
        <div class="ProfileContainer" style="flex-direction: column !important;">
            <form method="post" id="details" enctype="multipart/form-data">
                <h2> Let's Get Started</h2>
                <div class="hori">
                    <div class="datacon">
                        <div class="data">
                            <label>First Name <span id="red-star" class="red-star"> *</span></label>
                            <input name="First_Name" style="width: 200px;" required placeholder="Abdulla" type="text" id="firstname"
                                value="<?php if (!empty($data['values']['First_Name'])) {
                                            echo $data['values']['First_Name'];
                                        } ?>">
                            <?php if (!empty($data['errors']['First_Name'])): ?>
                                <p class="errorl" id="firstname-error">
                                    <?php echo $data['errors']['First_Name']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="data">
                            <label>User Name </label>
                            <input name="Username" style="width: 200px;" readonly value="<?php if (isset($data['username'])) {
                                                                                                echo $data['username'];
                                                                                            } ?>" type="text" id="username">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Last Name <span id="red-star3" class="red-star"> *</span> </label>
                            <input name="Last_Name" style="width: 200px;" placeholder="Aurad" type="text" id="lastname"
                                value="<?php if (!empty($data['values']['Last_Name'])) {
                                            echo $data['values']['Last_Name'];
                                        } ?>">
                            <?php if (!empty($data['errors']['Last_Name'])): ?>
                                <p class="errorl" id="lastname-error">
                                    <?php echo $data['errors']['Last_Name']; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="data">
                            <label>Phone Number <span id="red-star4" class="red-star"> *</span></label>
                            <input name="Phone_Number" style="width: 200px;" class="number"
                            placeholder="<?php 
                                echo htmlspecialchars(
                                    isset($_SESSION['APP']['CONTACT_VARIFIED'], $_SESSION['APP']['NUMBER']) && $_SESSION['APP']['CONTACT_VARIFIED']
                                        ? $_SESSION['APP']['NUMBER']
                                        : '0712345678'
                                ); 
                            ?>"
                            type="text" id="number" maxlength="12"
                                value="<?php if (!empty($data['values']['Phone_Number'])) {
                                            echo $data['values']['Phone_Number'];
                                        } ?>">
                            <p class="edit" id="verifyEmail" onclick="window.location.href='<?=ROOT?>/Onbording/EnterNumber'" style="cursor: pointer; margin-left: 160px; margin-top: 75px;"> Verify</p>
                        </div>
                    </div>
                    <span id="red-star5" class="red-star" style="margin-right: -40px;"> *</span>
                    <div class="datacon imagecon" id="image-bg" <?php if (!empty($data['values']['profile_image_base64'])): ?>
                            style="background-image: url('<?= $data['values']['profile_image_base64'] ?>'); background-size: cover;"
                        <?php endif; ?>
                    >
                    <input 
                            type="file" 
                            name="profile_image" 
                            id="image" 
                            accept="image/*" 
                            style="display: none"
                            <?= empty($data['values']['profile_image_base64']) ? 'required' : '' ?>
                        >
                        <i class="fa fa-add" id="image-icon" style="font-size:30px; cursor: pointer; border-radius: 30px; padding: 10px 12px; border: 2px solid black; background-color: white;"></i>
                    </div>
                </div>
                <div class="datacon">
                    <div class="data">
                        <label>Address <span id="red-star6" class="red-star"> *</span></label>
                        <input name="Address" style="width: 650px;" required placeholder="Abdulla" type="text" id="address"
                            value="<?php if (!empty($data['values']['Address'])) {
                                        echo $data['values']['Address'];
                                    } ?>">
                    </div>
                </div>
                <div class="datacon" style="flex-direction: row !important;">
                    <div class="data">
                        <label>NID <span id="red-star7" class="red-star"> *</span></label>
                        <input name="NID" style="width: 308px;" class="number" required placeholder="200232901776" type="text" maxlength="12" id="nid"
                            value="<?php if (!empty($data['values']['NID'])) {
                                        echo $data['values']['NID'];
                                    } ?>">
                        <?php if (!empty($data['errors']['NID'])): ?>
                            <p class="errorl" id="nid-error">
                                <?php echo $data['errors']['NID']; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="data">
                        <label>Email <span id="red-star8" class="red-star"> *</span></label>
                        <input name="Email" style="width: 308px;" required 
                                value="<?php if (!empty($data['values']['Email'])) {
                                        echo $data['values']['Email'];
                                    } ?>"
                            placeholder="<?php 
                                echo htmlspecialchars(
                                    isset($_SESSION['APP']['EMAIL_VARIFIED'], $_SESSION['APP']['EMAIL']) && $_SESSION['APP']['EMAIL_VARIFIED']
                                        ? $_SESSION['APP']['EMAIL'] 
                                        : 'lol@gmail.com'
                                ); 
                            ?>"
                            type="text" id="email">
                        <p class="edit" id="verifyEmail" onclick="window.location.href='<?=ROOT?>/Onbording/EnterEmail'" style="cursor: pointer; margin-left: 270px; margin-top: 75px;"> Verify</p>
                        <?php if (!empty($data['errors']['Email'])): ?>
                            <p class="errorl" id="email-error">
                                <?php echo $data['errors']['Email']; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="datacon" style="flex-direction: row !important;">
                    <div class="data">
                        <label>Gender <span id="red-star9" class="red-star"> *</span></label>
                        <select name="Gender" style="width: 323px;">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                            <option value="O">Other</option>
                        </select> 
                    </div>
                    <div class="data">
                        <label>Language Preference <span id="red-star10" class="red-star"> *</span> </label>
                        <select name="Language" style="width: 323px;">
                            <option>English</option>
                            <option>Tamil</option>
                            <option>Sinhala</option>
                        </select>
                    </div>
                </div>
                <div class="datacon" style="flex-direction: row; justify-content:flex-end; margin-right: 20px;">
                    <div class="data">
                        <button id="add-btn" type="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important;">Add Children<i class="fa fa-chevron-right" style="margin-left: 4px;"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // To get Parents image
            const imageicon = document.getElementById('image-icon');
            const image = document.getElementById('image');
            const imagebg = document.getElementById('image-bg');

            //imageicon.addEventListener('click', function() {
            //    image.click();
            //})

            image.addEventListener('input', function(event) {
                const file = event.target.files[0];
                if (file) {
                    redstar5.classList.add('hidden');
                    const imageUrl = URL.createObjectURL(file);
                    imagebg.style.backgroundImage = `url('${imageUrl}')`;
                } else {
                    redstar5.classList.remove('hidden');
                }
            })

            //To represent required inputs
            const redstar = document.getElementById('red-star');
            const redstar2 = document.getElementById('red-star2');
            const redstar3 = document.getElementById('red-star3');
            const redstar4 = document.getElementById('red-star4');
            const redstar5 = document.getElementById('red-star5');
            const redstar6 = document.getElementById('red-star6');
            const redstar7 = document.getElementById('red-star7');
            const redstar8 = document.getElementById('red-star8');
            const redstar9 = document.getElementById('red-star9');
            const redstar10 = document.getElementById('red-star10');

            const firstname = document.getElementById('firstname');
            const firstnameError = document.getElementById('firstname-error');
            const username = document.getElementById('username');
            const lastname = document.getElementById('lastname');
            const lastnameError = document.getElementById('lastname-error');
            const number = document.getElementById('number');
            const address = document.getElementById('address');
            const nid = document.getElementById('nid');
            const nidError = document.getElementById('nid-error');
            const email = document.getElementById('email');
            const emailError = document.getElementById('email-error');

            const numberInput = document.querySelector('.number');

            numberInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '');
            });

            email.addEventListener('input', function() {
                if (!email.value) {
                    redstar8.classList.remove('hidden');
                } else {
                    redstar8.classList.add('hidden');
                }
                if (emailError) { // Check if emailError exists in the DOM
                    emailError.style.display = 'none'; // Hide the error
                    emailError.textContent = ''; // Clear the error message
                }
            })

            address.addEventListener('input', function() {
                if (!address.value) {
                    redstar6.classList.remove('hidden');
                } else {
                    redstar6.classList.add('hidden');
                }
            })

            nid.addEventListener('input', function() {
                if (!nid.value) {
                    redstar7.classList.remove('hidden');
                } else {
                    redstar7.classList.add('hidden');
                }
                nidError.textContent = '';
            })

            number.addEventListener('input', function() {
                if (!number.value) {
                    redstar4.classList.remove('hidden');
                } else {
                    redstar4.classList.add('hidden');
                }
            })

            firstname.addEventListener('input', function() {
                if (!firstname.value) {
                    redstar.classList.remove('hidden');
                } else {
                    redstar.classList.add('hidden');
                }
                firstnameError.textContent = '';
            })

            username.addEventListener('input', function() {
                if (!username.value) {
                    redstar2.classList.remove('hidden');
                } else {
                    redstar2.classList.add('hidden');
                }
            })

            lastname.addEventListener('input', function() {
                if (!lastname.value) {
                    redstar3.classList.remove('hidden');
                } else {
                    redstar3.classList.add('hidden');
                }
                lastnameError.textContent = '';
            })

            document.getElementById('add-btn').addEventListener('click', function(event) {
                // event.preventDefault(); // Prevents the form's default submit behavior

                // Log each form field's value for debugging
                const form = document.getElementById('details');
                const formData = new FormData(form);
                formData.forEach((value, key) => {
                    console.log(`${key}: ${value}`);
                });
            });

            // Trigger file input when icon is clicked
            document.getElementById('image-icon').addEventListener('click', () => {
                document.getElementById('image').click();
            });

        });
    </script>
</body>

</html>