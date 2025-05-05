/*const select_row =  document.querySelectorAll(".select_row");
const main_list = document.querySelectorAll(".main");

select_row.addEventListener("click", () => {
    main_list.classList.toggle("active_list");
});*/

// Select all dropdown rows
const selectRows = document.querySelectorAll(".select_row");
const mainLists = document.querySelectorAll(".main");

// Loop through all rows and add event listeners
selectRows.forEach((row, index) => {
    row.addEventListener("click", () => {
        // Toggle the corresponding .main list (based on index)
        mainLists[index].classList.toggle("active_list");
    });
});
const select_check = document.querySelector(".select-check");
const option_list_check = document.querySelector(".option-list-check");
const options_check = document.querySelectorAll(".option-check");

select_check.addEventListener("click", () => {
    option_list_check.classList.toggle("active");
    select_check.querySelector(".fa-angle-down").classList.toggle("fa-angle-up")
});

options_check.forEach((option) => {
    option.addEventListener("click", () => {
        options_check.forEach((option) => {option.classList.remove('selected')});
        select_check.querySelector("span").innerHTML=option.innerHTML;
        option.classList.add('selected');
        option_list_check.classList.toggle("active");
        select_check.querySelector(".fa-angle-down").classList.toggle("fa-angle-up")
    });
});

let child1_content = document.querySelector(".child1");
let checkList1 = document.querySelector(".children");

child1_content.addEventListener("click", () => {
    // Use getComputedStyle and fallback to an empty string if not found
    const currentDisplay = window.getComputedStyle(checkList1).display;
    
    if (currentDisplay === "none" || currentDisplay === "") {
        checkList1.style.display = "block"; // Show it as a flex container
    } else {
        checkList1.style.display = "none"; // Hide it
    }
});

const check_in_button = document.querySelector(".check_in-check");


check_in_button.addEventListener("click", () => {
   
    select_check.querySelector(".checked_button").classList.toggle("not_checked_button")
});


