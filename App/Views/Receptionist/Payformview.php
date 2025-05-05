<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/do_payment.css?v=<?= time() ?>">
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
                        <span>Dashboard</span>
                      
                    </div> </a>
                     <a href="<?=ROOT?>/Receptionist/Attendance"><div class="mark_attendance">
                        <i class="fas fa-check-circle">
                        </i>
                       <span>Attendance</span>
                        
                     </div></a>
                     
                     <a href="<?=ROOT?>/Receptionist/Payment"><div class="payment">
                        <i class="fas fa-money-bill-wave">
                        </i>
                        <span>Payment</span>
                    </div></a>
                    <a href="<?=ROOT?>/Receptionist/Visitor"><div class="visitor">
                        <i class="fas fa-users">
                        </i>
                        <span>visitort</span>
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
                        <span>Help</span>
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
                       Little hands make the biggest memories !
                       </p>
                </div>
           
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                            <div class="wholeform">
                                <div class="head_topic">
                                    <span class="topic">Payment</span>
                                </div>
                                <hr>
                                <div class="mini_header">
                                    <span class="enter_index">Registration Number</span>
                                </div>
                                <form class="input_button" method="POST" action = "<?=ROOT?>/Receptionist/Payform">
                                    <input type="text" class="index_input" placeholder="Registration No" name="reg_no"/>
                                    <button class="apply" type="submit">PROCEED</button>
                                </form>
                                <div class="hidden_details">
                                    <div class="details">
                                        <span class="head">User Details</span>
                                        <hr>
                                        <div class="row_value">
                                            <span class="tag">Reg No</span>
                                            <span class="value">#005</span>
                                        </div>
                                        <div class="row_value">
                                            <span class="tag">Name</span>
                                            <span class="value">Thilina Perera</span>
                                        </div>
                                        <div class="row_value">
                                            <span class="tag">age Group</span>
                                            <span class="value">6-9</span>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <span class="head">Expences for child</span>
                                        <hr>
                                <?php if(!empty($payments)): ?>       
                                    <?php foreach($payments as $payment): ?>    
                                        <div class="row_value">
                                            <span class="tag"><?= htmlspecialchars($payment->Description) ?></span>
                                            <span class="value"><?= htmlspecialchars($payment->Amount) ?></span>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>   
                                    <button class="submit">Submit Payment</button>
                                </div>
                                
                                   
                            </div>
                            <div class="popup_section">
                                <div class="icon_section">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="success_header">
                                    <span>SUCCESS!</span>
                                </div>
                                <div class="description">
                                    <p>Your payment is recorded</p>
                                </div>
                                <a href="<?=ROOT?>/Receptionist/Payment"><div class="button">
                                    <button class="popup_close">Okay</button>
                                </div></a>
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
    <script src="<?=JS?>/Receptionist/receptionist_attendance.js"></script>
    <script src="<?=JS?>/Receptionist/test.js"></script>
    <script src="<?=JS?>/Receptionist/do_payments.js"></script>
</body>
</html>