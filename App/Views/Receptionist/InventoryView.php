<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - Inventory Management System</title>
    <link rel="stylesheet" href="<?= CSS ?>/Inventory.css?v=<?= time() ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Stats -->
        <div class="stats-container" style="margin-top: 5%;">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Total'] ?></h3>
                    <p>Total Items in Stock</p>
                </div>
            </div>
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
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3><?= $data['Low'] ?></h3>
                    <p>Items Low in Stock</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h2>Quick Actions</h2>
            </div>
            <div class="card-body">
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="<?=ROOT?>/Inventory/InventoryManage" class="btn btn-primary"><i class="fas fa-plus"></i> Add New
                        Item</a>
                    <a href="manager-restock.html" class="btn btn-secondary"><i class="fas fa-truck-loading"></i> Manage
                        Restocking</a>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="card">
            <div class="card-header">
                <h2>Recent Activities</h2>
                <a href="audit-log.html" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Activity</th>
                                <th>User</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['Recent'] as $row): ?>
                                <tr>
                                    <td><?=$row->Activity?> </td>
                                    <td><?=$row->Name?>(<?=$row->Role ?>)</td>
                                    <td><?=$row->ItemName?> </td>
                                    <td><?=$row->Quantity?> </td>
                                    <td><?=$row->DateTime?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="card">
            <div class="card-header">
                <h2>Low Stock Items</h2>
                <a href="manager-restocking.html" class="btn btn-sm btn-primary">Manage Restocking</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Current Stock</th>
                                <th>Minimum Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($data['Stock'])): ?>
                                <?php foreach($data['Stock'] as $row): ?>
                                    <tr>
                                        <td><?=$row->Item?> </td>
                                        <td><?=$row->Category?></td>
                                        <td><?=$row->Quantity?> </td>
                                        <td><?=$row->MinQuantity?> </td>
                                        <td><span class="status status-low">Low Stock</span></td>
                                        <td><button class="btn btn-sm btn-primary">Restock</button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div>
                    <?php if(empty($data['Stock'])): ?>
                        <div class="no-stack">
                            <p class="no-stock-message">All items are sufficiently stocked. No low inventory at the moment.</p>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // You can add JavaScript for interactions here
        // For example, toggle sidebar, modal functionality, etc.
    </script>
</body>

</html>