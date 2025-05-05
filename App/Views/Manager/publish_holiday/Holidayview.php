<html>

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Holiday.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="<?= JS ?>/Manager/leave.js"></script>
</head>

<body id="body">
    <div style="display: flex;">
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
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Manager/Packages"><i class="fas fa-box"></i> Packages</a>
                    </li>
                </ul>
                <ul>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Manager/Meeting"><i class="fa fa-exclamation-triangle"></i>Meeting</a>
                    </li>
                </ul>

                <ul>
                    <li class="selected">
                        <a href="<?= ROOT ?>/Manager/Holiday    " style="font-size: 18px;">
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
        <div style="display: block;">
            <div class="header" style="margin-top:0.025">
                <div class="name">
                    <h1>Hey Namal</h1>
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
            <div class="alltables">
                <div class="leave-cal">
                    <div class="leave-form-container">
                        <h1 style="color: #233E8D;">Publish Holidays</h1>
                        <form action="<?= ROOT ?>/Manager/Holiday/addleave" method="POST" class="leave-form" id="leaveForm">
                            <div class="form-group">
                                <label for="Leave_Type">Leave Type:</label>
                                <select name="Leave_Type" id="leavetype" class="form-control" required>
                                    <option value="">Select Leave Type</option>
                                    <option value="Annual Leave">Annual Leave</option>
                                    <option value="Poya Leave">Poya Leave</option>
                                    <option value="Independent Day">Independent Day</option>
                                    <option value="Cultural Leave">Cultural Leave</option>
                                    <option value="Religion Leave">Religion Leave</option>
                                    <option value="Other">Other</option>
                                </select>

                                <label for="Date">Date of Holiday:</label>
                                <?php $today = date('Y-m-d'); ?>
                                
                                <input type="date" name="Date" id="Date" class="form-control"
                                    value="<?php echo isset($_POST['Date']) ? $_POST['Date'] : ''; ?>"
                                    min="<?php echo $today; ?>" required>

                                <label for="About">About:</label>
                                <textarea name="About" id="About" required class="form-control" required><?php echo isset($_POST['About']) ? htmlspecialchars($_POST['About']) : ''; ?></textarea>
                                <div class="button-group">
                                    <button type="submit" class="btn btn-primary" style="margin-top:    5%;">Publish</button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="published-holidays" style="width: 25%; margin-top: 7.5%; padding-left: 20px;">
                    <h2>Published Holidays</h2>
                    <div class="holiday-list">
                        <?php if (!empty($data['allholidays'])): ?>
                            <?php foreach (array_reverse($data['allholidays']) as $holiday): ?>
                                <div class="holiday-item">
                                    <h3><?= htmlspecialchars($holiday->Leave_Type) ?></h3>
                                    <p>Date: <?= htmlspecialchars($holiday->Date) ?></p>
                                    <p>About: <?= htmlspecialchars($holiday->About) ?></p>
                                    <div class="buttons">
                                        <button class="update-btn" data-id="<?= $holiday->HolidayID ?>">Update</button>
                                        <button class="del-btn" onclick="deleteholiday(<?= $holiday->HolidayID ?>)">Delete</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No holidays published yet.</p>
                        <?php endif ?>
                    </div>
                </div>



                <div class="calendar">
                    <div class="calheading">
                        <div id="prev" class="btn"><i class="fa-solid fa-arrow-left"></i></div>
                        <div id="month-year"></div>
                        <div id="next" class="btn"><i class="fa-solid fa-arrow-right"></i></div>
                    </div>
                    <div class="weekdays">
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thur</div>
                        <div>Fri</div>
                        <div>Sat</div>
                        <div>Sun</div>
                    </div>
                    <div class="days" id="days"></div>
                </div>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <h2>Confirm Deletion</h2>
                    <p>Are you sure you want to delete this holiday?</p>
                    <div class="modal-buttons">
                        <button id="confirmDelete" class="confirm-btn">Yes, Delete</button>
                        <button id="cancelDelete" class="cancel-btn">Cancel</button>
                    </div>
                </div>
            </div>

            <!-- Update Holiday Popup -->
            <div id="popupContainer" class="popup-container">
                <div class="popup">
                    <button id="closePopup" class="close-btn">×</button>
                    <h1 style="color: #233E8D;">Update Holiday</h1>
                    <form action="<?= ROOT ?>/Manager/Holiday/updateholiday" method="POST" class="leave-form">
                        <!-- Hidden input for holiday ID will be added via JavaScript -->
                        <div class="form-group">
                            <label for="Leave_Type">Leave Type:</label>
                            <select name="Leave_Type" id="update_leavetype" class="form-control" required>
                                <option value="">Select Leave Type</option>
                                <option value="Annual Leave">Annual Leave</option>
                                <option value="Poya Leave">Poya Leave</option>
                                <option value="Independent Day">Independent Day</option>
                                <option value="Cultural Leave">Cultural Leave</option>
                                <option value="Religion Leave">Religion Leave</option>
                                <option value="Other">Other</option>
                            </select>

                            <label for="Date">Date of Holiday:</label>
                            <input type="date" name="Date" id="update_date" class="form-control" required>

                            <label for="About">About:</label>
                            <textarea name="About" id="update_about" class="form-control" required></textarea>

                            <div class="button-group">
                                <button type="submit" class="btn btn-primary" style="margin-top:5%;">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- 
            <script>
                // Convert PHP holidays array to JavaScript with explicit formatting
                const holidays = <?php echo json_encode(!empty($data['allholidays']) ? $data['allholidays'] : []); ?>;

                // Debug - check if holidays are correctly loaded
                console.log("Holidays loaded:", holidays);
            </script> -->

            <script>
                function deleteholiday(HolidayID) {
                    const modal = document.getElementById("deleteModal");
                    const confirmBtn = document.getElementById("confirmDelete");
                    const cancelBtn = document.getElementById("cancelDelete");

                    // Show modal
                    modal.style.display = "flex";

                    // When the user clicks "Yes, Delete"
                    confirmBtn.onclick = function() {
                        window.location.href = `<?= ROOT ?>/Manager/Holiday/deleteholiday/${HolidayID}`;
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

                // update - popup
                // Get elements
                document.addEventListener('DOMContentLoaded', function() {
                    // Get all update buttons by class instead of ID
                    const updateButtons = document.querySelectorAll('.update-btn');
                    const closeBtn = document.getElementById('closePopup');
                    const popupContainer = document.getElementById('popupContainer');

                    // Add click event to all update buttons
                    updateButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Get the holiday data from this specific holiday item
                            const holidayItem = this.closest('.holiday-item');
                            const holidayId = this.getAttribute('data-id');

                            // Get the text content of leave type, date, and about
                            const leaveType = holidayItem.querySelector('h3').textContent;
                            const dateText = holidayItem.querySelector('p:nth-of-type(1)').textContent;
                            const aboutText = holidayItem.querySelector('p:nth-of-type(2)').textContent;

                            // Extract just the date value from "Date: 2023-04-16" format
                            const dateValue = dateText.replace('Date: ', '').trim();
                            // Extract just the about text from "About: Some text" format
                            const aboutValue = aboutText.replace('About: ', '').trim();

                            // Set form action to point to the update endpoint with the correct ID
                            const form = document.querySelector('#popupContainer form');
                            form.action = `<?= ROOT ?>/Manager/Holiday/updateholiday/${holidayId}`;

                            // Add hidden input for holiday ID if needed
                            let hiddenInput = form.querySelector('input[name="HolidayID"]');
                            if (!hiddenInput) {
                                hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'HolidayID';
                                form.appendChild(hiddenInput);
                            }
                            hiddenInput.value = holidayId;

                            // Populate form fields with the holiday data
                            const leaveTypeSelect = form.querySelector('select[name="Leave_Type"]');
                            const dateInput = form.querySelector('input[name="Date"]');
                            const aboutTextarea = form.querySelector('textarea[name="About"]');

                            // Set the selected option in the dropdown
                            for (let i = 0; i < leaveTypeSelect.options.length; i++) {
                                if (leaveTypeSelect.options[i].value === leaveType) {
                                    leaveTypeSelect.selectedIndex = i;
                                    break;
                                }
                            }

                            // Set the date and about values
                            dateInput.value = dateValue;
                            aboutTextarea.value = aboutValue;

                            // Show the popup
                            popupContainer.style.display = 'flex';
                        });
                    });

                    // Close popup function
                    function closePopup() {
                        popupContainer.style.display = 'none';
                    }

                    // Event listener for close button
                    if (closeBtn) {
                        closeBtn.addEventListener('click', closePopup);
                    }

                    // Close popup when clicking outside
                    popupContainer.addEventListener('click', function(event) {
                        if (event.target === popupContainer) {
                            closePopup();
                        }
                    });

                    // Close popup with Escape key
                    document.addEventListener('keydown', function(event) {
                        if (event.key === 'Escape') {
                            closePopup();
                        }
                    });
                });
            </script>
</body>

</html>