<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <title>My Usage Summary - Inventory System</title>
    <link rel="stylesheet" href="<?= CSS ?>/Parent/deletepopup.css?v=<?= time() ?>">
        <link rel="stylesheet" href="<?= CSS ?>/Maid/main.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= CSS ?>/Inventory.css?v=<?= time() ?>">
        <script src="<?= JS ?>/Child/Profile.js?v=<?= time() ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
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
                        Maid
                    </p>
                </div>
            </div>
            <ul>
                <li class="hover-effect unselected first">
                    <a href="<?= ROOT ?>/Maid/Home">
                        <i class="fas fa-home"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="selected">
                    <a href="<?= ROOT ?>/Maid/Inventory">
                        <i class="fas fa-boxes"></i> <span>Inventory</span>
                    </a>
                </li>
                <li class="hover-effect unselected">
                    <a href="<?= ROOT ?>/Maid/Leaves">
                        <i class="fas fa-utensils"></i> <span>Leave</span>
                    </a>
                </li>
            </ul>
        </div>
    <div class="main-content">
        <div class="header" style="margin-top:287px; height: 80px; margin-left: -10px; width: 102.45%;">
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
        <div class="stats-container" style="margin-top:20px;">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Use'] ?></h3>
                    <p>Items Currently In Use</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Overdue'] ?></h3>
                    <p>Items Due for Return</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Request'] ?></h3>
                    <p>Pending Requests</p>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        <!-- <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-exclamation-circle"></i> Alerts</h2>
            </div>
            <div class="card-body">
                <div class="alert alert-danger">
                    <strong>Out of Stock:</strong> Your requested item "Graphing Calculators (10)" is currently unavailable.+
                </div>
                <div class="alert alert-warning">
                    <strong>Low Stock Alert:</strong> Whiteboard Markers are running low. Only 8 remaining in inventory.
                </div>
            </div>
        </div> -->

        <!-- Current Items -->
        <div class="card">
            <div class="card-header">
                <h2>Currently Borrowed Items</h2>
                <button class="btn btn-primary" id="returnItemsBtn"><i class="fas fa-undo-alt"></i> Return Items</button>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll"></th>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Borrowed Date</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($data['Borrowed'])): ?>
                                <tr>
                                    <td colspan="8" style="text-align: center;">No borrowed items</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data['Borrowed'] as $row): ?>
                                    <tr>
                                        <td><input type="checkbox" name="returnItem"></td>
                                        <td data-id="<?= $row->ActivityID ?>"><?= $row->Name ?></td>
                                        <td><?= $row->Category ?></td>
                                        <td><?= $row->Quantity ?></td>
                                        <td><?= $row->Date ?></td>
                                        <td><?= $row->ReturnDate ?></td>
                                        <td><span class="<?= $row->class ?>"><?= $row->Status ?> </span></td>
                                        <td><?= $row->Notes ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Usage History -->
        <div class="card">
            <div class="card-header">
                <h2>Usage History</h2>
            </div>
            <div class="card-body">
                <div class="form-row" style="margin-bottom: 20px;">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="historyDateFrom">From Date</label>
                            <input type="date" id="dateFrom" class="form-control">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="historyDateTo">To Date</label>
                            <input type="date" id="dateTo" class="form-control">
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="historyStatus">Status</label>
                            <select id="categoryFilter" class="form-control">
                                <option value="All" selected>All Categories</option>
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

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Return Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody id="Usagetbody">
                            <tr>
                                <td>Mar 01, 2025</td>
                                <td>Whiteboard Markers</td>
                                <td>Classroom Supplies</td>
                                <td>10</td>
                                <td>Borrowed</td>
                                <td>-</td>
                                <td>For Math Department</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <!-- <div class="card">
            <div class="card-header">
                <h2>Pending Requests</h2>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Request Date</th>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Expected Date</th>
                                <th>Notes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Feb 28, 2025</td>
                                <td>Graphing Calculators</td>
                                <td>Classroom Supplies</td>
                                <td>10</td>
                                <td><span class="status status-danger">Unavailable</span></td>
                                <td>Mar 10, 2025</td>
                                <td>For Calculus Class</td>
                                <td>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Feb 27, 2025</td>
                                <td>Document Camera</td>
                                <td>Electronics</td>
                                <td>1</td>
                                <td><span class="status status-warning">Pending</span></td>
                                <td>Mar 05, 2025</td>
                                <td>For Geometry Demonstration</td>
                                <td>
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Cancel</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->

        <!-- Return Items Modal -->
        <div class="modal-backdrop" id="returnModal">
            <form id="returnForm" method="POST" enctype="multipart/form-data" action="<?= ROOT ?>/Inventory/MyUsage/ReturnBorrowed">
                <input type="hidden" name="activityIDs" id="activityIDsInput">
                <div class="modal">
                    <div class="modal-header">
                        <h3>Return Items</h3>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to return the following items:</p>
                        <ul id="returnItemsList" style="margin: 15px 0; padding-left: 20px;">
                            <!-- Items will be populated by JavaScript -->
                        </ul>
                        <div class="form-group">
                            <label for="returnNotes">Notes (Optional)</label>
                            <textarea id="returnNotes" class="form-control" rows="3" placeholder="Add any comments about the condition of the items or other notes"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary modal-close">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="confirmReturn">Confirm Return</button>
                    </div>
                </div>
            </form>
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

    </div>

    <script>
        function GeneratePagination(res) {
            const paginationContainer = document.querySelector(".pagination");
            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const categoryFilter = document.getElementById('categoryFilter');

            const firstdate = dateFrom.value;
            const lastdate = dateTo.value;
            const category = categoryFilter.value;

            paginationContainer.innerHTML = '';

            const totalPages = res.Count; // Total number of pages from the server
            const currentPage = Number(res.Pagination); // Current page
            const maxVisiblePages = 5;

            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = startPage + maxVisiblePages - 1;

            // Adjust if we go past the total pages
            if (endPage > totalPages) {
                endPage = totalPages;
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // < Arrow
            if (currentPage > 1) {
                const prev = document.createElement('a');
                prev.textContent = '<';
                prev.href = '#';
                prev.onclick = (e) => {
                    e.preventDefault();
                    GetUsageReport(firstdate, lastdate, category, currentPage - 1);
                };
                paginationContainer.appendChild(prev);
            }

            // Page numbers
            for (let i = startPage; i <= endPage; i++) {
                const a = document.createElement('a');
                a.textContent = i;
                a.href = '#';
                if (i === currentPage) {
                    a.classList.add('active');
                }
                a.onclick = (e) => {
                    e.preventDefault();
                    GetUsageReport(firstdate, lastdate, category, i);
                };
                paginationContainer.appendChild(a);
            }

            // > Arrow
            if (currentPage < totalPages) {
                const next = document.createElement('a');
                next.textContent = '>';
                next.href = '#';
                next.onclick = (e) => {
                    e.preventDefault();
                    GetUsageReport(firstdate, lastdate, category, currentPage + 1);
                };
                paginationContainer.appendChild(next);
            }
        }

        function GenerateTable(res) {
            const tableBody = document.getElementById("Usagetbody");
            tableBody.innerHTML = '';

            // Fill rows
            res.data.forEach(row => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td style="white-space: nowrap;">${row.Date}</td>
                    <td>${row.Item}</td>
                    <td>${row.Category}</td>
                    <td>${row.Quantity}</td>
                    <td>${row.Activity}</td>
                    <td>${row.Notes || ''}</td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function logoutUser() {
            fetch("<?= ROOT ?>/Maid/Inventory/Logout", {
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

        function GetUsageReport(firstdate, lastdate, category, page = 1) {
            console.log(page);
            fetch('<?= ROOT ?>/Inventory/MyUsage/Usage_Report', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        firstDate: firstdate,
                        lastDate: lastdate,
                        Category: category,
                        Pagination: page
                    })
                })
                .then(response => response.json())
                .then(res => {
                    if (!res || !res.data) return;
                    console.log(res);
                    GenerateTable(res);
                    GeneratePagination(res);
                })
                .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {

            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const categoryFilter = document.getElementById('categoryFilter');

            dateFrom.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, categoryFilter.value);
            });

            dateTo.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, categoryFilter.value);
            });

            categoryFilter.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, categoryFilter.value);
            });

            GetUsageReport(null, null, null);

            const returnItemsBtn = document.getElementById('returnItemsBtn');
            const returnModal = document.getElementById('returnModal');
            const returnItemsList = document.getElementById('returnItemsList');
            const modalCloseButtons = document.querySelectorAll('.modal-close');
            const confirmReturnBtn = document.getElementById('confirmReturn');
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('input[name="returnItem"]');

            // Handle return items button click
            returnItemsBtn.addEventListener('click', function() {
                // Get selected items
                const selectedItems = [];
                document.querySelectorAll('input[name="returnItem"]:checked').forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const itemName = row.cells[1].textContent;
                    const quantity = row.cells[3].textContent;
                    selectedItems.push(`${itemName} (${quantity})`);
                });

                // Update modal list
                returnItemsList.innerHTML = '';
                if (selectedItems.length === 0) {
                    returnItemsList.innerHTML = '<li>No items selected</li>';
                } else {
                    selectedItems.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item;
                        returnItemsList.appendChild(li);
                    });
                }

                // Show modal
                returnModal.style.display = 'flex';
            });

            // Handle select all checkbox
            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            });

            // Close modal when clicking close buttons
            modalCloseButtons.forEach(button => {
                button.addEventListener('click', function() {
                    returnModal.style.display = 'none';
                });
            });

            confirmReturnBtn.addEventListener('click', function() {
                const selectedItems = [];
                const activityIDs = [];

                document.querySelectorAll('input[name="returnItem"]:checked').forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const itemName = row.cells[1].textContent;
                    const quantity = row.cells[3].textContent;
                    const activityId = row.querySelector('td[data-id]').getAttribute('data-id');

                    selectedItems.push(`${itemName} (${quantity})`);
                    activityIDs.push(activityId);
                });

                // Fill the return items list
                returnItemsList.innerHTML = '';
                if (selectedItems.length === 0) {
                    returnItemsList.innerHTML = '<li>No items selected</li>';
                } else {
                    selectedItems.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item;
                        returnItemsList.appendChild(li);
                    });
                }

                // Fill the hidden input with comma-separated IDs
                document.getElementById('activityIDsInput').value = activityIDs.join(',');

                // Show the modal
                returnModal.style.display = 'flex';
            });
        });
    </script>
</body>

</html>