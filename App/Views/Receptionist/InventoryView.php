<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="<?= CSS ?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/main.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="height: 150vh;">
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
            <li class="selected">
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
        </ul>
    </div>
    <div class="main-content">
        <div class="header" style="margin-top:52px; height: 80px; margin-left: -10px; width: 102.45%;">
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
        <!-- Stats -->
        <div class="stats-container" style="margin-top: 2%;">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Total'] ?></h3>
                    <p>Total Items in Stock</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Issued'] ?></h3>
                    <p>Items Issued This Month</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Low'] ?></h3>
                    <p>Items Low in Stock</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h2>Quick Actions</h2>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="<?= ROOT ?>/Receptionist/Inventory" class="btn btn-primary"><i class="fas fa-plus"></i> Add New
                        Item</a>
                    <a href="<?= ROOT ?>/Receptionist/Restock" class="btn btn-secondary"><i class="fas fa-truck-loading"></i> Manage
                        Restocking</a>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="card">
            <div class="card-header">
                <h2>Recent Activities</h2>
                <a href="audit-log.html" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>User</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['Recent'] as $row): ?>
                                <tr>
                                    <td><?= $row->Activity ?> </td>
                                    <td><?= $row->Name ?>(<?= $row->Role ?>)</td>
                                    <td><?= $row->ItemName ?> </td>
                                    <td><?= $row->Quantity ?> </td>
                                    <td><?= $row->DateTime ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="card">
            <div class="card-header">
                <h2>Low Stock Items</h2>
                <a href="manager-restocking.html" class="btn btn-sm btn-primary">Manage Restocking</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Current Stock</th>
                                <th>Minimum Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['Stock'])): ?>
                                <?php foreach ($data['Stock'] as $row): ?>
                                    <tr>
                                        <td><?= $row->Item ?> </td>
                                        <td><?= $row->Category ?></td>
                                        <td><?= $row->Quantity ?> </td>
                                        <td><?= $row->MinQuantity ?> </td>
                                        <td><span class="status status-low">Low Stock</span></td>
                                        <td><button class="btn btn-sm btn-primary">Restock</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div>
                        <?php if (empty($data['Stock'])): ?>
                            <div class="no-stack">
                                <p class="no-stock-message">All items are sufficiently stocked. No low inventory at the moment.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000; width: 21rem;">
        <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" />
        <img alt="Profile picture of Thilina Perera" height="100" src="<?= $data['Profile']->Image; ?>" width="100" class="profile" />
        <h2><?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?></h2>
        <p><?= $data['Profile']->EmployeeID ?> </p>
        <button class="profile-button"
            onclick="window.location.href ='<?= ROOT ?>/Receptionist/Profile'">Profile
        </button>
        <button class="logout-button" onclick="logoutUser()">LogOut</button>
    </div>


    <script>
        function logoutUser() {
            fetch("<?= ROOT ?>/Receptionist/Inventory/Logout", {
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