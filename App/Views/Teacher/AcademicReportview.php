<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/academic.css?v=<?= time() ?>">
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
                        <a href="<?= ROOT ?>/Teacher/Dashboard">
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
                    <a href="#"><h2>Hey <?=htmlspecialchars($teacherInfo['First_Name'])?> <?=htmlspecialchars($teacherInfo['Last_Name'])?></h2></a>
                    <h4>Empowering Excellence in Every Lesson!</h3>
                </div>
                <div class="navbar-right">
                <!-- <div class="alter-icon"></div>
                <a href="#" class="notification" onclick="toggleNotify()" id = "notificationIcon">
                   
                    <i class='bx bxs-bell' ></i>
                </a> -->
                <a href="#" class="profile">
                    <img src="<?=htmlspecialchars($teacherInfo['Image'])?> " onclick="toggleMenu()" id="profileIcon">
                </a>
                </div>
    
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?=IMAGE?>/profilePic.png" alt="">
                            <h3>Sara Bretney</h3>
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
                        <a href="<?=ROOT?>/Teacher/Notifications" onclick="toggleNotify()" class="all-btn">See all</a>
                    </div>
                </div> 
    
            </div>
        <div class="content">
            <div class="backgorund-overlay"></div>
            
            <div class="success-popup" id="success">
                <div class="success-popup-content">
                    <div class="checkmark">
                        <img src="<?=IMAGE?>/tick.png">
                        <h2>Success!</h2>
                    </div>
                    <p>Report has been submitted successfully</p>
                    <div class="continue">
                       <a href="<?=ROOT?>/Teacher/Reports"> <h3>Continue</h3></a>
                    </div>
                    
                    
           
                </div>
            </div>
            
            <div class="report-page">
                <H3>Report Card</H3>
                
                   
                <div class="report-header">
                    <?php if (isset($studentError) && $studentError !== null): ?>
                        <div class="error-message"><?= htmlspecialchars($studentError) ?></div>
                    
                    <?php elseif(isset($studentData)): ?>
                        
                    <!-- <div class="profile">
                        <div class="first-row">
                            <img src="<?=htmlspecialchars($studentData['Image'])?>" alt="profile pic">
                            <h3><?=htmlspecialchars($studentData['First_Name'])?> <?=htmlspecialchars($studentData['Last_Name'])?> </h3>
                        </div>
                        <div class="sub-details">
                            <p>Registration Number : <span><?=htmlspecialchars($studentData['RegNo'])?></span></p>
                            <p>Age: <?=htmlspecialchars($studentData['Age'])?> </p>
                        </div>
                        <div class="sub-details">
                            <p>Report Month: <?=htmlspecialchars($studentData['Month'])?> </p>
                            <p>Creation Date: <?=htmlspecialchars($studentData['Created'])?> </p>
                        </div>
                        
                    </div> -->
                    <div class="profile-card">
                    <div class="profile-header">
                        <div class="profile-img-container">
                            <img src="<?=htmlspecialchars($studentData['Image'])?>" alt="Student Photo" class="profile-img">
                        </div>
                    </div>
                    <div class="profile-content">
                        <h1 class="student-name"><?=htmlspecialchars($studentData['First_Name'])?> <?=htmlspecialchars($studentData['Last_Name'])?></h1>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Registration Number</span>
                                <span class="detail-value"><?=htmlspecialchars($studentData['RegNo'])?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Age</span>
                                <span class="detail-value"><?=htmlspecialchars($studentData['Age'])?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Report Month</span>
                                <span class="detail-value"><?=htmlspecialchars($studentData['Month'])?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Creation Date</span>
                                <span class="detail-value"><?=htmlspecialchars($studentData['Created'])?></span>
                            </div>
                        </div>
                        <div class="report-badge">
                            <span><?=htmlspecialchars($studentData['Month'])?></span> <span><?=htmlspecialchars($studentData['Year'])?></sapn> Report
                        </div>
                    </div>
                </div>
                    <?php endif; ?>

                    <?php if (isset($attendError) && $attendError !== null): ?>
                                <div class="error-message"><?= htmlspecialchars($attendError) ?></div>
                            <?php elseif(isset($attendData)): ?>
                    <div class="attendence-bar">
                            
                            <h3>My Attendence </h3>
                           
                            <!-- <pre><?php print_r($attendData)?></pre>
                            -->
                          
                            <?php 
                                $presentPercent = ($attendData['precentage']);
                                $conic = "conic-gradient(var(--primary-color) {$presentPercent}%, var(--border-line) 0)";
                            ?>
                            <div 
                                class="progress-bar" 
                                role="progressbar" 
                                aria-valuenow="<?= $presentPercent ?>" 
                                aria-valuemin="0" 
                                aria-valuemax="100"
                                style="background:
                                    radial-gradient(closest-side, white 79%, transparent 80% 100%),
                                    <?= $conic ?>;">
                                <span class="progress-value"><?= $presentPercent ?>%</span>
                            </div>

                            <div class="data">
                                <div class="data-line">
                                    <div class="dot1"></div>
                                    <p><span><?=htmlspecialchars($attendData['precent'])?> </span>Present</p>
                                </div>
                                <div class="data-line">
                                    <div class="dot2"></div>
                                    <p><span><?=htmlspecialchars($attendData['absent'])?> </span>Absent</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
               
                <div class="subject-grades">
                    <div class="subject-grades-head">
                        <h3>Learning Checks</h3>
                       
                    </div>
                    <div class="subject-grades-titles">
                        <h4>Subject ID</h4>
                        <h4>Subject</h4>
                        <h4>Marks</h4>
                        <h4>Regulation</h4>
                    </div>
                    <?php if (isset($marksError) && $marksError !== null): ?>
                    <div class="error-message"><?= htmlspecialchars($marksError) ?></div>
                  
                    <?php elseif(isset($marksData)): ?>
                        <?php foreach($marksData as $mark): ?>
                            <div class="subject-grades-data">
                                <p>0<?=htmlspecialchars($mark['Subject_ID'])?></p>
                                <p><?=htmlspecialchars($mark['Subject_Name'])?></p>
                                <p class="mark"><?=htmlspecialchars($mark['Mark'])?></p>
                                <div class="regulation"><p class="stat">Good</p></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                
                   
                </div>
                <div class="social-behaviour">
                <div class="container-social">
                    <h3>Fundamental Skills</h3>
                    <div class="skills-container">
                        <!-- Cognitive Skills -->
                         <?php if (isset($skillsData) && $skillsData !== null): ?>
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Cognitive Skills</span>
                                <span class="skill-value cognitive"><?=htmlspecialchars($skillsData['cognitive'])?></span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress cognitive" style="width: 85%"></div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Communication Skills -->
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Communication Skills</span>
                                <span class="skill-value communication">78</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress communication" style="width: 78%"></div>
                            </div>
                        </div>

                        <!-- Social and Emotional Skills -->
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Social and Emotional Skills</span>
                                <span class="skill-value socials">82</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress socials" style="width: 82%"></div>
                            </div>

                        </div>

                        <!-- Creative Skills -->
                        <div class="skill-item">
                            <div class="skill-header">
                                <span class="skill-name">Creative Skills</span>
                                <span class="skill-value creative">90</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-progress creative" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="behaviour">
                        
                            <div class="behaviour-head">
                                <h3>Behavioural Development</h3>
                            </div>
                            <div class="behaviour-skills">
                                <div class="text-line">
                                <i class="fas fa-circle" style="font-size: 10px; color: #3974ba;"></i>
                                Consistently calm and cooperative
                                </div>
                            
                            <div class="text-line">
                            <i class="fas fa-circle" style="font-size: 10px; color: #3974ba;"></i>
                                Expresses emotions freely
                           </div>
                        </div>
                            
                        

                    </div>
                </div>
                <!-- <div class="general-notes">
                    <div class="note-head">
                        <h3>General Notes and Suggestions</h3>
                    </div>
                    <div class="text-area">
                        <textarea rows="3" placeholder="Give suggestions and feedbacks" id="note"></textarea>
                    </div>
                </div>
                <div class="report-footer">
                    
                    <button class="reset" id="reset-report" >Reset</button>
                    <button class="submit-report" id="submit-report">Submit</button>
                </div> -->
            </div>
         
       
        
        </div>
    </div>
    </div>

    <script src="<?=JS?>/Teacher/script.js"></script>
    <script src="<?=JS?>/Teacher/academic.js"></script>
    <script>
        //  document.addEventListener('DOMContentLoaded', function() {
        //     // Fetch skills data from PHP backend
        //     fetch('get_skills_data.php')
        //         .then(response => response.json())
        //         .then(data => {
        //             // Update skill values and progress bars
        //             document.querySelector('.cognitive').textContent = Number(data.cognitive);
        //             document.querySelector('.skill-progress.cognitive').style.width = '40' + '%';
                    
        //             document.querySelector('.communication').textContent = data.communication;
        //             document.querySelector('.skill-progress.communication').style.width = data.communication + '%';
                    
        //             document.querySelector('.social').textContent = data.social;
        //             document.querySelector('.skill-progress.social').style.width = data.social + '%';
                    
        //             document.querySelector('.creative').textContent = data.creative;
        //             document.querySelector('.skill-progress.creative').style.width = data.creative + '%';
        //         })
        //         .catch(error => {
        //             console.error('Error fetching skills data:', error);
        //         });
        // });

        // document.querySelector('.cognitive').textContent = Number(data.cognitive);
        //             document.querySelector('.skill-progress.cognitive').style.width = 40 + '%';
                    
        //             document.querySelector('.communication').textContent = data.communication;
        //             document.querySelector('.skill-progress.communication').style.width = data.communication + '%';
                    
        //             document.querySelector('.social').textContent = data.social;
        //             document.querySelector('.skill-progress.social').style.width = data.social + '%';
                    
        //             document.querySelector('.creative').textContent = data.creative;
        //             document.querySelector('.skill-progress.creative').style.width = data.creative + '%';

        
        window.addEventListener('load', () => {
    let markElement = document.querySelector('.mark');
    if (!markElement) return; // just in case it's not there

    let mark = parseFloat(markElement.textContent.trim());
    console.log("Parsed mark:", mark);

    let card = document.querySelector('.regulation');
    let stat = document.querySelector('.stat');

    if (mark >= 75 && mark <= 100) {
        stat.innerHTML = '💎 Perfect';
        card.style.backgroundColor = '#a3f0b6';
    } else if (mark >= 65 && mark < 75) {
        stat.innerHTML = '✅ Good';
        card.style.backgroundColor = '#f6fbba';
    } else if (mark >= 50 && mark < 65) {
        stat.innerHTML = '🧩 Almost Good';
        card.style.backgroundColor = '#a3f0b6';
    } else {
        stat.innerHTML = '🚨 Needs Work';
        card.style.backgroundColor = '#f6cfcf';
    }
});

    </script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
    
</body>
</html>