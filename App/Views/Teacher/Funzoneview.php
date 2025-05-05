<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="<?=CSS?>/Teacher/styles.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/variables.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Teacher/funzone.css?v=<?= time() ?>">
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
                <?php if(isset($result)):?>
                <img src="<?=$result['image']?>">
                    <div class="sidebar-header-content">
                        <h3><?= $result['firstName'] ?> <?= $result['lastName'] ?></h3>
                        <?php endif; ?>
                        <h4>Teacher</h4>
                    </div>
                </div>
                <div class="sidebar-list">
                    <a href="<?=ROOT?>/Teacher/Dashboard" class="sidebar-list-item" id="dashboard-link"> 
                        <i class='bx bxs-dashboard'></i>
                        <span class="text">Dashboard</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Funzone" class="sidebar-list-item" id="home-link">
                    <i class="fa-solid fa-puzzle-piece"></i>
                        <span class="text">Funzone</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Reports" class="sidebar-list-item" id="report-link">
                        <i class='bx bxs-report' ></i>
                        <span class="text"> Report </span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Students" class="sidebar-list-item" id="students-link">
                        <i class='bx bxs-group' ></i>
                        <span class="text">Students</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Leaves" class="sidebar-list-item" id="leaves-link">
                        <i class='bx bx-calendar' ></i>
                        <span class="text">Leaves</span>
                    </a>
                    <a href="<?=ROOT?>/Teacher/Message" class="sidebar-list-item" id="chat-link" >
                        <i class='bx bx-message-square-detail'></i>
                        <span class="text">Messages</span>
                    </a>
                    
                   
                    
        
                </div>
            </div>
        </div>



        
        <div class="wrapper-1">

             <!-- ********* FUN ZONE CONTENT ADDING **********-->


            <div class="funzone-popup-container" id="funzone-popup-container" >
                <form action="<?=ROOT?>/Teacher/Funzone/addMedia" method="post" enctype="multipart/form-data" id="funzone-form">
                <div class="funzone-content">
                    <div class="funzone-header">
                        <i class="fa-solid fa-upload"></i>
                        <h3>Upload Resources</h3>
                        <img src="<?=ROOT?>/assets/images/logo.png">
                    </div>
                    
                    <div class="selects">
                        <div class="age">
                            <label for="date">Age Group</label>
                            <select name="AgeGroup" >
                                <option disabled selected value="">Select</option>
                                <option value="3-5">3-5</option>
                                <option value="6-9">6-9</option>
                                <option value="10-13">10-13</option>
                            </select>
                        </div>
                        <div class="type">
                            <label for="type">Media Type</label>
                            <select name="MediaType">
                            <option disabled selected value="">Select</option>
                                <option value="Audio">Audio</option>
                                <option value="Video">Video</option>
                                <option value="Image">Image</option>
                                <option value="Text">Text</option>
                            </select>
                        </div>
                            
                    </div>
                    <div class="title">
                        <h4>Title</h4>
                        <input type="text" name="Title" placeholder="Add file title" id ="title-input" />
                        <span  style="color: red;" id="title-error"></span>
                    </div>

                    <div class="funzone-footer">
                        <h4>Description</h4>
                        <input type="text" name="Description" placeholder="Add file description" id="description-input"/>
                        
                        <span  style="color: red;" id="des-error"></span>
                    </div>

                    <div class="drag-and-drop">
                        <div class="foramts">
                            <i class="fa-regular fa-file"></i>
                            <i class="fa-regular fa-image"></i>
                            <i class="fa-regular fa-file-lines"></i>
    
                        </div>
                        <h3>Drag and drop files to upload or </h3>
                        <div class="file-select">
                             <input type="file" name="file" id="file" >
                        </div>
                        
                        <p>Supported Files: JPG, PNG, PDF, DOCX</p>
                    </div>
                   
                    <div class="funzone-buttons">
                        <button type = "button"class="cancel"  onclick="closeFunZone()">Cancel</button>
                        <button class="done" id="" type="submit">Done</button>
                    </div>
                </form>
                </div>
    
    
            </div> 

            <!-- ********* FUN ZONE CONTENT EDITING  **********-->


            <div class="funzone-popup-edit" id="funzone-popup-edit" >
                <form>
                <div class="edit-funzone-content">
                    <div class="funzone-header">
                        <i class="fa-solid fa-upload"></i>
                        <h3>Upload Resources</h3>
                        <img src="<?=ROOT?>/assets/images/logo.png">
                    </div>
                    
                    <div class="selects">
                        <div class="age">
                            <label for="date">Age Group</label>
                            <select name="AgeGroup" id="age_groups">
                                <option disabled selected value="">Select</option>
                                <option value="3-5">3-5</option>
                                <option value="6-9">6-9</option>
                                <option value="10-13">10-13</option>
                            </select>
                        </div>
                        <div class="type">
                            <label for="type">Media Type</label>
                            <select name="MediaType" id="media_types">
                            <option disabled selected value="">Select</option>
                                <option value="Audio">Audio</option>
                                <option value="Video">Video</option>
                                <option value="Image">Image</option>
                                <option value="Text">Text</option>
                            </select>
                        </div>
                            
                    </div>
                    <div class="title">
                        <h4>Title</h4>
                        <input type="text" name="Title" placeholder="Add file title" id="title-inputs" required/>
                       
                    </div>

                    <div class="funzone-footer">
                        <h4>Description</h4>
                        <input type="text" name="Description" placeholder="Add file description" id="description-inputs" />
                        <p>You will be notified once the import is successful</p>
                    </div>

                    <div class="drag-and-drop">
                        <div class="foramts">
                            <i class="fa-regular fa-file"></i>
                            <i class="fa-regular fa-image"></i>
                            <i class="fa-regular fa-file-lines"></i>
    
                        </div>
                        <h3>Drag and drop files to upload or </h3>
                        <div class="file-select">
                             <input type="file" name="file" id="files" >
                             
                        </div>
                        <p id="current-file-name"></p>
                        <p>Supported Files: JPG, PNG, PDF, DOCX</p>
                    </div>
                    <input type="hidden"  id="media-id">
                    <input type="hidden" id="url">
                    <div class="funzone-buttons">
                        <button type = "button"class="cancel"   onclick="cancelFunZone()">Cancel</button>
                        <button type="button" class="done" onclick="submitEdit(event)">Done</button>


                    </div>
                </form>
                </div>
    
    
            </div> 

            <div class="navabr">
                <div class="navbar-left">
                    <a href="#"><h2>Hey <?= $result['firstName'] ?> <?= $result['lastName'] ?></h2></a>
                    <h4>Empowering Excellence in Every Lesson!</h4>
                </div>
                <div class="navbar-right">
                <!-- <div class="alter-icon"></div>
                <a href="#" class="notification" onclick="toggleNotify()" id = "notificationIcon">
                   
                    <i class='bx bxs-bell' ></i>
                </a> -->
                <a href="#" class="profile">
                    <img src="<?=$result['image']?>" onclick="toggleMenu()" id="profileIcon">
                </a>
                </div>
    
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="<?=$item->image?>" alt="">
                            <h3>Sara Bretney</h3>
                        </div>
                        <hr>
    
                        <a href="<?=ROOT?>/Teacher/Profile" class="sub-menu-link">
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
                <!-- <div class="notify-menu" id="notify">
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
                        <a href="<?=ROOT?>/Teacher/Notifications" onclick="toggleNotify()" class="all-btn">See all</a>
                    </div>
                </div>  -->
    
            </div>
        <div class="content">
            <div class="backgorund-overlay" ></div>
            <div class="funzone-page">
                <div class="funzone-page-header">
                <i class="fa-solid fa-puzzle-piece"></i>
                    <h3>Fun Zone</h3>  
                                        
                </div>
                <hr>
                

                <div class="filter-group">
                    <div class="filters">
                       
                        
                        <div class="age-select">
                            <label for="date">Age Group</label>
                            <form id="ageForm" action="<?=ROOT?>/Teacher/Funzone/selectbyAge" method="POST">
                                <select name="age-group" onchange="document.getElementById('ageForm').submit()">
                                    <option value="">Select Age Group</option>
                                    <option value="3-5">3-5</option>
                                    <option value="6-9">6-10 </option>
                                    <option value="10-13">11-13 </option>
                                </select>
                            </form>

                        </div>
                        <button class="upload" id="open-funzone" onclick="showFunzone()"><i class="fa-solid fa-plus"></i>Upload a file</button>
                    </div>
                    
                </div> 
                <?php if (!empty(($message))): ?>
                <div class="error-message">
                       
                           <?php foreach($message as $error): ?>
                            <p><li><?= $error ?></li></p>
                            <?php endforeach; ?>
                       
                        </div>
                        <?php endif; ?>
                <div class="student-table">
               
                    
                    
                    <div class="student-table-title">
                        <h4 class="file-name"><i class="fa-solid fa-file"></i>File Name</h4>
                        <h4 class="status"><i class="fa-solid fa-check"></i>Description</h4>
                        <h4 class="last-md"><i class="fa-solid fa-clock"></i>Date Created</h4>
                        <h4 class="up"><i class="fa-solid fa-user"></i>Uploaded By</h4>
                        <h4 class="actions"><i class="fa-regular fa-circle-check"></i>Actions</h4>
                    </div>
                   
                    <div class="table-rows">
                  
                       

                        <?php if(isset($media)):?>
                            <?php foreach($media as $item):?>
                        <div class="student-row">
                        <div class="first-row">
                            <img src="<?=IMAGE?>/mp4.png">
                            <p class="row-items name"><?= $item->Title ?></p></div>
                            <p class="row-items center small"><?=$item->Description?></p>
                            <p class="row-items center opacity"><?=$item->DateTime?></p>

                           
                            <div class="upload">
                                <img src="<?=$item->image?>">
                                <div class="upld-person">
                                    <p class="name"><?= $item->firstName?>&nbsp<?= $item->lastName?></p>
                                    <p class="email"><?= $item->email?></p>    
                                </div>
                            </div>
                        
                       
                            <div class="actions center">
                                <button type="button" class="edit-btn" onclick='showEditFunzone(<?=json_encode($item)?>)'>Edit
                                <i class='bx bxs-edit-alt' ></i>
                                </button>
                                <form action="<?=ROOT?>/Teacher/Funzone/removeMedia" method = "POST">
                                    <input type="hidden" name="id" value="<?= $item->MediaID?>">
                                    <button type="submit" class="dlt-btn">Delete
                                    <i class='bx bx-trash-alt' ></i>
                                    </button>
                                </form>
                                
                            </div>                      
                        </div>
                        <?php endforeach;?>
                        <?php endif; ?>  
                        

                    </div>
                   
                </div>
            </div>
            
       
        </div>
        
    </div>
    </div>
    


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   </script>
    <script src="<?=JS?>/Teacher/funzone.js"></script>
   
    <script>

        const showEditFunzone = (item) => {
          // console.log(item.file);

    try {
        // Parse the leave object if it's a string
        if (typeof leave === 'string') {
            item = JSON.parse(item);
        }
        
        const editContainer = document.getElementById("funzone-popup-edit");
        
        if (editContainer) {
            // Show the edit container by adding the class
            editContainer.classList.add("show-funzone-edit");
            
            // //Set form field values from the leave object
            if (document.querySelector('#age_groups')) {
                document.querySelector('#age_groups').value = item.AgeGroup;
            }
            if (document.querySelector('#media_types')) {
                document.querySelector('#media_types').value = item.MediaType;
            }

            const title = editContainer.querySelector('#title-inputs')
            title.value = item.Title;

            const descrpt = editContainer.querySelector('#description-inputs')
            descrpt.value = item.Description;

            const fileInput = editContainer.querySelector('#files');
            const file = fileInput ? fileInput.files[0] : null;

            const currentFile = editContainer.querySelector('#current-file-name')
            
            if(currentFile && item.URL){
                const urlParts = item.URL.split('/');
                const fileName = urlParts[urlParts.length - 1];
                currentFile.innerHTML = `Current file: <a href="${item.URL}" target="_blank">${fileName}</a>`;
            }

            const mediaIdInput = document.getElementById('media-id');
            if (mediaIdInput) {
                mediaIdInput.value = item.MediaID;  // Set Media ID
            }

            const url = document.getElementById('url');
            if (url) {
                url.value = item.URL;
            }
            
           
           
        } else {
            console.error("Edit container not found!");
        }
    } catch (error) {
        // console.error("Error opening edit form:", error);
        // console.error("Leave data:", item);
    }
};

const submitEdit = (event) => {
    event.preventDefault(); // STOP form from submitting & reloading page

    const mediaId = document.querySelector('#media-id').value;
    const title = document.querySelector('#title-inputs').value;
    const description = document.querySelector('#description-inputs').value;
    const ageGroup = document.querySelector('#age_groups').value;
    const mediaType = document.querySelector('#media_types').value;
    const fileInput = document.querySelector('#files');
    const url = document.querySelector('#url').value;
    const file = fileInput;

    const formData = new FormData();
    formData.append('mediaId', mediaId);
    formData.append('title', title);
    formData.append('description', description);
    formData.append('ageGroup', ageGroup);
    formData.append('mediaType', mediaType);
    formData.append('url', url);
    if (file) {
        formData.append('file', file);
    }

    fetch('<?=ROOT?>/Teacher/Funzone/editMedia', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("✅ Media updated successfully!",data);
            alert("✅ Media updated successfully!");
            window.location.reload();
        } else {
            console.error("❌ Error updating media:", data.message);
            alert("Error updating media");
        }
    })
    .catch(error => {
        console.error("❌ Error:", error);
        alert("❌ An error occurred while updating the media.");
    });
};

       
        
        // function editMedia(mediaId){
        //     console.log(mediaId);
        //     fetch('<?=ROOT?>/Teacher/Funzone/editMedia', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json'
        //             },
        //             body: JSON.stringify({
        //                 mediaId: mediaId
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 console.log(data);
        //                 window.location.reload();
        //             } else {
        //                 console.error("Failed to fetch meal plan:", data.message);
        //                 alert(data.message);
        //             }
        //         })
        //         .catch(error => console.error("Error:", error));
        // }





    </script>
    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
    

    <script src="https://kit.fontawesome.com/73dcf6eb33.js" crossorigin="anonymous"></script>
</body>
</html>