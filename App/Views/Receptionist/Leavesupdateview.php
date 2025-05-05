<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Maid/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Maid/studenprofile.css?v=<?= time() ?>">
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
                    <img alt="User profile picture" height="50" src="./assets/profilePic.png" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                            
                            <div class="second-content">
                                <form class="container_3" method = "POST" action = "<?=ROOT?>/Maid/Leaveform/RequestLeave">
                                    <div class="form-head">
                                        
                                        <span>Request Leave</span>
                                    </div>
                                    <div class="form-group-date">
                                        <label for="date">Start Date</label>
                                        <div class="date_entry">
                                            <input type="date" name="Start_Date"/>
                                         </div>
                                    </div>
                                    <div class="form-group-date">
                                        <label for="date">End Date</label>
                                        <div class="date_entry">
                                            <input type="date" name = "End_Date"/>
                                         </div>
                                    </div>
                                
                                    <div class="form-group-option">
                                        <label for="type">Request Types</label>
                                        <select id="type" name = "Leave_Type">
                                            <option value="Annual Leave">Annual Leave</option>
                                            <option value="Sick Leave">Sick Leave</option>
                                            <option value="Compassionate">Compassionate</option>
                                        </select>  
                                    </div>
                                    <div class="form-group-desp">
                                        <label for="description">Description</label>
                                        <textarea id="description" placeholder="Details about behavioutal condition" name= "Description"></textarea>
                                    </div>
                                  
                                    <div class="buttons">
                                        <button class="submt_butto" type = "submit">Request</button>
                                    </div>
                                </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
</body>
</html>