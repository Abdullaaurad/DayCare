<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Onbording.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Onbording/Package.css?v=<?= time() ?>">
    <style>
        .error {
            color: red !important;
            margin-left: 0px !important;
            font-size: 15px;
            margin-top: 0px;
            margin-bottom: -15px;
        }

        .delete {
            margin-top: 0px;
            padding: 10px;
            border-radius: 20px;
            background-color: #3498db;
            margin-left: -50px;
            margin-bottom: 440px;
        }
    </style>
</head>

<body>
    <form method="post" id="details" enctype="multipart/form-data" action="<?=ROOT?>/Onbording/Package/handleFormSubmission">
        <!-- container to get details -->
        <div class="Profilecard">
            <div style="background-color: #60a6ec; width: 350px; height: 600px; border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
                <img src="<?= IMAGE ?>/logo_light-remove.png" style="width:70px">
                <div class="heading">
                    <h1>Let's Create Your</h1>
                    <h1>Personalized</h1>
                    <h1>Profile for a</h1>
                    <h1>Tailored</h1>
                    <h1>Experienece!</h1>
                </div>
                <div class="text">
                    <p> Share your details for a smooth</p>
                    <p>and safe Daycare Experienece</p>
                </div>
                <div class="circles">
                    <div class="circle"></div>
                    <div class="circle select"></div>
                    <div class="circle"></div>
                </div>
            </div>
            <div class="ProfileContainer" style="flex-direction: column !important;">
                <div style="display: flex; flex-direction: row; justify-content: flex-start; margin-top: 20px; margin-left: 20px;">
                    <div class="toggle">
                        <label class="background" for="toggle"></label>
                        <div style="display: flex; flex-direction: row; justify-content: space-between; width: 30%;">
                            <label class="up-btn" id="up-btn">Fixed</label>
                            <label class="hi-btn" id="hi-btn">Custom</label>
                        </div>
                    </div>
                </div>
                <div id="spe-Modal">
                    <div class="datacon" style="margin-top: 10px;">
                        <div class="data">
                            <h1 style="color: #10639a; text-align: center;">Attending Days</h1>
                            <div class="days">
                                <div class="day" data-day="Sun" style="margin-left:0px">Sun</div>
                                <div class="day" data-day="Mon">Mon</div>
                                <div class="day" data-day="Tue">Tue</div>
                                <div class="day" data-day="Wed">Wed</div>
                                <div class="day" data-day="Thu">Thur</div>
                                <div class="day" data-day="Fri">Fri</div>
                                <div class="day" data-day="Sat">Sat</div>
                            </div>
                            <div style="display: none">
                                <input type="checkbox" id="day-Sun" name="selectedDays[]" value="Sunday">
                                <input type="checkbox" id="day-Mon" name="selectedDays[]" value="Monday">
                                <input type="checkbox" id="day-Tue" name="selectedDays[]" value="Tuesday">
                                <input type="checkbox" id="day-Wed" name="selectedDays[]" value="Wednesday">
                                <input type="checkbox" id="day-Thu" name="selectedDays[]" value="Thursday">
                                <input type="checkbox" id="day-Fri" name="selectedDays[]" value="Friday">
                                <input type="checkbox" id="day-Sat" name="selectedDays[]" value="Saturday">
                            </div>
                        </div>
                    </div>
                    <div class="datacon" style="margin-top: 10px; font-weight: bold;color: #10639a !important;">
                        <label> if the day count stay the same the payment amoutn will not change </label>
                    </div>
                    <div class="datacon" style="margin-top: -5px;font-weight: bold; color:  #10639a !important;">
                        <label> For additional days of visit a extra payment will be added</label>
                    </div>
                    <div class="package" id="packages" style="display: flex; flex-direction: row; margin-top: 20px; width: 350px; height: 190px; margin-left: auto; margin-right: auto; text-align: left; overflow-x: scroll;">
                    </div>

                    <div class="payment-option" style="margin-top: 0px;">
                        <input type="checkbox" id="payment-now">
                        <label for="payment-now" style="color:  #10639a; font-weight: bold;">
                            Payment can be made now or 2 weeks later
                        </label>
                    </div>
                </div>
                <!-- If person wants to change days dynamically packages -->
                <div id="fle-Modal" style="display: none; justify-content: center; align-items: center; margin-top: 90px;">
                    <h1 style="color: #10639a; text-align: center">Dynamic Payment Details </h1>
                    <div class="datacon" style="margin-top: 40px !important; font-weight: bold;color:  #10639a !important;">
                        <label> After a daycare attendance the payment for the day will be added to the account </label>
                    </div>
                    <div id="dynamic"> 

                    </div>
                </div>
                <!-- <?php echo !empty($data['value']['count'] >= 5) ? 'flex-end' : 'space-between '; ?> -->
                <div class="datacon" style="margin-top: 500px; position: fixed; flex-direction: row; justify-content: <?php echo $data['value']['count'] >= 5 ? 'flex-end' : 'space-between '; ?>; margin-right: 20px;">
                    <?php
                    if (!empty($data['value']['count']) && $data['value']['count'] < 5) {
                        echo <<<HTML
                <div class="data" style="margin-top: 40px;">
                    <button name="action" value="child" type="submit" id="add-btn" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-bottom: -40px;">Add Children<i class="fa fa-chevron-right" style="margin-left: 4px;"></i></button>
                </div>
            HTML;
                    }
                    ?>
                    <div class="data" style="margin-top: 40px;">
                        <button name="action" value="guardian" type="submit" id="submit" style="font-weight: 600; width: 200px; font-size: 20px; padding: 7px; background-color:rgb(67, 99, 154) !important; color: white !important; margin-bottom: -40px; margin-left: <?php echo ($data['value']['count'] >= 5)? '470px': '260px;' ?>"><?php echo ($data['guardian'])? 'Add Guardian' : 'exit' ;?><i class="fa fa-chevron-right" style="margin-left: 4px;"></i></button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
    <script>

        function updatePackagesDisplay(packages) {
            console.log("Received Packages:", packages); // Debugging log

            // Ensure `packages` is an array (convert from object if necessary)
            if (packages && !Array.isArray(packages)) {
                packages = Object.values(packages);
            }

            // Get the container and clear it before adding new items
            const packagesContainer = document.getElementById('packages');
            packagesContainer.innerHTML = ''; 

            // Get at most 3 packages
            const displayedPackages = packages ? packages.slice(0, 3) : [];

            if (displayedPackages.length === 0) {

                const packageDiv = document.createElement('div');
                const nameLabel = document.createElement('label');
                nameLabel.textContent = "No available packages";
                packageDiv.appendChild(nameLabel);
                packageDiv.style.alignItems = 'center';
                packageDiv.style.justifyContent = 'center';
                packagesContainer.appendChild(packageDiv);
                return;
            }

            displayedPackages.forEach(pkg => {
                const packageDiv = document.createElement('div');
                packageDiv.classList.add('package-item');
                packageDiv.style.display = "flex";
                packageDiv.style.minWidth = "330px"; // Ensures proper spacing
                packageDiv.style.flexDirection = "column";
                packageDiv.style.border = "1px solid #ddd";
                packageDiv.style.padding = "10px";
                packageDiv.style.marginTop = '-20px';
                packageDiv.style.margin = "10px 0";
                packageDiv.style.borderRadius = "8px";
                packageDiv.style.alignItems = 'center';
                packageDiv.style.background = "#f9f9f9";
                packageDiv.style.gap = "20px";
                packageDiv.style.marginRight = "30px";

                // Checkbox
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.name = 'selectedPackage';
                checkbox.value = pkg.PackageID;
                checkbox.id = `package-${pkg.PackageID}`;
                checkbox.style.marginTop = "-10px";
                checkbox.style.marginBottom = "-10px";
                checkbox.style.justifyContent = 'right';
                checkbox.style.width = "20px";
                checkbox.style.height = "20px";
                checkbox.style.marginRight = '-300px';

                // Ensure only one checkbox is selectable
                checkbox.addEventListener('change', function() {
                    document.querySelectorAll('input[name="selectedPackage"]').forEach(cb => {
                        if (cb !== this) cb.checked = false;
                    });
                });

                const nameLabel = document.createElement('label');
                nameLabel.textContent = pkg.Name;
                nameLabel.style.fontWeight = "bold";
                nameLabel.style.marginBottom = "-10px";

                let details = '';
                if (pkg.FoodAddons) {
                    details += "Food add ons included" ;
                }
                if (pkg.AllHours) {
                    details += "🕒 24-hour reservation included";
                }
                if (pkg.Everything || (pkg.FoodAddons && pkg.AllHours)) {
                    details = "✅ All services included";
                }
                if(details === ''){
                    details = "No services included";
                }

                const description = document.createElement('div');
                description.style.display = "flex";
                description.style.justifyContent = "space-between";
                description.style.padding = "5px 0";
                description.style.marginBottom = '-30px';
                description.innerHTML = `<label>description</label><span>: ${details}</span>`;

                // Weekday Price
                const weekdayPrice = document.createElement('div');
                weekdayPrice.style.display = "flex";
                weekdayPrice.style.justifyContent = "space-between";
                weekdayPrice.style.padding = "5px 0";
                weekdayPrice.style.borderBottom = '3px solid lightgrey';
                weekdayPrice.innerHTML = `<label>Price</label><span>: Rs ${pkg.Price}</span>`;

                // Append elements
                packageDiv.appendChild(nameLabel);
                packageDiv.appendChild(description);
                packageDiv.appendChild(weekdayPrice);
                packageDiv.appendChild(checkbox);
                packagesContainer.appendChild(packageDiv);
            });

            console.log("UI Updated Successfully!");
        }


        function fetchPackages(data) {
            console.log(data);
            fetch('<?= ROOT ?>/Onbording/Package/store_package', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    data: data
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.data);
                    updatePackagesDisplay(data.data);
                } else {
                    console.error("Failed to set child id from session.", data.message);
                }
                })
                .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const upbtn = document.getElementById('up-btn');
            const hibtn = document.getElementById('hi-btn');
            const upcoming = document.getElementById('spe-Modal');
            const history = document.getElementById('fle-Modal');

            upbtn.addEventListener('click', function() {
                upbtn.style.backgroundColor = '#10639a';
                hibtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'block';
                history.style.display = 'none';
            });

            hibtn.addEventListener('click', function() {
                hibtn.style.backgroundColor = '#10639a';
                upbtn.style.backgroundColor = '#60a6ec';
                upcoming.style.display = 'none';
                history.style.display = 'block';
                days.forEach(day => {
                    day.classList.remove('selectday');
                })
            });

            const days = document.querySelectorAll('.day');
            days.forEach(dayDiv => {
                dayDiv.addEventListener("click", function () {
                    const dayValue = dayDiv.getAttribute("data-day");
                    const checkbox = document.getElementById(`day-${dayValue}`);

                    // Toggle checkbox and add/remove 'selected' class
                    checkbox.checked = !checkbox.checked;
                    dayDiv.classList.toggle("selectday");

                    // Collect selected days
                    const selectedDays = [];
                    document.querySelectorAll("input[name='selectedDays[]']:checked").forEach(input => {
                        selectedDays.push(input.value);
                    });

                    // Send selected days via AJAX
                    fetchPackages(selectedDays);
                });
            });
        });
    </script>
</body>

</html>