<!DOCTYPE html>
<html>
<title>Parent</title>
<link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= CSS ?>/Parent/profile.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= CSS ?>/Parent/childrens.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= CSS ?>/Parent/Alert.css?v=<?= time() ?>">
<link rel="stylesheet" href="<?= CSS ?>/Parent/deletepopup.css?v=<?= time() ?>">

<head>
</head>
<body>
    <div class="Profilecard">
        <div class="Profile">
            <p style="margin-top: 0px; margin-bottom: 0px; cursor: pointer; color: rgba(35, 83, 167, 1);">Manage Children</p>
        </div>
        <div class="ProfileContainer">
            <div class="cards">
                <?php if (!empty($data['children'])): ?>
                    <?php foreach ($data['children'] as $child): ?>
                        <div class="report-card">
                            <div class="card-content">
                                <div class="profile">
                                    <img src="<?= $child['image'] ?? '<?= IMAGE ?>/default-profile.png' ?>" class="face" width="70px">
                                </div>
                                <div class="card-details">
                                    <h4><?= htmlspecialchars($child['fullname']) ?></h4>
                                </div>
                                <div class="card-footer">
                                    <button onclick="viewProfile(<?= htmlspecialchars($child['Id']) ?>)">View</button>
                                    <button class="del" onclick="openDeleteModal(<?= htmlspecialchars($child['Id']) ?>)">Delete</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No children found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deletePopup" class="delete-popup-overlay" style="display: none;">
        <div class="delete-popup-content">
            <p>Are you sure you want to delete this child?</p>
            <div class="delete-popup-buttons">
                <button id="confirmDelete" class="delete-popup-btn delete-popup-confirm">Yes</button>
                <button id="cancelDelete" class="delete-popup-btn delete-popup-cancel">No</button>
            </div>
        </div>
    </div>

    <!-- Success Modal (Initially Hidden) -->
    <div id="successPopup" class="verification-alert" style="display: none; top: 10.5%;">
        <div class="alert-icon">
            <img src="<?=IMAGE?>/success.svg" alt="success icon">
        </div>
        <div class="alert-message">
            <h1>Deletion Successful!</h1>
        </div>
    </div>

    <script>
        let selectedChildId = null;

        function viewProfile(ChildID) {
            console.log(ChildID);
            fetch(' <?= ROOT ?>/Parent/Home/setchildsession', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        ChildID: ChildID
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Child Id set in session.");
                        window.location.href = '<?= ROOT ?>/Child/ChildProfile';
                    } else {
                        console.error("Failed to set child ID in session at " + window.location.href + " inside function setChildSession.", data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function openDeleteModal(childId) {
            selectedChildId = childId;
            document.getElementById("deletePopup").style.display = "flex";
        }

        function closeDeleteModal() {
            document.getElementById("deletePopup").style.display = "none";
            selectedChildId = null;
        }

        document.getElementById("cancelDelete").addEventListener("click", closeDeleteModal);

        document.getElementById("confirmDelete").addEventListener("click", function () {
            if (selectedChildId) {
                fetch("<?= ROOT ?>/Parent/ManageChildren/DeleteChild", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ ChildID: selectedChildId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        closeDeleteModal();
                        showSuccessModal();
                    } else {
                        alert("Failed to delete child. Try again.");
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });

        function showSuccessModal() {
            let successPopup = document.getElementById("successPopup");
            successPopup.style.display = "flex";

            setTimeout(() => {
                successPopup.style.display = "none";
                location.reload(); // Refresh page after success message
            }, 2000); // Show for 2 seconds before reload
        }
    </script>
</body>
</html>
