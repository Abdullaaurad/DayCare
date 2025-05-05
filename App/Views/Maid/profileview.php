<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Maid/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Maid/profile.css?v=<?= time() ?>">
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
                <a href="<?=ROOT?>/Maid/Home"><div class="dashboard">
                    
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
                       Child Profile
                       </h2>
                       <p>
                        12/08/2025
                       </p>
                </div>
                <div class="field_input">
                    <i class="fas fa-search">
                    </i>
                  <input placeholder="Search" type="text"/>
                </div>
                <div class="subscription">
                    <i class="fas fa-bell"></i>
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
                            
                            <div class="second-content">
                                <form class="container_3" method= "POST" action = "<?=ROOT?>/Maid/Profile/condi">
                                <?php if (!empty($children)): ?>
                                    <?php foreach ($children as $child): ?>
                                    <div class="form-head">
                                        
                                        <span>Special Behaviour</span>
                                    </div>
                                    <div class="form-group-date">
                                        <label for="date">Registration No</label>
                                        <div class="date_entry">
                                            <span><?= htmlspecialchars($child->ChildID) ?></span>
                                         </div>
                                    </div>
                                
                                    <div class="form-group-option">
                                        <label for="type">Name</label>                                        
                                          <span><?= htmlspecialchars($child->First_Name) ?></span>                                         
                                    </div>
                                    <div class="form-group-desp">
                                    <label for="description">Description</label>
                                        <input type="hidden" name="child_id" value = "<?= htmlspecialchars($child->ChildID) ?>">
                                        <textarea id="description" placeholder="Details about the behavioural condition" name = "description"></textarea>
                                    </div>
                                    <div class="buttons">
                                        <button class="submt_butto" type="submit">Submit</button>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </form>
                                    
                                <form class="container_4" method= "POST" action = "<?=ROOT?>/Maid/Profile/cond">
                                <?php if (!empty($children)): ?>
                                    <?php foreach ($children as $child): ?>
                                    <div class="form-head">
                                        <span>Medical Conditions</span>
                                    </div>
                                    <div class="form-group-date">
                                    <label for="date">Registration No</label>
                                        <div class="date_entry">
                                            <span><?= htmlspecialchars($child->ChildID) ?></span>
                                         </div>
                                    </div>
                                    <div class="form-group-option">
                                        <label for="type">Name</label>                                        
                                        <span><?= htmlspecialchars($child->First_Name) ?></span>  
                                    </div>
                                    <div class="form-group-desp">
                                        <label for="description">Description</label>
                                        <input type="hidden" name="child_id" value = "<?= htmlspecialchars($child->ChildID) ?>">
                                        <textarea id="description" placeholder="Details about the medical condition" name = "description"></textarea>
                                    </div>
                                    <div class="buttons">
                                        <button class="submt_butto" type = submit>Submit</button>
                                    </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="./receptionist_attendance.js"></script>
            <script src = './maid_dashboard_skill.js' ></script>
            <script src = './studenprofile.js'></script>
</body>
</html>