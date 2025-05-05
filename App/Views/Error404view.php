<html>

<head>
    <title>
        404 Error Page
    </title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .error-title {
            font-size: 2rem;
            color: #7d7d7d;
            margin: 0;
        }

        .error-subtitle {
            font-size: 1.2rem;
            color: #b0b0b0;
            margin: 0;
        }

        .error-message {
            font-size: 1rem;
            color: #7d7d7d;
            margin: 20px 0;
        }

        .back-button {
            background-color: #007bff;
            color: #ffffff;
            padding: 15px 30px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .error-image {
            width: 100%;
            max-width: 600px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-title">
            404 ERROR PAGE
        </div>
        <div class="error-subtitle">
            illustration
        </div>
        <img alt="404 error with a broken robot illustration" class="error-image" height="400" src="<?=IMAGE?>/404.jpeg" width="600" />
        <div class="error-message">
            uh-oh! Nothing here...
        </div>
        <a class="back-button" href="<?=ROOT?>/Main/Home">
            GO BACK HOME
        </a>
    </div>
</body>

</html>