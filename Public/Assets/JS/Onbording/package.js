document.addEventListener('DOMContentLoaded', function () {
    const days = document.querySelectorAll('.day');
    const spe = document.getElementById('spe');
    const fle = document.getElementById('fle');
    const speModal = document.getElementById('spe-Modal');
    const fleModal = document.getElementById('fle-Modal');

    // to choose day
    days.forEach(day => {
        day.addEventListener('click', function () {
            if (day.classList.contains('selectday')) {
                day.classList.remove('selectday');
            }
            else {
                day.classList.add('selectday');
            }
        })
    })

    // special
    spe.addEventListener('click', function () {
        if(speModal.style.display === 'none'){
            speModal.style.display = 'block'
            fleModal.style.display = 'none'
            spe.style.transform = 'translateY(-10px)';
            fle.style.transform = 'translateY(0px)';
        }
    });

    // flexible
    fle.addEventListener('click', function () {
        if(fleModal.style.display === 'none'){
            fleModal.style.display = 'block';
            speModal.style.display = 'none';
            fle.style.transform = 'translateY(-10px)';
            spe.style.transform = 'translateY(0px)';
        }
    });
});