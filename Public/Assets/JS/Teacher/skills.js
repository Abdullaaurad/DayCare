

function openPopup(childID){
    const popup = document.getElementById('skill-popup-container');
    const input =  document.getElementById('id-input')
    popup.classList.add('show-skill-popup');
  

    let childId = childID;
    input.value = childId;
}

const closePopup = ()=>{
    const popup = document.getElementById('skill-popup-container');
    popup.classList.remove('show-skill-popup');
}