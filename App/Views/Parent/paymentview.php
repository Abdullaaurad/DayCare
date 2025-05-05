<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/payment.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Stats.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Table1.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px;">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">

        </div>
        <!-- navigation -->
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
                    <h2 style="margin-top: 25px;">Little Explorers</h2>
                    <p style="margin-bottom: 20px; color: white; margin-left: 5px !important;">
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
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn" style=""></i>
                <div class="name">
                    <h1><?= isset($data['parent']['fullname']) ? $data['parent']['fullname'] : 'No name set'; ?></h1>
                    <p style="color: white">Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <!-- message icon -->
                <div class="bell-con" id="bell-container" style="cursor: pointer;">
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
            <div class="stats">
                <div class="stat" style="justify-content: center; display: flex; flex-direction: column; align-items: center;">
                    <div class="overdue-payment" style="justify-content: center; display: flex;">
                        <div style="margin-left: 20px; margin-right: 20px;">
                            <?php if (isset($data['Due'])): ?>
                                <h2 style="color: red; margin-top: -5px; margin-bottom: -5px;">Overdue Payment</h2>
                                <p>Due Date: <strong><?= $data['Due']['Date'] ?></strong></p>
                                <p>Amount: <strong><?= $data['Due']['Amount'] ?> Rs</strong></p>
                                <form id="pay-form" action="http://localhost/KiddoVille-UI_UX/App/core/Payment.php" method="GET">
                                    <input type="hidden" name="total" id="total-input" value="<?= $data['Due']['Amount']*100 ?>" />
                                    <button type="submit" class="pay-now">Pay Now</button>
                                </form>
                            <?php else: ?>
                                <h2 style="color: red;">No Overdue Payment</h2>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
                <div class="stat" style="justify-content: center; display: flex; flex-direction: column; align-items: center;">
                    <div class="upcoming-payment" style="justify-content: center; display: flex;">
                        <div style="margin-left: -10px; margin-right: 20px;">
                            <?php if (isset($data['Expenses'])): ?>
                                <h2 style="color: green; margin-top: -5px; margin-bottom: -5px;">Upcoming Payment</h2>
                                <p>Due Date: <strong><?= $data['Expenses']['Date'] ?></strong></p>
                                <p>Amount: <strong><?= $data['Expenses']['Amount'] ?> Rs</strong></p>
                            <?php else: ?>
                                <h2 style="color: green;"> No Expenses </h2>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="stat">
                    <div style="justify-content: center; display: flex; flex-direction: column; align-items: center;">
                        <?php if (isset($data['LastBill'])): ?>
                            <h3 style="margin-top: 5px;">
                                <img src="<?= IMAGE ?>/mountain.svg" alt="Attendance" style="width: 40px; margin-right: 10px; margin-top: -15px;">
                                Last bill amount
                            </h3>
                            <p style="margin-top: 15px;"><?= isset($data['LastBill']['Amount']) ? $data['LastBill']['Amount'] : '0'; ?> Rs</p>
                        <?php else: ?>
                            <h3 style="margin-top: 5px;">
                                <img src="<?= IMAGE ?>/mountain.svg" alt="Attendance" style="width: 40px; margin-right: 10px; margin-top: -15px;">
                                Enjoy the journey — your first invoice will show up here soon!
                            </h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="saperate">
                <!-- payment table -->
                <div class="reservation-container">
                    <div class="toggle" style="margin-top: -20px;">
                        <label class="background" for="toggle"></label>
                        <div style="display: flex; flex-direction: row; justify-content: space-between; width: 100%;">
                            <label class="up-btn" id="up-btn">Upcoming</label>
                            <label class="hi-btn" id="hi-btn">History</label>
                        </div>
                    </div>
                    <div id="history" style="display: none;">
                        <h2 style="margin-top: 10px !important; margin-bottom: 2px;"> Payment History </h2>
                        <hr>
                        <div class="filters">
                            <input type="date" max="<?= (date('Y-m-d')); ?>" id="datePicker" style="width: 200px">
                            <select id="modePicker" style="margin-right: 100px; width: 200px">
                                <option value="All" hidden>Mode</option>
                                <option value="All">All</option>
                                <option value="Cash">Cash</option>
                                <option value="Online">Online</option>
                                <option value="Transfer">Transfer</option>
                            </select>
                            <select id="childPicker" style="margin-right: 400px;">
                                <option value="All" selected hidden>Child</option>
                                <option Value="All"> All </option>
                                <?php foreach ($data['children'] as $child): ?>
                                    <option value="<?= $child['name']; ?>">
                                        <?= $child['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <table id="history" class="payments" style="margin-top: -10px;">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Child</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Amount</th>
                                    <th> View </th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div id="upcoming" style="display: flex; flex-direction: row; align-items: flex-start;">
                        <div style="width: 600px; height: 400px;">
                            <canvas id="paymentsChart" width="500" height="200"></canvas>
                        </div>
                        <div style="margin-top: -10px;">
                            <div class="payment-description">
                                <h3>
                                    Payment Description
                                </h3>
                                <hr style="margin-top: -17px;">
                                <div id="month-switcher" class="month-switcher">
                                    <button id="prev-month" class="month-nav">&lt;</button>
                                    <span id="current-month" class="month-label">April 2025</span>
                                    <button id="next-month" class="month-nav">&gt;</button>
                                </div>
                                <ul>
                                    <li>
                                        <span>
                                            Service: Tuition Fee
                                        </span>
                                        <span class="amount">
                                            Amount: $500
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Meal Plan
                                        </span>
                                        <span class="amount">
                                            Amount: $200
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Sports Activity
                                        </span>
                                        <span class="amount">
                                            Amount: $150
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Art Class
                                        </span>
                                        <span class="amount">
                                            Amount: $100
                                        </span>
                                    </li>
                                </ul>
                                <div class="total">
                                    Total Amount: $950
                                </div>
                                <div style=" display: flex;justify-content: space-between; ">
                                    <button class="btn" id="view-details-btn">
                                        View Details
                                    </button>
                                    <!-- <button class="btn" onclick="window.location.href='<?= ROOT ?>/Parent/Pay'">
                                        Pay Now
                                    </button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- messager navigation -->

        </div>
        <!-- profile card -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
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
            fetch("<?= ROOT ?>/Parent/payment/Logout", {
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
            fetch(' <?= ROOT ?>/Parent/Payment/setchildsession', {
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
                        window.location.href = '<?= ROOT ?>/Child/Home';
                    } else {
                        console.error("Failed to set child name in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchPayments(date = null, mode = null, child = null) {
            console.log(date, child, mode)
            fetch('<?= ROOT ?>/Parent/Payment/store_history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date,
                        child: child,
                        mode: mode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("data:", data.data);
                        updaterHistoryTable(data.data);
                    } else {
                        console.error("Failed to fetch meal plan:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function updaterHistoryTable(data) {
            const historyTableBody = document.querySelector('#history tbody');
            historyTableBody.innerHTML = '';

            data.forEach(pay => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${pay.PaymentID ?? "No res set"}</td>
                    <td>${pay.ChildName ?? "No res set"}</td>
                    <td>${pay.Date ?? "No res set"}</td>
                    <td> ${pay.Time ?? "No res set"} </td>
                    <td> ${pay.Amount ?? "No res set"} </td>
                    <td> <i class="fas fa-eye"></i> </td>
                    <td> ${pay.Mode ?? "No res set"} </td>
                `;
                historyTableBody.appendChild(row);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById("pay-form");

            if(form){
                form.addEventListener("submit", function (e) {
                    e.preventDefault();

                    const total = document.getElementById("total-input").value;
                    const purpose = "Overdue Pyament Parent";

                    fetch("<?=ROOT?>/Parent/Payment/AmountPurpose", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({ total, purpose })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            form.submit();
                        } else {
                            alert("Something went wrong while setting session!");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
                });
            }

            document.getElementById('view-details-btn').addEventListener('click', function () {
                const monthText = document.getElementById('current-month').textContent.trim(); // e.g., "April 2025"
                const [monthName, year] = monthText.split(' ');
                
                const monthMap = {
                    January: '01', February: '02', March: '03',
                    April: '04', May: '05', June: '06',
                    July: '07', August: '08', September: '09',
                    October: '10', November: '11', December: '12'
                };

                const month = monthMap[monthName];

                if (month && year) {
                    const targetUrl = `<?= ROOT ?>/Parent/PaymentSheet?month=${month}&year=${year}`;
                    window.location.href = targetUrl;
                } else {
                    alert("Invalid month format.");
                }
            });

        const paymentData = <?= json_encode($data['description']) ?>;
        
        let currentMonthIndex = 0;
        const months = Object.keys(paymentData);
        let currentMonth = months[currentMonthIndex];

        const currentMonthLabel = document.getElementById('current-month');
        const paymentList = document.querySelector('.payment-description ul');
        const totalAmountElement = document.querySelector('.payment-description .total');

        function renderMonth(month) {
            let data = paymentData[month] || [];
            console.log(data);
            let total = 0;

            // Update month label
            currentMonthLabel.textContent = month;
            paymentList.innerHTML = '';

            if (!Array.isArray(data)) {
                data = Object.entries(data).map(([service, amount]) => ({
                    service,
                    amount
                }));
            }

            data.forEach(item => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span>Service: ${item.service}</span>
                    <span class="amount">Amount: ${item.amount}rs</span>
                `;
                paymentList.appendChild(li);
                total += parseFloat(item.amount);
            });

            totalAmountElement.textContent = `Total Amount: ${total}Rs`;
        }

        // Initial render
        renderMonth(currentMonth);

        const prevmonth = document.getElementById('prev-month');
        const nextmonth =  document.getElementById('next-month');

        prevmonth.addEventListener('click', () => {
            if (currentMonthIndex < months.length - 1) {
                currentMonthIndex++;
                currentMonth = months[currentMonthIndex];
                renderMonth(currentMonth);
            }
        });

        nextmonth.addEventListener('click', () => {
            if (currentMonthIndex > 0) {
                currentMonthIndex--;
                currentMonth = months[currentMonthIndex];
                renderMonth(currentMonth);
            }
        });

            const datePicker = document.getElementById('datePicker');
            const childPicker = document.getElementById('childPicker');
            const modePicker = document.getElementById('modePicker');

            // Initial fetch with 'null' values (or a default option like 'All')
            fetchPayments(null, null, null);

            datePicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null; // Use null if empty
                const modeValue = modePicker.value || null; // Use null if empty
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchPayments(dateValue, modeValue, childValue);
            });

            childPicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null;
                const modeValue = modePicker.value || null;
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchPayments(dateValue, modeValue, childValue);
            });

            modePicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null;
                const modeValue = modePicker.value || null;
                const childValue = childPicker.value || 'All'; // Default to 'All' if empty
                fetchPayments(dateValue, modeValue, childValue);
            });

            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('upcoming');
            const history = document.getElementById('history');
            const headingres = document.getElementById('heading-res');

            upbtn.addEventListener('click', function() {
                upbtn.style.backgroundColor = '#10639a';
                hibtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'flex';
                history.style.display = 'none';
                headingres.style.marginLeft = '180px';
                headingres.textContent = 'Reervation';
            });

            hibtn.addEventListener('click', function() {
                hibtn.style.backgroundColor = '#10639a';
                upbtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'none';
                history.style.display = 'block';
                headingres.style.marginLeft = '140px';
                headingres.textContent = 'Reervation history';
            });
        });

        var chartData = <?php echo ($data['graph']); ?>;
        const ctx = document.getElementById('paymentsChart').getContext('2d');

        // Destroy existing chart instance if it exists
        if (window.myChart instanceof Chart) {
            window.myChart.destroy();
        }

        // Create the chart
        window.myChart = new Chart(ctx, {
            type: 'bar',
            data: chartData, // Directly use the PHP-injected JSON data
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'nearest',
                    intersect: true
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Payments per Child',
                        font: {
                            size: 20,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const childName = context.dataset.label;
                                const amount = context.parsed.y;
                                return `${childName}: ${amount} Rs`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        title: {
                            display: true,
                            text: 'Month',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Fees',
                            font: {
                                size: 16,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>