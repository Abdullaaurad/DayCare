<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/marks.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Child/Header.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!--Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
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
                            Maid
                        </p>
                    </div>
                </div>
                <ul>
                    <li class="selected first">
                        <a href="<?= ROOT ?>/Teacher/Home">
                            <i class="fas fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Funzone">
                            <i class="fas fa-puzzle-piece"></i> <span>Funzone</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Reports">
                            <i class="fas fa-file-alt"></i> <span>Report</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Students">
                            <i class="fas fa-users"></i> <span>Students</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Inventory">
                            <i class="fas fa-boxes"></i> <span>Inventory</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Leaves">
                            <i class="fas fa-calendar-alt"></i> <span>Leaves</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Message">
                            <i class="fas fa-comments"></i> <span>Messages</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="wrapper-1">
            <div class="navabr">
                <div class="navbar-left">
                    <a href="#">
                        <h2>Hey Sara Britney</h2>
                    </a>
                    <h4>Empowering Excellence in Every Lesson!</h4>
                </div>
                <div class="navbar-right">
                    <div class="alter-icon"></div>
                    <a href="#" class="notification" onclick="toggleNotify()" id="notificationIcon">

                        <i class='bx bxs-bell'></i>
                    </a>
                    <a href="#" class="profile">
                        <img src="<?= IMAGE ?>/profilePic.png" onclick="toggleMenu()" id="profileIcon">
                    </a>
                </div>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?= IMAGE ?>/profilePic.png" alt="">
                            <h3>Sara Bretney</h3>
                        </div>
                        <hr>

                        <a href="<?= ROOT ?>/Teacher/Profile" class="sub-menu-link">
                            <i class='bx bx-edit'></i>
                            <p>View Profile</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <i class='bx bx-help-circle'></i>
                            <p>Help & Support</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <i class='bx bx-log-out'></i>
                            <p>Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
                <div class="notify-menu" id="notify">
                    <div class="notify">
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Leave request approved</h5>
                                <p>05.33 22 Jul</p>
                            </div>

                        </a>
                        <hr>
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Parents meeting</h5>
                                <p>05.33 22 Jul</p>
                            </div>
                        </a>
                        <hr>
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Reports have been updated</h5>
                                <p>05.33 22 Jul</p>
                            </div>
                        </a>
                        <a href="<?= ROOT ?>/Teacher/Notifications" onclick="toggleNotify()" class="all-btn">See all</a>
                    </div>
                </div>

            </div>
            <div class="content">
                <div class="marks-page">
                    <div class="marks-page-header">
                        <i class='bx bxs-report'></i>
                        <h3>Status Reports</h3>

                    </div>
                    <hr>

                    <div class="student-table">
                        <div id="container">
                            <!-- Form -->
                            <form id="dataForm" class="dataform">
                                <div class="profile-img">
                                    <img src="<?= IMAGE ?>/rtr.png" class="face" width="70px">
                                </div>
                                <!-- <label for="name">Name:</label>
                        <input type="text" id="name" required />
                        <label for="regNo">Reg No:</label>
                        <input type="text" id="regNo" required /> -->

                                <p><b>Kavindu Jayarathne</b></p>
                                <p class="index">Index Number: <span class="">2249403</span></p>

                                <div class="marks-section">
                                    <div class="subject mark">
                                        <h4>Maths</h4>
                                        <div class="range-slider mark">
                                            <input type="range" class="slider" id="range" min=0 max=100 value=60>
                                            <div class="value">20</div>
                                        </div>
                                    </div>

                                    <h4 class="fund">Fundamental Skills</h4>
                                    <hr>
                                    <div class="skill mark">
                                        <div class="skill-type cog">
                                            <h4>Cognitive Skills</h4>
                                            <div class="skill-1 mark">
                                                <input type="range" class="slider-1 slider" id="range-1" min=0 max=100 value=60>
                                                <div class="value-1">20</div>
                                            </div>
                                        </div>
                                        <div class="skill-type com">
                                            <h4>Communication Skills</h4>
                                            <div class="skill-2 mark">
                                                <input type="range" class="slider-2 slider" id="range-2" min=0 max=100 value=60>
                                                <div class="value-2">20</div>
                                            </div>
                                        </div>
                                        <div class="skill-type soc">
                                            <h4>Social and Emotional Skills</h4>
                                            <div class="skill-3 mark">
                                                <input type="range" class="slider-3 slider" id="range-3" min=0 max=100 value=60>
                                                <div class="value-3">20</div>
                                            </div>
                                        </div>

                                        <div class="skill-type cre">
                                            <h4>Creative Skills</h4>
                                            <div class="skill-4 mark">
                                                <input type="range" class="slider-4 slider" id="range-4" min=0 max=100 value=60>
                                                <div class="value-4">20</div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit">Submit</button>
                            </form>

                            <!-- Card Container -->
                            <div id="detailsContainer"></div>
                        </div>



                    </div>


                </div>
            </div>
        </div>




        <script src="<?= JS ?>/Teacher/script.js"></script>
        <script src="<?= JS ?>/Teacher/marks.js"></script>
        <script>


        </script>
        <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>


        <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>

</html>