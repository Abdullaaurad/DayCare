

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/dash.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
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
                <?php if(isset($teacherInfo)): ?>
                <img src="<?=htmlspecialchars($teacherInfo['Image'])?> " alt="profile-pic">
                    <div class="sidebar-header-content">
                    
                        <h3><?=htmlspecialchars($teacherInfo['First_Name'])?> <?=htmlspecialchars($teacherInfo['Last_Name'])?></h3>
                        <?php endif; ?>
                        <h4>Teacher</h4>
                    </div>
                </div>
                <div class="sidebar-list">
                    <a href="#" class="sidebar-list-item" id="dashboard-link" > 
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
                        <!-- <i class="fa-solid fa-puzzle-piece"></i> -->
                        <i class='bx bxs-group' ></i>
                        <span class="text">Students</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Leaves" class="sidebar-list-item" id="leaves-link" >
                        <i class='bx bx-calendar' ></i>
                        <span class="text">Leaves</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Message" class="sidebar-list-item" id="chat-link" >
                        <i class='bx bx-message-square-detail'></i>
                        <span class="text">Messages</span>
                    </a>
                  
                    
        
                </div>
            </div>
        </div>
  
        <div class="wrapper-1">


            <!-- ********* DAILY TASK SCHEDULE **********-->

            <div class="kiddo-schedule-container" id="kiddo-schedule-container" >
                <div class="kiddo-content">
                    <div class="kiddo-header">
                        <i class='bx bx-alarm'></i>
                        <div class="header-cont">
                            <h2>What Did We Learn?</h2>
                            
                        </div>
                        <img src="<?=ROOT?>/assets/images/let.png">
                    </div>
                    
                    <form action="<?=ROOT?>/Teacher/KiddoSchedule/addTask" method="post" id="task-form-submit">
                    <input type="hidden" id="today-task-id" name="WorkID">
                    <input type="hidden" id="today-teacher-id" name="TeacherID">
                        <div class="kiddo-body">
<!--     
                    <label htmlfor="name">Title</label>
                    <input type="text" name="Title"  required> -->

                    <label htmlfor="name">Description</label>
                    <textarea rows="4"  name="Description" id="task-des"></textarea>
                    <span  style="color: red;" id="task-error"></span>
                    
                </div>
                   
                    <div class="kiddo-footer">
                        <button class="done" type="submit">Done</button>
                        <button class="cancel" id="close-kiddo" onclick="closekiddo()">Cancel</button>
                    </div>
                </form>
                </div>
            </div> 

            
            <!-- *********  EDIT TASK  **********-->
            <div class="edit-task-popup">
                <div class="task-edit-container" id="task-edit-container" >
                    <div class="task-content">
                        <div class="task-edit-header">
                            <i class='bx bx-alarm'></i>
                            <div class="task-edit-header-cont">
                                <h2>What Did We Learn?</h2>
                                
                            </div>
                            <img src="<?=ROOT?>/assets/images/let.png">
                        </div>
                        
                        <form action="<?=ROOT?>/Teacher/KiddoSchedule/updateTask" method="post">
                        <input type="hidden" id="edit-task-id" name="ActivityID">
                            <div class="task-edit-body">
                            
                        <!-- <label htmlfor="name">Title</label>
                        <input type="text" name="Title"  id="task-title" required> -->

                        <label htmlfor="name">Description</label>
                        <textarea rows="4" required name="Description" class="task-description"></textarea>
                        <span id="task-name-error" style="color: red;" class="task-name-erro"></span>
                    </div>
                    
                        <div class="task-edit-footer">
                            <button class="done" type="submit">Done</button>
                            <button class="cancel" id="close-kiddo" onclick="closeTaskEdit()">Cancel</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

             <!-- *********  NAVBAR  **********-->
            <div class="navabr">
            <div class="navbar-left">
            <?php if(isset($teacherInfo)): ?>
                <a href="#"><h2>Hey <?=htmlspecialchars($teacherInfo['First_Name'])?> <?=htmlspecialchars($teacherInfo['Last_Name'])?></h2></a>
                <?php endif; ?>
                <h4>Empowering Excellence in Every Lesson!</h4>
            </div>
            <div class="navbar-right">
            <!-- <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search search-btn"></i>
                    
                </div> -->

            <div class="alter-icon"></div>
            <a href="#" class="notification" onclick="toggleNotify()" id = "notificationIcon">
               
                <i class='bx bxs-bell' ></i>
            </a>
            <a href="#" class="profile">
                <img src="<?=htmlspecialchars($teacherInfo['Image'])?>" onclick="toggleMenu()" id="profileIcon">
            </a>
            </div>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="<?=ROOT?>/assets/images/profilePic.png" alt="">
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

             <!-- *********  MAIN CONTENT **********-->
            <div class="content">
            
                <div class="col-1">
                    <div class="today-course">
                        <h3>Today's Lesson</h3>

                        <select name="task" id="value">
                            <option disabled selected value="">Select</option>
                            <option value="6-9">6 - 9</option>
                            <option value="10-13">10 - 13</option>
                           
                        </select>
                    </div>
                    
                    <div class="activity-column" id="activity-column">

                   
                        
                    </div>
                    <div class="perfomance">
                            <div class="title">
                                <h3>Overrall Performance</h3>
                                
                            </div>
                            
                            <div class="chart">
                                <div class="skil-chart">
                                    <canvas id="canvas-1" width="200px"></canvas>                         
                                </div>
                                <div class="chart-details">
                                     <div class="section">
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-1"></div>
                                                <p>Outstanding</p>
                                            </div>
                                            <div class="percent">
                                                <p><?=$dataArray[0]?>%
                                                </p>
                                            </div>
                                        </div>
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-2"></div>
                                                <p>Satisfactory</p>
                                            </div>
                                            <div class="percent">
                                                <p><?=$dataArray[1]?>%</p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="section">
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-3"></div>
                                                <p>Developing </p>
                                            </div>
                                            <div class="percent">
                                                <p><?=$dataArray[2]?>%</p>
                                            </div>
                                        </div>
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-4"></div>
                                                <p>Weak </p>
                                            </div>
                                            <div class="percent">
                                                <p><?=$dataArray[2]?>%</p>
                                            </div>
                                        </div>
                                     </div>             
                                </div>                   
                            </div>
                            
                    </div>                               
                    
                </div>

                <div class="col-2">
                    <div class="first-block">
                        <div class="attendance">
                            <h3>Attendance</h3>
                            <div class="attend-row">
                                <div class="details">
                                    <div class="icon one">
                                        <i class="fa-solid fa-clipboard-user clipone"></i>
                                    </div>
                                    <div class="stats">
                                        <p class="number"><span>85</span>%</p>
                                        <p class="group">Group: <span>3-5</span></p>
                                    </div>
                                    
                                </div>

                                <div class="details">
                                    <div class="icon two">
                                        <i class="fa-solid fa-clipboard-user cliptwo"></i>
                                    </div>
                                    <div class="stats">
                                        <p class="number"><span>75</span>%</p>
                                        <p class="group">Group: <span>6-9</span></p>
                                    </div>
                                    
                                </div>

                                <div class="details">
                                    <div class="icon three">
                                        <i class="fa-solid fa-clipboard-user clipthree"></i>
                                    </div>
                                    <div class="stats">
                                        <p class="number"><span>90</span>%</p>
                                        <p class="group">Group: <span>10-13</span></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- <div class="perfomance">
                            <div class="title">
                                <h3>Overrall Performance</h3>
                                <a href="#"><p>View Details ></p></a>
                            </div>
                            <p class="subtitle">Subject Profeciency</p>
                            <div class="chart">
                                <div class="skil-chart">
                                    <canvas id="canvas" width="200px"></canvas>                         
                                </div>
                                <div class="chart-details">
                                     <div class="section">
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-1"></div>
                                                <p>Outstanding</p>
                                            </div>
                                            <div class="percent">
                                                <p>55%</p>
                                            </div>
                                        </div>
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-2"></div>
                                                <p>Satisfactory</p>
                                            </div>
                                            <div class="percent">
                                                <p>20%</p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="section">
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-3"></div>
                                                <p>Developing </p>
                                            </div>
                                            <div class="percent">
                                                <p>15%</p>
                                            </div>
                                        </div>
                                        <div class="legend">
                                            <div class="level-name">
                                                <div class="circle-4"></div>
                                                <p>Weak </p>
                                            </div>
                                            <div class="percent">
                                                <p>10%</p>
                                            </div>
                                        </div>
                                     </div>             
                                </div>                   
                            </div>
                            
                        </div> -->
                    </div>
                    <div class="second-block">
                        <h3>Subject Profeciency</h3>   
                        <!-- <pre><?php print_r($lineArray)?></pre>                              -->
                        <div class="line-chart">
                            <canvas id="canvas-2" width="600px" height="300px"></canvas>
                        </div>
                </div>
        
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const phpData = <?= json_encode($dataArray) ?>;
        const phpData2 = <?= json_encode($lineArray) ?>;
    </script>

<script src="graph.js"></script> <!-- Load your graph after phpData is ready -->


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?=JS?>/Teacher/script.js"></script>
    <script src="<?=JS?>/Teacher/graphs.js"></script>
    <script src="<?=JS?>/Teacher/validation.js"></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
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

console.log("Script loaded ✅");

function fetchTaskList(value = null) {
    
    $.ajax({
            url: "<?=ROOT?>/Teacher/Dashboard",
            method: "POST",
            data: {
                action: 'request',
                value: value
            },
            success: function (response) {
                console.log("Server response:", response);

                // ✅ Removed invalid `exit();`
                // ✅ Fixed `data` vs `response`
                let data = typeof response === 'string' ? JSON.parse(response) : response;

                let container = $('#activity-column');
                container.empty();
                console.log(data);
                if (data.tasks && data.tasks.length > 0) {
                    data.tasks.forEach(function (task) {
                        let activity = `
                        <div class="activity" id="activity">
                            <div class="data-box">
                                <div class="head-part">
                                     <h4 class="topic">${escapeHTML(task.Activity)}</h4>
                                      ${
                                                (!task.Description || task.Description.trim() === "") 
                                                ? `<button class="add-task open-kiddo" data-workid="${task.WorkID}" data-teacherid=${task.TeacherID}>Create</button>` 
                                                : ""
                                            }
                                </div>
                               
                                <div class="data-1 set">
                                    <i class='bx bx-time-five'></i>
                                    <p class="time">${escapeHTML(task.Start_Time)} - ${escapeHTML(task.End_Time)} PM</p>
                                </div>
                               
                                <div class="data-3 set">
                                    <div class="panel" id="accd-delete">
                                        <div class="title">
                                            <div class="description">
                                                <h4>Description:</h4>
                                                <p>${escapeHTML(task.Description || "No description provided.")}</p>
                                            </div>
                                            <div class="buttons-section">
                                                <form method="POST" action="<?= ROOT ?>/Teacher/KiddoSchedule/delete" style="display: inline;">
                                                    <input type="hidden" name="ActivityID" value="${escapeHTML(task.ActivityID)}">
                                                    <button type="submit" class="delete-btn">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>
                                                </form>
                                                <button class="edit-btn edit-kiddo" data-actid="${task.ActivityID}" data-desc="${task.Description}">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </button>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="panel-footer">
                                            <p class="error">${escapeHTML(data.message || '')}</p>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        container.append(activity); // ✅ Fixed: used correct variable name
                    });
                } else if (data.message) {
                    container.html(`<p><b>${escapeHTML(data.message)}</b></p>`);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
                $('#activity-column').html(`<p style=" width: 100%;
    padding: 4px 5px 4px 20px;
     color: #ff0000;
    border: 1px;
    font-size: 12px;
    font-weight: 600;
    background-color: #feb7b7ad;
    width:40%;
    margin: 6px 2px 6px 12px;
  
    border-radius: 8px;">No Activities Found Today</p>`);
            }
        });
}

$(document).ready(function () {
    fetchTaskList();

    $("#value").on('change', function () {
        var value = $(this).val();
        console.log("Selected:", value);
        fetchTaskList(value);

        
    });

     // 🧠 NEW: Event delegation for dynamically added "Create" buttons
     $(document).on('click', '.open-kiddo', function () {
        const workId = $(this).data('workid');
        const teacherID = $(this).data('teacherid');
        console.log("Clicked create button for WorkID:", workId);
        console.log("Clicked create button for TeacherID:", teacherID);

        showKiddo(workId,teacherID);
    });

    $(document).on('click', '.edit-kiddo', function () {
        const activityID = $(this).data('actid');
        const desc = $(this).data('desc');
        console.log("Clicked create button for ActID:", activityID);
      

        showTaskEdit(activityID,desc);
    });
});


    </script>


</body>
</html>