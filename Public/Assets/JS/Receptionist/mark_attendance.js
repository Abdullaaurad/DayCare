// Function to toggle attendance status
function toggleAttendanceStatus() {
    // Select all the attendance status buttons
    const attendanceButtons = document.querySelectorAll('.attendance_button');

    // Loop through each attendance button and add an event listener
    attendanceButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Toggle the classes for the button between "not_checked_button" and "checked_button"
            if (button.classList.contains('not_checked_button')) {
                // If the button is "not_checked_button", change to "checked_button" (Present)
                button.classList.remove('not_checked_button');
                // button.classList.add('checked_button');
                button.textContent = 'Present'; // Optional: update text to 'Present'
            } else if (button.classList.contains('checked_button')) {
                // If the button is "checked_button", change to "not_checked_button" (Absent)
                button.classList.remove('checked_button');
                // button.classList.add('not_checked_button');
                button.textContent = 'Absent'; // Optional: update text to 'Absent'
            }
        });
    });
}

// Call the function to initialize event listeners when the page is loaded
document.addEventListener('DOMContentLoaded', () => {
    toggleAttendanceStatus();
});
/*
document.getElementById('attendanceButton').addEventListener('click', function() {
    this.classList.toggle('clicked');
    if (this.classList.contains('clicked')) {
        this.textContent = 'Done';
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
        document.getElementById('checkInTime').textContent = timeString;
    } else {
        this.textContent = 'Mark';
        document.getElementById('checkInTime').textContent = '';
    }
});
document.getElementById('attendanceButton1').addEventListener('click', function() {
    this.classList.toggle('clicked');
    if (this.classList.contains('clicked')) {
        this.textContent = 'Done';
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
        document.getElementById('checkInTime1').textContent = timeString;
    } else {
        this.textContent = 'Mark';
        document.getElementById('checkInTime1').textContent = '';
    }
});*/

document.querySelectorAll('.attendanceButton').forEach(button => {
    button.addEventListener('click', function() {
        this.classList.toggle('clicked');
        const checkInTimeSpan = this.nextElementSibling;
        if (this.classList.contains('clicked')) {
            this.style.display = 'none';
            const now = new Date();
            const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
            checkInTimeSpan.textContent = timeString;
        } else {
            this.textContent = 'Mark';
            checkInTimeSpan.textContent = '';
        }
    });
});