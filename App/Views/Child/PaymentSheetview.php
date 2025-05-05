<!DOCTYPE html>
<html>

<head>
<title>Parent</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= CSS ?>/Child/Paymentsheet.css?v=<?= time() ?>">
</head>

<body>
    <div class="container" style="margin-top: 30px;">
        <div class="top-con">
            <div class="back-con">
                <i class="fas fa-chevron-left" id="back"></i>
            </div>
        </div>
        <div class="header">
            <div class="details">
                <h1>Child Name : <?= $data['selectedchildren']['fullname'] ?></h1>
                <p>Age : <?= $data['selectedchildren']['age'] ?></p>
                <p>Details: Payment for childcare services</p>
            </div>
            <img src="<?= $data['selectedchildren']['image'] ?>" alt="Photo of John Doe" />
        </div>

        <div id="main">
            <div class="cost-details" id="cost-container">
            <h3>Cost Breakdown:</h3>
                <ul>
                    <?php if (!empty($data['CostBreakdown'])): ?>
                        <?php foreach ($data['CostBreakdown'] as $item): ?>
                            <li>
                                <span class="date"><?= date('d/m/Y', strtotime($item['date'])) ?></span>
                                <span class="description"><?= htmlspecialchars($item['reason']) ?></span>
                                <span class="amount <?= (isset($item['Fine']) && $item['Fine'] == 1) ? 'red' : '' ?>">
                                    <?= number_format(abs($item['amount']), 2) ?>Rs
                                </span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No cost breakdown available.</li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="cost" id="container2" style="width: 400px; height: 300px;">
                <h3>Cost Categorized:</h3>
                <ul>
                    <li>
                        <span class="description"> Package</span>
                        <span class="amount"><?= $data['Expenses']['Package'] ?>Rs</span>
                    </li>
                    <li>
                        <span class="description">Reservations</span>
                        <span class="amount"><?= $data['Expenses']['Reservations'] ?>Rs</span>
                    </li>
                    <li>
                        <span class="description">Snacks</span>
                        <span class="amount"><?= $data['Expenses']['Meal'] ?>Rs</span>
                    </li>
                    <li>
                        <span class="description">Events</span>
                        <span class="amount"><?= $data['Expenses']['Activity'] ?>Rs</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-total" style="margin-right: 40px; margin-top: 10px; margin-bottom: 40px;">
            Final Total: <strong><?= $data['Expenses']['Total'] ?></strong>
        </div>

        <div class="button-container">
            <button id="download-btn" style="margin-right: 30px;"> Download </button>
            <form id="pay-form" action="http://localhost/MVC/App/core/Payment.php" method="GET">
                <input type="hidden" name="total" id="total-input" value="500000" />
                <button type="submit" id="pay-now-button" style="margin-right: 40px;">Pay Now</button>
            </form>
        </div>
    </div>
    <script>
        document.getElementById("download-btn").addEventListener("click", function () {
            const container = document.getElementById("cost-container");
            const container2 = document.getElementById('container2');
            const btn1 = document.getElementById("pay-now-button");
            const btn2 = document.getElementById("download-btn");
            const main  = document.getElementById("main");
            main.style.flexDirection = 'column';
            container.style.maxHeight = 'none';
            btn1.style.display = 'none';
            btn2.style.display = 'none';
            container2.style.width = '600px';
            window.print();
            setTimeout(() => {
                main.style.flexDirection = 'row';
                container.style.maxHeight = '300px';
                btn1.style.display = 'flex';
                btn2.style.display = 'flex';
                container2.style.width = '400px';
            }, 1000);
        });

        document.getElementById('back').addEventListener("click", function (){
            window.location.href = '<?=ROOT?>/Child/<?= $_SESSION['APP']['Location'] ?>';
        })
    </script>
</body>

</html>