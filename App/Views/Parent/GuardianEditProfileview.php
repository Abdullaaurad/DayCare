<!DOCTYPE html>
<html>
<title>Parent</title>
<link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?=CSS?>/Parent/profile.css?v=<?= time() ?>">
<script src="<?=JS?>/Parent/Number.js?v=<?= time() ?>"></script>

<head>
</head>

<body>
    <div class="Profilecard">
        <div class="Profile">
            <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer;"
                onclick="window.location.href='<?=ROOT?>/Parent/Home'">Guardian Profile
                <span style="margin-left: 10px;"> > </span>
                <span style="margin-left: 10px; color: rgba(35, 83, 167, 1);"> Edit Guardian Profile</span>
            </p>
            <div class="refresh-con">
                <i class="fas fa-refresh" id="profilerefresh"
                    style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
            </div>
        </div>
        <div class="ProfileContainer">
        <form id="editprofileleft" action="<?=ROOT?>/Parent/GuardianEditProfile/update" enctype="multipart/form-data" method="POST" style="display: flex; flex-direction: row;">
            <div class="leftcon" id="editprofileleft">
                    <div class="profile-img" style="display: none;margin-left: 0px !important;" id="add-con">
                        <input type="file" id="fileInput" name="image" accept="image/*">
                        <i class="fa fa-plus add" id="add"></i>
                    </div>
                    <img src="<?= isset($data['Image'])? $data['Image'] : '' ?>" class="profile-img" id="img" style="margin-left: 0px; margin-bottom: 20px; position: fixed; margin-top: -140px;">
                    <i class="fa fa-edit"
                        style="font-size:30px; margin-left: 100px; color: #6f6f6f; cursor: pointer; position: fixed; margin-top: -20px;"
                        id="image-edit"></i>
                    <div class="datacon" style="margin-top: 0px; position: fixed; margin-top: 105px;">
                        <div class="data">
                            <label>First Name</label>
                            <input name="First_Name" placeholder="<?= isset($data['First_Name'])? $data['First_Name'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Last Name</label>
                            <input name="Last_Name" placeholder="<?= isset($data['Last_Name'])? $data['Last_Name'] : '' ?>" type="text">
                        </div>
                    </div>
                    <div class="datacon" style="position: fixed; margin-top: 265px;">
                        <div class="data">
                            <label>Email</label>
                            <input name="Email" placeholder="<?= isset($data['Email'])? $data['Email'] : '' ?>" type="email">
                        </div>
                        <div class="data">
                            <label>NID</label>
                            <input name="NID" maxlength="12" placeholder="<?= isset($data['NID'])? $data['NID'] : '' ?>" type="text">
                        </div>
                    </div>
            </div>
            <div class="divider"></div>
                <div class="rightcon">
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
                            <label>Contact</label>
                            <input name="Phone_number" style="width:293px;" class="number" maxlength="12" placeholder="<?= isset($data['Phone_Number'])? $data['Phone_Number'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Contact Preference</label>
                            <select>
                                <option value="email">email</option>
                                <option value="call" selected>call</option>
                                <option value="message">message</option>
                            </select>
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Address</label>
                            <input name="Address" placeholder="106/37,Brandiyawatta,wellampitiya" style="width: 618px;" type="text">
                        </div>
                    </div>
                    <div class="Save-con" style="margin-top: 20px;">
                        <button type="button" class="Save" onclick="window.location.href='<?=ROOT?>/Parent/GuardianProfile'">
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


        });
    </script>
</body>

</html>