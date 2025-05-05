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
<style>
       
        
        .error-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 550px;
            width: 100%;
            text-align: center;
        }
        
        .error-icon {
            width: 80px;
            height: 80px;
            background-color: #ffebee;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 24px;
        }
        
        .error-icon svg {
            width: 40px;
            height: 40px;
            fill: #f44336;
        }
        
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 16px;
        }
        
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 32px;
        }
        
        .issue-list {
            background-color: #f9f9f9;
            border-radius: 6px;
            padding: 16px 24px;
            text-align: left;
            margin-bottom: 32px;
        }
        
        .issue-list li {
            margin: 8px 0;
            color: #555;
        }
        
        .try-again-btn {
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 32px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-block;
            text-decoration: none;
        }
        
        .try-again-btn:hover {
            background-color: #3367d6;
        }
        
        @media (max-width: 480px) {
            .error-container {
                padding: 24px;
            }
            
            h1 {
                font-size: 24px;
            }
        }
    </style>
    <title>Document</title>
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
                       <p style = "color:#fff;">
                       Tiny moments, endless joy !
                       </p>
                </div>
                
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                        <div class="error-container">
        <div class="error-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
            </svg>
        </div>
        
        <h1>Invalid Visitor Details</h1>
        
        <p>We couldn't process your information due to some invalid entries. Please check the following issues and try again:</p>
        
        <ul class="issue-list">
            <li>Email address appears to be incorrect</li>
            <li>Phone number format is invalid</li>
            <li>Required fields are missing</li>
        </ul>
        
        <a href="<?=ROOT?>/Receptionist/Visitor" class="try-again-btn">Try Again</a>
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