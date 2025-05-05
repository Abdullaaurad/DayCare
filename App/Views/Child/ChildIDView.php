<html>

<head>
<title>Parent</title>
    <link rel="icon" href="<?= IMAGE ?>/logo_light-remove.png" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- Updated to latest stable version of html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .id-card {
            margin-top: -50px;
            width: 300px;
            height: 500px;
            background-color: #0275d8;
            color: white;
            text-align: center;
            border-radius: 10px;
            padding: 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .id-card .header {
            background-color: white;
            color: #0275d8;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .id-card .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .id-card .header h2 {
            margin: 5px 0 0 0;
            font-size: 16px;
            font-weight: normal;
        }

        .id-card .content {
            padding: 20px;
        }

        .id-card img {
            width: 160px;
            height: 160px;
            border: 5px solid white;
            margin-bottom: 10px;
        }

        .id-card h2 {
            margin: 10px 0 5px 0;
            font-size: 18px;
        }

        .id-card p {
            margin: 0;
            font-size: 16px;
        }

        .id-card .info {
            background-color: #025aa5;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
        }

        .id-card .info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .id-card .info p span {
            font-weight: bold;
        }

        .id-card .website {
            background-color: white;
            margin-top: 20px;
            font-size: 16px;
            padding: 20px 50px;
            margin-left: -20px;
            margin-right: -20px;
            margin-bottom: -30px !important;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .id-card .website a {
            color: #025aa5;
            text-decoration: none;
            font-size: 20px;
        }

        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0275d8;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 10px;
        }

        .download-btn:hover {
            background-color: #025aa5;
        }
    </style>
</head>

<body>
    <div class="id-card" id="id-card">
        <div class="header">
            <h1>
                KIDDO VILLE
            </h1>
            <h2>
                CHILD ID CARD
            </h2>
        </div>
        <div class="content">
            <img id="childImage" alt="Portrait of the child" src="<?= $data['Child']->Image ?>" />
            <h2>
                <?= isset($data['Child']->fullname) ? $data['Child']->fullname : ''; ?>
            </h2>
            <p>
                Age: <?= isset($data['Child']->Age) ? $data['Child']->Age : ''; ?>
            </p>
            <div class="info">
                <p>
                    <span>
                        ID NO:
                    </span>
                    SRD<?= isset($data['Child']->ChildID) ? $data['Child']->ChildID : ''; ?>
                </p>
                <p>
                    <span>
                        CONTACT:
                    </span>
                    <?= isset($data['Child']->Contact) ? $data['Child']->Contact : ''; ?>
                </p>
            </div>
            <div class="website">
                <a href="http://localhost/MVC/Public/Main/Home">www.KiddoVille.com</a>
            </div>
        </div>
    </div>

    <button class="download-btn" style="margin-top: 40%; margin-right: 0%; position: fixed;" id="download-btn">Download ID Card</button>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const downloadBtn = document.getElementById("download-btn");
            const idCard = document.getElementById("id-card");

            downloadBtn.addEventListener("click", async function() {
                try {
                    // Wait for images to load
                    await document.getElementById('childImage').decode();

                    const canvas = await html2canvas(idCard, {
                        useCORS: true, // Enable CORS for images
                        scale: 5, // Improve quality
                        logging: true, // Help with debugging
                        allowTaint: true,
                        backgroundColor: null,
                        height: idCard.scrollHeight * 1.001,
                        width: idCard.scrollWidth * 1.1,
                    });

                    const imgData = canvas.toDataURL("image/png");
                    const link = document.createElement('a');
                    link.href = imgData;
                    link.download = "ID_Card.png";
                    link.click();
                } catch (error) {
                    console.error('Error generating ID card:', error);
                    alert('There was an error generating the ID card. Please try again.');
                }
            });
        });
    </script>
</body>

</html>