document.addEventListener('DOMContentLoaded', function () {
    const dateElements = document.querySelectorAll('.date');
    const timeElements = document.querySelectorAll('.time');
    const pickupForm = document.getElementById('pickupForm');
    const refreshIcon = document.getElementById('pickuprefresh');
    const openModalBtn = document.getElementById('openPickupModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const pickupModal = document.getElementById('pickupModal');
    const pickupModal2 = document.getElementById('pickupModal2');
    const meetingbtn = document.getElementById('openMeetingModal');
    const meetingModal = document.getElementById('MeetingModal');
    const mainContent = document.querySelector('.main-content');
    const backformeeting = document.getElementById('backformeeting');
    const meetingrefresh = document.getElementById('meetingrefresh');
    const meetingform = document.getElementById('meeting-form');
    const closemeetingBtn = document.getElementById('closemeetingBtn');
    const checkboxes = document.querySelectorAll('.checkboxes');
    const profilebtn = document.querySelector('.profilebtn');
    const profilecard = document.getElementById('profileCard');

    function previewNewPersonImage(event) {
        const file = event.target.files[0];
    
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const newPersonContainer = document.getElementById("newPersonContainer");
                const newPersonImage = document.getElementById("newPersonImage");
    
                newPersonImage.src = e.target.result;
                newPersonContainer.style.display = "flex"; // Show the new person section
    
                // Automatically select the new person
                selectPerson("new");
            };
            reader.readAsDataURL(file);
        }
    }
    
    function selectPerson(personType) {
        if (personType === "parent") {
            document.getElementById("parentRadio").checked = true;
            document.getElementById("newPersonRadio").checked = false;
            document.getElementById("selectedPersonType").value = "parent";
        } else {
            document.getElementById("parentRadio").checked = false;
            document.getElementById("newPersonRadio").checked = true;
            document.getElementById("selectedPersonType").value = "new";
        }
    }

    profilebtn.addEventListener('click',function(){
        console.log('lol');
        profilecard.style.display = 'flex';
        profilecard.style.zIndex = 10000;
        profilecard.style.flexDirection = 'start';
    });

    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            checkboxes.forEach(function (otherCheckbox) {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        });
    });

    backformeeting.addEventListener('click', function () {
        toggleModal(meetingModal, 'none');
    });

    closemeetingBtn.addEventListener('click', function () {
        toggleModal(meetingModal, 'none');
    });

    meetingbtn.addEventListener('click', function () {
        toggleModal(meetingModal, 'flex');
    });

    if(openModalBtn){
        openModalBtn.addEventListener('click', function (){
            toggleModal(pickupModal, 'flex');
        })
    }

    closeModalBtn.addEventListener('click', function () {
        toggleModal(pickupModal, 'none');
    });

    meetingrefresh.addEventListener('click', function () {
        meetingform.reset();
    })

    window.addEventListener('click', function (e) {
        if (e.target === pickupModal) {
            toggleModal(pickupModal, 'none');
        }
        if (e.target === pickupModal2) {
            toggleModal(pickupModal2, 'none');
        }
        if (e.target === meetingModal) {
            toggleModal(meetingModal, 'none');
        }
    });

    backforpickup.addEventListener('click', function () {
        toggleModal(pickupModal, 'none');
    });

    function toggleModal(modal, display) {
        modal.style.display = display;
        if (display === 'flex' || display == 'block') {
            document.body.classList.add('no-scroll');
            mainContent.classList.add('blurred');
            console.log('blur');
        } else {
            document.body.classList.remove('no-scroll');
            mainContent.classList.remove('blurred');
        }
    }

    if(messageDropdown){
        messageDropdown.addEventListener('mouseleave', function () {
            messageDropdownTimeout = setTimeout(function () {
                messageDropdown.style.display = 'none';
            }, 300);
        });
    }

    // Function to clear selected dates
    function clearSelectedDates() {
        dateElements.forEach(function (date) {
            date.classList.remove('select');
        });
    }

    function clearSelectedTimes() {
        timeElements.forEach(function (time) {
            time.classList.remove('select');
        });
    }

    refreshIcon.addEventListener('click', function () {
        pickupForm.reset();
        redstar.classList.remove('hidden');
        redstar2.classList.remove('hidden');
    });

});
