document.addEventListener('DOMContentLoaded', function () {

    const mainContent = document.getElementById('main-content');
    const profilebtn = document.querySelector('.profilebtn');
    const pickupForm = document.getElementById('pickupForm');
    const refreshIcon = document.getElementById('pickuprefresh');
    const pickupModal = document.getElementById('pickupModal');
    const openModalBtn = document.getElementById('openPickupModal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    backforpickup.addEventListener('click', function () {
        toggleModal(pickupModal, 'none');
    });

    if(openModalBtn){
        openModalBtn.addEventListener('click', function (){
            console.log("hi")
            toggleModal(pickupModal, 'flex');
        })
    };

    closeModalBtn.addEventListener('click', function () {
        toggleModal(pickupModal, 'none');
    });

    window.addEventListener('click', function (e) {
        if (e.target === pickupModal) {
            toggleModal(pickupModal, 'none');
        }
    });

    refreshIcon.addEventListener('click', function () {
        pickupForm.reset();
        redstar.classList.remove('hidden');
        redstar2.classList.remove('hidden');
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
});
