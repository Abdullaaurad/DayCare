const openMedic = () => {

    medicPopup = document.getElementById("medical-report");
    medicPopup.classList.add("show-medic");
};

const closeBtn = document.getElementById("close-report");
const medical = document.getElementById("medical-report");

closeBtn.addEventListener('click', ()=> {
    medicPopup.classList.remove("show-medic");
})