<?php 

    use Twilio\Rest\Client;

    $number = $_POST["number"];
    $message = $_POST["message"];

    require 'vendor_trillio/autoload.php';

    $account_id = "ACf677f642bff24b0e748bc25b70cf73a5";
    $auth_token = "bac18202e705892d5bbf25c68c7eb4d6";

    $client = new Client($account_id, $auth_token);

    $to_phone_number = '+94728786938';
    $from_phone_number = 'whatsapp:+94714810928';
    $verification_code = rand(1000, 9999);

    try {
        $message = $client->messages->create(
            'whatsapp:' . $to_phone_number,  // Recipient's WhatsApp phone number
            [
                'from' => $from_phone_number,  // Your Twilio WhatsApp-enabled phone number
                'body' => $message_body  // The message body
            ]
        );
        return "WhatsApp message sent successfully!";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
?>