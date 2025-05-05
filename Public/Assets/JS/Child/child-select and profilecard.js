document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', (event) => {
        if (!customSelectContainer.contains(event.target) && !customSelectTrigger.contains(event.target)) {
            customSelectContainer.classList.remove('active');
        }

        if (!customChildSelectContainer.contains(event.target) && !customChildSelectTrigger.contains(event.target)) {
            customChildSelectContainer.classList.remove('active');
        }

        if (!profileCard.contains(event.target) && !settingsIcon.contains(event.target)) {
            profileCard.classList.remove('show');
        }
    });
});