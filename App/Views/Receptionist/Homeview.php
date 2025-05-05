<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/Dashboard.css?v=<?= time() ?>">
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
                <li class="selected first">
                    <a href="<?= ROOT ?>/Receptionist/Home">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Leave">
                        <i class="fas fa-dollar-sign"></i> <span>Salary</span>
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
                <div class="main-contents">
                    <div class="navigation-card-content">
                        <div class="card">
                            <span class="card-topic"><i class="fas fa-clipboard-check" title="Mark Attendance"></i>&nbsp; Attendance</span>
                            <span class="mini-topic">Present Count</span>
                            <div class="count-percentage">
                                <span class="count">35</span>
                                <span class="percentage1">Absent 42.66&#37</span>
                            </div>

                        </div>
                        <div class="card">
                            <span class="card-topic"><i class="fas fa-calendar-plus" title="Mark Attendance"></i>&nbsp; Resevation</span>
                            <span class="mini-topic">Available Slots</span>
                            <div class="count-percentage">
                                <span class="count">15</span>
                                <span class="percentage">Availbale Slots 42.66&#37</span>
                            </div>

                        </div>
                        <div class="card">
                            <span class="card-topic"><i class="fas fa-credit-card" title="Mark Attendance"></i>&nbsp; Payment</span>
                            <span class="mini-topic">Confirmed Enrollments</span>
                            <div class="count-percentage">
                                <span class="count">35</span>
                                <span class="percentage1">Payment Due 42.66&#37</span>
                            </div>

                        </div>
                    </div>
                    <div class="other_details">
                        <div class="att_percentage">
                            <div class="percentage_header">
                                <span><i class="fas fa-clipboard-check" title="Mark Attendance"></i>&nbsp; Today Attendance</span>
                                <div class="select_age">
                                    <select name="age" id="age" class="select_age_input">
                                        <option value="All">All</option>
                                        <option value="3-5">3-5</option>
                                        <option value="6-9">6-9</option>
                                        <option value="10-13">10-13</option>
                                    </select>
                                </div>
                            </div>
                            <div class="detailed_part">
                                <div class="in-students">
                                    <div class="in-students1">
                                        <div></div>
                                        <span>Present</span>
                                    </div>

                                    <span class="att-number">45</span>
                                </div>
                                <div class="out-students">
                                    <div class="out-students1">
                                        <div></div>
                                        <span>Absent</span>
                                    </div>
                                    <span class="att-number">15</span>
                                </div>

                            </div>
                            <div class="graphcontainer"><canvas id="piechart" class="animatepiechart" width="300" height="300" style="display: flex; justify-content: center; align-items: center;">
                                </canvas></div>

                        </div>
                        <div class="today_visitors">
    <div class="today_visitors_header">
        <span><i class="fas fa-door-open"></i>&nbsp; Today Visitors</span>
    </div>

    <div class="visitor-table-container">
        <table class="visitor-table">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>POSITION</th>
                    <th>PURPOSE</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['Visitors'])): ?>
                    <?php foreach ($data['Visitors'] as $visitor): ?>
                        <tr>
                            <td><?= $visitor->FirstName ?> <?= $visitor->LastName ?></td>
                            <td><?= $visitor->Role ?></td>
                            <td><?= $visitor->Purpose ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center; color: gray;">No visitors for today.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
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
    </div>

    <script src="<?= JS ?>/Receptionist/Dashboard.js"></script>
    <script src="<?= JS ?>/Receptionist/test.js"></script>
    <script src="<?= JS ?>/Receptionist/receptionist_attendance.js"></script>
</body>
<script>

    function logoutUser() {
        fetch("<?= ROOT ?>/Receptionist/Home/Logout", {
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
</script>

</html>