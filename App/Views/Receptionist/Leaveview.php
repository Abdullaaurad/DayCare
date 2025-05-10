<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/PaymentDashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Maid/profile.css?v=<?= time() ?>">
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
                <li class="hover-effect unselected first">
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
                <li class="selected">
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
                    <div class="payment_table">
                        <div class="table_header">
                            <div class="topic"><span>Leave Details</span></div>
                            <button onclick="document.querySelector('.modal').style.display = 'flex';" class="paymentbutton">
                                <span>Request &nbsp;Leaves</span>
                            </button>
                        </div>
                        <hr>
                        <div class="table_filters">
                            <form class="date_entry" method="GET" action="<?= ROOT ?>/Receptionist/Leave/index">
                                <input
                                    type="date"
                                    name="Date"
                                    value="<?= isset($data['Date']) ? htmlspecialchars($data['Date']) : '' ?>"
                                    onchange="this.form.submit()" />
                            </form>
                        </div>
                        <div class="table_topics">
                            <div class="head reg_id">

                                <span>Leave Type</span>
                            </div>
                            <div class="head name">

                                <span>Start Date</span>
                            </div>
                            <div class="head transaction_id">
                                <span>End Date</span>
                            </div>
                            <div class="head amount">

                                <span>Duration</span>
                            </div>
                            <div class="head date">

                                <span>Status</span>
                            </div>
                            <div class="head action">

                                <span>Action</span>
                            </div>
                        </div>
                        <div class="table_columns">
                            <?php if (!empty($leaves)): ?>
                                <?php foreach ($leaves as $leave): ?>
                                    <?php
                                    $isApproved = $leave->Status === 'Approved';
                                    $isPast = strtotime($leave->Start_Date) < strtotime(date('Y-m-d'));
                                    ?>
                                    <div class="table_column">
                                        <div class="colum reg_id">
                                            <span><?= htmlspecialchars($leave->Leave_Type) ?></span>
                                        </div>
                                        <div class="colum name">
                                            <span>&nbsp; <?= htmlspecialchars($leave->Start_Date) ?></span>
                                        </div>
                                        <div class="colum transaction_id">
                                            <span><?= htmlspecialchars($leave->End_Date) ?></span>
                                        </div>
                                        <div class="colum amount">
                                            <span><?= htmlspecialchars($leave->Duration) ?></span>
                                        </div>
                                        <div class="colum date">
                                            <span><?= htmlspecialchars($leave->Status) ?></span>
                                        </div>
                                        <div class="colum action">
                                            <?php if (!$isApproved && !$isPast): ?>
                                                <form method='POST' action="<?= ROOT ?>/Receptionist/Leaveupdate">
                                                    <input type='hidden' value='<?= htmlspecialchars($leave->LeaveID) ?>' name='leaveid'>
                                                    <button><i class="fas fa-edit" type="submit"></i>Edit</button>
                                                </form>
                                            <?php endif; ?>

                                            <?php if (!$isPast): ?>
                                                <form method='POST' action="<?= ROOT ?>/Receptionist/Leave/delrec">
                                                    <input type='hidden' value='<?= htmlspecialchars($leave->LeaveID) ?>' name='LeaveID'>
                                                    <button><i class="fas fa-trash"></i>Delete</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
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

        <form class="modal" style="display: none; width:" method="POST" action="<?= ROOT ?>/Receptionist/Leave/Requestleave">
            <div class="pickup-popup">
                <div class="top-con">
                    <div class="back-con">
                        <i class="fas fa-chevron-left" id="backformeeting"></i>
                    </div>
                    <div class="refresh-con">
                        <i class="fas fa-refresh" id="meetingrefresh"
                            style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                    </div>
                </div>
                <div class="form-head" style="margin-top: 50px;">
                    <span>Request Leave</span>
                </div>
                <hr>
                <div style="display: flex; flex-direction: row; margin-bottom: 10px;">
                    <div class="form-group-date">
                        <label for="date">Start Date</label>
                        <div class="date_entry">
                            <input type="date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" name="Start_Date" />
                        </div>
                    </div>
                    <div class="form-group-date">
                        <label for="date">End Date</label>
                        <div class="date_entry">
                            <input type="date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>"  name="End_Date" />
                        </div>
                    </div>
                </div>
                <div class="form-group-option" style="margin-bottom: 10px;">
                    <label for="type">Request Types</label>
                    <select id="type" name="Leave_Type" style="width: 290px;">
                        <option value="Annual Leave">Annual Leave</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Compassionate">Compassionate</option>
                    </select>
                </div>
                <div class="form-group-desp" style="margin-bottom: 10px; width: 290px;">
                    <label for="description">Description</label>
                    <textarea id="description" placeholder="Description about Leave" name="Description"></textarea>
                </div>

                <div class="button-popup" style="margin-top: 20px;">
                    <button id="closemeetingBtn">Cancel</button>
                    <button type="submit">Done</button>
                </div>
            </div>
        </form>

    </div>

    <script>
        const url = new URL(window.location);
        url.searchParams.delete('Date');
        window.history.replaceState({}, document.title, url);

        document.querySelector('input[name="Date"]').addEventListener('change', function() {
            console.log(this.value);
            if (this.value === '') {
                window.location.href = "<?= ROOT ?>/Receptionist/Leave/index";
            } else {
                this.form.submit(); // Otherwise, submit normally
            }
        });

        function logoutUser() {
            fetch("<?= ROOT ?>/Receptionist/Leave/Logout", {
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

        document.getElementById("backformeeting").addEventListener("click", function() {
            document.querySelector(".modal").style.display = "none";
        });

        document.getElementById("meetingrefresh").addEventListener("click", function() {
            document.querySelector(".modal").reset();
        });
    </script>
</body>

</html>