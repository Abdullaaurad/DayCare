<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzone1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzonehome.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Setting.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Parental-lock.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/Child/Select-child.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Select-type.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <!-- <script src="../JS/Load.js"></script> -->
    <style>

    </style>
</head>

<body>
    <div? class="container">
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
            <hr>
        </div>
        <!-- navigation to choose child -->
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
                                onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
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
        <!-- minimized sidebar -->

        <!-- navigation for funzone -->
        <!-- <div class="sidebar" style="background:white;">
        <a href="<? ROOT ?>/ReParent/Home">
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
            <a href="<?= ROOT ?>/ReParent/Home" class="nav-link">
                <i class="fas fa-home"></i>
                <p class="Welcome">Welcome to Funzone</p>
            </a>
        </div>
    </div> -->
        <div class="main-content" id="main-content">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="nav-buttons">
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneHistory'">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneWhishlist'">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <h2>Home</h2>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <i class="fas fa-cog settings"></i>
                <div class="profile-card" id="profileCard">
                    <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow" class="back" id="closeProfileCard">
                    <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png"
                        width="100" class="profile" />
                    <h2 class="child-name">Thilina Perera</h2>
                    <p>Student    RS0110657</p>
                    <button class="logout-button"
                        onclick="window.location.href = '<?= ROOT ?>/Main/Home' ">Logout
                    </button>
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
                <img src="<?= IMAGE ?>/funzone-logo.png">
                <p>Funzone </p>
                <a href="<?= ROOT ?>/Child/funzonehome" class="hover-effect select" style="margin-left: 170px;">Home</a>
                <a href="<?= ROOT ?>/Child/funzonewhishlist" class="hover-effect">Whishlist</a>
                <a href="<?= ROOT ?>/Child/funzonetasks" class="hover-effect">Task</a>
                <a href="<?= ROOT ?>/Child/funzonehistory" class="hover-effect">History</a>
                <select id="typePicker" style="margin-left: 330px; width: 200px; padding: 5px; border-radius: 10px;">
                    <option value="All"> All </option>
                    <option value="video"> Videos </option>
                    <option value="Book"> Books </option>
                    <option value="Image"> Images </option>
                    <option value="Audio"> Songs </option>
                </select>
            </div>
            <div class="contents" id="contents" style="margin-top: 130px !important; margin-left: -30px;">
                <div class="day">
                    <h3>Trending Now</h3>
                </div>
                <div class="grid" id="trending-grid"></div>

                <div class="day">
                    <h3>New</h3>
                </div>
                <div class="grid" id="new-grid"></div>

                <div class="day">
                    <h3>Watch It Again</h3>
                </div>
                <div class="grid" id="watch-again-grid"></div>

                <div class="day">
                    <h3>Popular</h3>
                </div>
                <div class="grid" id="popular-grid"></div>

                <div class="day">
                    <h3>Recommended</h3>
                </div>
                <div class="grid" id="recommended-grid"></div>
            </div>
            <!-- <div class="contents" id="contents" style="margin-top: 130px !important; margin-left: -30px;">
            <div class="day">
                <h3> Trending Now </h3>
            </div>
            <div class="grid" id="grid">
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/video'">
                    <img alt="Over It" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Over It</h3>
                </div>
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/youtube'">
                    <img alt="Leo Season" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Leo Season </h3>
                </div>
                <div class="item">
                    <img alt="Amalia(Deluxe Version)" src="<?= IMAGE ?>/funzone-3.png" />
                    <h3>Amalia(Deluxe Version)</h3>
                </div>
                <div class="item">
                    <img alt="Fever" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Fever</h3>
                </div>
                <div class="item">
                    <img alt="Certified Lover Boy" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Certified Lover Boy</h3>
                </div>
                <div class="item">
                    <img alt="Dawn FM" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Dawn FM</h3>
                </div>
                <div class="item">
                    <img alt="Meet The Woo" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Meet The Woo</h3>
                </div>
                <div class="item">
                    <img alt="Queen" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Queen</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Plain Jane REMIX (feat. Nicki Minaj) - Single" height="150"
                        src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Plain Jane</h3>
                </div>
            </div>
            <div class="day" style="margin-top: 20px;">
                <h3> Watch It Again </h3>
            </div>
            <div class="grid" id="grid">
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/video'">
                    <img alt="Over It" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Over It</h3>
                </div>
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/youtube'">
                    <img alt="Leo Season" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Leo Season </h3>
                </div>
                <div class="item">
                    <img alt="Amalia(Deluxe Version)" src="<?= IMAGE ?>/funzone-3.png" />
                    <h3>Amalia(Deluxe Version)</h3>
                </div>
                <div class="item">
                    <img alt="Fever" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Fever</h3>
                </div>
                <div class="item">
                    <img alt="Certified Lover Boy" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Certified Lover Boy</h3>
                </div>
                <div class="item">
                    <img alt="Dawn FM" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Dawn FM</h3>
                </div>
                <div class="item">
                    <img alt="Meet The Woo" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Meet The Woo</h3>
                </div>
                <div class="item">
                    <img alt="Queen" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Queen</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Plain Jane REMIX (feat. Nicki Minaj) - Single" height="150"
                        src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Plain Jane</h3>
                </div>
            </div>
            <div class="day" style="margin-top: 20px;">
                <h3> Popular </h3>
            </div>
            <div class="grid" id="grid">
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/video'">
                    <img alt="Over It" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Over It</h3>
                </div>
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/youtube'">
                    <img alt="Leo Season" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Leo Season </h3>
                </div>
                <div class="item">
                    <img alt="Amalia(Deluxe Version)" src="<?= IMAGE ?>/funzone-3.png" />
                    <h3>Amalia(Deluxe Version)</h3>
                </div>
                <div class="item">
                    <img alt="Fever" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Fever</h3>
                </div>
                <div class="item">
                    <img alt="Certified Lover Boy" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Certified Lover Boy</h3>
                </div>
                <div class="item">
                    <img alt="Dawn FM" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Dawn FM</h3>
                </div>
                <div class="item">
                    <img alt="Meet The Woo" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Meet The Woo</h3>
                </div>
                <div class="item">
                    <img alt="Queen" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Queen</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Plain Jane REMIX (feat. Nicki Minaj) - Single" height="150"
                        src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Plain Jane</h3>
                </div>
            </div>
            <div class="day" style="margin-top: 20px;">
                <h3> Recomended </h3>
            </div>
            <div class="grid" id="grid" style="margin-bottom: 20px;">
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/video'">
                    <img alt="Over It" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Over It</h3>
                </div>
                <div class="item" onclick="window.location.href='<?= ROOT ?>/Parent/youtube'">
                    <img alt="Leo Season" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Leo Season </h3>
                </div>
                <div class="item">
                    <img alt="Amalia(Deluxe Version)" src="<?= IMAGE ?>/funzone-3.png" />
                    <h3>Amalia(Deluxe Version)</h3>
                </div>
                <div class="item">
                    <img alt="Fever" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Fever</h3>
                </div>
                <div class="item">
                    <img alt="Certified Lover Boy" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Certified Lover Boy</h3>
                </div>
                <div class="item">
                    <img alt="Dawn FM" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Dawn FM</h3>
                </div>
                <div class="item">
                    <img alt="Meet The Woo" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Meet The Woo</h3>
                </div>
                <div class="item">
                    <img alt="Queen" height="150" src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Queen</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-2.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Issa" height="150" src="<?= IMAGE ?>/funzone-3.png" width="150" />
                    <h3>Issa</h3>
                </div>
                <div class="item">
                    <img alt="Plain Jane REMIX (feat. Nicki Minaj) - Single" height="150"
                        src="<?= IMAGE ?>/funzone-4.png" width="150" />
                    <h3>Plain Jane</h3>
                </div>
            </div> -->
            <!-- loading animation -->
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

            let History_count = 20;
            let Trending_count = 20;
            let Popular_count = 20;
            let Recommeded_count = 20;
            let New_count = 20;

            function removechildsession() {
                fetch('<?= ROOT ?>/Child/Funzonehome/removechildsession', {
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
                fetch('<?= ROOT ?>/Child/Funzonehome/setchildsession', {
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
                fetch('<?= ROOT ?>/Child/Funzonehome/store_Media', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            type: type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.data) {
                            console.log("Fetched media data:", data.data);
                            Media = data.data;
                            if (Array.isArray(Media.Trending)) createMediaItems(Media.Trending, "trending-grid", Media.Trending_avail);
                            if (Array.isArray(Media.Popular)) createMediaItems(Media.Popular, "popular-grid", Media.Popular_avail);
                            if (Array.isArray(Media.Recomended)) createMediaItems(Media.Recomended, "recommended-grid", Media.Recomended_avail);
                            if (Array.isArray(Media.History)) createMediaItems(Media.History, "watch-again-grid", Media.History_avail);
                            if (Array.isArray(Media.New)) createMediaItems(Media.New, "new-grid", Media.New_avail);
                        } else {
                            console.error("Failed to fetch media data:", data.message);
                            alert("Error fetching media data.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }

            function createMediaItems(dataArray, gridId, moreAvailable) {
                if (!Array.isArray(dataArray)) {
                    console.error(`Expected an array but got`, dataArray);
                    return;
                }

                const gridContainer = document.getElementById(gridId);

                dataArray.forEach(item => {
                    let mediaContent = "";

                    if (item.MediaType === "Image") {
                        mediaContent = `<img alt="${item.Title}" height="150" src="${item.URL}" width="150" />`;
                    } else if (item.MediaType === "Video") {
                        const videoBlob = item.Image;
                        mediaContent = `
                            <div class="video-container" id="video-container-${item.MediaID}">
                                <img 
                                    alt="Video Thumbnail" 
                                    height="150" 
                                    id="img-${item.MediaID}"
                                    src="${videoBlob || '<?= IMAGE ?>/video.png'}" 
                                    width="150" 
                                    id="video-thumbnail-${item.MediaID}"
                                />
                                <video 
                                    width="150" 
                                    height="150" 
                                    id="video-${item.MediaID}" 
                                    style="display: none;" 
                                    muted
                                    preload="none">
                                    <source src="${item.URL}" type="video/mp4">
                                    Your browser does not support video playback.
                                </video>
                            </div>
                        `;
                    } else if (item.MediaType === "Audio") {
                        const audioBlob = item.Image;
                        mediaContent = audioBlob ?
                            `<img alt="Audio Thumbnail" height="150" src="${audioBlob}" width="150" />` :
                            `<img alt="Audio Placeholder" height="150" src="<?= IMAGE ?>/Audio.jpeg" width="150" />`;
                    } else if (item.MediaType === "Book") {
                        const bookBlob = item.Image;
                        mediaContent = bookBlob ?
                            `<img alt="Book Thumbnail" height="150" src="${bookBlob}" width="150" />` :
                            `<img alt="Book Placeholder" height="150" src="<?= IMAGE ?>/PDF.jpeg" width="150" />`;
                    } else {
                        mediaContent = `<img alt="Default Placeholder" height="150" src="<?= IMAGE ?>/default-placeholder.png" width="150" />`;
                    }

                    const mediaItem = `
                        <div class="item" onclick="window.location.href='<?= ROOT ?>/Child/Resource?MediaID=${item.MediaID}'" style="cursor:pointer;">
                            ${mediaContent}
                            <h3>${item.Title}</h3>
                            <p>${item.Description}</p>
                        </div>
                    `;

                    gridContainer.innerHTML += mediaItem;
                });

                let loadMoreBtn = document.getElementById(`load-more-${gridId}`);
                if (!loadMoreBtn && moreAvailable === true) {
                    loadMoreBtn = document.createElement("button");
                    loadMoreBtn.value = `${gridId}`;
                    loadMoreBtn.id = `load-more-${gridId}`;
                    loadMoreBtn.innerText = "Load More";
                    loadMoreBtn.classList.add("load-more-btn");
                    gridContainer.appendChild(loadMoreBtn);
                }

                // Add event listeners after creating elements
                dataArray.forEach(item => {
                    if (item.MediaType === "Video") {
                        const container = document.getElementById(`video-container-${item.MediaID}`);
                        const video = document.getElementById(`video-${item.MediaID}`);
                        const img = document.getElementById(`img-${item.MediaID}`);
                        let timeoutId = null;

                        container.addEventListener('mouseenter', () => {
                            clearTimeout(timeoutId);
                            img.style.display = 'none';
                            video.style.display = 'flex';
                            video.play();
                        });

                        container.addEventListener('mouseleave', () => {
                            timeoutId = setTimeout(() => {
                                video.pause();
                            }, 10); // Small delay before hiding
                        });
                    }
                });
                addEventListeners();
            }

            function updateGridWithMoreData(dataArray, gridType, moreAvailable) {
                const gridContainer = document.getElementById(gridType);

                // First, remove the existing "Load More" button
                let loadMoreBtn = document.getElementById(`load-more-${gridType}`);
                if (loadMoreBtn) {
                    loadMoreBtn.remove();
                }

                // Add new media items to the grid
                createMediaItems(dataArray, gridType, moreAvailable);
                addEventListeners();
            }

            function handleMediaClick(type, url) {
                if (type === "Video") {
                    window.location.href = url; // Open full video page
                } else if (type === "Audio") {
                    alert("Audio playback not implemented yet! File URL: " + url);
                } else if (type === "Book") {
                    window.open(url, "_blank"); // Open PDF in a new tab
                } else {
                    console.log("Unhandled media type:", type);
                }
            }

            function fetchloadmore(type, gridType, count) {
                console.log("Fetching more data:", gridType, type, count);

                fetch('<?= ROOT ?>/Child/Funzonehome/store_extra', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            type: type,
                            grid: gridType,
                            count: count
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.data) {
                            console.log("Fetched media data:", data.data);
                            let logs = [];
                            let more = 0;
                            switch (gridType) {
                                case 'trending-grid':
                                    logs = data.data.Trending
                                    more = data.data.Trending_avail
                                    break;
                                case 'popular-grid':
                                    logs = data.data.Popular
                                    more = data.data.Popular_avail
                                    break;
                                case 'watch-again-grid':
                                    logs = data.data.History
                                    more = data.data.History_avail
                                    break;
                                case 'recommended-grid':
                                    logs = data.data.Recomended
                                    more = data.data.Recomended_avail
                                    break;
                                case 'new-grid':
                                    logs = data.data.New
                                    more = data.data.New_avail
                                    break;
                            }

                            updateGridWithMoreData(logs, gridType, more);
                        } else {
                            console.error("Failed to fetch media data:", data.message);
                            alert("Error fetching media data.");
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }

            function addEventListeners() {
                const loadmoretrending = document.getElementById('load-more-trending-grid');
                if (loadmoretrending) {
                    loadmoretrending.addEventListener('click', function() {
                        fetchloadmore(typePicker.value, this.value, Trending_count);
                        Trending_count += 20;
                    });
                }

                const loadmorehistory = document.getElementById('load-more-watch-again-grid');
                if (loadmorehistory) {
                    loadmorehistory.addEventListener('click', function() {
                        fetchloadmore(typePicker.value, this.value, History_count);
                        History_count += 20;
                    });
                }

                const loadmorepopular = document.getElementById('load-more-popular-grid');
                if (loadmorepopular) {
                    loadmorepopular.addEventListener('click', function() {
                        fetchloadmore(typePicker.value, this.value, Popular_count);
                        Popular_count += 20;
                    });
                }

                const loadmorerecommended = document.getElementById('load-more-recommended-grid');
                if (loadmorerecommended) {
                    loadmorerecommended.addEventListener('click', function() {
                        fetchloadmore(typePicker.value, this.value, Recommeded_count);
                        Recommeded_count += 20;
                    });
                }

                const loadmorenew = document.getElementById('load-more-new-grid');
                if (loadmorenew) {
                    loadmorenew.addEventListener('click', function() {
                        fetchloadmore(typePicker.value, this.value, New_count);
                        New_count += 20;
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const typePicker = document.getElementById('typePicker');

                // Initial fetch for media
                fetchMedia('All');

                // Change event listener for type picker
                typePicker.addEventListener('change', function() {
                    let History_count = 0;
                    let Trending_count = 0;
                    let Popular_count = 0;
                    let Recommeded_count = 0;
                    let New_count = 0;

                    const grid1Container = document.getElementById('trending-grid');
                    const grid2Container = document.getElementById('watch-again-grid');
                    const grid3Container = document.getElementById('recommended-grid');
                    const grid4Container = document.getElementById('popular-grid');
                    const grid5Container = document.getElementById('new-grid');


                    grid1Container.innerHTML = '';
                    grid2Container.innerHTML = '';
                    grid3Container.innerHTML = '';
                    grid4Container.innerHTML = '';
                    grid5Container.innerHTML = '';

                    fetchMedia(typePicker.value);
                });

                setTimeout(function() {
                    addEventListeners();
                }, 1000); // Delay by 1 second

                // Function to add event listeners
                function addEventListeners() {
                    const loadmoretrending = document.getElementById('load-more-trending-grid');
                    if (loadmoretrending) {
                        loadmoretrending.addEventListener('click', function() {
                            console.log('hi');
                            fetchloadmore(typePicker.value, this.value, Trending_count);
                            Trending_count += 20;
                        });
                    }

                    const loadmorehistory = document.getElementById('load-more-watch-again-grid');
                    if (loadmorehistory) {
                        loadmorehistory.addEventListener('click', function() {
                            fetchloadmore(typePicker.value, this.value, History_count);
                            History_count += 20;
                        });
                    }

                    const loadmorepopular = document.getElementById('load-more-popular-grid');
                    if (loadmorepopular) {
                        loadmorepopular.addEventListener('click', function() {
                            fetchloadmore(typePicker.value, this.value, Popular_count);
                            Popular_count += 20;
                        });
                    }

                    const loadmorerecommended = document.getElementById('load-more-recommended-grid');
                    if (loadmorerecommended) {
                        loadmorerecommended.addEventListener('click', function() {
                            fetchloadmore(typePicker.value, this.value, Recommeded_count);
                            Recommeded_count += 20;
                        });
                    }

                    const loadmorenew = document.getElementById('load-more-new-grid');
                    if (loadmorenew) {
                        loadmorenew.addEventListener('click', function() {
                            fetchloadmore(typePicker.value, this.value, New_count);
                            New_count += 20;
                        });
                    }
                }
            });
        </script>
</body>

</html>