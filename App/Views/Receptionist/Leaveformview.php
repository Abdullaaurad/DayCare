<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/PaymentDashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Maid/studenprofile.css?v=<?= time() ?>">
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
    <title>Receptionist Leaves</title>
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
                <li class="selected">
                    <a href="<?= ROOT ?>/Receptionist/Leave">
                        <i class="fas fa-utensils"></i> <span>Leave</span>
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
                    <div class="second-content">
                        

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>