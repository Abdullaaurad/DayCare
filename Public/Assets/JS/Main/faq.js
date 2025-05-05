document.addEventListener('DOMContentLoaded', function () {
    //to toggle between chevron down and up
    //one is clicked than other will be minimized
    var acc = document.getElementsByClassName("accordion");
    var pannels = document.getElementsByClassName("pannel");

    for (var i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            var pannel = this.nextElementSibling;

            // To remove other panels being open when another is clicked
            for (var j = 0; j < pannels.length; j++) {
                if (pannels[j] !== pannel) {
                    acc[j].classList.remove("active");
                    pannels[j].style.display = "none";
                    acc[j].querySelector("i").classList.remove("fa-chevron-up");
                    acc[j].querySelector("i").classList.add("fa-chevron-down");
                }
            }

            if (pannel.style.display === "block") {
                pannel.style.display = "none";
                this.classList.remove("active");
                this.querySelector("i").classList.remove("fa-chevron-up");
                this.querySelector("i").classList.add("fa-chevron-down");
            } else {
                pannel.style.display = "block";
                this.classList.add("active");
                this.querySelector("i").classList.remove("fa-chevron-down");
                this.querySelector("i").classList.add("fa-chevron-up");
            }
        });
    }
});