<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <title>Receptionist Dashboard - Inventory System</title>
    <link rel="stylesheet" href="<?=CSS?>/Parent/deletepopup.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="main-content">
        <!-- Stats -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="stat-info">
                    <h3><?=$data['Available'] ?? 0 ?></h3>
                    <p>Available Items</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding"></i>
                </div>
                <div class="stat-info">
                    <h3><?=$data['Overdue'] ?? 0 ?></h3>
                    <p>Items Currently Borrowed</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3><?=$data['Use'] ?? 0 ?></h3>
                    <p>Overdue Items</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="card">
            <div class="card-header">
                <h2>Inventory Management</h2>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <button class="btn btn-primary" id="issueItemBtn">
                        <i class="fas fa-arrow-right"></i> Issue Item
                    </button>
                    <button class="btn btn-success" id="returnItemBtn">
                        <i class="fas fa-arrow-left"></i> Return Item
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="card">
            <div class="card-header">
                <h2>Recent Activities</h2>
                <div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ItemID</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Item</th>
                                <th>Activity</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody id="activitiesTable">
                            <!-- Activities will be loaded here -->
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

        <!-- Current Inventory -->
        <div class="card">
            <div class="card-header">
                <h2>Current Borrowed</h2>
            </div>
            <form method="POST" id="details" enctype="multipart/form-data" action = "<?=ROOT?>/Inventory/Issue/Return_Borrowed">
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ItemID</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Notes</th>
                                <th> Return </th>
                            </tr>
                        </thead>
                        <tbody id="borrowTable">
                            <?php foreach($data['Borrowed'] as $row):  ?>
                                <tr>
                                    <td><?= $row->ItemIDmodified ?></td>
                                    <td><?= $row->Name ?></td>
                                    <td><?= $row->Role ?></td>
                                    <td><?= $row->Item ?></td>
                                    <td><?= $row->Quantity ?></td>
                                    <td><?= $row->Date ?></td>
                                    <td><?= $row->Notes ?></td>
                                    <td> <input type="checkbox" name="<?= $row->ActivityID ?>"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                    <button class="btn btn-success" type="submit">Submit Return</button>
                </div>
            </div>
            </form>
        </div>

        <!-- Issue Item Modal -->
        <div class="modal-backdrop" id="issueModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Issue Item</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="issueForm">
                        <div class="form-group">
                            <label for="issueUser">User</label>
                            <select id="issueUser" class="form-control" required>
                                <option value="">Select User</option>
                                <!-- Users will be loaded here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="issueItem">Item</label>
                            <select id="issueItem" class="form-control" required>
                                <option value="">Select Item</option>
                                <!-- Items will be loaded here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="issueQuantity">Quantity</label>
                            <input type="number" id="issueQuantity" min="1" class="form-control" required>
                            <small id="availableQuantity" class="text-muted">Available: 0</small>
                        </div>
                        <div class="form-group">
                            <label for="issueNotes">Notes (Optional)</label>
                            <textarea id="issueNotes" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmIssue">Issue Item</button>
                </div>
            </div>
        </div>

        <!-- Return Item Modal -->
        <div class="modal-backdrop" id="returnModal">
            <div class="modal">
                <div class="modal-header">
                    <h3>Return Item</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="returnForm">
                        <div class="form-group">
                            <label for="returnUser">User</label>
                            <select id="returnUser" class="form-control" required>
                                <option value="">Select User</option>
                                <!-- Users will be loaded here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="returnBorrowedItems">Borrowed Items</label>
                            <select id="returnBorrowedItems" class="form-control" required>
                                <option value="">Select Item</option>
                                <!-- Borrowed items will be loaded here -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="returnQuantity">Return Quantity</label>
                            <input type="number" id="returnQuantity" min="1" class="form-control" required>
                            <small id="borrowedQuantity" class="text-muted">Borrowed: 0</small>
                        </div>
                        <div class="form-group">
                            <label for="returnNotes">Notes (Optional)</label>
                            <textarea id="returnNotes" class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary modal-close">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="confirmReturn">Confirm Return</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        function GeneratePagination(res) {
            const paginationContainer = document.querySelector(".pagination");
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
                    GetUserActivities( currentPage - 1);
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
                    GetUserActivities(i);
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
                    GetUserActivities(currentPage + 1);
                };
                paginationContainer.appendChild(next);
            }
        }

        function GenerateTable(res) {
            const tableBody = document.getElementById("activitiesTable");
            tableBody.innerHTML = '';

            // Fill rows
            res.data.forEach(row => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${row.ItemIDmodified}</td>
                    <td>${row.Name}</td>
                    <td>${row.Role}</td>
                    <td>${row.Item}</td>
                    <td>${row.Activity}</td>
                    <td>${row.Quantity}</td>
                    <td>${row.Date}</td>
                    <td>${row.Notes}</td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function GetUserActivities(page = 1) {
            fetch('<?= ROOT ?>/Inventory/Issue/Get_All', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
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

            GetUserActivities(1);

            // Modal open/close functionality
            const issueBtn = document.getElementById('issueItemBtn');
            const returnBtn = document.getElementById('returnItemBtn');
            const issueModal = document.getElementById('issueModal');
            const returnModal = document.getElementById('returnModal');
            const closeButtons = document.querySelectorAll('.modal-close');
            
            // Open modals
            issueBtn.addEventListener('click', () => issueModal.style.display = 'flex');
            returnBtn.addEventListener('click', () => returnModal.style.display = 'flex');
            
            // Close modals
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    issueModal.style.display = 'none';
                    returnModal.style.display = 'none';
                    stockModal.style.display = 'none';
                });
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === issueModal) issueModal.style.display = 'none';
                if (event.target === returnModal) returnModal.style.display = 'none';
            });
            
            // Add quick actions to inventory buttons
            document.querySelectorAll('.issue-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    document.getElementById('issueItem').value = itemId;
                    updateAvailableQuantity();
                    document.getElementById('issueModal').style.display = 'flex';
                });
            });
            
            document.querySelectorAll('.return-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');
                    document.getElementById('returnModal').style.display = 'flex';
                });
            });
        });

    </script>
</body>
</html>