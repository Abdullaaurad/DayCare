<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Home.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Sidebar.css?v=<?= time() ?>">
    <script src="<?= JS ?>/Parent/Profile.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/Navbar.js?v=<?= time() ?>"></script>
    <script src="<?= JS ?>/Parent/MessageDropdown.js?v=<?= time() ?>"></script>
    <style>
        .report-header {
            display: flex;
            overflow-x: auto;
            width: 1100px;
            /* Adjust this based on the number of cards */
            padding-bottom: 10px;
        }

        .report-header::-webkit-scrollbar {
            display: none;
            /* Hides the scrollbar */
        }

        .post-card {
            flex: 0 0 auto;
            /* Prevent the cards from shrinking */
            width: 250px;
            /* Set the card width to fit your design */
            margin-right: 16px;
            /* Space between the cards */
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .post-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px 10px 0px 0px;
        }

        .post-card .post-content {
            padding: 15px;
        }

        .post-card .post-content h3 {
            font-size: 18px;
            margin: 0 0 10px;
            color: #60a6ec;
        }

        .post-card .post-content p {
            font-size: 14px;
            color: #666;
            margin: 0;
        }

        .post-card .post-content .post-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .post-card .post-content .post-meta span {
            font-size: 12px;
            color: #999;
        }

        .post-card .post-content .post-meta .author {
            display: flex;
            align-items: center;
        }

        .post-card .post-content .post-meta .author img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .post-card i {
            background-color: white !important;
            scale: 1.3;
            padding: 6px 7px;
        }

        .comments {
            margin-top: -20px;
        }

        .comments h3 {
            font-size: 20px;
            font-weight: 700;
        }

        .comment {
            display: flex;
            gap: 15px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            width: 660px;
            margin-left: 5px;
            margin-right: 5px;
        }

        .comment img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid gray;
        }

        .comment div {
            flex-grow: 1;
        }

        .comment h4 {
            font-size: 16px;
            font-weight: 700;
        }

        .comment p {
            color: #333;
            margin: 5px 0;
        }

        .comment span {
            font-size: 12px;
            color: #666;
        }

        .image-gallery::-webkit-scrollbar {
            display: none;
            /* For Chrome, Safari, and Edge */
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 30px;
            /* Rounded corners */
            border: 2px solid gray;
            /* Gray border */
            margin-top: -10px;
        }

        button {
            margin-top: -10px;
            display: inline-block;
            padding: 8px 16px;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .delete {
            margin-left: 573px;
            color: white;
            background-color: #60a6ec;
            padding: 10px;
            border-radius: 0px 0px 8px 0px;
            margin-top: -20px;
            margin-bottom: -15px;
            margin-right: -15px;
        }

        input[type="date"],
        input[type="text"] {
            width: 90%;
            height: 40px;
            padding: 15px 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 0px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-left: 30px;
        }
    </style>
</head>

<body style=" overflow-x: hidden;">
    <div class="container">
        <div class="sidebar " id="sidebar1">
            <img src="<?= IMAGE ?>/logo_light.png" class="star" id="starImage">
            <div class="logo-div">
                <img src="<?= IMAGE ?>/logo_light.png" class="logo" id="sidebar-logo"> </img>
                <h2 id="sidebar-kiddo">KIDDO VILLE </h2>
            </div>
            <ul>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/Home">
                        <i class="fas fa-home"></i> <span>Home</span>
                    </a>
                </li>
                <li class="hover-effect unselected" style="margin-top: 40px;">
                    <a href="<?= ROOT ?>/Parent/history">
                        <i class="fas fa-history"></i> <span>History</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/report">
                        <i class="fa fa-user-shield" aria-hidden="true"></i> <span>Report</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/reservation">
                        <i class="fas fa-calendar-check"></i> <span>Reservation</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/meal">
                        <i class="fas fa-utensils"></i> <span>Meal plan</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/event">
                        <i class="fas fa-calendar-alt"></i> <span>Event</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-box"></i> <span>Package</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/funzonehome">
                        <i class="fas fa-gamepad"></i> <span>Fun Zone</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Parent/package">
                        <i class="fas fa-credit-card"></i> <span>Payments</span>
                    </a>
                </li>
                <li class="selected" style="margin-top: 40px !important;">
                    <a href="<?= ROOT ?>/Parent/blog">
                        <i class="fas fa-newspaper"></i> <span>Blog</span>
                    </a>
                </li>

            </ul>
            <hr style="margin-top: 40px;">

        </div>
        <div class="sidebar-2" id="sidebar2" style="display: flex; flex-direction: row;">
            <div>
                <h2 style="margin-top: 25px; margin-left: 12px !important;">Familty Ties</h2>
                <div class="family-section" style="margin-top: 10px;">
                    <ul>
                        <li class="hover-effect first select-child"
                            onclick="window.location.href = '<?= ROOT ?>/ReParent/Home'">
                            <img src="<?= isset($data['parent']['image']) ? $data['parent']['image'] . '?v=' . time() : '' ?>"
                                style="width: 60px; height:60px; border-radius: 30px;">
                            <h2>Family</h2>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 style="margin-top: 25px;">Little Explorers</h2>
                    <p style="margin-bottom: 20px; color: white; margin-left: 5px !important;">
                        Explore your children's activities and progress!
                    </p>
                    <ul class="children-list">
                        <?php foreach ($data['children'] as $child): ?>
                            <li class="hover-effect first" onclick="setChildSession('<?= isset($child['name']) ? $child['name'] : '' ?>')">
                                <img src="<?= isset($child['image']) ? $child['image'] . '?v=' . time() : ROOT . '/Uploads/default_images/default_profile.jpg' ?>"
                                    alt="Child Profile Image"
                                    style="width: 60px; height: 60px; border-radius: 30px; margin-left: -20px !important;">
                                <h2><?= isset($child['name']) ? $child['name'] : 'No name set'; ?></h2>
                            </li>
                            <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content" id="main-content" style="height: 138vh !important;">
            <div class="header">
                <i class="fa fa-bars" id="minimize-btn"
                    style="margin-right: -50px; cursor: pointer; font-size: 30px;"></i>
                <div class="name">
                    <h1>Hey Thilina</h1>
                    <p>Let’s do some productive activities today</p>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="fas fa-search"></i>
                    <i class="fa fa-times clear-btn" style="margin-right: 10px;"></i>
                </div>
                <div class="bell-con" style="cursor: pointer;" id="bell-container">
                    <i class="fas fa-bell bell-icon" style="margin-left: -350px;"></i>
                    <div class="message-dropdown" id="messageDropdown" style="display: none;">
                        <ul>
                            <li>
                                <p>New Message 1 <i href="" class="fas fa-paper-plane"></i> </p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 2 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 3 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 4 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 5 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                            <li>
                                <p>New Message 6 <i href="" class="fas fa-paper-plane"></i></p>
                                <p class="content"> content like a message</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="message-numbers">
                    <p> 2</p>
                </div>
                <div class="profile">
                    <button class="profilebtn">
                        <i class="fas fa-user-circle" style="margin-left: 10px;"></i>
                    </button>
                </div>
            </div>
            <div class="stats">
                <!-- Stat for Average Blog Post Views -->
                <div class="stat" id="direct2" style="width: 0px; margin-left: 20px;">
                    <div id="stat3" style="display: '';">
                        <h3 style="margin-bottom: 10px; font-size: 18px; margin-top: 10px;">
                            Explore Your Activity
                        </h3>
                        <p style="margin-bottom: 15px;">
                            View Your Comments
                        </p>
                        <span style="display: block; margin-top: -10px; margin-bottom: 0px; font-size: 14px;">
                            Click below to see detailed insights on your comments
                        </span>
                    </div>
                    <div id="stat4" style="display: none;">
                        <h3 style="margin-bottom: 10px; font-size: 18px; margin-top: 10px;">
                            Discover Inspiring Blogs
                        </h3>
                        <p style="margin-bottom: 15px;">
                            Explore Posts
                        </p>
                        <span style="display: block; margin-top: -10px; margin-bottom: 0px; font-size: 14px;">
                            Dive into a world of creativity and see what others are sharing
                        </span>
                    </div>
                </div>

                <div class="stat" id="direct" style="cursor:pointer;" style="width: 0px;">
                    <div id="stat1" style="display: '';">
                        <h3 style="margin-bottom: 10px; font-size: 18px; margin-top: 10px;">
                            Explore Your Activity
                        </h3>
                        <p style="margin-bottom: 15px;">
                            View Your Posts
                        </p>
                        <span style="display: block; margin-top: -10px; margin-bottom: 0px; font-size: 14px;">
                            Click below to see detailed insights on your posts and interactions
                        </span>
                    </div>
                    <div id="stat2" style="display: none;">
                        <h3 style="margin-bottom: 10px; font-size: 18px; margin-top: 10px;">
                            Discover Inspiring Blogs
                        </h3>
                        <p style="margin-bottom: 15px;">
                            Explore Posts
                        </p>
                        <span style="display: block; margin-top: -10px; margin-bottom: 0px; font-size: 14px;">
                            Dive into a world of creativity and see what others are sharing
                        </span>
                    </div>
                </div>

                <!-- Stat for Creating New Blog Post (Right-most) -->
                <div class="stat" style="text-align: center; margin-right: 20px;">
                    <h3 style="margin-top: 5px;">
                        Create New Post
                    </h3>
                    <p style="margin-bottom: 3px;">Start a new blog post</p>
                    <br>
                    <a href="<?= ROOT ?>/Parent/CreatePost" class="btn-create-post" style="margin-top: -10px; display: inline-block; padding: 8px 16px; background-color: #3182ce; color: white; text-decoration: none; border-radius: 5px;">
                        Create Post
                    </a>
                </div>
            </div>

            <div class="report-page" id="report1" style="margin-top: 30px;">
                <h2 style="margin-left: 10px; margin-top: 10px !important; margin-bottom: 2px;"> Recent Posts </h2>
                <hr style="width: 1100px; margin-left: 10px;">
                <div class="report-header" style="overflow-x:scroll; width: 1100px;">
                    <div class="post-card" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="report-page" id="report2" style="margin-top: 30px; margin-bottom: 100px !important;">
                <h2 style="margin-left: 10px; margin-top: 10px !important; margin-bottom: 2px;"> Recommended Posts </h2>
                <hr style="width: 1100px; margin-left: 10px;">
                <div class="report-header">
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="post-card">
                        <img alt="Post Image 1" height="150" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="250" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="report-page" id="report4" style="margin-top: 20px;display: none; flex-direction: row; padding: 0px 30px !important; width: 1130px;">
                <div>
                    <h3 style="white-space: nowrap; display: flex; flex-direction: row; width: 500px;">Filter Blog Date : </h3>
                    <input type="date" style="margin-top: -50px; margin-left: 150px; width: 380px;">
                </div>
                <div>
                    <h3 style="white-space: nowrap; display: flex; flex-direction: row; width: 500px; margin-left: 30px;">Filter Blog Name : </h3>
                    <input type="text" style="margin-top: -50px; margin-left: 200px; width: 380px;">
                </div>
            </div>
            <div class="report-page report3" style="margin-top: 20px; margin-bottom: 20px !important; display: none;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 400px; height: 350px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:400px; height: 220px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-left: 10px;">
                            <button style="padding: 10px 30px; border: none;"> Edit </button>
                            <button style="padding: 10px 30px; border: none;"> Delete </button>
                        </div>
                    </section>
                </div>
            </div>
            <div class="report-page report3" style="margin-top: 20px; margin-bottom: 20px !important; display: none;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 400px; height: 350px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:400px; height: 220px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-left: 10px;">
                            <button style="padding: 10px 30px; border: none;"> Edit </button>
                            <button style="padding: 10px 30px; border: none;"> Delete </button>
                        </div>
                    </section>
                </div>
            </div>
            <div class="report-page report3" style="margin-top: 20px; margin-bottom: 20px !important; display: none;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 400px; height: 350px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:400px; height: 220px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-left: 10px;">
                            <button style="padding: 10px 30px; border: none;"> Edit </button>
                            <button style="padding: 10px 30px; border: none;"> Delete </button>
                        </div>
                    </section>
                </div>
            </div>
            <div class="report-page report3" style="margin-top: 0px; margin-bottom: 20px !important; display: none;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 400px; height: 350px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:400px; height: 220px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 2">
                                <div>
                                    <h4 style="margin-top: 0px;"> User Name 2</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <span style="margin-top: 0px;">Posted on Feb 2, 2023</span>
                                    <i class="fas fa-trash delete"> </i>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; margin-left: 10px;">
                            <button style="padding: 10px 30px; border: none;"> Edit </button>
                            <button style="padding: 10px 30px; border: none;"> Delete </button>
                        </div>
                    </section>
                </div>
            </div>
            <div id="report5" style="display: flex; flex-direction: column; display: none;">
                <div class="report-page" style="margin-top: 20px; flex-direction: row; padding: 0px 30px !important; width: 1130px;">
                    <div>
                        <h3 style="white-space: nowrap; display: flex; flex-direction: row; width: 500px;">Filter Blog Date : </h3>
                        <input type="date" style="margin-top: -50px; margin-left: 150px; width: 380px;">
                    </div>
                    <div>
                        <h3 style="white-space: nowrap; display: flex; flex-direction: row; width: 500px; margin-left: 30px;">Filter Blog Name : </h3>
                        <input type="text" style="margin-top: -50px; margin-left: 200px; width: 380px;">
                    </div>
                </div>
                <div class="report-page" style="margin-top: 0px; margin-bottom: 20px !important;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 300px; height: 310px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:300px; height: 160px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px; margin-left: 5px;">
                                <button style="padding: 10px 30px; border: none;"> Edit </button>
                                <button style="padding: 10px 30px; border: none;"> Delete </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="report-page" style="margin-top: 0px; margin-bottom: 20px !important;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 300px; height: 310px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:300px; height: 160px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px; margin-left: 5px;">
                                <button style="padding: 10px 30px; border: none;"> Edit </button>
                                <button style="padding: 10px 30px; border: none;"> Delete </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="report-page" style="margin-top: 0px; margin-bottom: 20px !important;">
                <div style="display: flex; flex-direction: row;" onclick="window.location.href='<?= ROOT ?>/Parent/Post';">
                    <div class="post-card" style="width: 300px; height: 310px;">
                        <img alt="Post Image 1" height="250" src="https://storage.googleapis.com/a1aa/image/3228wrKyS3oKFhXvmBeXEo2YPi6ExS1spg2tc0iMeLnNmz6TA.jpg" width="350" style="width:300px; height: 160px;" />
                        <div class="post-content">
                            <h3> The Impact of Technology on the Workplace: How Technology is Changing </h3>
                            <p> By John Doe - March 10, 2023 </p>
                            <div class="post-meta">
                                <span>
                                    <i class="fas fa-comments"></i>12
                                </span>
                                <div class="author">
                                    <img alt="Author Image" height="20" src="https://storage.googleapis.com/a1aa/image/gZen1LnQGzSpCyRfS3S5kQHGE8BUcI2m7d2yQoHDsVSQmz6TA.jpg" width="20" />
                                    <span>John Doe </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section class="comments" style="margin-left: 30px; height: 350px; overflow-y:scroll;">
                        <h3>Comments</h3>
                        <hr style="width: 690px; margin-bottom: 20px;">
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px; margin-left: 5px;">
                                <button style="padding: 10px 30px; border: none;"> Edit </button>
                                <button style="padding: 10px 30px; border: none;"> Delete </button>
                            </div>
                        </div>
                        <div style="overflow-y: scroll; height: 220px; scrollbar-width: none; -ms-overflow-style: none;">
                            <div class="comment">
                                <img src="<?= IMAGE ?>/face.jpeg" alt="User 1">
                                <div>
                                    <h4 style="margin-top: 0px;">User Name 1</h4>
                                    <p style="margin-top: -20px;">Lorem ipsum dolor sit amet...</p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <p> Hi </p>
                                    <span style="margin-top: 20px !important;">Posted on Jan 2, 2023</span>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px; margin-left: 5px;">
                                <button style="padding: 10px 30px; border: none;"> Edit </button>
                                <button style="padding: 10px 30px; border: none;"> Delete </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            </div>
            <div class="chatbox">
                <a href="<?= ROOT ?>/Parent/Message">
                    <img src="<?= IMAGE ?>/message.svg" class="fas fa-comment-dots"
                        style="margin-left: 12px; width: 24px; height: 24px; margin-top: 2px;" alt="Message Icon" />
                </a>
                <div class="message-numbers" style="margin-left: -5px; margin-bottom: 15px;">
                    <p> 2</p>
                </div>
            </div>
        </div>
        <!-- onclick function -->
        <div class="profile-card" id="profileCard">
            <img src="<?= IMAGE ?>/back-arrow-2.svg" alt="back-arrow"
                style="width: 24px; height: 24px; fill:#233E8D !important;" class="back">
            <img alt="Profile picture of Thilina Perera" height="100" src="<?= IMAGE ?>/profilePic.png" width="100"
                class="profile" />
            <h2>
                Thilina Perera
            </h2>
            <p>
                Student    RS0110657
            </p>
            <button class="profile-button" onclick="window.location.href ='<?= ROOT ?>/Parent/ParentProfile'">
                Profile
            </button>
            <button class="secondary-button" onclick="window.location.href ='<?= ROOT ?>/Parent/GuardianProfile'">
                Guardian profile
            </button>
            <button class="logout-button" onclick="window.location.href ='<?= ROOT ?>/Main/Home'">
                LogOut
            </button>
        </div>
    </div>
    <script>
        function setChildSession(childName) {
            console.log(childName);
            fetch(' <?= ROOT ?>/Parent/Home/setchildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        childName: childName
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child name set in session.");
                        window.location.href = '<?= ROOT ?>/Child/Home';
                    } else {
                        console.error("Failed to set child name in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const direct = document.getElementById('direct');
            const direct2 = document.getElementById('direct2');
            const report1 = document.getElementById('report1');
            const report2 = document.getElementById('report2');
            const report3 = document.querySelectorAll('.report3');
            const report4 = document.getElementById('report4');
            const report5 = document.getElementById('report5');
            const stat1 = document.getElementById('stat1');
            const stat2 = document.getElementById('stat2');
            const stat3 = document.getElementById('stat3');
            const stat4 = document.getElementById('stat4');

            direct.addEventListener('click', function() {
                if (stat1.style.display == '') {
                    console.log("hi");
                    stat1.style.display = 'none';
                    stat2.style.display = '';
                    stat4.style.display = 'none';
                    stat3.style.display = '';
                    report1.style.display = 'none';
                    report2.style.display = 'none';
                    report3.forEach(function(element) {
                        element.style.display = 'flex';
                    });
                    report4.style.display = 'flex';
                    report5.style.display = 'none';
                } else {
                    console.log("why");
                    stat1.style.display = '';
                    stat2.style.display = 'none';
                    report1.style.display = 'flex';
                    report2.style.display = 'flex';
                    report3.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    report4.style.display = 'none';
                    report5.style.display = 'flex';
                }
            })

            direct2.addEventListener('click', function() {
                if (stat3.style.display == '') {
                    stat3.style.display = 'none';
                    stat4.style.display = '';
                    stat1.style.display = '';
                    stat2.style.display = 'none';
                    report1.style.display = 'none';
                    report2.style.display = 'none';
                    report3.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    report4.style.display = 'none';
                    report5.style.display = 'flex';
                } else {
                    stat3.style.display = '';
                    stat4.style.display = 'none';
                    report1.style.display = 'flex';
                    report2.style.display = 'flex';
                    report3.forEach(function(element) {
                        element.style.display = 'none';
                    });
                    report4.style.display = 'none';
                    report5.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>