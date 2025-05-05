<html>

<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Schedule.css?v=<?= time() ?>" />
    <link rel="icon" href="<?= CSS ?>/Manager/KIDDOVILLE_LOGO.jpg">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Dashboard.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Account.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Manage-problem.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Manager/profileview.js"></script>
</head>

<body id="body">
    <div class="sidebar">
        <div class="logo_stuf" style="display: flex;margin-top:6%">
            <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
            <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
        </div>
        <ul>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Manager/Home" style="font-size: 18px;margin-left:10%;margin-top:-10%;">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <ul>
                <li class="hover-effect unselected">
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
    <div class="header" style="margin-top:-1%">
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
        <div class="fill">
            <h1 style="color:#233E8D;font-size:24px;margin-left:8%;"><i class="fas fa-exclamation-circle"></i>
                Manage Problems</h1>
            <hr>
            <div class="filter-container">
                <select id="problem-type">
                    <option value="" disabled selected>Select problem type</option>
                    <option value="Maid-Issue">Maid Issue</option>
                    <option value="Meal-Issue">Meal Issue</option>
                    <option value="Refund-Issue">Refund Issue</option>
                    <option value="Medical-Issue">Medical Issue</option>
                </select>
            </div>
            <div class="problem-list">
                <div class="problem-item">
                    <div class="details">
                        <h3>
                            Maid issue
                        </h3>
                        <p>
                            As a concerned parent, I've noticed issues with the maids at the daycare, including inconsistent
                            attendance, lack of proper training in child care, and challenges in maintaining hygiene and safety.
                        </p>
                        <div class="date">
                            12/08/2024
                        </div>
                    </div>
                    <div class="actions">
                        <div class="profile">
                            <img alt="Profile picture of Muhammad Alshamman" height="50" src="<?= IMAGE ?>/profilePic.png"
                                width="70" />
                            <span class="user-name">
                                Muhammad Alshamman
                            </span>
                        </div>
                        <a class="add-solution" href="<?= ROOT ?>/Manager/Problem/solution">
                            +add solution
                        </a>
                    </div>
                </div>
                <div class="problem-item">
                    <div class="details">
                        <h3>
                            Meal issue
                        </h3>
                        <p>
                            As a parent, I'm concerned about the meal quality at the daycare. The portions are often small, the food
                            lacks variety, and sometimes it is not served fresh, affecting my child's nutrition.
                        </p>
                        <div class="date">
                            10/08/2024
                        </div>
                    </div>
                    <div class="actions">
                        <div class="profile">
                            <img alt="Profile picture of Abdullah Qureshi" height="50" src="<?= IMAGE ?>/profilePic.png" width="50" />
                            <span class="user-name">
                                Abdullah Qureshi
                            </span>
                        </div>
                        <a class="add-solution" href="<?= ROOT ?>/Manager/Problem/solution">
                            +add solution
                        </a>
                    </div>
                </div>
                <div class="problem-item">
                    <div class="details">
                        <h3>
                            Refunding issue
                        </h3>
                        <p>
                            There have been recurring issues with processing refunds, leading to delays and frustration for parents.
                            This matter needs prompt attention to improve our service.
                        </p>
                        <div class="date">
                            07/08/2024
                        </div>
                    </div>
                    <div class="actions">
                        <div class="profile">
                            <img alt="Profile picture of Hannah Jacob" height="50" src="<?= IMAGE ?>/profilePic.png" width="50" />
                            <span class="user-name">
                                Hannah Jacob
                            </span>
                        </div>
                        <a class="add-solution" href="<?= ROOT ?>/Manager/Problem/solution">
                            +add solution
                        </a>
                    </div>
                </div>
                <div class="problem-item">
                    <div class="details">
                        <h3>
                            Medical issue
                        </h3>
                        <p>
                            There have been recurring issues with accessing child medical histories due to the system not loading
                            properly. This problem needs urgent attention to ensure reliable access to patient records.
                        </p>
                        <div class="date">
                            28/07/2024
                        </div>
                    </div>
                    <div class="actions">
                        <div class="profile">
                            <img alt="Profile picture of Muhammad Ewais" height="50" src="<?= IMAGE ?>/profilePic.png" width="50" />
                            <span class="user-name">
                                Muhammad Ewais
                            </span>
                        </div>
                        <a class="add-solution" href="<?= ROOT ?>/Manager/Problem/solution">
                            +add solution
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function resetSelects() {
            // Select all <select> elements within both tables
            const selects = document.querySelectorAll("#foodtable select, #snacktable select");
            // Reset each <select> to its default (first) option
            selects.forEach(select => select.selectedIndex = 0);
        }

        function handleClick() {
            var profileCard = document.getElementById('profileCard');
            profileCard.classList.toggle('show');
        }

        function handleHide() {
            var profileCard = document.getElementById('profileCard');
            profileCard.classList.remove('show');
        }

        function handlenotify() {
            var messageDropdown = document.getElementById('notification');
            messageDropdown.classList.toggle('show');
        }
        const today = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }; // Customize date format

        // Format and display the date
        document.getElementById("current-date").textContent = today.toLocaleDateString(undefined, options);
    </script>
</body>

</html>