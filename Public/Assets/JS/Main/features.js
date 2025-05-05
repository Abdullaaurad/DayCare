document.addEventListener('DOMContentLoaded', function () {
        //main body
    const content = document.getElementById('content');
    const body = document.getElementById('body');

    // billing popup
    const billingbtn = document.getElementById('billing-btn');
    const billingModal = document.getElementById('billing-Modal');
    const backbilling = document.getElementById('back-billing');

    backbilling.addEventListener('click',function(){
        billingModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    billingbtn.addEventListener('click', function () {
        billingModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });

    //pickup popup
    const pickupbtn = document.getElementById('pickup-btn');
    const pickupModal = document.getElementById('pickup-Modal');
    const backpickup = document.getElementById('back-pickup'); 

    backpickup.addEventListener('click',function(){
        pickupModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    pickupbtn.addEventListener('click', function () {
        pickupModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });
    
    //funzone popup
    const funzonepbtn = document.getElementById('funzone-btn');
    const funzoneModal = document.getElementById('funzone-Modal');
    const backfunzone = document.getElementById('back-funzone');  

    backfunzone.addEventListener('click',function(){
        funzoneModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    funzonepbtn.addEventListener('click', function () {
        funzoneModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });

    //activity popup
    const activitybtn = document.getElementById('activity-btn');
    const activityModal = document.getElementById('activity-Modal');
    const backactivity = document.getElementById('back-activity');

    backactivity.addEventListener('click',function(){
        activityModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    activitybtn.addEventListener('click', function () {
        activityModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });

    //reservation popup
    const reservationbtn = document.getElementById('reservation-btn');
    const reservationModal = document.getElementById('reservation-Modal');
    const backreservation = document.getElementById('back-reservation');

    backreservation.addEventListener('click',function(){
        reservationModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    reservationbtn.addEventListener('click', function () {
        reservationModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });

    //message popup
    const messagebtn = document.getElementById('message-btn');
    const messageModal = document.getElementById('message-Modal');
    const backmessage = document.getElementById('back-message');

    backmessage.addEventListener('click',function(){
        messageModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    messagebtn.addEventListener('click', function () {
        messageModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });

    //safety popup
    const safetybtn = document.getElementById('safe-btn');
    const safetyModal = document.getElementById('safe-Modal');
    const backsafety = document.getElementById('back-safe');

    backsafety.addEventListener('click',function(){
        safetyModal.style.display = 'none';
        content.style.filter = "none";
        body.style.overflow = 'scroll';
    })

    safetybtn.addEventListener('click', function () {
        safetyModal.style.display = 'flex';
        content.style.filter = "blur(10px)";
        body.style.overflow = 'hidden';
    });
});