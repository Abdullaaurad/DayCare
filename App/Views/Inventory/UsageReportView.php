<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usage Reports</title>
    <link rel="stylesheet" href="<?= CSS ?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
</head>
<style>
    @media print {
    body * {
        visibility: hidden;
    }

    #main-content, #main-content * {
        visibility: visible;
    }

    #main-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0 !important;
        padding: 0;
    }

    #usagePagination {
        display: none !important;
    }
}
</style>

<body>
    <div class="main-content" id="main-content">
            <!-- Stats -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $data['Issued'] ?></h3>
                        <p>Items Issued This Month</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-undo-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $data['Returned'] ?></h3>
                        <p>Items Returned This Month</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?= $data['Active'] ?></h3>
                        <p>Active Users</p>
                    </div>
                </div>
            </div>

            <!-- Usage Report Filters -->
            <div class="card" id="filters">
                <div class="card-header">
                    <h2>Usage Report Filters</h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="dateFrom">From Date</label>
                                    <input type="date" id="dateFrom" class="form-control">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="dateTo">To Date</label>
                                    <input type="date" id="dateTo" class="form-control">
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="userFilter">User</label>
                                    <select id="userFilter" class="form-control">
                                        <option value="All" selected> All </option>
                                        <?php foreach ($data['Users'] as $row): ?>
                                            <option value="<?= $row['UserID'] ?>"> <?= $row['Name'] ?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-col">
                                <div class="form-group">
                                    <label for="categoryFilter">Category</label>
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
                    </form>
                </div>
            </div>

            <!-- Usage Report Results -->
            <div class="card">
                <div class="card-header">
                    <h2>Usage Report</h2>
                    <div>
                        <button class="btn btn-secondary btn-excel"><i class="fas fa-file-excel"></i> Export to Excel</button>
                        <button class="btn btn-secondary btn-print"><i class="fas fa-print"></i> Print</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody id="usageTableBody">
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination" id="usagePagination">

                    </div>
                </div>
            </div>

            <!-- Usage Summary -->
            <div class="card">
                <div class="card-header">
                    <h2>Usage Summary</h2>
                </div>
                <div class="card-body">
                    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                        <!-- Top Users -->
                        <div style="flex: 1; min-width: 300px;">
                            <h3 style="margin-bottom: 15px; color: var(--primary-color);">Top Users</h3>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Items Issued</th>
                                            <th>Items Returned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['Top'] as $row): ?>
                                            <tr>
                                                <td><?= $row['Name'] ?></td>
                                                <td><?= $row['Issued'] ?></td>
                                                <td><?= $row['Returned'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Most Used Items -->
                        <div style="flex: 1; min-width: 300px;">
                            <h3 style="margin-bottom: 15px; color: var(--primary-color);">Most Used Items</h3>
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Category</th>
                                            <th>Times Issued</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['Used'] as $row): ?>
                                            <tr>
                                                <td><?= $row['Name'] ?></td>
                                                <td><?= $row['Category'] ?></td>
                                                <td><?= $row['Issued'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function GeneratePagination(res) {
            const paginationContainer = document.querySelector(".pagination");
            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const userFilter = document.getElementById('userFilter');
            const categoryFilter = document.getElementById('categoryFilter');

            const firstdate = dateFrom.value;
            const lastdate = dateTo.value;
            const user = userFilter.value;
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
                    GetUsageReport(firstdate, lastdate, user, category, currentPage - 1);
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
                    GetUsageReport(firstdate, lastdate, user, category, i);
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
                    GetUsageReport(firstdate, lastdate, user, category, currentPage + 1);
                };
                paginationContainer.appendChild(next);
            }
        }

        function GenerateTable(res) {
            const tableBody = document.querySelector("tbody");
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
                    <td>${row.Name}</td>
                    <td>${row.Role}</td>
                    <td>${row.Notes || ''}</td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function GetUsageReport(firstdate, lastdate, user, category, page = 1) {
            console.log(page);
            fetch('<?= ROOT ?>/Inventory/UsageReport/Usage_Report', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        firstDate: firstdate,
                        lastDate: lastdate,
                        UserID: user,
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

        function GetAll(firstdate, lastdate, user, category) {
            return fetch('<?= ROOT ?>/Inventory/UsageReport/Get_All', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        firstDate: firstdate,
                        lastDate: lastdate,
                        UserID: user,
                        Category: category,
                    })
                })
                .then(response => response.json())
                .then(res => {
                    if (!res || !res.data) return;
                    console.log(res);
                    GenerateTable(res); // your table-rendering function
                })
                .catch(error => console.error("Error:", error));
        }

        document.addEventListener('DOMContentLoaded', function() {

            const dateFrom = document.getElementById('dateFrom');
            const dateTo = document.getElementById('dateTo');
            const userFilter = document.getElementById('userFilter');
            const categoryFilter = document.getElementById('categoryFilter');
            const printpage = document.getElementById('main-content');
            const filters = document.getElementById('filters');

            document.querySelector(".btn-print").addEventListener("click", () => {
                usagePagination.style.display = 'none'; // hide pagination for print
                filters.style.display = 'none'; 

                GetAll(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value)
                    .then(() => {
                        
                        window.print();
                        location.reload();
                    });
            });

            document.querySelector(".btn-excel").addEventListener("click", () => {


                GetAll(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value)
                    .then(() => {
                        const table = document.getElementById("myTable"); // make sure table is freshly selected
                        const workbook = XLSX.utils.table_to_book(table, {
                            sheet: "Sheet1"
                        });
                        XLSX.writeFile(workbook, "UsageReport.xlsx");
                    });
                GetUsageReport(null, null, null, null);
            });

            dateFrom.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value);
            });

            dateTo.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value);
            });

            categoryFilter.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value);
            });

            userFilter.addEventListener("change", function() {
                GetUsageReport(dateFrom.value, dateTo.value, userFilter.value, categoryFilter.value);
            });

            GetUsageReport(null, null, null, null);
        });
    </script>
</body>

</html>