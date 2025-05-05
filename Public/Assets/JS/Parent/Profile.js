document.addEventListener('DOMContentLoaded', function() {
    const profileCard = document.querySelector('.profile-card');
    const profileButton = document.querySelector('.profilebtn');
    const backButton = document.querySelector('.profile-card .back');

    let profileCardTimeout;

    function showProfileCard() {
        console.log("Hi")
        profileCard.classList.add('show');
        profileButton.classList.add('active');
    }

    function hideProfileCard() {
        profileCard.classList.remove('show');
        profileButton.classList.remove('active');
    }

    profileButton.addEventListener('click', function() {
        showProfileCard();
    });

    backButton.addEventListener('click', function() {
        hideProfileCard();
    });

    document.addEventListener('click', function(event) {
        if (!profileCard.contains(event.target) && !profileButton.contains(event.target)) {
            hideProfileCard();
        }
    });

    profileCard.addEventListener('mouseenter', function() {
        clearTimeout(profileCardTimeout);
    });

    profileCard.addEventListener('mouseleave', function() {
        profileCardTimeout = setTimeout(function() {
            hideProfileCard();
        }, 300);
    });
});