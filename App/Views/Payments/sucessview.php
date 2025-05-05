<html>
<head>
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 600px;
        }
        .container .icon {
            font-size: 50px;
            color: #4CAF50;
        }
        .container h1 {
            font-size: 24px;
            margin: 20px 0;
            color: #333;
        }
        .container p {
            font-size: 16px;
            color: #666;
            margin: 10px 0;
        }
        .container .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .container .btn:hover {
            background-color: #45a049;
        }
        .details {
            text-align: left;
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1>Payment Successful!</h1>
        <p>Thank you for your purchase. Your transaction has been completed successfully.</p>
        <p>We have sent you an email with the details of your</p>
        <div class="details">
            <h2>Payment Details</h2>    
            <p><strong>Transaction ID:</strong>    <?= $data['Payment']->PaymentID ?></p>
            <p><strong>Amount Paid:</strong> <?=$data['Payment']->Amount ?></p>
            <p><strong>Payment Method:</strong>    <?=$data['Payment']->Mode?></p>
            <p><strong>Date:</strong><?=$data['Payment']->DateTime ?></p>
        </div>
        <a href="<?=ROOT . '/' . $_SESSION['APP']['Location']?>" class="btn">Go to Homepage</a>
    </div>
</body>
</html>