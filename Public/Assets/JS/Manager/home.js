const ctx = document.getElementById('inventoryChart').getContext('2d');

        // const productLabels = ['Jan', 'Feb', 'Mar', 'April', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const productLabels = ['1st', '2nd', '3rd', '4th'];
        const inventoryData = [56, 32, 42, 65]; // Inventory levels for each product

        // Create the bar chart
        const inventoryChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: productLabels,
                datasets: [{
                    label: 'Income in LKR',
                    data: inventoryData, // Inventory data
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1 // Border width for bars
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // Show the legend
                    },
                    tooltip: {
                        enabled: true, // Show tooltips on hover
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true, // Start y-axis at zero
                        title: {
                            display: true,
                            text: 'Income in LKR X 1000' // Y-axis title
                        },
                        ticks: {
                            stepSize: 10
                        },
                        max: 100
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Weekly Income'
                        }
                    }
                }
            }
        });



        const leaveRequests = [{
                name: "Alice Brown",
                type: "Teacher",
                from: "2025-01-01",
                to: "2025-03-01",
                Reason: "Flud"
            },
            {
                name: "Mark Lee",
                type: "Reciptionist",
                from: "2024-12-23",
                to: "2024-12-25",
                Reason: "Sick leave"
            },
        ];

        const container = document.getElementById('leave-requests');

        leaveRequests.forEach(request => {
            const requestDiv = document.createElement('div');
            requestDiv.className = 'request';
            requestDiv.innerHTML = ` <img src="<?= IMAGE ?>/profilePic.png"  class="resize"><p class="l_name"><strong>${request.name}</strong><br>${request.type}</p>
                                         <p style="margin-top: 10%;">From: ${request.from} To: ${request.to}</p>
                                         <p>Reason: ${request.Reason}</p>  <button class="viewbtn">View</button>`;
            container.appendChild(requestDiv);
        });

        const viewButtons = document.querySelectorAll('.viewbtn');
        const overlay = document.getElementById('overlay');
        const popup = document.getElementById('popup');
        const closePopup = document.getElementById('closePopup');

        const popupName = document.getElementById('popup-name');
        const popupDates = document.getElementById('popup-dates');
        const popupReason = document.getElementById('popup-reason');

        viewButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                const requestDiv = e.target.closest('.request');
                const name = requestDiv.getAttribute('data-name');
                const dates = requestDiv.getAttribute('data-dates');
                const reason = requestDiv.getAttribute('data-reason');

                // Set popup content dynamically
                popupName.value = name;
                popupDates.value = dates;
                popupReason.value = reason;

                // Show popup
                popup.style.display = 'block';
                overlay.style.display = 'block';
            });
        });

        // Close Popup
        closePopup.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });

        overlay.addEventListener('click', () => {
            popup.style.display = 'none';
            overlay.style.display = 'none';
        });

        