<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/visitorform.css?v=<?= time() ?>">
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
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Receptionist/Payment">
                        <i class="fa fa-user-shield"></i> <span>Payment</span>
                    </a>
                </li>
                <li class="selected">
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
                    <div class="detail_section">
                        <div class="combine">
                            <div class="card_topic">
                                <a href="<?= ROOT ?>/Receptionist/Visitortable"><span class="head_topic">Visitor Details</span></a>
                            </div>
                            <hr>
                        </div>

                        <div class="rules_regulations">
                            <div class="topic">
                                <span class="rules_topic">Rules And Regulations</span>
                            </div>
                            <div class="description">
                                <ul>
                                    <li>All visitors must present valid ID proof at the reception</li>
                                    <li>Complete the visitor entry log with accurate details.</li>
                                    <li>Visits to classrooms or children require prior approval.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="latest_updates">
                            <div class="last_marked">
                                <span class="last_marked_topic">Latest Updates</span>
                                <?php if (!empty($visitors)): ?>
                                    <?php foreach ($visitors as $visitor): ?>
                                        <div class="lastmarkedchilds">
                                            <div class="name_position_time">
                                                <span class="lastmarkedname"><?= htmlspecialchars($visitor->FirstName) ?></span>
                                                <span class="lastmarkedname"><?= htmlspecialchars($visitor->Role) ?></span>
                                                <span class="lastmarkedtime"><?= htmlspecialchars($visitor->Start_Time) ?></span>
                                            </div>
                                        </div>
                                        <hr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <form class="form_section" action="<?= ROOT ?>/Receptionist/Visitor/addvisitor" method="post">
                        <div class="form_topic">
                            <span>Welcome Desk</span>
                        </div>
                        <?php if (!empty($errors)): ?>

                            <span class="lastmarkedname"><?= htmlspecialchars($errors) ?></span>

                        <?php endif; ?>
                        <div class="form_input_section">
                            <div class="section_main">
                                <div class="section">
                                    <label for="">First Name</label>
                                    <input type="text" name="FirstName" placeholder="Enter First Name">
                                </div>
                                <div class="section">
                                    <label for="">Last Name</label>
                                    <input type="text" name="LastName" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Phone No</label>
                                    <input type="text" name="Phone_Number" placeholder="Enter Phone No">
                                </div>
                                <div class="section">
                                    <label for="">Email</label>
                                    <input type="text" name="e_mail" placeholder="Enter E-mail">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Position</label>
                                    <input type="text" name="Role" placeholder="Enter Position">
                                </div>
                                <div class="section">
                                    <label for="">National_Id</label>
                                    <input type="text" name="NID" placeholder="Enter National Id">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section purpose">
                                    <label for="">Purpose</label>
                                    <input type="text" name="Purpose" placeholder="Enter the Purpose">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Time In</label>
                                    <input type="time" name="Start_Time">
                                </div>
                                <div class="section">
                                    <label for="">Time-Out</label>
                                    <input type="time" name="End_Time">
                                </div>
                            </div>
                        </div>
                        <div class="form_button"><button type="submit">Submit Details</button></div>
                    </form>
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

    <script>
        function logoutUser() {
            fetch("<?= ROOT ?>/Receptionist/Visitor/Logout", {
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

    <script src='./test.js' defer></script>
</body>

</html>