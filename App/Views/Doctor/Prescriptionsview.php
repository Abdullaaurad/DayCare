<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="<?=CSS?>/Doctor/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/pres.css?v=<?= time() ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!--Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar">
                <div class="sidebar-header">
                  <?php if(isset($doctor)) :?>
                    <img src="<?=$doctor['image']?>" alt="profile-pic">
                    <div class="sidebar-header-content">
                        <h3><?=$doctor['Name']?></h3>
                        <h4>Doctor</h4>
                    </div>
                </div>
                <div class="sidebar-list">
                    <a href="<?=ROOT?>/Doctor/Dashboard" class="sidebar-list-item" id="dashboard-link"> 
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                    
                    <!-- <a href="<?=ROOT?>/Doctor/Prescriptions" class="sidebar-list-item" id="report-link">
                        <i class='bx bxs-report' ></i>
                        <span class="text"> Prescriptions </span>
                    </a> -->
                    <a href="<?=ROOT?>/Doctor/History" class="sidebar-list-item" id="students-link">
                    <i class='bx bxs-report' ></i>   
                    <span class="text">Prescriptions</span>
                    </a>
                
        
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

            <div class="navabr">
                <div class="navbar-left">
                    <a href="#"><h2>Dashboard</h2></a>
                    <h4><?=$doctor['date'] ?></h3>
                </div>
                <div class="navbar-right">
               
               
                <a href="#" class="profile">
                    <img src="<?=$doctor['image']?>"  onclick="toggleMenu()" id="profileIcon" height="50px">
                </a>
                </div>
    
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                        <img src="<?=$doctor['image']?>">
                            <h3><?=$doctor['Name']?></h3>
                        </div>
                        <hr>
                    <?php endif; ?>
                        <a href="teacherViewprofile.html" class="sub-menu-link">
                            <i class='bx bx-edit'></i>
                            <p>View Profile</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <i class='bx bx-help-circle' ></i>
                            <p>Help & Support</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                            <i class='bx bx-log-out'></i>
                            <p>Logout</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
                <div class="notify-menu" id="notify">
                    <div class="notify">
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Leave request approved</h5>
                                <p >05.33 22 Jul</p>
                            </div>
                           
                        </a>
                        <hr>
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Parents meeting</h5>
                                <p >05.33 22 Jul</p>
                            </div>
                        </a>
                        <hr>
                        <a href="#" class="notify-info">
                            <i class='bx bx-message-square-detail'></i>
                            <div class="msg-info">
                                <h4>New Notification</h4>
                                <h5>Reports have been updated</h5>
                                <p>05.33 22 Jul</p>
                            </div>
                        </a>
                        
                    </div>
                </div> 
    
            </div>
        <div class="content">
            <div class="backgorund-overlay"></div>
            <div class="press-page">
                <div class="form-container">
                    <form class="prescription-form" >
                    <?php if(isset($child)): ?>
                      <div class="form-section child-details">
                        <h2>Child's Details</h2>
                        <div class="form-group">
                          <label for="child-name">Child Name</label>
                         
                            <p><?=$child->First_Name?> <?=$child->Last_Name?></p>
                        
                        </div>
                        
                        <div class="form-group">
                          <label for="dob">Date of Birth</label>
                         <p><?=$child->DOB?></p>
                        </div>
                        
                        <div class="form-group">
                          <label for="guardian-name">Parent Name</label>
                          <p><?=$child->ParentName?></p>
                        </div>
                        <div class="form-group">
                          <label for="contact">Contact Number</label>
                          <p><?=$child->Contact?></p>
                        </div>
                        <div class="form-group">
                          <label for="prev-medics">Previous Medical Conditions</label>
                          <?php if(empty($child->Medicals)): ?>
                            <p>None</p>
                          <?php else: ?>
                          <?php foreach($child->Medicals as $medical): ?>
                          <li><?=$medical['name'] ?></li>
                          <?php endforeach; ?>
                          <?php endif; ?>
                      </div>
                      <div class="form-group docs">
                          <label for="prev-docs">Previous Medical Documents</label>
                          <?php if(empty($child->Images)): ?>
                            <p>None</p>
                          <?php else: ?>
                          <?php foreach($child->Images as $img): ?>
                            <!-- <img src="<?=ROOT?>/Doctor/Prescriptions/getImage?id=<?= $img['id'] ?>" width="100px" height="100px">
                            <br> -->
                            <!-- Download button -->
                            <li><a href="<?=ROOT?>/Doctor/Prescriptions/getImage?id=<?= $img['id'] ?>" class="btn btn-sm btn-primary" download>Download</a></li>
                          <?php endforeach; ?>
                          <?php endif; ?>
                      </div>
                      </div>
                      </form>
                      
                      <form action="<?=ROOT?>/Doctor/Prescriptions/addPrescription" method="POST" class="prescription-form" id="prescription-form" > 
                      <?php if(isset($child)): ?>
                        <input type="text" name="AppointmentID" value="<?=$child->SlotID?>" hidden >
                        <?php endif; ?>
                      <div class="form-section prescription-details">
                        <h2>Prescription Details</h2>
                        <div class="form-group">
                          <label for="medication-name">Medication Name</label>
                          <input type="text" id="medication-name" name="Medication_Name" placeholder="Enter medication name" >
                          <span id="medication-name-error" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                          <label for="dosage">Dosage</label>
                          <input type="text" id="dosage" name="Dosage" placeholder="Enter dosage (e.g., 5 ml)" >
                          <span id="dosage-name-error" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                          <label for="frequency">Frequency</label>
                          <input type="text" id="frequency" name="Frequency" placeholder="Enter frequency (e.g., Twice a day)" >
                          <span id="freq-name-error" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                          <label for="route">Route of Administration</label>
                          <select id="route" name="Route_of_Administration" >
                            <option value="oral">Oral</option>
                            <option value="topical">Topical</option>
                            <option value="inhalation">Inhalation</option>
                            <option value="other">Other</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="start-date">Start Date</label>
                          <input type="date" id="start-date" name="Issued_At" >
                          <span id="start-date-error" style="color: red;"></span>
                        </div>
                        <div class="form-group">
                          <label for="end-date">End Date</label>
                          <input type="date" id="end-date" name="endDate" >
                          <span id="end-date-error" style="color: red;"></span>
                        </div>
                      </div>
                    
                      <div class="form-buttons">
                        <button type="submit" class="submit-btn">Submit</button>
                        <button type="reset" class="reset-btn">Reset</button>
                      </div>

                      

                      <?php endif; ?> 
                    </form>
                  </div>
                
                
                
                  
            </div>
         
       
            
        </div>
    </div>
    </div>

   
    
     <script src="<?=JS?>/Doctor/pres.js"> </script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
    
</body>
</html>





































<!--
<div class="form-container">
    <form class="prescription-form">
       Left Side: Child's Details 
      <div class="form-section child-details">
        <h2>Child's Details</h2>
        <div class="form-group">
          <label for="child-name">Child's Name</label>
          <input type="text" id="child-name" name="childName" placeholder="Enter child's name" required>
        </div>
        <div class="form-group">
          <label for="dob">Date of Birth</label>
          <input type="date" id="dob" name="dob" required>
        </div>
        <div class="form-group">
          <label for="class">Class/Group</label>
          <input type="text" id="class" name="class" placeholder="Enter class/group name" required>
        </div>
        <div class="form-group">
          <label for="guardian-name">Parent/Guardian Name</label>
          <input type="text" id="guardian-name" name="guardianName" placeholder="Enter guardian's name" required>
        </div>
        <div class="form-group">
          <label for="contact">Contact Number</label>
          <input type="tel" id="contact" name="contact" placeholder="Enter contact number" required>
        </div>
      </div>

      <!-- Right Side: Prescription Details 
      <div class="form-section prescription-details">
        <h2>Prescription Details</h2>
        <div class="form-group">
          <label for="medication-name">Medication Name</label>
          <input type="text" id="medication-name" name="medicationName" placeholder="Enter medication name" required>
        </div>
        <div class="form-group">
          <label for="dosage">Dosage</label>
          <input type="text" id="dosage" name="dosage" placeholder="Enter dosage (e.g., 5 ml)" required>
        </div>
        <div class="form-group">
          <label for="frequency">Frequency</label>
          <input type="text" id="frequency" name="frequency" placeholder="Enter frequency (e.g., Twice a day)" required>
        </div>
        <div class="form-group">
          <label for="route">Route of Administration</label>
          <select id="route" name="route" required>
            <option value="oral">Oral</option>
            <option value="topical">Topical</option>
            <option value="inhalation">Inhalation</option>
            <option value="other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label for="start-date">Start Date</label>
          <input type="date" id="start-date" name="startDate" required>
        </div>
        <div class="form-group">
          <label for="end-date">End Date</label>
          <input type="date" id="end-date" name="endDate" required>
        </div>
      </div>
      <!-- Submit and Reset Buttons 
      <div class="form-buttons">
        <button type="submit" class="submit-btn">Submit</button>
        <button type="reset" class="reset-btn">Reset</button>
      </div>
    </form>
  </div>


-->