document.addEventListener('DOMContentLoaded', function() {
    const snackModal = document.getElementById('snackModal');
    const SnackModalButton = document.getElementById('openSnackModal');
    const closeSnackModalButton = document.getElementById('closeSnackModal');

    SnackModalButton.addEventListener('click', function() {
        if (snackModal.classList.contains('show')){
            snackModal.classList.remove('show');
        }
        else{
            snackModal.classList.add('show');
        }
    });

    closeSnackModalButton.addEventListener('click', function() {
        snackModal.classList.remove('show');
    });

    document.addEventListener('click', function(event) {
        if (!snackModal.contains(event.target) && !openSnackModalButton.contains(event.target)) {
            snackModal.classList.remove('show');
        }
    });
});