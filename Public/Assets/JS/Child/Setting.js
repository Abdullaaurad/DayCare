document.addEventListener('DOMContentLoaded', () => {
    // profile card on click event
    const settingsIcon = document.querySelector('.settings');
    const profileCard = document.getElementById('profileCard');
    const closeProfileCard = document.getElementById('closeProfileCard');

    // let profileCardTimeout;

    settingsIcon.addEventListener('click', () => {
        profileCard.classList.toggle('show');
    });

    closeProfileCard.addEventListener('click', () => {
        profileCard.classList.remove('show');
    });

    // profileCard.addEventListener('mouseenter', () => {
    //     clearTimeout(profileCardTimeout);
    // });

    // profileCard.addEventListener('mouseleave', () => {
    //     profileCardTimeout = setTimeout(() => {
    //         profileCard.classList.remove('show');
    //     }, 3000);
    // });
    
});