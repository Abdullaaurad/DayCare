document.addEventListener("DOMContentLoaded", function () {
    // report froms refresh and back buttons
    const refresh = document.getElementById('refresh');
    const refresh2 = document.getElementById('refresh2');
    const email = document.getElementById('email');
    const category = document.getElementById('category');
    const description = document.getElementById('description');
    const back = document.getElementById('back');

    refresh.addEventListener('click', function () {
        email.value = '';
        category.value = '';
        description.value = '';
    });

    refresh2.addEventListener('click', function () {
        email.value = '';
        category.value = '';
        description.value = '';
    });

    back.addEventListener('click',function(){
        window.history.back();
    })
});