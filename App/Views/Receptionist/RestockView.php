<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restocking - Inventory System</title>
    <link rel="stylesheet" href="<?=CSS?>/Parent/deletepopup.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Parent/Alert.css?v=<?= time() ?>">
    <link rel="stylesheet" href="<?=CSS?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Stats -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Low'] ?></h3>
                    <p>Items Low in Stock</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Out'] ?></h3>
                    <p>Out of Stock Items</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Full'] ?></h3>
                    <p>Available Items</p>
                </div>
            </div>
        </div>

        <!-- Alert for Critical Items -->
        <div class="alert alert-warning">
            <strong>Attention!</strong> There are 5 items that are out of stock and require immediate attention.
        </div>

        <!-- Low Stock Items Table -->
        <div class="card">
            <div class="card-header">
                <h2>Low Stock Items</h2>
            </div>
            <div class="card-body">
                <div class="search-bar">
                    <input type="text" id="Filter" placeholder="Search items...">
                    <button><i class="fas fa-search"></i></button>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Current Stock</th>
                                <th>Min. Required</th>
                                <th>Status</th>
                                <th>Last Restocked</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="lowstocktbody">
                            <tr>
                                <td>ITM001</td>
                                <td>Whiteboard Markers</td>
                                <td>Classroom Supplies</td>
                                <td>0</td>
                                <td>50</td>
                                <td><span class="status status-out">Out of Stock</span></td>
                                <td>Jan 15, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM001', 'Whiteboard Markers')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM008</td>
                                <td>Blue Pens</td>
                                <td>Office Supplies</td>
                                <td>5</td>
                                <td>30</td>
                                <td><span class="status status-low">Low Stock</span></td>
                                <td>Feb 10, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM008', 'Blue Pens')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM012</td>
                                <td>A4 Paper Reams</td>
                                <td>Office Supplies</td>
                                <td>0</td>
                                <td>20</td>
                                <td><span class="status status-out">Out of Stock</span></td>
                                <td>Feb 20, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM012', 'A4 Paper Reams')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM023</td>
                                <td>Science Lab Kit</td>
                                <td>Classroom Supplies</td>
                                <td>0</td>
                                <td>5</td>
                                <td><span class="status status-out">Out of Stock</span></td>
                                <td>Jan 28, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM023', 'Science Lab Kit')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM034</td>
                                <td>HDMI Cables</td>
                                <td>Electronics</td>
                                <td>2</td>
                                <td>10</td>
                                <td><span class="status status-low">Low Stock</span></td>
                                <td>Feb 15, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM034', 'HDMI Cables')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM045</td>
                                <td>Scissors</td>
                                <td>Office Supplies</td>
                                <td>8</td>
                                <td>25</td>
                                <td><span class="status status-low">Low Stock</span></td>
                                <td>Feb 22, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM045', 'Scissors')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM067</td>
                                <td>Cleaning Spray</td>
                                <td>Cleaning Supplies</td>
                                <td>3</td>
                                <td>15</td>
                                <td><span class="status status-low">Low Stock</span></td>
                                <td>Feb 05, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM067', 'Cleaning Spray')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM078</td>
                                <td>Projector Bulbs</td>
                                <td>Electronics</td>
                                <td>0</td>
                                <td>5</td>
                                <td><span class="status status-out">Out of Stock</span></td>
                                <td>Dec 12, 2024</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM078', 'Projector Bulbs')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM089</td>
                                <td>Dry Erase Erasers</td>
                                <td>Classroom Supplies</td>
                                <td>4</td>
                                <td>15</td>
                                <td><span class="status status-low">Low Stock</span></td>
                                <td>Jan 30, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM089', 'Dry Erase Erasers')">Restock</button>
                                </td>
                            </tr>
                            <tr>
                                <td>ITM092</td>
                                <td>Sticky Notes</td>
                                <td>Office Supplies</td>
                                <td>0</td>
                                <td>20</td>
                                <td><span class="status status-out">Out of Stock</span></td>
                                <td>Jan 25, 2025</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="openRestockModal('ITM092', 'Sticky Notes')">Restock</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <a href="#">&laquo;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Restock Modal -->
    <div class="modal-backdrop" id="restockModal">
        <div class="modal">
            <form id="restockForm" method="POST" enctype="multipart/form-data" action = "<?=ROOT?>/Inventory/Restock/RestockItem">
                <div class="modal-header">
                    <h3>Restock Item: <span id="modalItemName">Item Name</span></h3>
                    <button class="modal-close" onclick="closeRestockModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ItemID" id="itemId" value="">
                    <div class="form-group">
                        <label for="restockQuantity">Quantity of Restock</label>
                        <input type="number" name="Quantity" id="restockQuantity" class="form-control" min="1" placeholder="10" required>
                    </div>
                    <div class="form-group">
                        <label for="modalNotes">Notes</label>
                        <textarea id="modalNotes" name="Notes" class="form-control" placeholder="We are restocking the item" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" onclick="closeRestockModal()">Cancel</button>
                    <button class="btn btn-primary" type="submit">Restock</button>
                </div>
            </form>
        </div>
    </div>

    <script>

        function GeneratePagination(res) {
            const paginationContainer = document.querySelector(".pagination");
            const Filter = document.getElementById('Filter');
            const category = Filter.value;

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
                    GetUsageReport(category, currentPage - 1);
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
                    GetUsageReport(category, i);
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
                    GetUsageReport(category, currentPage + 1);
                };
                paginationContainer.appendChild(next);
            }
        }

        function GenerateTable(res) {
            const tableBody = document.getElementById("lowstocktbody");
            tableBody.innerHTML = '';

            // Fill rows
            res.data.forEach(row => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${row.ItemIDmodified}</td>
                    <td>${row.Item}</td>
                    <td>${row.Category}</td>
                    <td>${row.Quantity}</td>
                    <td>${row.MinQuantity}</td>
                    <td> <span class="${row.class}">${row.Status}</span></td>
                    <td>${row.RestockDate ?? '-'}</td>
                    <td>
                        <button data-id="${row.ItemID}" class="btn btn-sm btn-primary" onclick="openRestockModal(${row.ItemID}, '${row.Item}')">Restock</button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function GetUsageReport(category, page = 1) {
            console.log(category);
            fetch('<?= ROOT ?>/Inventory/Restock/Low_Stock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    Filter: category,
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

        // Function to open restock modal
        function openRestockModal(itemId, itemName) {
            document.getElementById('modalItemName').textContent = itemName;
            document.getElementById('itemId').value = itemId;
            document.getElementById('restockModal').style.display = 'flex';
        }

        // Function to close restock modal
        function closeRestockModal() {
            document.getElementById('restockModal').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {

            const Filter = document.getElementById('Filter');

            Filter.addEventListener("change", function() {
                console.log(Filter.value);
                GetUsageReport(Filter.value);
            });

            GetUsageReport(null);

        });

    </script>
</body>
</html>