    <html>

    <head>
    <title>Manager</title>
        <link rel="icon" href="../Assets/KIDDOVILLE_LOGO.jpg">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../Header/Header.css" />
        <link rel="stylesheet" href="<?= CSS ?>/Manager/package.css?v=<?= time() ?>" />
        <link rel="stylesheet" href="<?= CSS ?>/Manager/component.css?v=<?= time() ?>" />
        <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>" />
        <link rel="stylesheet" href="<?= CSS ?>/Manager/Holiday.css?v=<?= time() ?>">

    </head>

    <body>
        <div class="container">
            <div class="sidebar">
                <div class="logo_stuf" style="display: flex;margin-top:6%">
                    <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
                    <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
                </div>
                <ul style=" margin-top: 10%;">
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Manager/Home" style="font-size: 18px;margin-left:10%;margin-top:-10%;">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Viewprofile" style="font-size: 18px;">
                                <i class="fas fa-user-check"></i>Accounts
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Schedule" style="font-size: 18px;">
                                <i class="fas fa-calendar"></i>Scheduling
                            </a>
                        </li>
                    </ul>

                    <ul>
                        <li class="selected">
                            <a href="<?= ROOT ?>/Manager/Packages"><i class="fas fa-box"></i> Packages</a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Meeting"><i class="fa fa-exclamation-triangle"></i>Meeting</a>
                        </li>
                    </ul>

                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Holiday" style="font-size: 18px;">
                                <i class="fas fa-umbrella-beach"></i> Holiday</a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Event" style="font-size: 18px;">
                                <i class="fa fa-calendar-plus"></i>Event</a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Foodtable" style="font-size: 18px;">
                                <i class="fa fa-pizza-slice"></i>Food Plane</a>
                        </li>
                    </ul>
                    <ul>
                        <li class="hover-effect unselected">
                            <a href="<?= ROOT ?>/Manager/Leaverequest" style="font-size: 18px;">
                                <i class="fas fa-hand-paper"></i>Request</a>
                        </li>
                    </ul>
                </ul>
            </div>
            <div class="header" style="margin-top:16.45%">
                <div class="name">
                    <h1 style="color: #fff;">Hey Namal</h1>
                    <p style="color: white;">Let’s do some productive activities today</p>
                </div>
                <div class="profile">
                    <button class="profilebtn" onclick="handleClick()">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                    </button>
                </div>
                <div class="profile-card" id="profileCard" style="margin-top: 21%;">
                    <button class="back" onclick="handleHide()"><i class="fas fa-chevron-left"></i></button>
                    <img alt="Profile picture of Thilina Perera" height="100" src="../Assets/shimhan.jpg" width="100" class="profile" />
                    <h2>
                        Thilina Perera
                    </h2>
                    <p>
                        ID    RS0110657
                    </p>
                    <button class="profile-button">
                        Personal info
                    </button>
                    <button class="secondary-button">
                        Change Password
                    </button>
                    <button class="logout-button">
                        LogOut
                    </button>
                </div>
            </div>
            <div class="fill" style="margin-left: 300px;margin-top:25%">
                <h1 style=" margin-left: 20px;color:#233E8D ;width:75%;margin-top:20px;">Packages</h1>
                <hr>
                <div class="packages">
                    <?php if (!empty($data['packageData'])) : ?>
                        <?php foreach ($data['packageData'] as $package) : ?>
                            <div class="package-card">
                                <img alt="Classroom with colorful furniture and toys" src="<?= IMAGE ?>/packages.png" />
                                <p><?= $package->Name; ?></p>
                                <p>LKR.<?= $package->Price; ?>.00</p>
                                <button class='update-btn' onclick="updatepackage('<?= $package->PackageID; ?>')">Update</button>
                                <button class="delete-btn" onclick="deletepackage('<?= $package->PackageID; ?>')">Delete</button>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div>No packages available</div>
                    <?php endif; ?>
                </div>
                <div class="add-packages">
                    <button class="add-btn" onclick="addPackage()" id="addpack">+Add Package</button>
                </div>
                <div id="popupOverlay"></div>
                <div class="addcontainer" id="Addcontainer" style="width: 35%; height: 80%; margin-top: 2.5%; overflow-y: auto;">
                    <button id="close" class="close-btn">×</button>
                    <form id="packageForm" method="post" action="<?= ROOT ?>/Manager/Packages/addpackage">
                        <h1>Create Package</h1>
                        <!-- Package name -->
                        <label for="package-name">Package Name <span class="required">*</span></label>
                        <input type="text" class="opt" name="Name" placeholder="Enter package name"
                            value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : ''; ?>" required>
                        <!-- Included services -->
                        <label for="included-services">Description<span class="required">*</span></label>
                        <textarea name="Description" id="included-services" class="Description" placeholder="List included services" required><?php echo isset($_POST['Description']) ? $_POST['Description'] : ''; ?></textarea>
                        <!-- Price -->
                        <label for="Price">Price <span class="required">*</span></label>
                        <input type="number" id="Price" name="Price" value="<?php echo isset($_POST['Price']) ? $_POST['Price'] : '' ?>"
                            required min="1" max="25000">
                        <?php if (isset($_POST['Price']) && $_POST['Price'] > 25000): ?>
                            <p class="error">Price cannot exceed 25,000.</p>
                        <?php endif; ?>
                        <!-- Age group -->
                        <label for="AgeGroup">Age Group:</label>
                        <select name="AgeGroup" id="agegroup" class="form-control" required>
                            <option value="">Select Age Group</option>
                            <option value="2-3">2-3</option>
                            <option value="3-4">3-4</option>
                            <option value="4-5">4-5</option>
                            <option value="5-7">5-7</option>
                            <option value="7-9">7-9</option>
                        </select>
                        <!-- FoodAddons  -->
                        <label for="FoodAddons">Food Addons:</label>
                        <select name="features" id="foodaddons" class="form-control" required>
                            <option value="" selected hidden>Select Features</option>
                            <option value="AllHours">All Hours</option>
                            <option value="FoodAddons">Food Addons</option>
                            <option value="Everything">Everything</option>
                        </select>
                        <!-- Days -->

                        <?php
                        // Assuming selected days are stored in an array
                        $selectedDays = isset($_POST['days']) ? $_POST['days'] : [];
                        ?>

                        <div class="checkbox-group">
                            <label>
                                <input type="checkbox" name="Monday"> Monday
                            </label>
                            <label>
                                <input type="checkbox" name="Tuesday"> Tuesday
                            </label>
                            <label>
                                <input type="checkbox" name="Wedenesday"> Wednesday
                            </label>
                            <label>
                                <input type="checkbox" name="Thursday"> Thursday
                            </label>
                            <label>
                                <input type="checkbox" name="Friday"> Friday
                            </label>
                            <label>
                                <input type="checkbox" name="Saturday"> Saturday
                            </label>
                            <label>
                                <input type="checkbox" name="Sunday"> Sunday
                            </label>
                        </div>

                        <!-- Submit button -->
                        <div class="buttons">
                            <button type="submit" class="publish" style="margin-bottom: 2%;">Publish</button>
                            <a href="<?= ROOT ?>/Manager/Packages" style="margin-bottom: 2%;" class="cancel">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        <!-- Add this near the top of your packages view -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['message_type'] ?>">
                <?= $_SESSION['message'] ?>
            </div>
            <?php
            // Clear the message after displaying
            unset($_SESSION['message']);
            unset($_SESSION['message_type']);
            ?>
        <?php endif; ?>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Confirm Deletion</h2>
                <p>Are you sure you want to delete this Package?</p>
                <div class="modal-buttons">
                    <button id="confirmDelete" class="confirm-btn">Delete</button>
                    <button id="cancelDelete" class="cancel-btn" id="closePopup">Cancel</button>
                </div>
            </div>
        </div>



        <div id="popupContainer" class="popup-container">
            <div class="popup" style="width: 35%; height: 80%; margin-top: 5%; overflow-y: auto;">
                <button id="closePopup" class="close-btn">×</button>
                <h1 style="color: #233E8D; text-align: center;">Update Package</h1>
                <form method="POST" class="leave-form" id="updatePackageForm" action="<?= ROOT ?>/Manager/Packages/updatepackage">
                    <!-- Hidden package ID field -->
                    <input type="hidden" name="PackageID" id="packageId" value="<?= $package->PackageID; ?>">

                    <!-- Package name -->
                    <label for="package-name">Package Name <span class="required">*</span></label>
                    <input type="text" class="opt" name="Name" id="packageName" placeholder="Enter package name" value="" required>

                    <!-- Description -->
                    <label for="included-services">Description<span class="required">*</span></label>
                    <textarea name="Description" id="packageDescription" class="Description" placeholder="List included services" required></textarea>

                    <!-- Price -->
                    <label for="Price">Price <span class="required">*</span></label>
                    <input type="number" id="packagePrice" name="Price" required min="1" max="25000">

                    <!-- Age group -->
                    <label for="AgeGroup">Age Group:</label>
                    <select name="AgeGroup" id="packageAgeGroup" class="form-control" required>
                        <option value="">Select Age Group</option>
                        <option value="2-3">2-3</option>
                        <option value="3-4">3-4</option>
                        <option value="4-5">4-5</option>
                        <option value="5-7">5-7</option>
                        <option value="7-9">7-9</option>
                    </select>

                    <!-- Features -->
                    <label for="features">Features:</label>
                    <select name="features" id="packageFeatures" class="form-control" required>
                        <option value="" selected hidden>Select Features</option>
                        <option value="AllHours">All Hours</option>
                        <option value="FoodAddons">Food Addons</option>
                        <option value="Everything">Everything</option>
                    </select>

                    <!-- Days -->
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="Monday" id="monday"> Monday</label>
                        <label><input type="checkbox" name="Tuesday" id="tuesday"> Tuesday</label>
                        <label><input type="checkbox" name="Wednesday" id="wednesday"> Wednesday</label>
                        <label><input type="checkbox" name="Thursday" id="thursday"> Thursday</label>
                        <label><input type="checkbox" name="Friday" id="friday"> Friday</label>
                        <label><input type="checkbox" name="Saturday" id="saturday"> Saturday</label>
                        <label><input type="checkbox" name="Sunday" id="sunday"> Sunday</label>
                    </div>

                    <!-- Submit button -->
                    <div class="buttons">
                        <button type="submit" class="publish" id="confirmupdate">Update</button>
                        <a href="<?= ROOT ?>/Manager/Packages" class="cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function deletepackage(PackageID) {
                const modal = document.getElementById("deleteModal");
                const confirmBtn = document.getElementById("confirmDelete");
                const cancelBtn = document.getElementById("cancelDelete");

                // Show modal
                modal.style.display = "flex";

                // When the user clicks "Yes, Delete"
                confirmBtn.onclick = function() {
                    window.location.href = `<?= ROOT ?>/Manager/Packages/deletePackage/${PackageID}`;
                };

                // When the user clicks "Cancel"
                cancelBtn.onclick = function() {
                    modal.style.display = "none";
                };

                // Close modal when clicking outside
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };
            }

            function addPackage() {
                const close = document.getElementById('close')
                const addcontainer = document.getElementById('Addcontainer')
                document.querySelector(".addcontainer").style.display = "flex";
                close.addEventListener('click', function() {
                    addcontainer.style.display = 'none';
                });

                // Optional: Also close popup when clicking outside the modal
                window.addEventListener('click', function(e) {
                    if (e.target === updatemodal) {
                        addcontainer.style.display = 'none';
                    }
                });
            }

            function closePackageForm() {
                document.querySelector(".addcontainer").style.display = "none";
            }

            function updatepackage(PackageID) {

                //window.location.href = `<?= ROOT ?>/Manager/Packages/getPackage/${PackageID}`;

                fetch(`<?= ROOT ?>/Manager/Packages/getPackage/${PackageID}`)
                    .then(response => response.json())
                    .then(data => {
                        
                        console.log(data);
                        // Populate the form fields with the fetched data
                        document.getElementById('packageId').value = data.PackageID;
                        document.getElementById('packageName').value = data.Name;
                        document.getElementById('packageDescription').value = data.Description;
                        document.getElementById('packagePrice').value = data.Price;
                        document.getElementById('packageAgeGroup').value = data.AgeGroup;
                        document.getElementById('packageFeatures').value = data.Features;

                        const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        days.forEach(day => {
                            document.getElementById(day.toLowerCase()).checked = data[day] === 1;
                        });
                    })
                    .catch(error => console.error('Error fetching package data:', error));

                const updatemodal = document.getElementById('popupContainer');
                const closepopup = document.getElementById('closePopup');

                // Show the modal
                updatemodal.style.display = 'flex';


                // Close the popup when '×' button is clicked
                closepopup.addEventListener('click', function() {
                    updatemodal.style.display = 'none';
                });

                // Optional: Also close popup when clicking outside the modal
                window.addEventListener('click', function(e) {
                    if (e.target === updatemodal) {
                        updatemodal.style.display = 'none';
                    }
                }); 
            }
        </script>

    </body>

    </html>