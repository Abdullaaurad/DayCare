<!DOCTYPE html>
<html>

</html>

<head>
    <title>Help</title>
    <link rel="icon" href="<?=IMAGE?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <link rel="stylesheet" href="<?=CSS?>/Main/Help.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Main/Header.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Main/Footer.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/variables.css?v=<?= time() ?>" />
</head>

<body>
    <!-- Header fot the help.html -->
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
    <div class="content">
        <!-- To redirect to each helping part of the codes -->
        <div class="box">
            <div class="heading">
                <h1>We are here to help!</h1>
            </div>
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search" style="cursor: pointer;"></i>
                    <input type="text" placeholder="Search">
                </div>
            </div>
        </div>
        <a href="<?=ROOT?>/Main/Started" class="card-link">
            <div class="card">
                <i class="fas fa-seedling"></i>
                <h3>Getting started</h3>
                <p>first step with your new service</p>
            </div>
        </a>
        <a href="<?=ROOT?>/Main/payment" class="card-link">
            <div class="card">
                <i class="fas fa-credit-card"></i>
                <h3>Billing</h3>
                <p>Help with payment and billing issue</p>
            </div>
        </a>
        <a href="<?=ROOT?>/Main/featurespop" class="card-link">
            <div class="card">
                <i class="fas fa-th-large"></i>
                <h3>Features</h3>
                <p>see our additional options and services</p>
            </div>
        </a>
        <a href="<?=ROOT?>/Main/funzone" class="card-link">
            <div class="card">
                <i class="fas fa-film"></i>
                <h3>FunZone</h3>
                <p>see our additional options and services</p>
            </div>
        </a>
        <a href="<?=ROOT?>/Main/integration" class="card-link">
            <div class="card">
                <i class="fas fa-cogs"></i>
                <h3>Integrations</h3>
                <p>Bring your services together</p>
            </div>
        </a>
        <a href="<?=ROOT?>/Main/mobile" class="card-link">
            <div class="card">
                <i class="fas fa-mobile-alt"></i>
                <h3>Mobile</h3>
                <p>All about your Mobile App</p>
            </div>
        </a>
    </div>

    <!-- Footer code -->
    <div class="Footer">
        <img class="Footer-logo" src="<?=IMAGE?>/Footer-logo.png" alt="WhatsApp Icon" />
        <div class="KiddoVille">Kiddo<br/>Ville</div>
            <div class="Group4">
                <div class="Home"><a href="<?=ROOT?>/Main/Landing">Home</a></div>
                <div class="AboutUs"><a href="<?=ROOT?>/Main/AboutUs">About Us</a></div>
                <div class="ContactUs"><a href="<?=ROOT?>/Main/Help">Contact Us</a></div>
                <div class="Features"><a href="<?=ROOT?>/Main/features">Features</a></div>
            </div>
            <div class="Group5">
                <div class="Contact"><a href="<?=ROOT?>/Main/FAQ">FAQ</a></div>
                <div style="white-space: nowrap;" class="Address"><a href="<?=ROOT?>/Main/Report">Report Problems</a></div>
                <div style="margin-top: 20px;" class="Address"><a href="<?=ROOT?>/Main/Terms">Terms</a></div>
            </div>
            <div class="Group6">
                <div class="Contact"><a href="<?=ROOT?>/Main/Blog">Blog</a></div>
                <div class="Address"><a href="<?=ROOT?>/Main/Profile">Profile</a></div>
                <div style="margin-top: 20px; white-space: nowrap;" class="Address"><a href="<?=ROOT?>/Main/Privacy">Privacy Policy</a></div>
            </div>
        <div class="Group7">
            <div class="Frame13">
                <button class="Join">Join US Today</button>
            </div>
            <div class="Enrol">Enrol now to kickstart the childhood journey</div>
        </div>
        <div class="Line6"></div>

        <!-- Socila icons for the code -->
        <div class="social-icons">
            <!-- Twitter icon -->
            <div class="socialcontainer">
                <div class="icon social-icon-1-1">
                    <svg viewBox="0 0 512 512" height="1.7em" xmlns="http://www.w3.org/2000/svg" class="svgIcontwit"
                        fill="white">
                        <path fill="#ffffff"
                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z">
                        </path>
                    </svg>
                </div>
                <!-- Twitter icon effect -->
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
            <!-- facebook icon -->
            <div class="socialcontainer">
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
</body>

</html>