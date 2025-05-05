<!DOCTYPE html>
<html lang="english">

<head>
  <title>Profile Page</title>
  <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC20T-Ebp7Ly_5NzpJukTJ9JjD6rALsq3c&libraries=places&callback=initMap" async defer></script>
  <link href="./Landing.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= CSS ?>/Main/Profile.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="<?= CSS ?>/Main/Footer.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="<?= CSS ?>/Main/Header.css?v=<?= time() ?>" />
  <link rel="stylesheet" href="<?= CSS ?>/variables.css?v=<?= time() ?>" />
  <script src="<?= JS ?>/Main/profile.js?v=<?= time() ?>"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC20T-Ebp7Ly_5NzpJukTJ9JjD6rALsq3c&libraries=places&callback=initMap" async defer></script>
</head>

<body style="background:url(<?= IMAGE ?>/back-login.jpg); background-size:cover; ">
  <div>
    <!-- header -->
    <div class="navbar">
      <div class="navbar-logo">
        <img src="<?= IMAGE ?>/Header logo.png" alt="Logo" style="height:80px ; width:100px" />
      </div>
      <div class="navbar-links">
        <a href="<?= ROOT ?>/Main/Home">
          <div class="navbar-link select">Home</div>
        </a>
        <a href="<?= ROOT ?>/Main/Profile">
          <div class="navbar-link">Profile</div>
        </a>
        <a href="<?= ROOT ?>/Main/Blog">
          <div class="navbar-link">Blog</div>
        </a>
        <a href="<?= ROOT ?>/Main/AboutUs">
          <div class="navbar-link">AboutUs</div>
        </a>
        <a href="<?= ROOT ?>/Main/Help">
          <div class="navbar-link">ContactUs</div>
        </a>
      </div>
      <div class="sign-up-buttons">
        <a href="<?= ROOT ?>/Main/Login">
          <div class="navbar-link-login">Login</div>
        </a>
        <a href="<?= ROOT ?>/Main/Signup">
          <div class="navbar-link-signup">Sign Up</div>
        </a>
      </div>
    </div>
    <div class="landing-page-container">
      <div class="landing-page">
        <div class="landing-page-frame">
          <span class="Heading">
            <!-- Heading -->
            <span class="Heading-1">Welcome to our</span>
            <br />
            <span class="Heading-3" style="margin-left: 250px;">Kiddo Ville</span>
            <br />
            <span class="Heading-1">Wonderland!</span>
          </span>
          <span class="paragraph">
            <span class="paragraph-1" style="margin-top:500px !important;">
              Nurturing Young Minds, One Step at a Time
            </span>
            <br />
          </span>
          <!-- cloud and kids image -->
          <button class="button-c" onclick="window.location.href='<? ROOT ?>Main/Signup'">Join Us Today</button>
          <img alt="Kids" src="<?= IMAGE ?>/Kids.png" class="kids" />
          <img alt="cloud" src="<?= IMAGE ?>/cloud-1.png" class="cloud-1" />
          <img alt="cloud" src="<?= IMAGE ?>/cloud-2.png" class="cloud-2" />
          <img alt="cloud" src="<?= IMAGE ?>/cloud-2.png" class="cloud-3" />
        </div>
        <div class="content">
          <span class="Why-choose"><span>What Sets Us Apart?</span></span>
          <span class="Enrich" style="margin-bottom: -50px !important; margin-top: 30px !important;">
            <span class="fade-in">Our Identity</span>
            <h3 class="fade-in" style="color: aqua; white-space: nowrap; margin: 0px 0px;">Fostering Growth and
              Development</h3>
          </span>
          <span class="p-1">
            <span class="fade-in" style="margin-top: -100px !important; margin-bottom: -40px;">
              At Kiddo Ville, our name says it all. 'Kiddo' reflects our deep affection and care for each child, while
              'Ville' represents the safe and supportive community we've built to nurture their growth. From the moment
              you step into Kiddo Ville, you'll see that our focus is entirely on creating a loving, child-centered
              environment where every little one feels valued and at home.
            </span>
          </span>
        </div>
        <div class="Real">
          <span class="Real-time">
            <span class="fade-in" style="white-space: nowrap; margin-left: -200px; margin-bottom: -30px;">Discover Our
              Location and Directions</span>
            <h3 class="fade-in"
              style="color: aqua; white-space: nowrap; margin-left: -250px !important; margin-top: 10px; margin-bottom: -50px !important;">
              Your Path to Kiddo Ville Starts Here</h3>
          </span>
          <span class="p-2">
            <span class="fade-in" style="margin-top: -50px !important;">
              We know how crucial it is for parents to stay updated on their child's daily experiences. Our system
              delivers real-time notifications about your child's activities, meals, and nap times, ensuring you’re
              always informed. With our secure messaging feature, you can easily communicate with our daycare staff,
              fostering a transparent and reassuring connection. Experience peace of mind knowing you’re closely
              connected with your child’s care."
            </span>
          </span>
        </div>
        <div class="Efficient">
          <span class="Efficient-and fade-in">
            <h2 style="white-space: nowrap;">Hours of Operation</h2>
            <h3 style="color: aqua; white-space: nowrap; margin-top: 0px !important;">Flexible Hours for Your
              Convenience</h3>
          </span>
          <span class="p-3">
            <span class="fade-in">
              At Kiddo Ville, we understand the importance of flexibility and convenience for busy families. Our doors
              are open to provide exceptional care during the following hours: Monday to Sunday: 7:00 AM – 7:00 PM
              Whether you need early drop-offs or late pickups, we strive to accommodate your schedule and provide a
              consistent and welcoming environment for your child. For any special scheduling needs or inquiries, feel
              free to reach out to us!"
            </span>
          </span>
        </div>
        <div class="Mission">
          <span class="Real-time">
            <h2>Our Mission</h2>
            <h3 style="color: aqua; white-space: nowrap; margin-top: 0px; margin-left: -260px;">Nurturing Growth,
              Inspiring Futures</h3>
          </span>
          <span class="p-2">
            <span class="fade-in">
              At Kiddo Ville, our mission is to provide a nurturing and enriching environment where every child feels
              valued and inspired. We are dedicated to fostering a love for learning, creativity, and personal growth in
              each child. Our team of caring professionals is committed to offering exceptional early childhood
              education and care, guided by our core values of respect, inclusivity, and excellence. By creating a safe,
              supportive, and stimulating space, we aim to build a strong foundation for lifelong learning and success.
              Join us in our commitment to shaping bright futures, one child at a time.
            </span>
          </span>
        </div>
        <img alt="Enrich-photo" src="<?= IMAGE ?>/Operating-hours.jpg" class="Enrich-photo" />
        <img alt="pngwingcom1011487" src="<?= IMAGE ?>/logo_light.png" class="clock" />
        <div id="map" style="height: 400px; width: 400px; z-index: 100000;" class="task"> </div>
        <img alt="l11487" src="<?= IMAGE ?>/mission.jpeg" class="mission" />
        <span class="Last">
          <span>Where Little Minds Grow Big Dreams.</span>
        </span>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <div class="Footer">
    <img class="Footer-logo" src="<?= IMAGE ?>/Footer-logo.png" alt="WhatsApp Icon" />
    <div class="KiddoVille">Kiddo<br />Ville</div>
    <div class="Group4">
      <div class="Home"><a href="<? ROOT ?>Main/Home">Home</a></div>
      <div class="AboutUs"><a href="<? ROOT ?>Main/AboutUs">About Us</a></div>
      <div class="ContactUs"><a href="<? ROOT ?>Main/Help">Contact Us</a></div>
      <div class="Features"><a href="<? ROOT ?>Main/features">Features</a></div>
    </div>
    <div class="Group5">
      <div class="Contact"><a href="<? ROOT ?>Main/faq">FAQ</a></div>
      <div style="white-space: nowrap;" class="Address"><a href="<? ROOT ?>Main/Report">Report Problems</a></div>
      <div style="margin-top: 20px;" class="Address"><a href="<? ROOT ?>Main/Terms">Terms</a></div>
    </div>
    <div class="Group6">
      <div class="Contact"><a href="<? ROOT ?>Main/Blog">Blog</a></div>
      <div class="Address"><a href="<? ROOT ?>Main/Profile">Profile</a></div>
      <div style="margin-top: 20px; white-space: nowrap;" class="Address"><a href="<? ROOT ?>Main/Privacy">Privacy Policy</a></div>
    </div>
    <div class="Group7">
      <div class="Frame13">
        <button class="Join">Join US Today</button>
      </div>
      <div class="Enrol">Enrol now to kickstart the childhood journey</div>
    </div>
    <div class="Line6"></div>
    <!-- Socila icons -->
    <div class="social-icons">
      <!-- twitter icon -->
      <div class="socialcontainer">
        <div class="icon social-icon-1-1">
          <svg viewBox="0 0 512 512" height="1.7em" xmlns="http://www.w3.org/2000/svg" class="svgIcontwit"
            fill="white">
            <path fill="#ffffff"
              d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
            </path>
          </svg>
        </div>
        <!-- twitter icon effect-->
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
        <!-- instagram icon effect-->
        <div class="social-icon-2">
          <svg fill="white" class="svgIcon" viewBox="0 0 448 512" height="1.5em"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">
            </path>
          </svg>
        </div>
      </div>
      <!-- facebook icon  -->
      <div class="socialcontainer">
        <div class="icon social-icon-3-3">
          <svg viewBox="0 0 384 512" fill="white" height="1.6em" xmlns="http://www.w3.org/2000/svg">
            <path fill="#ffffff"
              d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
            </path>
          </svg>
        </div>
        <!-- facebook icon effect  -->
        <div class="social-icon-3">
          <svg viewBox="0 0 384 512" fill="white" height="1.6em" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z">
            </path>
          </svg>
        </div>
      </div>
      <!-- youtub icon  -->
      <div class="socialcontainer">
        <div class="icon social-icon-4-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" viewBox="0 0 256 180">
            <path fill="white" d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134"></path>
            <path fill="#144A78" d="m102.421 128.06l66.328-38.418l-66.328-38.418z"></path>
          </svg>
        </div>
        <!-- youtub icon  effect-->
        <div class="social-icon-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="1.6em" height="1.6em" viewBox="0 0 256 180">
            <path fill="white" d="M250.346 28.075A32.18 32.18 0 0 0 227.69 5.418C207.824 0 127.87 0 127.87 0S47.912.164 28.046 5.582A32.18 32.18 0 0 0 5.39 28.24c-6.009 35.298-8.34 89.084.165 122.97a32.18 32.18 0 0 0 22.656 22.657c19.866 5.418 99.822 5.418 99.822 5.418s79.955 0 99.82-5.418a32.18 32.18 0 0 0 22.657-22.657c6.338-35.348 8.291-89.1-.164-123.134"></path>
            <path fill="red" d="m102.421 128.06l66.328-38.418l-66.328-38.418z"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</body>

</html>