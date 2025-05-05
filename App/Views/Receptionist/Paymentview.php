<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=CSS?>/Receptionist/PaymentDashboard.css?v=<?= time() ?>">
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
                        Have a nice day
                       </p>
                </div>
               
                <div class="photo2">
                    <img alt="User profile picture" height="50" src="<?=IMAGE?>/female-receptionist-elegant-suit-work-hours.jpg" width="50"/>
                </div>
            </div>
            <div class="detailed_content">
                        <div class="make_background">
                          
                          <div class="payment_table">
                            <div class="table_header">
                                <div class="topic"><span>Payment Details</span></div>
                                
                                <a href="<?=ROOT?>/Receptionist/Payform"><button class="paymentbutton">
                                    Make &nbsp;Payment
                                </button></a>
                            </div>
                            <hr>
                            <div class="table_filters">
                                <div class="search_line">
                                    <form class="field_input2"  method = "POST" action="<?=ROOT?>/Receptionist/Payment/search">
                                        <i class="fas fa-search">
                                        </i>
                                      <input placeholder="Search Index......" type="text" name = "ChildID"/>
                                    </form>
                                 </div>
                                 <form class="date_entry"action="<?=ROOT?>/Receptionist/Payment/search" method="POST">
                                    <input type="date" name="Date" onchange="this.form.submit()"/>
                                </form>
                                 
                            </div>
                            
                            <div class="table_topics">
                                <div class="head reg_id">
                                    <i class="fas fa-id-card" title="Registration ID"></i>
                                    <span>Registration No</span> 
                                </div>
                                <div class="head name">
                                    <i class="fas fa-user" title="Child Name"></i>
                                    <span>Name</span>
                                </div>
                                <div class="head transaction_id">
                                    <i class="fas fa-receipt" title="Transaction ID"></i>
                                    <span>Transaction ID</span>
                                </div>
                                <div class="head amount">
                                    <i class="fas fa-money-bill"></i>
                                    <span>Amount</span>
                                </div>
                                <div class="head date">
                                    <i class="fas fa-calendar-alt" title="Date"></i>
                                    <span>Date</span>
                                </div>
                                <div class="head action">
                                    <i class="fas fa-user" title="Actions"></i>
                                    <span>Action</span>
                                </div>
                            </div>
                            <div class="table_columns">
                            <?php if(!empty($payments)): ?>
                                <?php foreach($payments as $payment): ?>   
                                <div class="table_column">
                                    <div class="colum reg_id">
                                        <span>SROOO<?= htmlspecialchars($payment->ChildID) ?></span> 
                                    </div>
                                    <div class="colum name">
                                        <img alt="card icon" height="30px" src="<?= $payment->Image ?>" width="30px"/>
                                        <span><?= htmlspecialchars($payment->First_Name) ?></span>
                                    </div>
                                    <div class="colum transaction_id">
                                        <span>DC-TXN-<?= htmlspecialchars($payment->PaymentID) ?></span>
                                    </div>
                                    <div class="colum amount">
                                        <span><?= htmlspecialchars($payment->Amount) ?></span>
                                    </div>
                                    <div class="colum date">
                                        <span><?= htmlspecialchars($payment->DateTime) ?></span>
                                    </div>
                                    <form class="colum action" method = "POST" action="<?=ROOT?>/Receptionist/Payment/delpay">
                                       <input type="hidden" name="payment_id" value="<?= htmlspecialchars($payment->PaymentID) ?>">
                                        <button><i class="fas fa-trash"></i>Delete</button>
                                </form>
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
    <script src="<?=JS?>/Receptionist/receptionist_attendance.js"></script>
    <script src="<?=JS?>/Receptionist/test.js"></script>
</body>
</html>