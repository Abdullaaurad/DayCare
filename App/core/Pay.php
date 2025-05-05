<?php
    require 'vendor_stripe/autoload.php';

    $stripe_secret_key = "sk_test_51QRD3Q006VNadgQuLV1JP0OPIpcesx0a3bcnYu4BWje6QUNthvf4DEKzEy4CvJktxSNx4FfqLxCoVEMDWN47wpIL00fjn9ScHt";

    \Stripe\Stripe::setApiKey($stripe_secret_key);

    // Get the total amount from the query parameter
    if (isset($_GET['total'])) {
        $total_amount = (int) $_GET['total']; // Convert to integer for Stripe
    } 
    else {
        die("Error: Total amount not provided.");
    }

    // Create the Checkout Session
    try {
        $checkout_session = \Stripe\Checkout\Session::create([
            "mode" => "payment",
            "success_url" =>  "http://localhost/MVC/Public/payments/sucess",
            "cancel_url" => "http://localhost/MVC/Public/payments/failure",
            "line_items" => [
                [
                    "quantity" => 1,
                    "price_data" => [
                        "currency" => "lkr",
                        "unit_amount" => $total_amount, // Use the dynamic total amount
                        "product_data" => [
                            "name" => "Total Amount"
                        ]
                    ]
                ]
            ]
        ]);

        // Redirect to the Stripe Checkout page
        http_response_code(303);
        header("Location: " . $checkout_session->url);
    } 
    catch (Exception $e) {
        echo "Error creating Stripe Checkout Session: " . $e->getMessage();
    }
?>