<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= CSS ?>/Maid/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Maid/dashboard.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link href="maid_dashboard.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <title>Maid</title>
</head>

<body>
    <div class="main">
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
                    <a href="<?= ROOT ?>/Maid/Home">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Maid/Inventory">
                        <i class="fas fa-boxes"></i> <span>Inventory</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Maid/Leaves">
                        <i class="fas fa-utensils"></i> <span>Leave</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <div class="header">
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
            <div class="detailed_content">
                <div class="make_background">
                    <div class="group">
                        <div class="group_topic">
                            <span class="header_topic">Group Members</span>
                        </div>
                        <div class="table_topic">
                            <div class="child_topic">
                                <span>Child</span>
                            </div>
                            <div class="skill">
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alergies</span>
                            </div>
                            <div class="profile">
                                <span>Profile</span>
                            </div>
                        </div>
                        <div class="members">
                            <?php if (!empty($children)): ?>
                                <?php foreach ($children as $child): ?>
                                    <div class="member">
                                        <div class="child_row">
                                            <div class="photo_child">
                                                <img alt="User profile picture" height="35" width="35" src="<?= $child->Image ?>" width="50" />
                                            </div>
                                            <div class="name">
                                                <span><?= htmlspecialchars($child->First_Name) ?></span>
                                            </div>
                                        </div>
                                        <div class="skill_content">

                                            <span><?= htmlspecialchars($child->Allergies) ?></span>
                                        </div>
                                        <div class="navigation_button">
                                            <form class="view_profile" method="post" action="<?= ROOT ?>/Maid/Home/conditions">
                                                <input type="hidden" name="child_id" value="<?= htmlspecialchars($child->ChildID) ?>">
                                                <button type="submit">profile</button>
                                            </form>
                                        </div>

                                    </div>
                                    <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>


                        </div>
                    </div>


                    <div class="schedule">
                        <h3>
                            Activity Schedule
                        </h3>

                        <div class="activity">
                            <table>
                                <tr>
                                    <th>
                                        Hours
                                    </th>
                                    <th>
                                        Activity
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                                <?php if (!empty($activities)): ?>
                                    <?php foreach ($activities as $activity): ?>
                                        <tr>
                                            <td>
                                                <?= htmlspecialchars($activity->Start_Time) ?> - <?= htmlspecialchars($activity->End_Time) ?>
                                            </td>
                                            <td>
                                                <?= htmlspecialchars($activity->Activity) ?>
                                            </td>
                                            <td>
                                                <?php if (isset($activity->IsCompleted) && $activity->IsCompleted == 1): ?>
                                                    <div class="holder">
                                                        <input class="tog-but" type="checkbox" id="check_<?= htmlspecialchars($activity->WorkID) ?>" checked>
                                                        <label for="check_<?= htmlspecialchars($activity->WorkID) ?>" class="tog"></label>
                                                    </div>

                                                <?php else: ?>
                                                    <form class="holder" method="post" action="<?= ROOT ?>/Maid/Home/markActivity">
                                                        <input class="tog-but" type="checkbox" id="check_<?= htmlspecialchars($activity->WorkID) ?>" value="<?= htmlspecialchars($activity->WorkID) ?>" name="work_id" onchange="this.form.submit()" />
                                                        <label for="check_<?= htmlspecialchars($activity->WorkID) ?>" class="tog"></label>
                                                    </form>
                                                <?php endif; ?>


                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000;">
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

</body>
<script>
    function logoutUser() {
        fetch("<?= ROOT ?>/Maid/Home/Logout", {
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
</script>

</html>