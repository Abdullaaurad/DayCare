<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/reports.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Teacher/students.css?v=<?= time() ?>">
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
                    <li class="hover-effect unselected first">
                        <a href="<?= ROOT ?>/Teacher/Home">
                            <i class="fas fa-home"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="hover-effect unselected">
                        <a href="<?= ROOT ?>/Teacher/Funzone">
                            <i class="fas fa-puzzle-piece"></i> <span>Funzone</span>
                        </a>
                    </li>
                    <li class="selected">
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
            <div class="content">
                <div class="header" style="width: 1270px; margin-left: 260px; padding: 40px;">
                    <div class="header-title">
                        <h2 style="font-size: 24px;">
                            Hey
                        </h2>
                        <p>
                            Start your day happy with little ones !
                        </p>
                    </div>
                    <div class="bell-con" id="bell-container" style="cursor: pointer;">
                        <i class="fas fa-bell bell-icon" style="margin-left: -350px; color: white;"></i>
                        <?php if (!empty($data['Notification'])): ?>
                            <?php if ($data['Notification']['Seen'] != 0): ?>
                                <div class="message-numbers" id="message-number">
                                    <p><?= $data['Notification']['Seen'] != 0 ? $data['Notification']['Seen'] : '' ?></p>
                                </div>
                            <?php endif; ?>
                            <div class="message-dropdown" id="messageDropdown" style="display: none;">
                                <ul>
                                    <?php foreach ($data['Notification']['data'] as $row): ?>
                                        <li data-id="<?= $row->NotificationID ?>">
                                            <p><?= htmlspecialchars($row->Description) ?></p>
                                            <?php if ($row->Location != NULL): ?>
                                                <a href="<?= ROOT ?>/Child/<?= $row->Location ?>">
                                                    <i class="fas fa-paper-plane"></i>
                                                </a>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Prodile btn -->
                    <div class="profile">
                        <button class="profilebtn">
                            <i class="fas fa-user-circle"></i>
                        </button>
                    </div>
                </div>
                <div class="report-page" style="margin-top: 100px;">
                    <div class="report-page-header">
                        <i class='bx bxs-report'></i>
                        <h3>Status Reports</h3>

                    </div>
                    <hr>
                    <div class="filter-group" style="margin: 10px 0px">
                        <form action="<?= ROOT ?>/Teacher/Reports/generateMonthlyReports" method="POST">
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
                    <div class="report-section" id="report-container">
                        <div class="pending-section">
                            <h4 class="pend">Pending Reprots</h4>

                            <div class="report-row pending" id="report-row-pending">


                            </div>
                            <div class="pending-msg" id="pending-msg">

                                <!-- <?php if (isset($message)): ?>
                                <div class="message">
                                    <p><?= $message ?></p>
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
                                    <p><?= $message ?></p>
                                </div>
                            <?php endif; ?>   -->




                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000; width: 21rem;">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" />
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= $data['Profile']->Image; ?>" width="100" class="profile" />
            <h2><?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?></h2>
            <p><?= $data['Profile']->EmployeeID ?> </p>
            <button class="profile-button"
                onclick="window.location.href ='<?= ROOT ?>/Receptionist/Profile'">Profile
            </button>
            <button class="logout-button" onclick="logoutUser()">LogOut</button>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function escapeHTML(str) {
            return String(str).replace(/[&<>"']/g, function(m) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [m];
            });
        }

        function logoutUser() {
            fetch("<?= ROOT ?>/Teacher/Dashboard/Logout", {
                    method: "POST",
                    credentials: "same-origin"
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "<?= ROOT ?>/Main/Login";
                    } else {
                        alert("Logout failed. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        console.log("Script loaded ✅");

        $(document).ready(function() {
            getGeneratedReports();

            $("#report-age").on('change', function() {
                var value = $(this).val();
                console.log("Selected:", value);
                getGeneratedReports(value);
            });
        });

        function getGeneratedReports(value = null) {
            $.ajax({
                url: '<?= ROOT ?>/Teacher/Reports',
                method: 'POST',
                data: {
                    action: 'request',
                    value: value
                },
                dataType: 'json',

                success: function(response) {
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
                                            <img src="<?= IMAGE ?>/rtr.png" class="face" width="70px">
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
                                            <img src="<?= IMAGE ?>/rtr.png" class="face" width="70px">
                                        </div>
                                        <div class="card-details">
                                            <h4>${escapeHTML(child.First_Name)} ${escapeHTML(child.Last_Name)}</h4>
                                            <p>Reg No: SNT110923</p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="<?= ROOT ?>/Teacher/AcademicReport" method="POST">
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
                    $(".mark-form").on("submit", function(e) {
                        e.preventDefault();
                        console.log("Submitting marks...");

                        const form = $(this);
                        const marks = form.find("input[name='Marks']").val();
                        const reportID = form.find("input[name='report_id']").val();

                        console.log(marks, reportID);
                        $.ajax({
                            url: "<?= ROOT ?>/Teacher/Reports/SubmitMarks", // Adjust if needed
                            method: "POST",
                            data: {
                                report_id: reportID,
                                marks: marks
                            },
                            dataType: "json", // ✅ this is the correct one
                            success: function(response) {
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

                            error: function(xhr, status, error) {
                                console.error("❌ AJAX error:", xhr.responseText);
                                alert(response.error);
                            }
                        });
                    });

                    $(document).on('click', '.enter-btn', function() {
                        const btn = $(this);
                        const markSection = btn.closest('.card-content').find('.mark-section');

                        btn.hide(); // Hide the button when clicked
                        markSection.show().addClass('show'); // Show the mark section
                    });

                    $document.on('submit', '.marks-submit', function() {
                        const button = $(this);
                        const markSection = button.closest('.card-content').find('.mark-section');

                        markSection.hide();
                        button.closest('.card-content').find('.enter-btn').hide();
                        button.closest('.card-content').find('.submit-msg').show();

                    })


                },

                error: function(xhr, status, error) {
                    console.log("Server raw output:", xhr.responseText);
                    $('#complete-msg').html('<p>Something went wrong </p>');
                }
            });
        }
    </script>

    <script src="<?= JS ?>/Teacher/script.js"></script>



    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>

</body>

</html>