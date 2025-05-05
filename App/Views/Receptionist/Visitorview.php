<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/visitorform.css?v=<?= time() ?>">
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
                       Childhood is a journey, not a race !
                       </p>
                </div>
               
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                          <div class="detail_section">
                            <div class="combine">
                                <div class="card_topic">
                                    <a href="<?=ROOT?>/Receptionist/Visitortable"><span class="head_topic">Visitor Details</span></a>
                                </div>
                                <hr>
                            </div>
                            
                            <div class="rules_regulations">
                                <div class="topic">
                                   <span class="rules_topic">Rules And Regulations</span>
                                </div>
                                <div class="description">
                                   <ul>
                                    <li>All visitors must present valid ID proof at the reception</li>
                                    <li>Complete the visitor entry log with accurate details.</li>
                                    <li>Visits to classrooms or children require prior approval.</li>
                                   </ul>
                                </div>
                            </div>
                            <div class="latest_updates">
                                <div class="last_marked">
                                    <span class="last_marked_topic">Latest Updates</span>
                        <?php if (!empty($visitors)): ?>
                            <?php foreach ($visitors as $visitor): ?>
                                    <div class="lastmarkedchilds">
                                       <div class="name_position_time">
                                           <span class="lastmarkedname"><?= htmlspecialchars($visitor->FirstName) ?></span>
                                           <span class="lastmarkedname"><?= htmlspecialchars($visitor->Role) ?></span>
                                       <span class="lastmarkedtime"><?= htmlspecialchars($visitor->Start_Time) ?></span>
                                       </div>
                                   </div>
                                   <hr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                               </div>
                            </div>
                          </div>
                          
                          <form class="form_section" action = "<?=ROOT?>/Receptionist/Visitor/addvisitor" method="post">
                            <div class="form_topic">
                                <span>Welcome Desk</span>
                            </div>
                            <?php if (!empty($errors)): ?>
                                
                                    <span class="lastmarkedname"><?= htmlspecialchars($errors) ?></span>

                            <?php endif; ?>
                            <div class="form_input_section">
                            <div class="section_main">
                                <div class="section">
                                    <label for="">First Name</label>
                                    <input type="text" name = "FirstName" placeholder="Enter First Name">
                                </div>
                                <div class="section">
                                    <label for="">Last Name</label>
                                    <input type="text" name = "LastName" placeholder="Enter Last Name">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Phone No</label>
                                    <input type="text" name = "Phone_Number" placeholder="Enter Phone No">
                                </div>
                                <div class="section">
                                    <label for="">Email</label>
                                    <input type="text" name = "e_mail" placeholder="Enter E-mail">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Position</label>
                                    <input type="text"name = "Role" placeholder="Enter Position">
                                </div>
                                <div class="section">
                                    <label for="">National_Id</label>
                                    <input type="text" name= "NID" placeholder="Enter National Id">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section purpose">
                                    <label for="">Purpose</label>
                                    <input type="text" name ="Purpose" placeholder="Enter the Purpose">
                                </div>
                            </div>
                            <div class="section_main">
                                <div class="section">
                                    <label for="">Time In</label>
                                    <input type="time" name = "Start_Time">
                                </div>
                                <div class="section">
                                    <label for="">Time-Out</label>
                                    <input type="time" name = "End_Time">
                                </div>
                            </div>
                            </div>
                            <div class="form_button"><button type ="submit">Submit Details</button></div>
</form>
                        </div>
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