let currentStartDate = new Date('2024-08-04');
const dateRangeDays = 2;

function formatDate(date) {
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: '2-digit' });
}

function changeDate(direction) {
    if(direction === 'prev') {
        currentStartDate.setDate(currentStartDate.getDate() - dateRangeDays - 1 );
    } 
    else if (direction === 'next') {
        currentStartDate.setDate(currentStartDate.getDate() + dateRangeDays + 1);
    }
    const endDate = new Date(currentStartDate);
    endDate.setDate(endDate.getDate() + dateRangeDays);
    document.getElementById('dateRange').textContent = `${formatDate(currentStartDate)} - ${formatDate(endDate)}`;

    for (let i = 0; i <= dateRangeDays; i++) {
        const headerDate = new Date(currentStartDate);
        headerDate.setDate(currentStartDate.getDate() + i);
        document.getElementById(`dateHeader${i + 1}`).textContent = formatDate(headerDate);
    }
    for (let i = 0; i <= dateRangeDays; i++) {
        const snackHeaderDate = new Date(currentStartDate);
        snackHeaderDate.setDate(currentStartDate.getDate() + i);
        document.getElementById(`snackDateHeader${i + 1}`).textContent = formatDate(snackHeaderDate);
    }  
}

function saveForm() {
    const staff = document.getElementById("staff");
    const ageGroup = document.getElementById("age-group");
    const activity = document.getElementById("activity");
    const startTime = document.getElementById("start-time");
    const endTime = document.getElementById("end-time");
    const location = document.getElementById("location");

    if (staff.value && ageGroup.value && activity.value && startTime.value && endTime.value && location.value) {
        showToast("Form saved successfully!");
    } else {
        showToast("Please fill in all required fields.");
    }
}

function showToast(message) {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.className = "toast show";
    setTimeout(() => {
        toast.className = toast.className.replace("show", "");
    }, 3000); // Toast disappears after 3 seconds
}