<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/Dashboard.css?v=<?= time() ?>">
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
                    <a href="Dashboard.Html"><div class="dashboard">
                    
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
                    <h2 style="font-size: 24px;">
                        Hey
                       </h2>
                       <p >
                        Start your day happy with little ones !
                       </p>
                </div>
               
                <div class="subscription">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                <div class="main-contents">
                    <div class="navigation-card-content">
                        <div class="card">
                        <span class="card-topic"><i class="fas fa-clipboard-check" title="Mark Attendance"></i>&nbsp; Attendance</span>    
                        <span class="mini-topic">Present Count</span>  
                        <div class="count-percentage">
                            <span class="count">35</span>
                            <span class="percentage1">Absent 42.66&#37</span>
                        </div>

                        </div>
                        <div class="card">
                            <span class="card-topic"><i class="fas fa-calendar-plus" title="Mark Attendance"></i>&nbsp; Resevation</span>    
                            <span class="mini-topic">Available Slots</span>  
                            <div class="count-percentage">
                                <span class="count">15</span>
                                <span class="percentage">Availbale Slots 42.66&#37</span>
                            </div>
    
                        </div>
                        <div class="card">
                            <span class="card-topic"><i class="fas fa-credit-card" title="Mark Attendance"></i>&nbsp; Payment</span>    
                            <span class="mini-topic">Confirmed Enrollments</span>  
                            <div class="count-percentage">
                                <span class="count">35</span>
                                <span class="percentage1">Payment Due 42.66&#37</span>
                            </div>
    
                        </div>
                    </div>
                    <div class="other_details">
                        <div class="att_percentage">
                            <div class="percentage_header">
                                <span ><i class="fas fa-clipboard-check" title="Mark Attendance"></i>&nbsp; Today Attendance</span>
                                <div class="select_age">
                                    <div class="select-agegroup">
                                        <div class="select">
                                            <span>Age Group</span>
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div class="option-list">
                                            <div class="option">Age 2-5</div>
                                            <div class="option">Age 6-9</div>
                                            <div class="option">Age 10-13</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="detailed_part">
                                <div class="in-students">
                                    <div class="in-students1">
                                        <div></div>
                                        <span>Present</span>
                                    </div>
                                    
                                    <span class="att-number">45</span>
                                </div>
                                <div class="out-students">
                                    <div class="out-students1">
                                        <div></div>
                                        <span>Absent</span>
                                    </div>                              
                                    <span class="att-number">15</span>
                                </div>
                                
                            </div>
                            <div class="graphcontainer"><canvas id="piechart" class="animatepiechart" width="300" height="300" style="display: flex; justify-content: center; align-items: center;">
                            </canvas></div>
                            
                        </div>
                        <div class="today_visitors">
                            <div class="today_visitors_header">
                                <span ><i class="fas fa-door-open"></i>&nbsp; Today Visitors</span>
                            </div>
                            <div class="visitor-table-topics">
                                <div class="visitorname">
                                    <span>NAME</span>
                                </div>
                                <div class="visitorposition">
                                    <span>POSITION</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>PURPOSE</span>
                                </div>
                            </div>
                            
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Lisa Johnson</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Delivery Personnel</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>Delivering supplies</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Dr. Emily Brown</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Pediatrician</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>	Conducting health check-ups</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Mike Davis</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Maintenance Staff</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>Fixing daycare equipment</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Sarah Wilson</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Government Inspector</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>Regular compliance inspection</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Jessica Lee</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Photographer</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>Capturing daycare event photos</span>
                                </div>
                            </div>
                            <hr>
                            <div class="detailed-lines">
                                <div class="visitorname">
                                    <span>Steve Martin</span>
                                </div>
                                <div class="visitorposition">
                                    <span>Consultant</span>
                                </div>
                                <div class="visitorpurpose">
                                    <span>Training daycare staff</span>
                                </div>
                            </div>
                            <hr>
                            </div>    
                        </div>
                    </div>
                </div>    
            </div>
            </div>
        </div>
            
        </div>
    </div>
    <script src="<?=JS?>/Receptionist/Dashboard.js"></script>
    <script src="<?=JS?>/Receptionist/test.js"></script>
    <script src="<?=JS?>/Receptionist/receptionist_attendance.js"></script>
</body>
</html>