<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/PaymentDashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/main.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <title>Receptionist</title>
</head>

<body>
    <div class="main">
        <div class="side_bar">
            <div class="userblock">
                <div class="photo">
                    <img alt="User profile picture" height="50" src="<?= $data['Profile']->Image ?>" width="50" />
                </div>
                <div class="username">
                    <h3>
                        <?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?>
                    </h3>
                    <p>
                        Receptionist
                    </p>
                </div>
            </div>
            <ul>
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Receptionist/Home">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Attendance">
                        <i class="fas fa-history"></i> <span>Attendance</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="<?= ROOT ?>/Receptionist/Payment">
                        <i class="fa fa-user-shield"></i> <span>Payment</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/visitor">
                        <i class="fas fa-calendar-check"></i> <span>Visitor</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Inventory">
                        <i class="fas fa-boxes"></i> <span>Inventory</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Restock">
                        <i class="fas fa-truck-loading"></i> <span>Restock</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Leave">
                        <i class="fas fa-utensils"></i> <span>Leave</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Leave">
                        <i class="fas fa-dollar-sign"></i> <span>Salary</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
                <div class="header-title">
                    <h2 style="font-size: 24px;">
                        Hey
                    </h2>
                    <p>
                        Start your day happy with little ones !
                    </p>
                </div>
                <div class="bell-con" id="bell-container" style="cursor: pointer;">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px; color: white;"></i>
                    <?php if (!empty($data['Notification'])): ?>
                        <?php if ($data['Notification']['Seen'] != 0): ?>
                            <div class="message-numbers" id="message-number">
                                <p><?= $data['Notification']['Seen'] != 0 ? $data['Notification']['Seen'] : '' ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="message-dropdown" id="messageDropdown" style="display: none;">
                            <ul>
                                <?php foreach ($data['Notification']['data'] as $row): ?>
                                    <li data-id="<?= $row->NotificationID ?>">
                                        <p><?= htmlspecialchars($row->Description) ?></p>
                                        <?php if ($row->Location != NULL): ?>
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
            <div class="detailed_content">
                <div class="make_background">

                    <div class="payment_table">
                        <div class="table_header">
                            <div class="topic"><span>Payment Details</span></div>

                            <a href="<?= ROOT ?>/Receptionist/Payform"><button class="paymentbutton">
                                    Make &nbsp;Payment
                                </button></a>
                        </div>
                        <hr>
                        <div class="table_filters">
                            <div class="search_line">
                                <form class="field_input2" method="POST" action="<?= ROOT ?>/Receptionist/Payment/search">
                                    <i class="fas fa-search">
                                    </i>
                                    <input placeholder="Search Index......" type="text" name="ChildID" />
                                </form>
                            </div>
                            <form class="date_entry" action="<?= ROOT ?>/Receptionist/Payment/search" method="POST">
                                <input type="date" name="Date" onchange="this.form.submit()" />
                            </form>

                        </div>

                        <div class="table_topics">
                            <div class="head reg_id">
                                <i class="fas fa-id-card" title="Registration ID"></i>
                                <span>Registration No</span>
                            </div>
                            <div class="head name">
                                <i class="fas fa-user" title="Child Name"></i>
                                <span>Name</span>
                            </div>
                            <div class="head transaction_id">
                                <i class="fas fa-receipt" title="Transaction ID"></i>
                                <span>Transaction ID</span>
                            </div>
                            <div class="head amount">
                                <i class="fas fa-money-bill"></i>
                                <span>Amount</span>
                            </div>
                            <div class="head date">
                                <i class="fas fa-calendar-alt" title="Date"></i>
                                <span>Date</span>
                            </div>
                            <div class="head action">
                                <i class="fas fa-user" title="Actions"></i>
                                <span>Action</span>
                            </div>
                        </div>
                        <div class="table_columns">
                            <?php if (!empty($payments)): ?>
                                <?php foreach ($payments as $payment): ?>
                                    <div class="table_column">
                                        <div class="colum reg_id">
                                            <span>SROOO<?= htmlspecialchars($payment->ChildID) ?></span>
                                        </div>
                                        <div class="colum name">
                                            <img alt="card icon" height="30px" src="<?= $payment->Image ?>" width="30px" />
                                            <span><?= htmlspecialchars($payment->First_Name) ?></span>
                                        </div>
                                        <div class="colum transaction_id">
                                            <span>DC-TXN-<?= htmlspecialchars($payment->PaymentID) ?></span>
                                        </div>
                                        <div class="colum amount">
                                            <span><?= htmlspecialchars($payment->Amount) ?></span>
                                        </div>
                                        <div class="colum date">
                                            <span><?= htmlspecialchars($payment->DateTime) ?></span>
                                        </div>
                                        <form class="colum action" method="POST" action="<?= ROOT ?>/Receptionist/Payment/delpay">
                                            <input type="hidden" name="payment_id" value="<?= htmlspecialchars($payment->PaymentID) ?>">
                                            <button><i class="fas fa-trash"></i>Delete</button>
                                        </form>
                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" />
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= $data['Profile']->Image; ?>" width="100" class="profile" />
            <h2><?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?></h2>
            <p><?= $data['Profile']->EmployeeID ?> </p>
            <button class="profile-button"
                onclick="window.location.href ='<?= ROOT ?>/Receptionist/Profile'">Profile
            </button>
            <button class="logout-button" onclick="logoutUser()">LogOut</button>
        </div>

    </div>
    </div>
    <script src="<?= JS ?>/Receptionist/test.js"></script>
    <script>
        function logoutUser() {
            fetch("<?= ROOT ?>/Receptionist/Home/Logout", {
                    method: "POST",
                    credentials: "same-origin"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "<?= ROOT ?>/Main/Login";
                    } else {
                        alert("Logout failed. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>