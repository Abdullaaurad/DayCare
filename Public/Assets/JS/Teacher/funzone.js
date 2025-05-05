
function showFunzone(){
    console.log("function running");
    const popup = document.getElementById("funzone-popup-container");
    popup.classList.add("show-funzone");
}

//show edit popup



function closeFunZone(){
    const popup = document.getElementById("funzone-popup-container");
    popup.classList.remove("show-funzone");
};

function cancelFunZone(){
    const popup = document.getElementById("funzone-popup-edit");
    popup.classList.remove("show-funzone-edit");
};



$(document).ready(function (){
    fetchMedia();
    $('#media_name').on('keyup',function(){
        let media_name = $(this).val();
        fetchMedia(media_name);
    });
});

function fetchMedia(media_name = ''){
    console.log("typed : ",media_name);
    $.ajax({
        url:"<?=ROOT?>/Teacher/Funzone",
        method:"POST",
        data:{
            action: 'SearchMedia',
            media_name: media_name
        },
        dataType:"json",
        success:function(data){
            console.log(data);
            $('#media_list').html(data.media_list);
        },
        error: function(xhr, status, error) {
            console.error("AJAX failed:", status, error);
            console.log("Response text:", xhr.responseText);
        }
    });
}



document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('funzone-form').addEventListener('submit', function (e) {
        const funzoneBox = document.getElementById("title-input");
        const fun = funzoneBox.value.trim();
        const description = document.getElementById("description-input");
        const des = description.value.trim();
        const titleError = document.getElementById("title-error");
        const desError = document.getElementById("des-error");

        if(fun === ''){
           
            titleError.textContent = "Task title cannot be empty.";
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



// function editMedia(mediaId){
//     console.log(mediaId);
//     fetch('<?=ROOT?>/Teacher/Funzone/editMedia', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 mediaId: mediaId
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 console.log(data);
//                 window.location.reload();
//             } else {
//                 console.error("Failed to fetch meal plan:", data.message);
//                 alert(data.message);
//             }
//         })
//         .catch(error => console.error("Error:", error));
// }