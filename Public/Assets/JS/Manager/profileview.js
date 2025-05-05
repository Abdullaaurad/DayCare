
function handleClick() {
    var profileCard = document.getElementById('profileCard');
    profileCard.classList.toggle('show');
}

function handleHide() {
    var profileCard = document.getElementById('profileCard');
    profileCard.classList.remove('show');
}

function handlenotify() {
    var messageDropdown = document.getElementById('notification');
    messageDropdown.classList.toggle('show');
}
const today = new Date();
const options = {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
}; // Customize date format

// Format and display the date
document.getElementById("current-date").textContent = today.toLocaleDateString(undefined, options);