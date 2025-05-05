<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?=CSS?>/Parent/profile.css?v=<?= time() ?>">
    <script src="<?=JS?>/Parent/Number.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="Profilecard">
        <div class="Profile">
            <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer;"
                onclick="window.location.href='<?=ROOT?>/Parent/Home'">My Profile
                <span style="margin-left: 10px;"> > </span>
                <span style="margin-left: 10px; color: rgba(35, 83, 167, 1);"> Edit Profile</span>
            </p>
            <div class="refresh-con">
                <i class="fas fa-refresh" id="profilerefresh"
                    style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
            </div>
        </div>
        <div class="ProfileContainer">
            <div class="leftcon">
                <form id="editprofileleft" action="<?=ROOT?>/Parent/ParentEditProfile/update" enctype="multipart/form-data" method="POST">
                <div class="profile-img" style="display: none;" id="add-con">
                    <input type="file" id="fileInput" name="image" accept="image/*">
                    <i class="fa fa-plus add" id="add" style="margin-bottom: -25px !important;"></i>
                </div>
                    <img src="<?= isset($data['Image'])? $data['Image'] : '' ?>" class="profile-img" id="img">
                    <i class="fa fa-edit"
                        style="font-size:30px; margin-left: -50px; margin-bottom: -20px; color: #6f6f6f; cursor: pointer"
                        id="image-edit"></i>
                    <div class="datacon">
                        <div class="data">
                            <label>First Name</label>
                            <input name="First_Name" placeholder="<?= isset($data['First_Name'])? $data['First_Name'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Last Name</label>
                            <input name="Last_Name" placeholder="<?= isset($data['Last_Name'])? $data['Last_Name'] : '' ?>" type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Password</label>
                            <input readonly placeholder="*******" style="width: 634.5px;" type="password">
                            <p class="edit" onclick="window.location.href='<?=ROOT?>/Main/Resetpasswordnown'"
                                style="cursor: pointer;"> Change Password</p>
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>User Name</label>
                            <input placeholder="<?= isset($data['Username'])? $data['Username'] : '' ?>" style="width: 634.5px;" type="text">
                            <p class="edit" onclick="window.location.href='<?=ROOT?>/Main/changeusername'"
                                style="cursor: pointer;"> Change UserName</p>
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Email</label>
                            <input id="emailInput" placeholder="<?= isset($data['Email'])? $data['Email'] : '' ?>" style="width: 634.5px;" type="email">
                            <p class="edit" id="verifyEmail" onclick="window.location.href='<?=ROOT?>/Main/change-username'" style="cursor: pointer;"> Verify Email</p>
                        </div>
                    </div>
            </div>
            <div class="divider"></div>
                <div class="rightcon">
                <div class="datacon">
                        <div class="data">
                            <label>Contact Number</label>
                            <input id="numberInput" maxlength="10" placeholder="<?= isset($data['Phone_Number'])? $data['Phone_Number'] : '' ?>" style="width: 627.5px;" type="text">
                            <p class="edit" id="verifyNumber" onclick="window.location.href='<?=ROOT?>/Main/change-number'" style="cursor: pointer; margin-left: 420px;" > Verify Contact</p>
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Gender</label>
                            <select name="Gender">
                                <option value="M" <?= ($data['Gender'] == 'M') ? 'selected' : '' ?>>Male</option>
                                <option value="F" <?= ($data['Gender'] == 'F') ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                        <div class="data">
                            <label>Language</label>
                            <select style="width: 307px;" name="Language">
                                <option value="English" <?= ($data['Language'] == 'English') ? 'selected' : '' ?>>English</option>
                                <option value="Sinhala" <?= ($data['Language'] == 'Sinhala') ? 'selected' : '' ?>>Sinhala</option>
                                <option value="Tamil" <?= ($data['Language'] == 'Tamil') ? 'selected' : '' ?>>Tamil</option>
                            </select>
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Last Seen</label>
                            <input style="width: 290px;" readonly placeholder="<?= isset($data['Last_Seen'])? $data['Last_Seen'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>ParentID</label>
                            <input readonly style="width:293px;" class="number" maxlength="12" placeholder="<?= isset($data['ParentID'])? $data['ParentID'] : '' ?>"
                                type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Address</label>
                            <input name="Address" placeholder="<?= isset($data['Address'])? $data['Address'] : '' ?>" style="width: 618px;" type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>NID</label>
                            <input name="Address" placeholder="<?= isset($data['NID'])? $data['NID'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Childs</label>
                            <input readonly maxlength="12" placeholder="<?= isset($data['childcount'])? $data['childcount'] : '' ?>" type="text">
                        </div>
                    </div>
                    <!-- <div class="datacon">
                        <div class="data">
                            payment Methods
                            <div style="display: flex; flex-direction: row; margin-top: 10px;">
                                <div class="cardcon">
                                    <img src="<?=IMAGE?>/Visa.png" class="card">
                                    Visa
                                </div>
                                <div class="cardcon">
                                    <img src="<?=IMAGE?>/master.png" class="card">
                                    Master
                                </div>
                            </div>
                            <p style="color:rgb(2, 77, 205); margin-top: 5px; font-weight: 600;">+Add payment modes</p>
                        </div>
                    </div> -->
                    <div class="Save-con" style="margin-top: 20px;">
                        <button type="button" class="Save" onclick="window.location.href='<?=ROOT?>/Parent/ParentProfile'">
                            Cancel
                        </button>
                        <button type="submit" class="Save">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.getElementById("verifyEmail").addEventListener("click", function () {
                const email = document.getElementById("emailInput").value;
                if (email) {
                    const encodedEmail = encodeURIComponent(email);
                    window.location.href = "<?= ROOT ?>/Parent/VerifyEmail?email=" + encodedEmail;
                } else {
                    alert("Please enter a valid email before verifying.");
                }
            });

            document.getElementById("verifyNumber").addEventListener("click", function () {
                const number = document.getElementById("numberInput").value;
                if (number) {
                    const encodedNumber = encodeURIComponent(number);
                    window.location.href = "<?= ROOT ?>/Parent/VerifyNumber?number=" + encodedNumber;
                } else {
                    alert("Please enter a valid email before verifying.");
                }
            });

            const profilerefresh = document.getElementById('profilerefresh');
            const editprofileleft = document.getElementById('editprofileleft');
            const editprofileright = document.getElementById('editprofileright');
            const imageedit = document.getElementById('image-edit');
            const img = document.getElementById('img');
            const addcon = document.getElementById('add-con');
            const add = document.getElementById('add');
            const fileInput = document.getElementById('fileInput');

            add.addEventListener('click', function () {
                document.getElementById('fileInput').click();
            })

            fileInput.addEventListener('input', (event) => {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        img.src = e.target.result;
                        addcon.style.display = 'none';
                        imageedit.style.display = '';
                        img.style.display = '';
                    };
                    reader.readAsDataURL(file);
                }
            });

            imageedit.addEventListener('click', function () {
                imageedit.style.display = 'none';
                img.style.display = 'none';
                addcon.style.display = 'flex';
            })

            profilerefresh.addEventListener('click', function () {
                editprofileleft.reset();
                editprofileright.reset();
            })

            const redstar = document.getElementById('red-star');
            
        });
    </script>
</body>

</html>