document.addEventListener('DOMContentLoaded', function() {
    const messageDropdown = document.getElementById('messageDropdown');
    const bellIcon = document.getElementById('bell-container');

    let messageDropdownTimeout;

    bellIcon.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleBellDropdown();
    });

    if(messageDropdown){
        messageDropdown.addEventListener('mouseenter', function() {
            clearTimeout(messageDropdownTimeout);
        });
    }

    document.addEventListener('click', function(event) {
        if(messageDropdown){
            if (!messageDropdown.contains(event.target) && !bellIcon.contains(event.target)) {
                messageDropdown.style.display = "none";
            }
        }
    });

});