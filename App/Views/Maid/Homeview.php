<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Maid/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Maid/dashboard.css?v=<?= time() ?>">
    <link href = "maid_dashboard.css" rel = "stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<title>Maid</title>
</head>
<body>
    <div class="main">
        <div class="side_bar">
        <?php if (!empty($maids)): ?>
            <?php foreach ($maids as $maid): ?>
            <div class="userblock">
                <div class="photo">
                
                    <img alt="User profile picture" height="50" src="<?= $maid->Image ?>" width="50"/>
                    
                </div>
                <div class="username">
                    <h3>
                    <?= htmlspecialchars($maid->First_Name) ?>&nbsp;<?= htmlspecialchars($maid->Last_Name) ?>
                       </h3>
                       <p>
                        Maid
                       </p>
                </div>
            </div>
            <?php endforeach; ?>
                    <?php endif; ?>
            <div class="directions">
                <div class="direction-items">
                <a href=""><div class="dashboard">
                    
                    <i class="fas fa-tachometer-alt">
                    </i>
                    <span>&nbsp;&nbsp; Dashboard</span>
                  
                </div> </a>
                
                 <a href="<?=ROOT?>/Maid/Leaves"><div class="leaves">
                    <i class="fas fa-calendar-check">
                    </i>
                   <span>&nbsp;&nbsp; Leaves</span>
                 </div></a>
                <hr>
                <div class="help">
                    <i class="fas fa-question-circle">
                    </i>
                    <span>&nbsp;&nbsp; Help</span>
                </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="header">
                <div class="header-title">
                    <h2>
                       Hey
                       </h2>
                       <p>
                       "Finding joy in the littlest things !
                       </p>
                </div>
              
                <div class="photo2">
                <?php if (!empty($maids)): ?>
                    <?php foreach ($maids as $maid): ?>
                    <img alt="User profile picture" height="50" src="<?= $maid->Image ?>" width="50"/>
                    <?php endforeach; ?>
                    <?php endif; ?>
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
                                                <img alt="User profile picture" height="35" width="35" src="<?= $child->Image ?>" width="50"/>
                                            </div>
                                            <div class="name">
                                                <span><?= htmlspecialchars($child->First_Name) ?></span>
                                            </div>
                                        </div>
                                       <div class="skill_content">
                                        
                                        <span><?= htmlspecialchars($child->Allergies) ?></span>
                                       </div>
                                       <div class="navigation_button">
                                            <form class="view_profile"method="post" action="<?=ROOT?>/Maid/Home/conditions">
                                                <input type="hidden" name="child_id" value="<?= htmlspecialchars($child->ChildID) ?>">
                                                <button type = "submit">profile</button>
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
                                 
                                 <div class = "activity"><table>
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
                                      <?php if(isset($activity->IsCompleted) && $activity->IsCompleted == 1): ?>
                                        <div class="holder">
                                            <input class="tog-but" type="checkbox" id="check_<?= htmlspecialchars($activity->WorkID) ?>" checked> 
                                            <label for="check_<?= htmlspecialchars($activity->WorkID)?>" class="tog"></label>
                                        </div>   
                                           
                                        <?php else: ?>
                                            <form class="holder" method = "post" action="<?=ROOT?>/Maid/Home/markActivity">
                                                <input class="tog-but" type="checkbox" id="check_<?= htmlspecialchars($activity->WorkID) ?>" value = "<?= htmlspecialchars($activity->WorkID) ?>" name = "work_id" onchange="this.form.submit()"/>
                                                <label for ="check_<?= htmlspecialchars($activity->WorkID)?>" class="tog"></label>
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
            </div>
            
            <!-- <script src="./receptionist_attendance.js"></script>
            <script src = './maid_dashboard_skill.js' ></script> -->
</body>
</html>