<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=CSS?>/Parent/Attendance.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Parent/Main.css?v=<?= time() ?>">
    <script src="<?=JS?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?=JS?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?=JS?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="container">
        <!-- minimzed sidenavbar -->
        <div class="sidebar minimized" id="sidebar1">
            <img src="<?=IMAGE?>/navbar-star.png" class="star show" id="starImage">
            <h2 style="margin-top: 10px;">Dashboard</h2>
            <ul>
                <li class="selected">
                    <a href="<?=ROOT?>/Parent/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="hover-effect unselected" style="margin-top: 40px;">
                    <a href="<?=ROOT?>/Parent/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/report">
                        <i class="fa fa-user-shield" aria-hidden="true"></i> <span>Report</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/reservation">
                        <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/meal">
                        <i class="fas fa-utensils"></i> <span>Meal plan</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?=ROOT?>/Parent/package">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">

        </div>
        <!-- navigation -->
        <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
            <div>
                <h2 style="margin-top: 25px;">Familty Ties</h2>
                <div class="family-section" style="margin-top: 10px;">
                    <ul>
                        <li class="hover-effect first select-child">
                            <img src="<?=IMAGE?>/family.jpg" style="width: 60px; height:60px; border-radius: 30px;">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 style="margin-top: 25px;">Little Explorers</h2>
                    <p style="margin-bottom: 20px; color: white; margin-left: 10px;">
                        Explore your children's activities and progress!
                    </p>
                    <ul>
                        <li class="hover-effect first" onclick="window.location.href = '../../Registered-Child/Attendance/attendance.html'">
                            <img src="<?=IMAGE?>/face.jpeg">
                            <h2>Abdulla</h2>
                        </li>
                        <hr>
                        <li class="hover-effect first" onclick="window.location.href = '../../Registered-Child/Attendance/attendance.html'">
                            <img src="<?=IMAGE?>/face.jpeg">
                            <h2>Abdulla</h2>
                        </li>
                        <hr>
                        <li class="hover-effect first" onclick="window.location.href = '../../Registered-Child/Attendance/attendance.html'">
                            <img src="<?=IMAGE?>/face.jpeg">
                            <h2>Abdulla</h2>
                        </li>
                        <hr>
                        <li class="hover-effect first" onclick="window.location.href = '../../Registered-Child/Attendance/attendance.html'">
                            <img src="<?=IMAGE?>/face.jpeg">
                            <h2>Abdulla</h2>
                        </li>
                        <hr>
                        <li class="hover-effect first" onclick="window.location.href = '../../Registered-Child/Attendance/attendance.html'">
                            <img src="<?=IMAGE?>/face.jpeg">
                            <h2>Abdulla</h2>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="name">
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search"></i>
                    <i class="fa fa-times clear-btn" style="margin-right: 10px;"></i>
                </div>
                <div class="bell-con" style="cursor: pointer;" id="bell-container">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px;"></i>
                    <div class="message-dropdown" id="messageDropdown" style="display: none;">
                        <ul>
                            <li>
                                <p>New Message 1 <i href="" class="fas fa-paper-plane"></i> </p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 2 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 3 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 4 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 5 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 6 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="message-numbers">
                    <p> 2</p>
                </div>
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                    </button>
                </div>
            </div>
            <div class="stats">
                <div class="stat">
                    <h3><img src="<?=IMAGE?>/attendance.svg" alt="Attendance"
                            style="width: 30px; margin-right: 10px; margin-bottom: -10px;">Kiddo attendance</h3>
                    <p style="margin-bottom: 3px; color: #D3D3D3;">03/04 Days</p>
                    <span style="font-weight: 50;">attended daycare</span>
                </div>
                <div class="stat">
                    <h3><img src="<?=IMAGE?>/mountain.svg" alt="Attendance"
                            style="width: 30px; margin-right: 10px; margin-bottom: -10px;">Late arrivals</h3>
                    <p style="margin-bottom: 3px;color: #D3D3D3;">1 Day</p>
                    <span style="font-weight: 50;">10/12 arrived at 9:30 am</span>
                </div>
                <div class="stat">
                    <h3 style="margin-top: -16px;"><img src="<?=IMAGE?>/child.svg" alt="Attendance"
                            style="width: 40px; margin-right: 10px; margin-bottom: -15px;">kiddo in daycare</h3>
                    <p style="margin-bottom: 3px;color: #D3D3D3;">Arrival time 8:00 am</p>
                    <span style="font-weight: 50;">kiddo is having breakfast now</span>
                </div>
            </div>
            <div class="saperate">
                <!-- attendance -->
                <div class="attendance">
                    <div class="attendance-component">
                        <h1>Attendance</h1>
                        <div class="contain">
                            <div class="attendance-grid">
                                <div class="attendance-item present">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Present</p>
                                </div>
                                <div class="attendance-item half-day">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Half day</p>
                                </div>
                                <div class="attendance-item present">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Present</p>
                                </div>
                                <div class="attendance-item present">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Present</p>
                                </div>
                                <div class="attendance-item absent">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Absent</p>
                                </div>
                                <div class="attendance-item present">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Present</p>
                                </div>
                                <div class="attendance-item half-day">
                                    <div class="day-label">Monday</div>
                                    <h2>15</h2>
                                    <p>Half day</p>
                                </div>
                            </div>
                        </div>
                        <div class="summary-container">
                            <div class="summary">
                                <div class="bar1">
                                    <p>Total</p>
                                    <p style="color: #00bcd4">Full day hours for week: 21 hrs</p>
                                </div>
                                <div class="bar2">
                                    <p style="margin-top: 15px;">Total</p>
                                    <p style="color: #9c27b0">Half day hours for week: 4 hrs</p>
                                </div>
                            </div>
                            <div class="image-container">
                                <img alt="Cartoon of a student sitting at a desk with books" height="100"
                                    src="<?=IMAGE?>/child_attendance.png" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="holidays">
                    <div class="holiday-contain">
                        <h1>Happy new year!</h1>
                        <h2>We’re</h2>
                        <h2>Temporarily</h2>
                        <h2>Closed</h2>
                        <h1>Sorry for the inconvenience</h1>
                        <p class="date">Date = 14/04/2025</p>
                        <p>From our entire team at KiddoVille, we wish you and your family a Happy New Year filled with
                            joy, health, and prosperity!</p>
                        <p class="contact">For any urgent matters during the holiday closure, please feel free to
                            contact us at abdullaurad@gmai.com or 0714810928</p>
                        <div class="icons">
                            <img class="icon" src="<?=IMAGE?>/facebook.svg" alt="facebook">
                            <img class="icon" src="<?=IMAGE?>/twitter.svg" alt="facebook">
                            <img class="icon" src="<?=IMAGE?>/youtube.svg" alt="facebook">
                            <img class="icon" src="<?=IMAGE?>/whatsapp.svg" alt="facebook">
                        </div>
                    </div>
                </div>
            </div>
            <!-- navigation to messager page -->

        </div>
        <!-- profile card -->
        <div class="profile-card" id="profileCard">
            <img 
                src="<?=IMAGE?>/back-arrow-2.svg" alt="back-arrow"
                style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
            <img 
                alt="Profile picture of Thilina Perera" 
                height="100"
                src="<?=IMAGE?>/profilePic.png" 
                width="100"
                class="profile" />
            <h2>
                Thilina Perera
            </h2>
            <p>
                Student    RS0110657
            </p>
            <button class="profile-button" onclick="window.location.href ='<?=ROOT?>/ReParent/ChildProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?=ROOT?>/ReParent/ParentProfile'" >
                Parent profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?=ROOT?>/ReParent/GuardianProfile'">
                Guardian profile
            </button>
            <button class="logout-button" onclick="window.location.href ='<?=ROOT?>/Main/Home'">
                LogOut
            </button>
        </div>
    </div>
</body>

</html>