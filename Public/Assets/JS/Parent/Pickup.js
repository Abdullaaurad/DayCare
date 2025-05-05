document.addEventListener('DOMContentLoaded', function() {
    const visitrefreshIcon = document.getElementById('visitrefresh');
    const visitForm = document.getElementById('visitForm');
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const pickupModal = document.getElementById('pickupModal');
    const refreshIcon = document.getElementById('pickuprefresh');
    const pickupForm = document.getElementById('pickupForm');

    openModalBtn.addEventListener('click', function () {
        toggleModal(pickupModal, 'flex');
    });

    closeModalBtn.addEventListener('click', function () {
        toggleModal(pickupModal, 'none');
    });

    openvisitModal.addEventListener('click', function () {
        toggleModal(visitModal, 'flex');
    });

    // Close Visit Modal
    closeVisitModalBtn.addEventListener('click', function () {
        toggleModal(visitModal, 'none');
    });

    visitrefreshIcon.addEventListener('click', function () {
        clearSelectedDates();
        clearSelectedTimes();
        visitForm.reset();
    });

    // Close Modal if clicking outside
    window.addEventListener('click', function (e) {
        if (e.target === pickupModal) {
            toggleModal(pickupModal, 'none');
        }
        if (e.target === visitModal) {
            toggleModal(visitModal, 'none');
        }
    });

    function toggleModal(modal, display) {
        modal.style.display = display;
        mainContent.classList.toggle('blurred', display === 'flex');
    }

    backforpickup.addEventListener('click', function() {
        toggleModal(pickupModal, 'none');
    });

    window.addEventListener('click', function (e) {
        if (e.target === pickupModal) {
            toggleModal(pickupModal, 'none');
        }
    });
});