<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/reservation.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Stats.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Table1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Alert.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="container">
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
                <li class="selected">
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
        </div>
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
        <div class="main-content" id="main-content">
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
                    <h3><img src="<?= IMAGE ?>/reservation.svg?v=<?= time() ?>" alt="Attendance">Accepted reservation</h3>
                    <p style="margin-bottom: 3px;"><?= isset($data['Approved']) ? $data['Approved'] : '0'; ?> reservations</p>
                    <span style="font-weight: 50;">Reservations been scheduled</span>
                </div>
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/pending.svg?v=<?= time() ?>" alt="Attendance">Pending reservation</h3>
                    <p style="margin-bottom: 3px;"><?= isset($data['Pending']) ? $data['Pending'] : '0'; ?> reservation</p>
                    <span style="font-weight: 50;">The reservation has not been accepted by maid
                        yet</span>
                </div>
                <div class="stat">
                    <h3 style="margin-top: -16px;"><img src="<?= IMAGE ?>/cancel.svg?v=<?= time() ?>" alt="Attendance">Canceled reservation</h3>
                    <p style="margin-bottom: 3px;"><?= isset($data['Canceled']) ? $data['Canceled'] : '0'; ?> reservations</p>
                    <span style="font-weight: 50;">The reservation has not been canceled</span>
                </div>
                <!-- <div class="stat">
                    <h3 style="margin-top: -16px;"><img src="<?= IMAGE ?>/calendar-plus-solid.svg?v=<?= time() ?>" alt="Attendance">Make reservation</h3>
                    <div class="lol" id="newreservationbtn" style="cursor: pointer; margin-bottom: -100px; margin-top: 20px;">
                        <p>Create</p>
                    </div>
                </div> -->
            </div>
            <div class="saperate">
                <div class="modal" id="NewReservationModal">
                    <div class="Edit-Reservation">
                        <form id="NewReservationForm" method="post">
                            <div class="pickup-popup">
                                <div class="top-con">
                                    <div class="back-con">
                                        <i class="fas fa-chevron-left" id="backfornewreservation"></i>
                                    </div>
                                    <div class="refresh-con">
                                        <i class="fas fa-refresh" id="newreservationrefresh"></i>
                                    </div>
                                </div>
                                <h1>Make Reservation</h1>
                                <div class="pickup-section" style="display: flex; flex-direction: row; justify-content:space-between;">
                                    <label for="time">Select Date <span id="red-star6" class="red-star"> *</span>
                                    </label>
                                    <p> May 2024
                                    </p>
                                    <div class="dates">
                                        <?php foreach ($data['dates'] as $date): ?>
                                            <div class="date">
                                                <p class="whichday"><?= $date['dayName'] ?></p>
                                                <h1 class="day"><?= $date['day'] ?></h1>
                                            </div>
                                        <?php endforeach ?>
                                        <input type="hidden" name="Date" id="date-inputforpost" required />
                                    </div>
                                    <p class="error"> <?= isset($data['errors']['Date']) ? $data['errors']['Date'] : '' ?> </p>
                                </div>
                                <div class="pickup-section Time">
                                    <div style="display: flex; flex-direction: row; justify-content:space-between;">
                                        <div>
                                            <label>Start Time :<span id="red-star7" class="red-star"> *</span></label>
                                            <input name="Start_Time" type="time" required step="900" min="08:00" max="20:00"
                                                value="<?= isset($data['values']['Start_Time']) ? $data['values']['Start_Time'] : '' ?>" id="customtime1">
                                            <p class="error"><?= isset($data['errors']['Start_Time']) ? $data['errors']['Start_Time'] : '' ?></p>
                                        </div>
                                        <div>
                                            <label>End Time :<span id="red-star8" class="red-star"> *</span></label>
                                            <input name="End_Time" type="time" required step="900" min="08:00" max="20:00"
                                                value="<?= isset($data['values']['End_Time']) ? $data['values']['End_Time'] : '' ?>" id="customtime1">
                                            <p class="error"><?= isset($data['errors']['End_Time']) ? $data['errors']['End_Time'] : '' ?></p>
                                        </div>
                                    </div>
                                    <p class="error"><?= isset($data['errors']['Time']) ? $data['errors']['Time'] : '' ?></p>
                                </div>
                                <div class="pickup-section">
                                    <label>Special notes</label>
                                    <input type="text" placeholder="put to sleep at 8:00 PM" name="Notes"
                                        value="<?= isset($data['values']['Notes']) ? $data['values']['Notes'] : '' ?>">
                                </div>
                                <div class="button-popup">
                                    <button id="closenewReservation">Cancel</button>
                                    <button type="submit" name="makereservation" value="new-reservation">Done</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal" id="ReservationModal">
                    <div class="Edit-Reservation">
                        <form id="ReservationEditForm">
                            <div class="pickup-popup">
                                <div class="top-con">
                                    <div class="back-con">
                                        <i class="fas fa-chevron-left" id="backforreservationedit"></i>
                                    </div>
                                    <div class="refresh-con">
                                        <i class="fas fa-refresh" id="reservationeditrefresh"></i>
                                    </div>
                                </div>
                                <h1>Edit Reservation</h1>
                                <form id="visitForm">
                                    <div class="pickup-section">
                                        <label for="time">Select Date <span id="red-star3" class="red-star" style="display: none;"> *</span>
                                        </label>
                                        <p> May 2024
                                        </p>
                                        <div class="dates">
                                            <div class="date select">
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
                                    </div>
                                    <div class="pickup-section" style="display: flex; flex-direction: column;">
                                        <label for="time">Select Time <span id="red-star4" class="red-star" style="display: none;">
                                                *</span></label>
                                        <input id="settime" type="time" value="08:00">
                                    </div>
                                    <div class="pickup-section">
                                        <label for="otp"> Speacial notes </label>
                                        <input class="text" id="text" placeholder="some notes" type="text"
                                            maxlength="12" />
                                    </div>
                                    <div class="button-popup">
                                        <button id="closeReservationedit">Cancel</button>
                                        <button type="submit">Done</button>
                                    </div>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal" id="ReservationViewModal">
                    <div class="Edit-Reservation">
                        <form id="ReservationViewForm">
                            <div class="pickup-popup">
                                <div class="top-con">
                                    <div class="back-con">
                                        <i class="fas fa-chevron-left" id="backforreservation"></i>
                                    </div>
                                    <div class="refresh-con">
                                        <i class="fas fa-refresh" id="reservationrefresh"></i>
                                    </div>
                                </div>
                                <h1>View Reservation</h1>
                                <div class="pickup-section">
                                    <div>
                                        <label>Status :<span style="color: black">Approved</span></label>
                                    </div>
                                    <div>
                                        <label>Child :<span style="color: black">Abdulla</span></label>
                                    </div>
                                </div>
                                <div class="pickup-section">
                                    <div>
                                        <label>Date :</label>
                                        <input readonly type="date" value="2024-08-18">
                                    </div>
                                    <div>
                                        <label>End Date :</label>
                                        <input readonly type="date" value="2024-08-19">
                                    </div>
                                </div>
                                <div class="pickup-section">
                                    <div>
                                        <label>Start Time :</label>
                                        <input readonly type="time" value="08:00" style="width: 130px">
                                    </div>
                                    <div>
                                        <label>End Time :</label>
                                        <input readonly type="time" value="20:00" style="width: 130px">
                                    </div>
                                </div>
                                <div class="pickup-section">
                                    <div>
                                        <label>Maid</label>
                                        <div class="person-section" style="width: 130px">
                                            <img alt="Person's photo" height="50" src="<?= IMAGE ?>/face.jpeg" width="50" />
                                            <div class="person-info">
                                                <span>Abdulla</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label>Special notes</label>
                                        <textarea readonly class="resize" type="text"> put to sleep at 8:00 PM</textarea>
                                    </div>
                                </div>
                                <div class="button-popup">
                                    <button id="">Cancel</button>
                                    <button type="submit">Done</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="modal" id="RatingModal">
                    <div class="Give-Rating">
                        <div class="top-con">
                            <div class="back-con">
                                <i class="fas fa-chevron-left" id="backforrating"></i>
                            </div>
                            <div class="refresh-con">
                                <i class="fas fa-refresh" id="ratingrefresh"></i>
                            </div>
                        </div>
                        <form id="ratingform">
                            <h1>Review and Rating</h1>
                            <label for="package-name">Reason</label>
                            <input id="package-name" type="text" placeholder="Reason for the review" />
                            <label for="included-services">Your review</label>
                            <textarea class="services" id="included-services"
                                placeholder="Provided a good service. The child was so happy. but the he left his toy at the daycare"></textarea>
                            <label for="price">Add your rating</label>
                            <div class="rating pickup-section">
                                <i class="star-rate fas fa-star" data-value="5"></i>
                                <i class="star-rate fas fa-star" data-value="4"></i>
                                <i class="star-rate fas fa-star" data-value="3"></i>
                                <i class="star-rate fas fa-star" data-value="2"></i>
                                <i class="star-rate fas fa-star" data-value="1"></i>
                            </div>
                            <div class="button-popup">
                                <button id="closeratingBtn">Cancel</button>
                                <button class="Ratingsubmit" type="submit">Done</button>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
            <div class="saperate">
                <div class="Table1">
                    <div class="togglediv">
                        <div class="toggle">
                            <label class="background" for="toggle"></label>
                            <div class="up-hi">
                                <label class="up-btn" id="up-btn">Upcoming</label>
                                <label class="hi-btn" id="hi-btn">History</label>
                            </div>
                        </div>
                        <h2> Reservations </h2>
                        <hr>
                    </div>
                    <div class="filters">
                        <input type="date" max="<?= (date('Y-m-d')); ?>" id="datePicker">
                        <select id="statusPicker">
                            <option value="">All</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Canceled">Canceled</option>
                        </select>
                        <select id="childPicker">
                            <option Value="" selected> All </option>
                            <?php foreach ($data['children'] as $child): ?>
                                <option value="<?= $child['name']; ?>">
                                    <?= $child['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <table id="upcoming">
                        <thead>
                            <tr>
                                <th>Res ID</th>
                                <th>Child</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <table id="history" style="display: none;">
                        <thead>
                            <tr>
                                <th>Child</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>


                </div>
            </div>

        </div>
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <p>Are you sure you want to delete this reservation?</p>
                <button id="confirmDelete" onclick="confirmDelete()">Yes</button>
                <button onclick="closeModal()">Cancel</button>
            </div>
        </div>
        <div class="verification-alert" id="alert">
            <div class="alert-icon">
                <img src="<?= IMAGE ?>/success.svg" alt="success icon">
            </div>
            <div class="alert-message">
                <h1>Success</h1>
            </div>
        </div>
        <!-- onclick function -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow" class="back">
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
            fetch("<?= ROOT ?>/Parent/resevation/Logout", {
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
            fetch(' <?= ROOT ?>/Parent/Reservation/setchildsession', {
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
                        console.log("Child name set in session.");
                        window.location.href = '<?= ROOT ?>/Child/Reservation';
                    } else {
                        console.error("Failed to set child name in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        <?php if (isset($_SESSION['success']) && $_SESSION['success'] === true): ?>
            document.getElementById('alert').classList.add('showl');
            setTimeout(function() {
                document.getElementById('alert').classList.remove('showl');
            }, 1000);
            <?php $_SESSION['success'] = false; ?>
        <?php endif; ?>

        let currentResId = null;

        function deleteReservation(Res_Id) {
            currentResId = Res_Id; // Store Res_Id in a variable
            document.getElementById("confirmationModal").style.display = "flex"; // Show modal
        }

        // Close the modal without deleting
        function closeModal() {
            document.getElementById("confirmationModal").style.display = "none";
            currentResId = null; // Clear the stored Res_Id
        }

        function confirmDelete() {
            console.log("time to delete = ", currentResId);
            if (currentResId) {
                // Send AJAX request
                fetch('<?= ROOT ?>/Parent/Reservation/RemoveReservation', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `Res_Id=${currentResId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.message);
                            closeModal();
                            document.getElementById('alert').classList.add('showl');
                            setTimeout(function() {
                                document.getElementById('alert').classList.remove('showl'); // Hide the alert after 6 seconds
                                window.location.reload(); // Reload the page after hiding the alert
                            }, 1000);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

        function fetchReservation(date = null, status = null, child = null) {
            console.log(date, child, status)
            fetch('<?= ROOT ?>/Parent/Reservation/store_reservations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date,
                        child: child,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("data:", data.data);
                        updaterReservationTable(data.data);
                    } else {
                        console.error("Failed to fetch meal plan:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updaterReservationTable(data) {
            const upcomingTableBody = document.querySelector('#upcoming tbody');
            const historyTableBody = document.querySelector('#history tbody');

            // Clear existing rows
            upcomingTableBody.innerHTML = '';
            historyTableBody.innerHTML = '';

            // Populate upcoming reservations
            data.upcoming.forEach(res => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${res?.ResID ?? "No res set"}</td>
            <td>${res.First_Name ?? "No res set"}</td>
            <td>${res?.Date ?? "No res set"}</td>
            <td>${res?.Start_Time ?? "No res set"}</td>
            <td>
                ${res?.End_Time ?? ""}
                ${res?.Is_24_Hour ? '<span class="tag-24-hour" title="24-Hour Reservation"> 24-hour</span>' : ''}
            </td>
            <td>
                <div class="${res?.Status ?? "cancel"}">
                    <p>${res?.Status ?? "cancel"}</p>
                </div>
            </td>
            <td class="edit">
                <i class="fas fa-pen reservation-edit"></i>
                ${res?.Status === 'Pending' ? `<i class="fas fa-trash" onclick="deleteReservation(${res.ResID})"></i>` : ''}
            </td>
        `;
                upcomingTableBody.appendChild(row);
            });

            // Populate history reservations
            data.history.forEach(res => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${res.First_Name ?? "No res set"}</td>
            <td>${res?.Date ?? "No res set"}</td>
            <td>${res?.Start_Time ?? "No res set"}</td>
            <td>
                ${res?.End_Time ?? "No res set"}
                ${res?.Is_24_Hour ? '<span class="tag-24-hour" title="24-Hour Reservation"> (24-hour)</span>' : ''}
            </td>
            <td>
                <div class="${res?.Status ?? "cancel"}">
                    <p>${res?.Status ?? "cancel"}</p>
                </div>
            </td>
            <td class="edit">
                <i class="fas fa-eye"></i>
                <i class="fas fa-star feedbackbtn" style="display: ${res?.Status === 'Canceled' ? "none" : ""}"></i>
            </td>
        `;
                historyTableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {

            const datePicker = document.getElementById('datePicker');
            const childPicker = document.getElementById('childPicker');
            const statusPicker = document.getElementById('statusPicker');

            // Initial fetch with 'null' values (or a default option like 'All')
            fetchReservation(null, null, null);

            datePicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null; // Use null if empty
                const statusValue = statusPicker.value || null; // Use null if empty
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchReservation(dateValue, statusValue, childValue);
            });

            childPicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null;
                const statusValue = statusPicker.value || null;
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchReservation(dateValue, statusValue, childValue);
            });

            statusPicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null;
                const statusValue = statusPicker.value || null;
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchReservation(dateValue, statusValue, childValue);
            });


            const dateElements = document.querySelectorAll('.date');
            const redstar3 = document.getElementById('red-star3');
            const redstar6 = document.getElementById('red-star6');

            dateElements.forEach(function(date) {
                date.addEventListener('click', function(event) {
                    const dayNumber = date.querySelector('h1').textContent;

                    if (date.classList.contains('select')) {
                        date.classList.remove('select');
                        redstar3.classList.remove('hidden');
                        redstar6.classList.remove('hidden');
                        selectedDate = null;
                    } else {
                        selectedDate = dayNumber;
                        redstar3.classList.add('hidden');
                        redstar6.classList.add('hidden');
                        clearSelectedDates();
                        date.classList.add('select');
                        selectDate(selectedDate);
                    }
                });
            });

            function selectDate(date) {
                console.log("Selected date:", date);
                var dateInput = document.getElementById('date-inputforpost');
                dateInput.value = '2024-11-' + date;

                var allDates = document.querySelectorAll('.date');
                allDates.forEach(function(element) {
                    element.classList.remove('select');
                });

                event.target.closest('.date').classList.add('select');
            }

            function clearSelectedDates() {
                dateElements.forEach(function(date) {
                    date.classList.remove('select');
                });
            }

            const feedbackbtns = document.querySelectorAll('.feedbackbtn');
            const RatingModal = document.getElementById('RatingModal');
            const backformeeting = document.getElementById('backforrating');
            const meetingrefresh = document.getElementById('ratingrefresh');
            const meetingform = document.getElementById('ratingform');
            const closemeetingBtn = document.getElementById('closeratingBtn');
            const stars = document.querySelectorAll('.star-rate');
            const ReservationEditModal = document.getElementById('ReservationModal');
            const mainContent = document.getElementById('main-content');
            const ReservationViewModal = document.getElementById('ReservationViewModal');
            const NewReservationModal = document.getElementById('NewReservationModal');

            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('upcoming');
            const history = document.getElementById('history');
            const headingres = document.getElementById('heading-res');

            upbtn.addEventListener('click', function() {
                upbtn.style.color = 'white';
                upbtn.style.backgroundColor = '#10639a';
                hibtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'block';
                history.style.display = 'none';
                headingres.style.marginLeft = '180px';
                headingres.textContent = 'Reervation';
            });

            hibtn.addEventListener('click', function() {
                hibtn.style.color = 'white';
                hibtn.style.backgroundColor = '#10639a';
                upbtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'none';
                history.style.display = 'block';
                headingres.style.marginLeft = '140px';
                headingres.textContent = 'Reervation history';
            });

            // backformeeting.addEventListener('click', function() {
            //     toggleModal(RatingModal, 'none');
            // })

            // meetingrefresh.addEventListener('click', function() {
            //     meetingform.reset();
            //     stars.forEach((star) => {
            //         star.classList.remove('selectestar')
            //     });
            // })

            // closemeetingBtn.addEventListener('click', function() {
            //     toggleModal(meetingModal, 'none');
            // })

            // feedbackbtns.forEach(element => {
            //     console.log("Hi");
            //     element.addEventListener('click', function() {
            //         toggleModal(RatingModal, 'flex');
            //     })
            // });

            window.addEventListener('click', function(e) {
                if (e.target === RatingModal) {
                    toggleModal(RatingModal, 'none');
                }
                if (e.target === ReservationEditModal) {
                    toggleModal(ReservationEditModal, 'none');
                }
                if (e.target === ReservationViewModal) {
                    toggleModal(ReservationViewModal, 'none');
                }
                if (e.target === NewReservationModal) {
                    toggleModal(NewReservationModal, 'none');
                }
            });

            function toggleModal(modal, display) {
                modal.style.display = display;
                if (display === 'flex') {
                    document.body.classList.add('no-scroll');
                    mainContent.classList.add('blurred');
                } else {
                    document.body.classList.remove('no-scroll');
                    mainContent.classList.remove('blurred');
                }
            }

            let rating = 0;
            let i = 0;

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    if (star.classList.contains('selectestar') && index === rating - 1) {
                        for (let j = index; j < stars.length; j++) {
                            stars[j].classList.remove('selectestar');
                        }
                        rating -= 1;
                        i -= 1;
                    } else if (index === rating) {
                        stars[index].classList.add('selectestar');
                        rating += 1;
                        i += 1;
                    }
                });
            });

            const reservationeditbtn = document.querySelectorAll('.reservation-edit');
            const backforreservationedit = document.getElementById('backforreservationedit');
            const reservationeditrefresh = document.getElementById('reservationeditrefresh');
            const closeReservationedit = document.getElementById('closeReservationedit');
            const ReservationEditForm = document.getElementById('ReservationEditForm');
            const redstar4 = document.getElementById('red-star4');
            const redstar5 = document.getElementById('red-star5');
            const settime = document.getElementById('settime');

            settime.addEventListener('input', function() {
                if (!settime.value) {
                    redstar4.classList.remove('hidden');
                } else {
                    redstar4.classList.add('hidden');
                }
            })

            reservationeditbtn.forEach(button => {
                button.addEventListener('click', function() {
                    toggleModal(ReservationEditModal, 'flex');
                });
            });

            backforreservationedit.addEventListener('click', function() {
                toggleModal(ReservationEditModal, 'none');
            });

            closeReservationedit.addEventListener('click', function() {
                toggleModal(ReservationEditModal, 'none');
            });

            let originalDate = null;
            let selectedDate = null;

            reservationeditrefresh.addEventListener('click', function() {
                clearSelectedDates();
                ReservationEditForm.reset();
                dateElements.forEach(date => {
                    if (date.textContent === originalDate) {
                        date.classList.add('select');
                    }
                })
            })

            const reservations = document.querySelectorAll('.reservation');
            const backforreservation = document.getElementById('backforreservation');
            const reservationrefresh = document.getElementById('reservationrefresh');
            const closeReservation = document.getElementById('closeReservation');

            reservations.forEach(reservationbtn => {
                reservationbtn.addEventListener('click', function() {
                    toggleModal(ReservationViewModal, 'flex');
                })
            })

            backforreservation.addEventListener('click', function() {
                toggleModal(ReservationViewModal, 'none');
            });

            // closeReservation.addEventListener('click', function() {
            //     toggleModal(ReservationViewModal, 'none');
            // });

            const newreservationbtn = document.getElementById('newreservationbtn');
            const NewReservationForm = document.getElementById('NewReservationForm');
            const backfornewreservation = document.getElementById('backfornewreservation');
            const newreservationrefresh = document.getElementById('newreservationrefresh');
            const closenewReservation = document.getElementById('closenewReservation');

            newreservationbtn.addEventListener('click', function() {
                console.log("New Reservation");
                toggleModal(NewReservationModal, 'flex');
            });
            backfornewreservation.addEventListener('click', function() {
                toggleModal(NewReservationModal, 'none');
            });
            closenewReservation.addEventListener('click', function() {
                toggleModal(NewReservationModal, 'none');
            });
            newreservationrefresh.addEventListener('click', function() {
                NewReservationForm.reset();
            });

            // starttime.addEventListener('input', function() {
            //     if (!starttime.value) {
            //         redstar7.classList.remove('hidden');
            //     } else {
            //         redstar7.classList.add('hidden');
            //     }
            // })

            // endtime.addEventListener('input', function() {
            //     if (!endtime.value) {
            //         redstar8.classList.remove('hidden');
            //     } else {
            //         redstar8.classList.add('hidden');
            //     }
            // })

        });
    </script>
</body>

</html>