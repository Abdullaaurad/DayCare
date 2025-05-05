<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzonetasks.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzone1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Setting.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Parental-lock.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/Child/Select-child.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Select-type.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
</head>

<body>
    <!-- minimzed sidebar -->
    <div class="container">
        <!-- mimnized sidebar -->
        <div class="sidebar" id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul style="margin-top:-20px;">
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Child/Home">
                        <i class="fas fa-house"></i> <span>Home</span>
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Child/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px;">
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
        <!-- navigation to choose child -->
        <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
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
                            <li class="first
                                <?php if ($child['name'] === $data['selectedchildren']['name']) {
                                    echo "select-child";
                                } ?>
                            "
                                onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
                                <img src="<?php echo htmlspecialchars($child['image']); ?>"
                                    alt="Child Profile Image"
                                    style="width: 60px; height: 60px; border-radius: 30px; <?php if ($child['name'] !== $data['selectedchildren']['name']) {
                                                                                                echo "margin-left: -20px !important";
                                                                                            } ?>">
                                <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- navigation -->
        <!-- <div class="sidebar" style="background:white">
        <a href="<?= ROOT ?>/ReParent/Home"></a>
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
        <button onclick="location.href='<?= ROOT ?>/Parent/funzoneTasks';">Tasks</button>
        <button onclick="location.href='<?= ROOT ?>/Parent/funzoneHistory';">History</button>
        <div class="bottom-text">
            <a href="<?= ROOT ?>/ReParent/funzoneHome" class="nav-link">
                <i class="fas fa-home"></i>
                <p class="Welcome">Welcome to Funzone</p>
            </a>
        </div>
    </div> -->
        <div class="main-content" id="media-container" style="background:linear-gradient(to bottom right, #f7f7f7, #eaeaea)">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="nav-buttons" style="margin-left: 50px;">
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneWhishlist'">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneHistory'">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <h2>
                    Tasks
                </h2>
                <!-- settings -->
                <i class="fas fa-cog settings"></i>
                <div class="profile-card" id="profileCard">
                    <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                        style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" id="closeProfileCard">
                    <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png"
                        width="100" class="profile" />
                    <h2 class="child-name">Thilina Perera</h2>
                    <p>Student    RS0110657</p>
                    <button class="logout-button" onclick="window.location.href = '<?= ROOT ?>/Main/Home' ">Logout</button>
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
            <div class="header2" style="margin-left: 23px; margin-top: 85px;">
                <img src="<?= IMAGE ?>/funzone-logo.png" style="width: 40px; height: 40px; margin-left: 20px;">
                <p style="color: white; font-size: 17px;">Funzone </p>
                <a href="<?= ROOT ?>/Child/funzonehome" class="hover-effect" style="margin-left: 170px;">Home</a>
                <a href="<?= ROOT ?>/Child/funzonewhishlist" class="hover-effect">Whishlist</a>
                <a href="<?= ROOT ?>/Child/funzonetasks" class="hover-effect select">Task</a>
                <a href="<?= ROOT ?>/Child/funzonehistory" class="hover-effect">History</a>
                <select id="typePicker" style="margin-left: 330px; width: 200px; padding: 5px; border-radius: 10px;">
                    <option value="All"> All </option>
                    <option value="Video"> Videos </option>
                    <option value="Book"> Books </option>
                    <option value="Image"> Images </option>
                    <option value="Audio"> Songs </option>
                </select>
            </div>
            <!-- <div class="grid" style="margin-top: 130px;"> -->
            <!-- <div class="item">
                <div class="icon-container">
                    <button class="icon-btn watch-btn"><i class="fas fa-play"
                            style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                </div>
                <img src="<?= IMAGE ?>/funzone-1.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div> -->
            <!-- <div class="item">
                <img src="<?= IMAGE ?>/funzone-2.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-3.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-4.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-1.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-2.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-3.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-4.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-1.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-2.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-3.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="<?= IMAGE ?>/funzone-4.png" alt="Item Image">
                <div class="content">
                    <h3>Item Title</h3>
                    <p>Item description goes here. It can be a bit longer and will be aligned to the left of the image.
                    </p>
                    <div class="date-time">
                        <span class="reminder-date">Deadline<i class="fa fa-calendar"
                                style="margin-left: 43px !important;"></i>Sep 18, 2024</span>
                        <span class="reminder-date" style="margin-top: 3px;">Assigned By<i class="fa fa-user"
                                style="margin-left: 20px !important;;"></i>Abdulla Aurad</span>
                        <span class="reminder-date" style="margin-top: 3px;">Type<i class="fa fa-video"
                                style="margin-left: 68px !important;;"></i>Abdulla Aurad</span>
                    </div>
                    <div class="reminder-toggle">
                        <p> Hi </p>
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
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
            fetch('<?= ROOT ?>/Child/Funzonetask/removechildsession', {
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
            fetch('<?= ROOT ?>/Child/Funzonetask/setchildsession', {
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
                        window.location.href = '<?= ROOT ?>/Child/Home';
                    } else {
                        console.error("Failed to set child id from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchMedia(type) {
            fetch('<?= ROOT ?>/Child/Funzonetasks/store_tasks', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: type,
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
                gridExist.remove(); // Remove existing grid before adding a new one
            }

            const grid = document.createElement("div");
            grid.classList.add("grid");
            grid.style.marginTop = "140px";
            grid.style.marginLeft = "25px";
            grid.id = "grid";

            data.forEach(item => {
                const itemDiv = document.createElement("div");
                itemDiv.classList.add("item");
                itemDiv.style.cursor = 'pointer';
                itemDiv.style.width = '600px';
                itemDiv.style.height = '200px';

                // Icon container
                const iconContainer = document.createElement("div");
                iconContainer.classList.add("icon-container");

                const watchButton = document.createElement("button");
                watchButton.classList.add("icon-btn", "watch-btn");
                watchButton.innerHTML = '<i class="fas fa-play" style="margin-top: 1px; font-size: 17px; margin-left: 3px; cursor: pointer;"></i>';

                if (item && item.MediaID) {
                    watchButton.onclick = function() {
                        console.log("clicked play button");
                        window.location.href = `<?= ROOT ?>/Child/Resource?MediaID=${item.MediaID}`;
                    };
                }

                iconContainer.appendChild(watchButton);

                // Media Content
                let mediaContent;
                if (item.MediaType === "Image") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = item.URL;
                    mediaContent.alt = item.Title;
                } else if (item.MediaType === "Video") {
                    const videoContainer = document.createElement("div");
                    videoContainer.classList.add("video-container");

                    const uniqueID = `video-container-${item.CompletionID}-${item.MediaID}`;

                    videoContainer.id = uniqueID;

                    const thumbnail = document.createElement("img");
                    thumbnail.src = item.Image || '<?= IMAGE ?>/video.png';
                    thumbnail.alt = "Video Thumbnail";

                    const video = document.createElement("video");
                    video.width = 290;
                    video.height = 210;
                    video.style.display = "none";
                    video.style.marginLeft = "-10px";
                    video.style.marginTop = "-30px";
                    video.style.marginBottom = "-30px";
                    video.muted = true;
                    video.preload = "none";

                    const source = document.createElement("source");
                    source.src = item.URL;
                    source.type = "video/mp4";

                    video.appendChild(source);
                    videoContainer.appendChild(thumbnail);
                    videoContainer.appendChild(video);
                    mediaContent = videoContainer;

                    // **Attach Event Listeners Using `CompletionID` and `MediaID`**
                    videoContainer.addEventListener("mouseenter", () => {
                        thumbnail.style.display = "none";
                        video.style.display = "block";
                        video.play();
                    });

                    videoContainer.addEventListener("mouseleave", () => {
                        video.pause();
                        video.style.display = "none";
                        thumbnail.style.display = "block";
                    });
                } else if (item.MediaType === "Audio") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/Audio.jpeg';
                    mediaContent.alt = "Audio Placeholder";
                } else if (item.MediaType === "Book") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/PDF.jpeg';
                    mediaContent.alt = "Book Placeholder";
                } else {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/default.png';
                    mediaContent.alt = "Default Placeholder";
                }

                // Content Container
                const contentDiv = document.createElement("div");
                contentDiv.classList.add("content");

                // Title
                const title = document.createElement("h3");
                title.textContent = item.Title;

                // Description
                const description = document.createElement("p");
                description.textContent = item.Description;

                // Date-Time Container
                const dateTimeDiv = document.createElement("div");
                dateTimeDiv.classList.add("date-time");

                const deadlineSpan = document.createElement("span");
                deadlineSpan.classList.add("reminder-date");
                deadlineSpan.innerHTML = `Deadline<i class="fa fa-calendar" style="margin-left: 43px !important;"></i> ${item.Deadline}`;

                const assignedBySpan = document.createElement("span");
                assignedBySpan.classList.add("reminder-date");
                assignedBySpan.style.marginTop = "3px";
                assignedBySpan.innerHTML = `Assigned By<i class="fa fa-user" style="margin-left: 20px !important;"></i> ${item.TeacherName}`;

                const typeSpan = document.createElement("span");
                typeSpan.classList.add("reminder-date");
                typeSpan.style.marginTop = "3px";
                typeSpan.innerHTML = `Type<i class="fa fa-video" style="margin-left: 68px !important;"></i> ${item.MediaType}`;

                dateTimeDiv.appendChild(deadlineSpan);
                dateTimeDiv.appendChild(assignedBySpan);
                dateTimeDiv.appendChild(typeSpan);

                // Reminder Toggle
                const reminderToggleDiv = document.createElement("div");
                reminderToggleDiv.classList.add("reminder-toggle");

                const reminderText = document.createElement("span");
                reminderText.classList.add("reminder-text");
                reminderText.textContent = "Set Reminder";

                const reminderLabel = document.createElement("label");
                reminderLabel.classList.add("switch-reminder");

                const reminderInput = document.createElement("input");
                reminderInput.type = "checkbox";
                reminderInput.id = `reminder-${item.CompletionID}-${item.MediaID}`;
                if (item.Reminder) {
                    reminderInput.checked = true;
                }

                const reminderSlider = document.createElement("span");
                reminderSlider.classList.add("slider");

                reminderLabel.appendChild(reminderInput);
                reminderLabel.appendChild(reminderSlider);
                reminderToggleDiv.appendChild(reminderText);
                reminderToggleDiv.appendChild(reminderLabel);

                // Append elements to content div
                contentDiv.appendChild(title);
                contentDiv.appendChild(description);
                contentDiv.appendChild(dateTimeDiv);
                contentDiv.appendChild(reminderToggleDiv);

                // Append all elements to item div
                itemDiv.appendChild(iconContainer);
                itemDiv.appendChild(mediaContent);
                itemDiv.appendChild(contentDiv);

                // Append item to grid
                grid.appendChild(itemDiv);
            });

            document.getElementById("media-container").appendChild(grid);
        }


        document.addEventListener('DOMContentLoaded', function() {
            const typePicker = document.getElementById('typePicker');
            // Initial fetch for media
            fetchMedia('All');

            typePicker.addEventListener('change', function() {
                fetchMedia(typePicker.value);
            });
        });
    </script>
</body>

</html>