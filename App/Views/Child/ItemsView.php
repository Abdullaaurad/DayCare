<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Child/history.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Main.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/history.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Child/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?=JS?>/Child/Profile.js?v=<?= time() ?>"></script>
    <script src="<?=JS?>/Child/MessageDropdown.js?v=<?= time() ?>"> </script>
</head>
<style>
    .child-history tbody {
        max-height: 400px !important;
    }
</style>

<body>
    <div class="container">
        <!-- mimnized sidebar -->
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
                <li class="selected" style="margin-top: 40px;">
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
                    <a href="<?= ROOT ?>/Child/payment">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
            </ul>
            <hr style="margin-top: 40px;">

        </div>
        <!-- navigation to choose child -->
        <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
            <div>
                <h2 style="margin-top: 25px; margin-left: 15px !important;">Familty Ties</h2>
                <div class="family-section" style="margin-top: 10px; margin-left: 20px;">
                    <ul>
                        <li class="hover-effect first"
                            onclick="removechildsession();">
                            <img src="<?= isset($data['parent']['image']) ? $data['parent']['image'] . '?v=' . time() : '' ?>"
                                style="width: 60px; height:60px; border-radius: 30px;">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 style="margin-top: 25px; margin-left: 15px !important;">Little Explorers</h2>
                    <p style="margin-bottom: 20px; color: white; margin-left: 15px !important;">
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="first
                                <?php if ($child['name'] === $data['selectedchildren']['name']) {
                                    echo "select-child";
                                } ?>
                            "
                                onclick="setChildSession('<?= isset($child['name']) ? $child['name'] : '' ?>','<?= isset($child['Child_Id']) ? $child['Child_Id'] : '' ?>')">
                                <img src="<?= isset($child['image']) ? $child['image'] . '?v=' . time() : ROOT . '/Uploads/default_images/default_profile.jpg' ?>"
                                    alt="Child Profile Image"
                                    style="width: 60px; height: 60px; border-radius: 30px; <?php if ($child['name'] !== $data['selectedchildren']['name']) {
                                                                                                echo "margin-left: -20px !important";
                                                                                            } ?>">
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
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="name">
                    <h1><?= isset($data['parent']['fullname']) ? $data['parent']['fullname'] : 'No name set'; ?></h1>
                    <p style="color: white">Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search"></i>
                    <i class="fa fa-times clear-btn" style="margin-right: 10px;"></i>
                </div>
                <!-- message icon -->
                <div class="bell-con" id="bell-container" style="cursor: pointer;">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px;"></i>
                    <div class="message-dropdown" id="messageDropdown" style="display: none;">
                        <ul>
                            <li>
                                <p>New Message 1 <i href="" class="fas fa-paper-plane"></i> </p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 2 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 3 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 4 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 5 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 6 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="message-numbers">
                    <p> 2</p>
                </div>
                <!-- Prodile btn -->
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                    </button>
                </div>
            </div>
            <div class="saperate">
                <!-- Child history table -->
                <div class="child-history" style="max-width: 1800px !important; height: 560px !important; margin-top: 100px;">
                    <h1>Bought Items</h1>
                    <input type="date" id="datePicker" value="2025-01-10" style="width: 200px">
                    <table style="margin-bottom: 20px;">
                        <thead>
                            <tr>
                                <th style="padding: 10px -5px;">Date</th>
                                <th>Maid</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- First set of items for 10/10/2024 and Sarah -->
                            <tr>
                                <td rowspan="2" style="justify-content:center;">10/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="2" style="justify-content:center;">Sarah</td> <!-- rowspan for Maid -->
                                <td>Lunchbox</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Water Bottle</td>
                                <td>1</td>
                                <td>Missing</td>
                            </tr>

                            <!-- Second set of items for 15/10/2024 and Emily -->
                            <tr>
                                <td rowspan="2" style="text-align:center;">15/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="2" style="text-align:center;">Emily</td> <!-- rowspan for Maid -->
                                <td>Snack Box</td>
                                <td>2</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Book</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>

                            <!-- Third set of items for 18/10/2024 and Rachel -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">18/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Rachel</td> <!-- rowspan for Maid -->
                                <td>Toy Car</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>

                            <!-- Fourth set of items for 20/10/2024 and Anna -->
                            <tr>
                                <td rowspan="2" style="text-align:center;">20/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="2" style="text-align:center;">Anna</td> <!-- rowspan for Maid -->
                                <td>Art Supplies</td>
                                <td>3</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Notebook</td>
                                <td>1</td>
                                <td>Missing</td>
                            </tr>

                            <!-- Fifth set of items for 25/10/2024 and Claire -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">25/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Claire</td> <!-- rowspan for Maid -->
                                <td>Lunchbox</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>

                            <!-- Sixth set of items for 28/10/2024 and Olivia -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">28/10/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Olivia</td> <!-- rowspan for Maid -->
                                <td>Water Bottle</td>
                                <td>1</td>
                                <td>Damaged</td>
                            </tr>

                            <!-- Seventh set of items for 01/11/2024 and Ella -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">01/11/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Ella</td> <!-- rowspan for Maid -->
                                <td>Snack Box</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>

                            <!-- Eighth set of items for 05/11/2024 and Grace -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">05/11/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Grace</td> <!-- rowspan for Maid -->
                                <td>Lunchbox</td>
                                <td>2</td>
                                <td>Missing</td>
                            </tr>

                            <!-- Ninth set of items for 08/11/2024 and Sophie -->
                            <tr>
                                <td rowspan="1" style="text-align:center;">08/11/2024</td> <!-- rowspan for Date -->
                                <td rowspan="1" style="text-align:center;">Sophie</td> <!-- rowspan for Maid -->
                                <td>Book</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>

                            <!-- Tenth set of items for 10/11/2024 and Maya -->
                            <tr>
                                <td rowspan="2" style="text-align:center;">10/11/2024</td> <!-- rowspan for Date -->
                                <td rowspan="2" style="text-align:center;">Maya</td> <!-- rowspan for Maid -->
                                <td>Toy</td>
                                <td>1</td>
                                <td>Returned</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Water Bottle</td>
                                <td>1</td>
                                <td>Lost</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>