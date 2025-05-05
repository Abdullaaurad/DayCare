// const select = document.querySelector(".select");
// const option_list = document.querySelector(".option-list");
// const options = document.querySelectorAll(".option");

// select.addEventListener("click", () => {
//     option_list.classList.toggle("active");
//     select.querySelector(".fa-angle-down").classList.toggle("fa-angle-up")
// });

// options.forEach((option) => {
//     option.addEventListener("click", () => {
//         options.forEach((option) => {option.classList.remove('selected')});
//         select.querySelector("span").innerHTML=option.innerHTML;
//         option.classList.add('selected');
//         option_list.classList.toggle("active");
//         select.querySelector(".fa-angle-down").classList.toggle("fa-angle-up")
//     });
// });

// document.addEventListener('keydown',function(event){
//     const profile = document.querySelector('.profiles')
//      const size = 370
//      switch (event.key) {
//         case 'ArrowDown' :
//             profile.scrollBy({top: size , behavior:'smooth'});
//             break;
//         case 'ArrowUp' :
//             profile.scrollBy({top: -size , behavior:'smooth'});
//             break;
//         default:
//             break;

//      }
// })


// document.getElementById('myButton').addEventListener('click', function() {
//     this.classList.toggle('clicked');
// });