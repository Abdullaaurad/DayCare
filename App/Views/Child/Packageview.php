<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/package.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Packagecard.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/MessageDropdown.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Price.js?v=<?= time() ?>"></script>
</head>

<body style="overflow: hidden;">
    <div class="container">
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px;">
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
            <hr>
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
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <div class="bell-con" style="cursor: pointer;" id="bell-container">
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
                    <div class="services" id="included-services" style="width: 280px;">

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

        function fetchrequest(max, min) {
            fetch('<?= ROOT ?>/Child/package/store_package', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        Min_price: min,
                        Max_price: max
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
            console.log("hi");
            const PackageModal = document.getElementById('PackageModal');
            const packageBtns = document.querySelectorAll('.view');

            packageBtns.forEach((btn, index) => {
                btn.addEventListener('click', function() {
                    const pkg = packages[index];
                    if (pkg) {
                        setModalData(pkg);
                        toggleModal(PackageModal, 'flex');
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
            console.log("package");
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

            fetchrequest(null, null);

            const max_price = document.getElementById('max_price');
            const min_price = document.getElementById('min_price');

            function applyFilters() {
                const max = max_price.value || null;
                const min = min_price.value || null;
                console.log(max, min);
                fetchrequest(max, min);
            }

            max_price.addEventListener('change', applyFilters);
            min_price.addEventListener('change', applyFilters);

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

        function setChildSession(childName) {
            fetch('<?= ROOT ?>/Child/Home/setchildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        childName: childName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child name set in session.");
                        window.location.href = '<?= ROOT ?>/Child/Package';
                    } else {
                        console.error("Failed to set child name in session.", data.message);
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
                        window.location.href = '<?= ROOT ?>/Parent/Package';
                    } else {
                        console.error("Failed to remove child name from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>