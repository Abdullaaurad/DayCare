<html>

</html>

<head>
    <title>
        Contact Us
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="<?=CSS?>/Main/popup.css" rel="stylesheet" />
    <script src="<?=JS?>/Help.js"></script>
</head>

<body>
    <!-- popup for help in funzone -->
    <div class="popup-container">
        <div class="left-panel">
            <div class="header">
                Get in touch with us
            </div>
            <div class="contact-info">
                <img alt="Profile picture of Amanda" height="50" src="<?=IMAGE?>/face.jpeg" width="50"
                    style="border: 4px solid darkblue;" />
                <p>
                    Hi, I'm Amanda. Need help? Use the form below or email me at <a
                        style="color: darkblue; cursor: pointer;">abdullaaurad@gmail.com</a>
                </p>
            </div>
            <div class="form-group">
                <label for="contact">
                    Contact
                </label>
                <input id="contact" name="contact" type="text" placeholder="Enter contact info here ...." />
            </div>
            <div class="form-group">
                <label for="message">
                    Massage
                </label>
                <textarea id="message" name="message" placeholder="Type your message here..."></textarea>
            </div>
            <div class="form-group">
                <div id="image-group">
                    <label for="image">
                        Add image
                    </label>
                    <label class="custom-file-upload" for="image">
                        + Choose File
                    </label>
                </div>
                <input id="image" name="image" type="file" />
            </div>
            <button class="submit-btn">
                Save
            </button>
            <button class="cancel-btn" id="cancel">
                Cancel
            </button>
        </div>
        <div class="right-panel">
            <div class="back-con">
                <i class="fas fa-chevron-left" id="back" onclick="window.location.href = '<?=ROOT?>/Main/Help'"></i>
            </div>
            <img alt="Illustration of a person using a VR headset and working on a laptop" height="500"
                src="<?=IMAGE?>/help-funzone2.jpg" width="400" height="100"/>
        </div>
    </div>
</body>

</html>