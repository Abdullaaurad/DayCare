<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Onbording.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Package.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Onbording/child.js"></script>
    <style>
        .error {
            color: red !important;
            margin-left: 0px !important;
            font-size: 15px;
            margin-top: 0px;
            margin-bottom: -15px;
        }

        .delete {
            margin-top: 0px;
            padding: 10px;
            border-radius: 20px;
            background-color: #3498db;
            margin-left: -50px;
            margin-bottom: 440px;
        }
    </style>
</head>

<body>
    <form method="post" id="details" enctype="multipart/form-data">
        <!-- container to get details -->
        <div class="Profilecard">
            <div style="background-color: #60a6ec; width: 350px; height: 600px; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                <img src="<?= IMAGE ?>/logo_light-remove.png" style="width:70px">
                <div class="heading">
                    <h1>Schedule Your</h1>
                    <h1>Daycare Visits</h1>
                    <h1>Conveniently</h1>
                    <h1>and Seamlessly!</h1>
                </div>
                <div class="text">
                    <p> Plan your daycare visits with ease</p>
                    <p>and ensure a safe, enjoyable experience for your kids.</p>
                </div>
            </div>
            <div class="ProfileContainer" style="flex-direction: column !important;">
                <div style="display: flex; flex-direction: row; justify-content: flex-start; margin-top: 20px; margin-left: 20px;">
                    <div class="toggle">
                        <label class="background" for="toggle"></label>
                        <div style="display: flex; flex-direction: row; justify-content: space-between; width: 30%;">
                            <label class="up-btn" id="up-btn">Create</label>
                            <label class="hi-btn" id="hi-btn" style="padding: 10px 41px 10px 41px;">Edit</label>
                        </div>
                    </div>
                    <div class="home-contain">
                        <i onclick="window.location.href='<?=ROOT?>/Main/Landing'" class="fa fa-home"></i>
                    </div>
                </div>
                <div id="spe-Modal">
                    <h1 style="color: #10639a; text-align: center; margin-top: 10px;">Schedule Visits</h1>

                    <div class="datacon" style="margin-left: 10px; margin-top: -20px;">
                        <div class="data">
                            <label> Name </label>
                            <input name="Name" type="text" placeholder="Enter Name">
                        </div>
                        <div class="data">
                            <label> NID </label>
                            <input name="NID" type="text" maxlength="12" placeholder="Enter NID">
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Date </label>
                            <select style="width: 315px;">
                                <option disabled selected> Select date </option>
                                <option>Mon 01 Nov </option>
                                <option>Tue 02 Nov </option>
                                <option>Wed 03 Nov </option>
                                <option>Thu 04 Nov </option>
                                <option>Fri 05 Nov </option>
                                <option>Sat 06 Nov </option>
                                <option>Sun 07 Nov </option>
                            </select>
                        </div>
                        <div class="data">
                            <label> Time </label>
                            <select style="width: 315px;">
                                <option disabled selected> Select time </option>
                                <option>11:00 AM </option>
                                <option>12:00 AM </option>
                                <option>2:00 PM </option>
                                <option>3:00 PM </option>
                                <option>4:00 PM </option>
                                <option>5:00 PM </option>
                            </select>
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Contact </label>
                            <input name="Contact" type="text" maxlength="10" placeholder="Enter Contact Number">
                        </div>
                        <div class="data">
                            <label> Email </label>
                            <input name="Email" type="text" maxlength="100" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Purpose of visit </label>
                            <input style="width: 635px;" name="pupose" type="text" maxlength="100" placeholder="Enter purpose of visit">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <button type="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-left: 460px; margin-top: 30px;"> Save </button>
                        </div>
                    </div>
                </div>
                <!-- If person wants to change days dynamically packages -->
                <div id="fle-Modal" style="display: none; justify-content: center; align-items: center;">
                    <h1 style="color: #10639a; text-align: center; margin-top: 10px;"> Edit Visits  </h1>
                    <div class="datacon" style="margin-left: 10px; margin-top: -20px;">
                        <div class="data">
                            <label> NID </label>
                            <input name="NID" type="text" maxlength="12" placeholder="Enter NID">
                        </div>
                        <div class="data">
                            <label> Email </label>
                            <input name="Email" type="text" placeholder="Enter Email">
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Name </label>
                            <input name="Name" type="text">
                        </div>
                        <div class="data">
                            <label> Contact </label>
                            <input name="Contact" type="text" maxlength="10">
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Date </label>
                            <select style="width: 315px;">
                                <option disabled selected> </option>
                                <option>Mon 01 Nov </option>
                                <option>Tue 02 Nov </option>
                                <option>Wed 03 Nov </option>
                                <option>Thu 04 Nov </option>
                                <option>Fri 05 Nov </option>
                                <option>Sat 06 Nov </option>
                                <option>Sun 07 Nov </option>
                            </select>
                        </div>
                        <div class="data">
                            <label> Time </label>
                            <select style="width: 315px;">
                                <option disabled selected> </option>
                                <option>Mon 01 Nov </option>
                                <option>Tue 02 Nov </option>
                                <option>Wed 03 Nov </option>
                                <option>Thu 04 Nov </option>
                                <option>Fri 05 Nov </option>
                                <option>Sat 06 Nov </option>
                                <option>Sun 07 Nov </option>
                            </select>
                        </div>
                    </div>
                    <div class="datacon" style="margin-left: 10px;">
                        <div class="data">
                            <label> Purpose of visit </label>
                            <input style="width: 635px;" name="pupose" type="text" maxlength="100">
                        </div>
                    </div>
                    <div class="datacon">
                        <div class="data">
                            <button type="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important;margin-top: 30px; margin-left: 10px"> Delete </button>
                        </div>
                        <div class="data">
                            <button type="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-left: 230px; margin-top: 30px;"> Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('spe-Modal');
            const history = document.getElementById('fle-Modal');

            upbtn.addEventListener('click', function() {
                upbtn.style.backgroundColor = '#10639a';
                hibtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'block';
                history.style.display = 'none';
            });

            hibtn.addEventListener('click', function() {
                hibtn.style.backgroundColor = '#10639a';
                upbtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'none';
                history.style.display = 'block';
                days.forEach(day => {
                    day.classList.remove('selectday');
                })
            });

            const days = document.querySelectorAll('.day');
            days.forEach(dayDiv => {
                dayDiv.addEventListener('click', function() {
                    const dayValue = dayDiv.getAttribute('data-day');
                    const checkbox = document.getElementById(`day-${dayValue}`);

                    // Toggle the checkbox and add/remove 'selected' class
                    if (checkbox.checked) {
                        checkbox.checked = false;
                        dayDiv.classList.remove('selectday');
                    } else {
                        checkbox.checked = true;
                        dayDiv.classList.add('selectday');
                    }
                });
            });
        });
    </script>
</body>

</html>