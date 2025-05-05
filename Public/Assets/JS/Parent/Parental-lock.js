document.addEventListener('DOMContentLoaded', () => {
    const lock=document.getElementById('toggle');
    const lockpassword = document.getElementById('lock-password');
    const profileCard = document.getElementById('profileCard');

    lock.addEventListener('change', function() {
        const icon = document.querySelector('.toggle-icon i');
        if (this.checked) {
            icon.classList.remove('fa-unlock');
            icon.classList.add('fa-lock');
            lockpassword.style.display = 'flex';
        }
        else{
            icon.classList.remove('fa-lock');
            icon.classList.add('fa-unlock');
            lockpassword.style.display = 'none';
        }
    });
});