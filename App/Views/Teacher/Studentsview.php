<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <title>Teacher</title>
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
                    <li class="selected">
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
            <!-- ****** skill score popup *******-->
            <div class="skill-popup-container" id="skill-popup-container">
                <div class="card">
                    <form action="<?= ROOT ?>/Teacher/Students/addSkill" method="POST">
                        <h2>Skill Observation: Jane Doe</h2>
                        <input type="hidden" name="ChildID" id="id-input" />
                        <hr>
                        <div class="skill-row">
                            <label for="teamwork">Cognitive</label>
                            <select name="Cognitive" id="teamwork">
                                <option disabled selected value="">Rate</option>
                                <option value="1">🌱 Beginner</option>
                                <option value="2">🌿 Developing</option>
                                <option value="3">🌳 Mastered</option>
                            </select>
                        </div>
                        <div class="skill-row">
                            <label for="communication">Communication</label>
                            <select name="Communicaiton" id="communication">
                                <option disabled selected value="">Rate</option>
                                <option value="1">🌱 Beginner</option>
                                <option value="2">🌿 Developing</option>
                                <option value="3">🌳 Mastered</option>
                            </select>
                        </div>
                        <div class="skill-row">
                            <label for="critical_thinking">Critical Thinking</label>
                            <select name="Critical Thinking" id="critical_thinking">
                                <option disabled selected value="">Rate</option>
                                <option value="1">🌱 Beginner</option>
                                <option value="2">🌿 Developing</option>
                                <option value="3">🌳 Mastered</option>
                            </select>
                        </div>
                        <div class="skill-row">
                            <label for="emotional_control">Emotional Control</label>
                            <select name="Emotional Control" id="emotional_control">
                                <option disabled selected value="">Rate</option>
                                <option value="1">🌱 Beginner</option>
                                <option value="2">🌿 Developing</option>
                                <option value="3">🌳 Mastered</option>
                            </select>
                        </div>
                        <div class="skill-row">
                            <label for="self_care">Creativity</label>
                            <select name="Creativity" id="self_care">
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
                    <div class="bell-con" id="bell-container" style="cursor: pointer;flex-grow: 0;">
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

                <div class="backgorund-overlay"></div>
                <div class="profile-page" style="height: 100%; margin-top: 100px;">
                    <div class="profile-page-header">
                        <i class="fa-regular fa-circle-user"></i>
                        <h3>Student Profiles</h3>

                    </div>
                    <hr>
                    <div class="filter-group">

                        <input type="text" name="stu_name" placeholder="Search Name..." id="stu_name">
                        <!--                    
                    <label for="date">Age Group</label>
                    <form id="ageForm" action="<?= ROOT ?>/Teacher/Students/selectbyAge" method="POST">
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

                            <?php foreach ($errors as $error): ?>
                                <p>
                                    <li><?= $error ?></li>
                                </p>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>


                    <div class="student-table" id="student-table" style="flex: 1;">
                        <div class="student-table-title" style="max-height:50px; flex: 1;">
                            <h4>Reg NO</h4>
                            <h4>Full Name</h4>
                            <h4>Age</h4>
                            <h4>Skill Score</h4>
                        </div>

                        <!-- This will dynamically display students -->
                        <div id="students-container" style="max-height: 360px; overflow-y: auto;scrollbar-width: none; flex:1; border-top: 1px solid #dcdcdc; flex: 1;">
                            <?php if (isset($message)): ?>
                                <div class="success-message" style="flex: 1;">
                                    <p><?= $message ?></p>
                                </div>
                            <?php endif; ?>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= JS ?>/Teacher/skills.js"></script>
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

        // 👇 Main function to fetch and render students
        function fetchStudents(stu_name = '') {
            $.ajax({
                url: "<?= ROOT ?>/Teacher/Students",
                method: "POST",
                data: {
                    action: 'SearchRecord',
                    stu_name: stu_name
                },
                success: function(data) {
                    console.log("Got students:", data.students);
                    let container = $('#students-container');
                    container.empty(); // Clear existing content

                    if (data.students && data.students.length > 0) {
                        data.students.forEach(function(student) {
                            let studentRow = `
                        <div class="student-row" style="flex: 1;">
                            <p class="row-items" style="flex: 1;">${escapeHTML(student.ChildID)}</p>
                            <p class="row-items" style="flex: 1;">${escapeHTML(student.First_Name)} ${escapeHTML(student.Last_Name)}</p>
                            <p class="row-items" style="flex: 1;">${escapeHTML(student.DOB)}</p>
                            <div class="marks" style="flex: 1;">
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



        $(document).ready(function() {
            // 🔄 Fetch all students when the page loads
            fetchStudents();

            // 🔍 Trigger search on keyup
            $('#stu_name').on('keyup', function() {
                let stu_name = $(this).val();
                fetchStudents(stu_name);
            });
        });
    </script>

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>

</html>