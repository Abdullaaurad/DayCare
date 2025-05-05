<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/message.css?v=<?= time() ?>">
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
                    <img src="<?=IMAGE?>/profilePic.png" alt="profile-pic">
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
               
                <a href="#" class="profile">
                    <img src="<?=IMAGE?>/profilePic.png" onclick="toggleMenu()" id="profileIcon">
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
            <div class="glass-box">
                <div class="message-box">
                    <div class="chat-bar">
                        <h3><span>4</span> New Messages</h3>
                        <div class="chat-pane">
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-1.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-2.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-3.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-4.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-2.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                        <div class="chat-list-item">
                            <img src="<?=IMAGE?>/profilePic-2.png">
                            <div class="chat-details">
                                <h4>Sara Andrews</h4>
                                <p>New meeting is scheduled 3 days later</p>
                                <span>4.03 PM</span>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="message-panel">
                        <div class="heading">
                            <p>Your Connection With</p>
                            <h3>Sara Andrews</h3>
                        </div>
                       
                        <div class="dialog-box">
                            <div class="chat-container" id="chat-content">
                                <div class="sub-cont" id="sub-cont-1">
                                    <img class="person" src="<?=IMAGE?>/profilePic-2.png" title="Person-1" alt="person">
                                    <p id="chat-1">Hey</p>
                                    
                                </div>
                                <div class="sub-cont" id="sub-cont-2">
                                   
                                    <p id="chat-2">Hello</p>
                                    <img class="person" src="<?=IMAGE?>/profilePic-4.png" title="Person-2" alt="person">
                                </div>
                            </div>
                    
                            <div class="type-container">
                                <div class="child">
                                    <input type="text" id="type-1" placeholder="Enter your message here...">
                                    <div class="send-btn">
                                        <button id="act-1">Send</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
       
        </div>
    </div>
    </div>
    


    
    <script src="<?=JS?>/Teacher/script.js"></script>
    <script src="<?=JS?>/Teacher/message.js"></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>
</html>