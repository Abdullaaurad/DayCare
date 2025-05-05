<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Child/all-event.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Packagecard.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/MessageDropdown.js?v=<?= time() ?>"></script>
</head>

<body style="overflow: hidden;">
    <div class="container">
        // minimized sidebar
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul>
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Child/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/report">
                        <i class="fa fa-user-shield"></i> <span>Report</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/reservation">
                        <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/meal">
                        <i class="fas fa-utensils"></i> <span>Meal plan</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px;">
                    <a href="<?= ROOT ?>/Child/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/Message">
                        <i class="fas fa-comment"></i> <span>Messager</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">
        </div>
        <div class="sidebar-2" id="sidebar2">
            <div>
                <h2>Familty Ties</h2>
                <div class="family-section">
                    <ul>
                        <li class="hover-effect first"
                            onclick="removechildsession();">
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
                            <li class="first
                                <?php if ($child['name'] === $data['selectedchildren']['name']) {
                                    echo "select-child";
                                } ?>
                            "
                                onclick="setChildSession('<?= isset($child['name']) ? $child['name'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
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
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="name">
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <div class="bell-con" style="cursor: pointer;" id="bell-container">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px;"></i>
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
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle"></i>
                    </button>
                </div>
            </div>
            <div class="modal" id="EventModal">
                <div class="View-Package">
                    <img src="" id="Event-img">
                    <div class="top-con">
                        <div class="back-con" id="back-arrow">
                            <i class="fas fa-chevron-left" id="backformeeting"></i>
                        </div>
                    </div>
                    <div class="pickup-section" style="margin-top: 220px;">
                        <label for="package-name">Event name</label>
                        <input id="Event-name" style="width: 270px;" readonly="" type="text" />
                    </div>
                    <div class="pickup-section">
                        <label for="included-services">Activity details</label>
                        <div class="services" id="description">

                        </div>
                    </div>
                    <div class="pickup-section">
                        <label for="price">Date Time</label>
                        <input id="datetime" readonly type="text" />
                    </div>
                    <button id="Enrollbtn" class="btn" onclick="getchildrens(this.value)">Enroll</button>
                </div>
            </div>
            <div class="fill" style="margin-left: -20px; width: 1180px;">
                <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                    class="back" onclick="window.location.href='<?= ROOT ?>/Child/event'">
                <h2> Events </h2>
                <hr>
                <div class="filters" style="margin-left: 30px !important;">
                    <input type="date" id="datePicker" value="" style="width: 200px; margin-left: 70px;">
                </div>
                <div class="packages">

                </div>
                <div class="pagination">

                </div>
            </div>

        </div>
        <!-- onclick function -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?php echo htmlspecialchars($data['selectedchildren']['image']); ?>" width="100"
                class="profile" />
            <h2><?= $data['selectedchildren']['fullname'] ?></h2>
            <p>SRD<?= $data['selectedchildren']['id'] ?></p>
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ParentProfile'">
                Parent profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/GuardianProfile'">
                Guardian profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildPackage'">Package</button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildID'">Id Card</button>
            <button class="logout-button" onclick="window.location.href ='<?= ROOT ?>/Main/Home'">
                LogOut
            </button>
        </div>
    </div>
    <script>

    const messageDropdown = document.getElementById('messageDropdown');
    const bellIcon = document.getElementById('bell-container');
    const messagenumber = document.getElementById('message-number')

    let messageDropdownTimeout;

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

        function fetchrequest(date) {
            fetch('<?= ROOT ?>/Child/allevent/store_events', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Event data:", data.data);
                        const eventArray = Object.values(data.data);
                        displayEvents(eventArray);
                    } else {
                        console.error("Failed to fetch events:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function displayEvents(data, page = 1, itemsPerPage = 10) {
            const eventsContainer = document.querySelector(".packages");
            const paginationContainer = document.querySelector(".pagination");

            // Clear the current events and pagination
            eventsContainer.innerHTML = "";
            paginationContainer.innerHTML = "";

            // Pagination logic
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = page * itemsPerPage;
            paginatedData = data.slice(startIndex, endIndex); // Store the paginated data globally
            const totalPages = Math.ceil(data.length / itemsPerPage);

            paginatedData.forEach((event, index) => {
                const card = document.createElement("div");
                card.classList.add("package-card");

                card.innerHTML = `
                    <img alt="Classroom with colorful furniture and toys" src="${event.image || '<?= IMAGE ?>/packages.png'}" />
                    <p>Event Name: ${event.EventName}</p>
                    <p>Date: ${event.Date}</p>
                    <p>Time: ${event.Time}</p>
                    <button class="eventbtn lol" data-index="${index}">View</button>
                `;
                eventsContainer.appendChild(card);
            });

            const eventBtns = eventsContainer.querySelectorAll(".eventbtn");
            eventBtns.forEach((btn) => {
                btn.addEventListener("click", () => {
                    const index = parseInt(btn.getAttribute("data-index")); // Get the index from the button's data attribute
                    const selectedEvent = paginatedData[index]; // Use the paginatedData to get the correct event
                    setModalData(selectedEvent); // Pass the event data to setModalData
                    toggleModal(document.getElementById("EventModal"), "flex"); // Open the modal
                });
            });

            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement("a");
                pageLink.href = "#";
                pageLink.textContent = i;
                if (i === page) {
                    pageLink.classList.add("active");
                }
                pageLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    displayEvents(data, i, itemsPerPage);
                });
                paginationContainer.appendChild(pageLink);
            }
        }

        function setChildSession(ChildID) {
            console.log(ChildID);
            fetch(' <?= ROOT ?>/Child/Home/setchildsession', {
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
                        window.location.href = '<?= ROOT ?>/Child/allevent';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function removechildsession() {
            fetch('<?= ROOT ?>/Child/Home/removechildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child name removed from session.");
                        window.location.href = '<?= ROOT ?>/Parent/Event';
                    } else {
                        console.error("Failed to remove child name from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
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

        function setModalData(event) {
            console.log("Event data:", event);
            const Event_img = document.getElementById('Event-img');
            const Event_name = document.getElementById('Event-name');
            const Description = document.getElementById('description');
            const Datetime = document.getElementById('datetime');
            const Enrollbtn = document.getElementById('Enrollbtn');

            Enrollbtn.value = event.EventID;
            Event_img.src = event.Image;
            Event_name.value = event.EventName;
            Description.innerHTML = `
                ${event.Description}
            `
            Datetime.value = event.Date + ' ' + event.Time;
        }

        document.addEventListener('DOMContentLoaded', function() {

            fetchrequest(null);

            const datePicker = document.getElementById('datePicker');

            function applyFilters() {
                const date = datePicker.value || null;
                console.log(date);
                fetchrequest(date);
            }

            datePicker.addEventListener('change', applyFilters);

            const EventModal = document.getElementById('EventModal');
            const eventbtns = document.querySelectorAll('.eventbtn');
            const mainContent = document.getElementById('main-content');
            const eventback = document.getElementById('back-arrow');

            eventback.addEventListener('click', function() {
                toggleModal(EventModal, 'none');
            })

            eventbtns.forEach(function(eventbtn) {
                eventbtn.addEventListener('click', function() {
                    toggleModal(EventModal, 'flex');
                })
            });

            window.addEventListener('click', function(e) {
                if (e.target === EventModal) {
                    toggleModal(EventModal, 'none');
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
        });
    </script>
</body>

</html>