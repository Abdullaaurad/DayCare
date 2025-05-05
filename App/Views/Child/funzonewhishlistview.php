<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzonewhishlist.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/funzone1.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/deletepopup.css?v=<?= time() ?>">
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
        <a href="<?= ROOT ?>/ReParent/Home">
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
        <div class="main-content" id="main-content" style="background:linear-gradient(to bottom right, #f7f7f7, #eaeaea); overflow-x: hidden; ">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="nav-buttons" style="margin-left: 50px;">
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneHome'">
                        <i class="fas fa-chevron-left"></i>
                    </div>
                    <div class="circle" onclick="window.location.href='<?= ROOT ?>/Child/funzoneTasks'">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
                <h2>WhishList</h2>
                <i class="fas fa-cog settings" style="margin-right: 200px !important; margin-left: -38px;"></i>
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
            <div class="header2" style="margin-left: 23px; margin-top: 85px;">
                <img src="<?= IMAGE ?>/funzone-logo.png" style="width: 40px; height: 40px; margin-left: 20px;">
                <p style="color: white; font-size: 17px;">Funzone </p>
                <a href="<?= ROOT ?>/Child/funzonehome" class="hover-effect" style="margin-left: 170px;">Home</a>
                <a href="<?= ROOT ?>/Child/funzonewhishlist" class="hover-effect select">Whishlist</a>
                <a href="<?= ROOT ?>/Child/funzonetasks" class="hover-effect">Task</a>
                <a href="<?= ROOT ?>/Child/funzonehistory" class="hover-effect">History</a>
                <select id="typePicker" style="margin-left: 330px; width: 200px; padding: 5px; border-radius: 10px;">
                    <option value="All"> All </option>
                    <option value="Video"> Videos </option>
                    <option value="Book"> Books </option>
                    <option value="Image"> Images </option>
                    <option value="Audio"> Songs </option>
                </select>
            </div>
            <div id="media-container" style="margin-top: 50px;">
                <!-- <div class="item">
                    <div class="icon-container">
                        <button class="icon-btn watch-btn"><i class="fas fa-play"
                                style="margin-top: 1px; font-size: 17px; margin-left: 3px;"></i></button>
                        <button class="icon-btn remove-btn"><i class="fas fa-trash"></i></button>
                    </div>
                    <img alt="Over It" height="150" src="<?= IMAGE ?>/funzone-1.png" width="150" />
                    <h3>Over It</h3>
                    <p> Small description</p>
                    <p class="format"> Format: mp4</p>
                    <div class="date-time">
                        <div class="reminder-date">
                            <i class="fas fa-calendar-alt"></i>
                            <span class="date-text">Sep 18, 2024</span>
                        </div>
                        <div class="reminder-time">
                            <i class="fas fa-clock"></i>
                            <span class="time-text">3:30 PM</span>
                        </div>
                    </div>
                    <div class="reminder-toggle">
                        <span class="reminder-text">Set Reminder</span>
                        <label class="switch-reminder">
                            <input type="checkbox" id="reminder">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div> -->
            </div>
        </div>
        <div id="deletePopup" class="delete-popup-overlay" style="position: fixed;">
            <div class="delete-popup-content" style="margin-top:340px; margin-left: 700px;">
                <p>Are you sure you want to delete this message?</p>
                <div class="delete-popup-buttons">
                    <button id="confirmDelete" class="delete-popup-btn delete-popup-confirm">Yes</button>
                    <button id="cancelDelete" class="delete-popup-btn delete-popup-cancel">No</button>
                </div>
            </div>
        </div>
        <div id="reminder-modal" class="pickup-popup" style="display: none; width: 270px; position: fixed; margin-top:240px; margin-left: 600px;">
            <form id="ReminderForm" method="POST" action="<?= ROOT ?>/child/funzonewhishlist/AddReminders">
                <div class="top-con">
                    <div class="back-con">
                        <i class="fas fa-chevron-left" id="backforpickup"></i>
                    </div>
                    <div class="refresh-con">
                        <i class="fas fa-refresh" id="pickuprefresh"
                            style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                    </div>
                </div>
                <div class="modal-content" style="justify-content: center; display:flex; flex-direction: column;">
                    <h2>Set Reminder</h2>
                    <label for="reminder-date">Date</label>
                    <input type="date" name="Date" style="margin-left: 100px;" id="reminder-date" min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    <label for="reminder-time">Time</label>
                    <input type="time" name="Time" style="margin-left: 100px;" id="reminder-time" min="06:00" max="23:59">
                    <input type="number" style="display: none;" id="WhishlistInput" name="WhishlistID">
                </div>
                <div class="button-popup" style="margin-top: 10px;">
                    <button style="margin-right: 100px;" id="closeModalBtn">Cancel</button>
                    <button>Done</button>
                </div>
            </form>
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

        function resetReminderForm() {
            const dateInput = document.getElementById("reminder-date");
            const timeInput = document.getElementById("reminder-time");
            if (dateInput) dateInput.value = "";
            if (timeInput) timeInput.value = "";
        }

        function removechildsession() {
            fetch('<?= ROOT ?>/Child/Funzonewhishlist/removechildsession', {
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
            fetch('<?= ROOT ?>/Child/Funzonewhishlist/setchildsession', {
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
            fetch('<?= ROOT ?>/Child/Funzonewhishlist/store_media', {
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

        function toggleReminderPopup(itemID) {
            console.log("Open Reminder Modal");
            const Media = document.getElementById("WhishlistInput");
            const modal = document.getElementById("reminder-modal");
            const mainContent = document.getElementById("main-content");

            Media.value = itemID;
            modal.style.display = "block";
            // mainContent.style.filter = "blur(5px)";
            mainContent.style.pointerEvents = "none";
        }

        // Function to close the modal and remove the blur
        function closeReminderModal() {
            const modal = document.getElementById("reminder-modal");
            const mainContent = document.getElementById("main-content");

            modal.style.display = "none";
            // mainContent.style.filter = "none";
            mainContent.style.pointerEvents = "auto";
        }

        function generateMediaGrid(data) {
            const gridexist = document.getElementById('grid');
            if (gridexist) {
                gridexist.remove();
            }
            const grid = document.createElement("div");
            grid.classList.add("grid");
            grid.style.marginTop = "140px";
            grid.style.marginLeft = "20px";
            grid.id = "grid";

            data.forEach(item => {
                const itemDiv = document.createElement("div");
                itemDiv.classList.add("item");
                itemDiv.style.cursor = 'pointer';

                // Icon container
                const iconContainer = document.createElement("div");
                iconContainer.classList.add("icon-container");

                const watchButton = document.createElement("button");
                watchButton.classList.add("icon-btn", "watch-btn");
                watchButton.innerHTML = '<i class="fas fa-play" style="margin-top: 1px; font-size: 17px; margin-left: 3px; cursor: pointer"></i>';

                if (item && item.MediaID) {
                    watchButton.onclick = function() {
                        console.log("clicked play button");
                        window.location.href = `<?= ROOT ?>/Child/Resource?MediaID=${item.MediaID}`;
                    };
                }

                const removeButton = document.createElement("button");
                removeButton.classList.add("icon-btn", "remove-btn");
                removeButton.innerHTML = '<i class="fas fa-trash" style=" cursor: pointer"></i>';

                removeButton.onclick = function() {
                    // Show the confirmation popup
                    const deletePopup = document.getElementById('deletePopup');
                    deletePopup.style.display = 'block'; // Display the popup

                    // Handle the "Yes" (confirm) button
                    document.getElementById('confirmDelete').onclick = function() {
                        console.log("delete WhishlistID", item.WishlistID);

                        // Send the delete request if confirmed
                        fetch('<?= ROOT ?>/Child/Funzonewhishlist/delete_whish', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    WishlistID: item.WishlistID,
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const typePicker = document.getElementById('typePicker');
                                    fetchMedia(typePicker.value); // Refresh media list after successful deletion
                                    console.log("Fetched media data:", data.data);
                                } else {
                                    console.error("Failed to fetch media data:", data.message);
                                }

                                // Close the popup after action is completed
                                deletePopup.style.display = 'none';
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                deletePopup.style.display = 'none'; // Hide popup on error
                            });
                    };

                    // Handle the "No" (cancel) button
                    document.getElementById('cancelDelete').onclick = function() {
                        deletePopup.style.display = 'none'; // Close the popup if canceled
                    };
                };

                iconContainer.appendChild(watchButton);
                iconContainer.appendChild(removeButton);

                // Media Content
                let mediaContent;
                if (item.MediaType === "Image") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = item.URL;
                    mediaContent.alt = item.Title;
                    mediaContent.width = 150;
                    mediaContent.height = 150;
                } else if (item.MediaType === "Video") {
                    const videoContainer = document.createElement("div");
                    videoContainer.classList.add("video-container");
                    videoContainer.id = `video-container-${item.MediaID}`;

                    const thumbnail = document.createElement("img");
                    thumbnail.src = item.Image || '<?= IMAGE ?>/video.png';
                    thumbnail.alt = "Video Thumbnail";
                    thumbnail.width = 150;
                    thumbnail.height = 150;
                    thumbnail.id = `img-${item.MediaID}`;

                    const video = document.createElement("video");
                    video.width = 250;
                    video.height = 230;
                    video.id = `video-${item.MediaID}`;
                    video.style.display = "none";
                    video.style.marginTop = "-20px";
                    video.style.marginBottom = "-10px";
                    video.muted = true;
                    video.preload = "none";

                    const source = document.createElement("source");
                    source.src = item.URL;
                    source.type = "video/mp4";

                    video.appendChild(source);
                    videoContainer.appendChild(thumbnail);
                    videoContainer.appendChild(video);
                    mediaContent = videoContainer;

                    // **Fix: Attach Event Listeners AFTER element is in the DOM**
                    setTimeout(() => {
                        const container = document.getElementById(`video-container-${item.MediaID}`);
                        const thumb = document.getElementById(`img-${item.MediaID}`);
                        const vid = document.getElementById(`video-${item.MediaID}`);

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
                } else if (item.MediaType === "Audio") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/Audio.jpeg';
                    mediaContent.alt = "Default Placeholder";
                    mediaContent.width = 150;
                    mediaContent.height = 150;
                } else if (item.MediaType === "Book") {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/PDF.jpeg';
                    mediaContent.alt = "Default Placeholder";
                    mediaContent.width = 150;
                    mediaContent.height = 150;
                } else {
                    mediaContent = document.createElement("img");
                    mediaContent.src = '<?= IMAGE ?>/PDF.';
                    mediaContent.alt = "Default Placeholder";
                    mediaContent.width = 150;
                    mediaContent.height = 150;
                }

                // Title
                const title = document.createElement("h3");
                title.style.marginTop = "0px";
                title.textContent = item.Title;

                // Description
                const description = document.createElement("p");
                description.textContent = item.Description;

                // Append elements to item div
                itemDiv.appendChild(iconContainer);
                itemDiv.appendChild(mediaContent);
                itemDiv.appendChild(title);
                itemDiv.appendChild(description);

                const format = document.createElement("p");
                format.classList.add("format");
                format.textContent = `Format: ${item.Format}`;

                // Date & Time Container
                const dateTimeDiv = document.createElement("div");
                dateTimeDiv.classList.add("date-time");

                const reminderDateDiv = document.createElement("div");
                reminderDateDiv.classList.add("reminder-date");
                reminderDateDiv.innerHTML = `<i class="fas fa-calendar-alt"></i> <span class="date-text">${item.Date}</span>`;

                const reminderTimeDiv = document.createElement("div");
                reminderTimeDiv.classList.add("reminder-time");
                reminderTimeDiv.innerHTML = `<i class="fas fa-clock"></i> <span class="time-text">${item.Time}</span>`;

                dateTimeDiv.appendChild(reminderDateDiv);
                dateTimeDiv.appendChild(reminderTimeDiv);

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
                reminderInput.id = `reminder-${item.MediaID}`;

                if (item.Reminder) {
                    reminderInput.checked = true;
                }

                reminderInput.addEventListener("change", function() {
                    if (this.checked) {
                        toggleReminderPopup(item.WishlistID);
                    } else {
                        console.log("Hi");
                        fetch('<?= ROOT ?>/Child/Funzonewhishlist/delete_Reminder', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    WhishlistID: item.WishlistID,
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log("Fetched media data:", data);
                                } else {
                                    console.error("Failed to fetch media data:", data.message);
                                }
                            })
                            .catch(error => console.error("Error:", error));
                    }
                });

                const reminderSlider = document.createElement("span");
                reminderSlider.classList.add("slider");

                reminderLabel.appendChild(reminderInput);
                reminderLabel.appendChild(reminderSlider);
                reminderToggleDiv.appendChild(reminderText);
                reminderToggleDiv.appendChild(reminderLabel);

                // Append all elements to the item div
                itemDiv.appendChild(mediaContent);
                itemDiv.appendChild(title);
                itemDiv.appendChild(description);
                itemDiv.appendChild(format);
                itemDiv.appendChild(dateTimeDiv);
                itemDiv.appendChild(reminderToggleDiv);

                // Append item to grid
                grid.appendChild(itemDiv);
            });

            document.getElementById("media-container").appendChild(grid);
        }



        document.addEventListener('DOMContentLoaded', function() {

            const backBtn = document.getElementById("backforpickup");
            if (backBtn) {
                backBtn.addEventListener("click", () => {
                    location.reload();
                });
            }

            // Refresh button: reset form data (and optionally hide modal)
            const refreshBtn = document.getElementById("pickuprefresh");
            if (refreshBtn) {
                refreshBtn.addEventListener("click", () => {
                    resetReminderForm();
                });
            }

            // Additionally, the Cancel button can close the modal too:
            const closeModalBtn = document.getElementById("closeModalBtn");
            if (closeModalBtn) {
                closeModalBtn.addEventListener("click", () => {
                    location.reload();
                });
            }

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