<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/leaves.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!--Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
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
                            Maid
                        </p>
                    </div>
                </div>
                <ul>
                    <li class="hover-effect unselected first">
                        <a href="<?= ROOT ?>/Teacher/Home">
                            <i class="fas fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Funzone">
                            <i class="fas fa-puzzle-piece"></i> <span>Funzone</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Reports">
                            <i class="fas fa-file-alt"></i> <span>Report</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Students">
                            <i class="fas fa-users"></i> <span>Students</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Inventory">
                            <i class="fas fa-boxes"></i> <span>Inventory</span>
                        </a>
                    </li>
                    <li class="selected">
                        <a href="<?= ROOT ?>/Teacher/Leaves">
                            <i class="fas fa-calendar-alt"></i> <span>Leaves</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Message">
                            <i class="fas fa-comments"></i> <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="wrapper-1">
            <div class="request-leave-container" id="request-leave-container">
                <div class="leave-content">
                    <h3>Leave Request</h3>
                    <form action="<?= ROOT ?>/Teacher/Leaves/addLeave" method="POST">
                        <div class="leave-body">
                            <div class="body-left">
                                <label for="Leave_Type">Leave Type<span>*</span></label>
                                <select name="Leave_Type" required id="Leave_Type">
                                    <option value="Annual Leave">Annual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Compassionate Leave">Compassionate</option>
                                </select>
                                <label for="Start_Date">From</label>
                                <input type="date" name="Start_Date" id="Start_Date" required>
                                <label for="End_Date">To</label>
                                <input type="date" name="End_Date" id="End_Date" required>
                                <label for="Description">About</label>
                                <textarea name="Description" id="Description" placeholder="Inlcude comments for your approver" rows="5"></textarea>

                            </div>
                            <div class="body-right">
                                <img src="<?= ROOT ?>/assets/images/leave.png">
                                <div class="leave-info">
                                    <h4>Your Remaining Leaves</h4>
                                    <hr>
                                    <div class="details-grid">
                                        <?php if (isset($rems)): ?>
                                            <?php foreach ($rems as $rem): ?>
                                                <div class="detail-item">
                                                    <span class="detail-label"><?= $rem['LeaveType'] ?></span>
                                                    <div class="leave-rem">
                                                        <span class="detail-value">Used: <?= $rem['Used'] ?></span>
                                                        <span class="detail-value">Remaining: <?= $rem['Remain'] ?> </span>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>




                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="leave-footer">
                            <button class="request" type="submit">Request Now</button>
                            <button type="button" class="cancel" id="close-request" onclick="closeRequest()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- ********* EDIT REQUEST LEAVES **********-->

            <div class="request-leave-edit" id="request-leave-edit">
                <div class="edit-leave-content">
                    <h3>Leave Request</h3>
                    <form action="<?= ROOT ?>/Teacher/Leaves/editLeave" method="POST">
                        <div class="edit-leave-body">
                            <div class="body-left">

                                <input type="hidden" id="leave-id" name="LeaveID">
                                <input type="hidden" id="teacher-id" name="TeacherID">
                                <label for="Leave_Type">Leave Type<span>*</span></label>
                                <select name="Leave_Type" required id="Leave_Type">
                                    <option value="Annual Leave">Annual Leave</option>
                                    <option value="Sick Leave">Sick Leave</option>
                                    <option value="Compassionate Leave">Compassionate</option>
                                </select>
                                <label for="Start_Date">From</label>
                                <input type="date" name="Start_Date" id="Start_Date" required>
                                <label for="End_Date">To</label>
                                <input type="date" name="End_Date" id="End_Date" required>
                                <label for="Description">About</label>
                                <textarea name="Description" id="Description" placeholder="Inlcude comments for your approver" rows="5" required></textarea>

                            </div>
                            <div class="body-right">
                                <img src="<?= ROOT ?>/assets/images/leave.png">
                                <div class="leave-info">
                                    <h4>Your Request Includes</h4>
                                    <hr>
                                    <b>
                                        <p class="para-1"><span>10 </span>days of annual leave</p>
                                    </b>
                                    <p class="para-2"><span>
                                        </span> days remaining</p>
                                </div>
                            </div>
                        </div>
                        <div class="leave-footer">
                            <button class="edit-request" type="submit">Request Now</button>
                            <button class="edit-cancel" id="close-edit-request" onclick="closeEditLeaves(event)">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content">

                <div class="header" style="width: 1270px; margin-left: 260px; padding: 40px;">
                    <div class="header-title">
                        <h2 style="font-size: 24px;">
                            Hey
                        </h2>
                        <p>
                            Start your day happy with little ones !
                        </p>
                    </div>
                    <div class="bell-con" id="bell-container" style="cursor: pointer;flex-grow: 0;">
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

                <div class="leave-page" style="margin-top: 100px; height: 1000px;">
                    <div class="leave-page-header">
                        <div class="leave-page-header-group">
                            <i class="fa-regular fa-calendar"></i>
                            <h3 style="white-space: nowrap;">Leave History</h3>
                            <div class="req-btn">
                                <button class="new-req" id="open-request" onclick="openRequest()">New Request</button>
                            </div>
                        </div>
                        <hr>
                        <?php if (!empty($errors)): ?>
                            <div class="error-messages">
                                <ul>
                                    <?php foreach ($errors as $field => $error): ?>
                                        <li><strong><?= ucfirst($field) ?>:</strong> <?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($message)): ?>
                            <div class="success-message">
                                <p><?= $message ?></p>
                            </div>
                        <?php elseif (isset($success)): ?>
                            <div class="ok-message">
                                <p><?= $success ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="leave-table">
                        <div class="leave-table-title">
                            <h4><i class="fa-solid fa-file-alt"></i>Leave Type</h4>
                            <h4><i class="fa-solid fa-calendar-plus"></i>Start Date</h4>
                            <h4><i class="fa-solid fa-calendar-check"></i>End Date</h4>
                            <h4><i class="fa-solid fa-hourglass-half"></i>Duration</h4>
                            <h4><i class="fa-solid fa-info-circle"></i>Status</h4>
                            <h4><i class="fa-solid fa-cogs"></i>Action</h4>
                        </div>
                        <?php if (isset($leaves)): ?>
                            <?php foreach ($leaves as $leave): ?>
                                <div class="leave-row">
                                    <p><?= $leave->Leave_Type ?></p>
                                    <p><?= $leave->Start_Date ?></p>
                                    <p><?= $leave->End_Date ?></p>
                                    <p class="num"><?= $leave->Duration ?></p>
                                    <div class="approve"><?= $leave->Status ?></div>
                                    <?php if ($leave->Status == "Pending"): ?>
                                        <div class="actions-btn">
                                            <button class="edit-btn" onclick='openEditLeaves(<?= htmlspecialchars(json_encode($leave)) ?>)'>Edit</button>
                                            <form action="<?= ROOT ?>/Teacher/Leaves/deleteLeave" method="POST">
                                                <input type="text" name="LeaveID" value="<?= $leave->LeaveID ?>" hidden>
                                                <button class="dlt-btn" type="submit">Delete</button>
                                        </div>
                                        </form>
                                    <?php else: ?>
                                        <div class="actions-btn">
                                            <button class="edit-button" disabled>Edit</button>
                                            <button class="dlt-button" disabled>Delete</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000; width: 21rem;">
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

    <script src="<?= JS ?>/Teacher/script.js"></script>
    <script src="<?= JS ?>/Teacher/leaves.js"></script>
    <script>
        const openRequest = () => {
            const requestContainer = document.getElementById("request-leave-container");
            if (requestContainer) {
                requestContainer.classList.add("show-request");
            }
        };

        function logoutUser() {
            fetch("<?= ROOT ?>/Teacher/Leaves/Logout", {
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

        // CLOSE LEAVE REQUEST POPUP
        const closeRequest = () => {
            const requestContainer = document.getElementById("request-leave-container");
            if (requestContainer) {
                requestContainer.classList.remove("show-request");
            }
        };

        // OPEN EDIT LEAVES POPUP
        const openEditLeaves = (leave) => {
            console.log(leave);
            try {
                // Parse the leave object if it's a string
                if (typeof leave === 'string') {
                    leave = JSON.parse(leave);
                }

                const editContainer = document.getElementById("request-leave-edit");

                if (editContainer) {
                    // Show the edit container by adding the class
                    editContainer.classList.add("show-request-edit");

                    // Set form field values from the leave object
                    if (document.getElementById('leave-id')) {
                        document.getElementById('leave-id').value = leave.LeaveID;
                    }
                    if (document.getElementById('teacher-id')) {
                        document.getElementById('teacher-id').value = leave.TeacherID;
                    }

                    const leaveType = editContainer.querySelector('#Leave_Type')
                    leaveType.value = leave.Leave_Type;

                    // Get all the Start_Date fields in the edit form
                    const startDateInputs = editContainer.querySelectorAll('#Start_Date');
                    startDateInputs.forEach(input => input.value = leave.Start_Date);

                    // Get all the End_Date fields in the edit form
                    const endDateInputs = editContainer.querySelectorAll('#End_Date');
                    endDateInputs.forEach(input => input.value = leave.End_Date);

                    // Get all the Description fields in the edit form
                    const descriptionInputs = editContainer.querySelectorAll('#Description');
                    descriptionInputs.forEach(input => input.value = leave.Description);

                    console.log("Successfully opened edit form with data:", leave);
                } else {
                    console.error("Edit container not found!");
                }
            } catch (error) {
                console.error("Error opening edit form:", error);
                console.error("Leave data:", leave);
            }
        };

        // CLOSE EDIT LEAVES POPUP
        const closeEditLeaves = (event) => {
            if (event) {
                event.preventDefault();
            }
            const editContainer = document.getElementById("request-leave-edit");
            if (editContainer) {
                editContainer.classList.remove("show-request-edit");
            } else {
                console.error("Edit container not found!");
            }
        };

        // // OPEN LEAVE REQUEST POPUP
    </script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>


</body>

</html>