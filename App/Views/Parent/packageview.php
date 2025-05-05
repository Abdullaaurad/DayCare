<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/package.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Packagecard.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Price.js?v=<?= time() ?>"></script>
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="selected">
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
            <div class="modal" id="PackageModal">
                <div class="View-Package">
                    <div class="top-con">
                        <div class="back-con" id="back-arrow">
                            <i class="fas fa-chevron-left" id="backformeeting"></i>
                        </div>
                    </div>
                    <h1>View Package</h1>
                    <label for="package-name">Package name</label>
                    <input id="package-name" readonly="" type="text" value="Basic care plan" />
                    <label for="included-services">Included services</label>
                    <div class="services" id="included-services">

                    </div>
                    <label for="price">Price</label>
                    <div class="price-container">
                        <input id="price" readonly="" type="text" value="80,000" />
                        <span>RS</span>
                    </div>
                    <label for="included-days">Included days</label>
                    <div class="services" id="included-days">
                        <ul id="first-ul"></ul>
                        <ul id="second-ul"></ul>
                    </div>
                </div>
            </div>
            <div class="fill">
                <div class="fill-head">
                    <h2>Packages</h2>
                    <hr>
                </div>
                <div class="filters" style="text-align: left;">
                    <label for="minPrice">Min Price:</label>
                    <input type="text" id="min_price" class="price" maxlength="7" placeholder="Min Price"
                        style="width: 100px;">
                    <label for="maxPrice">Max Price:</label>
                    <input type="text" id="max_price" class="price" maxlength="7" placeholder="Max Price"
                        style="width: 100px;">
                    <label for="minPrice">Age Group:</label>
                    <select id="age">
                        <option value="All" selected> All </option>
                        <option value="2-3"> 2-3 </option>
                        <option value="4-5"> 4-5 </option>
                        <option value="6-7"> 6-7 </option>
                        <option value="8-9"> 8-9 </option>
                        <option value="10-11"> 10-11 </option>
                        <option value="12-13"> 12-13 </option>
                        <option value="14-15"> 14-15 </option>
                    </select>
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
            fetch("<?= ROOT ?>/Parent/package/Logout", {
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
                        window.location.href = '<?= ROOT ?>/Child/Package';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchrequest(max, min, age) {
            fetch('<?= ROOT ?>/Parent/package/store_package', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        Min_price: min,
                        Max_price: max,
                        Age: age
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Event data:", data.data);
                        const packagesArray = Object.values(data.data);
                        displayPackages(packagesArray);
                        attachEventListeners(packagesArray);
                    } else {
                        console.error("Failed to fetch events:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function displayPackages(data, page = 1, itemsPerPage = 10) {
            const packagesContainer = document.querySelector(".packages");
            const paginationContainer = document.querySelector(".pagination");

            // Clear the current packages and pagination
            packagesContainer.innerHTML = "";
            paginationContainer.innerHTML = "";

            // Pagination logic
            const startIndex = (page - 1) * itemsPerPage;
            const endIndex = page * itemsPerPage;
            const paginatedData = data.slice(startIndex, endIndex);
            const totalPages = Math.ceil(data.length / itemsPerPage);

            // Create package cards
            paginatedData.forEach(pkg => {
                const card = document.createElement("div");
                card.classList.add("package-card");

                card.innerHTML = `
                    <img alt="Classroom with colorful furniture and toys" src="<?= IMAGE ?>/packages.png" />
                    <p>Package : ${pkg.Name}</p>
                    <p>Price : Rs. ${pkg.Price}</p>
                    <button class="view">View</button>
                `;
                packagesContainer.appendChild(card);
            });

            // Create pagination
            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement("a");
                pageLink.href = "#";
                pageLink.textContent = i;
                if (i === page) {
                    pageLink.classList.add("active");
                }
                pageLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    displayPackages(data, i, itemsPerPage); // Load the selected page
                });
                paginationContainer.appendChild(pageLink);
            }

            // Add previous and next links
            if (page > 1) {
                const prevLink = document.createElement("a");
                prevLink.href = "#";
                prevLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    displayPackages(data, page - 1, itemsPerPage);
                });
                paginationContainer.insertBefore(prevLink, paginationContainer.firstChild);
            }

            if (page < totalPages) {
                const nextLink = document.createElement("a");
                nextLink.href = "#";
                nextLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    displayPackages(data, page + 1, itemsPerPage);
                });
                paginationContainer.appendChild(nextLink);
            }
        }

        function attachEventListeners(packages) {
            const PackageModal = document.getElementById('PackageModal');
            const packageBtns = document.querySelectorAll('.view');

            packageBtns.forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    const pkg = packages[index]; // Get the corresponding package data
                    if (pkg) {
                        setModalData(pkg); // Set modal data with the package details
                        toggleModal(PackageModal, 'flex'); // Show the modal
                    }
                });
            });
        }

        function getAllowedDaysList(pkg) {
            const days = [{
                    name: 'Monday',
                    value: pkg.Monday
                },
                {
                    name: 'Tuesday',
                    value: pkg.Tuesday
                },
                {
                    name: 'Wednesday',
                    value: pkg.Wednesday
                },
                {
                    name: 'Thursday',
                    value: pkg.Thursday
                },
                {
                    name: 'Friday',
                    value: pkg.Friday
                },
                {
                    name: 'Saturday',
                    value: pkg.Saturday
                },
                {
                    name: 'Sunday',
                    value: pkg.Sunday
                },
            ];

            // Split the days into two parts
            const firstHalfDays = days.slice(0, Math.ceil(days.length / 2));
            const secondHalfDays = days.slice(Math.ceil(days.length / 2));

            // Create the first <ul> element and add the first half of the days
            const firstUl = document.getElementById('first-ul');
            firstUl.innerHTML = ''; // Clear previous content
            firstHalfDays.forEach(day => {
                if (day.value) {
                    const li = document.createElement('li');
                    li.textContent = day.name;
                    firstUl.appendChild(li);
                }
            });

            // Create the second <ul> element and add the second half of the days
            const secondUl = document.getElementById('second-ul');
            secondUl.innerHTML = ''; // Clear previous content
            secondHalfDays.forEach(day => {
                if (day.value) {
                    const li = document.createElement('li');
                    li.textContent = day.name;
                    secondUl.appendChild(li);
                }
            });
        }

        function setModalData(pkg) {
            // Set the package name
            const packageNameInput = document.getElementById('package-name');
            packageNameInput.value = pkg.Name;

            // Set the included services
            const includedServicesDiv = document.getElementById('included-services');
            const includeddatesDiv = document.getElementById('included-days');
            includedServicesDiv.innerHTML = `
                ${pkg.Description}
                <br />
                ${pkg.AllHours ? '24/7 care included.' : ''}
                <br />
                ${pkg.FoodAddons ? 'All food add-ons allowed.' : ''}
                <br />
                ${pkg.Everything ? 'Everything included in the package.' : ''}
            `;

            getAllowedDaysList(pkg);
            // Set the price
            const priceInput = document.getElementById('price');
            priceInput.value = pkg.Price;
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

            const max_price = document.getElementById('max_price');
            const min_price = document.getElementById('min_price');
            const age = document.getElementById('age');

            function applyFilters() {
                const max = max_price.value || null;
                const min = min_price.value || null;
                const agegroup = age.value || null;
                console.log(max, min, agegroup);
                fetchrequest(max, min, agegroup);
            }

            max_price.addEventListener('change', applyFilters);
            min_price.addEventListener('change', applyFilters);
            age.addEventListener('change', applyFilters);

            const PackageModal = document.getElementById('PackageModal');
            const packagebtns = document.querySelectorAll('.view');
            const mainContent = document.getElementById('main-content');
            const packageback = document.getElementById('back-arrow');

            packageback.addEventListener('click', function() {
                toggleModal(PackageModal, 'none');
            })

            packagebtns.forEach(function(eventbtn) {
                console.log("Hi");
                eventbtn.addEventListener('click', function() {
                    toggleModal(PackageModal, 'flex');
                })
            });

            window.addEventListener('click', function(e) {
                if (e.target === PackageModal) {
                    toggleModal(PackageModal, 'none');
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