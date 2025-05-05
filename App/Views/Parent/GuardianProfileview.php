<!DOCTYPE html>
<html>
<title>Parent</title>
<link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?=CSS?>/Parent/profile.css?v=<?= time() ?>">
<script src="<?=JS?>/Number.js?v=<?= time() ?>"></script>

<head>
</head>
<body>
    <div class="Profilecard" style="display: flex; flex-direction: column; justify-content: center; align-self: center; margin-top: 140px;">
        <div class="Profile">
            <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer; color: rgba(35, 83, 167, 1);">Guardian Profile</p>
        </div>
        <div class="ProfileContainer">
            <div class="leftcon">
                <form id="editprofileleft">
                    <img src="<?= isset($data['Image'])? $data['Image'] : '' ?>" class="profile-img">
                    <div class="datacon">
                        <div class="data">
                            <label>First Name</label>
                            <input readonly placeholder="<?= isset($data['First_Name'])? $data['First_Name'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Last Name</label>
                            <input readonly placeholder="<?= isset($data['Last_Name'])? $data['Last_Name'] : '' ?>" type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Email</label>
                            <input readonly placeholder="<?= isset($data['Email'])? $data['Email'] : '' ?>" type="email">
                        </div>
                        <div class="data">
                            <label>NID</label>
                            <input readonly maxlength="12" placeholder="<?= isset($data['NID'])? $data['NID'] : '' ?>" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="divider"></div>
            <form id="editprofileright">
                <div class="rightcon">
                    <div class="datacon">
                        <div class="data">
                            <label>Gender</label>
                            <input readonly type="text" placeholder="<?= ($data['Gender'] == 'M')? 'Male' : 'Female' ?>">
                        </div>
                        <div class="data">
                            <label>Language</label>
                            <input readonly type="text" placeholder="<?= isset($data['Language'])? $data['Language'] : '' ?>">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Contact</label>
                            <input readonly class="number" maxlength="12" placeholder="<?= isset($data['Phone_Number'])? $data['Phone_Number'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>Contact Preference</label>
                            <input readonly type="text" placeholder="Mobile">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Address</label>
                            <input readonly  placeholder="<?= isset($data['Address'])? $data['Address'] : '' ?>" style="width: 625px;" type="text">
                        </div>
                    </div>
                    <div style="margin-top: 20px; margin-bottom: 5px; display: flex; justify-content:flex-end;align-items: right;">
                        <button type="button" class="Save" onclick="window.location.href='<?=ROOT?>/Parent/GuardianEditProfile'">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>