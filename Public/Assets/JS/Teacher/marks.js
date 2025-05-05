document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('dataForm');
    const container = document.getElementById('container');
    const detailsContainer = document.getElementById('detailsContainer');

    // Load data from local storage on page load
    //const savedData = JSON.parse(localStorage.getItem('formData'));

    // if (savedData) {
    //     createCard(savedData.name, savedData.regNo);
    //     expandContainer();
    // }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Get input values
        const name = document.getElementById('name').value;
        const regNo = document.getElementById('regNo').value;

        if (!name || !regNo) {
            alert('Please fill out all fields.');
            return;
        }

        // Save data to local storage
        // const formData = { name, regNo };
        // localStorage.setItem('formData', JSON.stringify(formData));

        // Create the card
        createCard(name, regNo);
        expandContainer();

        // Clear form inputs
       // form.reset();
    });

    function createCard(name, regNo) {
        // Clear previous content
        detailsContainer.innerHTML = '';

        // Create card
        const card = document.createElement('div');
        card.classList.add('card');
        card.innerHTML = `
            <h4>${name}</h4>
            <p>Reg No: ${regNo}</p>
        `;

        // Append card
        detailsContainer.appendChild(card);
    }

    function expandContainer() {
        container.style.display = 'flex';
        detailsContainer.style.flex=1;
    }



});

let slider = document.getElementById("range"); 
let value = document.querySelector(".value");

value.textContent = slider.value;

function calcValue(){
    let valuePercent = (slider.value/ slider.max) * 100;
    slider.style.background = `linear-gradient(to right, #3974ba ${valuePercent}%, #c4ced7 ${valuePercent}%)`;
}


slider.addEventListener('input', () => {
   calcValue();
    value.textContent = slider.value; // Fixed the typo in 'textContent'
});

/* Second Slider */

let slider1 = document.getElementById("range-1"); 
let value1 = document.querySelector(".value-1");

value1.textContent = slider1.value;

function calcValue1(){
    let valuePercent = (slider1.value/ slider1.max) * 100;
    slider1.style.background = `linear-gradient(to right, #d4c012 ${valuePercent}%, #ebe5ad ${valuePercent}%)`;
}


slider1.addEventListener('input', () => {
   calcValue1();
   value1.textContent = slider1.value; // Fixed the typo in 'textContent'
});


/* Third Slider */

let slider2 = document.getElementById("range-2"); 
let value2 = document.querySelector(".value-2");

value2.textContent = slider2.value;

function calcValue2(){
    let valuePercent = (slider2.value/ slider2.max) * 100;
    slider2.style.background = `linear-gradient(to right, #4caf50 ${valuePercent}%, #9adf9d ${valuePercent}%)`;
}


slider2.addEventListener('input', () => {
   calcValue2();
   value2.textContent = slider2.value; // Fixed the typo in 'textContent'
});

/* Fourth Slider */

let slider3 = document.getElementById("range-3"); 
let value3 = document.querySelector(".value-3");

value3.textContent = slider3.value;

function calcValue3(){
    let valuePercent = (slider3.value/ slider3.max) * 100;
    slider3.style.background = `linear-gradient(to right, #b718b7 ${valuePercent}%, #de91de ${valuePercent}%)`;
}


slider3.addEventListener('input', () => {
   calcValue3();
   value3.textContent = slider3.value; // Fixed the typo in 'textContent'
});


/* Fifth Slider */

let slider4 = document.getElementById("range-4"); 
let value4 = document.querySelector(".value-4");

value4.textContent = slider4.value;

function calcValue4(){
    let valuePercent = (slider4.value/ slider4.max) * 100;
    slider4.style.background = `linear-gradient(to right, #e3641b ${valuePercent}%, #daad93 ${valuePercent}%)`;
}


slider4.addEventListener('input', () => {
   calcValue4();
   value4.textContent = slider4.value; // Fixed the typo in 'textContent'
});
