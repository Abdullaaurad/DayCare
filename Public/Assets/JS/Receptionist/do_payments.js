
const proceedButton = document.querySelector('.apply'); 
const submitButton = document.querySelector('.submit'); 
const hiddenDetails = document.querySelector('.hidden_details');
const Popup = document.querySelector(".popup_section");
const Popup_button = document.querySelector(".popup_close");
const whole = document.querySelector(".wholeform");

proceedButton.addEventListener('click', function () {

    hiddenDetails.style.display = 'flex'; 
});
submitButton.addEventListener('click', function () {
    whole.style.display = 'none'; 
    Popup.style.display = 'flex'; 

});
Popup_button.addEventListener('click', function () {
    Popup.style.display = 'none'; 
    hiddenDetails.style.display = 'none';
    
});