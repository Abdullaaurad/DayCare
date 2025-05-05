<!DOCTYPE html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/deletepopup.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/OTP.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Number.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Home.js?v=<?= time() ?>"></script>
    
</head>

<body style="overflow-x: hidden;">
    <div class="container">
        <!-- minimized sidebar -->
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul>
                <li class="selected">
                    <a href="<?= ROOT ?>/Parent/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
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
                        <i class="fas fa-calendar-alt"></i>
                        <span>Event
                            <span class="message-numbers" style="margin-left: 30px; padding: 6px 10px;"> 1
                            </span>
                        </span>
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
                    <a href="<?= ROOT ?>/Parent/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr>
        </div>
        <!-- navigation to choose child -->
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
                    <h2>Little Explorers</h2>
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
        <div class="main-content" style="overflow-y: scroll; overflow-x: hidden;">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="name">
                    <h1><?= isset($data['parent']['fullname']) ? $data['parent']['fullname'] : 'No name set'; ?></h1>
                    <p style="color: white">Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <!-- message icon -->
                <div class="bell-con" id="bell-container" style="cursor: pointer;">
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
            <div class="report-page">
                <H2 style="color: #2353A7; margin-left: 15px;margin-top:-8px">
                    <?= isset($data['parent']['lastname']) ? $data['parent']['lastname'] : 'No name set'; ?> Our Pillar of Strength
                </H2>
                <p style="margin-left: 15px; margin-bottom: 0px; color:#363636">
                    Today, we shine a spotlight on <?= isset($data['parent']['firstname']) ? $data['parent']['firstname'] : 'Our beloved parent'; ?>, the guiding light and heart of our family!
                </p>
                <div class="report-header">
                    <div class="profile" style="margin-right: 1%; width: 420px !important;">
                        <h3 style="margin-top: 10px !important; margin-bottom: 2px;">Child Profile</h3>
                        <hr>
                        <div class="first-row" style="display: flex; flex-direction: row;">
                            <div style="display: flex; flex-direction: column;">
                                <img
                                    src="<?php echo htmlspecialchars($data['children'][0]['image']); ?>"
                                    alt="parent profile pic"
                                    style="height: 150px; border: 2px solid lightgrey; border-radius: 5px;">
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" 
                                    style="background: radial-gradient(closest-side, white 79%, transparent 80% 100%), 
                                        conic-gradient(#3974ba <?= isset($data['children'][0]['graph']) ? $data['children'][0]['graph'] : 0 ?>%, 
                                        rgba(204, 204, 204, 0.56) <?= isset($data['children'][0]['graph']) ? $data['children'][0]['graph'] : 0 ?>%);">
                                    <span class="progress-text">
                                        <?= isset($data['children'][0]['graph']) ? $data['children'][0]['graph'] : 0 ?>%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <h3 style="margin-top: 0px !important;" id="fullname"> Child Name :

                        </h3>
                        <hr style="margin-top: -15px; margin-bottom: -10px;">
                        <div style="display: flex; flex-direction: row; justify-content: space-between;">
                            <div>
                                <div class="overdue-payment card" style="flex-direction: column; margin-top: 10px; padding: 10px 15px;">
                                    <div style="display: none;">
                                        <h4 class="activity-title"></h4>
                                        <div style="display: flex; flex-direction: row;">
                                            <h4 style="margin-top: -10px;">Description:</h4>
                                            <p class="activity-description" style="margin-top: -18px; margin-left: 5px;"></p>
                                        </div>
                                    </div>
                                    <h4 id="child-activity" style="text-align: center; display: block;">
                                        Child is not Present
                                    </h4>
                                </div>
                                <div style="display: flex; flex-direction: row; margin-top: 30px; margin-bottom: -30px;">
                                    <h4 style="margin-top: -10px;"> Upcoming Reservation : </h4>
                                    <p style="margin-top: -10px;" id="upcomingreservations"> </p>
                                </div>
                                <button class="button" id="Viewchild" style="margin: -40px 0px 0px 315px !important; padding: 15px 20px 15px 20px;" value=""> View Child
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="profile" style="width: 240px !important; margin-right: 1%;">
                        <h3 style="margin-top: 10px !important; margin-bottom: 2px;">Childrens</h3>
                        <hr>
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="child present" onclick="setChild('<?= isset($child['Id']) ? $child['Id'] : '' ?>')">
                                <img src="<?php echo htmlspecialchars($child['image']); ?>"
                                    alt="Child Profile Image"
                                    class='child-photo'>
                                <div class="child-info">
                                    <p class="child-name">
                                        <?= isset($child['fullname']) ? $child['fullname'] : 'No name set'; ?>
                                    </p>
                                    <p class="attendancestatus" style="color: <?= isset($child['Status']) && $child['Status'] == 'Absent' ? 'red' : 'green'; ?>;">
                                        <?= isset($child['Status']) ? $child['Status'] : 'Absent'; ?>
                                    </p>
                                </div>
                            </li>
                            <hr class="attendance-hr">
                        <?php endforeach; ?>
                    </div>
                    <!-- <div class="attendence-bar" style="width: 300px !important;">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="child present" onclick="setChildSession('<?= isset($child['name']) ? $child['name'] : '' ?>')">
                                <img src="<?= isset($child['image']) ? $child['image'] . '?v=' . time() : ROOT . '/Uploads/default_images/default_profile.jpg' ?>" 
                                    alt="Child Profile Image"
                                    class='child-photo'>
                                <div class="child-info">
                                    <p class="child-name">
                                        <?= isset($child['fullname']) ? $child['fullname'] : 'No name set'; ?>
                                    </p>
                                    <p class="attendancestatus">
                                        present
                                    </p>
                                </div>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </div> -->
                    <div class="profile">
                        <h3 style="margin-top: 10px !important; margin-bottom: 2px;">Child Payments</h3>
                        <hr>
                        <div class="overdue-payment card" style="justify-content: center; display: flex;">
                            <div style="margin-left: 20px; margin-right: 20px; margin-top:40px">
                                <?php if (isset($data['Due'])): ?>
                                    <h2 style="color: red; margin-top: -5px;">Overdue Payment</h2>
                                    <p>Due Date: <strong><?= $data['Due']['Date'] ?></strong></p>
                                    <p>Amount: <strong><?= $data['Due']['Amount'] ?></strong></p>
                                    <form id="pay-form" action="http://localhost/KiddoVille-UI_UX/App/core/Payment.php" method="GET">
                                        <input type="hidden" name="total" id="total-input" value="<?= $data['Due']['Amount']*100 ?>" />
                                        <button type="submit" class="pay-now">Pay Now</button>
                                    </form>
                                <?php else: ?>
                                    <h2 style="color: red; white-space: nowrap;">No Overdue Payment</h2>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="upcoming-payment card" style="justify-content: center; display: flex; margin-top: 20px;">
                            <div style="margin-left: -10px; margin-right: 20px;  margin-top:50px">
                                <?php if (isset($data['Expenses'])): ?>
                                    <h2 style="color: green; margin-top: -5px; margin-bottom: 25px;">Upcoming Payment</h2>
                                    <p>Due Date: <strong><?= $data['Expenses']['Date'] ?></strong></p>
                                    <p>Amount: <strong><?= $data['Expenses']['Amount'] ?></strong></p>
                                <?php else: ?>
                                    <h2 style="color: green;"> No Expenses </h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="profile">
                        <a href="#" class="main-menu-item">
                            <i class="fas fa-bullhorn icon-announcements"></i>
                            <span style="font-size: 15px;">Announcements</span>
                        </a>
                        <div class="announcement-list">
                            Example Announcements
                            <div class="announcement">
                                <p class="event-name" style="margin-top: 5px;">Winter Vacation</p>
                                <p class="event-date" style="margin-top: 5px;">11/02/2025</p>
                            </div>
                            
                            <div class="announcement">
                                <p class="event-name" style="margin-top: 5px;">Spring Field Trip</p>
                                <p class="event-date" style="margin-top: 5px;">11/02/2025</p>
                            </div>
                    
                            <div class="announcement">
                                <p class="event-name" style="margin-top: 5px;">Parent-Teacher Meeting</p>
                                <p class="event-date" style="margin-top: 5px;">11/02/2025</p>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="report-header">
                    <div class="timetable" style=" margin-right: 1%; width: 420px;">
                        <h3 style="margin-top: 10px !important; margin-bottom: 4px;"> Reminders </h3>
                        <hr>
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="color: #233E8D; background-color:transparent; padding-right: 4%;">Child</th>
                                    <th style="color: #233E8D; background-color:transparent; padding-left: 0%;">Description</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="table-body-container" style="max-height: 90px; overflow-y: auto; padding: 10px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tbody>
                                    <?php foreach ($data['reminders'] as $row): ?>
                                        <tr>
                                            <td><?= $row->Name ?></td>
                                            <td><?= $row->Description ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="profile" style="margin-right: 1%; width: 240px;">
                        <h3 style="margin-top: 10px !important; margin-bottom: 2px; white-space: nowrap;"> Meetings </h3>
                        <hr>
                        <?php if (isset($data['stat1'])): ?>
                            <div class="overdue-payment card" style="flex-direction: column; margin-top: 10px; padding: 5px 20px;">
                                <div style="display: flex; flex-direction: row;">
                                    <h4> Date : </h4>
                                    <p style="margin-top: 12px; margin-left: 5px;"> <?= isset($data['stat1']['Date'])? $data['stat1']['Date'] : '' ?> </p>
                                </div>
                                <div style="display: flex; flex-direction: row;">
                                    <h4 style="margin-top: -10px;"> Time : </h4>
                                    <p style="margin-top: -18px; margin-left: 5px;"> <?= isset($data['stat1']['Time'])? $data['stat1']['Time'] : '' ?>  </p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="overdue-payment card" style="justify-content: center;">
                                <h4 style="text-align: center; margin-top: 45px;">No meeting scheduled</h4>
                            </div>
                        <?php endif; ?>
                        <div style="display: flex; flex-direction: row;">
                            <?php if (!isset($data['stat1'])): ?>
                                <button class="button" id="openMeetingModal" style="width: 100%; margin: 10px;">Request</button>
                            <?php elseif(isset($data['stat1']) && $data['stat1']['today'] == 1): ?>
                                Meeting is Scheduled for today
                            <?php else: ?>
                                <button class="button" id="openMeetingModal" style="width: 100%; margin: 10px;">Edit</button>
                                <button class="button" id="ResetMeeting" style="width: 100%; margin: 10px;">Delete</button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="profile" style="width: 275px;">
                        <h3 style="margin-top: 10px !important; margin-bottom: 2px;"> Pickup </h3>
                        <hr>
                        <div class="overdue-payment card" style="margin-top: 10px; justify-content:center; align-items: center; text-align: center; padding: 5px 20px; display: <?=isset($data['stat2']['nochild'])? 'flex': 'none' ?>">
                            <h4> No child In daycare </h4>
                        </div>
                        <div class="overdue-payment card" style="flex-direction: column; margin-top: 10px; padding: 5px 20px; display: <?=isset($data['stat2']['nochild'])? 'none': 'flex' ?>">
                            <div style="display: flex; flex-direction: row;">
                                <h4> Time : </h4>
                                <p style="margin-top: 12px;  margin-left: 5px;"><?= isset($data['stat2']['Time'])? $data['stat2']['Time']: '' ?> </p>
                            </div>
                            <div style="display: flex; flex-direction: row;">
                                <h4 style="margin-top: -10px; white-space: nowrap;"> Person : </h4>
                                <p style="margin-top: -18px; margin-left: 5px;"> <?= isset($data['stat2']['Person'])? $data['stat2']['Person']: '' ?> </p>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: row; display: <?=isset($data['stat2']['nochild'])? 'none': 'flex' ?>">
                            <button class="button" id="openPickupModal" style="width: 100%; margin: 10px;"> Customize </button>
                            <?php if (($data['stat2']['Time'] !== '8:00PM' && $data['stat2']['Person'] !== 'Parent')): ?>
                                <button class="button" id="ResetPickupBtn" style="width: 100%; margin: 10px;"> Reset </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- schedule meetings -->
            <div class="modal" id="MeetingModal">
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
                    <h1>daycare meeting slots</h1>
                    <form id="meeting-form" method="post" enctype="multipart/form-data" action="<?=ROOT?>/Parent/Home/handlemeetings">
                        <div class="pickup-section">
                            <label for="time">Choose prfered time slot</label>
                            <table>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th style="width: 30px;">Choose</th>
                                </tr>
                                <?php if (!empty($data['Meetingslots'])): ?>
                                    <?php foreach ($data['Meetingslots'] as $meeting): ?>
                                        <tr>
                                            <td style="text-align: center;"><?= htmlspecialchars($meeting->Date) ?></td>
                                            <td style="text-align: center;"><?= htmlspecialchars($meeting->Time) ?></td>
                                            <td style="text-align: center;">
                                                <input type="radio" <?=($meeting->Scheduled)? 'checked': '' ?> name="meeting_slot" style="width: 10px;" value="<?= htmlspecialchars($meeting->MeetingID) ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center;">No meeting slots available</td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        <p id="meeting-error" style="color: red; display: none;"> </p>
                        <div class="button-popup" style="margin-top: 15px;">
                            <button style="margin-right: 230px;" type="button" id="closemeetingBtn">Cancel</button>
                            <button type="submit">Done</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- to create custom meetings -->
            <!-- <div class="modal" id="customMeetingModal">
                <div class="pickup-popup">
                    <div class="top-con">
                        <div class="back-con">
                            <i class="fas fa-chevron-left" id="backforcustommeeting"></i>
                        </div>
                        <div class="refresh-con" id="meetingrefreshcon">
                            <i class="fas fa-refresh" id="custommeetingrefresh"
                                style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                        </div>
                    </div>
                    <h1>daycare meeting slots</h1>
                    <form id="custommeeting-form">
                        <div class="pickup-section">
                            <label for="date">Date</label>
                            <input required id="customdate" type="date">
                        </div>
                        <div class="pickup-section">
                            <label>Time</label>
                            <input required min="08:00" max="17:00" step="900" id="customtime" type="time">
                        </div>
                        <div class="button-popup">
                            <button style="margin-right: 230px;" id="closecustommeetingBtn">Cancel</button>
                            <button type="submit">Done</button>
                        </div>
                    </form>
                </div>
            </div> -->
            <!-- to scheule pickups -->
            <form id="pickupForm" method="post" enctype="multipart/form-data" action="<?=ROOT?>/Parent/Home/handlePickups">
            <div class="modal" id="pickupModal">
                <div class="pickup-popup">
                    <div class="top-con">
                        <div class="back-con">
                            <i class="fas fa-chevron-left" id="backforpickup"></i>
                        </div>
                        <div class="refresh-con">
                            <i class="fas fa-refresh" id="pickuprefresh"
                                style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                        </div>
                    </div>
                    <h1>Schedule pickup</h1>
                    <form id="pickupForm">
                        <div class="pickup-section">
                            <label for="Time">Select Time <span id="red-star" class="red-star"> *</span></label>
                            <input name="Time" style="width: 330px;" id="pickuptime" required class="time" type="time" value="<?= isset($data['stat2']['Time'])? $data['stat2']['Time'] : '' ?>" min="08:00" max="20:00" />
                            <p id="timeError" style="color: red; display: none;"></p>
                        </div>
                        <div class="pickup-section">
                            <label for="OTP">Provide OTP <span id="red-star" class="red-star"> *</span></label>
                            <input name="OTP"
                                style="width: 330px;"
                                id="pickupotp"
                                required
                                class="time"
                                type="number"
                                maxlength="6"
                                oninput="this.value = this.value.slice(0, 6);"
                                value="<?= isset($data['stat2']['OTP']) ? $data['stat2']['OTP'] : '' ?>" />
                            <p id="otpError" style="color: red; display: none;"></p>
                        </div>
                        <div class="pickup-section" id="PickupNID" style="display: <?= isset($data['stat2']['NID']) ? 'block' : 'none' ?>;">
                            <label for="NID">Provide NID <span id="red-star" class="red-star"> *</span></label>
                            <input name="NID"
                                style="width: 330px;"
                                id="Newnid"
                                class="time"
                                type="number"
                                maxlength="12" <?= isset($data['stat2']['NID']) ? 'required' : '' ?>
                                oninput="this.value = this.value.slice(0, 12);"
                                value="<?= isset($data['stat2']['NID']) ? $data['stat2']['NID'] : '' ?>" />
                            <p id="nidError" style="color: red; display: none;"></p>
                        </div>
                        <div class="pickup-section">
                            <label>Select person for pickup</label>
                            <div class="person-section" style="display: flex; flex-direction: row; align-items: flex-start">
                                <div class="person-container" style="display: flex; flex-direction: row;padding: 5px 10px; border-radius: 10px; cursor:pointer; background-Color: #ADD8E6"
                                    onclick="selectPerson('Guardian')">
                                    <input type="radio" name="Person" id="guardianRadio" value="guardian" hidden>
                                    <img id="guardianImage" alt="Guardian's photo" height="50" src="<?php echo(htmlspecialchars($data['guardian']['Image'])); ?>" width="50" />
                                    <div class="person-info">
                                        <span><?= $data['guardian']['name'] ?></span>
                                    </div>
                                </div>
                                <div class="add-person-container" style="display: flex; flex-direction: row;padding: 5px 10px; margin-left: 0px;" id="add-person">
                                    <label for="newPersonImageInput" class="add-person"
                                        style="margin-right: 2px; width: 55px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #ddd; cursor: pointer;">
                                        +
                                    </label>
                                    <input type="file" id="newPersonImageInput" name="newPersonImage" accept="image/*" style="display: none;"
                                        onchange="previewNewPersonImage(event)">
                                </div>

                                <div class="person-container" id="newPersonContainer"  style="display: none;padding: 5px 10px; flex-direction: row; margin-left: 10px; padding: 5px 10px; border-radius: 10px; cursor:pointer;" onclick="selectPerson('New')">
                                    <input type="radio" name="Person" id="newPersonRadio" value="new" hidden>
                                    <img id="newPersonImage" alt="New person's photo" height="50" width="50" />
                                </div>
                            </div>
                            <input type="hidden" name="PersonType" id="selectedPersonType" value="Guardian">
                        </div>
                        <div class="button-popup" style="margin-top: 10px;">
                            <button style="margin-right: 230px;" id="closeModalBtn">Cancel</button>
                            <button>Done</button>
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div>
        <!-- to schedule visits -->
        <div class="modal" id="visitModal">
            <div class="pickup-popup">
                <div class="top-con">
                    <div class="back-con">
                        <i class="fas fa-chevron-left" id="backforvisit"></i>
                    </div>
                    <div class="refresh-con">
                        <i class="fas fa-refresh" id="visitrefresh"
                            style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                    </div>
                </div>
                <h1>Schedule Visits</h1>
                <form id="visitForm">
                    <div class="pickup-section">
                        <label for="time">Select Date <span id="red-star3" class="red-star"> *</span> </label>
                        <p style="color: lightgray; margin-top: -28px; margin-left: 100px;"> May 2024 </p>
                        <div class="dates">
                            <div class="date">
                                <p class="whichday">Mon</p>
                                <h1 class="day">14</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Tue</p>
                                <h1 class="day">15</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Wed</p>
                                <h1 class="day">16</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Thu</p>
                                <h1 class="day">17</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Fri</p>
                                <h1 class="day">18</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Sat</p>
                                <h1 class="day">19</h1>
                            </div>
                            <div class="date">
                                <p class="whichday">Sun</p>
                                <h1 class="day">20</h1>
                            </div>
                        </div>
                        <i class="fa fa-chevron-right"
                            style="font-size: 30px; margin-top: -65px; margin-left: 350px; color: #233E8D;"></i>
                    </div>
                    <div class="pickup-section" style="display: flex; flex-direction: column;">
                        <label>Select Date <span id="red-star4" class="red-star"> *</span></label>
                        <div class="time-list">
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                        </div>
                        <div class="time-list">
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                            <div class="time">
                                <p> 9:00 - 9:15 AM</p>
                            </div>
                        </div>
                    </div>
                    <div class="pickup-section">
                        <label for="otp">Contact details <span id="red-star5" class="red-star"> *</span></label>
                        <input class="number" id="number" placeholder="071-481-0928" type="text" maxlength="12" />
                        <small>Enter your contact number</small>
                    </div>
                    <div class="terms" id="agree">
                        <input required type="checkbox" style="box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);" />
                        <label for="number">
                            I agree to the
                            <a href="#">Terms of Service</a>
                        </label>
                    </div>
                    <div class="button-popup">
                        <button style="margin-right: 230px;" id="closeVisitModalBtn">Cancel</button>
                        <button type="submit">Done</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- profile card -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png" width="100"
                class="profile" />
            <h2>Thilina Perera</h2>
            <p>Student    RS0110657</p>
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Parent/ParentProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Parent/GuardianProfile'">
                Guardian profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Parent/ManageChildren'">
                Manage Children
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
        <div class="tasks" id="taskbtn" style="position: fixed;">
            <i class="fas fa-chevron-left" id="taskicon"></i>
        </div>
    </div>

    <div class="verification-alert" id="alert" style="display: none; top: 5%;">
        <div class="alert-icon">
            <img src="<?= IMAGE ?>/success.svg" id="alert-img" alt="success icon">
        </div>
        <div class="alert-message">
            <h1 id="alert-message">Success</h1>
        </div>
    </div>
    
    <div id="deletePopup" class="delete-popup-overlay" style="position: fixed;">
        <div class="delete-popup-content">
            <p>Are you sure you want to Cancel meeting?</p>
            <div class="delete-popup-buttons">
                <button id="confirmDelete" class="delete-popup-btn delete-popup-confirm" onclick=" DeleteMeeting()  ">Yes</button>
                <button id="cancelDelete" class="delete-popup-btn delete-popup-cancel" onclick="document.getElementById('deletePopup').style.display='none'">No</button>
            </div>
        </div>
    </div>

    <div id="deletePopup1" class="delete-popup-overlay" style="position: fixed;">
        <div class="delete-popup-content">
            <p>Are you sure you want to Reset Pickup details?</p>
            <div class="delete-popup-buttons">
                <button id="confirmDelete" class="delete-popup-btn delete-popup-confirm" onclick=" ResetPickup()">Yes</button>
                <button id="cancelDelete" class="delete-popup-btn delete-popup-cancel" onclick="document.getElementById('deletePopup').style.display='none'">No</button>
            </div>
        </div>
    </div>

    <script>

    const meetingform = document.getElementById('meeting-form');
    const alert = document.getElementById('alert');
    const alertmessage = document.getElementById('alert-message');
    const MeetingModal = document.getElementById('MeetingModal');
    const alertimg =  document.getElementById('alert-img');
    const meetingerror = document.getElementById('meeting-error');

    meetingform.addEventListener("submit", function(event) {
        event.preventDefault();
        const formData = new FormData(meetingform);

        fetch(meetingform.action, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                MeetingModal.style.display = 'none';
                alertmessage.textContent = data.message || "Meeting scheduled successfully!";
                alert.style.display = 'flex';
                meetingerror.style.display = 'none';

                setTimeout(() => {
                    alert.style.display = 'none';
                    location.reload();
                }, 2000);
            } else {
                // Determine error type
                const errorText = data.error?.toLowerCase() || "";

                if (errorText.includes("meeting slot")) {
                    // Show in meetingerror div
                    meetingerror.style.display = 'flex';
                    meetingerror.textContent = data.error;
                    alert.style.display = 'none';
                } else {
                    // Show in alert box
                    alertmessage.textContent = data.error || "Something went wrong.";
                    alert.style.display = 'flex';
                    meetingerror.style.display = 'none';
                }
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alertmessage.textContent = "An unexpected error occurred.";
            alert.style.display = 'flex';
            meetingerror.style.display = 'none';
        });
    });

    const pickupModal = document.getElementById('pickupModal');
    const pickupForm = document.getElementById('pickupForm');
    const bannedOtps = ["000000", "111111", "123456", "654321", "999999", "222222", "333333"];

    function validateOTP(input) {
        input.value = input.value.slice(0, 6); // Always limit to 6 digits

        const otpError = document.getElementById('otpError');
        if (bannedOtps.includes(input.value)) {
            otpError.textContent = "This OTP is too common. Please choose a different one.";
            otpError.style.display = 'block';
            return false; // Invalid OTP
        } else {
            otpError.textContent = "";
            otpError.style.display = 'none';
            return true; // Valid OTP
        }
    }

    const nidInput = document.getElementById('Newnid');
    const otpInput = document.getElementById('pickupotp');
    const nidError = document.getElementById('nidError');

    // NID Validation on input
    nidInput.addEventListener('input', function() {
        const value = nidInput.value.trim();

        if (value.length !== 12) {
            nidError.textContent = "NID must be exactly 12 digits.";
            nidError.style.display = 'block';
        } else {
            nidError.style.display = 'none';
        }
    });

    pickupForm.addEventListener("submit", function(event){
        event.preventDefault();
        const otpInput = document.getElementById('pickupotp');
        const isValidOtp = validateOTP(otpInput);

        if (!isValidOtp) {
            return;
        }
        if(nidInput.style.display === 'block') {
            return;
        }
        const formData = new FormData(pickupForm);

        fetch(pickupForm.action, {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alertmessage.textContent = data.message || "Pickup scheduled successfully!";
                alert.style.display = 'flex';
                pickupModal.style.display = 'none';

                setTimeout(() => {
                    alert.style.display = 'none';
                    location.reload();
                }, 2000);
            } else {
                // Handle validation error (e.g., time)

                alertmessage.textContent = "Failed to schedule pickup.";
                alert.style.display = 'flex';
                setTimeout(() => {
                    alert.style.display = 'none';
                    pickupModal.style.display = 'fixed';
                    const timeError = document.getElementById("timeError");
                    if (timeError) {
                        timeError.textContent = data.error;
                        timeError.style.display = 'block';
                    }
                }, 2000);
            }
        })
        .catch(error => {
            console.error("AJAX Error:", error);
            alertmessage.textContent = "Unexpected error occurred.";
            alert.style.display = 'flex';
        });
    });

    const messageDropdown = document.getElementById('messageDropdown');
    const bellIcon = document.getElementById('bell-container');
    const messagenumber = document.getElementById('message-number')

    function toggleBellDropdown() {
        if(messageDropdown){
            if (messageDropdown.style.display === "none" || !messageDropdown.style.display) {
                messageDropdown.style.display = "block";
                w
                
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
            const PickupNID = document.getElementById('PickupNID');

            <?php if (!empty($_SESSION['APP']['MINIMIZE'])): ?>
                sidebar.classList.add('minimized');
                starImage.classList.add('show');
                logo.classList.add('hidden');
                kiddo.classList.add('hidden');
            <?php endif; ?>
        
            let selectedPerson = "Guardian"; // Default selection
            const guardianContainer = document.querySelector(".person-container[onclick=\"selectPerson('Guardian')\"]");
            const newPersonContainer = document.getElementById("newPersonContainer");
            const addPersonSection = document.getElementById("add-person");
            const selectedPersonTypeInput = document.getElementById("selectedPersonType");
            const guardianRadio = document.getElementById("guardianRadio");
            const newPersonRadio = document.getElementById("newPersonRadio");
            const Newnid = document.getElementById('Newnid');

            function selectPerson(personType) {
                if (personType === "Guardian") {
                    selectedPerson = "Guardian";

                    // ✅ Highlight Guardian
                    guardianContainer.style.backgroundColor = "#ADD8E6"; // Light blue background
                    newPersonContainer.style.backgroundColor = "transparent"; // Reset new person background

                    // ✅ Update selected person
                    guardianRadio.checked = true;
                    newPersonRadio.checked = false;
                    selectedPersonTypeInput.value = "Guardian";

                    PickupNID.style.display = 'none';
                    Newnid.required = false;

                } else if (personType === "New") {
                    selectedPerson = "New";

                    // ✅ Highlight New Person
                    newPersonContainer.style.backgroundColor = "#ADD8E6"; // Light blue background
                    guardianContainer.style.backgroundColor = "transparent"; // Reset guardian background

                    // ✅ Hide "Add New Person" section
                    addPersonSection.style.display = "none";

                    // ✅ Update selected person
                    newPersonRadio.checked = true;
                    guardianRadio.checked = false;
                    selectedPersonTypeInput.value = "New";

                    PickupNID.style.display = 'block';
                    Newnid.required = true;
                }
            }

        function previewNewPersonImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("newPersonImage").src = e.target.result;
                    document.getElementById("newPersonContainer").style.display = "flex";
                    document.getElementById("add-person").style.display = "none";
                    newPersonContainer.style.backgroundColor = "#ADD8E6";
                    guardianContainer.style.backgroundColor = "transparent";
                    selectPerson("New");
                };
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener("DOMContentLoaded", function () {

            const pickupotp = document.getElementById("pickupotp");

            pickupotp.addEventListener('input', function () {
                const lol = validateOTP(pickupotp);
            });

            // minimizeBtn.addEventListener('click', function() {
            //     fetch("<?=ROOT?>/Parent/Home/minimize", {
            //         method: "POST",
            //         credentials: "same-origin"
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         if (data.success) {
            //             console.log("Sidebar minimized state saved successfully.");
            //         } else {
            //             console.log("Failed to save sidebar minimized state.");
            //         }
            //     })
            //     .catch(error => console.error("Error:", error));
            // });

            let selectedPerson = "Guardian"; // Default selection
            const guardianContainer = document.querySelector(".person-container[onclick=\"selectPerson('Guardian')\"]");
            const newPersonContainer = document.getElementById("newPersonContainer");
            const addPersonSection = document.getElementById("add-person");
            const selectedPersonTypeInput = document.getElementById("selectedPersonType");
            const guardianRadio = document.getElementById("guardianRadio");
            const newPersonRadio = document.getElementById("newPersonRadio");

            function selectPerson(personType) {
                if (personType === "Guardian") {
                    selectedPerson = "Guardian";

                    // ✅ Highlight Guardian
                    guardianContainer.style.backgroundColor = "#ADD8E6"; // Light blue background
                    newPersonContainer.style.backgroundColor = "transparent"; // Reset new person background

                    // ✅ Show "Add New Person" option
                    addPersonSection.style.display = "flex";

                    // ✅ Update selected person
                    guardianRadio.checked = true;
                    newPersonRadio.checked = false;
                    selectedPersonTypeInput.value = "Guardian";
                } else if (personType === "New") {
                    selectedPerson = "New";

                    // ✅ Highlight New Person
                    newPersonContainer.style.backgroundColor = "#ADD8E6"; // Light blue background
                    guardianContainer.style.backgroundColor = "transparent"; // Reset guardian background

                    // ✅ Hide "Add New Person" section
                    addPersonSection.style.display = "none";

                    // ✅ Update selected person
                    newPersonRadio.checked = true;
                    guardianRadio.checked = false;
                    selectedPersonTypeInput.value = "New";
                }
            }

            let savedPerson = "<?= isset($data['stat2']['Person']) ? $data['stat2']['Person'] : 'Guardian' ?>";
            if (savedPerson === "New") {
                selectPerson("New");

                let newPersonImage = "<?= isset($data['stat2']['Image']) ? $data['stat2']['Image'] : '' ?>";
                if (newPersonImage) {
                    document.getElementById("newPersonImage").src = newPersonImage;
                    newPersonContainer.style.display = "flex";
                }
            } else {
                selectPerson("Guardian");
            }
        });

        function logoutUser() {
            fetch("<?= ROOT ?>/Parent/Home/Logout", {
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

        const childrenData = <?php echo json_encode($data['children']); ?>;

        function setChild(childId) {
            const selectedChild = childrenData.find(child => child.Id == childId);

            if (selectedChild) {
                // Update the child profile image
                const childProfileImage = document.querySelector(".first-row img");
                if (childProfileImage) {
                    childProfileImage.src = selectedChild.image ? selectedChild.image : "default-profile.png";
                    childProfileImage.alt = selectedChild.fullname ? `${selectedChild.fullname}'s profile picture` : "Child Profile Picture";
                }

                // Update the child name
                const childNameElement = document.getElementById("fullname");
                if (childNameElement) {
                    childNameElement.innerHTML = `Child Name: ${selectedChild.fullname ? selectedChild.fullname : "No name set"}`;
                }

                // Get activity elements
                const activityTitle = document.querySelector(".activity-title");
                const activityDescriptionElement = document.querySelector(".activity-description");
                const activityContainer = activityTitle.closest("div"); // Get the parent <div> to show/hide
                const childNotPresentElement = document.getElementById("child-activity");

                if (selectedChild.Activity && selectedChild.Activity !== "Child not present") {
                    // Show activity and update details
                    activityContainer.style.display = "block";
                    childNotPresentElement.style.display = "none"; // Hide "Child is not Present" message

                    activityTitle.innerHTML = `Activity: ${selectedChild.Activity}`;
                    activityDescriptionElement.innerText = `${selectedChild.Description}`;
                } else {
                    // Show "Child is not Present" and hide activity details
                    activityContainer.style.display = "none";
                    childNotPresentElement.style.display = "block";
                }

                // Update the progress bar
                const progressBar = document.querySelector(".progress-bar");
                if (progressBar) {
                    let percentage = selectedChild.graph || 0;
                    progressBar.innerHTML = `${percentage} %`;
                    progressBar.style.background = `radial-gradient(closest-side, white 79%, transparent 80% 100%), 
                                                        conic-gradient(#3974ba ${percentage}%, rgba(204, 204, 204, 0.56) ${percentage}% 100%)`;
                }

                // Update upcoming reservations
                const upcomingReservations = document.getElementById('upcomingreservations');
                console.log(upcomingReservations.innerHTML = selectedChild.upcomingreservations)
                if (selectedChild.upcomingreservations !== undefined && selectedChild.upcomingreservations !== null) {
                    upcomingReservations.innerHTML = selectedChild.upcomingreservations;
                } else {
                    upcomingReservations.innerHTML = "No Reservations";
                }

                // Set the child ID in the view button
                const Viewchildbtn = document.getElementById("Viewchild");
                if (Viewchildbtn) {
                    Viewchildbtn.value = childId;
                }
            }
        }

        const deletePopup = document.getElementById('deletePopup');

        function DeleteMeeting(){
            deletePopup.style.display = 'none';
            fetch("<?= ROOT ?>/parent/home/deleteMeeting", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert.style.display = 'flex';
                    setTimeout (() => {
                        meetingform.submit();
                        alert.style.display = 'none'; 
                        location.reload();
                        alertimg.src = '<?=IMAGE?>/success.svg';
                        alertmessage.textContent = "Success";
                    }, 2000);
                }
                else{
                    alert.style.display = 'flex';
                    alertimg.src = '<?=IMAGE?>/faile.svg';
                    alertmessage.textContent = "Failed";
                }
            })
            .catch(error => console.error("Error:", error));
        }

        const deletePopup1 = document.getElementById('deletePopup1');
        function ResetPickup(){
            deletePopup1.style.display = 'none';
            fetch("<?= ROOT ?>/parent/home/deletePickup", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                if (data.success) {
                    alert.style.display = 'flex';
                    setTimeout (() => {
                        pickupForm.submit();
                        alert.style.display = 'none'; 
                        location.reload();
                        alertimg.src = '<?=IMAGE?>/success.svg';
                        alertmessage.textContent = "Success";
                    }, 2000);
                }else{
                    alert.style.display = 'flex';
                    alertimg.src = '<?=IMAGE?>/faile.svg';
                    alertmessage.textContent = "Failed";
                }
            })
            .catch(error => console.error("Error:", error));
        }

        document.addEventListener("DOMContentLoaded", function() {

            const ResetPickup = document.getElementById("ResetPickupBtn");
            const deletePopup1 = document.getElementById('deletePopup1');
            if(ResetPickup){
                ResetPickup.addEventListener("click", function () {
                    console.log("Deleting the pickup");
                    deletePopup1.style.display = 'flex';
                });
            }

            const ResetMeeting = document.getElementById("ResetMeeting");
            const deletePopup = document.getElementById('deletePopup');

            if(ResetMeeting){
                ResetMeeting.addEventListener("click", function () {
                    console.log("Deleting the meeting");
                    deletePopup.style.display = 'flex';
                });
            }

            if (childrenData.length > 0) {
                setChild(childrenData[0].Id);
            }

            const Viewchildbtn = document.getElementById("Viewchild");

            Viewchildbtn.addEventListener("click", function() {
                setChildSession(this.value)
            });

            document.getElementById("pickuprefresh").addEventListener("click", function() {
                const guardianContainer = document.querySelector(".person-container[onclick*='guardian']");
                const newPersonContainer = document.getElementById("newPersonContainer");
                const newPersonRadio = document.getElementById("newPersonRadio");
                const selectedPersonType = document.getElementById("selectedPersonType");

                // Reset the hidden input value to "parent"
                selectedPersonType.value = "guardiant";
                
                // Reset radio buttons
                parentRadio.checked = true;
                newPersonRadio.checked = false;

                // Reset background colors
                guardianContainer.style.backgroundColor = "#add1e1"; // Highlight parent by default
                newPersonContainer.style.backgroundColor = "transparent";

                // Reset New Person Image and Hide it
                const newPersonImage = document.getElementById("newPersonImage");
                newPersonImage.src = ""; 
                newPersonContainer.style.display = "none"; // Hide the new person section

                // Show the "Add Person" button again
                const addPersonButton = document.getElementById("add-person");
                addPersonButton.style.display = "flex";

                // Reset the file input
                const newPersonImageInput = document.getElementById("newPersonImageInput");
                newPersonImageInput.value = ""; 

                // Reset the entire form if needed
                const form = document.querySelector("form");
                if (form) {
                    form.reset();
                }
            });
        });
    </script>
</body>

</html>