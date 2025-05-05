<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="<?=CSS?>/Doctor/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/history.css?v=<?= time() ?>">
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
            <div class="sidebar">
                <div class="sidebar-header">
                <?php if(isset($doctor)) :?>
                        <img src="<?=$doctor['image']?>" alt="profile-pic">
                        <div class="sidebar-header-content">
                            <h3><?=$doctor['Name']?></h3>
                            <h4>Doctor</h4>
                        </div>
                </div>
                <div class="sidebar-list">
                    <a href="<?=ROOT?>/Doctor/Dashboard" class="sidebar-list-item" id="dashboard-link"> 
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                   
                    <!-- <a href="<?=ROOT?>/Doctor/Prescriptions" class="sidebar-list-item" id="report-link">
                        <i class='bx bxs-report' ></i>
                        <span class="text"> Prescriptions </span>
                    </a> -->
                    <a href="<?=ROOT?>/Doctor/History" class="sidebar-list-item" id="students-link">
                    <i class='bx bxs-report' ></i>
                        <span class="text">Prescriptions</span>
                    </a>
                    
                  
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

            <div class="navabr">
                <div class="navbar-left">
                    <a href="#"><h2>Dashboard</h2></a>
                    <h4><?=$doctor['date'] ?></h3>
                </div>
                <div class="navbar-right">
                <div class="alter-icon"></div>
                <!-- <a href="#" class="notification" onclick="toggleNotify()" id = "notificationIcon">
                   
                    <i class='bx bxs-bell' ></i>
                </a> -->
                <a href="#" class="profile">
                    <img src="<?=$doctor['image']?>"  onclick="toggleMenu()" id="profileIcon" height="50px">
                </a>
                </div>
                <?php endif; ?>    
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?=IMAGE?>/profilePic-2.png" alt="">
                            <h3>Wane Carter</h3>
                        </div>
                        <hr>
    
                        <a href="teacherViewprofile.html" class="sub-menu-link">
                            <i class='bx bx-edit'></i>
                            <p>View Profile</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <i class='bx bx-help-circle' ></i>
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
                                <p >05.33 22 Jul</p>
                            </div>
                           
                        </a>
                        <hr>
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Parents meeting</h5>
                                <p >05.33 22 Jul</p>
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
                        
                    </div>
                </div> 
    
            </div>
        <div class="content">
            <div class="backgorund-overlay"></div>
            <div class="press-page">
                <div class="press-page-header">
                    <div class="press-page-header-group">
                        <i class="fa-regular fa-calendar"></i>
                        <h3>Prescription History</h3>
                    </div>
                    
                    <hr>
                </div>
                <div class="press-table">
                    <div class="press-table-title">
                        <h4>Prescription ID</h4>
                        <h4>Child's Name</h4>
                        <h4>Medication</h4>
                        <h4>Parent's Name</h4>
                        <h4>Contact Number </h4>
                        
                    </div>
                    <?php if (isset($childInfo)): ?>
                        <?php foreach ($childInfo as $child): ?>
                    <div class="press-row">
                        <p>MTD00<?=$child['AppoinentID']?></p>
                        <p><?=$child['ChildName']?></p>
                        <p><?=$child['Medication']?></p>
                        <p><?=$child['Dosage']?></p>
                        <p><?=$child['Frequency']?></p>
                                        
                    </div>
                    <?php endforeach; ?>
                    <?php elseif (isset($Message)): ?>
                       <div class="message">
                       <p><?=$Message?></p>
                       </div>
                   <?php endif; ?>
                   
                   
                </div>
                
            </div>
         
       
            
        </div>
    </div>
    </div>

    <script src="../Scripts/script.js"></script>
    <script></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
    
</body>
</html>