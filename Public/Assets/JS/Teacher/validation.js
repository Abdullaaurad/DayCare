
//validaiton for task creation

console.log("valdiaiton");
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById("task-form-submit").addEventListener('submit', function (e) {
        const taskBox = document.getElementById("task-des");
        const taskBoxName = taskBox.value.trim();
        const taskError = document.getElementById("task-error");
        
        const invalidChars = /[$%.*#]/;
        if(taskBoxName === ''){
           
            taskError.textContent = "Task description cannot be empty.";
            e.preventDefault();
        }else if(invalidChars.test(taskBoxName)){
            taskError.textContent = "Task description cannot contain $, %, ., *, or #.";
            e.preventDefault();
        }else if(taskBoxName.length < 8){
            taskError.textContent = "Task description must be at least 8 characters long.";
            e.preventDefault();
        }
    })


    document.getElementById('funzone-form').addEventListener('submit', function (e) {
        const funzoneBox = document.getElementById("title-input");
        const fun = funzoneBox.value.trim();
        const description = document.getElementById("description-input");
        const des = description.value.trim();
        const titleError = document.getElementById("title-error");
        const desError = document.getElementById("des-error");

        if(fun === ''){
           
            titleError.textContent = "Task description cannot be empty.";
            e.preventDefault();
        }

        
        if(des === ''){
           
            desError.textContent = "Task description cannot be empty.";
            e.preventDefault();
        }else if(des.length < 8){
            desError.textContent = "Task description must be at least 8 characters long.";
            e.preventDefault();
        }
    })

})