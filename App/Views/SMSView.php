<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS Form</title>
</head>
<body>
    <h2>Send SMS</h2>
    <form method="POST" action="http://localhost/MVC/App/core/SMS.php">
        <label for="number">Phone Number (with country code):</label>
        <input type="text" id="number" name="number" required><br><br>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br><br>
        
        <button type="submit">Send SMS</button>
    </form>
</body>
</html>
