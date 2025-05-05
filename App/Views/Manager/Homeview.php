<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="icon" href="<?= IMAGE ?>/KIDDOVILLE_LOGO.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Leaverequest.css?<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo_stuf" style="display: flex;margin-top:6%">
                <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
                <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
            </div>
            <ul style=" margin-top: 10%;">
                <li class="selected">
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

        <div class="main-content">
            <div class="header">
                <div class="name">
                    <h1>Hey Namal</h1>
                    <p style="color: white;">Let’s do some productive activities today</p>
                </div>
                <div class="profile">
                    <button class="profilebtn" onclick="handleClick()">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                    </button>
                </div>
                <div class="profile-card" id="profileCard">
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

            <div class="stats">
                <div class="stat">
                    <h3 style="color: #233E8D;">Total Attendance</h3>
                    <h2 style="margin-bottom: 3px;color: #233E8D;"><?= $data['Totalchild'] ?></h2>
                    <p style="color: #233E8D;">Out of 120 Children today attended to Daycare</p>
                </div>
                <div class="stat">
                    <h3 style="color: #233E8D;">Total Employees Attendance</h3>
                    <h2 style="margin-bottom: 3px;color: #233E8D;"><?= $data['Totaluser'] ?></h2>
                    <p style="color: #233E8D;">Out of 27 employees today attended to Daycare</p>
                </div>
                <div class="stat">
                    <h3 style="color: #233E8D;">Total Enrollment</h3>
                    <h2 style="margin-bottom: 3px;color: #233E8D;"><?= $data['Totalenroll'] ?></h2>
                    <p style="color: #233E8D;"><?= date('F Y') ?></p>
                </div>
            </div>

            <div class="two-divs">
                <div class="graph">
                    <h2 style="color: #233E8D;">Income of the month</h2>
                    <hr>
                    <div class="description_gr">
                        <p style="color: #233E8D;font-weight:bold;color:red;font-size:18px;">Pending :LKR.56000</p>
                        <p style="color: #233E8D;font-weight:bold;color:green;font-size:18px;">Paid : LKR.123000</p>
                        <p style="color: #233E8D;font-weight:bold;font-size:18px;">Total:LKR. 156000</p>
                    </div>
                    <canvas id="inventoryChart" width="600" height="157"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script src="inventoryGraph.js"></script>
                </div>
                <div class="emergency">
                    <h2 style="color: #233E8D; margin-left:5%; margin-top:5%;">Emergency Alerts</h2>
                    <hr>
                    <?php if (!empty($data['emergency'])): ?> <!-- Check if data exists -->
                        <?php foreach ($data['emergency'] as $emergency): ?> <!-- Loop through data -->
                            <div class="alert-box">
                                <img src="<?= IMAGE ?>/profilePic.png" class="resize" style="width: 50px; border-radius: 50%;margin-left:5%;">
                                <p class="description" style="margin-left:30%; margin-top:-18%;">
                                    <strong><?= htmlspecialchars($emergency->Description); ?></strong><br>
                                </p>
                                <p style="margin-left:30%;"><?= htmlspecialchars($emergency->Name) ?></p>
                                <p style="margin-left: 30%;"><?= htmlspecialchars($emergency->Time) ?></p>
                                <a href="<?= ROOT ?>/Manager/Home/emergency_delete/<?= $emergency->EmergencyID ?>"><button class="edel">Delete</button></a>
                            </div>
                            <br>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No Emergency alert found.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="reservation">
                <h2 style="color: #233E8D; margin-left:5%;">Reservations</h2>
                <hr>
                <div class="schedule-table-header">
                    <div class="child-id"><span>Parent</span></div>
                    <div class="reservation-date"><span>Date</span></div>
                    <div class="start-time"><span>Start Time</span></div>
                    <div class="end-time"><span>End Time</span></div>
                    <div class="status"><span>Status</span></div>
                    <div class="notes"><span>Notes</span></div>
                    <div class="is_24_Hour">Is 24_Hours</div>
                </div>

                <div id="scheduleData">
                    <?php if (!empty($data['reservations'])): ?>
                        <?php foreach ($data['reservations'] as $reservation): ?>
                            <div class="schedule-table-row">
                                <div class="child-id"><span><?= htmlspecialchars($reservation->ParentName); ?></span></div>
                                <div class="reservation-date"><span><?= htmlspecialchars($reservation->Date); ?></span></div>
                                <div class="start-time"><span><?= htmlspecialchars($reservation->Start_Time); ?></span></div>
                                <div class="end-time"><span><?= htmlspecialchars($reservation->End_Time); ?></span></div>
                                <div class="status">
                                    <span data-status="<?= strtolower(htmlspecialchars($reservation->Status)) ?>">
                                        <?= htmlspecialchars($reservation->Status) ?>
                                    </span>
                                </div>

                                <div class="notes">
                                    <?php if (!empty($reservation->Notes)): ?>
                                        <span><?= htmlspecialchars($reservation->Notes) ?></span>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </div>
                                <div class="is_24_Hour"><span><?= htmlspecialchars($reservation->Is_24_Hour); ?></span></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No visitors found.</p>
                    <?php endif; ?>
                    <div id="no-results" style="display: none; color: red; text-align: center; margin-top: 11.5%;">
                        <h1>Date Not Found</h1>
                    </div>
                </div>
            </div>



            <div class="today_visitors" style="padding-bottom: 2%;">
                <div class="today_visitors_header">
                    <span style="white-space: nowrap;">
                        <i class="fas fa-door-open" style="margin-right: 5%;"></i>Visitors Summary
                    </span>
                    <input type="date" class="visitorsdate" id="search-date" oninput="filterByDate();">
                    <!-- <input type="text" class="visitorsrole" id="search-role" oninput="filterByRole();" placeholder="Search by Role"> -->

                </div>

                <div class="visitor-table-topics">
                    <div class="visitorname"><span>NAME</span></div>
                    <div class="visitorposition"><span>Role</span></div>
                    <div class="visitorpurpose"><span>PURPOSE</span></div>

                    <div class="visitordate"><span>DATE</span></div>
                    <div class="visitorstarttime"><span>Start Time</span></div>
                    <div class="visitorendtime"><span>End Time</span></div>
                </div>

                <div id="visitorData">
                    <?php if (!empty($data['visitorsummary'])): ?>
                        <?php foreach ($data['visitorsummary'] as $visitor): ?>
                            <div class="detailed-lines">
                                <div class="visitorname"><span><?= htmlspecialchars($visitor->FirstName . ' ' . $visitor->LastName); ?></span></div>

                                <div class="visitorposition" style="margin-left: 0.5%;">
                                    <?php if(!empty($visitor->Role)):?>
                                        <span><?= htmlspecialchars($visitor->Role); ?></span>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?> 
                                </div>
                                <div class="visitorpurpose" style="margin-left: 0.5%;"><span><?= htmlspecialchars($visitor->Purpose); ?></span></div>
                                <div class="visitordate" style="margin-left: 0.5%;">
                                    <span><?= htmlspecialchars(date('Y-m-d', strtotime($visitor->Date))); ?></span>
                                </div>
                                <div class="visitorstarttime" style="margin-left: 0.5%;"><span><?= htmlspecialchars($visitor->Start_Time); ?></span></div>
                                <div class="visitorendtime" style="margin-left: 0.5%;"><span><?= htmlspecialchars($visitor->End_Time); ?></span></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No visitors found.</p>
                    <?php endif; ?>
                    <div id="no-results" style="display: none; color: red; text-align: center; margin-top: 11.5%;">
                        <h1>Date Not Found</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
        // Get the canvas element
        const ctx = document.getElementById('inventoryChart').getContext('2d');

        // const productLabels = ['Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const productLabels = ['1st', '2nd', '3rd', '4th'];
        const inventoryData = [56, 32, 42, 65]; // Inventory levels for each product

        // Create the bar chart
        const inventoryChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: productLabels,
                datasets: [{
                    label: 'Income in LKR',
                    data: inventoryData, // Inventory data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1 // Border width for bars
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // Show the legend
                    },
                    tooltip: {
                        enabled: true, // Show tooltips on hover
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Start y-axis at zero
                        title: {
                            display: true,
                            text: 'Income in LKR X 1000' // Y-axis title
                        },
                        ticks: {
                            stepSize: 10
                        },
                        max: 100
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Weekly Income'
                        }
                    }
                }
            }
        });


        const filterByDate = () => {
            const searchDate = document.getElementById('search-date').value; // Get input date
            const visitors = document.querySelectorAll('.detailed-lines'); // Select all visitor records
            const noResultsMessage = document.getElementById('no-results');

            let found = false; // Track if any match is found
            noResultsMessage.style.display = "none"; // Hide "Date Not Found" initially

            for (let i = 0; i < visitors.length; i++) {
                let visitorDateElement = visitors[i].querySelector('.visitordate span'); // Get the date span inside each visitor record

                if (visitorDateElement) {
                    let visitorDate = visitorDateElement.textContent.trim(); // Get the text content (date)

                    // Compare the selected date with the visitor's date
                    if (searchDate === visitorDate) {
                        visitors[i].style.display = ""; // Show matching record
                        found = true;
                    } else {
                        visitors[i].style.display = "none"; // Hide non-matching records
                    }
                }
            }

            // If no match is found, show the "Date Not Found" message
            if (!found && searchDate !== "") {
                noResultsMessage.style.display = "block";
            }
        };

        // const filterByRole = () => {
        //     const searchRole = document.getElementById('search-role').value.toLowerCase().trim();
        //     const visitors = document.querySelectorAll('.detailed-lines');
        //     const noResultsMessage = document.getElementById('no-results');

        //     let found = false;
        //     noResultsMessage.style.display = "none";

        //     for (let i = 0; i < visitors.length; i++) {
        //         let visitorRoleElement = visitors[i].querySelector('.visitorposition span');

        //         if (visitorRoleElement) {
        //             let visitorRole = visitorRoleElement.textContent.toLowerCase().trim();

        //             if (visitorRole.includes(searchRole)) {
        //                 visitors[i].style.display = "";
        //                 found = true;
        //             } else {
        //                 visitors[i].style.display = "none";
        //             }
        //         }
        //     }

        //     if (!found && searchRole !== "") {
        //         noResultsMessage.style.display = "block";
        //     }
        // };
    </script>
</body>

</html>