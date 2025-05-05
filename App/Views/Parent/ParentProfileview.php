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
            <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer; color: rgba(35, 83, 167, 1);">My Profile</p>
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
                            <label>Password</label>
                            <input readonly placeholder="*******" style="width: 627.5px;" type="password">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>User Name</label>
                            <input readonly placeholder="<?= isset($data['Username'])? $data['Username'] : '' ?>" style="width: 627.5px;" type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Email</label>
                            <input readonly placeholder="<?= isset($data['Email'])? $data['Email'] : '' ?>" style="width: 627.5px;" type="text">
                        </div>
                    </div>
                </form>
            </div>
            <div class="divider"></div>
            <form id="editprofileright">
                <div class="rightcon">
                    <div class="datacon">
                        <div class="data">
                            <label>Contact Number</label>
                            <input readonly placeholder="<?= isset($data['Phone_Number'])? $data['Phone_Number'] : '' ?>" style="width: 627.5px;" type="text">
                        </div>
                    </div>
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
                            <label>Last Seen</label>
                            <input readonly placeholder="<?= isset($data['Last_Seen'])? $data['Last_Seen'] : '' ?>" type="text">
                        </div>
                        <div class="data">
                            <label>ParentID</label>
                            <input style="width:293px;" class="number" maxlength="12" placeholder="<?= isset($data['ParentID'])? $data['ParentID'] : '' ?>"
                                type="text">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <label>Address</label>
                            <input readonly  placeholder="<?= isset($data['Address'])? $data['Address'] : '' ?>" style="width: 625px;" type="text">
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
                    <div class="datacon">
                        <!-- <div class="data">
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
                        </div> -->
                    </div>
                    <div style="margin-top: 20px; margin-bottom: 5px; display: flex; justify-content:flex-end;align-items: right;">
                        <button type="button" class="Save" onclick="window.location.href=('<?=ROOT?>/Parent/ParentEditProfile')">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>