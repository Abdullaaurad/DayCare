<!DOCTYPE html>
<html lang="en">
<head>
<title>Kiddo Ville</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <!-- Fonts that we are using -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        data-tag="font" />
    <link rel="stylesheet" href="<?=CSS?>/Teacher/home.css?v=<?= time() ?>" />
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>"" />
    <script src="<?=JS?>/Main/Landing.js"></script>
</head>
<body>

    <div class="backdrop" style="background:url(<?=IMAGE?>/back-login-1.jpg); background-size:cover; ">
        <div class="blur-layer">
        <div class="wrapper-1">
            <div class="navbar">
                <div class="navbar-logo">
                    <img src="<?=IMAGE?>/Header logo.png" alt="Logo" style="height:80px ; width:100px" />
                </div>
                <div class="navbar-links">
                    <a href="<?=ROOT?>/Main/Home"><div class="navbar-link select">Home</div></a>
                    <a href="<?=ROOT?>/Main/Profile"><div class="navbar-link">Profile</div></a>
                    <a href="<?=ROOT?>/Main/Blog"> <div class="navbar-link">Blog</div></a>
                    <a href="<?=ROOT?>/Main/AboutUs"><div class="navbar-link">AboutUs</div></a>
                    <a href="<?=ROOT?>/Main/Help"><div class="navbar-link">ContactUs</div></a>
                </div>
                <div class="sign-up-buttons">
                    <a href="<?=ROOT?>/Main/Login"><div class="navbar-link-login">Login</div></a>
                    <a href="<?=ROOT?>/Main/Signup"><div class="navbar-link-signup">Sign Up</div></a>
                </div>
            </div>
        <div class="view">
        <div class="hero-section">
            <div class="hero-content1">
                <span class="heading first">
                        <!-- Starting heading -->
                        <h1>Welcome to</h1>
                        <h1><span class="name">Kiddo Ville</span> Wonderland</h1>
                </span>
                <span class="paragraph first">
                    <span class="paragraph-1">
                            Welcome to Kiddo Ville Wonderland, a vibrant haven where
                            imagination meets adventure! Dive into a world designed for
                            fun and discovery, where every day is an exciting new journey!
                    </span>
                        <br />
                </span>
                    <!-- the kids image and the clouds -->
                <button class="button-c first" onclick="window.location.href='../../Login/Signup.html'">Enroll Your Child Now</button>

            </div>
            <div class="hero-content2">
            `<img alt="Kids" src="<?=IMAGE?>/Kids.png" class="kids first" />
            </div>
        </div>
        <!--End od the Hero-->
<!-- 
        <div class="clouds">
            <img alt="Kids" src="<?=IMAGE?>/new-back.jpg" class="kids" />
        </div> -->
       
        <div class="content">
            <span class="why-choose block"><span>Why choose us?</span></span>
            <div class="double-content">
                <div class="left-c block">
                    <span class="enrich">
                        Enriched Learning Environment
                    </span>
                    <span class="foster">
                        <span class="fade-in">Fostering Growth and Development</span>
                    </span>
    
                    <p class="fade-in">
                    Our daycare offers a stimulating and nurturing environment that
                    promotes learning and development through a variety of
                    age-appropriate activities. We provide a balanced curriculum
                    that includes play-based learning, creative arts, and early
                    education fundamentals. We help your child develop essential
                    skills and a love for learning.
                    </p>

                </div>
                <div class="right-c block">
                <img alt="Kids" src="<?=IMAGE?>/circle.png" class="kids" />
                </div>
            </div>

            <div class="double-content">
                <div class="left-c1 block">
                    <img alt="Kids" src="<?=IMAGE?>/clock.png" class="kids" />
                </div>

                <div class="right-c1 block">
                    <span class="enrich">
                    Real-Time Updates
                    </span>
                    <span class="foster">
                        <span class="fade-in">Stay Connected, Anytime, Anywhere</span>
                    </span>
    
                    <p class="fade-in">
                    We understand how important it is for parents to stay informed
                            about their child's day. Our system provides real-time updates
                            on your child's activities, meals, and nap times. Our secure
                            messaging feature allows seamless communication with daycare
                            staff, providing peace of mind and fostering a transparent
                            relationship.
                    </p>

                </div>
               
            </div>

           
            <div class="double-content">
                <div class="left-c block">
                    <span class="enrich">
                    Efficient and Organized Management
                    </span>
                    <span class="foster">
                        <span class="fade-in">Streamlined Operations for Quality Care</span>
                    </span>
    
                    <p class="fade-in">
                    Our daycare management system is designed to make the
                            administration of the daycare seamless and efficient. From easy
                            check-ins and check-outs to managing staff schedules and
                            tracking attendance, our platform handles it all. This allows
                            daycare staff to focus more on providing high-quality care and
                            engaging activities for your children
                    </p>

                </div>
                <div class="right-c block">
                <img alt="Kids" src="<?=IMAGE?>/Task.png" class="kids" />
                </div>
            </div>


        </div>

        <div class="guide block">
                <h1>Our Teachers</h1>
           </div>
        <div class="teacher-list">
            
         
           <div class="teachers block">
                <div class="profile-1 ">
                    <div class="circle">
                    <img alt="teacher" src="<?=IMAGE?>/t1.jpg"  />
                    </div>
                    <div class="name-box">
                        <div class="name">
                            <p>Sara Britney</p>
                        </div>
                        
                    </div>

                </div>
                <div class="profile-2 ">
                    <div class="circle">
                        <img alt="teacher" src="<?=IMAGE?>/t2.jpg"  />
                    </div>
                    <div class="name-box">
                        <div class="name">
                            <p> Olivia Davis</p>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="profile-3 ">
                    <div class="circle">
                        <img alt="teacher" src="<?=IMAGE?>/t4.jpg"  />
                    </div>
                    <div class="name-box">
                        <div class="name">
                            <p>Emma Clark</p>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="profile-4 ">
                    <div class="circle">
                        <img alt="teacher" src="<?=IMAGE?>/t3.jpg"  />
                    </div>
                    <div class="name-box">
                        <div class="name">
                            <p>Emily Roberts</p>
                        </div>
                        
                    </div>
                </div>
           </div>
        </div>
       

        </div>

        <div class="location-box">
            <div class="description block">
                <h1>Discover Our Location</h1>
                <p>Conveniently located to serve you better, our Daycare center is easily accessible and provides a welcoming environment. Check the map to find us effortlessly and plan your visit today!"</p>
            </div>

            <div class="map block">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9040252131454!2d79.85830197448266!3d6.9020802186492896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25963126b91e7%3A0x5b54a2722ff782ab!2sUCSC%20Building%20Complex%2C%20University%20of%20Colombo%20School%20of%20Computing%2C%20UCSC%20Building%20Complex%2C%2035%2C%2C%20Reiv%20Ave%2C%20Colombo%2000700!5e0!3m2!1sen!2slk!4v1733758620611!5m2!1sen!2slk" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        

        <div class="footer">
            <div class="footer-up">
                <div class="fl-1 col">
                <img alt="logo" src="<?=IMAGE?>/logo_light-remove.png" width="100px" />
                <h1>Kiddo Ville</h1>
                </div>
                <div class="fl-2 col">
                    <div class="Home"><a href="Home">Home</a></div>
                    <div class="AboutUs"><a href="<?=ROOT?>/Main/AboutUs">About Us</a></div>
                    <div class="ContactUs"><a href="<?=ROOT?>/Main/Help">Contact Us</a></div>
                    <div class="Features"><a href="<?=ROOT?>/Main/features">Features</a></div>
                </div>
                <div class="fl-3 col">
                    <div class="Contact"><a href="<?=ROOT?>/Main/FAQ">FAQ</a></div>
                    <div style="white-space: nowrap;" class="Address"><a href="<?=ROOT?>/Main/Report">Report Problems</a></div>
                    <div  class="Address"><a href="<?=ROOT?>/Main/Terms">Terms</a></div>
                </div>
                <div class="fl-4 col">
                    <div class="Contact"><a href="<?=ROOT?>/Main/Blog">Blog</a></div>
                    <div class="Address"><a href="<?=ROOT?>/Main/Profile">Profile</a></div>
                    <div  class="Address"><a href="<?=ROOT?>/Main/Privacy">Privacy Policy</a></div>
                </div>
                <div class="fl-5 col">
                <div class="enrol">Enrol now to kickstart the childhood journey</div>
                    <div class="join-btn">
                        <button >Join US Today</button>
                    </div>
                    
                </div>

            </div>
            <hr>
            <div class="footer-down">

            <div class="social-icons">
            <!-- twiiter icon -->
            <div class="socialcontainer">
                <div class="icon social-icon-1-1">
                    <svg viewBox="0 0 512 512" height="1.7em" xmlns="http://www.w3.org/2000/svg" class="svgIcontwit"
                        fill="white">
                        <path fill="#ffffff"
                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                        </path>
                    </svg>
                </div>
                <!-- twiiter icon effect-->
                <div class="social-icon-1">
                    <svg viewBox="0 0 512 512" height="1.7em" xmlns="http://www.w3.org/2000/svg" class="svgIcontwit"
                        fill="white">
                        <path
                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                        </path>
                    </svg>
                </div>
            </div>
            <!-- instagram icon -->
            <div class="socialcontainer">
                <div class="icon social-icon-2-2">
                    <svg fill="white" class="svgIcon" viewBox="0 0 448 512" height="1.5em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill="#ffffff"
                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                        </path>
                    </svg>
                </div>
                <!-- Instagram icon effect-->
                <div class="social-icon-2">
                    <svg fill="white" class="svgIcon" viewBox="0 0 448 512" height="1.5em"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="socialcontainer">
                <!-- facebook icon -->
                <div class="icon social-icon-3-3">
                    <svg viewBox="0 0 384 512" fill="white" height="1.6em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#ffffff"
                            d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                        </path>
                    </svg>
                </div>
                <!-- facebook icon effect-->
                <div class="social-icon-3">
                    <svg viewBox="0 0 384 512" fill="white" height="1.6em" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
                        </path>
                    </svg>
                </div>
            </div>
            <!-- Youtube icon -->
            <div class="socialcontainer">
                <div class="icon social-icon-4-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" viewBox="0 0 256 180">
                        <path fill="white" d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134"></path>
                        <path fill="#144A78" d="m102.421 128.06l66.328-38.418l-66.328-38.418z"></path>
                    </svg>
                </div>
                <!-- Youtube icon effect-->
                <div class="social-icon-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" viewBox="0 0 256 180">
                        <path fill="white" d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134"></path>
                        <path fill="red" d="m102.421 128.06l66.328-38.418l-66.328-38.418z"></path>
                    </svg>
                </div>
            </div>
        </div>

            </div>
            <div class="copyright">
                &copy; 2025 | All rights received
            </div>
        </div>
        <!--Wrapper ends-->
        </div>
        </div>
        
    </div>
</body>
</html>