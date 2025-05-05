<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/reports.css?v=<?= time() ?>">
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
                    <a href="<?=ROOT?>/Teacher/Message" class="sidebar-list-item" id="chat-link" >
                        <i class='bx bx-message-square-detail'></i>
                        <span class="text">Messages</span>
                    </a>
                  
                    
                    
        
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

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
                        <a href="<?=ROOT?>/Teacher/Notifications"  onclick="toggleNotify()" class="all-btn">See all</a>
                    </div>
                </div> 
    
            </div>
        <div class="content" >
            <div class="report-page">
                <div class="report-page-header">
                    <i class='bx bxs-report'></i>
                    <h3>Status Reports</h3>                    
                    
                </div>
                <hr>
                <div class="filter-group" style="margin: 10px 0px">
                    <form action="<?=ROOT?>/Teacher/Reports/generateMonthlyReports" method="POST">
                        <button class="generate">Generate Monthly Reports</button>
                    </form>
                    <div class="age-class">
                        <label for="date">Age Group</label>
                        <select name="age-group" id="report-age">
                            <option disabled selected value="">Select</option>
                            <option value="6-9">6-9</option>
                            <option value="10-13">10-13</option>
                        </select>
                    </div>
                    

                </div>
                <div class="report-section" id= "report-container">
                    <div class="pending-section">
                        <h4 class="pend">Pending Reprots</h4>
                    
                        <div class="report-row pending" id="report-row-pending">
                           

                            </div>
                            <div class="pending-msg" id="pending-msg">
                         
                            <!-- <?php if (isset($message)): ?>
                                <div class="message">
                                    <p><?=$message?></p>
                                </div>
                            <?php endif; ?>                         -->
                        
                        </div>
                    </div>
                    <div class="complete-section">
                        <h4 class="comp">Completed Reprots</h4>
                          
                        <div class="report-row completed" id="report-row-completed">
                        
                                
                        </div>
                        <div class="complete-msg" id="complete-msg">     
                        <!-- <?php if (isset($message)): ?>
                                <div class="message">
                                    <p><?=$message?></p>
                                </div>
                            <?php endif; ?>   -->

                            
                    
                       
                        </div>
                    </div>
                </div>
           
            </div>
            
       
        </div>
    </div>
    </div>
    



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

    $(document).ready(function () {
        getGeneratedReports();

        $("#report-age").on('change', function () {
            var value = $(this).val();
            console.log("Selected:", value);
            getGeneratedReports(value);
        });
    });

        function getGeneratedReports(value = null) {
            $.ajax({
                url: '<?=ROOT?>/Teacher/Reports',
                method: 'POST',
                data: {
                    action: 'request',
                    value: value
                },
                dataType: 'json',

                success: function (response) {
                    //console.log(response);
                    let data = typeof response === 'string' ? JSON.parse(response) : response;
                    let completes = $('#report-row-completed');
                    let pendings = $('#report-row-pending');
                    completes.empty();
                    pendings.empty();

                    // ✅ Handle empty pending reports
                    if (!data.pending || data.pending.length === 0) {
                        $('#pending-msg').html(`<div class="message"><p>No pending reports</p></div>`);
                    } else {
                        $('#pending-msg').html(''); // Clear any previous message
                        data.pending.forEach(child => {
                            let studentRow2 = `
                                <div class="report-card">
                                    <div class="card-content">
                                        <div class="profile-img">
                                            <img src="<?=IMAGE?>/rtr.png" class="face" width="70px">
                                        </div>
                                        <div class="card-details">
                                            <h4>${escapeHTML(child.First_Name)} ${escapeHTML(child.Last_Name)}</h4>
                                            <p>Reg No: ${escapeHTML(child.ChildID)}</p>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" style="color:#fff" class="enter-btn">Enter Marks</button>
                                            <p class ="submit-msg">Marks Updated</p>
                                        </div>
                                        <div class="mark-section">
                                         <form class="mark-form" method="POST" id="marks-from">
                                                <input type="hidden" name="report_id" value="${child.ReportID}">
                                                <input type="text" name="Marks" id="marks-input" required>
                                                <span  style="color: red;" id="mark-error"></span>
                                                <button type="submit" class="marks-submit">Submit</button>
                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            `;
                            pendings.append(studentRow2);
                            pendings.show();
                        });
                    }

                    // ✅ Handle empty completed reports
                    if (!data.completed || data.completed.length === 0) {
                        $('#complete-msg').html(`<div class="message"><p>No completed reports</p></div>`);
                    } else {
                        $('#complete-msg').html(''); // Clear any previous message
                        data.completed.forEach(child => {
                            let studentRow1 = `
                                <div class="report-card">
                                    <div class="card-content">
                                        <div class="profile-img">
                                            <img src="<?=IMAGE?>/rtr.png" class="face" width="70px">
                                        </div>
                                        <div class="card-details">
                                            <h4>${escapeHTML(child.First_Name)} ${escapeHTML(child.Last_Name)}</h4>
                                            <p>Reg No: SNT110923</p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="<?=ROOT?>/Teacher/AcademicReport" method="POST">
                                                <input type="hidden" name="report_id" value="${child.ReportID}">
                                                <button type="submit" style="color:#fff">View Report</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            `;
                            completes.append(studentRow1);
                            completes.show();
                        });
                    }


                    // 👇 Attach submit handler after the new forms are in the DOM
                    $(".mark-form").on("submit", function (e) {
                        e.preventDefault();
                        console.log("Submitting marks...");

                        const form = $(this);
                        const marks = form.find("input[name='Marks']").val();
                        const reportID = form.find("input[name='report_id']").val();

                        console.log(marks, reportID);
                        $.ajax({
                            url: "<?=ROOT?>/Teacher/Reports/SubmitMarks", // Adjust if needed
                            method: "POST",
                            data: {
                                report_id: reportID,
                                marks: marks
                            },
                            dataType: "json", // ✅ this is the correct one
                            success: function (response) {
                                console.log("💬 Raw response:", response);

                                if (response.success) {
                                    console.log("✅ Marks submitted!", response.message);
                                    alert(response.message);
                                    getGeneratedReports(); // Refresh reports table or UI
                                } else {
                                    console.warn("⚠️ Something went wrong:", response.error);
                                    alert(response.error || "Failed to submit marks.");
            }
                            },
                        
                            error: function (xhr, status, error) {
                                console.error("❌ AJAX error:", xhr.responseText);
                                alert(response.error);
                            }
                        });
                    });

                    $(document).on('click', '.enter-btn', function () {
                        const btn = $(this);
                        const markSection = btn.closest('.card-content').find('.mark-section');
                        
                        btn.hide(); // Hide the button when clicked
                        markSection.show().addClass('show'); // Show the mark section
                    });

                    $document.on('submit', '.marks-submit', function(){
                        const button = $(this);
                        const markSection = button.closest('.card-content').find('.mark-section');

                        markSection.hide();
                        button.closest('.card-content').find('.enter-btn').hide();
                        button.closest('.card-content').find('.submit-msg').show();

                    })


                }, 

                error: function (xhr, status, error) {
                    console.log("Server raw output:", xhr.responseText);
                    $('#complete-msg').html('<p>Something went wrong </p>');
                }
            });
        }

   
</script>

    <script src="<?=JS?>/Teacher/script.js"></script>
    
    

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
</body>
</html>