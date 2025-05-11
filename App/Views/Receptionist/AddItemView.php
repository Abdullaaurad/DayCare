<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="<?=CSS?>/Parent/deletepopup.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Receptionist/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body style="overflow: hidden;">

    <div class="side_bar">
        <div class="userblock">
            <div class="photo">
                <img alt="User profile picture" height="50" src="<?= $data['Profile']->Image ?>" width="50" />
            </div>
            <div class="username">
                <h3>
                    <?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?>
                </h3>
                <p>
                    Receptionist
                </p>
            </div>
        </div>
        <ul>
            <li class="hover-effect unselected first">
                <a href="<?= ROOT ?>/Receptionist/Home">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Receptionist/Attendance">
                    <i class="fas fa-history"></i> <span>Attendance</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Receptionist/Payment">
                    <i class="fa fa-user-shield"></i> <span>Payment</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Receptionist/visitor">
                    <i class="fas fa-calendar-check"></i> <span>Visitor</span>
                </a>
            </li>
            <li class="selected">
                <a href="<?= ROOT ?>/Receptionist/Inventory">
                    <i class="fas fa-boxes"></i> <span>Inventory</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Receptionist/Restock">
                    <i class="fas fa-truck-loading"></i> <span>Restock</span>
                </a>
            </li>
            <li class="hover-effect unselected">
                <a href="<?= ROOT ?>/Receptionist/Leave">
                    <i class="fas fa-utensils"></i> <span>Leave</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header" style="margin-top:12px; height: 80px; margin-left: -10px; width: 102.45%;">
            <div class="header-title">
                <h2 style="font-size: 24px;">
                    Hey
                </h2>
                <p>
                    Start your day happy with little ones !
                </p>
            </div>
            <div class="bell-con" id="bell-container" style="cursor: pointer;">
                <i class="fas fa-bell bell-icon" style="margin-left: -350px; color: white;"></i>
                <?php if (!empty($data['Notification'])): ?>
                    <?php if ($data['Notification']['Seen'] != 0): ?>
                        <div class="message-numbers" id="message-number">
                            <p><?= $data['Notification']['Seen'] != 0 ? $data['Notification']['Seen'] : '' ?></p>
                        </div>
                    <?php endif; ?>
                    <div class="message-dropdown" id="messageDropdown" style="display: none;">
                        <ul>
                            <?php foreach ($data['Notification']['data'] as $row): ?>
                                <li data-id="<?= $row->NotificationID ?>">
                                    <p><?= htmlspecialchars($row->Description) ?></p>
                                    <?php if ($row->Location != NULL): ?>
                                        <a href="<?= ROOT ?>/Child/<?= $row->Location ?>">
                                            <i class="fas fa-paper-plane"></i>
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!-- Prodile btn -->
            <div class="profile">
                <button class="profilebtn">
                    <i class="fas fa-user-circle"></i>
                </button>
            </div>
        </div>
        <!-- Stats -->
        <div class="stats-container" style="margin-top: 1%;">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['RestockDate'] ?></h3>
                    <p>Last Restock Date</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Categories'] ?></h3>
                    <p>Categories</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dolly"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Restocks'] ?></h3>
                    <p>Restocks This Month</p>
                </div>
            </div>
        </div>

        <!-- Inventory Management -->
        <div class="card">
            <div class="card-header">
                <h2>Inventory Items</h2>
                <button class="btn btn-primary" onclick="document.getElementById('addItemModal').style.display='flex'">
                    <i class="fas fa-plus"></i> Add New Item
                </button>
            </div>
            <div class="card-body">
                <!-- Search and Filter -->
                <div>
                    <div>
                        <select class="form-control" id="Category" style="max-width: 150px;">
                            <option value="All">All Categories</option>
                            <option value="Stationery">Stationery</option>
                            <option value="Toys">Toys</option>
                            <option value="Books">Books</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Health">Health</option>
                            <option value="Snacks">Snacks</option>
                            <option value="Crafts">Crafts</option>
                            <option value="Clothing">Clothing</option>
                        </select>
                        <select class="form-control" id="Status" style="max-width: 150px; margin-left: 50px;">
                            <option value="All">All Status</option>
                            <option value="Available">Available</option>
                            <option value="Low Stock">Low Stock</option>
                            <option value="Out of Stock">Out of Stock</option>
                        </select>
                    </div>
                </div>

                <!-- Inventory Table -->
                <div class="table-container" style="margin-top:1.5%">
                    <table>
                        <thead>
                            </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination" id="pagination" style="margin-top: 10px; margin-bottom: -10px;">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Item Modal -->
    <div id="addItemModal" class="modal-backdrop">
        <div class="modal">
            <form method="post" id="Add" enctype="multipart/form-data" action="<?= ROOT ?>/Inventory/InventoryManage/AddItems">
                <div class="modal-header">
                    <h3>Add New Item</h3>
                    <button class="modal-close" onclick="document.getElementById('addItemModal').style.display='none'">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemName">Item Name</label>
                                <input name="Item" type="text" id="itemName" class="form-control" placeholder="Enter item name">
                                <p id="ItemError" style="display: none; color: red;"> Item already exists in stock </p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemCategory">Category</label>
                                <select name="Category" id="itemCategory" class="form-control">
                                    <option value="select" hidden> Select </option>
                                    <option value="Stationery">Stationery</option>
                                    <option value="Toys">Toys</option>
                                    <option value="Books">Books</option>
                                    <option value="Cleaning">Cleaning</option>
                                    <option value="Health">Health</option>
                                    <option value="Snacks">Snacks</option>
                                    <option value="Crafts">Crafts</option>
                                    <option value="Clothing">Clothing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemQuantity">Quantity</label>
                                <input name="Quantity" type="number" id="itemQuantity" placeholder="20" class="form-control" min="0">
                                <p id="QuantityError" style="display: none; color: red;"></p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemMinStock">Minimum Stock Level</label>
                                <input name="MinQuantity" type="number" id="itemMinStock" placeholder="50" class="form-control" min="0">
                                <p id="MinQuantityError" style="display: none; color: red;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="itemDescription">Description</label>
                        <textarea name="Description" id="itemDescription" class="form-control" rows="3" placeholder="Enter item description"></textarea>
                        <p id="DescriptionError" style="display: none; color: red;"></p>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemPrice">Unit Price</label>
                                <input name="Price" type="number" id="itemPrice" class="form-control" min="0" step="0.01" placeholder="100.00">
                                <p id="PriceError" style="display: none; color: red;"></p>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="itemImage">Item Image</label>
                                <input name="Image" required type="file" id="itemImage" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="document.getElementById('addItemModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewItemModal" class="modal-backdrop">
        <div class="modal">
            <div class="modal-header">
                <h3>View Item</h3>
                <button class="modal-close" onclick="document.getElementById('viewItemModal').style.display='none'">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-row" style="display: flex; flex-wrap: wrap;">
                    <!-- Left side: Text Info -->
                    <div class="form-col" style="flex: 1; min-width: 200px;">
                        <div class="form-group">
                            <label for="viewItemName"><strong>Item Name:</strong></label>
                            <p id="viewItemName"></p>
                        </div>
                        <div class="form-group">
                            <label for="viewItemName"><strong>Item ID:</strong></label>
                            <p id="viewItemID"></p>
                        </div>
                        <div class="form-group">
                            <label for="viewItemCategory"><strong>Category:</strong></label>
                            <p id="viewItemCategory"></p>
                        </div>
                        <div class="form-group">
                            <label for="viewItemQuantity"><strong>Quantity:</strong></label>
                            <p id="viewItemQuantity"></p>
                        </div>
                    </div>

                    <!-- Right side: Image -->
                    <div class="form-col" style="flex: 1; text-align: right; min-width: 200px;">
                        <img id="viewItemImage" src="<?=IMAGE?>/face.jpeg" alt="Item Image" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                    </div>
                </div>

                <!-- Optional: Add more fields below -->
                <div class="form-group">
                    <label for="viewItemDescription"><strong>Description:</strong></label>
                    <p id="viewItemDescription"></p>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="viewItemPrice"><strong>Price:</strong></label>
                            <p id="viewItemPrice"></p>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="viewItemMinQuantity"><strong>Min Stock Level:</strong></label>
                            <p id="viewItemMinQuantity"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" onclick="document.getElementById('viewItemModal').style.display='none'">Close</button>
            </div>
        </div>
    </div>

    <div id="editItemModal" class="modal-backdrop" style="display: <?= isset($_SESSION['Edit'])?"flex" : 'none';?>;">
        <div class="modal">
            <form id="editForm" method="post" enctype="multipart/form-data" action="<?=ROOT?>/Inventory/InventoryManage/EditItem">
                <div class="modal-header">
                    <h3>Edit Item</h3>
                    <button type="button" class="modal-close" onclick="document.getElementById('editItemModal').style.display='none'">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-row" style="display: flex; flex-wrap: wrap;">
                        <!-- Left Side -->
                        <div class="form-col" style="flex: 1; min-width: 200px;">
                            <input type="number" name="ItemID" style="display: none;" id="editItemID">

                            <!-- ITEM NAME -->
                            <div class="form-group">
                                <label for="editItemName"><strong>Item Name:</strong></label>
                                <input type="text" id="editItemName" name="Item" class="form-control" required
                                    value="<?= $_SESSION['old']['Item'] ?? '' ?>">
                                <?php if (!empty($_SESSION['errors']['Item'])): ?>
                                    <p class="error-text"><?= $_SESSION['errors']['Item'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- CATEGORY -->
                            <div class="form-group">
                                <label for="editItemCategory"><strong>Category:</strong></label>
                                <select id="editItemCategory" name="Category" class="form-control" required>
                                    <?php
                                        $selected = $_SESSION['old']['Category'] ?? '';
                                        $categories = ['Stationery','Toys','Books','Cleaning','Health','Snacks','Crafts','Clothing'];
                                        foreach ($categories as $cat):
                                    ?>
                                        <option value="<?= $cat ?>" <?= $selected == $cat ? 'selected' : '' ?>><?= $cat ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($_SESSION['errors']['Category'])): ?>
                                    <p class="error-text"><?= $_SESSION['errors']['Category'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- QUANTITY -->
                            <div class="form-group">
                                <label for="editItemQuantity"><strong>Quantity:</strong></label>
                                <input type="number" id="editItemQuantity" name="Quantity" class="form-control" min="0" required
                                    value="<?= $_SESSION['old']['Quantity'] ?? '' ?>">
                                <?php if (!empty($_SESSION['errors']['Quantity'])): ?>
                                    <p class="error-text"><?= $_SESSION['errors']['Quantity'] ?></p>
                                <?php endif; ?>
                            </div>

                            <!-- MIN QUANTITY -->
                            <div class="form-group">
                                <label for="editItemMinQuantity"><strong>Min Stock Level:</strong></label>
                                <input type="number" id="editItemMinQuantity" name="MinQuantity" class="form-control" min="0" required
                                    value="<?= $_SESSION['old']['MinQuantity'] ?? '' ?>">
                                <?php if (!empty($_SESSION['errors']['MinQuantity'])): ?>
                                    <p class="error-text"><?= $_SESSION['errors']['MinQuantity'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Right Side: Image -->
                        <div class="form-col" style="flex: 1; text-align: right; min-width: 200px;">
                        <div style="width: 210px; height: 210px; overflow: hidden; border-radius: 8px; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                            <img id="editItemImagePreview"
                                src="<?=IMAGE?>/Empty.png"
                                alt="Item Image"
                                style="width: 100%; height: 100%; object-fit: contain;">
                        </div>
                            <input type="file" name="Image" id="editItemImage" accept="image/*" class="form-control" style="margin-top: 12px;">
                            <div class="form-group" style="text-align: left; margin-top: 19px;">
                                <label for="editItemPrice"><strong>Price:</strong></label>
                                <input type="number" id="editItemPrice" name="Price" class="form-control" min="10" step="0.01" required
                                    value="<?= $_SESSION['old']['Price'] ?? '' ?>">
                                <?php if (!empty($_SESSION['errors']['Price'])): ?>
                                    <p class="error-text"><?= $_SESSION['errors']['Price'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editItemDescription"><strong>Description:</strong></label>
                        <textarea id="editItemDescription" name="Description" rows="3" class="form-control" required><?= $_SESSION['old']['Description'] ?? '' ?></textarea>
                        <?php if (!empty($_SESSION['errors']['Description'])): ?>
                            <p class="error-text"><?= $_SESSION['errors']['Description'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editItemModal').style.display='none'">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deletePopup" class="delete-popup-overlay" style="position: fixed;">
        <div class="delete-popup-content">
            <p>Are you sure you want to delete this Item?</p>
            <div class="delete-popup-buttons">
                <button id="confirmDelete" class="delete-popup-btn delete-popup-confirm" onclick=" handleDelete(this)">Yes</button>
                <button id="cancelDelete" class="delete-popup-btn delete-popup-cancel" onclick="document.getElementById('deletePopup').style.display='none'">No</button>
            </div>
        </div>
    </div>

    <div class="verification-alert" id="alert" style="display: none; top: 5%;">
        <div class="alert-icon">
            <img src="<?= IMAGE ?>/success.svg" id="alert-img" alt="success icon">
        </div>
        <div class="alert-message">
            <h1 id="alert-message">Success</h1>
        </div>
    </div>

    <div class="profile-card" id="profileCard" style="top: 0 !important; position: fixed !important; z-index: 1000000; width: 21rem;">
        <img src="<?= IMAGE ?>/back-arrow-2.svg" id="back-arrow-profile" style="width: 24px; height: 24px; fill:#233E8D !important;" class="back" />
        <img alt="Profile picture of Thilina Perera" height="100" src="<?= $data['Profile']->Image; ?>" width="100" class="profile" />
        <h2><?= $data['Profile']->First_Name ?> <?= $data['Profile']->Last_Name ?></h2>
        <p><?= $data['Profile']->EmployeeID ?> </p>
        <button class="profile-button"
            onclick="window.location.href ='<?= ROOT ?>/Receptionist/Profile'">Profile
        </button>
        <button class="logout-button" onclick="logoutUser()">LogOut</button>
    </div>

    <script>
        // Simple JavaScript for modal functionality
        window.onclick = function(event) {
            const modal = document.getElementById('addItemModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }

            const ViewModal = document.getElementById('viewItemModal');
            if (event.target == ViewModal) {
                ViewModal.style.display = "none";
            }

            const deletePopup = document.getElementById('deletePopup');
            if (event.target == deletePopup) {
                deletePopup.style.display = "none";
            }

            const editItemModal = document.getElementById('editItemModal');
            if (event.target == editItemModal) {
                editItemModal.style.display = "none";
            }
        } 

        function logoutUser() {
            fetch("<?= ROOT ?>/Receptionist/AddItem/Logout", {
                method: "POST",
                credentials: "same-origin"
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "<?= ROOT ?>/Main/Login";
                } else {
                    alert("Logout failed. Try again.");
                }
            })
            .catch(error => console.error("Error:", error));
        }

        const AddForm = document.getElementById('Add');
        const ItemError = document.getElementById('ItemError');
        const editItemError = document.getElementById('editItemError');
        const alert = document.getElementById('alert');
        const alertmessage = document.getElementById('alert-message'); // assume this exists
        const timeError = document.getElementById('timeError'); // error span below time input
        const alertimg =  document.getElementById('alert-img');

        function clearErrors() {
            const errorTags = AddForm.querySelectorAll("p[id$='Error']");
            errorTags.forEach(p => {
                p.style.display = 'none';
                p.textContent = '';
            });
        }

        // Handle form submission
        AddForm.addEventListener("submit", function(event){
            event.preventDefault();
            clearErrors();
            const formData = new FormData(AddForm);
            for (let [key, value] of formData.entries()) {
                console.log(`${key}:`, value);
            }

            fetch('<?= ROOT ?>/Inventory/InventoryManage/AddItems', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    alertmessage.textContent = data.message || "Pickup scheduled successfully!";
                    alertimg.src = '<?=IMAGE?>/Success.svg';
                    alert.style.display = 'flex';
                    location.reload();
                } else {
                    console.log(data);
                    if (data.errors) {
                        for (const [key, msg] of Object.entries(data.errors)) {
                            const errorTag = document.getElementById(key + 'Error');
                            if (errorTag) {
                                errorTag.textContent = msg;
                                errorTag.style.display = 'block';
                            }
                        }
                    } else {
                        alert("An unexpected error occurred.");
                    }
                    alertmessage.textContent = data.message;
                    alertimg.src = '<?=IMAGE?>/Faile.svg';
                    alert.style.display = 'flex';
                }
            })
            .catch(error => {
                console.error("Error:", error);
                alert("Something went wrong while adding item.");
            });
        });

        const editForm = document.getElementById('editForm');
        editForm.addEventListener("submit", function(event){
            if(editItemError.style.display == 'flex'){
                event.preventDefault();
            }else{
                editForm.submit();
            }
        });

        function fetchInventory(Category, Status, Pagination) {
            fetch('<?= ROOT ?>/Inventory/InventoryManage/StoreInventory', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        Category: Category,
                        Status: Status,
                        Pagination: Pagination
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Stock table:", data.data);
                        renderTable(data.data.Stock);
                        renderPagination(data.data.TotalPages, data.data.CurrentPage, Category, Status);
                    } else {
                        console.error("Failed to fetch Stock:", data.message);
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        function renderTable(stockData) {
            const table = document.querySelector("table");
            let html = `
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>In Stock</th>
                        <th>Issued</th>
                        <th>Min Stock</th>
                        <th>Last Restocked</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            `;

            stockData.forEach(item => {
                html += `
                    <tr>
                        <td>${item.ItemIDmodified}</td>
                        <td>${item.Item}</td>
                        <td>${item.Category}</td>
                        <td>${item.Quantity}</td>
                        <td>${item.Issued}</td>
                        <td>${item.MinQuantity}</td>
                        <td>${item.Date ?? '—'}</td>
                        <td><span class="status ${getStatusClass(item.Status)}">${item.Status}</span></td>
                        <td>
                            <button class="btn btn-sm btn-secondary" onclick="openViewModal(${item.ItemID})"> <i class="fas fa-eye"></i> </button>
                            <button class="btn btn-sm btn-secondary" onclick="openEditModal(${item.ItemID})"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteModal(${item.ItemID})"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            });

            html += `</tbody>`;
            table.innerHTML = html;
        }

        function getStatusClass(status) {
            switch (status) {
                case "Available":
                    return "status-available";
                case "Low Stock":
                    return "status-low";
                case "Out of Stock":
                    return "status-out";
                default:
                    return "";
            }
        }

        function renderPagination(totalPages, currentPage, Category, Status) {
            const paginationContainer = document.getElementById("pagination");
            paginationContainer.innerHTML = '';

            // Previous
            const prevPage = currentPage > 1 ? currentPage - 1 : 1;
            paginationContainer.innerHTML += `<a href="#" data-page="${prevPage}">&laquo;</a>`;

            for (let i = 1; i <= totalPages; i++) {
                paginationContainer.innerHTML += `
                    <a href="#" data-page="${i}" class="${i === currentPage ? 'active' : ''}">${i}</a>
                `;
            }

            // Next
            const nextPage = currentPage < totalPages ? currentPage + 1 : totalPages;
            paginationContainer.innerHTML += `<a href="#" data-page="${nextPage}">&raquo;</a>`;

            // Add click listeners
            paginationContainer.querySelectorAll("a").forEach(a => {
                a.addEventListener("click", function(e) {
                    e.preventDefault();
                    const page = parseInt(this.getAttribute("data-page"));
                    fetchInventory(Category, Status, page);
                });
            });
        }

        function openDeleteModal(ItemID){
            const deletePopup = document.getElementById('deletePopup');
            const confirmDelete = document.getElementById('confirmDelete');

            deletePopup.style.display = 'flex';
            confirmDelete.setAttribute('data-itemid', ItemID);
        }

        function handleDelete(button) {
            console.log("Delet function is called");
            const ItemID = button.getAttribute('data-itemid');
            const alert = document.getElementById('alert');
            const alertimg = document.getElementById('alert-img');
            const alertmessage =  document.getElementById('alert-message');
            const deletePopup = document.getElementById('deletePopup');

            console.log("You are deleting Item with ID" + ItemID);
            fetch('<?= ROOT ?>/Inventory/InventoryManage/DeleteStock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ItemID: ItemID
                })
            })
            .then(response => response.json())
            .then(data => {
                alert.style.display = 'flex';
                console.log(data);
                if (data.success) {
                    deletePopup.style.display = 'none';
                    alertimg.src = '<?=IMAGE?>/success.svg';
                    alertmessage.textContent = data.message;
                    alert.style.display = 'flex';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 2000);
                    location.reload();
                }else{
                    deletePopup.style.display = 'none';
                    alertimg.src = '<?=IMAGE?>/faile.svg';
                    alertmessage.textContent = data.message;
                    alert.style.display = 'flex';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 2000);
                    location.reload();
                }
            })
            .catch(error => console.error("Error:", error));

        }

        function openEditModal(ItemID){
            const EditModal = document.getElementById('editItemModal');
            const editItemName = document.getElementById('editItemName');
            const editItemCategory = document.getElementById('editItemCategory');
            const editItemQuantity = document.getElementById('editItemQuantity');
            const editItemImage = document.getElementById('editItemImagePreview');
            const editItemDescription = document.getElementById('editItemDescription');
            const editItemPrice = document.getElementById('editItemPrice');
            const editItemMinQuantity = document.getElementById('editItemMinQuantity');
            const editItemID = document.getElementById('editItemID');

            EditModal.style.display = 'flex';
            fetch('<?= ROOT ?>/Inventory/InventoryManage/ViewItem', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ItemID : ItemID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Edit view:", data.data);
                    editItemName.value = data.data.Item;
                    editItemID.value = data.data.ItemID;
                    editItemCategory.value = data.data.Category;
                    editItemQuantity.value = data.data.Quantity;
                    editItemMinQuantity.value = data.data.MinQuantity;
                    editItemDescription.value = data.data.Description;
                    editItemPrice.value = data.data.Price;
                    if(data.data.Image != null){
                        editItemImage.src = data.data.Image;
                    }

                } else {
                    console.error("Failed to fetch Stock:", data.message);
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));

        }
        
        function openViewModal(ItemID){
            const ViewModal = document.getElementById('viewItemModal');
            const viewItemName = document.getElementById('viewItemName');
            const viewItemCategory = document.getElementById('viewItemCategory');
            const viewItemQuantity = document.getElementById('viewItemQuantity');
            const viewItemImage = document.getElementById('viewItemImage');
            const viewItemDescription = document.getElementById('viewItemDescription');
            const viewItemPrice = document.getElementById('viewItemPrice');
            const viewItemMinQuantity = document.getElementById('viewItemMinQuantity');
            const viewItemID = document.getElementById('viewItemID');

            ViewModal.style.display = "flex";

            fetch('<?= ROOT ?>/Inventory/InventoryManage/ViewItem', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ItemID : ItemID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Stock view:", data.data);
                    viewItemName.textContent = data.data.Item;
                    console.log("The View Item Modified ID" + data.data.ItemIDmodified);
                    viewItemID.textContent = data.data.ItemIDmodified;
                    viewItemCategory.textContent = data.data.Category;
                    viewItemQuantity.textContent = data.data.Quantity;
                    viewItemMinQuantity.textContent = data.data.MinQuantity;
                    viewItemDescription.textContent = data.data.Description;
                    viewItemPrice.textContent = data.data.Price;
                    viewItemImage.src = data.data.Image;

                } else {
                    console.error("Failed to fetch Stock:", data.message);
                    alert(data.message);
                }
            })
            .catch(error => console.error("Error:", error));
        }

        function Seterror(Name, Category){
            fetch('<?= ROOT ?>/Inventory/InventoryManage/NameError', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Item: Name,
                    Category: Category
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    ItemError.style.display = 'flex';
                    ItemError.textContent = data.data;
                    console.log(data.data);
                }else{
                    ItemError.style.display = 'none';
                }
            })
            .catch(error => console.error("Error:", error));
        }

        function EditSeterror(Name, Category, ItemID){
            console.log(Name);
            console.log(Category);
            console.log(ItemID);
            fetch('<?= ROOT ?>/Inventory/InventoryManage/EditNameError', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Item: Name,
                    Category: Category,
                    ItemID : ItemID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    editItemError.style.display = 'flex';
                    editItemError.textContent = data.data;
                    console.log(data.data);
                }else{
                    editItemError.style.display = 'none';
                }
            })
            .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {

            const Add = document.getElementById('Add');
            const ItemError = document.getElementById('ItemError');

            Add.addEventListener("submit", function(event){
                if(ItemError.style.display = 'flex'){
                    event.preventDefault();
                }else{
                    Add.submit();
                }
            });

            const editForm = document.getElementById('editForm');

            const preview = document.getElementById('editItemImagePreview');
            const editItemImage = document.getElementById('editItemImage');

            editItemImage.addEventListener('change', function () {
                const file = this.files[0];
                
                if (file && file.type.startsWith('image/')) {
                    preview.src = URL.createObjectURL(file);
                }
            });

            const editItemName = document.getElementById('editItemName');
            const editItemCategory = document.getElementById('editItemCategory');
            const editItemID = document.getElementById('editItemID')

            editItemName.addEventListener("change" , function (){
                console.log("Change");
                EditSeterror(editItemName.value, editItemCategory.value, editItemID.value);
            });

            editItemCategory.addEventListener("change" , function (){
                console.log("Change");
                EditSeterror(editItemName.value, editItemCategory.value, editItemID.value);
            });

            const itemName = document.getElementById('itemName');
            const itemCategory = document.getElementById('itemCategory');

            itemName.addEventListener("change" , function (){
                console.log("Change");
                Seterror(itemName.value, itemCategory.value);
            });

            itemCategory.addEventListener("change" , function (){
                console.log("Change");
                Seterror(itemName.value, itemCategory.value);
            });

            const CategoryPicker = document.getElementById('Category');
            const StatusPicker = document.getElementById('Status');

            function getCurrentCategory() {
                return CategoryPicker?.value || 'All';
            }

            function getCurrentStatus() {
                return StatusPicker?.value || 'All';
            }

            fetchInventory(getCurrentCategory(), getCurrentStatus(), 1);

            [CategoryPicker, StatusPicker].forEach(picker => {
                if (picker) {
                    picker.addEventListener('change', () => {
                        fetchInventory(getCurrentCategory(), getCurrentStatus(), 1);
                    });
                }
            });

        });
    </script>
</body>

</html>