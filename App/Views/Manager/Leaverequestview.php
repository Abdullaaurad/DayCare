    <html>

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
        <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
        <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
        <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
        <link rel="stylesheet" href="<?= CSS ?>/Manager/Leaverequest.css?<?= time() ?>">
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
                    <li class="hover-effect unselected">
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
                    <li class="selected">
                        <a href="<?= ROOT ?>/Manager/Leaverequest" style="font-size: 18px;">
                            <i class="fas fa-hand-paper"></i>Request</a>
                    </li>
                </ul>
            </ul>
        </div>
        <div class="header" style="margin-top:-22%">
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


        <div class="container" id="container">
            <div class="leaverequest">
                <div id="leave-requests" class="scroll-container">
                    <h1 style="margin-top: 2%; color:#233E8D; font-size:24px;display:flex;gap:2%"><i class="fa-solid fa-calendar-check"></i>Teacher Leave requests</h1>
                    <hr style="margin-left: -4%;">
                    <!-- Leave Requests -->
                    <div class="leavecards">
                        <?php if (!empty($data['leaverequest'])): ?>
                            <?php foreach ($data['leaverequest'] as $leave): ?>
                                <div class="leavecard">
                                    <p name="TeacherName"><span>Name : <?= htmlspecialchars($leave->TeacherName) ?></span></p>
                                    <p name="LeaveType"><span>Leave_Type : <?= htmlspecialchars($leave->Leave_Type); ?></span></p>
                                    <p name="Description"><span>Description : <?= htmlspecialchars($leave->Description); ?></span></p>
                                    <p name="Duration"><span>Duration : <?= htmlspecialchars($leave->Duration); ?></span></p>
                                    <p name="Duration"><span>Remaining : <?= htmlspecialchars($leave->Remaining); ?></span></p>
                                    <p name="Duration"><span>Used : <?= htmlspecialchars($leave->Used); ?></span></p>
                                    <p name="   atus" style="margin: 10px 0;">
                                        <span id="status-text" data-status="<?= strtolower(htmlspecialchars($leave->Status)) ?>" style="font-weight: bold;">
                                            <?= htmlspecialchars($leave->Status) ?>
                                        </span>
                                        <?php if (strtolower($leave->Status) === 'pending'): ?>
                                    <div style="margin-top: 8px;">
                                        <button class="accept-btn" onclick="Approve(<?= htmlspecialchars($leave->LeaveID) ?>)">Accept</button>
                                        <button class="decline-btn" onclick="Delete(<?= htmlspecialchars($leave->LeaveID) ?>)">Decline</button>
                                    </div>
                                <?php endif; ?>
                                </p>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Not found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="leaverequest">
                <div id="leave-requests" class="scroll-container">
                    <h1 style="margin-top: 2%; color:#233E8D; font-size:24px;display:flex;gap:2%"><i class="fa-solid fa-calendar-check"></i>Maid Leave requests</h1>
                    <hr style="margin-left: -4%;">
                    <!-- Leave Requests -->
                    <div class="leavecards">
                        <?php if (!empty($data['maidleaves'])): ?>
                            <?php foreach ($data['maidleaves'] as $leave): ?>
                                <div class="leavecard">
                                    <p name="MaidName"><span>Name : <?= htmlspecialchars($leave->MaidName) ?></span></p>
                                    <p name="LeaveType"><span>Leave_Type : <?= htmlspecialchars($leave->Leave_Type); ?></span></p>
                                    <p name="Description"><span>Description : <?= htmlspecialchars($leave->Description); ?></span></p>
                                    <p name="Duration"><span>Duration : <?= htmlspecialchars($leave->Duration); ?></span></p>
                                    <p name="status" style="margin: 10px 0;">
                                        <span id="status-text" data-status="<?= strtolower(htmlspecialchars($leave->Status)) ?>" style="font-weight: bold;">
                                            <?= htmlspecialchars($leave->Status) ?>
                                        </span>
                                        <?php if (strtolower($leave->Status) === 'pending'): ?>
                                    <div style="margin-top: 8px;">
                                        <button class="accept-btn" onclick="Approve(<?= htmlspecialchars($leave->LeaveID) ?>)">Accept</button>
                                        <button class="decline-btn" onclick="Delete(<?= htmlspecialchars($leave->LeaveID) ?>)">Decline</button>
                                    </div>
                                <?php endif; ?>
                                </p>
                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Not found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="overlay" id="overlay"></div>

        <!-- Popup -->
        <div class="popup" id="popup">
            <h3>Personal Leave</h3>
            <div class="form-field">
                <label>Employee Name</label>
                <input type="text" id="popup-name" readonly>
            </div>
            <div class="form-field">
                <label>Application Type</label>
                <input type="text" value="Leave Request" readonly>
            </div>
            <div class="form-field">
                <label>Leave</label>
                <input type="text" id="popup-dates" readonly>
            </div>
            <div class="form-field">
                <label>Reason</label>
                <input type="text" id="popup-reason" readonly>
            </div>
            <div class="buttons">
                <button class="approve-btn" type="submit">Approve</button>
                <button class="reject-btn" type="submit">Reject</button>
            </div>
            <span class="close-btn" id="closePopup" style="text-decoration: none;">Close</span>
        </div>



        <script>
            const container = document.getElementById('leave-requests');
            leaveRequests.forEach(request => {
                const requestDiv = document.createElement('div');
                requestDiv.className = 'request';
                requestDiv.innerHTML = ` <img src="<?= IMAGE ?>/profilePic.png"  class="resize"><p class="l_name"><strong>${request.name}</strong><br>${request.type}</p>
                                            <p style="margin-top: 10%;">From: ${request.from} To: ${request.to}</p>
                                            <p>Reason: ${request.Reason}</p>  <button class="viewbtn">View</button>`;
                container.appendChild(requestDiv);
            });

            const viewButtons = document.querySelectorAll('.viewbtn');
            const overlay = document.getElementById('overlay');
            const popup = document.getElementById('popup');
            const closePopup = document.getElementById('closePopup');

            const popupName = document.getElementById('popup-name');
            const popupDates = document.getElementById('popup-dates');
            const popupReason = document.getElementById('popup-reason');

            viewButtons.forEach((button) => {
                button.addEventListener('click', (e) => {
                    const requestDiv = e.target.closest('.request');
                    const name = requestDiv.getAttribute('data-name');
                    const dates = requestDiv.getAttribute('data-dates');
                    const reason = requestDiv.getAttribute('data-reason');

                    // Set popup content dynamically
                    popupName.value = name;
                    popupDates.value = dates;
                    popupReason.value = reason;

                    // Show popup
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                });
            });

            // Close Popup
            closePopup.addEventListener('click', () => {
                popup.style.display = 'none';
                overlay.style.display = 'none';
            });

            overlay.addEventListener('click', () => {
                popup.style.display = 'none';
                overlay.style.display = 'none';
            });

            function Approve(LeaveID) {
                console.log(LeaveID);
                fetch('<?= ROOT ?>/Manager/Leaverequest/ApproveLeave', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            LeaveID: LeaveID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Leave request approved successfully!');
                            location.reload();
                        } else {
                            alert('Failed to approve leave request.');
                        }
                    })
            }

            function Delete(LeaveID) {
                console.log(LeaveID);
                fetch('<?= ROOT ?>/Manager/Leaverequest/CancelLeave', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            LeaveID: LeaveID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Leave request rejected successfully!');
                            location.reload();
                        } else {
                            alert('Failed to reject leave request.');
                        }
                    })
            }
        </script>

    </body>

    </html>