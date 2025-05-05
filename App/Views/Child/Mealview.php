<!DOCTYPE html>
<html lang="en">

<head>
+    <title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/meal.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/foodtable.css?v=<?= time() ?>">
    <script src="<?= JS ?>/child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/child/MessageDropdown.js?v=<?= time() ?>"></script>
    <!-- <script src="<?= JS ?>/child/meal.js?v=<?= time() ?>"></script> -->
    <script src="<?= JS ?>/child/Navbar.js?v=<?= time() ?>"></script>
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
                <li class="hover-effect unselected" style="margin-top: -20px;">
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
                <li class="selected" style="margin-top: 40px;">
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
                <div class="family-section" style="margin-top: 10px;">
                    <ul>
                        <li class="hover-effect first"
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
        <div class="main-content">
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="name">
                    <h1><?= isset($data['parent']['fullname']) ? $data['parent']['fullname'] : 'No name set'; ?></h1>
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
            <div class="table-holder">
                <div class="container-food t1">
                    <!-- Table for Food -->
                    <div class="foodtable">
                        <h3>Meal Plan</h3>
                        <hr>
                        <input type="date" id="datePicker" min="<?= (date('Y-m-d')); ?>" value="<?= (date('Y-m-d')); ?>" style="width: 200px">
                        <table id="mealsTable">
                            <thead>
                                <tr>
                                    <th style="color: #233E8D; background-color:transparent; padding-right: 4%;">Meal</th>
                                    <th style="color: #233E8D; background-color:transparent; padding-left: 0%;">Dish</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-food t2">
                    <!-- Table for Snacks -->
                    <div class="foodtable" id="snackTable">
                        <h3>Snack Plan</h3>
                        <hr>
                        <input type="date" id="SnackdatePicker" min="<?= (date('Y-m-d')); ?>" value="" style="width: 200px">
                        <table id="snacksTable">
                            <thead>
                                <tr>
                                    <th style="color: #233E8D; background-color:transparent; padding-right: 4%;">Time</th>
                                    <th style="color: #233E8D; background-color:transparent; padding-left: 0%;">Snack</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-food t3">
                    <form id="Form" method="POST" id="details" enctype="multipart/form-data" action="<?= ROOT ?>/Child/Meal/Snack_request">
                        <h3>Add Snack</h3>
                        <hr>
                        <div class="pickup-section">
                            <label for="Date">Date</label>
                            <input name="Date" required id="dateInput" min="<?= (date('Y-m-d', strtotime('+1 day'))); ?>" type="date" value="<?= date('Y-m-d', strtotime('+1 day')); ?>">

                            <label for="Meal">Meal</label>
                            <select name="Meal" required id="mealInput">
                                <option value="Breakfast">Breakfast</option>
                                <option value="Lunch">Lunch</option>
                                <option value="Dinner">Dinner</option>
                            </select>

                            <label for="Snack">Snack</label>
                            <select name="Snack" required id="snackInput">
                            </select>
                        </div>
                        <button type="submit" style="margin-left: 80px; width: 100px;"> Add </button>
                    </form>
                </div>
            </div>

            <div class="container-food container2">
                <h3>Assigned Snacks</h3>
                <hr>
                <p> Please select the child and meal, then enter the snack to assign it. You can easily view and edit the assigned snacks for each child as needed. </p>
                <div class="Snackdata">
                    <form id="Form2" method="POST" enctype="multipart/form-data" action="<?= ROOT ?>/Child/Meal/Snack_request_edit">
                        <div>
                            <h3 style="white-space:nowrap;">Edit Snack Request</h3>
                            <hr>
                            <div class="pickup-section" style="width: 340px;">
                                <label for="date">Date</label>
                                <input class="editsnack" required id="EditSnackDate" type="date" min="<?= (date('Y-m-d', strtotime('+1 day'))); ?>">
                                <label for="date">Meal</label>
                                <select class="editsnacksel" required id="EditSnackTime" name="Meal">
                                    <option>Breakfast</option>
                                    <option>Lunch</option>
                                    <option>Dinner</option>
                                </select>
                                <input type="number" id="requestid" style="display: none;" name="Request"> </input>
                                <label for="date">Snack</label>

                                <select class="editsnacksel" required id="Snacksforedit" type="date" name="Snack">
                                    <option hidden> selecte snack </option>
                                </select>
                            </div>
                            <button style="margin-top: 15px; margin-left:285px;"> Save </button>
                        </div>
                    </form>
                    <div class="verticle-line"></div>
                    <div class="foodtable">
                        <div class="filters">
                            <input type="date" id="requestPicker" min="<?= (date('Y-m-d', strtotime('+1 day'))); ?>" value="<?= date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>
                        <table id="requestTable">
                            <thead>
                                <tr>
                                    <th style="color: #233E8D; background-color: transparent; padding: 10px 15px;">Child</th>
                                    <th style="color: #233E8D; background-color: transparent; padding: 10px 15px;">Meal</th>
                                    <th style="color: #233E8D; background-color: transparent; padding: 10px 15px;">Snack</th>
                                    <th style="color: #233E8D; background-color: transparent; padding: 10px 15px;">Edit</th>
                                </tr>
                            </thead>
                            <tbody style="max-height: 400px; overflow-y: auto;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile"
                style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?php echo htmlspecialchars($data['selectedchildren']['image']); ?>" width="100"
                class="profile" />
            <h2><?= $data['selectedchildren']['fullname'] ?></h2>
            <p>SRD<?= $data['selectedchildren']['id'] ?></p>
            <button class="profile-button"
                onclick="window.location.href ='<?= ROOT ?>/Child/ChildProfile'">Profile</button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ParentProfile'">Parent profile</button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/GuardianProfile'">Guardian profile</button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildPackage'">Package</button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ChildID'">Id Card</button>
            <button class="logout-button" onclick="window.location.href ='<?= ROOT ?>/Child/Home'">LogOut</button>
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

        const dateInput = document.getElementById("dateInput");
        const mealInput = document.getElementById("mealInput");
        const snackInput = document.getElementById("snackInput");

        function fetchSnacks() {
            let selectedDate = dateInput.value;
            let selectedMeal = mealInput.value;
            // console.log(selectedMeal);

            if (!selectedDate) {
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                selectedDate = tomorrow.toISOString().split("T")[0]; // Format as YYYY-MM-DD
                dateInput.value = selectedDate; // Update input field
            }

            // If meal is empty, set it to "Breakfast"
            if (!selectedMeal) {
                selectedMeal = "Breakfast";
                mealInput.value = selectedMeal; // Update input field
            }

            fetch("<?= ROOT ?>/Parent/meal/get_snacks", {
                    method: "POST",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        date: selectedDate,
                        time: selectedMeal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // console.log("Snack data for a specific date and time");
                        // console.log(data.data);
                        updatesnacksInput(data.data);
                    } else {
                        alert("Fetching snacks failed. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchSnacksEdit() {
            let dateInput = document.getElementById("EditSnackDate");
            let mealInput = document.getElementById("EditSnackTime");
            let snackInput = document.getElementById("Snacksforedit"); // Correct reference

            let selectedDate = dateInput.value;
            let selectedMeal = mealInput.value;

            if (!selectedDate) {
                let tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                selectedDate = tomorrow.toISOString().split("T")[0]; // Format as YYYY-MM-DD
                dateInput.value = selectedDate; // Update input field
            }

            if (!selectedMeal) {
                selectedMeal = "Breakfast";
                mealInput.value = selectedMeal; // Update input field
            }

            console.log(selectedDate, selectedMeal);

            fetch("<?= ROOT ?>/Parent/meal/get_snacks", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    credentials: "same-origin",
                    body: JSON.stringify({
                        date: selectedDate,
                        time: selectedMeal,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && Array.isArray(data.data)) {
                        console.log(data.data);
                        snackInput.innerHTML = ''; // Clear previous options

                        data.data.forEach(snack => {
                            let option = document.createElement("option");
                            option.value = snack.SnackID; // Set ID as value
                            option.textContent = snack.Snack; // Set snack name as text
                            snackInput.appendChild(option);
                        });
                    } else {
                        console.error("Unexpected response:", data);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updatesnacksInput(data) {
            // console.log("Received data:", data);
            if (!Array.isArray(data)) {
                console.error("Data is not an array:", data);
                return;
            }

            // Clear previous options
            snackInput.innerHTML = '';
            // Populate the select element with received snack options
            data.forEach(snack => {
                // console.log("Adding snack:", snack.Snack);
                let option = document.createElement("option");
                option.value = snack.SnackID;
                option.textContent = snack.Snack;
                snackInput.appendChild(option);
            });

            // console.log("Updated snackInput:", snackInput.innerHTML);
        }

        function setChildSession(ChildID) {
            fetch(' <?= ROOT ?>/Parent/Meal/setchildsession', {
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
                        console.log("Child name set in session.");
                        window.location.href = '<?= ROOT ?>/Child/Meal';
                    } else {
                        console.error("Failed to set child name in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchMealPlan(date) {
            fetch('<?= ROOT ?>/Child/Meal/store_food', {
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
                        console.log("Meal plan data:", data.data);
                        updateMealPlanTables(data.data);
                    } else {
                        console.error("Failed to fetch meal plan:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Function to update tables dynamically
        function updateMealPlanTables(mealPlan) {
            console.log(mealPlan);
            const mealsTableBody = document.querySelector('#mealsTable tbody');
            mealsTableBody.innerHTML = '';

            // Loop through each meal type (e.g., breakfast, lunch, dinner)
            for (const [meal, dishes] of Object.entries(mealPlan)) {
                let rowSpanSet = false;

                // Loop through the dishes for the current meal
                dishes.forEach(dish => {
                    const row = document.createElement('tr');

                    // Add meal type cell with rowspan for multiple dishes
                    if (!rowSpanSet) {
                        const mealCell = document.createElement('td');
                        mealCell.textContent = meal.charAt(0).toUpperCase() + meal.slice(1); // Capitalize meal type
                        mealCell.rowSpan = dishes.length; // Set rowspan for the meal type cell
                        row.appendChild(mealCell);
                        rowSpanSet = true;
                    }

                    // Add dish cell
                    const dishCell = document.createElement('td');
                    dishCell.textContent = dish; // Set the dish name
                    row.appendChild(dishCell);

                    // Append the row to the table body
                    mealsTableBody.appendChild(row);
                });
            }
        }

        function fetchSnackPlan(date) {
            fetch('<?= ROOT ?>/Child/Meal/store_snack', {
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
                        console.log("Snack plan data:", data.data);
                        updateSnackPlanTables(data.data);
                    } else {
                        console.error("Failed to fetch snack plan:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Function to update tables dynamically
        function updateSnackPlanTables(SnackPlan) {
            console.log(SnackPlan);
            const snacksTableBody = document.querySelector('#snackTable tbody');
            snacksTableBody.innerHTML = '';

            // Loop through each meal type (e.g., breakfast, lunch, dinner)
            for (const [meal, dishes] of Object.entries(SnackPlan)) {
                let rowSpanSet = false;

                // Loop through the dishes for the current meal
                dishes.forEach(dish => {
                    const row = document.createElement('tr');

                    // Add meal type cell with rowspan for multiple dishes
                    if (!rowSpanSet) {
                        const mealCell = document.createElement('td');
                        mealCell.textContent = meal.charAt(0).toUpperCase() + meal.slice(1); // Capitalize meal type
                        mealCell.rowSpan = dishes.length; // Set rowspan for the meal type cell
                        row.appendChild(mealCell);
                        rowSpanSet = true;
                    }

                    // Add dish cell
                    const dishCell = document.createElement('td');
                    dishCell.textContent = dish; // Set the dish name
                    row.appendChild(dishCell);

                    // Append the row to the table body
                    snacksTableBody.appendChild(row);
                });
            }
        }

        function fetchrequest(date) {
            fetch('<?= ROOT ?>/Child/Meal/store_request', {
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
                        console.log("snack request data:", data.data);
                        updateSnackrequestTables(data.data);
                    } else {
                        console.error("Failed to fetch snack request:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updateSnackrequestTables(snackRequestData) {
            const tableBody = document.querySelector("#requestTable tbody");
            tableBody.innerHTML = "";

            for (const childName in snackRequestData) {
                const meals = snackRequestData[childName];
                let firstRowForChild = true;

                for (const meal in meals) {
                    const snacks = meals[meal];
                    let firstRowForMeal = true;

                    for (const snackName in snacks) {
                        const {
                            quantity,
                            requestID
                        } = snacks[snackName];

                        const row = document.createElement("tr");

                        if (firstRowForChild) {
                            const childCell = document.createElement("td");
                            childCell.textContent = childName;
                            childCell.style.padding = "10px 15px";
                            childCell.rowSpan = Object.values(meals).reduce((sum, mealSnacks) => sum + Object.keys(mealSnacks).length, 0);
                            row.appendChild(childCell);
                            firstRowForChild = false;
                        }

                        if (firstRowForMeal) {
                            const mealCell = document.createElement("td");
                            mealCell.textContent = meal;
                            mealCell.style.padding = "10px 15px";
                            mealCell.rowSpan = Object.keys(snacks).length;
                            row.appendChild(mealCell);
                            firstRowForMeal = false;
                        }

                        const snackCell = document.createElement("td");
                        snackCell.textContent = `${snackName} (${quantity})`;
                        snackCell.style.padding = "10px 15px";
                        row.appendChild(snackCell);

                        const editCell = document.createElement("td");
                        editCell.className = "edit";
                        editCell.style.padding = "10px 15px";
                        editCell.innerHTML = `
                    <i class="fas fa-pen reservation-edit" 
                        style="margin-right: 15px; cursor: pointer;" 
                        data-request-id="${requestID}"></i>
                    <i class="fas fa-trash" style="cursor: pointer;" data-request-id="${requestID}"></i>`;
                        row.appendChild(editCell);

                        tableBody.appendChild(row);
                    }
                }
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const editSnackDate = document.getElementById("EditSnackDate");
            const editSnackTime = document.getElementById("EditSnackTime");
            const requestid = document.getElementById("requestid");
            const editSnackSelect = document.getElementById("Snacksforedit");

            editSnackDate.addEventListener('change', function() {
                const selectedDate = this.value;
                const selectedMeal = editSnackTime.value;
                console.log(selectedDate, selectedMeal);
                fetchSnacksEdit(selectedDate, selectedMeal);
            });

            editSnackTime.addEventListener('change', function() {
                const selectedDate = editSnackDate.value;
                const selectedMeal = this.value;
                console.log(selectedDate, selectedMeal);
                fetchSnacksEdit(selectedDate, selectedMeal);
            });

            // Function to populate the edit form
            function populateEditForm(date, meal, snack, id) {
                editSnackDate.value = date;
                requestid.value = id;
                editSnackTime.value = meal;

                fetchSnacksEdit(date, meal);
                setTimeout(() => {
                    Array.from(editSnackSelect.options).forEach(option => {
                        if (option.textContent.trim() == snack.trim()) { // Compare correctly
                            option.selected = true; // Select only the correct option
                        } else {
                            option.selected = false; // Deselect others
                        }
                    });
                }, 100);
            }

            document.querySelector("#requestTable tbody").addEventListener("click", function(event) {
                if (event.target.classList.contains("fa-trash")) {
                    const requestID = event.target.getAttribute("data-request-id");

                    if (!requestID) {
                        console.error("Request ID is missing");
                        return;
                    }

                    // Confirm before deleting
                    if (!confirm("Are you sure you want to delete this snack request?")) {
                        return;
                    }

                    // Send delete request to the server
                    fetch("<?= ROOT ?>/Parent/meal/delete_snack_request", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                ID: requestID
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the row from the table
                                event.target.closest("tr").remove();
                            } else {
                                alert("Failed to delete the request. Try again.");
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }
            });

            document.querySelector("#requestTable tbody").addEventListener("click", function(event) {
                if (event.target.classList.contains("reservation-edit")) {
                    const row = event.target.closest("tr");
                    const requestId = event.target.getAttribute("data-request-id");

                    let childName = null;
                    let meal = null;
                    let snackInfo = null;
                    let snackName = null;

                    // Find the closest row containing the child name
                    let prevRow = row;
                    while (prevRow && prevRow.cells.length < 4) {
                        prevRow = prevRow.previousElementSibling;
                    }
                    if (prevRow) {
                        childName = prevRow.cells[0].textContent.trim(); // Get child name from the first column
                    }

                    // Find the closest row containing the meal name
                    let mealRow = row;
                    while (mealRow && mealRow.cells.length < 3) {
                        mealRow = mealRow.previousElementSibling;
                    }
                    if (mealRow) {
                        meal = mealRow.cells[0].textContent.trim(); // Get meal name from the second column
                    }

                    // Extract snack info from the current row
                    snackInfo = row.cells[row.cells.length - 2].textContent.trim(); // Get snack name + quantity
                    snackName = snackInfo.split(" (")[0]; // Extract snack name only

                    // Get the selected date (assumed from input)
                    let selectedDate = document.getElementById("EditSnackDate").value;
                    if (!selectedDate) {
                        let tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        selectedDate = tomorrow.toISOString().split("T")[0];
                    }

                    console.log("Date:", selectedDate, "Meal:", meal, "Snack:", snackName);

                    populateEditForm(selectedDate, meal, snackName, requestId);
                }
            });


            const dateInput = document.getElementById("dateInput");
            const mealInput = document.getElementById("mealInput");
            const snackInput = document.getElementById("Snacks");

            fetchSnacks();

            dateInput.addEventListener('change', function() {
                console.log(dateInput.value)
                fetchSnacks();
            });
            mealInput.addEventListener('change', function() {
                console.log(mealInput.value)
                fetchSnacks();
            });

            const currentDate = new Date().toISOString().split('T')[0];
            fetchMealPlan(currentDate);
            fetchSnackPlan(currentDate);
            fetchrequest(currentDate);
            console.log(currentDate);

            document.getElementById('requestPicker').addEventListener('change', function() {
                const selectedDate = this.value;
                fetchrequest(selectedDate);
            });

            document.getElementById('datePicker').addEventListener('change', function() {
                const selectedDate = this.value;
                fetchMealPlan(selectedDate);
            });

            document.getElementById('SnackdatePicker').addEventListener('change', function() {
                const selectedDate = this.value;
                console.log(selectedDate);
                fetchSnackPlan(selectedDate);
            });
        });
    </script>
</body>

</html>