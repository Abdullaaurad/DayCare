<!DOCTYPE html>
<html>
<title>Parent</title>
<link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= CSS ?>/Child/profile.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= CSS ?>/Child/childpackage.css?v=<?= time() ?>">
<script src="<?= JS ?>/Child/Number.js"></script>
<style>
    .fa-chevron-left {
        margin-left: 40px;
        cursor: pointer;
        color: white !important;
    }

    .profile-img {
        width: 200px;
        height: 200px;
        border-radius: 100%;
        border: 5px solid rgba(27, 54, 101, 1);
        box-shadow: 0px 0px 12px rgba(72, 99, 180, 0.5);
        transition: box-shadow 0.3s;
        margin-top: 10px;
        margin-left: 250px;
        justify-content: center;
        align-items: center;
    }
</style>

<head>
</head>

<body>
    <div class="Profilecard" id="Profilecard" style="margin-top: 45px !important;">
        <div class="Profile">
            <p style="margin-top: 0px; margin-bottom: -10px; margin-left: 90px; cursor: pointer; color: rgba(35, 83, 167, 1);"
                onclick="window.location.href='<?=ROOT?>/Child/Home'">Child Package
                <span style="margin-left: 10px;"> > </span>
                <span style="cursor: pointer; color: rgba(35, 83, 167, 1);"> Edit Child Package</span>
            </p>
            <div class="back-con" id="back-arrow" style="margin-top: -25px !important; border-top-left-radius: 0px;" onclick="window.location.href='<?=ROOT?>/Child/Home'">
                <i class="fas fa-chevron-left" id="backforprescription"></i>
            </div>
            <div class="refresh-con" style="margin-top: -40px; margin-left: 655px !important; border-top-right-radius: 0px;">
                <i class="fas fa-refresh" id="profilerefresh" style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"> </i>
            </div>
        </div>
        <div class="ProfileContainer" style="flex-direction: column !important; padding-bottom: 40px;">
            <div style="display: flex; flex-direction: row; justify-content: flex-start; margin-top: 20px; margin-left: 20px;">
                <div class="toggle" style="border-top-left-radius: 18px;">
                    <label class="background" for="toggle"></label>
                    <div style="display: flex; flex-direction: row; justify-content: space-between; width: 30%;">
                        <label class="up-btn" id="up-btn">Fixed</label>
                        <label class="hi-btn" id="hi-btn">Custom</label>
                    </div>
                </div>
            </div>
            <div id="spe-Modal" style="margin-top:-50px;">
                <div class="datacon" style="margin-top: 10px;">
                    <div class="data">
                        <h1 style="color: #10639a; text-align: center;">Attending Days</h1>
                        <div class="days">
                            <div class="day" data-day="Sun" style="margin-left:0px">Sun</div>
                            <div class="day" data-day="Mon">Mon</div>
                            <div class="day" data-day="Tue">Tue</div>
                            <div class="day" data-day="Wed">Wed</div>
                            <div class="day" data-day="Thu">Thur</div>
                            <div class="day" data-day="Fri">Fri</div>
                            <div class="day" data-day="Sat">Sat</div>
                        </div>
                        <div style="display: none">
                            <input type="checkbox" id="day-Sun" name="selectedDays[]" value="Sun">
                            <input type="checkbox" id="day-Mon" name="selectedDays[]" value="Mon">
                            <input type="checkbox" id="day-Tue" name="selectedDays[]" value="Tue">
                            <input type="checkbox" id="day-Wed" name="selectedDays[]" value="Wed">
                            <input type="checkbox" id="day-Thu" name="selectedDays[]" value="Thu">
                            <input type="checkbox" id="day-Fri" name="selectedDays[]" value="Fri">
                            <input type="checkbox" id="day-Sat" name="selectedDays[]" value="Sat">
                        </div>
                    </div>
                </div>
                <div class="datacon" style="margin-top: 10px; font-weight: bold;color: #10639a !important;">
                    <label> if the day count stay the same the payment amoutn will not change </label>
                </div>
                <div class="datacon" style="margin-top: -5px;font-weight: bold; color:  #10639a !important;">
                    <label> For additional days of visit a extra payment will be added</label>
                </div>
                <div class="package"
                    style="display: flex; flex-direction: column; margin-top: 20px; width: 350px; margin-left: auto; margin-right: auto; text-align: left;">
                    <div style="display: flex; justify-content: space-between; width: 100%; padding: 5px 0;">
                        <label>Package Name</label>
                        <span> : something</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; padding: 5px 0;">
                        <label>Number of Days Included</label>
                        <span> : 3</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; padding: 5px 0;">
                        <label>Amount</label>
                        <span> : 14000</span>
                    </div>
                </div>

                <div class="payment-option">
                    <label for="payment-now" style="color:  #10639a; font-weight: bold;">
                    </label>
                </div>
            </div>
            <!-- If person wants to change days dynamically packages -->
            <div id="fle-Modal" style="display: none; justify-content: center; align-items: center; margin-top: 90px; width: 670px; height: 330px;">
                <h1 style="color: #10639a; text-align: center; margin-top: -30px;">Dynamic Payment Details </h1>
                <div class="datacon" style="margin-top: 40px !important; font-weight: bold;color:  #10639a !important;">
                    <label> Payment must be made in 2 week intervals. </label>
                </div>
                <div class="package" style="display: flex; flex-direction: column; margin-top: 20px; width: 350px; margin-left: auto; margin-right: auto; text-align: left;">
                    <div style="display: flex; justify-content: space-between; width: 100%; padding: 5px 0;">
                        <label>Weekday Price</label>
                        <span> : 6000</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; padding: 5px 0;">
                        <label>Weekend Price</label>
                        <span> : 7000</span>
                    </div>
                </div>
            </div>
            <!-- <?php echo !empty($data['value']['button']) ? 'flex-end' : 'space-between '; ?> -->
            <div class="datacon" style="margin-top: 445px; position: fixed; flex-direction: row;">
                <div class="data">
                    <button name="action" value="guardian" type="submit" id="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-left: 440px;">Save<i class="fa fa-chevron-right" style="margin-left: 4px;"></i></button>
                </div>
            </div>
        </div>
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