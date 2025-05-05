<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/view_viisitors.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/maincss.css?v=<?= time() ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 
<title>Receptionist</title>
</head>
<body>
    <div class="main">
        <div class="side_bar">
            <div class="userblock">
                <div class="photo">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
                <div class="username">
                    <h3>
                        Kayla Wood
                       </h3>
                       <p>
                        Receptionist
                       </p>
                </div>
            </div>
            <div class="directions">
                <div class="direction-items">
                <a href="<?=ROOT?>/Receptionist/Home"><div class="dashboard">
                    
                    <i class="fas fa-tachometer-alt">
                    </i>
                    <span>&nbsp;&nbsp; Dashboard</span>
                  
                </div> </a>
             
                 <a href="<?=ROOT?>/Receptionist/Attendance"><div class="mark_attendance">
                    <i class="fas fa-check-circle">
                    </i>
                   <span>&nbsp;&nbsp; Attendance</span>
                    
                 </div></a>
                 
                 <a href="<?=ROOT?>/Receptionist/Payment"><div class="payment">
                    <i class="fas fa-money-bill-wave">
                    </i>
                    <span>&nbsp;&nbsp; Payment</span>
                </div></a>
                <a href="<?=ROOT?>/Receptionist/Visitor"><div class="visitor">
                    <i class="fas fa-users">
                    </i>
                    <span>&nbsp;&nbsp; visitort</span>
                </div></a>
                <a href="<?=ROOT?>/Receptionist/Leaves"><div class="leaves">
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
                       Little feet leave the biggest footprints on our hearts
                       </p>
                </div>
                
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                            <div class="visitor_table">
                                <div class="table_header">
                                    <div class="topic"><span>Visitor Table</span></div>
                                    
                                    <a href="<?=ROOT?>/Receptionist/Visitor"><div class="paymentbutton">
                                        <span>Back</span>
                                    </div></a>
                                </div>
                                <hr>
                                <div class="table_filters">
                                    <div class="search_line">
                                        <form class="field_input2" action="<?=ROOT?>/Receptionist/Visitortable/search" method="POST">
                                            <i class="fas fa-search">
                                            </i>
                                          <input name = 'NID' placeholder="Search NID......" type="text"/>
                                        </form>
                                     </div>
                                     <form class="date_entry" action="<?=ROOT?>/Receptionist/Visitortable/search" method="POST">
                                        <input name = 'Date' type="date" onchange="this.form.submit()"/>
                                     </form>
                                  
                                </div>
                                <div class="table_topics">
                                    <div class="head name">
                                        <i class="fas fa-user" title="Child Name"></i>
                                        <span>Name</span>
                                    </div>
                                    <div class="head position">
                                        <i class="fas fa-id-card" title="position"></i>
                                        <span>Position</span>
                                    </div>
                                    <div class="head purpose">
                                        <i class="fas fa-clipboard-list"></i>
                                        <span>Purpose</span>
                                    </div>
                                    <div class="head contact">
                                        <i class="fas fa-phone" title="Date"></i>
                                        <span>Contact</span>
                                    </div>
                                    <div class="head view">
                                        <i class="fas fa-eye" title="Actions"></i>
                                        <span>view</span>
                                    </div>
                                </div>
                                <div class="table_columns">
                        <?php if (!empty($visitors)): ?>
                            <?php foreach ($visitors as $visitor): ?>
                              
                                    <div class="table_column">
                                        <div class="colum name">
                                           <span><?= htmlspecialchars($visitor->FirstName) ?></span>
                                        </div>
                                        <div class="colum position">
                                            <span><?= htmlspecialchars($visitor->Role) ?></span>
                                        </div>
                                        <div class="colum purpose">
                                            <span><?= htmlspecialchars($visitor->Purpose) ?></span>
                                        </div>
                                        <div class="colum contact">
                                            <span><?= htmlspecialchars($visitor->Phone_Number) ?></span>
                                        </div>
                                        <div class="colum view">
                                        <form action = "<?=ROOT?>/Receptionist/Individualvisitor" method = "POST">
                                            <input type = "hidden" name = "VisitorID" value = "<?= htmlspecialchars($visitor->VisitorID)?>">   
                                            <button type = "submit">More</button>
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
            </div>
        </div>
            
        </div>
    </div>
    <script src='./test.js' defer></script>
    <script src = './receptionist_attendance.js' defer></script>
</body>
</html>