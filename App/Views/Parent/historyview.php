<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/history.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Stats.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Table1.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/Parent/history.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/Parent/Pickup.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Parent/OTP.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="container">
        <!-- minimized sidebar -->
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="<?= ROOT ?>/Parent/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/report">
                        <i class="fa fa-user-shield" aria-hidden="true"></i> <span>Report</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/reservation">
                        <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/meal">
                        <i class="fas fa-utensils"></i> <span>Meal plan</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr>
            <div class="help">
                <a href="#"><i class="fas fa-question-circle"></i> <span>Help</span></a>
            </div>
        </div>
        <!-- navigation -->
        <div class="sidebar-2" id="sidebar2">
            <div>
                <h2>Familty Ties</h2>
                <div class="family-section">
                    <ul>
                        <li class="hover-effect first select-child"
                            onclick="window.location.href = '<?= ROOT ?>/Parent/Home'">
                            <img src="<?php echo htmlspecialchars($data['parent']['image']); ?>">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="explorer">Little Explorers</h2>
                    <p>
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="hover-effect first" onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>')">
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
                    <h1><?= isset($data['parent']['fullname']) ? $data['parent']['fullname'] : 'No name set'; ?></h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <!-- message icon -->
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
                <!-- Prodile btn -->
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle"></i>
                    </button>
                </div>
            </div>
            <div class="stats">
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/attendance.svg?v=<?= time() ?>" alt="Attendance">Holidays</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['holidays'] ?> Days</p>
                    <span>holiday to the daycare</span>
                </div>
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/sick.svg?v=<?= time() ?>" alt="Attendance">Average attendance</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['average_attendance'] ?>%</p>
                    <span>Average of attendance in a month</span>
                </div>
                <div class="stat">
                    <h3 style="margin-top: -16px;"><img src="<?= IMAGE ?>/mountain.svg?v=<?= time() ?>" alt="Attendance">Total late arrivals</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['late_arrivals'] ?> Days</p>
                    <span>Laet arrivals of all child</span>
                </div>
            </div>
            <div class="saperate">
                <div class="Table1">
                    <h2>Child Attendance</h2>
                    <hr>
                    <input type="date" max = "<?= (date('Y-m-d')); ?>" id="datePicker" value="">
                    <select id="childPicker">
                        <option Value="All" selected> All </option>
                        <?php foreach ($data['children'] as $child): ?>
                            <option value="<?php echo htmlspecialchars($child['name']); ?>">
                                <?php echo htmlspecialchars($child['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <table id="historyTable">
                        <thead>
                            <tr>
                                <th>Child</th>
                                <th>Arrival</th>
                                <th>Departure</th>
                                <th>Pickup</th>
                                <th> Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="glass-box" style="width: 200px !important; height: 400px !important;">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
            <!-- messager page -->
        </div>
        <!-- profile card -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow" id="back-arrow-profile" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png" width="100"
                class="profile" />
            <h2>
                Thilina Perera
            </h2>
            <p>
                Student    RS0110657
            </p>
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Parent/ParentProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Parent/GuardianProfile'">
                Guardian profile
            </button>
            <?php if ($data['Child_Count'] < 5) { ?>
                <button class="secondary-button" onclick="window.location.href='<?php echo ROOT; ?>/Onbording/Child'">
                    Add Children
                </button>
            <?php } ?>
            <button class="logout-button" onclick="logoutUser()">
                LogOut
            </button>
        </div>
    </div>
    <script>
        
    const messageDropdown = document.getElementById('messageDropdown');
    const bellIcon = document.getElementById('bell-container');
    const messagenumber = document.getElementById('message-number')

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

        function logoutUser() {
            fetch("<?= ROOT ?>/Parent/history/Logout", {
                method: "POST", 
                credentials: "same-origin"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "<?= ROOT ?>/Main/Login"; // Redirect after logout
                } else {
                    alert("Logout failed. Try again.");
                }
            })
            .catch(error => console.error("Error:", error));
        }
        
        function setChildSession(ChildID) {
            fetch(' <?= ROOT ?>/Parent/History/setchildsession', {
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
                        window.location.href = '<?=ROOT?>/Child/History';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchAttendanceHistory(date, child) {
            fetch('<?= ROOT ?>/Parent/History/store_history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date,
                        child: child
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
                
                // Child Name
                const childCell = document.createElement('td');
                childCell.textContent = attendance.First_Name;  // Assuming First_Name is returned
                row.appendChild(childCell);
                
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
                pickupCell.textContent = attendance.Pickup || 'N/A';  // Handle if Pickup is empty or undefined
                row.appendChild(pickupCell);
                
                // Status (Present or Absent)
                const statusCell = document.createElement('td');
                statusCell.textContent = attendance.Status;
                row.appendChild(statusCell);

                // Append the created row to the table body
                tableBody.appendChild(row);
            });
        }


        document.addEventListener('DOMContentLoaded', function() {

            const ctx = document.getElementById('attendanceChart').getContext('2d');

            // Example PHP data passed as JSON (Replace with dynamic PHP data)
            const graphData = <?= json_encode($data['graph']); ?>;

            // Extract labels (child names) and attendance percentages
            const labels = graphData.map(child => child.ChildName);
            const attendanceData = graphData.map(child => child.Attendance);

            // Define colors based on attendance
            const barColors = "rgba(0, 115, 246, 0.78)";

            // Create Chart
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Attendance Percentage',
                        data: attendanceData,
                        backgroundColor: barColors,
                        borderColor: "#000",
                        borderWidth: 1,
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function (value) {
                                    return value + "%"; // Show percentage on Y-axis
                                }
                            },
                            grid: {
                                color: "rgba(0, 0, 0, 0.2)",
                                borderDash: [5, 5],
                            }
                        },
                        x: {
                            grid: {
                                display: false // ❌ Hide vertical grid lines
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Hide legend
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.raw + "% Attendance";
                                }
                            }
                        }
                    }
                }
            });

            const datePicker = document.getElementById('datePicker');
            const childPicker = document.getElementById('childPicker');
            
            fetchAttendanceHistory(datePicker.value, childPicker.value );

            datePicker.addEventListener('change', function() {
                fetchAttendanceHistory(datePicker.value, childPicker.value );
            });

            childPicker.addEventListener('change', function() {
                fetchAttendanceHistory(datePicker.value, childPicker.value);
            });
        });

    </script>
</body>

</html>