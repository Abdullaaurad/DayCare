<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/Attendancedashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/main.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js?v=<?= time() ?>"></script>
    <title>Receptionist</title>
</head>

<body>
    <div class="main">
        <div class="side_bar">
            <div class="userblock">
                <div class="photo">
                    <img alt="User profile picture" height="50" src="<?= $data['Profile']->Image ?>" width="50" />
                </div>
                <div class="username">
                    <h3>
                        <?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?>
                    </h3>
                    <p>
                        Receptionist
                    </p>
                </div>
            </div>
            <ul>
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Receptionist/Home">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="<?= ROOT ?>/Receptionist/Attendance">
                        <i class="fas fa-history"></i> <span>Attendance</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Payment">
                        <i class="fa fa-user-shield"></i> <span>Payment</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/visitor">
                        <i class="fas fa-calendar-check"></i> <span>Visitor</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Inventory">
                        <i class="fas fa-boxes"></i> <span>Inventory</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Restock">
                        <i class="fas fa-truck-loading"></i> <span>Restock</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Leave">
                        <i class="fas fa-utensils"></i> <span>Leave</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <div class="header-title">
                    <h2 style="font-size: 24px;">
                        Hey
                    </h2>
                    <p>
                        Start your day happy with little ones !
                    </p>
                </div>
                <div class="bell-con" id="bell-container" style="cursor: pointer;">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px; color: white;"></i>
                    <?php if (!empty($data['Notification'])): ?>
                        <?php if ($data['Notification']['Seen'] != 0): ?>
                            <div class="message-numbers" id="message-number">
                                <p><?= $data['Notification']['Seen'] != 0 ? $data['Notification']['Seen'] : '' ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="message-dropdown" id="messageDropdown" style="display: none;">
                            <ul>
                                <?php foreach ($data['Notification']['data'] as $row): ?>
                                    <li data-id="<?= $row->NotificationID ?>">
                                        <p><?= htmlspecialchars($row->Description) ?></p>
                                        <?php if ($row->Location != NULL): ?>
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
            <div class="detailed_content">
                <div class="make_background">
                    <div class="weeklygraph_todaypresents">
                        <div class="weekly_graph">
                            <div class="weekly_texts">
                                <span class="total_topic">Total</span>
                                <div class="number_and_text">
                                    <span class="number"><?= $data['graph']['All'] ?></span>
                                    <span class="text">LAST<br>WEEK</span>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="graph">
                                <canvas id="attendanceChart"></canvas>
                            </div>
                        </div>
                        <div class="last_marked" style="height: 200px; overflow-y: auto;">
                            <span class="last_marked_topic">Previous Check-In</span>
                            <?php if (!empty($data['checkin'])): ?>
                                <?php foreach ($data['checkin'] as $child): ?>
                                    <div class="lastmarkedchilds">
                                        <div class="profile_image">
                                            <img alt="User profile picture"
                                                height="50"
                                                width="50"
                                                src="<?= isset($child->Image) ? $child->Image : ROOT . '/assets/images/profilePic-1.png' ?>" />
                                        </div>
                                        <div class="name_time">
                                            <span class="lastmarkedname"><?= htmlspecialchars($child->ChildName) ?></span>
                                            <span class="lastmarkedtime"><?= date('g:i A', strtotime($child->Start_Time)) ?></span>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="lastmarkedchilds" style="text-align: center; justify-content: center; align-items: center;">
                                    <p>No children have checked in yet.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="second_part">
                        <div class="attendance_table">
                            <div class="table_header">
                                <div class="topic"><span>Mark Attendance</span></div>
                            </div>
                            <hr>
                            <div class="table_filters">
                                <div class="select_age">
                                    <input type="text" class="select" id="Filter" placeholder="Enter Child ID" />
                                </div>
                            </div>
                            <table class="attendance-table">
                            <thead>
                                <tr>
                                <th>Reg No</th>
                                <th>Name</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Pickup</th>
                                </tr>
                            </thead>
                            <tbody id="attendance-rows">
                                <!-- Rows inserted by JS -->
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" />
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= $data['Profile']->Image; ?>" width="100" class="profile" />
            <h2><?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?></h2>
            <p><?= $data['Profile']->EmployeeID ?> </p>
            <button class="profile-button"
                onclick="window.location.href ='<?= ROOT ?>/Receptionist/Profile'">Profile
            </button>
            <button class="logout-button" onclick="logoutUser()">LogOut</button>
        </div>

        <div class="modal" id="pickupModal">
            <div class="pickup-popup">
                <div class="top-con">
                    <div class="back-con">
                        <i class="fas fa-chevron-left" id="backforpickup"></i>
                    </div>
                </div>
                <h1>pickup Schedule</h1>
                <div class="pickup-section">
                    <label for="Person">Person</label>
                    <p id="Person">Parent</p>
                </div>
                <div class="pickup-section" id="OTPdiv">
                    <label for="OTP">OTP</label>
                    <p id="OTP">321456</p>
                </div>
                <div class="pickup-section">
                    <label for="NID">NID</label>
                    <p id="NID">200232901776</p>
                </div>
                <div class="pickup-section" style="display: flex; justify-content: center; align-items: center;">
                    <img id="IMG" alt="User profile picture" height="50" width="50" src="<?=IMAGE?>/face.jpeg" />
                </div>
            </div>
        </div>

    </div>

</body>
<script>
    function logoutUser() {
        fetch("<?= ROOT ?>/Receptionist/Attendance/Logout", {
                method: "POST",
                credentials: "same-origin"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "<?= ROOT ?>/Main/Login";
                } else {
                    alert("Logout failed. Try again.");
                }
            })
            .catch(error => console.error("Error:", error));
    }

    function renderTable(data) {
        const tbody = document.getElementById('attendance-rows');
        tbody.innerHTML = ''; // Clear existing rows

        data.forEach(row => {
            const image = row.Image ?? '<?= ROOT ?>/assets/images/profilePic-1.png';
            const checkIn = row.Start_Time ? 
                `<span>${row.Start_Time}</span>` :
                `<form method="POST" action="<?= ROOT ?>/Receptionist/Attendance/markAttendance">
                    <input type="hidden" name="ChildID" value="${row.ChildID}">
                    <button type="submit">Mark</button>
                </form>`;

            const checkOut = row.End_Time ?
                `<span>${row.End_Time}</span>` :
                `<form method="POST" action="<?= ROOT ?>/Receptionist/Attendance/markdeparture">
                    <input type="hidden" name="ChildID" value="${row.ChildID}">
                    <button type="submit">Mark</button>
                </form>`;

            const pickup = row.PickupScheduled ?
                `
                    <div class="pickup_info" onclick="viewPickupDetails(${row.ChildID})">
                        <span><i class="fa fa-user"></i> View</span>
                    </div>
                ` :
                `<div class="pickup_info">
                    <span>Parent</span>
                </div>`

            // Create a new row (tr) for each child and append it
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.ChildIDEdited}</td>
                <td>
                    <img src="${image}" alt="Child Image" class="child-img">
                    <span>${row.ChildName}</span>
                </td>
                <td>${checkIn}</td>
                <td>${checkOut}</td>
                <td>${pickup}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    function GetUsageReport(filter) {
        console.log(filter);
        fetch('<?= ROOT ?>/Receptionist/Attendance/Rows', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Filter: filter,
                })
            })
            .then(response => response.json())
            .then(res => {
                console.log(res);
                renderTable(res);
            })
            .catch(error => console.error("Error:", error));
    }

    function viewPickupDetails(childID) {
        fetch('<?= ROOT ?>/Receptionist/Attendance/PickupDetails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ChildID: childID,
                })
            })
            .then(response => response.json())
            .then(res => {
                console.log(res);
                document.getElementById('pickupModal').style.display = 'flex';
                if(res.OTP == null){
                    document.getElementById('OTPdiv').style.display = "none";
                }else{
                    document.getElementById('OTP').innerText = res.OTP;
                }
                document.getElementById('NID').innerText = res.NID;
                document.getElementById('Person').innerText = res.Person;
                document.getElementById('IMG').src = res.Image ? res.Image : '<?= ROOT ?>/assets/images/profilePic-1.png';
            })
            .catch(error => console.error("Error:", error));
    }

    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('backforpickup').addEventListener('click', function () {
            document.getElementById('pickupModal').style.display = 'none';
        });

        const Filter = document.getElementById('Filter');

        Filter.addEventListener('change', function() {
            const filterValue = Filter.value.trim();
            GetUsageReport(filterValue);
        });

        GetUsageReport(null);

        const ctx = document.getElementById('attendanceChart').getContext('2d');
        const weeklyData = <?= json_encode($data['graph']['data'] ?? []) ?>;
        const labels = Object.keys(weeklyData).map(day => day.substring(0, 3));
        const attendanceCounts = Object.values(weeklyData);

        const barColors = "rgba(0, 115, 246, 0.78)";

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Attendance Count',
                    data: attendanceCounts,
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
                        ticks: {
                            precision: 0 // Ensure integer ticks
                        },
                        grid: {
                            color: "rgba(0, 0, 0, 0.2)",
                            borderDash: [5, 5],
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + " Attendees";
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</html>