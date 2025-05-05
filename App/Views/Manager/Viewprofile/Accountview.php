<!DOCTYPE html>
<html lang="en">

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Account.css?v=<?= time() ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="<?= JS ?>/Manager/profileview.js"></script> -->
</head>

<body id="body">
    <div class="sidebar">
        <div class="logo_stuf" style="display: flex;margin-top:6%">
            <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
            <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
        </div>
        <ul style=" margin-top: 10%;">
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Manager/Home" style="font-size: 18px;margin-left:10%;margin-top:-10%;">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <ul>
                <li class="selected">
                    <a href="<?= ROOT ?>/Manager/Viewprofile" style="font-size: 18px;">
                        <i class="fas fa-user-check"></i>Accounts
                    </a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Schedule" style="font-size: 18px;">
                        <i class="fas fa-calendar"></i>Scheduling
                    </a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Packages"><i class="fas fa-box"></i> Packages</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Meeting"><i class="fa fa-exclamation-triangle"></i>Meeting</a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Holiday" style="font-size: 18px;">
                        <i class="fas fa-umbrella-beach"></i> Holiday</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Event" style="font-size: 18px;">
                        <i class="fa fa-calendar-plus"></i>Event</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Foodtable" style="font-size: 18px;">
                        <i class="fa fa-pizza-slice"></i>Food Plane</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Leaverequest" style="font-size: 18px;">
                        <i class="fas fa-hand-paper"></i>Request</a>
                </li>
            </ul>
        </ul>
    </div>
    <div class="header" style="margin-top:-22%">
        <div class="name">
            <h1>Hey Namal</h1>
            <p style="color: white;">Let's do some productive activities today</p>
        </div>
        <div class="profile">
            <button class="profilebtn" onclick="handleClick()">
                <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
            </button>
        </div>
        <div class="profile-card" id="profileCard" style="margin-top: 21%;">
            <button class="back" onclick="handleHide()"><i class="fas fa-chevron-left"></i></button>
            <img alt="Profile picture of Thilina Perera" height="100" src="../Assets/shimhan.jpg" width="100" class="profile" />
            <h2>
                Thilina Perera
            </h2>
            <p>
                ID RS0110657
            </p>
            <button class="profile-button">
                Personal info
            </button>
            <button class="secondary-button">
                Change Password
            </button>
            <button class="logout-button">
                LogOut
            </button>
        </div>
    </div>


    <div class="container" id="container" style="margin-top:22%;margin-left:20.5%;">
        <div style="width: 85%; margin-top:-20%">
            <div class="fill">
                <div style="display: block;">
                    <h3 class="heading">
                        View profiles
                    </h3>
                </div>
                <hr>
                <div class="search-container">
                    <form action="" method="GET">
                        <input type="text"
                            id="Idpicker"
                            name="search_id"
                            placeholder="Search ID"
                            style="padding: 10px 30px;margin-left:-50%">
                        <select name="role" id="rolefilter" style="margin-left:50%">
                            <option value="All" selected>All</option>
                            <option value="User">Parent</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Maid">Maid</option>
                            <option value="Receptionist">Receptionist</option>
                            <option value="Doctor">Doctor</option>
                        </select>
                    </form>
                </div>
                <div class="cards">
                    <?php
                    if (!empty($data['userData'])): ?>
                        <?php foreach ($data['userData'] as $user): ?>
                            <div class="report-card">
                                <div class="card-content">
                                    <div class="profile-img">
                                        <img src="<?= IMAGE ?>/profilePic.png" class="face" width="70px">
                                    </div>
                                    <div class="card-details">
                                        <h4><?= htmlspecialchars($user->Username); ?></h4>
                                        <p>UserID: <?= htmlspecialchars($user->UserID); ?></p>
                                        <p>Role: <?= htmlspecialchars($user->Role); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <!-- <button id="userview" class="view-btn" onclick="viewUser(<?= $user->UserID ?>)">View</button> -->
                                        <button id="blockuser" class="del-btn" onclick="blockUser(<?= $user->UserID ?>)">Block</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No users found matching the criteria.</p>
                    <?php endif; ?>
                </div>

                <a href="#" id="addUserBtn" style="margin-left:85%;text-decoration:none;font-size:20px;color:blue">+Add User</a>

                <!-- Overlay -->
                <div class="overlay" id="overlay" style="display: none;"></div>

                <!-- Popup Modal -->
                <div class="adduser" id="popup" style="display: none;">
                    <div class="popup-content">
                        <span class="close-btn" onclick="togglePopup()">&times;</span>
                        <h2>Add User</h2>
                        <form id="userForm" method="post" action="<?= ROOT ?>/Manager/Viewprofile/adduser">
                            <label for="role" class="labeltag">Select Role:</label>
                            <select id="Role" name="Role" required>
                                <option value="">-- Select --</option>
                                <option value="User ">Parent</option>
                                <option value="Maid">Maid</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Teacher">Teacher</option>
                            </select>

                            <div class="common-fields">
                                <label for="email" class="labeltag">Email : </label>
                                <input type="email" id="email" name="email" required>
                                <p id="emailError" style="color: red; font-size: 12px; display: none;" ></p>

                                <label for="name" class="labeltag">Username</label>
                                <input type="text" id="name" name="Username" required>
                                <p class="error" style="color: red; font-size: 12px; display: none;" id="usererror"></p>

                                <label for="password" class="labeltag">Password</label>
                                <input type="password" id="password" name="Password" required>
                                <p id="passwordError" style="color: red; font-size: 12px; display: none;"></p>

                                <label for="Subject" class="labeltag" id="Subject" style="display: none;">Subject</label>
                                <input type="text" id="SubjectInput" name="Subject" style="display: none;">

                                <label for="Age" class="labeltag" id="AgeLabel" style="display: none;">AgeGroup</label>
                                <select id="Age" name="Age" style="display: none;">
                                    <option value="">-- Select --</option>
                                    <option value="2-3">2-3</option>
                                    <option value="4-5">4-5</option>
                                    <option value="6-7">6-7</option>
                                    <option value="8-9">8-9</option>
                                    </option>
                                    <option value="10-15">10-15</option>
                                </select>

                            </div>

                            <button type="submit" class="addbtn">Add User</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            function fetchProfile(Role, Id) {
                fetch('<?= ROOT ?>/Manager/Viewprofile/store_users', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            role: Role,
                            id: Id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log("Meal plan data:", data.data);
                            updateProfileCards(data.data);
                        } else {
                            console.error("Failed to fetch meal plan:", data.message);
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }

            function updateProfileCards(users) {
                const cardsContainer = document.querySelector('.cards');

                // Clear previous content
                cardsContainer.innerHTML = '';

                if (users.length === 0) {
                    cardsContainer.innerHTML = '<p>No users found matching the criteria.</p>';
                    return;
                }

                let allCardsHTML = '';

                users.forEach(user => {
                    const Role = user?.Role === "User" ? "Parent" : user?.Role;
                    const isBlocked = user.Block == 1; // Check if user is blocked

                    allCardsHTML += `
            <div class="report-card ${isBlocked ? 'blocked-user' : ''}">
                <div class="card-content">
                    <div class="profile-img">
                        <img src="${user.Image}" class="face" width="70px">
                    </div>
                    <div class="card-details">
                        <h4>${user.Username}</h4>
                        <p>UserID: ${user.UserID}</p>
                        <p>Role: ${Role}</p>
                        ${isBlocked ? '<p class="blocked-status">BLOCKED</p>' : ''}
                    </div>
                    <div class="card-footer">
                        ${!isBlocked ? 
                          `<button class="del-btn" onclick="blockUser(${user.UserID})">Block</button>` : 
                          `<button class="unblock-btn" onclick="unblockUser(${user.UserID})">Unblock</button>`
                        }
                    </div>
                </div>
            </div>
        `;
                });

                cardsContainer.innerHTML = allCardsHTML;
            }


            function unblockUser(userId) {
                console.log("Unblocking user with ID:", userId);

                Swal.fire({
                    title: 'Unblock User?',
                    text: "Are you sure you want to unblock this user?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Unblock'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make unblock request
                        fetch(`<?= ROOT ?>/Manager/Viewprofile/unblockuser`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    UserID: userId,
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Unblocked!',
                                        'User has been unblocked.',
                                        'success'
                                    );
                                    // Refresh user list
                                    fetchProfile(document.getElementById('rolefilter').value,
                                        document.getElementById('Idpicker').value);
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message || 'Failed to unblock user.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while unblocking the user.',
                                    'error'
                                );
                            });
                    }
                });
            }

            // Toggle popup function
            function togglePopup() {
                const popup = document.getElementById('popup');
                const overlay = document.getElementById('overlay');

                // Toggle visibility
                if (popup.style.display === 'block') {
                    popup.style.display = 'none';
                    overlay.style.display = 'none';
                } else {
                    popup.style.display = 'block';
                    overlay.style.display = 'block';
                }
            }

            // Handle profile card visibility
            function handleClick() {
                const profileCard = document.getElementById('profileCard');
                profileCard.style.display = 'block';
            }

            function handleHide() {
                const profileCard = document.getElementById('profileCard');
                profileCard.style.display = 'none';
            }

            // Function to view user (replace with your implementation)
            // function viewUser(userId) {
            //     console.log("Viewing user with ID:", userId);
            //     // Implement your view logic here
            //     window.location.href = `<?= ROOT ?>/Manager/Viewprofile/view/${userId}`;
            // }

            // Function to block user
            function blockUser(userId) {
                console.log("Blocking user with ID:", userId);

                Swal.fire({
                    title: 'Block User?',
                    text: "Are you sure you want to Block this user?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'BLock'
                }).then((result) => {
                    console.log("Confirmed");
                    if (result.isConfirmed) {
                        // Make block request
                        fetch(`<?= ROOT ?>/Manager/Viewprofile/blockuser`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    UserID: userId,
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Blocked!',
                                        'User has been Blocked.',
                                        'success'
                                    );
                                    // Refresh user list
                                    fetchProfile(document.getElementById('rolefilter').value,
                                        document.getElementById('Idpicker').value);
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        data.message || 'Failed to block user.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while blocking the user.',
                                    'error'
                                );
                            });
                    }
                });
            }

            document.addEventListener('DOMContentLoaded', function() {

                const passwordInput = document.getElementById('password');
                const passwordError = document.getElementById('passwordError');
                const usererror = document.getElementById('usererror');
                const emailError = document.getElementById('emailError');

                //

                // Password validation regex
                const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

                passwordInput.addEventListener('input', function() {
                    const password = passwordInput.value;

                    const errors = [];

                    if (password.length < 8) {
                        errors.push("• At least 8 characters");
                    }
                    if (!/[A-Z]/.test(password)) {
                        errors.push("• At least one uppercase letter");
                    }
                    if (!/[a-z]/.test(password)) {
                        errors.push("• At least one lowercase letter");
                    }
                    if (!/[0-9]/.test(password)) {
                        errors.push("• At least one number");
                    }
                    if (!/[\W_]/.test(password)) {
                        errors.push("• At least one special character");
                    }

                    if (errors.length > 0) {
                        passwordError.style.display = 'block';
                        passwordError.innerHTML = "Password must include:<br>" + errors.join('<br>');
                    } else {
                        passwordError.style.display = 'none';
                        passwordError.innerHTML = "";
                    }
                });

                const Form = document.getElementById('userForm');

                Form.addEventListener('submit', function(e) {
                    console.log("Submission of form inside function");
                    const password = passwordInput.value;
                    let haserror = false;
                    if (!passwordRegex.test(password)) {
                        e.preventDefault(); // Stop form submission
                        passwordError.textContent = "Please fix your password before submitting.";
                        haserror = true;
                    }
                    if (usererror.style.display === 'block') {
                        e.preventDefault();
                        usererror.textContent = "Please fix your username before submitting.";
                        haserror = true;
                    }
                    console.log(haserror);
                    if (haserror == false) {
                        console.log("Submission of form");
                        Form.submit();
                    }
                });

                const name = document.getElementById('name');

                name.addEventListener('change', handleUsernameChange);

                function handleUsernameChange() {
                    Username = name.value;
                    usererror.style.display = 'none';

                    fetch('<?= ROOT ?>/Manager/Viewprofile/handleusername', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                Username: Username,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log("Username is allowed");
                                usererror.style.display = 'none';
                                usererror.innerHTML = "";
                            } else {
                                usererror.style.display = 'block';
                                usererror.innerHTML = data.message;
                            }
                        })
                        .catch(error => console.error("Error:", error));
                }

                const roleSelect = document.getElementById('Role');
                const AgeLabel = document.getElementById('AgeLabel');
                const SubjectLabel = document.getElementById('Subject');
                const SubjectInput = document.getElementById('SubjectInput');
                const AgeGroup = document.getElementById('Age');

                // Function to handle role changes
                function handleRoleChange() {
                    const selectedRole = roleSelect.value;

                    if (selectedRole === 'Teacher') {
                        AgeGroup.required = false;
                        AgeGroup.style.display = 'none';
                        AgeLabel.style.display = 'none';
                        SubjectInput.required = true;
                        SubjectLabel.style.display = 'block';
                        SubjectInput.style.display = 'block';
                    } else if (selectedRole === 'Maid') {
                        SubjectInput.required = false;
                        AgeLabel.style.display = 'block';
                        SubjectInput.style.display = 'none';
                        AgeGroup.required = true;
                        AgeGroup.style.display = 'block';
                    } else {
                        SubjectInput.required = false;
                        AgeLabel.style.display = 'none';
                        SubjectLabel.style.display = 'none';
                        SubjectInput.style.display = 'none';
                        AgeGroup.required = false;
                        AgeGroup.style.display = 'none';
                    }
                }

                // Attach the listener
                roleSelect.addEventListener('change', handleRoleChange);

                const rolePicker = document.getElementById('rolefilter');
                const idPicker = document.getElementById('Idpicker');
                const addUserBtn = document.getElementById('addUserBtn');

                fetchProfile('All', null);

                rolePicker.addEventListener('change', function() {
                    fetchProfile(rolePicker.value, idPicker.value);
                });

                idPicker.addEventListener('change', function() {
                    fetchProfile(rolePicker.value, idPicker.value);
                });

                // Add event listener for the Add User button
                if (addUserBtn) {
                    addUserBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        togglePopup();
                    });
                }
            });
        </script>
</body>

</html>