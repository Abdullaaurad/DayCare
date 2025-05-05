<!DOCTYPE html>
<html>
<title>Parent</title>
<link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= CSS ?>/Child/profile.css?v=<?= time() ?>">
<script src="<?= JS ?>/Child/Number.js"></script>
<style>
    .fa-chevron-left {
        margin-left: 40px;
        cursor: pointer;
        color: white !important;
    }

    .profile-img {
        width: 200px;
        height: 200px;
        border-radius: 100%;
        border: 5px solid rgba(27, 54, 101, 1);
        box-shadow: 0px 0px 12px rgba(72, 99, 180, 0.5);
        transition: box-shadow 0.3s;
        margin-top: 10px;
        margin-left: 250px;
        justify-content: center;
        align-items: center;
    }
    button {
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
    }
    #fileListContainer::-webkit-scrollbar {
        display: none;
    }
</style>

<head>
</head>
<body>
    <form id="Form" method="POST" id="details" enctype="multipart/form-data" action = "<?=ROOT?>/Child/ChildEditProfile/Savedetails">
        <div id="prescriptionModal" class="prescription-view" style="margin-left: 500px;">
            <div class="top-con" style="margin-bottom: 570px;">
                <div class="back-con" id="back-arrow">
                    <i class="fas fa-chevron-left" id="backforprescription"></i>
                </div>
                <div class="add-con" id="add-image">
                    <i class="fas fa-plus" style="margin-left: 10px; color: white;" id="addprescription"></i>
                </div>
            </div>
            <i class="fa fa-chevron-left move" id="left" style="margin-left: -20px !important;"></i>
            <input type='file' name='prescriptions[]' id="image-input" multiple style="display: none;">
            <img src="<?=IMAGE?>/prescription1.jpeg" alt='input mark' class="prescription-img" id="prescription-img">
            <button type="button" id="delete-image-btn" class="delete"><i class="fas fa-trash" style="color: white; font-size: 20px;"></i></button>
            <i class="fa fa-chevron-right move" id="right"></i>
        </div>
        <div id="documentModal" style="width: 550px; height: 500px; margin-left: 500px;">
            <div class="top-con">
                <div class="back-con" id="back-arrow">
                    <i class="fas fa-chevron-left" id="backfordocument"></i>
                </div>
            </div>
            <div id="fileListContainer" style="display: flex; flex-direction: column; overflow-y: scroll; width: 480px; height: 400px; margin-top: 0px;">
            </div>
                <input type="file" style="display: none; position: absolute;" name='documents[]' id="file-input" multiple>
                <button class="add-files" style="cursor: pointer !important;" for="file-input" id="file-btn" type='button'> Add Files </button>
            </div>
        </div>
        <div class="Profilecard" id="Profilecard" style="margin-top: 45px !important;">
            <div class="Profile">
                <p style="margin-top: 0px; margin-bottom: -10px; margin-left: 90px; cursor: pointer; color: rgba(35, 83, 167, 1);"
                    onclick="window.location.href='../Home/Home.html'">Child Profile
                    <span style="margin-left: 10px;"> > </span>
                    <span style="cursor: pointer; color: rgba(35, 83, 167, 1);"> Edit Child Profile</span>
                </p>
                <div class="back-con" id="back-arrow" style="margin-top: -25px !important; border-top-left-radius: 0px;">
                    <i class="fas fa-chevron-left" id="backforprescription"></i>
                </div>
                <div class="refresh-con" style="margin-top: -40px; border-top-right-radius: 0px;">
                    <i class="fas fa-refresh" id="profilerefresh"
                        style="margin-left: 10px; margin-bottom: -20px; cursor: pointer; color: #233E8D;"></i>
                </div>
            </div>
            <div class="ProfileContainer" style="margin-top: 10px;">
                <div class="leftcon">
                    <div id="editprofileleft">
                        <div class="profile-img" style="display: none;" id="add-con" style="width:200px !important; height:200px !important; ">
                            <input type="file" id="fileInput" name="profileimage">
                            <i class="fa fa-plus add" id="add" style="margin-left: 80px; margin-top: 80px;"></i>
                        </div>
                        <img src="<?= isset($data['children']->Image) ? $data['children']->Image : '' ?>" class="profile-img" id="img" style="width:200px; height:200px; margin-bottom: 40px;">
                        <i class="fa fa-edit"
                            style="font-size:30px; margin-left: 400px; margin-bottom: 0px; margin-top: -60px; color: #6f6f6f; cursor: pointer; display:flex;"
                            id="image-edit">
                        </i>

                        <div class="datacon">
                            <div class="data">
                                <label>First Name</label>
                                <input name="First_Name" required value="<?= isset($data['children']->First_Name) ? $data['children']->First_Name : '' ?>" type="text">
                            </div>
                            <div class="data">
                                <label>Last Name</label>
                                <input name="Last_Name" required value="<?= isset($data['children']->Last_Name) ? $data['children']->Last_Name : '' ?>" type="text">
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Nickname</label>
                                <input name="Nickname" required value="<?= isset($data['children']->Nickname) ? $data['children']->Nickname : '' ?>" type="text">
                            </div>
                            <div class="data">
                                <label>Date Of Birth</label>
                                <input name="DOB" required value="<?= isset($data['children']->DOB) ? $data['children']->DOB : '' ?>" type="date">
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Gender</label>
                                <select style="width: 315px;" name="Gender">
                                <?php
                                    $selectedGender = isset($data['children']->Gender) ? $data['children']->Gender : '';// Fetch the stored value ('M' or 'F')
                                ?>
                                    <option value="M" <?= $selectedGender === 'M' ? 'selected' : '' ?>>Male</option>
                                    <option value="F" <?= $selectedGender === 'F' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                            <div class="data">
                                <label>User Relationship</label>
                                <input required name="Relation" type="text" value="<?= isset($data['children']->Relation) ? $data['children']->Relation : '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div id="editprofileright">
                    <div class="rightcon">
                        <div class="datacon">
                            <div class="data">
                                <label>Language</label>
                                <select style="width: 315px;" name="Language">
                                    <?php $selectedLanguage = isset($data['children']->Language) ? $data['children']->Language : ''; // Fetch the value
                                    ?>
                                    <option value="Tamil" <?= $selectedLanguage === 'Tamil' ? 'selected' : '' ?>>Tamil</option>
                                    <option value="English" <?= $selectedLanguage === 'English' ? 'selected' : '' ?>>English</option>
                                    <option value="Sinhala" <?= $selectedLanguage === 'Sinhala' ? 'selected' : '' ?>>Sinhala</option>
                                </select>
                            </div>
                            <div class="data">
                                <label>Religion</label>
                                <select style="width: 315px;" name="Religion">
                                    <?php $selectedReligion = isset($data['children']->Religion) ? $data['children']->Religion : ''; // Fetch the value
                                    ?>
                                    <option value="None" <?= $selectedGender === 'None' ? 'selected' : '' ?>>None</option>
                                    <option value="Budhisum" <?= $selectedGender === 'Budhisum' ? 'selected' : '' ?>>Budhisum</option>
                                    <option value="Islam" <?= $selectedGender === 'Islam' ? 'selected' : '' ?>>Islam</option>
                                    <option value="Christianity" <?= $selectedGender === 'Christianity' ? 'selected' : '' ?>>Christianity</option>
                                    <option value="Tamil" <?= $selectedGender === 'Tamil' ? 'selected' : '' ?>>Tamil</option>
                                </select>
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Emergency Contact</label>
                                <input required type="text" readonly value="<?= isset($data['children']->Phone_Number) ? $data['children']->Phone_Number : 'None' ?>" class="number">
                            </div>
                            <div class="data">
                                <label>Email</label>
                                <input required type="text" readonly value="<?= (isset($data['children']->Email) && $data['children']->Email !== '') ? $data['children']->Email : 'None' ?>">
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Medications</label>
                                <input readonly style="width: 635px;" type="text">
                                <p class="edit" style="margin-left: 220px;" id="prescriptions">+Add doctor prescriptions
                                </p>
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Medical Conditions</label>
                                <input readonly style="width: 635px;" type="text">
                                <p class="edit" style="margin-left: 260px;" id="documents">+Add documents </p>
                            </div>
                        </div>
                        <div class="datacon">
                            <div class="data">
                                <label>Allergies</label>
                                <input type="text" name="Allergies" value="<?= (isset($data['children']->Allergies) && $data['children']->Allergies !== '') ? $data['children']->Allergies : 'None' ?>" style="width: 635px;">
                            </div>
                        </div>
                        <input type="hidden" name="images" style="display: none;" id="images">
                        <input type="hidden" name="files" style="display: none;" id="files">
                        <div class="Save-con" style="margin-top: 20px;">
                            <button class="Save" type="button" onclick="window.location.href='<?= ROOT ?>/Child/ChildProfile'">
                                Cancel
                            </button>
                            <button class="Save" type="submit">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prescriptions = document.getElementById('prescriptions');
            const prescriptionsModal = document.getElementById('prescriptionModal');
            const left = document.getElementById('left');
            const right = document.getElementById('right');
            const Profilecard = document.getElementById('Profilecard');
            const prescriptionimg = document.getElementById('prescription-img');
            const backforprescription = document.getElementById('backforprescription');
            const documents = document.getElementById('documents');
            const documnetModal = document.getElementById('documentModal');
            const fileListContainer = document.getElementById('fileListContainer');
            const backfordocument = document.getElementById('backfordocument');
            const deleteImageBtn = document.getElementById('delete-image-btn');
            const add = document.getElementById('file-btn');
            const fileInput = document.getElementById('file-input');
            const imageInput = document.getElementById('image-input')

            documents.addEventListener('click', function () {
                documnetModal.style.display = 'flex';
                Profilecard.style.filter = "blur(10px)";
            })

            backfordocument.addEventListener('click', function () {
                documnetModal.style.display = 'none';
                Profilecard.style.filter = "blur(0px)";
            })

            backforprescription.addEventListener('click', function () {
                prescriptionsModal.style.display = 'none';
                Profilecard.style.filter = "blur(0px)";
            })

            prescriptions.addEventListener('click', function () {
                prescriptionsModal.style.display = 'flex';
                Profilecard.style.filter = "blur(10px)";
            });

            // Initialize the images array
            let images = <?= json_encode($data['medications'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
            let currentIndex = 0;

            const addprescription = document.getElementById('addprescription');
            addprescription.addEventListener('click', function () {
                imageInput.click(); // Trigger the file input click
            });

            // Event listener for the image input change (when a new image is selected)
            imageInput.addEventListener('change', function () {
                if (imageInput.files.length) {
                    const file = imageInput.files[0]; // Take the first file

                    const reader = new FileReader();
                    reader.onload = function (event) {
                        // Create a new image object with all relevant file details
                        const newImage = {
                            MedicationImage: event.target.result, // Base64-encoded image
                            OriginalName: file.name, // File name
                            FileType: file.type, // MIME type (e.g., image/png)
                            FileSize: file.size, // File size in bytes
                            LastModified: new Date(file.lastModified).toISOString(), // Last modified date
                        };

                        // Add the new image to the images array
                        images.push(newImage);

                        // Set the current index to the last image (the newly added one)
                        currentIndex = images.length - 1;

                        // Update the prescription modal to show the newly added image
                        updateImage();

                        // Optionally, scroll to the latest image in the modal
                        prescriptionimg.scrollIntoView({ behavior: 'smooth', block: 'center' });

                        // Debugging (optional): Log the image details
                        console.log("Image added:", newImage);
                    };

                    // Read the file as base64 data URL
                    reader.readAsDataURL(file);
                }
            });


            // Function to update the prescription image displayed in the modal
            function updateImage() {
                if (images.length > 0) {
                    prescriptionimg.src = images[currentIndex].MedicationImage; // Set the image source to the current image
                    console.log('Displaying image:', prescriptionimg.src);
                } else {
                    prescriptionimg.src = ''; // Clear the image if there are no images
                    console.log('No images available');
                }
            }

            // Left arrow to navigate through images
            left.addEventListener('click', function () {
                currentIndex = (currentIndex - 1 + images.length) % images.length; // Go to the previous image
                updateImage();
            });

            // Right arrow to navigate through images
            right.addEventListener('click', function () {
                currentIndex = (currentIndex + 1) % images.length; // Go to the next image
                updateImage();
            });

            // Delete the current image functionality
            deleteImageBtn.addEventListener('click', function () {
                if (images.length > 0) {
                    // Remove the current image from the array
                    images.splice(currentIndex, 1);

                    // If the current image is the last one, go to the previous one
                    if (currentIndex >= images.length) {
                        currentIndex = images.length - 1;
                    }

                    // Update the image view after deletion
                    if (images.length > 0) {
                        updateImage();
                    } else {
                        prescriptionimg.src = ''; // If no images left, clear the image
                        console.log('No images available');
                    }
                }
            });


            let files = <?= json_encode($data['documents'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;

            add.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                // Check if there are files selected
                if (fileInput.files.length) {
                    // Loop over the files selected by the user
                    for (const file of fileInput.files) {
                        const reader = new FileReader();
                        
                        reader.onload = function(event) {
                            // Create a new file object with necessary properties
                            const newFile = {
                                OriginalName: file.name,
                                FileType: file.type,
                                UploadedFile: event.target.result.split('base64,')[1], // Extract base64 data
                                UploadDate: new Date().toISOString(),
                                ChildID: 1 // Adjust based on your needs
                            };
                            
                            // Add the new file to the `files` array
                            if (!files || !Array.isArray(files)) {
                                // If `files` is not an array, initialize it as an empty array
                                files = [];
                            }

                            // Add the new file to the array
                            files.push(newFile)
                            
                            // Re-render the modal after the file is added
                            renderFileList();
                        };
                        
                        // Read the file as a data URL (base64)
                        reader.readAsDataURL(file);
                    }
                } else {
                    console.log("No files selected.");
                }
            });

            // Function to render the file list
            function renderFileList() {
                // Clear the current file list
                fileListContainer.innerHTML = '';

                if(Array.isArray(files) && files.length > 0){
                    files.forEach((file, index) => {
                        const fileDiv = document.createElement('div');
                        fileDiv.className = "file-entry";
                        fileDiv.style.textAlign = "left";
                        fileDiv.style.marginBottom = '15px'; // Add some spacing between file entries

                        // Create a container for the file name and buttons
                        const fileNameContainer = document.createElement('div');
                        fileNameContainer.className = 'file-name-container';
                        fileNameContainer.style.display = 'flex';
                        fileNameContainer.style.alignItems = 'center';
                        fileNameContainer.style.justifyContent = '';

                        // Display the filename
                        const viewLink = document.createElement('a');
                        viewLink.href = `data:${file.FileType};base64,${file.UploadedFile}`; // Extract the base64 string
                        viewLink.target = "_blank";
                        viewLink.textContent = file.OriginalName;
                        viewLink.className = "view-link";

                        // Create a div for the buttons
                        const buttonsDiv = document.createElement('div');
                        buttonsDiv.style.display = 'flex';
                        buttonsDiv.style.gap = '10px'; // Create space between the buttons

                        // Create the download button
                        const downloadButton = document.createElement('button');
                        downloadButton.textContent = "Download";
                        downloadButton.className = "download-button";
                        downloadButton.onclick = function () {
                            const link = document.createElement('a');
                            link.href = `data:${file.FileType};base64,${file.UploadedFile}`;
                            link.download = file.OriginalName;
                            link.click();  // Trigger the download
                        };

                        // Create the delete button
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = "Delete";
                        deleteButton.className = "delete-button";
                        deleteButton.onclick = function () {
                            // Remove the file from the files array
                            files.splice(index, 1);

                            // Re-render the modal after deletion
                            renderFileList();
                        };

                        // Append the buttons to the buttons div
                        buttonsDiv.appendChild(downloadButton);
                        buttonsDiv.appendChild(deleteButton);

                        // Append the filename and buttons div to the file name container
                        fileNameContainer.appendChild(viewLink);
                        fileNameContainer.appendChild(buttonsDiv);

                        // Append the file name container to the main file div
                        fileDiv.appendChild(fileNameContainer);

                        // Append the file div to the file list container
                        fileListContainer.appendChild(fileDiv);
                    });
                }
            }


            // Initial render of the file list (in case there are pre-existing files)
            renderFileList();

            // Select necessary elements
            const imageEditIcon = document.getElementById('image-edit');  // Edit icon
            const addCon = document.getElementById('add-con');  // Container that holds the file input and plus icon
            const profileInput = document.getElementById('fileInput');  // File input element for image upload
            const profileImage = document.getElementById('img');  // Profile image element

            // Show the file input when the edit icon is clicked
            imageEditIcon.addEventListener('click', function() {
                profileImage.style.display = 'none';
                imageEditIcon.style.display = 'none';
                addCon.style.display = 'block';  // Show the input container
            });

            addCon.addEventListener('click', function(){
                profileInput.click();
            });

            // Handle file selection
            profileInput.addEventListener('change', function() {
                if (profileInput.files.length > 0) {
                    const file = profileInput.files[0];  // Get the selected file
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        // Update the profile image with the selected file
                        profileImage.src = event.target.result;
                        
                        // Hide the file input container after the image is selected
                        addCon.style.display = 'none';
                        profileImage.style.display = 'block';
                        imageEditIcon.style.display = 'block';
                    };

                    // Read the file as a Data URL (base64)
                    reader.readAsDataURL(file);
                }
            });

            document.getElementById('Form').addEventListener('submit', function () {
                document.getElementById('images').value = JSON.stringify(images);
                document.getElementById('files').value = JSON.stringify(files);
            });

        });
    </script>
</body>

</html>