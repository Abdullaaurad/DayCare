<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/child/funzonehistory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/child/funzone1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <script src="<?= JS ?>/child/Setting.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/child/Parental-lock.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/child/Select-child.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/child/Select-type.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/child/Load.js?v=<?= time() ?>"></script> -->
</head>

<body>
    <div class="container">
        <!-- minimized sidebar -->
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul style="margin-top:-20px;">
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Parent/Home">
                        <i class="fas fa-house"></i> <span>Home</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/report">
                        <i class="fa fa-user-shield"></i> <span>Report</span>
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="selected">
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
                <h2 style="margin-top: 25px; margin-left: 15px !important;">Familty Ties</h2>
                <div class="family-section" style="margin-top: 10px; margin-left: 20px;">
                    <ul>
                        <li class="hover-effect first"
                            onclick="removechildsession();">
                            <img src="<?php echo htmlspecialchars($data['parent']['image']); ?>"
                                style="width: 60px; height:60px; border-radius: 30px;">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 style="margin-top: 25px; margin-left: 15px !important;">Little Explorers</h2>
                    <p style="margin-bottom: 20px; color: white; margin-left: 15px !important;">
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="hover-effect first" onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>')">
                                <img src="<?php echo htmlspecialchars($child['image']); ?>"
                                    alt="Child Profile Image"
                                    style="margin-left: -20px;">
                                <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- mavigation for funzone -->
        <!-- <div class="sidebar" style="background:white">
        <a href="../../Home/Home.html">
            <img alt="Kiddo Ville Logo" height="50" src="<?= IMAGE ?>/logo_light-remove.png" width="50" />
        </a>
        <h1>Kiddo Ville</h1>
        <input placeholder="Search" type="text" /><i class="fas fa-search"></i>
        <button onclick="location.href='<?= ROOT ?>/Parent/funzonehome';">Home</button>
        <div class="custom-select-container" tabindex="0">
            <div class="custom-select-trigger">
                Type <i class="fa fa-chevron-down"></i>
            </div>
            <div class="custom-options-container">
                <div class="custom-option"> Recent </div>
                <div class="custom-option"> Rhymes </div>
                <div class="custom-option"> book </div>
                <div class="custom-option"> Games </div>
                <div class="custom-option"> Cartoon </div>
                <div class="custom-option"> Crafts </div>
                <div class="custom-option"> Lessons </div>
            </div>
        </div>
        <button onclick="location.href='<?= ROOT ?>/Parent/funzonewhishlist';">Wishlist</button>
        <button onclick="location.href='<?= ROOT ?>/Parent/funzonetasks';">Tasks</button>
        <button onclick="location.href='<?= ROOT ?>/Parent/funzoneHistory';">History</button>
        <div class="bottom-text">
            <a href="<?= ROOT ?>/ReParent/Home" class="nav-link">
                <i class="fas fa-home"></i>
                <p class="Welcome">Welcome to Funzone</p>
            </a>
        </div>
    </div> -->
        <div class="main-content" style="background:linear-gradient(to bottom right, #f7f7f7,#eaeaea)">
            <!-- Header -->
            <div class="header" style="z-index: 100 !important;">
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="nav-buttons" style="margin-left: 50px;">
                    <div class="circle">
                        <i class="fas fa-chevron-left" onclick="window.location.href='<?= ROOT ?>/Parent/funzonetasks'"></i>
                    </div>
                    <div class="circle">
                        <i class="fas fa-chevron-right" onclick="window.location.href='<?= ROOT ?>/Parent/funzoneHome'"></i>
                    </div>
                </div>
                <h2>
                    History
                </h2>
                <i class="fas fa-cog settings"></i>
                <div class="profile-card" id="profileCard">
                    <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                        style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" id="closeProfileCard">
                    <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png"
                        width="100" class="profile" />
                    <h2 class="child-name">Thilina Perera</h2>
                    <p>Student    RS0110657</p>
                    <button class="logout-button">Logout</button>
                    <div class="lock">
                        <p class="lock-p"> Parental lock</p>
                        <div class="switch">
                            <input type="checkbox" id="toggle">
                            <label for="toggle">
                                <div class="toggle-icon">
                                    <i class="fa fa-unlock"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header2">
                <img src="<?= IMAGE ?>/funzone-logo.png" style="width: 40px; height: 40px; margin-left: 20px;">
                <p style="color: white; font-size: 17px;">Funzone </p>
                <a href="<?= ROOT ?>/Parent/funzonehome" class="hover-effect" style="margin-left: 170px;">Home</a>
                <a href="<?= ROOT ?>/Parent/funzonewhishlist" class="hover-effect">Whishlist</a>
                <a href="<?= ROOT ?>/Parent/funzonetasks" class="hover-effect">Task</a>
                <a href="<?= ROOT ?>/Parent/funzonehistory" class="hover-effect select">History</a>
                <select id="typePicker" style="margin-left: 330px; width: 200px; padding: 5px; border-radius: 10px;">
                    <option value="All"> All </option>
                    <option value="Video"> Videos </option>
                    <option value="Book"> Books </option>
                    <option value="Image"> Images </option>
                    <option value="Audio"> Songs </option>
                </select>
            </div>
            <div class="contents" id="media-container" style="margin-top: -880px !important; z-index:1 !important ;">
                <!-- <div class="grid" id="grid">
                <div class="filter-section" style="margin-top: 770px; z-index:1 !important ;">
                    <label for="filter-date">Filter by date: </label>
                    <input type="date" id="filter-date">
                    <button id="filter-button">Filter</button>
                </div> -->
                <!-- <p style="margin-top: 700px;"> Hi </p> -->
                <!-- <div class="day" style="margin-top: -15px;">
                    <h3> Today </h3>
                </div>
                <div class="items-day">
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-1.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-2.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="day">
                    <h3> Yesterday </h3>
                </div>
                <div class="items-day">
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-3.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-4.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--   <div class="day">
                    <h3> 16/09/2024 </h3>
                </div>
                <div class="items-day">
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-1.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-2.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play"
                                    style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-3.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon-container">
                            <button class="icon-btn watch-btn"><i class="fas fa-play" style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        </div>
                        <img src="<?= IMAGE ?>/funzone-4.png" alt="Item Image">
                        <div class="content">
                            <h3>Item Title</h3>
                            <p>Item description goes here. It can be a bit longer and will be aligned to the left of the
                                image.</p>
                            <div class="date-time">
                                <span class="reminder-date">Date<i class="fa fa-calendar"
                                        style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                                <span class="reminder-date" style="margin-top: 3px;">Time<i class="fa fa-user"
                                        style="margin-left: 42px !important;"></i>6:00 pm</span>
                                <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                        style="margin-left: 43px !important;"></i>Video</span>
                                <span class="reminder-date" style="margin-top: 3px;">Progress<i class="fa fa-hourglass"
                                        style="margin-left: 18px !important;"></i>43%</span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- </div> -->
                <!-- <div class="loading-area" id="loader">
                <div class="loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div> -->
            </div>
        </div>
    </div>
    <script>
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

        function removechildsession() {
            fetch('<?= ROOT ?>/Parent/Funzonehistory/removechildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child id removed from session.");
                        window.location.href = '<?= ROOT ?>/Parent/Home';
                    } else {
                        console.error("Failed to remove child id from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function setChildSession(ChildID) {
            fetch('<?= ROOT ?>/Parent/Funzonehistory/setchildsession', {
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
                        console.log("Child id set in session.");
                        window.location.href = '<?= ROOT ?>/Parent/Funzonehistory';
                    } else {
                        console.error("Failed to set child id from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchMedia(type, Date) {
            fetch('<?= ROOT ?>/Parent/FunzoneHistory/store_media', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: type,
                        Date: Date,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data) {
                        console.log("Fetched media data:", data.data);
                        generateMediaGrid(data.data);
                    } else {
                        console.error("Failed to fetch media data:", data.message);
                        alert("Error fetching media data.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function generateMediaGrid(data) {
            const gridExist = document.getElementById('grid');
            if (gridExist) {
                gridExist.remove();
            }

            const grid = document.createElement("div");
            grid.classList.add("grid");
            grid.style.marginTop = "220px";
            grid.style.marginLeft = "20px";
            grid.id = "grid";

            const filterSection = document.createElement("div");
            filterSection.classList.add("filter-section");
            filterSection.style.marginTop = "770px";
            filterSection.style.zIndex = "1";
            filterSection.innerHTML = `
                <label for="filter-date">Filter by date: </label>
                <input type="date" id="filter-date" value="${data.selected_date || ''}">
            `;
            grid.appendChild(filterSection);

            // Iterate over the fetched data
            Object.keys(data).filter(key => key !== "selected_date").forEach(dateKey => {
                // Create the day container
                const dateDiv = document.createElement("div");
                dateDiv.className = "day";

                const dateHeader = document.createElement("h3");
                dateHeader.textContent = `Date: ${dateKey}`;
                dateDiv.appendChild(dateHeader);

                grid.appendChild(dateDiv);

                // Create the items container
                const itemsContainer = document.createElement("div");
                itemsContainer.classList.add("items-day");

                // Iterate over the items for this particular date
                data[dateKey].forEach(item => {
                    const itemDiv = document.createElement("div");
                    itemDiv.classList.add("item");
                    itemDiv.style.cursor = 'pointer';
                    itemDiv.style.height = '200px';
                    itemDiv.onclick = function() {
                        window.location.href = `<?= ROOT ?>/Parent/Resource?MediaID=${item.MediaID}`;
                    };

                    // Icon container (play button)
                    const iconContainer = document.createElement("div");
                    iconContainer.classList.add("icon-container");

                    const watchButton = document.createElement("button");
                    watchButton.classList.add("icon-btn", "watch-btn");
                    watchButton.innerHTML = '<i class="fas fa-play" style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i>';

                    iconContainer.appendChild(watchButton);

                    // Media content (Video or default image)
                    let mediaContent;
                    if (item.MediaType === "Video") {
                        const videoContainer = document.createElement("div");
                        videoContainer.classList.add("video-container");

                        const thumbnail = document.createElement("img");
                        thumbnail.src = item.Image || '<?= IMAGE ?>/video.png';
                        thumbnail.alt = "Video Thumbnail";
                        thumbnail.width = 150;
                        thumbnail.height = 150;
                        thumbnail.style.border = '5px solid grey';
                        thumbnail.style.marginTop = '10px;';
                        thumbnail.style, marginBottom = '-5px;';

                        const video = document.createElement("video");
                        video.width = 305; // Set fixed width
                        video.height = 210; // Set fixed height
                        video.style.marginLeft = '-10px'; // Adjust position as needed
                        video.style.marginRight = '-9px';
                        video.style.display = "none";
                        video.style.objectFit = "cover"; // Ensures video covers the container and crops if needed
                        video.muted = true;
                        video.preload = "none";

                        const source = document.createElement("source");
                        source.src = item.URL;
                        source.type = "video/mp4";

                        video.appendChild(source);
                        videoContainer.appendChild(thumbnail);
                        videoContainer.appendChild(video);
                        mediaContent = videoContainer;

                        // Video hover effect to play
                        setTimeout(() => {
                            const container = videoContainer;
                            const thumb = thumbnail;
                            const vid = video;

                            if (container && thumb && vid) {
                                container.addEventListener("mouseenter", () => {
                                    thumb.style.display = "none";
                                    vid.style.display = "block";
                                    vid.play();
                                });

                                container.addEventListener("mouseleave", () => {
                                    vid.pause();
                                });
                            }
                        }, 0);
                    } else if (item.MediaType === "Image") {
                        mediaContent = document.createElement("img");
                        mediaContent.src = item.URL;
                        mediaContent.alt = item.Title;
                        mediaContent.width = 180;
                        mediaContent.height = 150;
                        mediaContent.style.objectFit = "cover";
                    } else if (item.MediaType === "Audio") {
                        mediaContent = document.createElement("img");
                        mediaContent.src = '<?= IMAGE ?>/Audio.jpeg';
                        mediaContent.alt = "Default Placeholder";
                        mediaContent.width = 180;
                        mediaContent.height = 150;
                        mediaContent.style.objectFit = "cover";
                    } else if (item.MediaType === "Book") {
                        mediaContent = document.createElement("img");
                        mediaContent.src = '<?= IMAGE ?>/PDF.jpeg';
                        mediaContent.alt = "Default Placeholder";
                        mediaContent.width = 180;
                        mediaContent.height = 150;
                        mediaContent.style.objectFit = "cover";
                    } else {
                        mediaContent = document.createElement("img");
                        mediaContent.src = '<?= IMAGE ?>/PDF.';
                        mediaContent.alt = "Default Placeholder";
                        mediaContent.width = 180;
                        mediaContent.height = 150;
                        mediaContent.style.objectFit = "cover";
                    }

                    itemDiv.appendChild(iconContainer);
                    // Add media content to the iconContainer (before Content)
                    itemDiv.appendChild(mediaContent); // Added here to ensure the media shows
                    // Create Content div
                    const Content = document.createElement("div");
                    Content.classList = 'content';

                    // Title
                    const title = document.createElement("h3");
                    title.textContent = item.Title;
                    Content.appendChild(title);

                    // Description
                    const description = document.createElement("p");
                    description.textContent = item.Description;
                    Content.appendChild(description);

                    // Date & Time container
                    const dateTimeDiv = document.createElement("div");
                    dateTimeDiv.classList.add("date-time");

                    const dateTimeParts = item.DateTime.split(' ');
                    const datePart = dateTimeParts[0]; // "2025-02-21"
                    const timePart = dateTimeParts[1]; // "15:30:00"

                    const reminderDateDiv = document.createElement("div");
                    reminderDateDiv.classList.add("reminder-date");
                    // Removed duplicate style attribute error in icon
                    reminderDateDiv.innerHTML = `<i class="fas fa-calendar-alt"></i> <span class="date-text">${datePart}</span>`;
                    dateTimeDiv.appendChild(reminderDateDiv);

                    const reminderTimeDiv = document.createElement("div");
                    reminderTimeDiv.classList.add("reminder-date");
                    // Removed duplicate style attribute error in icon
                    reminderTimeDiv.innerHTML = `<i class="fas fa-video"></i> <span class="time-text">${timePart}</span>`;
                    dateTimeDiv.appendChild(reminderTimeDiv);

                    const UserDiv = document.createElement("div");
                    UserDiv.classList.add("reminder-date");
                    UserDiv.innerHTML = `<i class="fas fa-user"></i> <span class="time-text">${item.User}</span>`;
                    dateTimeDiv.appendChild(UserDiv);

                    const progressDiv = document.createElement("div");
                    progressDiv.classList.add("reminder-date");
                    progressDiv.innerHTML = `<i class="fas fa-hourglass"></i> Progress: ${item.Progress}%`;
                    dateTimeDiv.appendChild(progressDiv);

                    const childNameDiv = document.createElement("h4");
                    childNameDiv.classList.add("format");
                    childNameDiv.textContent = `Child - ${item.ChildName}`;

                    Content.appendChild(dateTimeDiv);
                    Content.appendChild(childNameDiv);
                    itemDiv.appendChild(Content);
                    itemsContainer.appendChild(itemDiv);
                });

                // After creating all items, append the items container to the day container
                grid.appendChild(itemsContainer);
            });

            // Append the grid to the media container
            document.getElementById("media-container").appendChild(grid);

            const typePicker = document.getElementById('typePicker');
            const datePicker = document.getElementById('filter-date');
            datePicker.addEventListener('change', function() {
                fetchMedia(typePicker.value, datePicker.value);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {

            const typePicker = document.getElementById('typePicker');
            const datePicker = document.getElementById('filter-date');
            // Initial fetch for media
            fetchMedia('All', null);

            if (typePicker) {
                typePicker.addEventListener('change', function() {
                    fetchMedia(typePicker.value, datePicker.value);
                });
            }

            if (datePicker) {
                datePicker.addEventListener('change', function() {
                    fetchMedia(typePicker.value, datePicker.value);
                });
            }

        });
    </script>
</body>

</html>