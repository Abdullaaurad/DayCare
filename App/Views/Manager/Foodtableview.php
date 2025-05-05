<!DOCTYPE html>
<html lang="en">
<head>
<title>Manager</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Manager/Home.css?v=<?= time() ?>">

    <link rel="stylesheet" href="<?= CSS ?>/Manager/Food-table?v=<?= time() ?>">

    <style>
        
        .sub-container {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }
        
        
        
        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 30px 0 20px;
            color: var(--primary-color);
            text-align: center;
            position: relative;
        }
        
        .title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background-color: var(--accent-color);
        }
        
        .table-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        
        th {
            background-color: #f2f6ff;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        tr:hover {
            background-color: #f9fafc;
        }
        
        .date-display {
            font-weight: normal;
            color: var(--accent-color);
        }
        
        .meal-item {
            padding: 5px 0;
            display: flex;
            align-items: center;
        }
        
        .meal-item:before {
            content: '•';
            color: var(--accent-color);
            font-weight: bold;
            margin-right: 8px;
        }
        
        .button-row {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .edit-button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .edit-button i {
            margin-right: 8px;
        }
        
        .edit-button:hover {
            background-color: var(--secondary-color);
        }
        
        .meal-category {
            font-weight: 600;
            color: var(--dark-text);
        }
        
        .profile {
            display: flex;
            align-items: center;
        }
        
        .profilebtn {
            background: transparent;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 24px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .sub-container {
                margin-left: 0;
            }
        }
        
        .meal-day-header {
            background-color: #e6f0ff;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="sidebar">
        <div class="logo_stuf" style="display: flex;margin-top:6%">
            <img src="<?= IMAGE ?>/logo_light.png" style="width: 40px;height:40px" alt="">
            <h2 style="margin-top: 10px;font-size:25px;">KIDDO VILLE</h2>
        </div>
        <ul style=" margin-top: 10%;">
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Manager/Home" style="font-size: 18px;margin-left:10%;margin-top:-10%;">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <ul>
                <li class="selected">
                    <a href="<?= ROOT ?>/Manager/Viewprofile" style="font-size: 18px;">
                        <i class="fas fa-user-check"></i>Accounts
                    </a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Schedule" style="font-size: 18px;">
                        <i class="fas fa-calendar"></i>Scheduling
                    </a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Packages"><i class="fas fa-box"></i> Packages</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Meeting"><i class="fa fa-exclamation-triangle"></i>Meeting</a>
                </li>
            </ul>

            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Holiday" style="font-size: 18px;">
                        <i class="fas fa-umbrella-beach"></i> Holiday</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Event" style="font-size: 18px;">
                        <i class="fa fa-calendar-plus"></i>Event</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Foodtable" style="font-size: 18px;">
                        <i class="fa fa-pizza-slice"></i>Food Plane</a>
                </li>
            </ul>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Manager/Leaverequest" style="font-size: 18px;">
                        <i class="fas fa-hand-paper"></i>Request</a>
                </li>
            </ul>
        </ul>
    </div>

        <div class="sub-container">
            <div class="header">
                <div class="name">
                    <h1>Hey Namal</h1>
                    <p>Let's do some productive activities today</p>
                </div>
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle"></i>
                    </button>
                </div>
            </div>
            
            

            <?php show($data) ?>
            <div class="table-container">
            <div class="title" style="color:#2353A7">
                KIDDO VILLE FOOD PLAN
            </div>
                <table id="foodtable">
                    <tr>
                        <th style="background-color:#f5f5f5; border:none"></th>
                        <th>
                            <span class="date-display">Today</span>
                            <div id="todayDate"></div>
                        </th>
                        <th>
                            <span class="date-display">Tomorrow</span>
                            <div id="tomorrowDate"></div>
                        </th>
                        <th>
                            <span class="date-display">Day After</span>
                            <div id="dayAfterDate"></div>
                        </th>
                    </tr>
                    <tr>
                        <td class="meal-category">Breakfast</td>
                        <td>
                            <?php if (!empty($data['Meal']['today']['Breakfast'])): ?>
                                <?php foreach ($data['Meal']['today']['Breakfast'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['tomorrow']['Breakfast'])): ?>
                                <?php foreach ($data['Meal']['tomorrow']['Breakfast'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['dayafter']['Breakfast'])): ?>
                                <?php foreach ($data['Meal']['dayafter']['Breakfast'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td class="meal-category">Morning Tea Time</td>
                        <td>
                            <?php if (!empty($data['today'])): ?>
                                <?php foreach ($data['today'] as $foods): ?>
                                    <?php if ($foods->Time == 'MorningTeatime'): ?>
                                        <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['tomorrow'])): ?>
                                <?php foreach ($data['tomorrow'] as $foods): ?>
                                    <?php if ($foods->Time == 'MorningTeatime'): ?>
                                        <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['dayafter'])): ?>
                                <?php foreach ($data['dayafter'] as $foods): ?>
                                    <?php if ($foods->Time == 'MorningTeatime'): ?>
                                        <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr> -->
                    <tr>
                        <td class="meal-category">Lunch</td>
                        <td>
                            <?php if (!empty($data['Meal']['today']['Lunch'])): ?>
                                <?php foreach ($data['Meal']['today']['Lunch'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['tomorrow']['Lunch'])): ?>
                                <?php foreach ($data['Meal']['tomorrow']['Lunch'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['dayafter']['Lunch'])): ?>
                                <?php foreach ($data['Meal']['dayafter']['Lunch'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                        <!-- <tr>
                            <td class="meal-category">Evening Tea Time</td>
                            <td>
                                <?php if (!empty($data['today'])): ?>
                                    <?php foreach ($data['today'] as $foods): ?>
                                        <?php if ($foods->Time == 'EveningTeatime'): ?>
                                            <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($data['tomorrow'])): ?>
                                    <?php foreach ($data['tomorrow'] as $foods): ?>
                                        <?php if ($foods->Time == 'EveningTeatime'): ?>
                                            <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($data['dayafter'])): ?>
                                    <?php foreach ($data['dayafter'] as $foods): ?>
                                        <?php if ($foods->Time == 'EveningTeatime'): ?>
                                            <div class="meal-item"><?= htmlspecialchars($foods->Food) ?></div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </td>
                        </tr> -->
                    <tr>
                        <td class="meal-category">Dinner (For 24 hours service)</td>
                        <td>
                            <?php if (!empty($data['Meal']['today']['Dinner'])): ?>
                                <?php foreach ($data['Meal']['today']['Dinner'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['tomorrow']['Dinner'])): ?>
                                <?php foreach ($data['Meal']['tomorrow']['Dinner'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($data['Meal']['dayafter']['Dinner'])): ?>
                                <?php foreach ($data['Meal']['dayafter']['Dinner'] as $food): ?>
                                    <div class="meal-item"><?= htmlspecialchars($food) ?></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>

<!-- KIDDO VILLE SNACK PLAN TABLE WITH HARDCODED DATA -->
<div class="title">
    KIDDO VILLE SNACK PLAN
</div>

<div class="table-container">
    <table id="snackplan">
        <tr>
            <th style="background-color:#f5f5f5; border:none"></th>
            <th>
                <span class="date-display">Today</span>
            </th>
            <th>
                <span class="date-display">Tomorrow</span>
            </th>
            <th>
                <span class="date-display">Day After</span>
            </th>
        </tr>
        <tr>
            <td class="meal-category">Breakfast</td>
            <td>
                <!-- Today's Breakfast Snacks -->
                <div class="meal-item">Fresh fruit slices (apple, banana, strawberry)</div>
                <div class="meal-item">Yogurt cups with honey</div>
            </td>
            <td>
                <!-- Tomorrow's Breakfast Snacks -->
                <div class="meal-item">Mini muffins</div>
                <div class="meal-item">Apple sauce cups</div>
            </td>
            <td>
                <!-- Day After's Breakfast Snacks -->
                <div class="meal-item">Cereal bars</div>
                <div class="meal-item">Fruit yogurt parfait</div>
            </td>
        </tr>
        <tr>
            <td class="meal-category">Lunch</td>
            <td>
                <!-- Today's Lunch Snacks -->
                <div class="meal-item">Veggie sticks with hummus</div>
                <div class="meal-item">Cheese cubes</div>
            </td>
            <td>
                <!-- Tomorrow's Lunch Snacks -->
                <div class="meal-item">Trail mix (nuts, raisins, cereal)</div>
                <div class="meal-item">Orange slices</div>
            </td>
            <td>
                <!-- Day After's Lunch Snacks -->
                <div class="meal-item">Cucumber sandwich bites</div>
                <div class="meal-item">Fruit jelly cups</div>
            </td>
        </tr>
        <tr>
            <td class="meal-category">Dinner (For 24 hours service)</td>
            <td>
                <!-- Today's Dinner Snacks -->
                <div class="meal-item">Whole grain crackers</div>
                <div class="meal-item">Fruit smoothie</div>
            </td>
            <td>
                <!-- Tomorrow's Dinner Snacks -->
                <div class="meal-item">Graham crackers</div>
                <div class="meal-item">Milk and cookies</div>
            </td>
            <td>
                <!-- Day After's Dinner Snacks -->
                <div class="meal-item">Popcorn</div>
                <div class="meal-item">Banana bread slices</div>
            </td>
        </tr>
    </table>
</div>  

    <script>
        // Function to handle profile card toggle
        function handleClick() {
            const profileCard = document.getElementById('profileCard');
            profileCard.style.display = 'flex';
        }
        
        function handleHide() {
            const profileCard = document.getElementById('profileCard');
            profileCard.style.display = 'none';
        }
        
        // Set current dates
        function setDates() {
            const today = new Date();
            const tomorrow = new Date();
            tomorrow.setDate(today.getDate() + 1);
            const dayAfter = new Date();
            dayAfter.setDate(today.getDate() + 2);
            
            const formatDate = (date) => {
                return date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
            };
            
            if (document.getElementById('todayDate')) {
                document.getElementById('todayDate').textContent = formatDate(today);
            }
            if (document.getElementById('tomorrowDate')) {
                document.getElementById('tomorrowDate').textContent = formatDate(tomorrow);
            }
            if (document.getElementById('dayAfterDate')) {
                document.getElementById('dayAfterDate').textContent = formatDate(dayAfter);
            }
        }
        
        // Edit function that redirects to the edit page
        function editMealPlan() {
            // Redirect to edit page or trigger modal
            window.location.href = '<?= ROOT ?>/Manager/EditFoodplan';
        }
        
        // Initialize on page load
        window.onload = function() {
            setDates();
            
            // Hide profile card initially
            const profileCard = document.getElementById('profileCard');
            if (profileCard) {
                profileCard.style.display = 'none';
            }
        };
    </script>
</body>
</html>