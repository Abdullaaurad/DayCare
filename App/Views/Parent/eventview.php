<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/event.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Stats.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Table1.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
</head>

<body>
    <div class="container">
        <!-- miminzed sidebar -->
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
                <li class="hover-effect unselected" style="margin-top: 40px;">
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
                <li class="selected">
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
                    <a href="<?= ROOT ?>/Parent/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr>
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
                    <h2>Little Explorers</h2>
                    <p>
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="hover-effect first" onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>')">
                                <img src="<?php echo htmlspecialchars($child['image']); ?>" alt="Child Profile Image">
                                <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content" id="main-content">
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
                <div class="stat" id="NewEvent">
                    <div class="stat-img">
                        <img src="<?= isset($data['stat3']['Image']) ? $data['stat3']['Image'] : IMAGE . '/event-2.svg'; ?>" alt="Event Image">
                        <div class="stat-event">
                            <h3 class="footer">Event Name: <?= $data['stat3']['EventName'] ?></h3>
                            <p class="footer">Date: <?= date('d/m/Y', strtotime($data['stat3']['Date'])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="stat" id="stat1" style="display: none;">
                    <h3>
                        <img src="<?= IMAGE ?>/event.svg?v=<?= time() ?>" alt="Attendance">
                        Upcoming events
                    </h3>

                    <?php if (!empty($data['stat1']['upcomingEvent'])): ?>
                        <!-- If there is an upcoming event -->
                        <p style="margin-bottom: 3px;">
                            <?= $data['stat1']['upcomingEvent']['EventName'] ?>
                        </p>
                    <?php else: ?>
                        <!-- If there is no upcoming event -->
                        <p style="margin-bottom: 3px;">
                            No upcoming events at the moment.
                        </p>
                    <?php endif; ?>

                    <span style="font-weight: 50;"><?= isset($data['stat1']['upcomingEvent']['Date']) ? $data['stat1']['upcomingEvent']['Date'] : ''; ?></span>
                </div>
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/event-2.svg?v=<?= time() ?>" alt="Attendance">Enroll to events</h3>
                    <p style="margin-bottom: 3px;"> <?= $data['stat2']['enrolledEvents'] ?></p>
                    <span><?= $data['stat2']['eventsMessage'] ?></span>
                </div>
                <div class="stat">
                    <h3><img src="<?= IMAGE ?>/event-2.svg?v=<?= time() ?>" alt="Attendance">View all events</h3>
                    <div class="lol" style="cursor: pointer; margin-top: 20px; margin-left: 4rem;"
                        onclick="window.location.href='<?= ROOT ?>/Parent/allevent';">
                        <p>View</p>
                    </div>
                </div>
            </div>
            <div class="saperate">
                <!-- Event Modal -->
                <div class="modal" id="EventModal">
                    <div class="View-Package">
                        <img id="Eventimage" src="<?= IMAGE ?>/packages.png">
                        <div class="top-con" style="margin-top: -190px; margin-left: 1px;">
                            <div class="back-con" id="back-arrow">
                                <i class="fas fa-chevron-left" id="backformeeting"></i>
                            </div>
                        </div>
                        <div class="pickup-section" style="margin-top: 190px;">
                            <label for="package-name">Event name</label>
                            <input id="event-name" readonly="" type="text" />
                        </div>
                        <div class="pickup-section">
                            <label for="included-services">Activity details</label>
                            <div class="services" id="event-description">
                            </div>
                        </div>
                        <div class="pickup-section">
                            <label for="price">Date Time</label>
                            <div class="price-container">
                                <input id="datetime" readonly="" type="text" />
                            </div>
                        </div>
                        <div class="button-popup">
                            <button id="LeaveEvent">Leave</button>
                        </div>
                    </div>
                </div>
                <!-- Rating Modal -->
                <div class="modal" id="RatingModal">
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
                            <h1 class="review">Review and Rating</h1>
                            <div class="pickup-section">
                                <label for="package-name">Reason</label>
                                <input id="package-name" type="text" placeholder="Reason for the review" />
                            </div>
                            <div class="pickup-section">
                                <label for="included-services">Your review</label>
                                <textarea id="included-services" placeholder="Provided a good service. The child was so happy. but the he left his toy at the daycare"></textarea>
                            </div>
                            <div class="pickup-section">
                                <label for="price">Add your rating</label>
                                <div class="rating pickup-section">
                                    <i class="star-rate fas fa-star" data-value="5"></i>
                                    <i class="star-rate fas fa-star" data-value="4"></i>
                                    <i class="star-rate fas fa-star" data-value="3"></i>
                                    <i class="star-rate fas fa-star" data-value="2"></i>
                                    <i class="star-rate fas fa-star" data-value="1"></i>
                                </div>
                            </div>
                            <div class="button-popup">
                                <button id="closeratingBtn">Cancel</button>
                                <button type="submit">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Event conatiner -->
                <div class="Table1">
                    <h2> Events </h2>
                    <hr>
                    <div class="filters">
                        <input type="date" id="datePicker" value="" style="width: 200px">
                        <select style="width: 200px" id="select">
                            <option value="" hidden>Status</option>
                            <option value="NULL">All</option>
                            <option value="Upcoming">Upcoming</option>
                            <option value="Happening">Happening</option>
                            <option value="Finished">Finished</option>
                        </select>
                        <select id="childPicker" style="margin-right: 200px;">
                            <option Value="" selected> All </option>
                            <?php foreach ($data['children'] as $child): ?>
                                <option value="<?= $child['name']; ?>">
                                    <?= $child['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th> Child </th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="glass-box">
                    <div class="report-header">
                        <i class="fa-regular fa-clipboard"></i>
                        <h1>Feedback</h1>
                    </div>
                    <div class="report-footer">
                        <p class="footer">Event Name: <span>Drawing</span></p>
                        <p class="footer">Date: <span>12/12/2024</span></p>
                    </div>
                    <div class="report-body">
                        <p class="text">Give us feedback for the events that your child participated</p>
                        <button style="margin-bottom: 21px;" class="button" id="feedbackbtn">Give feedback</button>
                    </div>
                </div>
            </div>
            <!-- navigation to messager -->

        </div>
        <!-- profile card -->
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
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/ReParent/ChildProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/ReParent/ParentProfile'">
                Parent profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/ReParent/GuardianProfile'">
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
            fetch("<?= ROOT ?>/Parent/event/Logout", {
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
            fetch(' <?= ROOT ?>/Parent/event/setchildsession', {
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
                        window.location.href = '<?= ROOT ?>/Child/Event';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchrequest(date, status, child) {
            fetch('<?= ROOT ?>/Parent/Event/store_data', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date,
                        status: status,
                        child: child
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Event data:", data.data);
                        updateEventTable(data.data);
                        attachEventListeners();
                    } else {
                        console.error("Failed to fetch events:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updateEventTable(events) {
            const tbody = document.querySelector('.Table1 table tbody');
            tbody.innerHTML = '';

            events.forEach(event => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${event.EventName}</td>
                    <td> ${event.ChildName} </td>
                    <td>${new Date(event.Date).toLocaleDateString()}</td>
                    <td>${event.Status}</td>
                    <td><i class="fas fa-eye icon eventbtn" data-eventid="${event.EventID}" data-enrollmentid = "${event.EnrollmentID}"></i></td>
                `;
                tbody.appendChild(row);
            });
        }

        function attachEventListeners() {
            const eventbtns = document.querySelectorAll('.eventbtn');
            const EventModal = document.getElementById('EventModal');
            eventbtns.forEach(function(eventbtn) {
                eventbtn.addEventListener('click', function() {
                    const eventId = this.dataset.eventid;
                    const EnrollmentID = this.dataset.enrollmentid;
                    console.log(eventId);
                    fetchEventDetails(eventId, EnrollmentID);
                });
            });
        }

        function fetchEventDetails(eventId, EnrollmentID) {
            const eventNameInput = document.getElementById('event-name');
            const eventDetailsDiv = document.getElementById('event-description');
            const eventDateTimeInput = document.getElementById('datetime');
            const eventImage = document.getElementById('Eventimage');
            const LeaveEvent = document.getElementById('LeaveEvent');

            console.log(eventId);
            fetch('<?= ROOT ?>/Parent/event/lol', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        EventID: eventId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Event details:', data.data);
                        eventNameInput.value = data.data.EventName;
                        eventDateTimeInput.value = data.data.Date;
                        eventDetailsDiv.innerHTML = data.data.Description.replace(/\./g, '.<br>');
                        LeaveEvent.dataset.EnrollmentID = EnrollmentID


                        if (data.data.Image) {
                            eventImage.src = data.data.Image;
                        } else {
                            eventImage.src = "<?= IMAGE ?>/packages.png";
                        }

                        toggleModal(EventModal, 'flex'); // Ensure EventModal is defined elsewhere
                    } else {
                        alert(data.message || 'Failed to load event details.');
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        const LeaveEvent = document.getElementById('LeaveEvent');
        if (LeaveEvent) {
            LeaveEvent.addEventListener('click', function() {
                const enrollmentId = this.dataset.EnrollmentID; // Get EnrollmentID from data attribute

                if (!enrollmentId) {
                    alert("EnrollmentID is missing!");
                    return;
                }

                console.log("Leaving event with EnrollmentID:", enrollmentId);

                fetch('<?= ROOT ?>/Parent/event/leaveEvent', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            EnrollmentID: enrollmentId // ✅ Send EnrollmentID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Successfully left the event!");
                            location.reload(); // ✅ Refresh the page or update UI
                        } else {
                            alert(data.message || "Failed to leave event.");
                        }
                    })
                    .catch(error => console.error("Error leaving event:", error));
            });
        }

        function toggleModal(modal, display) {
            const mainContent = document.getElementById('main-content');
            modal.style.display = display;
            if (display === 'flex') {
                document.body.classList.add('no-scroll');
                mainContent.classList.add('blurred');
            } else {
                document.body.classList.remove('no-scroll');
                mainContent.classList.remove('blurred');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {

            fetchrequest(null, null, null);

            const datePicker = document.getElementById('datePicker');
            const statusDropdown = document.querySelector('select');
            const childPicker = document.getElementById('childPicker');

            function applyFilters() {
                const selectedDate = datePicker.value || null;
                const selectedStatus = statusDropdown.value || null;
                const selectedchild = childPicker.value || null;
                console.log(selectedDate, selectedStatus, selectedchild);
                fetchrequest(selectedDate, selectedStatus, selectedchild);
            }

            datePicker.addEventListener('change', applyFilters);
            statusDropdown.addEventListener('change', applyFilters);
            childPicker.addEventListener('change', applyFilters);

            const EventModal = document.getElementById('EventModal');
            const eventbtns = document.querySelectorAll('.eventbtn');
            const mainContent = document.getElementById('main-content');
            const eventback = document.getElementById('back-arrow');

            eventback.addEventListener('click', function() {
                toggleModal(EventModal, 'none');
            })

            function attachEventListeners() {
                const eventbtns = document.querySelectorAll('.eventbtn');
                eventbtns.forEach(function(eventbtn) {
                    eventbtn.addEventListener('click', function() {
                        console.log("EVENT BTN");
                        toggleModal(EventModal, 'block');
                    });
                });
            }

            attachEventListeners();

            window.addEventListener('click', function(e) {
                if (e.target === EventModal) {
                    toggleModal(EventModal, 'none');
                }
            });

            const RatingModal = document.getElementById('RatingModal');
            const feedbackbtn = document.getElementById('feedbackbtn');
            const backforrating = document.getElementById('backforrating');

            backforrating.addEventListener('click', function() {
                toggleModal(RatingModal, 'none');
            });

            feedbackbtn.addEventListener('click', function() {
                toggleModal(RatingModal, 'flex');
            });

            const stars = document.querySelectorAll('.star-rate');
            const meetingrefresh = document.getElementById('ratingrefresh');
            const ratingform = document.getElementById('ratingform');

            meetingrefresh.addEventListener('click', function() {
                ratingform.reset();
                stars.forEach((star) => {
                    star.classList.remove('selectestar')
                });
            })

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

            const stat1 = document.getElementById('stat1');
            const stat2 = document.getElementById('stat2');
            const NewEvent = document.getElementById('NewEvent');

            function rotateStats() {
                if (stat1.style.display == '') {
                    stat1.style.display = 'none';
                    NewEvent.style.display = 'flex';
                } else {
                    stat1.style.display = '';
                    NewEvent.style.display = 'none';
                }
            }

            setInterval(rotateStats, 5000);

        });
    </script>
</body>

</html>