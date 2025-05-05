<!DOCTYPE html>
<html lang="en">

<head>
<title>Parent</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Account.css?v=<?= time() ?>">
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
                    <a href="<?= ROOT ?>/Manager/Problem"><i class="fa fa-exclamation-triangle"></i>Problems</a>
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
            <p style="color: white;">Let’s do some productive activities today</p>
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
                ID    RS0110657
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
                            <option value="All">All</option>
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

                    use function Controller\adduser;

                    if (!empty($data['allusers'])): ?>
                        <?php foreach ($data['allusers'] as $user): ?>
                            <div class="report-card">
                                <div class="card-content">
                                    <div class="profile-img">
                                        <img src="<?= IMAGE ?>/profilePic.png" class="face" width="70px">
                                    </div>
                                    <div class="card-details">
                                        <h4><?= htmlspecialchars($user->Username); ?></h4>
                                        <p>Email: <?= htmlspecialchars($user->Email); ?></p>
                                        <p>UserID: <?= htmlspecialchars($user->UserID); ?></p>
                                        <p>Role: <?= htmlspecialchars($user->Role); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <button>View</button>
                                        <button class="del">Delete</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No users found matching the criteria.</p>
                    <?php endif; ?>

                </div>
                <!-- <div class="view-user">
                    <h1>Sineth</h1>
                    <img src="<?= IMAGE ?>/profilePic.png" class="face" width="70px">
                    <div class="content">
                        <label for="">User ID : </label>
                        <span>40</span>
                    </div>
                    <div class="content">
                        <label for="">User Role : </label>
                        <span>Teacher</span>
                    </div>
                    <div class="content">
                        <label for="">Name :</label>
                        <span>Sineth</span>
                    </div>
                    <div class="content">
                        <label for="">NIC : </label>
                        <span>200126001978</span>
                    </div>
                    <div class="content">
                        <label for="">Phone number : </label>
                        <span>098765443</span>
                    </div>
                    <div class="content">
                        <label for="">Subject : </label>
                        <span>Maths</span>
                    </div>
                    <div class="content">
                        <label for="">Address : </label>
                        <span>No:3A,Kalubowila,Colombo 7</span>
                    </div>
                </div> -->
                <a href="javascript:void(0);" onclick="togglePopup()" style="margin-left:85%;text-decoration:none;font-size:20px;color:blue">+Add User</a>

                <!-- Overlay -->
                <div class="overlay" id="overlay"></div>

                <!-- Popup Modal -->
                <div class="adduser" id="popup">
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

                                <label for="name" class="labeltag">Username</label>
                                <input type="text" id="name" name="Username" required>

                                <label for="password" class="labeltag">Password</label>
                                <input type="password" id="password" name="Password" required>
                            </div>

                            <button type="submit" class="addbtn">Add User</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        var messageText = "<?= $_SESSION['status'] ?? ''; ?>"
        if (messageText) {
            Swal.fire({
                title: "Thank You",
                text: messageText,
                icon: 'success'
            });
            <?php unset($_SESSION['status']); ?>
        }

        function togglePopup() {
            var overlay = document.getElementById("overlay");
            var popup = document.getElementById("popup");
            var isHidden = overlay.style.display === "none" || overlay.style.display === "";

            if (isHidden) {
                overlay.style.display = "block";
                popup.style.display = "block";
            } else {
                overlay.style.display = "none";
                popup.style.display = "none";
            }
        }

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
            const cardsContainer = document.querySelector('.cards'); // Select the container

            // Clear previous content
            cardsContainer.innerHTML = '';

            if (users.length === 0) {
                cardsContainer.innerHTML = '<p>No users found matching the criteria.</p>';
                return;
            }

            users.forEach(user => {

                const Role = user?.Role === "User" ? "Parent" : user?.Role;
                const cardHTML = `
            <div class="report-card">
                <div class="card-content">
                    <div class="profile-img">
                        <img src="<?= IMAGE ?>/profilePic.png" class="face" width="70px">
                    </div>
                    <div class="card-details">
                        <h4>${user.Username}</h4>
                        <p>UserID: ${user.UserID}</p>
                        <p>Role:${Role}</p>
                    </div>
                    <div class="card-footer">
                        <button onclick="viewUser(${user.UserID})">View</button>
                        <button class="del" onclick="deleteUser(${user.UserID})">Delete</button>
                    </div>
                </div>
            </div>
        `;

                // Append new card to the container
                cardsContainer.innerHTML += cardHTML;
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const rolePicker = document.getElementById('rolefilter');
            const idPicker = document.getElementById('Idpicker');

            fetchProfile('All', null);

            rolePicker.addEventListener('change', function() {
                fetchProfile(rolePicker.value, idPicker.value);
            });

            idPicker.addEventListener('change', function() {
                fetchProfile(rolePicker.value, idPicker.value);
            });
        });
    </script>
</body>

</html>