<!-- uploadForm.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Media</title>
</head>
<body>

<h1>Upload Media</h1>

<!-- Form for uploading file -->
<form action="<?=ROOT?>/Child/FileUpload/store" method="POST" enctype="multipart/form-data">
    <label for="MediaType">Media Type (PDF, Video, Image, Audio):</label>
    <input type="text" id="MediaType" name="MediaType" required><br>

    <label for="Title">Title:</label>
    <input type="text" id="Title" name="Title" required><br>

    <label for="Description">Description:</label>
    <textarea id="Description" name="Description" required></textarea><br>

    <label for="file">Choose a file to upload:</label>
    <input type="file" id="file" name="file" required><br>

    <button type="submit">Upload</button>
</form>

</body>
</html>
