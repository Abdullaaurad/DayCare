<html>

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Meeting.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Event.css?v=<?= time() ?>">

</head>

<body id="body">
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
                <li class="selected">
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
    <div class="header" style="margin-top:-1.3%">
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


    <div class="container">
        <!-- Column 1: Add Time Slot Form -->
        <div class="column">
            <h2>Add Time Slot</h2>
            <form id="meetingform" action="<?= ROOT ?>/Manager/Meeting/addMeeting" method="post" class="leave-form">
                <div class="form-group">
                    <label for="SlotTime">Time Slot<span class="required">*</span></label>
                    <select name="Time" id="SlotTime" class="form-control">
                        <option value="hidden">Select Time Slot</option>
                        <option value="9:00:00">9:00 - 9:15</option>
                        <option value="9:15:00">9:15 - 9:30</option>
                        <option value="9:30:00">9:30 - 9:45</option>
                        <option value="9:45:00">9:45 - 10:00</option>
                        <option value="10:00:00">10:00 - 10:15</option>
                        <option value="10:15:00">10:15 - 10:30</option>
                        <option value="11:00:00">11:00 - 11:15</option>
                        <option value="11:15:00">11:15 - 11:30</option>
                        <option value="11:30:00">11:30 - 11:45</option>
                        <option value="11:45:00">11:45 - 12:00</option>
                    </select>
                </div>
                
                <div class="form-group date-container">
                    <label for="SlotDate" class="date-label">Select a Saturday:<span class="required">*</span></label>
                    <input
                        type="date"
                        id="SlotDate"
                        name="Date"
                        class="form-control"
                        min="<?php echo date('Y-m-d', strtotime('next Saturday')); ?>"
                        required>
                    <div id="dateMessage" class="date-message"></div>
                </div>
                
                <input type="hidden" name="MeetingID" id="MeetingID" value="">
                <div class="button-group">
                    <button type="submit" id="Add" class="btn btn-primary">Add</button>
                    <button type="submit" id="Update" style="display: none;" class="btn btn-secondary">Update</button>
                </div>
            </form>
        </div>
        <!-- Column 2: Time Slots List -->
        <div class="column">
            <h2>Time Slots</h2>
            <div class="event-list">
                <?php if (!empty($data['allslots'])): ?>
                    <?php foreach (array_reverse($data['allslots']) as $slot): ?>
                        <div class="event-item">
                            <h3><?= htmlspecialchars($slot->Time) ?></h3>
                            <p>Date: <?= htmlspecialchars($slot->Date) ?></p>
                            <?php if ($slot->Scheduled == 0): ?>
                                <div class="buttons">
                                    <button class="update-btn" onclick="UpdateSlot(<?= $slot->MeetingID ?>)">Update</button>
                                    <button class="del-btn" onclick="deleteSlot(<?= $slot->MeetingID ?>)">Delete</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No events published yet.</p>
                <?php endif ?>
            </div>
        </div>
        <!-- Column 3: New Enrollment Meetings -->
        <div class="column">
            <h2>New Enrollment Meetings</h2>
            <div class="event-list">
                <?php if (!empty($data['admission_allslots'])): ?>
                    <?php foreach (array_reverse($data['admission_allslots']) as $slot): ?>
                        <div class="event-item">
                            <h3><?= htmlspecialchars($slot->Name) ?></h3>
                            <p>Phone Number: <?= htmlspecialchars($slot->PhoneNumber) ?></p>
                            <p>Email : <?=htmlspecialchars($slot->Email)?></p>
                            <div class="buttons">
                                <button class="del-btn" onclick="adddeleteSlot(<?= $slot->NIC?>)">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No meetings yet.</p>
                <?php endif ?>
            </div>
        </div>
    </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this time Slot?</p>
            <div class="modal-buttons">
                <button id="confirmDelete" class="confirm-btn">Delete</button>
                <button id="cancelDelete" class="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const SlotTime = document.getElementById('SlotTime');
            const SlotDate = document.getElementById('SlotDate');
            const MeetingID = document.getElementById('MeetingID');
            const Update = document.getElementById('Update');
            const dateMessage = document.getElementById('dateMessage');

            // Set initial value to next Saturday
            SlotDate.value = "<?php echo date('Y-m-d', strtotime('next Saturday')); ?>";

            // Show initial message
            dateMessage.textContent = "Please select Saturday Only";
            dateMessage.classList.add('info-message');

            // Load time slots for the initial date
            loadTimeSlots(SlotDate.value);

            // Single event listener for date changes to handle both validation and time slot loading
            SlotDate.addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time part for proper date comparison

                // Check if selected date is in the past
                if (selectedDate < today) {
                    // Show error message for past dates
                    dateMessage.textContent = "Please select a future date";
                    dateMessage.classList.remove('info-message');
                    dateMessage.classList.add('error-message');

                    // Reset to next available Saturday
                    const nextSat = findNextSaturday(new Date());
                    this.value = formatDate(nextSat);

                    setTimeout(() => {
                        dateMessage.textContent = "Please select Saturday";
                        dateMessage.classList.remove('error-message');
                        dateMessage.classList.add('info-message');
                    }, 3000);

                    // Load time slots for the corrected date   
                    loadTimeSlots(this.value);
                    return;
                }

                // Check if selected date is a Saturday (day 6)
                if (selectedDate.getDay() !== 6) {
                    // Show error message
                    dateMessage.textContent = "Sorry, only Saturdays are available for booking";
                    dateMessage.classList.remove('info-message');
                    dateMessage.classList.add('error-message');

                    // Reset to next available Saturday
                    const nextSat = findNextSaturday(selectedDate);
                    this.value = formatDate(nextSat);

                    // After 3 seconds, switch back to info message
                    setTimeout(() => {
                        dateMessage.textContent = "Please select Saturday only";
                        dateMessage.classList.remove('error-message');
                        dateMessage.classList.add('info-message');
                    }, 3000);

                    // Load time slots for the corrected date
                    loadTimeSlots(this.value);
                } else {
                    // Valid selection, show confirmation
                    const options = {
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    dateMessage.textContent = "Selected: " + selectedDate.toLocaleDateString(undefined, options);
                    dateMessage.classList.remove('error-message');
                    dateMessage.classList.add('info-message');

                    // Load time slots for the valid date
                    loadTimeSlots(this.value);
                }
            });

            // Function to load time slots from the server
            function loadTimeSlots(selectedDate) {
                console.log("Loading time slots for:", selectedDate);

                fetch('<?= ROOT ?>/Manager/Meeting/checkDate', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            Date: selectedDate
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server response:', data);
                        SlotTime.innerHTML = '';

                        // Create label map for time slots
                        const labelMap = {
                            "09:00:00": "9:00 - 9:15",
                            "09:15:00": "9:15 - 9:30",
                            "09:30:00": "9:30 - 9:45",
                            "09:45:00": "9:45 - 10:00",
                            "10:00:00": "10:00 - 10:15",
                            "10:15:00": "10:15 - 10:30",
                            "11:00:00": "11:00 - 11:15",
                            "11:15:00": "11:15 - 11:30",
                            "11:30:00": "11:30 - 11:45",
                            "11:45:00": "11:45 - 12:00"
                        };

                        // Always add the "Select" option first
                        const defaultOption = document.createElement('option');
                        defaultOption.value = 'hidden';
                        defaultOption.textContent = 'Select Time Slot';
                        SlotTime.appendChild(defaultOption);

                        // Check if we are updating
                        if (Update.style.display === 'flex') {
                            const meetingId = MeetingID.value;
                            const allSlots = <?= json_encode($data['allslots'] ?? []) ?>;
                            const selectedSlot = allSlots.find(slot => slot.MeetingID == meetingId);

                            if (selectedSlot) {
                                const selectedTime = selectedSlot.Time;

                                const selectedOption = document.createElement('option');
                                selectedOption.value = selectedTime;
                                selectedOption.textContent = labelMap[selectedTime] || selectedTime;
                                selectedOption.selected = true;
                                SlotTime.appendChild(selectedOption);
                            }
                        }

                        // Add remaining available slots (excluding the selected one if updating)
                        data.forEach(time => {
                            // Don't add duplicate if already selected
                            const isAlreadySelected = SlotTime.querySelector(`option[value="${time}"]`);
                            if (!isAlreadySelected) {
                                const option = document.createElement('option');
                                option.value = time;
                                option.textContent = labelMap[time] || time;
                                SlotTime.appendChild(option);
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error sending date:', error);
                    });
            }

            // Find the next Saturday from a given date
            function findNextSaturday(date) {
                const dayOfWeek = date.getDay();
                const daysUntilSaturday = (6 - dayOfWeek + 7) % 7;

                const nextSaturday = new Date(date);
                nextSaturday.setDate(date.getDate() + (daysUntilSaturday === 0 ? 7 : daysUntilSaturday));

                return nextSaturday;
            }

            // Format date as YYYY-MM-DD for input value
            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');

                return `${year}-${month}-${day}`;
            }
        });

        // JavaScript function to update a slot
        function UpdateSlot(meetingId) {
            const meetingform = document.getElementById('meetingform');
            meetingform.action = "<?= ROOT ?>/Manager/Meeting/updateMeeting";

            const Add = document.getElementById('Add');
            const Update = document.getElementById('Update');
            const SlotDate = document.getElementById('SlotDate');
            const MeetingID = document.getElementById('MeetingID');

            Add.style.display = "none";
            Update.style.display = "flex";

            const data = <?php echo json_encode($data['allslots'] ?? []); ?>;

            const selectedSlot = data.find(slot => slot.MeetingID == meetingId);
            console.log(selectedSlot);

            if (selectedSlot) {
                console.log('Slot found:', selectedSlot);
                // Set the values using the correct IDs
                console.log('Setting values:', selectedSlot.Time, selectedSlot.Date);
                SlotDate.value = selectedSlot.Date;
                MeetingID.value = selectedSlot.MeetingID;

                // Manually trigger the date change event to load available time slots
                const changeEvent = new Event('change');
                SlotDate.dispatchEvent(changeEvent);
            } else {
                console.error('Slot not found with ID:', meetingId);
            }
        }

        function deleteSlot(MeetingID) {
            const modal = document.getElementById("deleteModal");
            const confirmBtn = document.getElementById("confirmDelete");
            const cancelBtn = document.getElementById("cancelDelete");

            // Show modal
            modal.style.display = "flex";

            // When the user clicks "Delete"
            confirmBtn.onclick = function() {
                window.location.href = `<?= ROOT ?>/Manager/Meeting/deleteSlot/${MeetingID}`;
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


        // function adddeleteSlot(NIC){
        //     const modal = document.getElementById("deleteModal");
        //     const confirmBtn = document.getElementById("confirmDelete");
        //     const cancelBtn = document.getElementById("cancelDelete");

        //     // Show modal
        //     modal.style.display = "flex";

        //     // When the user clicks "Delete"
        //     confirmBtn.onclick = function() {
        //         window.location.href = `<?= ROOT ?>/Manager/Meeting/deleteAdmissionSlot/${NIC}`;
        //     };

        //     // When the user clicks "Cancel"
        //     cancelBtn.onclick = function() {
        //         modal.style.display = "none";
        //     };

        //     // Close modal when clicking outside
        //     window.onclick = function(event) {
        //         if (event.target == modal) {
        //             modal.style.display = "none";
        //         }
        //     };
        // }

    </script>
</body>

</html>