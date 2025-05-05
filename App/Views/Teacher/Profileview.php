<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/profile.css?v=<?= time() ?>">
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
                    <img src="<?=ROOT?>/assets/images/profilePic.png" alt="profile-pic">
                    <div class="sidebar-header-content">
                        <h3>Sara Britney</h3>
                        <h4>Teacher</h4>
                    </div>
                </div>
                <div class="sidebar-list">
                    <a href="<?=ROOT?>/Teacher/Dashboard" class="sidebar-list-item" id="dashboard-link"> 
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Funzone" class="sidebar-list-item" id="home-link">
                    <i class="fa-solid fa-puzzle-piece"></i>
                        <span class="text">Funzone</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Reports" class="sidebar-list-item" id="report-link">
                        <i class='bx bxs-report' ></i>
                        <span class="text"> Report </span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Students" class="sidebar-list-item" id="students-link">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Students</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Leaves" class="sidebar-list-item" id="leaves-link">
                        <i class='bx bx-calendar' ></i>
                        <span class="text">Leaves</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Message" class="sidebar-list-item" id="chat-link" >
                        <i class='bx bx-message-square-detail'></i>
                        <span class="text">Messages</span>
                    </a>
                    <hr>
                    <a href="<?=ROOT?>/Main/Help" class="sidebar-bottom" id="help-link">
                            <i class='bx bxs-help-circle' ></i>
                            <span class="text">Help</span>
                    </a>
                    
        
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

            <div class="navabr">
                <div class="navbar-left">
                    <a href="#"><h2>Hey Sara Britney</h2></a>
                    <h4>Empowering Excellence in Every Lesson!</h4>
                </div>
                <div class="navbar-right">
                <div class="alter-icon"></div>
                <a href="#" class="notification" onclick="toggleNotify()" id = "notificationIcon">
                   
                    <i class='bx bxs-bell' ></i>
                </a>
                <a href="#" class="profile">
                    <img src="<?=ROOT?>/assets/images/profilePic.png" onclick="toggleMenu()" id="profileIcon">
                </a>
                </div>
    
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?=IMAGE?>/profilePic.png" alt="">
                            <h3>Sara Bretney</h3>
                        </div>
                        <hr>
    
                        <a href="<?=ROOT?>/Teacher/Profile" class="sub-menu-link">
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
                        <a href="<?=ROOT?>/Teacher/Notifications" onclick="toggleNotify()" class="all-btn">See all</a>
                    </div>
                </div> 
    
            </div>
        <div class="content">
            <div class="backgorund-overlay"></div>
            <div class="Profilecard" style="margin-top: 20px;">
                <div class="Profile">
                    <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer; color: rgba(35, 83, 167, 1);">Teacher Profile</p>
                </div>
                
                <div class="ProfileContainer">
                    
                    <div class="leftcon">
                        <form id="editprofileleft">
                            <img src="<?=IMAGE?>/profilePic-1.png" class="profile-img">
                            <div class="datafield">
                                <div class="data">
                                    <label>First Name</label>
                                    <input readonly placeholder="Sara" type="text">
                                </div>
                                <div class="data">
                                    <label>Last Name</label>
                                    <input readonly placeholder="Britney" type="text">
                                </div>
                            </div>
                            <div class="datafield">
                                <div class="data">
                                    <label>User Name</label>
                                    <input readonly placeholder="Sara Britney" type="text">
                                </div>
                            </div>
                            <div class="datafield">
                                <div class="data">
                                    <label>email</label>
                                    <input readonly placeholder="sarabrit453@gmail.com" type="text">
                                </div>
                                <div class="data">
                                    <label>NIC</label>
                                    <input readonly placeholder="1992820348" type="text">
                                </div>
                            </div>
                            <div class="datafield">
                                <div class="data">
                                    <label>Gender</label>
                                    <input readonly placeholder="Female" type="text">
                                </div>
                                <div class="data">
                                    <label>Language</label>
                                    <input readonly placeholder="English" type="text">
                                </div>
                            </div>
                            <div class="datafield">
                                <div class="data">
                                    <label>Date of Birth</label>
                                    <input readonly placeholder="07-05-1994" type="text">
                                </div>
                                <div class="data">
                                    <label>Contact</label>
                                    <input readonly placeholder="0712344567" type="text">
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <!--<div class="divider"></div>-->
                    <div class="rightcon">
                    <form id="editprofileright">
                        
                        <div class="datafield">
                            <div class="data">
                                <label>Address</label>
                                <input readonly placeholder="Colombo" type="text">
                            </div>
                            
                        </div>
                       
                        <div class="datafield">
                            <div class="data">
                                <label>Education</label>
                                <textarea readonly rows="6" placeholder="BSc. English"></textarea>

                               
                                
                            </div>
                        </div>

                        <div class="datafield">
                            <div class="data">
                                <label>Additional Training</label>
                                <textarea readonly rows="6" placeholder=""></textarea>
                               
                            </div>
                        </div>
                        <div class="datafield">
                            <div class="data">
                                <button >View Certifications</button>
                                
                               
                            </div>
                        </div>
                        <div class="profile-footer">
                        <button class="edit-btn" onclick="" id="profile-edit-btn">Edit</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            
            </div>
            
       
        </div>
    </div>
    </div>
    


    
    <script src="<?=JS?>/Teacher/script.js"></script>
    <script></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>
</html>