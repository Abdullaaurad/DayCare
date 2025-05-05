

//OPEN KIDDO SCHEDULE
function showKiddo(workId,teacherID) {
    console.log("Received WorkID:", workId);
    console.log("Received TeacherID:", teacherID);

    const kiddoContainer = document.getElementById("kiddo-schedule-container");
    const inputBox1 = document.getElementById("today-task-id");
    const inputBox2 = document.getElementById("today-teacher-id");

    if (inputBox1) inputBox1.value = workId;
    if (inputBox2) inputBox2.value = teacherID;

    if (kiddoContainer) {
        kiddoContainer.classList.add("show-kiddo");
    }
}

//CLOSE KIDDO SCHDEULE

const closekiddo = ()=>{
    event.preventDefault();
    const closeBtn = document.getElementById("close-kiddo");
    const kiddoContainer = document.getElementById("kiddo-schedule-container");
    kiddoContainer.classList.remove("show-kiddo");
}


function deleteTask(taskId) {

    //console.log("Task ID: " + taskId);
    // Make sure the ID is valid
    if (!taskId) {
        console.log("Task ID not found");
        alert("Invalid Task ID");
        return;
    }

    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    var root = '<?= ROOT ?>';
    xhr.open("POST", root+ "/kiddoSchedule/delete", true); // Set the URL to call the delete method
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    console.log(root);
    // Set up the data to be sent
    var data = "id=" + taskId;
  
    // Define what to do when the request completes
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // If task is deleted, remove it from the page
            var response = xhr.responseText;
            if (response === "Task deleted successfully") {
                alert(response);
                // Optionally, remove the task element from the DOM
                var taskElement = document.getElementById('task-' + taskId);
                if (taskElement) {
                    taskElement.remove(); // Remove the task element from the page
                }
            } else {
                alert(response);
            }
        }
    };

    // Send the request with the data
    xhr.send(data);
}

//filtering daily tasks



//OPEN PROFILE SUBMENU
const toggleMenu = ()=>{
    const subMenu = document.getElementById("subMenu")
        subMenu.classList.toggle("open-menu");

}
document.addEventListener("click", (event) => {
    const subMenu = document.getElementById("subMenu");
    const profileIcon = document.getElementById("profileIcon");
   


    // Check if the click is outside the menu and the notification icon
    if (!subMenu.contains(event.target) && !profileIcon.contains(event.target)) {
        subMenu.classList.remove("open-menu");
    }
    
});


//OPEN NOTIFICAITON SUBMENU
const toggleNotify = ()=>{
    const notifyMenu = document.getElementById("notify");
    notifyMenu.classList.toggle("open-notify");
}

document.addEventListener("click", (event) => {
    const notifyMenu = document.getElementById("notify");
    const notificationIcon = document.getElementById("notificationIcon");
   


    // Check if the click is outside the menu and the notification icon
    if (!notifyMenu.contains(event.target) && !notificationIcon.contains(event.target)) {
        notifyMenu.classList.remove("open-notify");
    }
    
});



//open edit daily task popup

//OPEN KIDDO SCHEDULE

const showTaskEdit = (actID,desc)=>{
    
    console.log("Received ActivityID:", actID);
    console.log("Received ActivityID:", desc);

    const kiddoContainer = document.getElementById("task-edit-container");
    const editBox = document.getElementById("edit-task-id")
    const descBox = document.getElementById("task-description")

    if (editBox) editBox.value = actID;
    if (descBox) descBox.value = desc;

    if(kiddoContainer){
        kiddoContainer.classList.add("show-task-edit")
    }

}

//CLOSE KIDDO SCHDEULE

const closeTaskEdit = ()=>{
    event.preventDefault();
    const closeBtn = document.getElementById("close-kiddo");
    const kiddoContainer = document.getElementById("task-edit-container");
    kiddoContainer.classList.remove("show-task-edit");
}







