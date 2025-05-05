<html>

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/StaffSchedule.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Manager/profileview.js"></script>
</head>

<body id="body">
    <div class="sidebar">
        <div class="logo_stuf" style="display: flex;margin-top:6%">
            <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
            <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
        </div>
        <ul style=" margin-top: 10%;">
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Manager/Home" style="font-size: 18px;margin-left:10%;margin-top:-10%;">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Viewprofile" style="font-size: 18px;">
                        <i class="fas fa-user-check"></i>Accounts
                    </a>
                </li>
            </ul>
            <ul>
                <li class="selected">
                    <a href="<?= ROOT ?>/Manager/Schedule" style="font-size: 18px;">
                        <i class="fas fa-calendar"></i>Scheduling
                    </a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Packages"><i class="fas fa-box"></i> Packages</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Meeting"><i class="fa fa-exclamation-triangle"></i>Meeting</a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Holiday" style="font-size: 18px;">
                        <i class="fas fa-umbrella-beach"></i> Holiday</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Event" style="font-size: 18px;">
                        <i class="fa fa-calendar-plus"></i>Event</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Foodtable" style="font-size: 18px;">
                        <i class="fa fa-pizza-slice"></i>Food Plane</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Leaverequest" style="font-size: 18px;">
                        <i class="fas fa-hand-paper"></i>Request</a>
                </li>
            </ul>
        </ul>
    </div>
    <div class="header" style="margin-top:-40.05%">
        <div class="name">
            <h1>Hey Namal</h1>
            <p style="color: white;">Let’s do some productive activities today</p>
        </div>
        <div class="profile">
            <button class="profilebtn" onclick="handleClick()">
                <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
            </button>
        </div>
        <div class="profile-card" id="profileCard" style="margin-top: 21%;">
            <button class="back" onclick="handleHide()"><i class="fas fa-chevron-left"></i></button>
            <img alt="Profile picture of Thilina Perera" height="100" src="../Assets/shimhan.jpg" width="100" class="profile" />
            <h2>
                Thilina Perera
            </h2>
            <p>
                ID    RS0110657
            </p>
            <button class="profile-button">
                Personal info
            </button>
            <button class="secondary-button">
                Change Password
            </button>
            <button class="logout-button">
                LogOut
            </button>
        </div>
    </div>

    <div class="filters">
        <label for="ageGroupSelect">Age Group:</label>
        <select name="AgeGroup2" style="margin-right: 325px;width:150px;" id="ageGroupSelect">
            <option value="3-5">3 - 5</option>
            <option value="6-9">6 - 9</option>
            <option value="10-13">10 - 13</option>
        </select>
    </div>
    <div id="content1" class="content show" style="display: none">
        <form action="<?= ROOT ?>/Manager/Schedule/addscheduleMaid" method="post">
            <div class="activity-schedule" style="position:fixed;margin-top:-11%;margin-left:-48.5%;">
                <div style="display: flex;justify-content:space-around;">
                    <h2 style="color: #233E8D;margin-left:-25%">Tomorrow Activity Schedule
                        <div style="display: flex;width:100px;margin-left:50%;margin-top:-2.5%">
                            <input type="date" id="onlyTomorrow" name="Date" required>
                        </div>
                    </h2>
                </div>
                <hr style="margin-top: -1%;">
                <div class="table-div">
                    <table>
                        <thead>
                            <tr class="table_headings">
                                <th style="color: #233E8D;background-color:transparent">Activity</th>
                                <th style="color: #233E8D;background-color:transparent">Staff</th>
                                <th style="color: #233E8D;background-color:transparent">Start_Time</th>
                                <th style="color: #233E8D;background-color:transparent">End_Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="Breakfast" readonly class="styled-select">
                                    <input type="hidden" name="Activity[]" value="Breakfast">
                                </td>
                                <td>
                                    <input type="text" class="styled-select" readonly>
                                </td>
                                <td>
                                    <input type="text" value="8:00" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="8:00">
                                </td>
                                <td>
                                    <input type="text" value="8:30" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="8:30">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Activity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="8:30" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="8:30">
                                </td>
                                <td>
                                    <input type="text" value="10:00" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="10:00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="Refreshment" class="styled-select" readonly>
                                    <input type="hidden" name="Activity[]" value="Refreshment">
                                </td>
                                <td>
                                    <input type="text" class="styled-select" readonly>
                                </td>
                                <td>
                                    <input type="text" value="10:00" class="styled-select" readonly>
                                    <input type="hidden" name="Start_Time[]" value="10:00">
                                </td>
                                <td>
                                    <input type="text" value="10:30" class="styled-select" readonly>
                                    <input type="hidden" name="End_Time[]" value="10:30">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Activity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="10:30" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="10:30">
                                </td>
                                <td>
                                    <input type="text" value="12:00" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="12:00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" value="Ready for Lunch" readonly class="styled-select">
                                    <input type="hidden" name="Activity[]" value="Ready for Lunch">
                                </td>
                                <td>
                                    <input type="text" name="" id="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="12:00" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="12:00">
                                </td>
                                <td>
                                    <input type="text" value="13:00" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="13:00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="styled-select" value="Lunch" readonly>
                                    <input type="hidden" name="Activity[]" value="Lunch">
                                </td>
                                <td>
                                    <input type="text" class="styled-select" readonly>
                                </td>
                                <td>
                                    <input type="text" value="13:00" class="styled-select" readonly>
                                    <input type="hidden" name="Start_Time[]" value="13:00">
                                </td>
                                <td>
                                    <input type="text" value="13:30" class="styled-select" readonly>
                                    <input type="hidden" name="End_Time[]" value="13:30">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Activity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="13:30" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="13:30">
                                </td>
                                <td>
                                    <input type="text" value="15:00" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="15:00">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Activity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="15:00" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="15:00">
                                </td>
                                <td>
                                    <input type="text" value="16:30" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="16:30">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Activity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="16:30" readonly class="styled-select">
                                    <input type="hidden" name="Start_Time[]" value="16:30">
                                </td>
                                <td>
                                    <input type="text" value="17:00" readonly class="styled-select">
                                    <input type="hidden" name="End_Time[]" value="17:00">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="resetbtn" style="background-color: #233E8D;color:white;">Add</button>
            </div>
        </form>
    </div>

    <div id="content2" class="content show" style="display: none;">
        <form action="<?= ROOT ?>/Manager/Schedule/addscheduleforTeacher" method="post">
            <div class="activity-schedule" style="position:fixed;margin-top:-10%;margin-left:-48.5%;">
                <div style="display: flex;justify-content:space-around;">
                    <h2 style="color: #233E8D;margin-left:-25%">Tomorrow Activity Schedule
                        <div style="display: flex;width:100px;margin-left:50%;margin-top:-2.5%">
                            <input type="date" id="onlyTomorrow_1" name="Date" required>
                        </div>
                    </h2>
                </div>
                <hr style="margin-top: -1%;">
                <div class="table-div">
                    <input type="text" name="AgeGroup" id="InsideFormAgeGroup" hidden />
                    <table>
                        <thead>
                            <tr class="table_headings">
                                <th style="color: #233E8D;background-color:transparent">Activity</th>
                                <th style="color: #233E8D;background-color:transparent">Staff</th>
                                <th style="color: #233E8D;background-color:transparent">Start_Time</th>
                                <th style="color: #233E8D;background-color:transparent">End_Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="Lunch" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" class="styled-select" readonly>
                                <td>
                                    <input type="text" value="14:00" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="14:30" readonly class="styled-select">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Creative Activity">Creative Acitivity</option>
                                        <option value="Story Time">Story Time</option>
                                        <option value="Out door Time">Out door Time</option>
                                        <option value="Basic Learning Time">Basic Learning Time</option>
                                        <option value="Nap Time">Nap Time</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="MaidID" class="styled-select" id="" required>
                                        <option value="" disabled selected>Select Maid</option>
                                        <?php foreach ($maids as $maid): ?>
                                            <option>
                                                <?= $maid->First_Name . ' ' . $maid->Last_Name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </td>
                                <td>
                                    <input type="text" value="14:30" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="15:30" readonly class="styled-select">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="Activity[]" class="styled-select" id="activity" onchange="loadTeachers(this.value)">
                                        <option value="Select Activity" disabled selected>Select Activity</option>
                                        <option value="Maths">Maths</option>
                                        <option value="Science">Science</option>
                                        <option value="English">English</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="TeacherID" class="styled-select" id="teacherSelect" required>
                                        <option value="" disabled selected>Select Teacher</option>
                                    </select>

                                </td>
                                <td>
                                    <input type="text" value="15:30" readonly class="styled-select">
                                </td>
                                <td>
                                    <input type="text" value="16:30" readonly class="styled-select">

                                </td>
                            </tr>
                            <td>
                                <select name="Activity[]" class="styled-select" id="">
                                    <option value="Select Activity" disabled selected>Select Activity</option>
                                    <option value="Creative Acitivity">Creative Acitivity</option>
                                    <option value="Story Time">Story Time</option>
                                    <option value="Out door Time">Out door Time</option>
                                    <option value="Basic Learning Time">Basic Learning Time</option>
                                    <option value="Nap Time">Nap Time</option>
                                </select>
                            </td>
                            <td><select name="MaidID" class="styled-select" id="" required>
                                    <option value="" disabled selected>Select Maid</option>
                                    <?php foreach ($maids as $maid): ?>
                                        <option>
                                            <?= $maid->First_Name . ' ' . $maid->Last_Name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" value="16:30" readonly class="styled-select">
                            </td>
                            <td>
                                <input type="text" value="17:00" readonly class="styled-select">
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="resetbtn" style="background-color: #233E8D;color:white;">Add</button>
            </div>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set tomorrow's date
            const dateInput = document.getElementById('onlyTomorrow');
            const dateInput1 = document.getElementById('onlyTomorrow_1');
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);

            const yyyy = tomorrow.getFullYear();
            const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
            const dd = String(tomorrow.getDate()).padStart(2, '0');

            dateInput.value = `${yyyy}-${mm}-${dd}`;
            dateInput1.value = `${yyyy}-${mm}-${dd}`; // Set the same date for the second input

            dateInput.min = dateInput.value;
            dateInput.max = dateInput.value;
        });

        document.addEventListener('DOMContentLoaded', function() {
            const ageGroupSelect = document.getElementById('ageGroupSelect');
            const insideFormAgeGroup = document.getElementById('InsideFormAgeGroup');
            const content1 = document.getElementById('content1');
            const content2 = document.getElementById('content2');
            content1.style.display = 'block';
            content2.style.display = 'none';

            ageGroupSelect.addEventListener('change', function(event) {
                const selectedValue = this.value;
                console.log(selectedValue); // Log the selected value
                if (selectedValue === '3-5') {
                    content1.style.display = 'block';
                    content2.style.display = 'none';
                } else if (selectedValue === '6-9') {
                    content1.style.display = 'none';
                    content2.style.display = 'block';
                    insideFormAgeGroup.value = selectedValue; // Set the hidden input value
                } else if (selectedValue === '10-13') {
                    content1.style.display = 'none';
                    content2.style.display = 'block';
                    insideFormAgeGroup.value = selectedValue; // Set the hidden input value
                } else {
                    content1.style.display = 'block';
                    content2.style.display = 'none';
                }
            });
        });

        function loadTeachers(subject) {
            fetch("<?= ROOT ?>/Manager/Schedule/getTeacher", {
                    method: "POST",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        Subject: subject
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const Teachers = data.data
                        console.log(Teachers);
                        Teachers.forEach(teacher => {
                            const option = document.createElement("option");
                            option.value = teacher.TeacherID;
                            option.textContent = teacher.First_Name + " " + teacher.Last_Name;
                            document.getElementById("teacherSelect").appendChild(option);
                        });
                    } else {
                        alert("Logout failed. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>