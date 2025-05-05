<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/PaymentDashboard.css?v=<?= time() ?>">
   
    <link rel="stylesheet" href="<?=CSS?>/Maid/main.css?v=<?= time() ?>">
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
            <div class="userblock">
                <div class="photo">
                    <img alt="User profile picture" height="50" src="./assets/profilePic.png" width="50"/>
                </div>
                <div class="username">
                    <h3>
                        Kayla Wood
                       </h3>
                       <p>
                        Maid
                       </p>
                </div>
            </div>
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
                        Leaves
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
                    <img alt="User profile picture" height="50" src="./assets/profilePic.png" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                        <div class="payment_table">
                            <div class="table_header">
                                <div class="topic"><span>Leave Details</span></div>
                                
                                <a href="<?=ROOT?>/Maid/Leaveform"><div class="paymentbutton">
                                    <span>Request &nbsp;Leaves</span>
                                </div></a>
                            </div>
                            <hr>
                            <div class="table_filters">
                             
                                 <form class="date_entry" method = 'POST' action="<?=ROOT?>/Maid/Leaves/datefilter">
                                    <input type="date" name="Date" onchange="this.form.submit()"/>
                                </form>
                            </div>
                            <div class="table_topics">
                                <div class="head reg_id">
                                   
                                    <span>Leave Type</span> 
                                </div>
                                <div class="head name">
                                    
                                    <span>Start Date</span>
                                </div>
                                <div class="head transaction_id">
                                    <span>End Date</span>
                                </div>
                                <div class="head amount">
                                   
                                    <span>Duration</span>
                                </div>
                                <div class="head date">
                                   
                                    <span>Status</span>
                                </div>
                                <div class="head action">
                                   
                                    <span>Action</span>
                                </div>
                            </div>
                            <div class="table_columns">        
                            <?php if(!empty($leaves)): ?>
                                <?php foreach($leaves as $leave): ?>   
                                <div class="table_column">
                                    <div class="colum reg_id">
                                        <span><?= htmlspecialchars($leave->Leave_Type) ?></span> 
                                    </div>
                                    <div class="colum name">
                                         <span>&nbsp; <?= htmlspecialchars($leave->Start_Date) ?></span>
                                    </div>
                                    <div class="colum transaction_id">
                                        <span><?= htmlspecialchars($leave->End_Date) ?></span>
                                    </div>
                                    <div class="colum amount">
                                        <span><?= htmlspecialchars($leave->Duration) ?></span>
                                    </div>
                                    <div class="colum date">
                                        <span><?= htmlspecialchars($leave->Status) ?></span>
                                    </div>
                                    <div class="colum action">
                                        <form  method='POST' action="<?=ROOT?>/Maid/Leaveupdate">
                                        <input type='hidden' value='<?= htmlspecialchars($leave->LeaveID) ?>' name = 'leaveid'>
                                        <button><i class="fas fa-edit" type = "submit"></i>Edit</button>
                                        </form>
                                        <form method='POST' action="<?=ROOT?>/Maid/Leaves/delmai">
                                        <input type='hidden' value='<?= htmlspecialchars($leave->LeaveID) ?>' name = 'LeaveID'>
                                        <button><i class="fas fa-trash"></i>Delete</button>
                                        </form>
                                </div>
                                </div>
                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                            </div>
                          
            </div>
        </div>
        
         
        </div>
    </div>
    <script src='./test.js' defer></script>
    <script src = './receptionist_attendance.js' defer></script>
</body>
</html>