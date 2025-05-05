<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/students.css?v=<?= time() ?>">
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
                <?php if(isset($teacher)):?>
                <img src="<?=$teacher['image']?>">
                    <div class="sidebar-header-content">
                        <h3><?= $teacher['firstName'] ?> <?= $teacher['lastName'] ?></h3>
                        <?php endif; ?>
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
                    <!-- <a href="<?=ROOT?>/Teacher/Message" class="sidebar-list-item" id="chat-link" >
                        <i class='bx bx-message-square-detail'></i>
                        <span class="text">Messages</span>
                    </a> -->
                    
                   
                    
        
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

        <!-- ****** skill score popup *******-->
        <div class="skill-popup-container" id ="skill-popup-container">
                    <div class="card">
                    <form action="<?=ROOT?>/Teacher/Students/addSkill" method="POST">
                    <h2>Skill Observation: Jane Doe</h2>
                    <input type="hidden" name="ChildID" id = "id-input"/>
                    <hr>
                    <div class="skill-row">
                        <label for="teamwork">Cognitive</label>
                        <select name="Cognitive" id="teamwork" >
                        <option disabled selected value="">Rate</option>
                        <option value="1">🌱 Beginner</option>
                        <option value="2">🌿 Developing</option>
                        <option value="3">🌳 Mastered</option>
                        </select>
                    </div>
                    <div class="skill-row">
                        <label for="communication">Communication</label>
                        <select name="Communicaiton" id="communication" >
                        <option disabled selected value="">Rate</option>
                        <option value="1">🌱 Beginner</option>
                        <option value="2">🌿 Developing</option>
                        <option value="3">🌳 Mastered</option>
                        </select>
                    </div>
                    <div class="skill-row">
                        <label for="critical_thinking">Critical Thinking</label>
                        <select name="Critical Thinking" id="critical_thinking" >
                        <option disabled selected value="">Rate</option>
                        <option value="1">🌱 Beginner</option>
                        <option value="2">🌿 Developing</option>
                        <option value="3">🌳 Mastered</option>
                        </select>
                    </div>
                    <div class="skill-row">
                        <label for="emotional_control">Emotional Control</label>
                        <select name="Emotional Control" id="emotional_control" >
                        <option disabled selected value="">Rate</option>
                        <option value="1">🌱 Beginner</option>
                        <option value="2">🌿 Developing</option>
                        <option value="3">🌳 Mastered</option>
                        </select>
                    </div>
                    <div class="skill-row">
                        <label for="self_care">Creativity</label>
                        <select name="Creativity" id="self_care" >
                        <option disabled selected value="">Rate</option>
                        <option value="1">🌱 Beginner</option>
                        <option value="2">🌿 Developing</option>
                        <option value="3">🌳 Mastered</option>
                        </select>
                    </div>
                    <div class="button-set">
                        <button type="submit">Submit Observation</button>
                        <button type="button" onclick="closePopup()" class="cancel-button">Cancel</button>
                    </div>
                    
                    </form>
                </div>
                    </div>
                


            <div class="navabr">
                <div class="navbar-left">
                    <a href="#"><h2>Hey <?= $teacher['firstName'] ?> <?= $teacher['lastName'] ?></h2></a>
                    <h4>Empowering Excellence in Every Lesson!</h4>
                </div>
                <div class="navbar-right">
               
                <a href="#" class="profile">
                    <img src="<?=$teacher['image']?>" onclick="toggleMenu()" id="profileIcon">
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
            <div class="backgorund-overlay" ></div>
            <div class="profile-page"  style="height: 100%;">
                <div class="profile-page-header">
                    <i class="fa-regular fa-circle-user"></i>
                    <h3>Student Profiles</h3>                    
                    
                </div>
                <hr>
                <div class="filter-group">
                   
                    <input type="text" name="stu_name" placeholder="Search Name..." id="stu_name">
<!--                    
                    <label for="date">Age Group</label>
                    <form id="ageForm" action="<?=ROOT?>/Teacher/Students/selectbyAge" method="POST">
                                <select name="age-group" onchange="document.getElementById('ageForm').submit()">
                                    <option value="">Select Age Group</option>
                                    <option value="3-5">3-5</option>
                                    <option value="6-9">6-10 </option>
                                    <option value="10-13">11-13 </option>
                                </select>
                    </form> -->
                </div>

                <?php if (!empty(($errors))): ?>
                <div class="error-message">
                       
                           <?php foreach($errors as $error): ?>
                            <p><li><?= $error ?></li></p>
                            <?php endforeach; ?>
                       
                        </div>
                        <?php endif; ?>
                
                   
                    <div class="student-table"  id ="student-table" >
                        <div class="student-table-title" style="max-height:50px">
                            <h4>Reg NO</h4>
                            <h4>Full Name</h4>
                            <h4>Age</h4>
                            <h4>Skill Score</h4>
                        </div>
                  

                    
                    
                    <!-- This will dynamically display students -->
                    <div id="students-container" style="max-height: 360px; overflow-y: auto;scrollbar-width: none; 
    border-top: 1px solid #dcdcdc;">
                    <?php if (isset($message)): ?>
                        <div class="success-message">
                            <p><?= $message ?></p>
                        </div>
                        <?php endif; ?>

                    
                        
                    </div>
                </div>

            
       
        </div>
    </div>
    </div>
    


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?=JS?>/Teacher/skills.js"></script>
    <script>
    function escapeHTML(str) {
        return String(str).replace(/[&<>"']/g, function (m) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[m];
        });
    }

    // 👇 Main function to fetch and render students
    function fetchStudents(stu_name = '') {
    $.ajax({
        url: "<?=ROOT?>/Teacher/Students",
        method: "POST",
        data: {
            action: 'SearchRecord',
            stu_name: stu_name
        },
        success: function (data) {
            console.log("Got students:", data.students);
            let container = $('#students-container');
            container.empty(); // Clear existing content

            if (data.students && data.students.length > 0) {
                data.students.forEach(function(student) {
                    let studentRow = `
                        <div class="student-row">
                            <p class="row-items">${escapeHTML(student.ChildID)}</p>
                            <p class="row-items">${escapeHTML(student.First_Name)} ${escapeHTML(student.Last_Name)}</p>
                            <p class="row-items">${escapeHTML(student.DOB)}</p>
                            <div class="marks">
                                <button class="enter-btn" onclick="openPopup('${student.ChildID}')">Enter</button>
                            </div>
                        </div>
                    `;
                    container.append(studentRow);
                });
            } else if (data.message) {
                container.html(`<p><b>${escapeHTML(data.message)}</b></p>`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX failed:", status, error);
            console.log("Response text:", xhr.responseText);
        }
    });
}

    

    $(document).ready(function () {
        // 🔄 Fetch all students when the page loads
        fetchStudents();

        // 🔍 Trigger search on keyup
        $('#stu_name').on('keyup', function () {
            let stu_name = $(this).val();
            fetchStudents(stu_name);
        });
    });
</script>




   
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>
</html>