<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/history.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Stats.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Table1.css?v=<?= time() ?>">
    <!-- <script src="<?= JS ?>/Child/history.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/Child/Pickup.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Child/OTP.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/MessageDropdown.js?v=<?= time() ?>"></script>
</head>

<body style="overflow: hidden;">
    <div class="container">
        <!-- mimnized sidebar -->
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul>
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Child/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px;">
                    <a href="<?= ROOT ?>/Child/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/report">
                        <i class="fa fa-user-shield"></i> <span>Report</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/reservation">
                        <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/meal">
                        <i class="fas fa-utensils"></i> <span>Meal plan</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/Message">
                        <i class="fas fa-comment"></i> <span>Messager</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">
        </div>
        <!-- navigation to choose child -->
        <div class="sidebar-2" id="sidebar2">
            <div>
                <h2>Familty Ties</h2>
                <div class="family-section">
                    <ul>
                        <li class="hover-effect first"
                            onclick="removechildsession();">
                            <img src="<?php echo htmlspecialchars($data['parent']['image']); ?>">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2>Little Explorers</h2>
                    <p>
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="first
                                <?php if ($child['name'] === $data['selectedchildren']['name']) {
                                    echo "select-child";
                                } ?>
                            "
                                onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
                                <img src="<?php echo htmlspecialchars($child['image']); ?>"
                                    alt="Child Profile Image">
                                <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="name">
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <div class="bell-con" id="bell-container">
                    <i class="fas fa-bell bell-icon"></i>
                    <?php if(!empty($data['Notification'])): ?>
                        <?php if($data['Notification']['Seen'] != 0): ?>
                            <div class="message-numbers" id="message-number">
                                <p><?= $data['Notification']['Seen'] != 0 ? $data['Notification']['Seen'] : '' ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="message-dropdown" id="messageDropdown" style="display: none;">
                        <ul>
                            <?php foreach($data['Notification']['data'] as $row): ?>
                                <li data-id="<?= $row->NotificationID ?>">
                                    <p><?= htmlspecialchars($row->Description) ?></p>
                                    <?php if($row->Location != NULL): ?>
                                        <a href="<?= ROOT ?>/Child/<?= $row->Location ?>">
                                            <i class="fas fa-paper-plane"></i>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle"></i>
                    </button>
                </div>
            </div>
            <div class="stats">
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/attendance.svg?v=<?= time() ?>" alt="Attendance"
                            style="width: 30px; margin-right: 10px; margin-bottom: -10px;">Holidays</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['holidays'] ?> Days</p>
                    <span style="font-weight: 50;">holiday to the daycare</span>
                </div>
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/sick.svg?v=<?= time() ?>" alt="Attendance"
                            style="width: 30px; margin-right: 10px; margin-bottom: -10px;">Average attendance</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['average_attendance'] ?> Day</p>
                    <span style="font-weight: 50;">Average of attendance in a month</span>
                </div>
                <div class="stat">
                    <h3 style="margin-top: -16px;"><img src="<?= IMAGE ?>/mountain.svg?v=<?= time() ?>" alt="Attendance"
                            style="width: 40px; margin-right: 10px; margin-bottom: -15px;">Total late arrivals</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['late_arrivals'] ?> Days</p>
                    <span style="font-weight: 50;">Laet arrivals of all child</span>
                </div>
            </div>
            <div class="saperate" style="height: 540px;">
                <!-- Child history table -->
                <div class="Table1">
                    <h2> Child History </h2>
                    <hr style="color:black; background-color: black; position:fixed; z-index:1000000000;">
                    <input type="date" max="<?= (date('Y-m-d')); ?>" id="datePicker" style="width: 200px">
                    <table id="historyTable">
                        <thead>
                            <tr>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th>Pickup</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody style="max-height: 300px; margin-bottom: 0px;">
                        </tbody>
                    </table>
                </div>
                <!-- <div class="pickup-container">
                    <h1>Schedule pickups</h1>
                    <p>Review and finalize children pickup from the daycare</p>
                    <button class="button" id="openModalBtn">Schedule pickups</button>
                    <div class="details">
                        <p>Date: 12-16, 2025</p>
                        <p>Pickup person: Guardian</p>
                        <p>Departure time: 8:00pm</p>
                    </div>
                    <button class="button" style="width: 189px" id="editModalBtn">Edit</button>
                </div> -->
                <div class="attendance">
                    <div class="attendance-component">
                        <div style="display: flex; flex-direction: column;">
                            <h2 style="margin-top: -5px !important; margin-bottom: 2px;"> Attendance </h2>
                            <hr style="width: 480px;">
                        </div>
                        <div class="contain">
                            <div class="attendance-grid">
                                <?php foreach ($weeklyAttendance as $day): ?>
                                    <div class="attendance-item <?= $day['style'] ?> " style="width: 75px;">
                                        <?= $day['style'] ?>
                                        <div class="day-label" style="font-size: 15px;"><?= $day['day'] ?></div>
                                        <h2><?= date('d', strtotime($day['date'])) ?></h2>
                                        <p><?= $day['status'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="summary-container">
                            <div class="summary">
                                <div class="bar1">
                                    <p>Total</p>
                                    <p style="color: #00bcd4">Attended days of week: <?= $summary['totalDaysPresent'] ?> day</p>
                                </div>
                                <div class="bar2">
                                    <p style="margin-top: 15px;">Total</p>
                                    <p style="color: #9c27b0">Absent days of week: <?= $summary['totalDaysAbsent'] ?> day</p>
                                </div>
                            </div>
                            <div class="image-container">
                                <img alt="Cartoon of a student sitting at a desk with books" height="100"
                                    src="<?= IMAGE ?>/child_attendance.png" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- navigation to message page -->

            </div>
            <!-- Profile card -->
            <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
                <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                    style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
                <img alt="Profile picture of Thilina Perera" height="100" src="<?php echo htmlspecialchars($data['selectedchildren']['image']); ?>" width="100"
                    class="profile" />
                <h2><?= $data['selectedchildren']['fullname'] ?></h2>
                <p>SRD<?= $data['selectedchildren']['id'] ?></p>
                <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildProfile'">
                    Profile
                </button>
                <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ParentProfile'">
                    Parent profile
                </button>
                <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/GuardianProfile'">
                    Guardian profile
                </button>
                <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildPackage'">Package</button>
                <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildID'">Id Card</button>
                <button class="logout-button" onclick="window.location.href ='<?= ROOT ?>/Main/Home'">
                    LogOut
                </button>
            </div>
        </div>
    </div>
    <script>

    const messageDropdown = document.getElementById('messageDropdown');
    const bellIcon = document.getElementById('bell-container');
    const messagenumber = document.getElementById('message-number')

    let messageDropdownTimeout;

    function toggleBellDropdown() {
        if(messageDropdown){
            if (messageDropdown.style.display === "none" || !messageDropdown.style.display) {
                messageDropdown.style.display = "block";
                fetch("<?= ROOT ?>/Child/Home/SeenNotification", {
                    method: "POST",
                    credentials: "same-origin"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Seen the notifications");
                        messagenumber.style.display = 'none';
                    } else {
                        alert("Logout failed. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
                
            } else {
                messageDropdown.style.display = "none";
            }
        }
    }

        const minimizeBtn = document.getElementById('minimize-btn');
        const sidebar = document.getElementById('sidebar1');
        const starImage = document.getElementById('starImage');
        const logo = document.getElementById('sidebar-logo');
        const kiddo = document.getElementById('sidebar-kiddo');

        <?php if (!empty($_SESSION['APP']['MINIMIZE'])): ?>
            sidebar.classList.add('minimized');
            starImage.classList.add('show');
            logo.classList.add('hidden');
            kiddo.classList.add('hidden');
        <?php endif; ?>

        function setChildSession(ChildID) {
            console.log(ChildID);
            fetch(' <?= ROOT ?>/Parent/Home/setchildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ChildID: ChildID
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child Id set in session.");
                        window.location.href = '<?= ROOT ?>/Child/Home';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchAttendanceHistory(date) {
            fetch('<?= ROOT ?>/Child/History/store_history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Meal plan data:", data.data);
                        updateAttendanceTable(data.data);
                    } else {
                        console.error("Failed to fetch meal plan:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updateAttendanceTable(attendanceData) {
            // Get the table body
            const tableBody = document.querySelector('#historyTable tbody');

            // Clear any existing rows in the table
            tableBody.innerHTML = '';

            // Loop through the attendance data and create table rows
            attendanceData.forEach(attendance => {
                const row = document.createElement('tr');

                // Arrival Time (Start Date & Time)
                const arrivalCell = document.createElement('td');
                arrivalCell.textContent = `${attendance.Start_Date} ${attendance.Start_Time}`;
                row.appendChild(arrivalCell);

                // Departure Time (End Date & Time)
                const departureCell = document.createElement('td');
                departureCell.textContent = (attendance.End_Date && attendance.End_Time) 
                    ? `${attendance.End_Date} ${attendance.End_Time}` 
                    : '';
                row.appendChild(departureCell);

                // Pickup Information
                const pickupCell = document.createElement('td');
                pickupCell.textContent = attendance.Pickup || 'N/A'; // Handle if Pickup is empty or undefined
                row.appendChild(pickupCell);

                // Status (Present or Absent)
                const statusCell = document.createElement('td');
                statusCell.textContent = attendance.Status;
                row.appendChild(statusCell);

                // Append the created row to the table body
                tableBody.appendChild(row);
            });
        }

        function removechildsession() {
            fetch('<?= ROOT ?>/Child/Home/removechildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child name removed from session.");
                        window.location.href = '<?= ROOT ?>/Parent/History';
                    } else {
                        console.error("Failed to remove child name from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const datePicker = document.getElementById('datePicker');

            fetchAttendanceHistory('All');

            datePicker.addEventListener('change', function() {
                fetchAttendanceHistory(datePicker.value);
            });

        });
    </script>
</body>

</html>