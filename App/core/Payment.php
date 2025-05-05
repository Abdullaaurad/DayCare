<?php
require 'vendor_stripe/autoload.php';
session_start();
$GLOBALS['env'] = require 'C:\xampp\htdocs\KiddoVille-UI_UX\App\env.php';

$stripe_secret_key = $GLOBALS['env']['stripe_secret_key']; // your key
$webhook_secret = $GLOBALS['env']['webhook_secret']; // from Stripe CLI or dashboard

\Stripe\Stripe::setApiKey($stripe_secret_key);

// If webhook request:
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['HTTP_STRIPE_SIGNATURE'])) {
    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

    try {
        $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $webhook_secret);
    } catch (\Exception $e) {
        http_response_code(400);
        exit("Webhook Error: " . $e->getMessage());
    }

    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;
        file_put_contents("paid.log", json_encode($session)); // log it
        // ✅ mark as paid in DB, etc.
    }

    http_response_code(200);
    exit;
}

// If user submitting for payment:
if (isset($_GET['total'])) {
    $total_amount = (int) $_GET['total']; // In cents (e.g. 470000)

    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" => "http://localhost/KiddoVille-UI_UX/App/Core/Payment.php?success=true",
            "cancel_url" => "http://localhost/KiddoVille-UI_UX/App/Core/Payment.php?cancel=true",
            "client_reference_id" => $_SESSION['CHILDID'] ?? "unknown",
            "metadata" => [
                "reason" => $_GET['reason'] ?? 'General Payment'
            ],
            "line_items" => [[
                "quantity" => 1,
                "price_data" => [
                    "currency" => "lkr",
                    "unit_amount" => $total_amount,
                    "product_data" => ["name" => "KiddoVille Payment"]
                ]
            ]]
        ]);

        header("Location: " . $checkout_session->url);
        exit;
    } catch (Exception $e) {
        echo "Stripe error: " . $e->getMessage();
    }
}

// If success or cancel:
if (isset($_GET['success'])) {
    unset($_SESSION['success']);
    $_SESSION['success'] = true;
    header("Location: /KiddoVille-UI_UX/Public/Payments/sucess");
    exit();
}

if (isset($_GET['cancel'])) {
    unset($_SESSION['success']);
    $_SESSION['success'] = false;
    $_SESSION['Retry'] = true;
    
    header("Location: /KiddoVille-UI_UX/Public/Payments/failure");
    exit();
}
?>

<!-- Simple Form -->
<form method="GET" action="">
    <input type="hidden" name="reason" value="April 2025 Fees">
    <label>Total (LKR cents):</label>
    <input type="number" name="total" placeholder="e.g. 470000" required>
    <button type="submit">Pay with Stripe</button>
</form>
