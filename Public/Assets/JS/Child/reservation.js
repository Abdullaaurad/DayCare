        function deleteReservation(Res_Id) {
            currentResId = Res_Id; // Store Res_Id in a variable
            document.getElementById("confirmationModal").style.display = "flex"; // Show modal
        }

        // Close the modal without deleting
        function closeModal() {
            document.getElementById("confirmationModal").style.display = "none";
            currentResId = null; // Clear the stored Res_Id
        }

        function confirmDelete() {
            console.log("time to delete = ", currentResId);
            if (currentResId) {
                // Send AJAX request
                fetch('<?= ROOT ?>/Parent/Reservation/RemoveReservation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `Res_Id=${currentResId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.message);
                        closeModal();
                        document.getElementById('alert').classList.add('showl');
                        setTimeout(function() {
                            document.getElementById('alert').classList.remove('showl'); // Hide the alert after 6 seconds
                            window.location.reload(); // Reload the page after hiding the alert
                        }, 1000);
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function setChildSession(childName, childId) {
            fetch('<?=ROOT?>/Parent/Reservation/setchildsession', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ childName: childName, childId: childId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(childName);
                    console.log("Child name set in session.");
                    window.location.href = '<?= ROOT ?>/Child/Reservation';
                } else {
                    console.error("Failed to set child name in session.", data.message);
                }
            })
            .catch(error => console.error("Error:",error));
        }

        document.addEventListener('DOMContentLoaded', function () {

            const dateElements = document.querySelectorAll('.date');
            const redstar3 = document.getElementById('red-star3');
            const redstar6 = document.getElementById('red-star6');

            dateElements.forEach(function(date) {
                date.addEventListener('click', function(event) {
                    const dayNumber = date.querySelector('h1').textContent;

                    if (date.classList.contains('select')) {
                        date.classList.remove('select');
                        redstar3.classList.remove('hidden');
                        redstar6.classList.remove('hidden');
                        selectedDate = null;
                    } else {
                        selectedDate = dayNumber;
                        redstar3.classList.add('hidden');
                        redstar6.classList.add('hidden');
                        clearSelectedDates();
                        date.classList.add('select');
                        selectDate(selectedDate);
                    }
                });
            });

            function selectDate(date) {
                console.log("Selected date:", date);
                var dateInput = document.getElementById('date-inputforpost');
                dateInput.value = '2024-11-' + date;

                var allDates = document.querySelectorAll('.date');
                allDates.forEach(function(element) {
                    element.classList.remove('select');
                });

                event.target.closest('.date').classList.add('select');
            }

            function clearSelectedDates() {
                dateElements.forEach(function(date) {
                    date.classList.remove('select');
                });
            }

            const feedbackbtns = document.querySelectorAll('.feedbackbtn');
            const RatingModal = document.getElementById('RatingModal');
            const backformeeting = document.getElementById('backforrating');
            const meetingrefresh = document.getElementById('ratingrefresh');
            const meetingform = document.getElementById('ratingform');
            const closemeetingBtn = document.getElementById('closeratingBtn');
            const stars = document.querySelectorAll('.star-rate');
            const ReservationEditModal = document.getElementById('ReservationModal');
            const mainContent = document.getElementById('main-content');
            const ReservationViewModal = document.getElementById('ReservationViewModal');
            const NewReservationModal = document.getElementById('NewReservationModal');

            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('upcoming');
            const history = document.getElementById('history');
            const headingres = document.getElementById('heading-res');

            upbtn.addEventListener('click', function(){
                upbtn.style.color = 'white';
                hibtn.style.color = 'black';
                upbtn.style.backgroundColor = '#099690';
                hibtn.style.backgroundColor = '#BADBD0';
                upcoming.style.display = 'block';
                history.style.display = 'none';
                headingres.style.marginLeft = '180px';
                headingres.textContent = 'Reervation';
            });

            hibtn.addEventListener('click', function(){
                hibtn.style.color = 'white';
                upbtn.style.color = 'black';
                hibtn.style.backgroundColor = '#099690';
                upbtn.style.backgroundColor = '#BADBD0';
                upcoming.style.display = 'none';
                history.style.display = 'block';
                headingres.style.marginLeft = '140px';
                headingres.textContent = 'Reervation history';
            });

            backformeeting.addEventListener('click', function () {
                toggleModal(RatingModal, 'none');
            })

            closemeetingBtn.addEventListener('click', function () {
                toggleModal(meetingModal, 'none');
            })

            feedbackbtns.forEach(element => {
                console.log("Hi");
                element.addEventListener('click', function () {
                    toggleModal(RatingModal, 'flex');
                })
            });

            window.addEventListener('click', function (e) {
                if (e.target === RatingModal) {
                    toggleModal(RatingModal, 'none');
                }
                if (e.target === ReservationEditModal) {
                    toggleModal(ReservationEditModal, 'none');
                }
                if (e.target === ReservationViewModal) {
                    toggleModal(ReservationViewModal, 'none');
                }
                if (e.target === NewReservationModal) {
                    clearSelectedDates();
                    NewReservationForm.reset();
                    toggleModal(NewReservationModal, 'none');
                }
            });

            function toggleModal(modal, display) {
                modal.style.display = display;
                if (display === 'flex') {
                    document.body.classList.add('no-scroll');
                    mainContent.classList.add('blurred');
                } else {
                    document.body.classList.remove('no-scroll');
                    mainContent.classList.remove('blurred');
                }
            }

            let rating = 0;
            let i = 0;

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    if (star.classList.contains('selectestar') && index === rating - 1) {
                        for (let j = index; j < stars.length; j++) {
                            stars[j].classList.remove('selectestar');
                        }
                        rating -= 1;
                        i -= 1;
                    }
                    else if (index === rating) {
                        stars[index].classList.add('selectestar');
                        rating += 1;
                        i += 1;
                    }
                });
            });

            const reservationeditbtn = document.querySelectorAll('.reservation-edit');
            const backforreservationedit = document.getElementById('backforreservationedit');
            const reservationeditrefresh = document.getElementById('reservationeditrefresh');
            const closeReservationedit = document.getElementById('closeReservationedit');
            const ReservationEditForm = document.getElementById('ReservationEditForm');
            const redstar4 = document.getElementById('red-star4');
            const redstar5 = document.getElementById('red-star5');
            const settime = document.getElementById('settime');

            settime.addEventListener('input',function(){
                if(!settime.value){
                    redstar4.classList.remove('hidden');
                }
                else{
                    redstar4.classList.add('hidden');
                }
            })

            reservationeditbtn.forEach(button => {
                button.addEventListener('click', function () {
                    toggleModal(ReservationEditModal, 'flex');
                });
            });

            backforreservationedit.addEventListener('click', function () {
                toggleModal(ReservationEditModal, 'none');
            });

            closeReservationedit.addEventListener('click', function () {
                toggleModal(ReservationEditModal, 'none');
            });

            let originalDate = null;
            let selectedDate = null;

            reservationeditrefresh.addEventListener('click', function () {
                clearSelectedDates();
                ReservationEditForm.reset();
                dateElements.forEach(date => {
                    if (date.textContent === originalDate) {
                        date.classList.add('select');
                    }
                })
            })

            const reservations = document.querySelectorAll('.reservation');
            const backforreservation = document.getElementById('backforreservation');
            const reservationrefresh = document.getElementById('reservationrefresh');
            const closeReservation = document.getElementById('closeReservation');

            reservations.forEach( reservationbtn => {
                reservationbtn.addEventListener('click',function () {
                    toggleModal(ReservationViewModal, 'flex');
                })
            })

            backforreservation.addEventListener('click', function () {
                toggleModal(ReservationViewModal, 'none');
            });

            closeReservation.addEventListener('click', function () {
                toggleModal(ReservationViewModal, 'none');
            });

            // const newreservationbtn = document.getElementById('newreservationbtn');
            // const NewReservationForm = document.getElementById('NewReservationForm');
            // const backfornewreservation = document.getElementById('backfornewreservation');
            // const newreservationrefresh = document.getElementById('newreservationrefresh');
            // const closenewReservation = document.getElementById('closenewReservation');

            // newreservationbtn.addEventListener('click',function () {
            //     toggleModal(NewReservationModal,'flex');
            // });
            // backfornewreservation.addEventListener('click',function () {
            //     clearSelectedDates();
            //     NewReservationForm.reset();
            //     toggleModal(NewReservationModal,'none');
            // });
            // closenewReservation.addEventListener('click',function () {
            //     clearSelectedDates();
            //     NewReservationForm.reset();
            //     toggleModal(NewReservationModal,'none');
            // });
            // newreservationrefresh.addEventListener('click',function () {
            //     clearSelectedDates();
            //     NewReservationForm.reset();
            // });

            // starttime.addEventListener('input',function(){
            //     if(!starttime.value){
            //         redstar7.classList.remove('hidden');
            //     }
            //     else{
            //         redstar7.classList.add('hidden');
            //     }
            // })
            
            // endtime.addEventListener('input',function(){
            //     if(!endtime.value){
            //         redstar8.classList.remove('hidden');
            //     }
            //     else{
            //         redstar8.classList.add('hidden');
            //     }
            // })

        });