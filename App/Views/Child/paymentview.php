<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/child/payment.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/child/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Sidebar2.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/stats.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/MessageDropdown.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
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
                <li class="selected" style="margin-top: 40px;">
                    <a href="<?= ROOT ?>/Child/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">

        </div>
        <!-- navigation -->
        <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
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
                                onclick="setChildSession('<?= isset($child['Id']) ? $child['Id'] : '' ?>')">
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
            <!-- Header -->
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"></i>
                <div class="name">
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                </div>
                <!-- notoifcation icona and dropdown -->
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
                                <h2 style="color: red;"> No Expenses </h2>
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
                            <h3 style="margin-top: -12px;">
                                <img src="<?= IMAGE ?>/mountain.svg" alt="Welcome" style="width: 40px; margin-right: 10px; margin-bottom: -15px;">
                                Welcome aboard!
                            </h3>
                            <p style="text-align: center;">Enjoy the journey — your first invoice will show up here soon!</p>
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
                        </div>
                        <table class="payments" style="margin-top: -10px;">
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
                        <button class="pay"> Make payment </button>
                    </div>
                    <div id="upcoming" style="display: flex; flex-direction: row; align-items: flex-start;">
                        <canvas id="paymentChart" width="500" height="200" style="max-width: 600px; max-height: 400px; margin-top:-10px;"></canvas>
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
                                            Amount: 500Rs
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Meal Plan
                                        </span>
                                        <span class="amount">
                                            Amount: 200Rs
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Sports Activity
                                        </span>
                                        <span class="amount">
                                            Amount: 150Rs
                                        </span>
                                    </li>
                                    <li>
                                        <span>
                                            Service: Art Class
                                        </span>
                                        <span class="amount">
                                            Amount: 100Rs
                                        </span>
                                    </li>
                                </ul>
                                <div class="total">
                                    Total Amount: 950Rs
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
        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?php echo htmlspecialchars($data['selectedchildren']['image']); ?>" width="100"
                class="profile" />
            <h2><?= $data['selectedchildren']['fullname'] ?></h2>
            <p>SRD<?= $data['selectedchildren']['id'] ?></p>
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Parent/ParentProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Child/ParentProfile'">
                Parent profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Parent/GuardianProfile'">
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

        function removechildsession() {
            fetch('<?= ROOT ?>/Child/Payment/removechildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child id removed from session.");
                        window.location.href = '<?= ROOT ?>/Parent/Payment';
                    } else {
                        console.error("Failed to remove child id from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function setChildSession(ChildID) {
            console.log(ChildID);
            fetch('<?= ROOT ?>/Child/Payment/setchildsession', {
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
                        window.location.href = '<?= ROOT ?>/Child/Payment';
                    } else {
                        console.error("Failed to set child id from session.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function fetchPayments(date = null, mode = null) {
            fetch('<?= ROOT ?>/Child/Payment/store_history', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        date: date,
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
                    const targetUrl = `<?= ROOT ?>/Child/PaymentSheet?month=${month}&year=${year}`;
                    window.location.href = targetUrl;
                } else {
                    alert("Invalid month format.");
                }
            });

            const datePicker = document.getElementById('datePicker');
            const modePicker = document.getElementById('modePicker');

            fetchPayments(null, null);

            datePicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null; // Use null if empty
                const modeValue = modePicker.value || null; // Use null if empty
                fetchPayments(dateValue, modeValue);
            });

            modePicker.addEventListener('change', function() {
                const dateValue = datePicker.value || null;
                const modeValue = modePicker.value || null;
                fetchPayments(dateValue, modeValue);
            });

            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('upcoming');
            const history = document.getElementById('history');

            upbtn.addEventListener('click', function() {
                upbtn.style.backgroundColor = '#10639a';
                hibtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'flex';
                history.style.display = 'none';
            });

            hibtn.addEventListener('click', function() {
                hibtn.style.backgroundColor = '#10639a';
                upbtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'none';
                history.style.display = 'block';
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById("pay-form");

            if(form){
                form.addEventListener("submit", function (e) {
                    e.preventDefault();

                    const total = document.getElementById("total-input").value;
                    const purpose = "Overdue Pyament";

                    fetch("<?=ROOT?>/Child/Payment/AmountPurpose", {
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

            const ctx = document.getElementById('paymentChart').getContext('2d');
            var chartData = <?php echo ($data['graph']); ?>;

            // Calculate suggested max (20% higher than highest value)
            const maxValue = Math.max(...chartData.datasets[0].data);
            const suggestedMax = Math.ceil(maxValue * 1.2);

            if (window.inventoryChart instanceof Chart) {
                window.inventoryChart.destroy();
            }

            window.inventoryChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 30
                        }
                    },
                    plugins: {
                        tooltip: {
                            enabled: true,
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function (context) {
                                    return 'Amount: $' + context.formattedValue;
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Monthly Fees for <?= $data['selectedchildren']['name'] ?>',
                            font: {
                                size: 18,
                                weight: 'bold'
                            }
                        },
                        legend: {
                            display: true,
                            labels: {
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    elements: {
                        point: {
                            radius: 5,
                            hitRadius: 10,
                            hoverRadius: 7
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Months',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                autoSkip: false, // show all 4 months clearly
                                maxRotation: 0,
                                minRotation: 0
                            }
                        },
                        y: {
                            beginAtZero: true,
                            suggestedMax: suggestedMax,
                            title: {
                                display: true,
                                text: 'Fees',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                callback: function (value) {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            });
        });

        // const data = {
        //     labels: ['October', 'November', 'December'], // Months
        //     datasets: [{
        //             label: 'Child 1',
        //             data: [400, 500, 450], // Payments for Child 1
        //             backgroundColor: 'rgba(255, 99, 132, 0.6)',
        //             borderColor: 'rgba(255, 99, 132, 1)',
        //             borderWidth: 1
        //         },
        //         {
        //             label: 'Child 2',
        //             data: [300, 400, 350], // Payments for Child 2
        //             backgroundColor: 'rgba(54, 162, 235, 0.6)',
        //             borderColor: 'rgba(54, 162, 235, 1)',
        //             borderWidth: 1
        //         },
        //         {
        //             label: 'Child 3',
        //             data: [200, 250, 300], // Payments for Child 3
        //             backgroundColor: 'rgba(255, 206, 86, 0.6)',
        //             borderColor: 'rgba(255, 206, 86, 1)',
        //             borderWidth: 1
        //         },
        //         {
        //             label: 'Child 4',
        //             data: [100, 150, 200], // Payments for Child 4
        //             backgroundColor: 'rgba(75, 192, 192, 0.6)',
        //             borderColor: 'rgba(75, 192, 192, 1)',
        //             borderWidth: 1
        //         },
        //         {
        //             label: 'Child 5',
        //             data: [50, 100, 150], // Payments for Child 5
        //             backgroundColor: 'rgba(153, 102, 255, 0.6)',
        //             borderColor: 'rgba(153, 102, 255, 1)',
        //             borderWidth: 1
        //         }
        //     ]
        // };

        // // Configuration for the chart
        // const config = {
        //     type: 'bar', // Bar chart
        //     data: data,
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 display: true,
        //                 position: 'top',
        //                 font: {
        //                     size: 20, // Font size in pixels
        //                     weight: 'bold', // Font weight (e.g., 'bold', 'normal', 'lighter')
        //                 },
        //             },
        //             title: {
        //                 display: true,
        //                 text: 'Payments per Child',
        //                 font: {
        //                     size: 20, // Font size in pixels
        //                     weight: 'bold', // Font weight (e.g., 'bold', 'normal', 'lighter')
        //                 },
        //             }
        //         },
        //         scales: {
        //             x: {
        //                 title: {
        //                     display: true,
        //                     text: 'Month',
        //                     font: {
        //                         size: 20, // Font size in pixels
        //                         weight: 'bold', // Font weight (e.g., 'bold', 'normal', 'lighter')
        //                     },
        //                 },
        //                 stacked: false
        //             },
        //             y: {
        //                 beginAtZero: true,
        //                 title: {
        //                     display: true,
        //                     text: 'Payments (RS)',
        //                     font: {
        //                         size: 20, // Font size in pixels
        //                         weight: 'bold', // Font weight (e.g., 'bold', 'normal', 'lighter')
        //                     },
        //                 }
        //             }
        //         }
        //     }
        // };

        // Render the chart
        // const ctx = document.getElementById('paymentsChart').getContext('2d');
        // new Chart(ctx, config);

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
                    <span class="amount">Amount: ${item.amount} Rs</span>
                `;
                paymentList.appendChild(li);
                total += parseFloat(item.amount);
            });

            totalAmountElement.textContent = `Total Amount: ${total} Rs`;
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

    </script>
</body>

</html>