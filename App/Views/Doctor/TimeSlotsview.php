<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="<?=CSS?>/Doctor/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Doctor/timeslot.css?v=<?= time() ?>">
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
                  
                    <a href="<?=ROOT?>/Doctor/Prescriptions" class="sidebar-list-item" id="report-link">
                        <i class='bx bxs-report' ></i>
                        <span class="text"> Prescriptions </span>
                    </a>
                    <a href="<?=ROOT?>/Doctor/History" class="sidebar-list-item" id="students-link">
                        <i class='bx bxs-group' ></i>
                        <span class="text">History</span>
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
                    <img src="<?=$doctor['image']?>"  onclick="toggleMenu()" id="profileIcon" height="40px">
                </a>
                </div>
                <?php endif; ?>  
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?=IMAGE?>/profilePic-2.png" alt="">
                            <h3>Wane Carter</h3>
                        </div>
                        <hr>
    
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
            <div class="time-slot-page">
               
                <form class="time-slot-form" action="<?=ROOT?>/Doctor/TimeSlots/addSlot" method="POST" >
                    <div class="time-slot">
                      <!-- Calendar Section -->
                      <div class="calendar">
                      <h3>Date</h3>
                        <header>
                        <pre class="left">◀</pre>
                        
                        <div class="header-display">
                            <p class="display"></p>
                        </div>

                        <pre class="right">▶</pre>

                        </header>

                        <div class="week">
                            <div>Su</div>
                            <div>Mo</div>
                            <div>Tu</div>
                            <div>We</div>
                            <div>Th</div>
                            <div>Fr</div>
                            <div>Sa</div>
                        </div>
                        <div class="days"></div>

                        <div class="display-selected">
                            <p class="selected"></p>
                            <!-- <input type="date" name="Date" id="Date"> -->
                             <input type=Date name="Date" id="Date" hidden></p>
                        </div>
                    </div>
                   
                  
                      <!-- Time Selection Section -->
                      <div class="time-selection">
                        <h3>Time</h3>
                        <div class="slots">
                          <input type="radio" id="time-1" name="time-1" value="8:00 - 8:30" />
                          <label class="slot" for="time-1">8:00 - 8:30</label>
                  
                          <input type="radio" id="time-2" name="time-2" value="13:00 - 13:30" />
                          <label class="slot" for="time-2">13:00 - 13:30</label>
                  
                          <input type="radio" id="time-3" name="time-3" value="9:00 - 9:30" />
                          <label class="slot" for="time-3">9:00 - 9:30</label>

                          <input type="radio" id="time-4" name="time-4" value="13:30 - 14:00" />
                          <label class="slot" for="time-4">13:30 - 14:00</label>

                          <input type="radio" id="time-5" name="time-5" value="9:30 - 10:00" />
                          <label class="slot" for="time-5">9:30 - 10:00</label>

                          <input type="radio" id="time-6" name="time-5" value="14:00 - 14:30" />
                          <label class="slot" for="time-6">14:00 - 14:30</label>

                          <input type="radio" id="time-7" name="time-6" value="10:00 - 10:30" />
                          <label class="slot" for="time-7">10:00 - 10:30</label>

                          <input type="radio" id="time-8" name="time-7" value="14:30 - 15:00" />
                          <label class="slot" for="time-8">14:30 - 15:00</label>

                          <input type="radio" id="time-9" name="time-8" value="10:30 - 11:00" />
                          <label class="slot" for="time-9">10:30 - 11:00</label>

                          <input type="radio" id="time-10" name="time-9" value="15:00 - 15:30" />
                          <label class="slot" for="time-10">15:00 - 15:30</label>

                          <input type="radio" id="time-11" name="time-10" value="11:00 - 11:30" />
                          <label class="slot" for="time-11">11:00 - 11:30</label>

                          <input type="radio" id="time-12" name="time-11" value="15:30 - 16:00" />
                          <label class="slot" for="time-12">15:30 - 16:00</label>

                          <input type="radio" id="time-13" name="time-12" value="11:30 - 12:00" />
                          <label class="slot" for="time-13">11:30 - 12:00</label>

                          <input type="radio" id="time-14" name="time-13" value="16:00 - 16:30" />
                          <label class="slot" for="time-14">16:00 - 16:30</label>
                  
                          <!-- Repeat for all time slots -->
                        </div>
                      </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" class="submit-btn">Done</button>
                    <button type="reset" class="reset-btn">Reset</button>
                  </form>
                  
            </div>
         
       
            
        </div>
    </div>
    </div>

    
   <!-- // <script src="<?=JS?>/Doctor/calander.js"></script> -->
    <script>
        let display = document.querySelector(".display");
    let days = document.querySelector(".days");
    let previous = document.querySelector(".left");
    let next = document.querySelector(".right");
    let selected = document.querySelector(".selected");
    const dataBox = document.querySelector("#Date");

    let date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth();

    function displayCalendar() {
      days.innerHTML = "";

      const firstDay = new Date(year, month, 1);
      const lastDay = new Date(year, month + 1, 0);
      const firstDayIndex = firstDay.getDay();
      const numberOfDays = lastDay.getDate();

      let formattedDate = date.toLocaleString("en-US", {
        month: "long",
        year: "numeric"
      });

      display.innerHTML = formattedDate;

      for (let x = 1; x <= firstDayIndex; x++) {
        const div = document.createElement("div");
        div.innerHTML += "";
        days.appendChild(div);
      }

      for (let i = 1; i <= numberOfDays; i++) {
        let div = document.createElement("div");
        let currentDate = new Date(year, month, i);
        div.dataset.date = currentDate.toISOString().split("T")[0];

        div.innerHTML += i;
        days.appendChild(div);

        if (
          currentDate.getFullYear() === new Date().getFullYear() &&
          currentDate.getMonth() === new Date().getMonth() &&
          currentDate.getDate() === new Date().getDate()
        ) {
          div.classList.add("current-date");
        }
      }

      displaySelected(); // important!
    }

    function displaySelected() {
      const dayElements = document.querySelectorAll(".days div");
      //const databox = document.querySelectorAll(".Date");
      dayElements.forEach((day) => {
        if (!day.dataset.date) return; // skip blanks
        day.addEventListener("click", (e) => {
          const selectedDate = e.target.dataset.date;
          selected.innerHTML = `Selected Date: ${selectedDate}`;
          console.log(selectedDate);
          dataBox.value = selectedDate;
        });
      });
    }

    previous.addEventListener("click", () => {
      if (month <= 0) {
        month = 11;
        year--;
      } else {
        month--;
      }
      date.setMonth(month);
      displayCalendar();
    });

    next.addEventListener("click", () => {
      if (month >= 11) {
        month = 0;
        year++;
      } else {
        month++;
      }
      date.setMonth(month);
      displayCalendar();
    });

    // Initial display
    displayCalendar();

    const displayBox = document.querySelector(".selected").textContent;

    if(displayBox != ''){
      displayBox.classList.add("selectBox");
    }
    </script>
    
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    
    
</body>
</html>