<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/variables.css?v=<?= time() ?>">
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
            <!-- ********* FUN ZONE CONTENT ADDING **********-->
            <div class="funzone-popup-container" id="funzone-popup-container">
                <form action="#" method="post">
                    <div class="funzone-content">
                        <div class="funzone-header">
                            <i class="fa-solid fa-upload"></i>
                            <h3>Upload Resources</h3>
                            <img src="<?= ROOT ?>/assets/images/logo.png">
                        </div>


                        <div class="drag-and-drop">
                            <div class="foramts">
                                <i class="fa-regular fa-file"></i>
                                <i class="fa-regular fa-image"></i>
                                <i class="fa-regular fa-file-lines"></i>

                            </div>
                            <h3>Drag and drop files to upload or </h3>
                            <button class="browse">Browse</button>
                            <p>Supported Files: JPG, PNG, PDF, DOCX</p>
                        </div>
                        <div class="funzone-footer">
                            <h3>Import from URL</h3>
                            <input type="text" name="url" placeholder="Add file URL" />
                            <p>You will be notified once the import is successful</p>
                        </div>
                        <div class="funzone-buttons">
                            <button class="cancel" onclick="closeFunZone()">Cancel</button>
                            <button class="done" id="close-funzone" type="submit">Done</button>
                        </div>
                </form>
            </div>


        </div>

        <!-- ********* REQUEST LEAVES **********-->

        <div class="request-leave-container" id="request-leave-container">
            <div class="leave-content">
                <h3>Leave Request</h3>
                <form action="#">
                    <div class="leave-body">
                        <div class="body-left">
                            <label for="leave-type">Leave Type<span>*</span></label>
                            <select name="leave-type" required>
                                <option value="Annual Leave">Annual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Compassionate">Compassionate</option>
                            </select>
                            <label for="fromdate">From</label>
                            <input type="date" name="fromdate" id="fromdate" required>
                            <label for="todate">To</label>
                            <input type="date" name="todate" id="todate" required>
                            <label for="about">About</label>
                            <textarea name="about" id="about" placeholder="Inlcude comments for your approver" rows="5" required></textarea>

                        </div>
                        <div class="body-right">
                            <img src="<?= ROOT ?>/assets/images/leave.png">
                            <div class="leave-info">
                                <h4>Your Request Includes</h4>
                                <hr>
                                <b>
                                    <p class="para-1"><span>10 </span>days of annual leave</p>
                                </b>
                                <p class="para-2"><span>26</span> days remaining</p>
                            </div>
                        </div>
                    </div>
                    <div class="leave-footer">
                        <button class="request" type="submit">Request Now</button>
                        <button class="cancel" id="close-request" onclick="closeRequest()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ********* DAILY TASK SCHEDULE **********-->

        <div class="kiddo-schedule-container" id="kiddo-schedule-container">
            <div class="kiddo-content">
                <div class="kiddo-header">
                    <i class='bx bx-alarm'></i>
                    <div class="header-cont">
                        <h2>What Did We Learn?</h2>

                    </div>
                    <img src="<?= ROOT ?>/assets/images/let.png">
                </div>

                <form action="<?= ROOT ?>/Teacher/KiddoSchedule/addTask" method="post">
                    <div class="kiddo-body">

                        <label htmlfor="name">Title</label>
                        <input type="text" name="Title" required>

                        <label htmlfor="name">Title</label>
                        <textarea rows="4" required name="Description"></textarea>

                    </div>

                    <div class="kiddo-footer">
                        <button class="done" type="submit">Done</button>
                        <button class="cancel" id="close-kiddo" onclick="closekiddo()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>



        <div class="edit-task-popup">
            <div class="task-edit-container" id="task-edit-container">
                <div class="task-content">
                    <div class="task-edit-header">
                        <i class='bx bx-alarm'></i>
                        <div class="task-edit-header-cont">
                            <h2>What Did We Learn?</h2>

                        </div>
                        <img src="<?= ROOT ?>/assets/images/let.png">
                    </div>

                    <form action="<?= ROOT ?>/Teacher/KiddoSchedule/updateTask" method="post">
                        <div class="task-edit-body">
                            <input type="hidden" id="task-id" name="id">
                            <label htmlfor="name">Title</label>
                            <input type="text" name="Title" id="task-title" required>

                            <label htmlfor="name">Description</label>
                            <textarea rows="4" required name="Description" id="task-description"></textarea>

                        </div>

                        <div class="task-edit-footer">
                            <button class="done" type="submit">Done</button>
                            <button class="cancel" id="close-kiddo" onclick="closeTaskEdit()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>







        <div class="navabr">
            <div class="navbar-left">
                <a href="#">
                    <h2>Hey Sara Britney</h2>
                </a>
                <h4>Empowering Excellence in Every Lesson!</h4>
            </div>
            <div class="navbar-right">
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search search-btn"></i>

                </div>

                <div class="alter-icon"></div>
                <a href="#" class="notification" onclick="toggleNotify()" id="notificationIcon">

                    <i class='bx bxs-bell'></i>
                </a>
                <a href="#" class="profile">
                    <img src="<?= ROOT ?>/assets/images/profilePic.png" onclick="toggleMenu()" id="profileIcon">
                </a>
            </div>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="<?= ROOT ?>/assets/images/profilePic.png" alt="">
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

            <div class="card-row">
                <div class="card" id="open-kiddo" onclick="showKiddo()">
                    <div class="card-header">
                        <i class='bx bx-task'></i>
                        <h3>Kiddo Schedule</h3>
                    </div>
                    <div class="card-bottom">
                        <h2 class="remark">Today's Focus</h2>
                        <p>Ativities for the day</p>
                    </div>

                </div>
                <div class="card" id="open-funzone" onclick="showFunzone()">
                    <div class="card-header">
                        <i class="fa-solid fa-mountain-sun mount"></i>
                        <h3>Fun Zone</h3>
                    </div>
                    <div class="card-bottom">
                        <h2 class="remark">274 Views</h2>
                        <p>47 Downlaods & 4 Uploads</p>
                    </div>

                </div>
                <div class="card" id="open-request" onclick="openRequest()">
                    <div class="card-header">
                        <i class='bx bxs-calendar'></i>
                        <h3>Request a Leave</h3>
                    </div>
                    <div class="card-bottom">
                        <h2 class="remark">3 Leaves Left</h2>
                        <p>30 Annual leaves remaining</p>
                    </div>

                </div>
            </div>

            <!-- ACTIVITY SCHEDULE-->

            <div class="content-2">

                <div class="activity-list" id="act-list">
                    <div class="activity-header">
                        <div class="header-content">
                            <h3>Activity Schedule</h3>

                            <div class="filters">
                                <div class="date-filter">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date">
                                </div>
                                <div class="age-filter">
                                    <label for="age">Age Group</label>
                                    <select name="agegroup">
                                        <option value="lower">3-5</option>
                                        <option value="middle">6-9</option>
                                        <option value="upper">9-13</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="activity-table">
                        <div class="table-title">
                            <h4 class="wider bold">
                                <i class="fa-solid fa-people-group"></i>
                                Activity
                            </h4>
                            <h4 class="bold">
                                <i class="fa-solid fa-people-group"></i>
                                Start Time
                            </h4>
                            <h4 class="bold">
                                <i class="fa-solid fa-people-group"></i>
                                End Time
                            </h4>
                            <h4 class="attend bold">
                                <i class="fa-solid fa-user-check"></i>
                                Attendence
                            </h4>
                        </div>

                        <div class="activity-row">
                            <p>Creative Play</p>
                            <p>9.00 A.M</p>
                            <p>10.00 A.M</p>
                            <p class="attend">22</p>
                        </div>

                        <div class="activity-row">
                            <p>Story Time</p>
                            <p>11.00 A.M</p>
                            <p>12.00 A.M</p>
                            <p class="attend">22</p>
                        </div>


                        <div class="activity-row">
                            <p class="assign" id="day-task">Basic Learning Activities</p>
                            <p>2.00 A.M</p>
                            <p>3.00 A.M</p>
                            <p class="attend">22</p>
                        </div>



                    </div>
                </div>

                <!-- ********* Pending Report Seciton **********-->


                <div class="pending-reports" id="pending">
                    <div class="pending-reports-head">
                        <div class="left-pend-head">
                            <h3>Pending Reports</h3>
                            <p>Age Group : 6-9</p>
                        </div>
                        <div class="right-pend-head" id="pending-close">
                            <span>&times;</span>
                        </div>

                    </div>
                    <div class="pending-title">
                        <h4>Registration No</h4>
                        <h4>Name</h4>
                        <h4>Status</h4>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="done">Submitted</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="pnd">Pending</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="done">Submitted</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="pnd">Pending</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="pnd">Pending</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="pnd">Pending</p>
                    </div>
                    <div class="pending-data">
                        <p>SDR001923</p>
                        <p>Thilina Perera</p>
                        <p id="done">Submitted</p>

                    </div>

                </div>
                <div class="right-content">


                    <div class="glass-box">
                        <div class="report-header">
                            <i class="fa-regular fa-clipboard"></i>
                            <h2>Status Report</h2>
                        </div>
                        <div class="report-body">
                            <p class="text">Review and finalize weekly reports for all the students</p>
                            <p class="number"><span>6 </span>Reports Pending</p>
                            <button class="manage" id="manage" onclick="openPending()">Manage Reports</button>
                        </div>
                        <div class="report-footer">
                            <p class="footer">week: <span>Feb 12-16, 2025</span></p>
                            <p class="footer">Last Update:<span>Feb 15, 2025</span></p>
                        </div>

                    </div>

                    <!-- ********* DAILY TASK VIEW **********-->






                    <div class="my-task">
                        <button class="accordion" id="accordion" onclick="accd()">
                            <p>Basic Learning Activities</p>
                        </button>
                        <div class="panel" id="accd-delete">
                            <?php if (isset($tasks)): ?>
                                <?php foreach ($tasks as $task): ?>
                                    <div class="title">
                                        <div class="content">
                                            <h4>Title:</h4>
                                            <p><?= htmlspecialchars($task->Title) ?></p>
                                        </div>
                                        <form method="POST" action="<?= ROOT ?>/Teacher/KiddoSchedule/delete" style="display: inline;">
                                            <!-- Add hidden input to pass the task ID -->
                                            <input type="hidden" name="id" value="<?= $task->id ?>">
                                            <button type="submit" class="delete-btn">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                        <button class="edit-btn" onclick="showTaskEdit(<?= htmlspecialchars(json_encode($task)) ?>)">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                        <!-- <form method="POST" action="#" style="display: inline;">
                    Add hidden input to pass the task ID 
                    <input type="hidden" name="id" value="<?= $task->id ?>">
                    <button type="submit" class="delete-btn" >
                        <i class="fa-regular fa-pen-to-square" onclick="showTaskEdit()"></i>
                    </button>
                </form> -->
                                    </div>
                                    <div class="description">
                                        <h4>Description:</h4>
                                        <p><?= htmlspecialchars($task->Description) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php elseif (isset($message)): ?>
                                <p><?= htmlspecialchars($message) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>

    <script src="<?= JS ?>/Teacher/script.js"></script>
    <script></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>

    <script>
        const notifyMenu = document.getElementById("nofity");
        document.getElementById("notify").addEventListener('click', toggleNotify);

        function toggleNotify() {
            notify.classList.toggle("open-notify")
        }
    </script>


</body>

</html>