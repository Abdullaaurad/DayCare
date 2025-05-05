document.addEventListener('DOMContentLoaded', function () {
    const taskbtn = document.getElementById('taskbtn');
    const taskicon = document.getElementById('taskicon');
    const tasknavbar = document.getElementById('tasknavbar')
    const report1 = document.getElementById('report-header1');
    const report2 = document.getElementById('report-header2');
    const attendance1 = document.getElementById('attendance');
    const attendance2 = document.getElementById('attendance2');
    const pickup = document.getElementById('pickup');
    const social = document.getElementById('social');

    let isNavbarVisible = false;

    taskbtn.addEventListener('click', function () {
        if (!isNavbarVisible) {
            tasknavbar.style.display = "block";
            report1.style.gridTemplateColumns = 'repeat(2, 1fr)';
            report2.style.gridTemplateColumns = 'repeat(2, 1fr)';
            report1.style.width= '600px';
            report2.style.width= '600px';
            attendance1.style.display = 'none';
            attendance2.style.display = 'flex';
            pickup.style.width = '250px';
            social.style.width = '450px';
            setTimeout(() => {
                tasknavbar.style.opacity = "1";
            }, 10);

            isNavbarVisible = true;
        } else {
            // Hide the tasknavbar
            tasknavbar.style.opacity = "0";
            report1.style.gridTemplateColumns = 'repeat(3, 1fr)';
            report2.style.gridTemplateColumns = 'repeat(3, 1fr)';
            report1.style.width= '1000px';
            report2.style.width= '1000px';
            attendance2.style.display = 'none';
            attendance1.style.display = 'flex';
            pickup.style.width = '200px';
            social.style.width = '300px';
            setTimeout(() => {
                tasknavbar.style.display = "none";
            }, 300);

            isNavbarVisible = false;
        }

        // Toggle Button Icon
        taskicon.classList.toggle('fa-chevron-left');
        taskicon.classList.toggle('fa-chevron-right');
    });

    // Close tasknavbar if clicked outside
    window.addEventListener('click', function (event) {
        if (
            !tasknavbar.contains(event.target) &&
            !taskbtn.contains(event.target) &&
            tasknavbar.style.opacity === "1"
        ) {
            tasknavbar.style.opacity = "0";
            report1.style.gridTemplateColumns = 'repeat(3, 1fr)';
            report2.style.gridTemplateColumns = 'repeat(3, 1fr)';
            report1.style.width= '1000px';
            report2.style.width= '1000px';
            attendance2.style.display = 'none';
            attendance1.style.display = 'flex';
            pickup.style.width = '200px';
            social.style.width = '300px';
            setTimeout(() => {
                tasknavbar.style.display = "none";
            }, 300);

            isNavbarVisible = false;
        }
    });
});
